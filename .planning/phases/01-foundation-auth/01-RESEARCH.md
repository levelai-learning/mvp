# Phase 1: Foundation & Auth - Research

**Researched:** 2026-04-02
**Domain:** Supabase auth integration with PHP, RLS, multi-role routing, CSS design system
**Confidence:** MEDIUM-HIGH

---

<user_constraints>
## User Constraints (from CONTEXT.md)

### Locked Decisions

- **D-01:** Onboard first, then auth. Users go through the existing preference/avatar steps, then create their account (email/password) at the end. Reduces upfront friction.
- **D-02:** Separate entry paths per role. Landing page shows "I'm a student" / "I'm a parent" / "I'm a teacher" buttons, each leading to a tailored onboarding and signup flow.
- **D-03:** Parent-child linking via invite code. Teacher or admin creates student account, gives parent a code. Parent enters code during their signup to link accounts.
- **D-04:** COPPA consent appears in parent flow only. Parent sees consent step when linking to child's account. Student never sees consent UI — parent consented on their behalf.
- **D-05:** URL structure uses role prefixes: /student/home, /teacher/dashboard, /parent/dashboard. Clear separation, easy to protect with PHP middleware.
- **D-06:** After login, users go straight to their role dashboard. No intermediate welcome screen.
- **D-07:** Unauthenticated users hitting protected pages get redirected to /login. After successful login, redirect back to the originally requested page.
- **D-08:** Full audit trail logging. All data reads/writes logged with user, timestamp, and resource.
- **D-09:** Full RLS isolation. Students see only their own data, parents see only linked children, teachers see only their classroom students.
- **D-10:** One teacher, one classroom model. Each teacher has exactly one classroom for the demo.
- **D-11:** Keep both light and dark themes. Already partially built — polish both for Phase 1.
- **D-12:** Keep the Open Dyslexic font toggle.
- **D-13:** Subtle accent color per role. Same base design but student/parent/teacher each get a different accent color for nav/buttons.

### Claude's Discretion

- CSS architecture: Claude decides whether to keep single app.css (organized with sections) or split into multiple files based on what works best with the existing PHP includes pattern.

### Deferred Ideas (OUT OF SCOPE)

None — discussion stayed within phase scope.

</user_constraints>

---

<phase_requirements>
## Phase Requirements

