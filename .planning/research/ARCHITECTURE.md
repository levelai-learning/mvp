# Architecture Research

**Project:** Level.AI - ADHD/Dyslexia EdTech Platform
**Researched:** 2026-02-04
**Confidence:** HIGH (verified via official Supabase documentation)

## Executive Summary

A PHP + Supabase architecture for Level.AI should follow a three-tier pattern: PHP handles business logic and UI rendering while Supabase provides authentication, database, and RLS-enforced data access. The multi-tenant B2B model (School > Teacher > Classroom > Student) maps cleanly to Supabase's tenant-id-in-metadata pattern with cascading RLS policies.

COPPA/FERPA compliance requires purpose-built audit logging (using Supabase's audit extension), explicit consent tracking tables, and careful separation between compliance data and operational data.

---

## System Components

### Component Overview

```
+------------------+     +------------------+     +------------------+
|   PHP Backend    |---->|   Supabase API   |---->|    PostgreSQL    |
|   (Controller)   |     |   (Auth + REST)  |     |    (RLS + Data)  |
+------------------+     +------------------+     +------------------+
        |                        |
        v                        v
+------------------+     +------------------+
|   View Layer     |     |   Audit Schema   |
|   (Templates)    |     |   (Compliance)   |
+------------------+     +------------------+
```

### 1. PHP Application Layer

**Responsibilities:**
- Route handling and request validation
- Business logic orchestration
- View rendering (server-side templates)
- JWT verification and session management
- Role-based UI gating

**Does NOT handle:**
- Direct database queries (delegated to Supabase REST API)
- User authentication mechanics (delegated to Supabase Auth)
- Row-level authorization (enforced by Supabase RLS)

**Rationale:** PHP acts as a "thin orchestration layer" - it decides WHAT to request from Supabase based on user role, but Supabase enforces WHO can access WHICH data. This separation prevents authorization logic bugs in PHP from creating data leaks.

### 2. Supabase Auth Service

**Responsibilities:**
- User registration/login flows
- JWT issuance and refresh
- Password reset flows
- Session management
- Storing tenant/role metadata in `app_metadata`

**Key patterns:**
- Use `app_metadata` (not `user_metadata`) for role and tenant IDs - users cannot modify `app_metadata`
- JWT claims include `role`, `school_id`, `user_type` for RLS policy use
- PHP verifies JWT signatures using Supabase JWKS endpoint

**Source:** [Supabase Auth Architecture](https://supabase.com/docs/guides/auth/architecture)

### 3. Supabase REST API

**Responsibilities:**
- Auto-generated REST endpoints for all tables
- RLS-enforced data access
- Automatic query optimization via PostgREST

**Access pattern from PHP:**
```
PHP sends:
- Authorization: Bearer <user_jwt>
- apikey: <anon_key>
- Request to /rest/v1/<table>

Supabase executes:
- Query with implicit RLS WHERE clauses
- Returns only rows user is authorized to see
```

**Source:** [Supabase REST API](https://supabase.com/docs/guides/api)

### 4. PostgreSQL Database

**Responsibilities:**
- Data storage with RLS policies
- Trigger-based audit logging
- Referential integrity via foreign keys
- Helper functions for RLS (tenant_id extraction, role checking)

**Key extensions:**
- `supa_audit` - table change tracking for FERPA compliance
- `pgcrypto` - encryption utilities if needed

### 5. Audit Schema (Compliance)

**Responsibilities:**
- Track all access to student education records
- Log data modifications with before/after states
- Maintain consent workflow state machine
- Support FERPA disclosure logs

**Source:** [Supabase Postgres Audit](https://supabase.com/blog/postgres-audit)

---

## Data Model

### Entity Relationship Overview

```
                    +----------------+
                    |    Schools     |  (Tenant/Organization)
                    +----------------+
                           |
            +--------------+--------------+
            |                             |
    +---------------+             +---------------+
    |   Teachers    |             |   Parents     |
    +---------------+             +---------------+
            |                             |
            v                             v
    +---------------+             +---------------+
    |  Classrooms   |             |   Students    |
    +---------------+             +---------------+
            |                             ^
            +------------+----------------+
                         |
                +---------------+
                |   Enrollment  | (junction table)
                +---------------+
```

### Core Tables

#### Organizations (Multi-Tenant Root)

```sql
CREATE TABLE schools (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    name TEXT NOT NULL,
    district TEXT,
    coppa_contact_email TEXT NOT NULL,  -- Required for consent workflows
    created_at TIMESTAMPTZ DEFAULT now(),
    settings JSONB DEFAULT '{}'::jsonb
);
```

#### User Profiles

```sql
CREATE TABLE profiles (
    id UUID PRIMARY KEY REFERENCES auth.users ON DELETE CASCADE,
    school_id UUID REFERENCES schools(id),
    user_type TEXT NOT NULL CHECK (user_type IN ('student', 'parent', 'teacher', 'admin')),
    display_name TEXT NOT NULL,
    avatar_url TEXT,
    created_at TIMESTAMPTZ DEFAULT now()
);
-- Index for RLS performance
CREATE INDEX profiles_school_id_idx ON profiles(school_id);
CREATE INDEX profiles_user_type_idx ON profiles(user_type);
```

**Trigger for auto-creation:**
```sql
CREATE FUNCTION handle_new_user()
RETURNS TRIGGER
LANGUAGE plpgsql
SECURITY DEFINER SET search_path = ''
AS $$
BEGIN
    INSERT INTO public.profiles (id, school_id, user_type, display_name)
    VALUES (
        new.id,
        (new.raw_app_meta_data ->> 'school_id')::uuid,
        new.raw_app_meta_data ->> 'user_type',
        new.raw_user_meta_data ->> 'display_name'
    );
    RETURN new;
END;
$$;

CREATE TRIGGER on_auth_user_created
    AFTER INSERT ON auth.users
    FOR EACH ROW EXECUTE PROCEDURE handle_new_user();
```

**Source:** [Supabase User Management](https://supabase.com/docs/guides/auth/managing-user-data)

#### Parent-Student Relationship

```sql
CREATE TABLE parent_student_links (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    parent_id UUID REFERENCES profiles(id) ON DELETE CASCADE,
    student_id UUID REFERENCES profiles(id) ON DELETE CASCADE,
    relationship TEXT DEFAULT 'parent',  -- 'parent', 'guardian', 'authorized_adult'
    is_primary BOOLEAN DEFAULT false,
    created_at TIMESTAMPTZ DEFAULT now(),
    UNIQUE(parent_id, student_id)
);
```

#### Teacher and Classroom

```sql
CREATE TABLE classrooms (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    school_id UUID REFERENCES schools(id) ON DELETE CASCADE,
    teacher_id UUID REFERENCES profiles(id),
    name TEXT NOT NULL,
    grade_level TEXT,
    subject TEXT,
    school_year TEXT,
    settings JSONB DEFAULT '{}'::jsonb,
    created_at TIMESTAMPTZ DEFAULT now()
);
CREATE INDEX classrooms_school_id_idx ON classrooms(school_id);
CREATE INDEX classrooms_teacher_id_idx ON classrooms(teacher_id);

CREATE TABLE classroom_enrollments (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    classroom_id UUID REFERENCES classrooms(id) ON DELETE CASCADE,
    student_id UUID REFERENCES profiles(id) ON DELETE CASCADE,
    enrolled_at TIMESTAMPTZ DEFAULT now(),
    status TEXT DEFAULT 'active' CHECK (status IN ('active', 'inactive', 'withdrawn')),
    UNIQUE(classroom_id, student_id)
);
```

#### Consent Tracking (COPPA)

```sql
CREATE TABLE consent_records (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    student_id UUID REFERENCES profiles(id) ON DELETE CASCADE,
    parent_id UUID REFERENCES profiles(id),
    school_id UUID REFERENCES schools(id),
    consent_type TEXT NOT NULL CHECK (consent_type IN ('school_granted', 'parent_direct')),
    consent_scope TEXT[] NOT NULL,  -- ['basic_learning', 'progress_tracking', 'voice_input']
    granted_at TIMESTAMPTZ DEFAULT now(),
    expires_at TIMESTAMPTZ,
    revoked_at TIMESTAMPTZ,
    verification_method TEXT,  -- 'email_link', 'school_admin', 'signed_form'
    verification_metadata JSONB,
    ip_address INET,
    user_agent TEXT
);
CREATE INDEX consent_records_student_idx ON consent_records(student_id);
CREATE INDEX consent_records_active_idx ON consent_records(student_id) WHERE revoked_at IS NULL;
```

---

## Role & Permission Model

### User Type Hierarchy

| User Type | Scope | Can See | Can Modify |
|-----------|-------|---------|------------|
| Student | Self only | Own tasks, progress, lessons | Task completion status |
| Parent | Linked children | Child's progress, schedule | Schedule preferences, teacher messages |
| Teacher | Own classrooms | All students in classrooms, curriculum | Assignments, grades, curriculum |
| Admin | Whole school | All school data | User management, settings |

### Supabase Role Mapping

All authenticated users map to `authenticated` Postgres role. Authorization handled via RLS policies checking `app_metadata`.

**User metadata structure:**
```json
{
    "app_metadata": {
        "school_id": "uuid",
        "user_type": "student|parent|teacher|admin",
        "classroom_ids": ["uuid", "uuid"]  // For teachers
    },
    "user_metadata": {
        "display_name": "...",
        "avatar_url": "..."
    }
}
```

### Helper Functions for RLS

```sql
-- Get current user's school ID
CREATE OR REPLACE FUNCTION auth.school_id()
RETURNS UUID
LANGUAGE sql STABLE
AS $$
    SELECT NULLIF(
        (current_setting('request.jwt.claims', true)::jsonb
         -> 'app_metadata' ->> 'school_id'),
        ''
    )::uuid
$$;

-- Get current user's type
CREATE OR REPLACE FUNCTION auth.user_type()
RETURNS TEXT
LANGUAGE sql STABLE
AS $$
    SELECT current_setting('request.jwt.claims', true)::jsonb
           -> 'app_metadata' ->> 'user_type'
$$;

-- Check if user is a teacher for a classroom
CREATE OR REPLACE FUNCTION auth.is_teacher_for_classroom(classroom_uuid UUID)
RETURNS BOOLEAN
LANGUAGE sql STABLE
AS $$
    SELECT EXISTS (
        SELECT 1 FROM classrooms
        WHERE id = classroom_uuid
        AND teacher_id = auth.uid()
    )
$$;

-- Check if user is parent of student
CREATE OR REPLACE FUNCTION auth.is_parent_of(student_uuid UUID)
RETURNS BOOLEAN
LANGUAGE sql STABLE
AS $$
    SELECT EXISTS (
        SELECT 1 FROM parent_student_links
        WHERE parent_id = auth.uid()
        AND student_id = student_uuid
    )
$$;
```

**Source:** [Supabase RLS Documentation](https://supabase.com/docs/guides/database/postgres/row-level-security)

---

## Security Architecture

### RLS Policy Examples

#### Profiles Table

```sql
-- Users can read their own profile
CREATE POLICY "users_read_own_profile"
ON profiles FOR SELECT
TO authenticated
USING (id = auth.uid());

-- Teachers can read profiles of students in their classrooms
CREATE POLICY "teachers_read_classroom_students"
ON profiles FOR SELECT
TO authenticated
USING (
    auth.user_type() = 'teacher'
    AND user_type = 'student'
    AND id IN (
        SELECT ce.student_id
        FROM classroom_enrollments ce
        JOIN classrooms c ON c.id = ce.classroom_id
        WHERE c.teacher_id = auth.uid()
    )
);

-- Parents can read their linked children's profiles
CREATE POLICY "parents_read_children"
ON profiles FOR SELECT
TO authenticated
USING (
    auth.user_type() = 'parent'
    AND auth.is_parent_of(id)
);

-- School admins can read all profiles in their school
CREATE POLICY "admins_read_school_profiles"
ON profiles FOR SELECT
TO authenticated
USING (
    auth.user_type() = 'admin'
    AND school_id = auth.school_id()
);
```

#### Progress Data (FERPA-Protected)

```sql
-- Students see only their own progress
CREATE POLICY "students_own_progress"
ON student_progress FOR SELECT
TO authenticated
USING (
    auth.user_type() = 'student'
    AND student_id = auth.uid()
);

-- Parents see linked children's progress
CREATE POLICY "parents_children_progress"
ON student_progress FOR SELECT
TO authenticated
USING (
    auth.user_type() = 'parent'
    AND auth.is_parent_of(student_id)
);

-- Teachers see progress for students in their classrooms
CREATE POLICY "teachers_classroom_progress"
ON student_progress FOR SELECT
TO authenticated
USING (
    auth.user_type() = 'teacher'
    AND student_id IN (
        SELECT ce.student_id
        FROM classroom_enrollments ce
        JOIN classrooms c ON c.id = ce.classroom_id
        WHERE c.teacher_id = auth.uid()
    )
);
```

### Multi-Tenant Isolation

Every table with tenant-scoped data includes `school_id`:

```sql
-- Base policy: users can only access data within their school
CREATE POLICY "tenant_isolation"
ON [table_name] FOR ALL
TO authenticated
USING (school_id = auth.school_id());
```

**This is the FIRST policy evaluated** - even if other policies grant access, data from other schools is never visible.

**Source:** [Supabase Multi-Tenancy Pattern](https://roughlywritten.substack.com/p/supabase-multi-tenancy-simple-and)

### JWT Verification in PHP

```php
// PHP-side JWT verification
use Firebase\JWT\JWT;
use Firebase\JWT\JWK;

class SupabaseAuth {
    private $jwksUrl;
    private $jwksCache;

    public function __construct(string $projectRef) {
        $this->jwksUrl = "https://{$projectRef}.supabase.co/auth/v1/.well-known/jwks.json";
    }

    public function verifyToken(string $token): ?object {
        // Fetch JWKS (cache for < 10 minutes)
        $jwks = $this->getJwks();

        try {
            $decoded = JWT::decode($token, JWK::parseKeySet($jwks));

            // Verify claims
            if ($decoded->exp < time()) {
                return null; // Expired
            }

            return $decoded;
        } catch (Exception $e) {
            return null;
        }
    }

    public function getUserType(object $jwt): string {
        return $jwt->app_metadata->user_type ?? 'unknown';
    }

    public function getSchoolId(object $jwt): ?string {
        return $jwt->app_metadata->school_id ?? null;
    }
}
```

**Source:** [Supabase JWT Documentation](https://supabase.com/docs/guides/auth/jwts)

### FERPA Audit Logging

Enable audit tracking on education record tables:

```sql
-- Install supa_audit extension
CREATE EXTENSION IF NOT EXISTS supa_audit CASCADE;

-- Enable on FERPA-protected tables
SELECT audit.enable_tracking('public.student_progress'::regclass);
SELECT audit.enable_tracking('public.lesson_completions'::regclass);
SELECT audit.enable_tracking('public.assessment_results'::regclass);
SELECT audit.enable_tracking('public.student_notes'::regclass);

-- Custom access log for FERPA disclosure requirements
CREATE TABLE ferpa_access_log (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    accessed_at TIMESTAMPTZ DEFAULT now(),
    accessor_id UUID REFERENCES profiles(id),
    accessor_type TEXT NOT NULL,
    student_id UUID REFERENCES profiles(id),
    record_type TEXT NOT NULL,
    record_id UUID,
    access_reason TEXT,
    ip_address INET,
    school_id UUID REFERENCES schools(id)
);

-- Trigger to log access to protected tables
CREATE FUNCTION log_ferpa_access()
RETURNS TRIGGER
LANGUAGE plpgsql SECURITY DEFINER
AS $$
BEGIN
    INSERT INTO ferpa_access_log (
        accessor_id, accessor_type, student_id,
        record_type, record_id, school_id
    )
    SELECT
        auth.uid(),
        auth.user_type(),
        NEW.student_id,
        TG_TABLE_NAME,
        NEW.id,
        auth.school_id();
    RETURN NEW;
END;
$$;
```

**Source:** [FERPA Compliance Requirements](https://www.brightdefense.com/blog/ferpa-compliance-checklist/)

---

## Data Flow

### Authentication Flow

```
User                PHP                 Supabase Auth        Database
 |                   |                       |                   |
 |-- Login form ---->|                       |                   |
 |                   |-- signIn() ---------->|                   |
 |                   |                       |-- Verify creds -->|
 |                   |                       |<-- User record ---|
 |                   |<-- JWT + refresh -----|                   |
 |<-- Set cookie ----|                       |                   |
 |                   |                       |                   |
 |-- Page request -->|                       |                   |
 |                   |-- Verify JWT locally -|                   |
 |                   |-- API request --------|------------------>|
 |                   |                       |    (RLS applied)  |
 |                   |<-- Filtered data -----|-------------------|
 |<-- Rendered page -|                       |                   |
```

### Student Task Completion Flow

```
Student             PHP                 Supabase             Audit
   |                  |                     |                   |
   |-- Mark done ---->|                     |                   |
   |                  |-- Validate JWT ----->|                   |
   |                  |                     |                   |
   |                  |-- UPDATE task       |                   |
   |                  |   WITH student JWT ->|                   |
   |                  |                     |-- RLS check ------>|
   |                  |                     |   (is this their  |
   |                  |                     |    task?)         |
   |                  |                     |                   |
   |                  |                     |-- Trigger -------->|
   |                  |                     |   audit.insert()  |
   |                  |                     |                   |
   |                  |<-- Success ---------|                   |
   |<-- Updated UI ---|                     |                   |
```

### Parent Viewing Child Progress

```
Parent              PHP                 Supabase             Audit
   |                  |                     |                   |
   |-- View child --->|                     |                   |
   |                  |-- GET /progress     |                   |
   |                  |   WITH parent JWT ->|                   |
   |                  |                     |                   |
   |                  |                     |-- RLS check ------>|
   |                  |                     |   is_parent_of()  |
   |                  |                     |                   |
   |                  |                     |-- Log FERPA ------>|
   |                  |                     |   access          |
   |                  |                     |                   |
   |                  |<-- Child's data ----|                   |
   |<-- Progress UI --|                     |                   |
```

### Consent Workflow Flow (COPPA)

```
New Student Signup

Parent              PHP                 Supabase
   |                  |                     |
   |-- Create acct -->|                     |
   |                  |-- Create parent --->|
   |                  |   user              |
   |                  |<-- Parent JWT ------|
   |                  |                     |
   |-- Add child ---->|                     |
   |                  |-- Create student -->|
   |                  |   (pending status)  |
   |                  |                     |
   |                  |-- Create consent -->|
   |                  |   record (pending)  |
   |                  |                     |
   |<-- Verify email -|                     |
   |                  |                     |
   |-- Click link --->|                     |
   |                  |-- Verify token ---->|
   |                  |-- Update consent -->|
   |                  |   (granted)         |
   |                  |-- Activate -------->|
   |                  |   student account   |
   |<-- Success ------|                     |
```

**Source:** [COPPA Compliance Requirements](https://blog.promise.legal/startup-central/coppa-compliance-in-2025-a-practical-guide-for-tech-edtech-and-kids-apps/)

---

## Build Order

Based on component dependencies, build in this sequence:

### Phase 1: Foundation (Weeks 1-2)

**Build first - everything depends on these:**

1. **Supabase project setup**
   - Create project, configure auth settings
   - Set up environment variables

2. **Core database schema**
   - `schools` table (tenant root)
   - `profiles` table with trigger
   - Basic RLS policies

3. **PHP-Supabase integration**
   - JWT verification library
   - Supabase REST client wrapper
   - Session/cookie management

4. **Basic auth flows**
   - Login/logout
   - Role-based redirects

**Why first:** All features need auth + basic data access

### Phase 2: User Management (Weeks 2-3)

**Build second - users before content:**

1. **Teacher user type**
   - Profile management
   - Classroom creation

2. **Student user type**
   - Profile (minimal - no PII collection yet)
   - Classroom enrollment

3. **Parent user type**
   - Profile management
   - Parent-student linking

4. **Multi-tenant isolation**
   - School-level RLS policies
   - School admin basics

**Why second:** Content delivery needs users to deliver to

### Phase 3: Compliance Infrastructure (Weeks 3-4)

**Build third - before any student data:**

1. **Consent workflow**
   - Consent records table
   - Parent verification flow
   - Consent scope management

2. **Audit logging**
   - supa_audit installation
   - FERPA access logging
   - Access log queries

3. **Data retention policies**
   - Soft delete patterns
   - Anonymization utilities

**Why third:** MUST be in place before collecting student education records

### Phase 4: Core Learning Features (Weeks 4-6)

**Build fourth - the actual product:**

1. **Curriculum structure**
   - Lessons, modules, topics
   - Assignment management

2. **Student experience**
   - Task views
   - Progress tracking
   - Break system

3. **Teacher dashboard**
   - Class overview
   - Assignment creation
   - Progress monitoring

4. **Parent dashboard**
   - Child progress view
   - Schedule management
   - Teacher communication

**Why fourth:** Depends on all prior infrastructure

### Phase 5: Polish & Demo (Weeks 6-8)

1. **ADHD/Dyslexia features**
   - UI accommodations
   - Focus modes

2. **Demo data seeding**
3. **Error handling**
4. **Performance optimization**

---

## Architectural Decisions Summary

| Decision | Choice | Rationale |
|----------|--------|-----------|
| Auth | Supabase Auth | Handles JWTs, sessions, eliminates custom auth bugs |
| Authorization | RLS policies | Enforced at database level, can't be bypassed by PHP bugs |
| Multi-tenancy | school_id in app_metadata | Clean RLS policies, no join tables for tenant checks |
| API pattern | PHP + Supabase REST | PHP orchestrates, Supabase enforces, separation of concerns |
| Audit logging | supa_audit extension | Built for Postgres, minimal performance impact, JSONB schema-agnostic |
| User profiles | Separate profiles table | Auth schema not exposed, allows custom fields |
| Consent tracking | Dedicated table + state machine | COPPA audit trail, revocation support |

---

## Sources

### Supabase Official Documentation (HIGH confidence)
- [Row Level Security](https://supabase.com/docs/guides/database/postgres/row-level-security)
- [Auth Architecture](https://supabase.com/docs/guides/auth/architecture)
- [JWT Documentation](https://supabase.com/docs/guides/auth/jwts)
- [User Management](https://supabase.com/docs/guides/auth/managing-user-data)
- [REST API](https://supabase.com/docs/guides/api)
- [Postgres Audit Blog](https://supabase.com/blog/postgres-audit)

### Compliance Resources (MEDIUM confidence)
- [COPPA 2025 Guide](https://blog.promise.legal/startup-central/coppa-compliance-in-2025-a-practical-guide-for-tech-edtech-and-kids-apps/)
- [FERPA Compliance Checklist](https://www.brightdefense.com/blog/ferpa-compliance-checklist/)

### Community Patterns (MEDIUM confidence)
- [Supabase Multi-Tenancy Guide](https://roughlywritten.substack.com/p/supabase-multi-tenancy-simple-and)