| ID | Description | Research Support |
|----|-------------|------------------|
| AUTH-01 | User can create account with email and password | Supabase Auth REST API `/auth/v1/signup` — use `supabase-php/supabase-client` v1.2.0 |
| AUTH-02 | User is routed to appropriate dashboard based on role (student/parent/teacher) | Custom JWT claim `app_metadata.role` read in PHP after login; router.php extended for `/student/`, `/parent/`, `/teacher/` prefixes |
| AUTH-03 | Session persists across browser refresh | Access token + refresh token stored in `HttpOnly` PHP session cookies; PHP reads cookie and validates token on every protected page load |
| AUTH-04 | Parent account links to child's student account during signup | `parent_student_links` join table keyed on `parent_id` + `student_id`; `invite_codes` table with single-use tokens; invite code entered during parent onboarding |
| AUTH-05 | Consent workflow UI is visible and functional (architecture-ready for full COPPA) | `consent_records` table (consent_type, scope, verification_method, granted_at, granted_by_user_id); shown in parent onboarding step before account creation |
| AUTH-06 | Row Level Security enforces data access at database level | Enable RLS on all tables; policies use `(select auth.uid())` pattern and `auth.jwt()->'app_metadata'->>'role'` for role checking |
| AUTH-07 | Audit logging captures data access events (FERPA-ready) | pgaudit extension + custom `audit_log` table (user_id, action, resource_type, resource_id, timestamp, ip_address) populated via Postgres triggers |
| DSGN-01 | Cream/off-white backgrounds (#FFFEF5) across all screens | Already in app.css as `--color-bg: #F2F0EA` — update token to `#FFFEF5` to match spec exactly, or confirm current value is close enough |
| DSGN-02 | Dark gray text (#333333), not pure black | Already in app.css as `--color-text-primary: #2C2C2C` — update to `#333333` to match spec |
| DSGN-03 | Color used only for meaning (status, priority) | Audit all screens to remove decorative color; add per-role accent CSS variables |
| DSGN-04 | Age-appropriate language (encouraging, not childish) | Content review of all nav labels, error messages, and onboarding copy |
| DSGN-05 | No decorative fills, busy patterns, or flashing animations | CSS audit — remove any animated decorative elements; transitions limited to 180ms ease (already set) |

</phase_requirements>

---

## Summary

Phase 1 builds the authentication layer and visual design system that every subsequent phase depends on. The stack is PHP 8.5 + Supabase (Auth + PostgreSQL) + vanilla JS. No PHP framework; no JS framework. The existing codebase has a solid CSS design system (app.css), PHP includes pattern (bootstrap.php, head.php, nav-app.php), and a router (router.php) that needs to be extended for role-prefixed URLs.

The critical integration work is: (1) wiring Supabase Auth into the PHP request lifecycle via `supabase-php/supabase-client` v1.2.0, (2) storing access/refresh tokens as `HttpOnly` PHP session cookies so the server can verify sessions without exposing tokens to JavaScript, (3) extending router.php to handle `/student/*`, `/parent/*`, `/teacher/*` paths and enforce auth middleware, and (4) creating the database schema with RLS policies from day one.

The invite code flow for parent-child linking is straightforward: a `parent_invites` table with single-use tokens created by teachers/admins. The parent enters the code during signup; PHP looks up the invite, validates it, and inserts into `parent_student_links`. Consent record is written at the same transaction point.

**Primary recommendation:** Build the PHP auth middleware and role-routing infrastructure first (as a Wave 1 plan), then the database schema + RLS + invite code flow (Wave 2), then the design system polish (Wave 3). Auth middleware gates everything — nothing else can be safely built without it.

---

## Standard Stack

### Core

| Library | Version | Purpose | Why Standard |
|---------|---------|---------|--------------|
| supabase-php/supabase-client | v1.2.0 | PHP client for Supabase Auth, PostgREST, Storage | Most recently maintained (Dec 2025); official `supabase/supabase-php` is alpha and not production-ready |
| defuse/php-encryption | v2.4.0 | AES-256 encryption for student PII at rest | Audited, 16M+ installs, designed to be hard to misuse; FERPA-ready |
| @supabase/supabase-js | 2.101.1 | Client-side Supabase interactions (auth state) | Official; handles token refresh and `onAuthStateChange` |

### Supporting

| Library | Version | Purpose | When to Use |
|---------|---------|---------|-------------|
| pgaudit (Postgres extension) | Built-in to Supabase | Database-level audit logging | Enable in Supabase dashboard; supplement with custom `audit_log` table |
| vlucas/phpdotenv | ^5.6 | `.env` file loading for Supabase credentials | Required dependency of supabase-php client |
| firebase/php-jwt | ^6.x | Optional: verify Supabase JWTs server-side without calling auth API | Use only if you need zero-latency token verification without network call |

### Alternatives Considered

| Instead of | Could Use | Tradeoff |
|------------|-----------|----------|
| supabase-php/supabase-client | Raw PHP cURL to Supabase REST API | More control, no dependency; more boilerplate. Viable for this project size. |
| supabase-php/supabase-client | supabase/supabase-php (official) | Official library is marked alpha, last production update April 2023 — avoid |
| defuse/php-encryption | sodium_crypto (PHP built-in) | sodium_crypto is lower-level and also excellent; defuse wraps it with key management helpers |
| pgaudit | Custom PHP logging to a table | pgaudit captures all DB activity regardless of PHP; more complete for FERPA |

**Installation (when Composer is available):**
```bash
composer require supabase-php/supabase-client defuse/php-encryption
```

**Note on Composer:** Composer was not found on the local machine. The PHP files will need to be deployed to an environment with Composer, or Composer installed locally first (`brew install composer` on macOS). The project currently has no `composer.json` — this needs to be initialized.

**Version verification (confirmed 2026-04-02):**
- `supabase-php/supabase-client`: v1.2.0 (released 2025-12-25, last Packagist update 2026-03-26)
- `defuse/php-encryption`: v2.4.0
- `@supabase/supabase-js`: 2.101.1 (via `npm view`)

---

## Architecture Patterns

### Recommended Project Structure

```
public/
├── index.php              # Landing: role selection ("I'm a student / parent / teacher")
├── login.php              # Shared login page (redirects to role dashboard after)
├── student/
│   ├── home.php           # Student dashboard (AUTH required, role=student)
│   └── ...                # Other student pages
├── parent/
│   ├── dashboard.php      # Parent dashboard (AUTH required, role=parent)
│   └── ...
├── teacher/
│   ├── dashboard.php      # Teacher dashboard (AUTH required, role=teacher)
│   └── ...
├── onboard/
│   ├── student/           # Student-specific onboarding flow (steps 1-5 + signup)
│   ├── parent/            # Parent onboarding (steps + consent + invite code + signup)
│   └── teacher/           # Teacher onboarding (steps + signup)
├── includes/
│   ├── bootstrap.php      # (exists) — add Composer autoload + Supabase client init
│   ├── auth-middleware.php # NEW: verify session, enforce role, redirect if needed
│   ├── head.php           # (exists)
│   ├── nav-app.php        # (exists) — extend for role-aware rendering
│   ├── nav-onboard.php    # (exists)
│   └── footer.php        # (exists)
└── router.php             # Extend for /student/*, /parent/*, /teacher/* + auth gate
```

### Pattern 1: PHP Auth Middleware

**What:** Every protected page includes `auth-middleware.php` before rendering. The middleware reads session cookies containing the Supabase access token, verifies it, extracts the role claim, and either continues or redirects.

**When to use:** Include at the top of every protected page. The `login.php` page and `/onboard/*` pages are public (no middleware).

**Example:**
```php
// includes/auth-middleware.php
<?php
// 1. Read tokens from HttpOnly cookies (set at login time)
$access_token  = $_COOKIE['sb_access_token']  ?? null;
$refresh_token = $_COOKIE['sb_refresh_token'] ?? null;

if (!$access_token) {
    // Store intended destination, redirect to login
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    header('Location: /login.php');
    exit;
}

// 2. Verify with Supabase (getUser validates against auth server)
$supabase = require __DIR__ . '/supabase-client.php';
try {
    $user = $supabase->auth->getUser($access_token);
} catch (Exception $e) {
    // Token expired — attempt refresh
    try {
        $session = $supabase->auth->refreshSession($refresh_token);
        $user = $session->user;
        // Rewrite cookies with new tokens
        setcookie('sb_access_token', $session->access_token, [
            'expires'  => time() + 3600,
            'httponly' => true,
            'samesite' => 'Lax',
            'secure'   => true,
            'path'     => '/',
        ]);
        setcookie('sb_refresh_token', $session->refresh_token, [
            'expires'  => time() + (60 * 60 * 24 * 30), // 30 days
            'httponly' => true,
            'samesite' => 'Lax',
            'secure'   => true,
            'path'     => '/',
        ]);
    } catch (Exception $e2) {
        // Refresh failed — force re-login
        header('Location: /login.php');
        exit;
    }
}

// 3. Extract role from JWT app_metadata
$role = $user->app_metadata['role'] ?? null;

// 4. Enforce role-path match (optional — also handled by router)
// $REQUIRED_ROLE defined by the calling page (e.g., 'student')
if (isset($REQUIRED_ROLE) && $role !== $REQUIRED_ROLE) {
    header('Location: /login.php?error=wrong_role');
    exit;
}

// 5. Make user available to the page
$CURRENT_USER = $user;
$CURRENT_ROLE = $role;
```

### Pattern 2: Supabase Client Initialization

**What:** A single PHP file that initializes and returns the Supabase client. Included by bootstrap.php.

**When to use:** Before any auth or database operation.

```php
// includes/supabase-client.php
<?php
require_once BASE_PATH . '/vendor/autoload.php';

use Supabase\CreateClient;

$supabase = CreateClient::create(
    $_ENV['SUPABASE_URL'],
    $_ENV['SUPABASE_ANON_KEY']  // Use ANON key for user-facing operations
);

return $supabase;
```

### Pattern 3: RLS Policy — Role-Based Isolation

**What:** All user tables have RLS enabled. Policies read the `role` from `app_metadata` in the JWT and the user's `id` from `auth.uid()`.

**When to use:** Applied at schema creation time to every table that contains user data.

```sql
-- Source: Supabase official RLS docs + custom claims guide

-- Students see only their own progress
create policy "students_own_data" on student_progress
  for all
  to authenticated
  using (
    student_id = (select auth.uid())
    and (select auth.jwt() -> 'app_metadata' ->> 'role') = 'student'
  );

-- Parents see only their linked children's data
create policy "parents_see_linked_children" on student_progress
  for select
  to authenticated
  using (
    (select auth.jwt() -> 'app_metadata' ->> 'role') = 'parent'
    and student_id in (
      select student_id from parent_student_links
      where parent_id = (select auth.uid())
    )
  );

-- Teachers see only students in their classroom
create policy "teachers_see_classroom" on student_progress
  for select
  to authenticated
  using (
    (select auth.jwt() -> 'app_metadata' ->> 'role') = 'teacher'
    and student_id in (
      select cs.student_id from classroom_students cs
      join classrooms c on cs.classroom_id = c.id
      where c.teacher_id = (select auth.uid())
    )
  );
```

### Pattern 4: Custom JWT Role Claim via Auth Hook

**What:** A Postgres function that fires as a Supabase Auth Hook whenever a JWT is issued. It reads the user's role from a `user_roles` table and embeds it in `app_metadata` of the JWT.

**When to use:** Set up once during database initialization. Required for RLS policies to read role from token.

```sql
-- Source: Supabase Custom Access Token Hook docs
create or replace function public.custom_access_token_hook(event jsonb)
returns jsonb
language plpgsql
stable  -- important: must be stable or immutable
as $$
declare
  claims jsonb;
  user_role text;
begin
  select role into user_role
  from public.user_roles
  where user_id = (event->>'user_id')::uuid;

  claims := event->'claims';

  if jsonb_typeof(claims->'app_metadata') is null then
    claims := jsonb_set(claims, '{app_metadata}', '{}');
  end if;

  claims := jsonb_set(claims, '{app_metadata,role}', to_jsonb(user_role));

  event := jsonb_set(event, '{claims}', claims);
  return event;
end;
$$;

-- Grant execute permission and register as auth hook in Supabase Dashboard
grant execute on function public.custom_access_token_hook to supabase_auth_admin;
```

**After creating this function:** Go to Supabase Dashboard > Authentication > Hooks > Custom Access Token, and point it at this function. The role then appears in every JWT automatically.

### Pattern 5: Invite Code Flow for Parent-Child Linking

**What:** Teacher/admin creates a student account and generates a single-use invite code. Parent enters code during signup. PHP looks up the invite, validates it, and writes to `parent_student_links` and `consent_records` atomically.

**Database schema:**

```sql
-- parent_invites: single-use tokens created by teachers
create table public.parent_invites (
  id            uuid primary key default gen_random_uuid(),
  code          text not null unique,              -- 8-char alphanumeric code
  student_id    uuid not null references auth.users(id),
  created_by    uuid not null references auth.users(id), -- teacher who created it
  expires_at    timestamptz not null default (now() + interval '7 days'),
  used_at       timestamptz,
  used_by       uuid references auth.users(id)    -- parent who used it
);

-- parent_student_links: the durable relationship
create table public.parent_student_links (
  id         uuid primary key default gen_random_uuid(),
  parent_id  uuid not null references auth.users(id),
  student_id uuid not null references auth.users(id),
  linked_at  timestamptz not null default now(),
  invite_id  uuid references public.parent_invites(id),
  unique(parent_id, student_id)
);

-- consent_records: COPPA-required consent tracking
create table public.consent_records (
  id                  uuid primary key default gen_random_uuid(),
  student_id          uuid not null references auth.users(id),
  parent_id           uuid not null references auth.users(id),
  consent_type        text not null default 'coppa_data_collection',
  scope               text not null default 'educational_data',
  verification_method text not null default 'email',  -- for demo
  granted_at          timestamptz not null default now(),
  granted_by_user_id  uuid not null references auth.users(id),
  revoked_at          timestamptz,
  ip_address          inet
);
```

**PHP redemption flow (during parent signup, step after invite code entry):**

```php
// Pseudo-code for invite redemption
$code = trim($_POST['invite_code']);

// 1. Look up invite (check not expired, not used)
$invite = $supabase->from('parent_invites')
  ->select('*')
  ->eq('code', strtoupper($code))
  ->is('used_at', null)
  ->gt('expires_at', date('c'))
  ->single()
  ->execute();

if (!$invite->data) {
    $error = 'Invalid or expired invite code.';
} else {
    // Store in session for the final signup step
    $_SESSION['pending_invite'] = $invite->data;
}
```

### Anti-Patterns to Avoid

- **Using service role key client-side:** The service role key bypasses ALL RLS. Never expose it. Only use it in server-side PHP for admin operations (creating invite codes, user account setup). Never include it in any JS or HTML.
- **Calling `auth.uid()` without SELECT wrapper in RLS:** Use `(select auth.uid())` not `auth.uid()` directly. The SELECT wrapper caches the result per statement, giving 94% performance improvement per Supabase official docs.
- **Storing tokens in localStorage:** Supabase JS by default stores tokens in localStorage. For this PHP-rendered app, configure the JS client with `persistSession: false` and let PHP manage sessions via cookies instead — or use `storage: customStorage` that reads/writes to cookies that PHP can also read.
- **Not redirecting to original page after login:** Store `$_SERVER['REQUEST_URI']` in `$_SESSION['redirect_after_login']` before redirecting to login. After successful login, redirect to that stored URL (validate it's a relative path first to prevent open redirect).

---

## Don't Hand-Roll

| Problem | Don't Build | Use Instead | Why |
|---------|-------------|-------------|-----|
| Password hashing | Custom bcrypt wrapper | Supabase Auth | Supabase handles password hashing, salting, rate limiting, and breach detection |
| JWT generation/signing | Custom JWT library | Supabase Auth + `custom_access_token_hook` | JWT signing keys, algorithm selection, and rotation are security-critical |
| Invite code collision prevention | Custom random string generator | `gen_random_uuid()` + `encode(gen_random_bytes(4), 'hex')` in Postgres | Database-native random is cryptographically safe |
| AES encryption | OpenSSL calls directly | `defuse/php-encryption` | Key management and IV generation are where DIY encryption fails |
| Session token storage | Custom cookie implementation | PHP `setcookie()` with `HttpOnly`+`SameSite`+`Secure` flags | Standard flags prevent XSS and CSRF token theft |
| Audit logging | Custom PHP log file | pgaudit + custom `audit_log` table | pgaudit captures DB activity regardless of which client wrote the data |

**Key insight:** The biggest risk in auth systems is not feature gaps — it is correct implementation of security-sensitive operations. Use Supabase Auth for all identity operations; only integrate custom PHP for routing and session cookie management.

---

## Common Pitfalls

### Pitfall 1: Service Role Key Exposure

**What goes wrong:** Service role key (or secret API key) ends up in `app.js`, a `<script>` tag, or a committed `.env` file. All RLS is bypassed for anyone who finds it.

**Why it happens:** Developer needs to create accounts server-side (invite flow, admin setup) and uses service role key in PHP, then accidentally references same variable in a template that outputs it.

**How to avoid:** Two separate PHP constants: `SUPABASE_ANON_KEY` (safe to use in any context) and `SUPABASE_SERVICE_KEY` (only in server-side admin scripts, never referenced in view templates).

**Warning signs:** Any `<?= SUPABASE_SERVICE_KEY ?>` in a template. Grepping the built output for the key prefix should return zero results.

### Pitfall 2: JWT Role Claim Not Refreshed After Role Assignment

**What goes wrong:** Teacher creates a student account and assigns role='student'. Parent logs in and their JWT still has no role claim (or stale role) because JWTs are issued at login time and cached.

**Why it happens:** The `custom_access_token_hook` reads the role at JWT issuance. If the role row is inserted AFTER the user's first login, their existing JWT doesn't have it.

**How to avoid:** Always insert the `user_roles` row BEFORE the user's first login (i.e., during account creation via service key). For role changes, require the user to log out and log back in, or force a session refresh via the Supabase Auth admin API.

**Warning signs:** RLS denying access to users who should have access, even though the `user_roles` table has their correct role.

### Pitfall 3: Open Redirect After Login

**What goes wrong:** Login page redirects to `?redirect=/arbitrary/url` which could redirect to a phishing site.

**Why it happens:** Developer stores the redirect target in a query param and uses it without validation.

**How to avoid:** Only redirect to paths that are relative (start with `/`) and do not contain `://`. Validate with: `if (strpos($redirect, '/') === 0 && strpos($redirect, '//') !== 0)`.

**Warning signs:** Login form with `<input type="hidden" name="redirect" value="<?= $_GET['redirect'] ?>">` without sanitization.

### Pitfall 4: RLS Policies Missing on New Tables

**What goes wrong:** A later phase adds a new table (e.g., `lesson_progress`). Developer forgets to enable RLS. All authenticated users can read all rows via the Supabase anon key.

**Why it happens:** RLS is not enabled by default in Postgres; Supabase dashboard makes it easy to forget.

**How to avoid:** Every `CREATE TABLE` statement in migration scripts includes `ALTER TABLE ... ENABLE ROW LEVEL SECURITY;` on the next line. Add a database function that checks all tables have RLS enabled and alert if any new table doesn't.

**Warning signs:** Supabase Dashboard "Table Editor" shows tables without the lock icon.

### Pitfall 5: PHP Sessions vs Supabase Tokens — Dual State

**What goes wrong:** PHP session (`$_SESSION`) stores user data. Supabase JS client (`supabase.auth.getSession()`) has its own state. They get out of sync when one is cleared but the other isn't.

**Why it happens:** PHP logout clears `$_SESSION` but doesn't tell the JS client to clear its token. Or the JS client refreshes the access token but PHP still has the old token in a cookie.

**How to avoid:** On logout, (1) call `supabase.auth.signOut()` from JS to clear the JS client state, (2) PHP also clears the `sb_access_token` and `sb_refresh_token` cookies via `setcookie(..., '', time()-3600)`. One source of truth: HttpOnly cookies are the canonical session state; JS client configured with `persistSession: false`.

---

## Code Examples

### Signup Flow (PHP — final onboarding step)

```php
// POST handler for account creation at end of onboarding
<?php
require_once BASE_PATH . '/includes/supabase-client.php';

$email    = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = $_POST['password'] ?? '';
$role     = $_SESSION['onboard_role'] ?? null; // 'student', 'parent', 'teacher'

if (!$email || strlen($password) < 8 || !$role) {
    $error = 'Missing required fields.';
} else {
    // Use service-role client for signup (to set app_metadata.role)
    $adminClient = CreateClient::create(
        $_ENV['SUPABASE_URL'],
        $_ENV['SUPABASE_SERVICE_KEY']
    );

    try {
        $user = $adminClient->auth->admin->createUser([
            'email'          => $email,
            'password'       => $password,
            'email_confirm'  => true,  // Skip email verify for demo
            'app_metadata'   => ['role' => $role],
        ]);

        // Insert into user_roles table (custom_access_token_hook reads this)
        $adminClient->from('user_roles')->insert([
            'user_id' => $user->id,
            'role'    => $role,
        ])->execute();

        // Sign them in immediately after creation
        $anonClient = require BASE_PATH . '/includes/supabase-client.php';
        $session = $anonClient->auth->signInWithPassword([
            'email'    => $email,
            'password' => $password,
        ]);

        // Store tokens in HttpOnly cookies
        setcookie('sb_access_token', $session->access_token, [
            'expires'  => time() + 3600,
            'httponly' => true,
            'samesite' => 'Lax',
            'secure'   => isset($_SERVER['HTTPS']),
            'path'     => '/',
        ]);
        setcookie('sb_refresh_token', $session->refresh_token, [
            'expires'  => time() + (60 * 60 * 24 * 30),
            'httponly' => true,
            'samesite' => 'Lax',
            'secure'   => isset($_SERVER['HTTPS']),
            'path'     => '/',
        ]);

        // Redirect to role dashboard
        $dashboards = [
            'student' => '/student/home.php',
            'parent'  => '/parent/dashboard.php',
            'teacher' => '/teacher/dashboard.php',
        ];
        header('Location: ' . $dashboards[$role]);
        exit;

    } catch (Exception $e) {
        $error = 'Account creation failed. Please try again.';
    }
}
```

### Router Extension for Role Prefixes

```php
// Extended router.php — additions to existing file
// (add before the existing $allowed check)

// Role-prefixed routes: /student/*, /parent/*, /teacher/*
$roles = ['student', 'parent', 'teacher'];
foreach ($roles as $r) {
    if (preg_match("#^/{$r}/(.+)\.php$#", $uri, $m)) {
        $page_file = __DIR__ . "/{$r}/{$m[1]}.php";
        if (file_exists($page_file)) {
            // Auth middleware is included inside each role page
            include $page_file;
            return true;
        }
    }
}

// Onboard role routes: /onboard/student/*, /onboard/parent/*, /onboard/teacher/*
foreach ($roles as $r) {
    if (preg_match("#^/onboard/{$r}/(step[1-9])\.php$#", $uri, $m)) {
        $page_file = __DIR__ . "/onboard/{$r}/{$m[1]}.php";
        if (file_exists($page_file)) {
            include $page_file;
            return true;
        }
    }
}
```

### Core Database Schema

```sql
-- Run in Supabase SQL Editor during setup

-- 1. User roles table (read by custom_access_token_hook)
create table public.user_roles (
  user_id uuid primary key references auth.users(id) on delete cascade,
  role    text not null check (role in ('student', 'parent', 'teacher')),
  created_at timestamptz not null default now()
);
alter table public.user_roles enable row level security;
-- Only the user and admins can read their own role
create policy "user_sees_own_role" on public.user_roles
  for select to authenticated
  using (user_id = (select auth.uid()));

-- 2. User profiles (display name, preferences)
create table public.profiles (
  user_id        uuid primary key references auth.users(id) on delete cascade,
  display_name   text not null,
  preferred_name text,
  avatar_emoji   text,
  avatar_bg      text,
  learning_style text,
  dark_mode      boolean not null default false,
  dyslexic_font  boolean not null default false,
  created_at     timestamptz not null default now(),
  updated_at     timestamptz not null default now()
);
alter table public.profiles enable row level security;
create policy "users_own_profile" on public.profiles
  for all to authenticated
  using (user_id = (select auth.uid()));

-- 3. Classrooms (D-10: one teacher, one classroom for demo)
create table public.classrooms (
  id          uuid primary key default gen_random_uuid(),
  teacher_id  uuid not null references auth.users(id),
  name        text not null,
  created_at  timestamptz not null default now(),
  unique(teacher_id)  -- one classroom per teacher
);
alter table public.classrooms enable row level security;
create policy "teacher_owns_classroom" on public.classrooms
  for all to authenticated
  using (teacher_id = (select auth.uid()));

-- 4. Classroom students
create table public.classroom_students (
  classroom_id uuid not null references public.classrooms(id),
  student_id   uuid not null references auth.users(id),
  enrolled_at  timestamptz not null default now(),
  primary key (classroom_id, student_id)
);
alter table public.classroom_students enable row level security;
-- Teachers see their classroom roster
create policy "teacher_sees_roster" on public.classroom_students
  for all to authenticated
  using (
    classroom_id in (
      select id from public.classrooms
      where teacher_id = (select auth.uid())
    )
  );
-- Students see their own enrollment
create policy "student_sees_own_enrollment" on public.classroom_students
  for select to authenticated
  using (student_id = (select auth.uid()));

-- 5. Audit log table
create table public.audit_log (
  id            bigserial primary key,
  user_id       uuid references auth.users(id),
  action        text not null,       -- 'read', 'write', 'login', 'logout'
  resource_type text not null,       -- 'profile', 'lesson', 'progress'
  resource_id   text,
  ip_address    inet,
  user_agent    text,
  created_at    timestamptz not null default now()
);
alter table public.audit_log enable row level security;
-- Only admins/service role can read audit log
create policy "no_user_reads_audit_log" on public.audit_log
  for select to authenticated
  using (false);  -- block all user reads; service role bypasses RLS
```

### Per-Role Accent Color CSS Variables

```css
/* Add to app.css — per-role accent colors (D-13) */

/* Student: green (calm, growth) */
[data-role="student"] {
  --color-accent:       var(--color-green);
  --color-accent-light: var(--color-green-light);
  --color-accent-hover: var(--color-green-hover);
}

/* Parent: blue (trust, oversight) */
[data-role="parent"] {
  --color-accent:       var(--color-blue);
  --color-accent-light: var(--color-blue-light);
  --color-accent-hover: #3A5A8A;
}

/* Teacher: orange (energy, leadership) */
[data-role="teacher"] {
  --color-accent:       var(--color-orange);
  --color-accent-light: var(--color-orange-light);
  --color-accent-hover: #C0612C;
}
```

Apply by setting `data-role="student"` on `<body>` from PHP:

```php
<body data-role="<?= htmlspecialchars($CURRENT_ROLE ?? 'guest') ?>">
```

---

## Runtime State Inventory

> This is a greenfield phase (first phase, no existing auth state). No runtime state to inventory.

None — no authentication system exists yet. The current sessionStorage-based demo state in `app.js` is to be replaced, not migrated.

---

## State of the Art

| Old Approach | Current Approach | When Changed | Impact |
|--------------|------------------|--------------|--------|
| Supabase anon/service JWT keys as API keys | New publishable/secret API keys (sb_publishable_xxx format) | Nov 2025 | New Supabase projects may use new key format; supabase-php/supabase-client v1.2.0 needs testing with new format |
| supabase/supabase-php (official) | supabase-php/supabase-client (community) | 2023 (official stalled) | Research summary confirms community library is the active maintained one |
| Symmetric JWT verification (HS256 with shared secret) | Asymmetric JWT verification (ES256 via JWKS endpoint) | Late 2024 | For PHP JWT verification without network call, fetch public key from `/.well-known/jwks.json` |

**Deprecated/outdated:**

- `supabase/supabase-php`: Marked "not ready for production." Last real update April 2023. Do not use.
- Direct `sessionStorage` for user state: Current `app.js` uses `sessionStorage` for name/avatar/preferences. This must be replaced with Supabase-backed profile data. The `sessionStorage` pattern should survive only for ephemeral UI preferences (like current theme), but identity state moves to Supabase.
- PHP built-in server `router.php` for `/onboard/(step[1-5]).php`: The regex only handles five steps in the root onboard path. Must be updated to handle role-specific onboard paths.

---

## Open Questions

1. **supabase-php/supabase-client v1.2.0 auth method signatures**
   - What we know: Library advertises "Authentication and more," uses `vlucas/phpdotenv`
   - What's unclear: Exact method signatures for `auth->signInWithPassword()`, `auth->admin->createUser()`, and session object structure
   - Recommendation: During Wave 1 implementation, test auth methods against a Supabase project and document actual API surface. The community library is recent (Dec 2025) so may have incomplete docs; be ready to fall back to raw cURL against Supabase Auth REST API if specific methods are missing.

2. **New Supabase API key format compatibility**
   - What we know: Supabase began rolling out `sb_publishable_xxx` keys Nov 2025; legacy `anon`/`service_role` JWT keys still work during transition
   - What's unclear: Whether supabase-php/supabase-client v1.2.0 handles the new key format
   - Recommendation: Create the Supabase project first, check which key format it uses, and test initialization before building auth flows.

3. **Composer availability on deployment environment**
   - What we know: Composer not installed locally; PHP 8.5.4 is installed
   - What's unclear: Is the deployment/hosting environment (Vercel? Local PHP server?) able to run Composer?
   - Recommendation: Wave 0 of the plan must include `composer init` + `composer require` and confirm the `vendor/` directory is accessible from `public/`. The existing `vercel.json` file suggests Vercel deployment — check if Vercel PHP runtime supports Composer.

4. **Vercel PHP Runtime compatibility**
   - What we know: `vercel.json` exists; Supabase PHP library requires PHP 8.2+
   - What's unclear: Whether the Vercel PHP runtime (via community runtimes like `vercel-php`) supports the required PHP version and Composer
   - Recommendation: Test locally with `php -S localhost:8080 public/router.php` first; verify Vercel deployment separately in a Wave 0 smoke test.

---

## Environment Availability

| Dependency | Required By | Available | Version | Fallback |
|------------|------------|-----------|---------|----------|
| PHP | Auth middleware, all pages | Yes | 8.5.4 | — |
| Node.js | npm version checks, dev tooling | Yes | 24.13.0 | — |
| Composer | supabase-php/supabase-client install | No | — | Install via `brew install composer` or download phar; or use raw cURL to Supabase REST API |
| Supabase project | All auth + database operations | Unknown | — | Must be created; free tier sufficient for demo |

**Missing dependencies with no fallback:**
- Supabase project credentials (SUPABASE_URL, SUPABASE_ANON_KEY, SUPABASE_SERVICE_KEY) — must be created before any auth work begins

**Missing dependencies with fallback:**
- Composer — install locally (`brew install composer`) OR implement auth via raw PHP cURL to Supabase Auth REST endpoints (viable for this project's small surface area)

---

## Project Constraints (from CLAUDE.md)

No CLAUDE.md found at project root. No additional project-specific constraints to enforce beyond those in CONTEXT.md decisions above.

---

## Validation Architecture

> `workflow.nyquist_validation` not set in `.planning/config.json` — treating as enabled.

### Test Framework

| Property | Value |
|----------|-------|
| Framework | None detected — this is a PHP/vanilla JS project with no test runner configured |
| Config file | None — see Wave 0 gap |
| Quick run command | N/A until framework is installed |
| Full suite command | N/A until framework is installed |

**Recommendation for this phase:** Given the stack (plain PHP, no framework), the lowest-friction test approach is PHPUnit for server-side logic (auth middleware, invite code validation) and browser-based smoke tests via curl for route verification. However, given the demo timeline and "yolo" mode config, manual verification of acceptance criteria may be more practical than a full test suite.

### Phase Requirements → Test Map

| Req ID | Behavior | Test Type | Automated Command | File Exists? |
|--------|----------|-----------|-------------------|-------------|
| AUTH-01 | User can create account | smoke | `curl -X POST /onboard/student/signup.php` | No — Wave 0 |
| AUTH-02 | Role routing after login | smoke | `curl -c cookies.txt /login.php` then follow redirect | No — Wave 0 |
| AUTH-03 | Session persists on refresh | manual | Browser refresh after login | Manual |
| AUTH-04 | Parent-child linking via invite code | manual | Enter invite code in parent onboarding | Manual |
| AUTH-05 | Consent UI visible and submittable | manual | Step through parent onboarding | Manual |
| AUTH-06 | RLS prevents cross-user data access | SQL test | Supabase SQL Editor — query as wrong user | Manual SQL |
| AUTH-07 | Audit log captures events | SQL test | Check `audit_log` table after actions | Manual SQL |
| DSGN-01 | Cream backgrounds | visual | Browser screenshot comparison | Manual |
| DSGN-02 | Dark gray text | visual | Browser screenshot comparison | Manual |
| DSGN-03 | Color only for meaning | visual | Manual audit of all screens | Manual |
| DSGN-04 | Age-appropriate language | content | Manual copy review | Manual |
| DSGN-05 | No decorative fills/animations | visual | CSS audit + browser review | Manual |

### Sampling Rate

- **Per task commit:** Manual smoke test — load the affected page and confirm no PHP errors, redirect works
- **Per wave merge:** Step through each role's full onboarding + login + dashboard landing
- **Phase gate:** All 5 success criteria verified manually before calling phase complete

### Wave 0 Gaps

- [ ] `composer.json` — initialize with `composer init`, then `composer require supabase-php/supabase-client defuse/php-encryption`
- [ ] `.env` file — create with SUPABASE_URL, SUPABASE_ANON_KEY, SUPABASE_SERVICE_KEY (from new Supabase project)
- [ ] Supabase project — create at supabase.com, copy credentials
- [ ] `public/includes/supabase-client.php` — new file, Supabase client init
- [ ] `public/includes/auth-middleware.php` — new file, token verification

*(No automated test framework gap — given config `"mode": "yolo"` and `"granularity": "coarse"`, manual verification is the appropriate strategy for this demo project.)*

---

## Sources

### Primary (HIGH confidence)

- [Supabase Custom Access Token Hook](https://supabase.com/docs/guides/auth/auth-hooks/custom-access-token-hook) — PostgreSQL function pattern for role claims
- [Supabase Row Level Security](https://supabase.com/docs/guides/database/postgres/row-level-security) — `auth.uid()` SELECT wrapper, performance tips, policy patterns
- [Supabase JWT Signing Keys](https://supabase.com/docs/guides/auth/signing-keys) — new API key format status, asymmetric JWT verification
- [Supabase Server-Side Auth Advanced Guide](https://supabase.com/docs/guides/auth/server-side/advanced-guide) — cookie-based token storage for SSR apps
- [PGAudit Supabase Extension](https://supabase.com/docs/guides/database/extensions/pgaudit) — enabling audit logging, configuration options
- [Packagist: supabase-php/supabase-client](https://packagist.org/packages/supabase-php/supabase-client) — v1.2.0, Dec 2025 release confirmed

### Secondary (MEDIUM confidence)

- [Packagist: defuse/php-encryption](https://packagist.org/packages/defuse/php-encryption) — v2.4.0 confirmed current
- [Supabase RBAC Custom Claims Guide](https://supabase.com/docs/guides/database/postgres/custom-claims-and-role-based-access-control-rbac) — `app_metadata` role claim pattern
- npm registry — `@supabase/supabase-js` v2.101.1 verified via `npm view`
- Supabase GitHub Discussion #40300 — new key format transition timeline

### Tertiary (LOW confidence — needs validation during implementation)

- supabase-php/supabase-client auth method signatures — library docs sparse; must be tested against live project
- Vercel PHP runtime compatibility with Composer — needs hands-on verification

---

## Metadata

**Confidence breakdown:**

- Standard stack: MEDIUM — supabase-php/supabase-client v1.2.0 version confirmed; exact auth API surface not fully documented; Composer not yet installed
- Architecture: HIGH — RLS patterns and custom JWT hook are from official Supabase docs; PHP cookie-based session pattern is standard
- Pitfalls: HIGH — service role key exposure, JWT stale claims, open redirect are well-documented security anti-patterns; RLS missing on new tables is a known Supabase pitfall
- Design system: HIGH — existing app.css already implements the correct design tokens; changes are color value adjustments, not rebuilds

**Research date:** 2026-04-02
**Valid until:** 2026-05-02 (stable stack; Supabase API key migration is the only near-term risk)
