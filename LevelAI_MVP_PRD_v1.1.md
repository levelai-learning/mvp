# Level.AI MVP PRD

AI-Assisted Learning Environment for Students with ADHD and Dyslexia

Minimum Viable Product Specification

Version 1.1 | March 8, 2026

Revised from v1.0 to preserve full feature scope while resolving product, compliance, architecture, accessibility, and execution ambiguity.

## 1. Executive Summary

Level.AI is a web-based SaaS learning platform for middle school students ages 11-14 with ADHD, Dyslexia, or both. The product is intended to reduce cognitive overload, support executive function, and provide coordinated visibility for adults supporting the learner.

The MVP serves three user roles:

- Student
- Parent/Guardian
- Teacher

The MVP supports two operating contexts:

- Home-led use: a parent creates and manages the student experience directly.
- School-led use: a teacher or school manages classroom assignments and parent visibility.

The MVP keeps the full originally requested feature set in scope. To make that feasible, the product must be treated as a controlled pilot SaaS with strict launch gates, explicit compliance decision points, a normalized multi-relationship data model, and staged activation across internal alpha, pilot beta, and launch readiness.

The product is not a general EdTech platform. The core differentiation is a neurodivergent-first interaction model:

- One thing at a time
- Daily-first task orientation
- Breaks as supportive interventions
- Respectful, age-appropriate motivation
- Adult oversight without overwhelming the student

## 2. Product Positioning

### 2.1 Problem Statement

Students with ADHD and Dyslexia face significant barriers in traditional digital learning environments. Most platforms assume sustained attention, tolerate visual clutter, and reward speed or competition. Those patterns create friction for the target learner and reduce follow-through on schoolwork.

### 2.2 Primary Outcome

The product must increase schoolwork completion inside the platform while helping students regulate attention and giving adults actionable visibility.

### 2.3 Target Users

- Primary: Middle school students ages 11-14 with ADHD, Dyslexia, or both
- Secondary: Parents and guardians supporting learning at home
- Tertiary: Teachers managing instruction and intervention for neurodivergent learners

## 3. MVP Definition

The MVP includes all originally requested features. "Minimum viable" in this document means the smallest product that can validate value and be piloted safely, not the fewest features imaginable.

The MVP is considered complete only when the following are true:

- Student, parent, and teacher experiences are all functional
- Both home-led and school-led operating contexts are supported
- Compliance controls are in place for minors and educational data
- Accessibility and neurodivergent-first UX requirements are implemented
- Analytics and auditability are sufficient to evaluate product and compliance outcomes

Because feature cuts are not permitted, viability depends on sequencing, governance, and launch gating rather than scope reduction.

## 4. Goals and Success Metrics

### 4.1 Product Goals

| Goal | Success Metric |
| --- | --- |
| Students complete assigned schoolwork within the platform | 80% assignment completion by due date |
| Students know what to do immediately after opening the app | Average time-to-first-action under 5 seconds |
| Break system supports re-engagement instead of abandonment | 50% reduction in mid-lesson abandonment versus baseline pilot behavior |
| Parents understand how to help their child | 70% of parents report improved understanding in survey |
| Teachers can manage the system without high overhead | Under 30 minutes per week per class |

### 4.2 North Star Metric

Student Schoolwork Completion Rate: percentage of assigned work completed within the platform by due date.

### 4.3 Leading Indicators

- Time-to-first-action
- Mission start rate
- Mission completion rate
- Break initiation rate
- Break completion rate
- Return-to-lesson rate after break
- Parent dashboard visit frequency
- Teacher dashboard usage frequency

### 4.4 Event Definitions

To avoid ambiguity, the following metrics must be instrumented explicitly:

- `app_opened`
- `recommended_task_rendered`
- `first_action_taken`
- `mission_started`
- `mission_step_completed`
- `mission_completed`
- `break_requested`
- `break_started`
- `break_completed`
- `break_reflection_submitted`
- `lesson_abandoned`
- `parent_dashboard_viewed`
- `teacher_dashboard_viewed`
- `message_sent`
- `encouragement_sent`
- `remote_break_triggered`

## 5. Product Principles

### 5.1 One Thing at a Time

- Every student screen has one primary action.
- Secondary actions are hidden or deferred until the current step is completed.
- The student should understand the next action within 5 seconds.

### 5.2 Calm Visual Environment

- Cream or off-white backgrounds
- Dark gray body text instead of pure black
- Color used for meaning, not decoration
- Minimal simultaneous information density

### 5.3 Respectful Motivation

- Rewards acknowledge effort, consistency, and improvement
- Language must not feel childish for ages 12-14
- Pop-ups and celebration moments must be limited and meaningful

### 5.4 Breaks as Support

- Breaks are always available during lessons
- Breaks are structured, not passive escape hatches
- Return-to-work is gently guided

### 5.5 Adult Coordination Without Student Overload

- Parents and teachers get richer dashboards than students
- Student-facing surfaces remain sparse and focused
- Adults can monitor and support without introducing clutter into the student experience

## 6. Operating Contexts

### 6.1 Home-Led Context

Used when a parent or guardian directly creates the account, completes consent, and configures the student profile. The parent owns setup, alerting, and home-support recommendations.

### 6.2 School-Led Context

Used when a teacher or school-administered workflow creates classroom structures and assigns work. Parent access may still exist, but school workflows govern curriculum, classroom membership, and educational record handling.

### 6.3 Shared Product Requirement

The same product must support both contexts without creating separate codebases. Permissions, onboarding, and record access must vary by context, but the underlying platform, student mission flow, break experience, and reporting model must remain unified.

## 7. User Stories

### 7.1 Student Stories

#### Onboarding and Character

- As a student, I want to create and customize my avatar so that the platform feels personal and engaging.
- As a student, I want a guided tutorial that introduces features one at a time so that I do not feel overwhelmed.
- As a student, I want my progress to unlock new customization options so that I have motivation to continue.

#### Daily Learning

- As a student, I want to see only my next task when I open the app so that I know exactly what to do.
- As a student, I want lessons presented as missions so that completing schoolwork feels like an achievement.
- As a student, I want each screen to show only one question or action so that I can focus without distraction.
- As a student, I want encouraging messages that respect my age so that I feel motivated, not patronized.

#### Breaks and Self-Regulation

- As a student, I want to request a break at any time so that I can reset when I am struggling.
- As a student, I want guided breathing or movement during breaks so that I actually calm down.
- As a student, I want a short reflection after breaks so that I can identify what I need.

#### Progress and Rewards

- As a student, I want a trophy case showing my personal achievements so that I can see my growth.
- As a student, I want awards for effort and improvement, not just completion, so that trying hard is valued.
- As a student, I want to earn tokens for completing missions so that I can unlock new features.

### 7.2 Parent Stories

#### Onboarding and Setup

- As a parent, I want to complete a profile survey about my child so that the platform can personalize their experience.
- As a parent, I want to add extracurricular schedules so that my child's calendar reflects their full life.
- As a parent, I want to link my account to my child's teacher so that we can coordinate.

#### Monitoring and Support

- As a parent, I want to view my child's progress dashboard so that I understand how they are doing.
- As a parent, I want to receive alerts when my child takes frequent breaks so that I can check in.
- As a parent, I want educational resources about ADHD and Dyslexia so that I can better support my child at home.
- As a parent, I want to see specific recommendations for home support so that I know what actions to take.

#### Communication

- As a parent, I want to send questions to my child's teacher through the platform so that communication is centralized.
- As a parent, I want clear boundaries on what I can and cannot modify so that I respect the teacher's domain.

### 7.3 Teacher Stories

#### Curriculum Management

- As a teacher, I want to set the curriculum and class schedule so that students know what is expected.
- As a teacher, I want to assign missions to individual students or the whole class so that I can differentiate instruction.
- As a teacher, I want to adjust difficulty levels per student so that each learner is appropriately challenged.

#### Student Monitoring

- As a teacher, I want a classroom dashboard showing all students' progress so that I can identify who needs help.
- As a teacher, I want alerts when a student shows signs of struggle so that I can intervene early.
- As a teacher, I want to trigger a break for a specific student so that I can support them remotely.
- As a teacher, I want aggregated break and struggle data per student so that I can identify patterns.

#### Communication

- As a teacher, I want to respond to parent questions within the platform so that communication is documented.
- As a teacher, I want to send encouragement to students so that they feel supported.

## 8. Requirements

### 8.1 Product-Wide P0 Requirements

#### Identity, Access, and Relationships

- Role-based authentication for students, parents, and teachers
- Multi-context onboarding for home-led and school-led use
- Explicit relationship model linking:
  - parents to one or more students
  - teachers to one or more classrooms
  - students to one or more classrooms where applicable
- Invitation and linking workflows for adult-to-student and parent-to-teacher relationships
- Session management with device and session revocation capability

#### Compliance and Governance

- COPPA-compliant verifiable parental consent workflow
- FERPA-aligned educational record handling and access controls
- Audit logging for access to educational records and sensitive profile data
- PII minimization and documented retention/deletion workflows
- Privacy policy, terms of service, and guardian-facing consent language
- Restricted access until required consent state is satisfied

#### Student Experience

- Single-action dashboard with one recommended next task
- Daily view as default schedule orientation
- Weekly, monthly, and semester views accessible but secondary
- Step-by-step lesson flow with one question or action per screen
- Simulated lesson content sufficient to demonstrate full product interaction
- Always-visible break request button during missions
- Guided break activities:
  - breathing
  - movement prompt
  - short reflection
- Break cooldown logic with minimum interval and anti-abuse logic
- Mission framing, progress, and reward surfaces

#### Parent Experience

- Parent onboarding and child profile survey
- Extracurricular schedule input
- Progress dashboard with completion, break frequency, and struggle indicators
- Notification preferences for breaks, struggles, and milestones
- Parent resources and actionable home-support recommendations
- Parent-to-teacher messaging with clear permission boundaries

#### Teacher Experience

- Classroom creation and management
- Assignment and mission scheduling
- Per-student assignment targeting and difficulty adjustment
- Classroom dashboard with status, progress, and alerts
- Remote intervention triggers for break and encouragement
- Parent communication inside the platform

#### Gamification and Analytics

- Avatar customization
- Unlockable items tied to progress
- Token economy
- Trophy case for personal achievement
- Analytics required to evaluate mission flow, break flow, and dashboard engagement
- Heuristic struggle detection using product interaction data

### 8.2 Accessibility and Neurodivergent-First UX Requirements

These are MVP requirements, not polish.

- Readable typography with dyslexia-friendly fallback options
- User-adjustable text size and spacing controls
- Clear focus states and full keyboard navigation for all adult workflows
- Minimal motion by default with reduced-motion support
- Predictable heading structure and screen-reader labels
- Consistent placement of the primary action on student screens
- No decorative sound, flashing, countdown pressure, or visually noisy transitions
- Reading support patterns for longer text blocks, including chunking and progressive disclosure
- WCAG 2.2 AA target for all core workflows

### 8.3 Messaging and Notification Requirements

- Parent-teacher messaging is required for MVP
- Messaging must be role-aware and relationship-aware
- Messaging must be logged and retrievable for compliance purposes
- Notifications must be configurable by adult user and suppressible during protected school contexts where required

### 8.4 Struggle Detection Requirements

The MVP will not use eye tracking or camera inference. It will use heuristics based on interaction data:

- prolonged inactivity
- excessive navigation reversals
- repeated incorrect attempts
- repeated break requests
- unusually long step dwell time
- abandonment after a repeated friction pattern

The rules must be configurable, logged, and reviewable by product and support teams.

## 9. Non-Goals

The following remain out of scope for the MVP:

- Real third-party curriculum integration
- Eye-tracking attention monitoring
- Full LLM-powered coaching in production
- Native iOS and Android apps
- Multi-language support
- Third-party LMS integrations
- public competitive leaderboards

These items must be anticipated architecturally but not implemented in the MVP.

## 10. Compliance Requirements

### 10.1 COPPA

Required for users under 13.

- Verifiable parental consent before collection of personal information
- Parent ability to review, delete, and refuse further collection
- Minimal data collection
- No behavioral advertising
- Separate flows for:
  - direct home use
  - school-mediated use
- Consent state stored as a first-class system record with timestamp, method, actor, and revocation status

### 10.2 FERPA

Required for school use cases.

- Educational records available only to authorized parties
- Parent rights to inspect and request amendment where applicable
- Audit trail for record access
- School partnership documentation and DUA process
- Access model must distinguish between:
  - school-controlled student records
  - parent-controlled setup data
  - blended records visible in both contexts

### 10.3 Security and SOC 2 Readiness

- TLS 1.2 or higher
- Encryption at rest
- role-based authorization
- environment separation for dev, staging, and production
- vulnerability management process
- documented backup and disaster recovery process
- incident response playbook
- audit trail integrity

### 10.4 PII Handling

- Collect only necessary learner and guardian information
- Use internal IDs rather than exposing personal identifiers in URLs or logs
- Define data retention policy and automated inactive-account review
- Support deletion requests within a defined processing window
- Ensure exports and admin tools do not expose unnecessary data

## 11. Launch Blockers and Decision Gates

The following are required decisions before public pilot launch:

| Decision | Owner | Priority | Launch Impact |
| --- | --- | --- | --- |
| Home-led vs school-led consent path for under-13 students | Legal + Product | High | Blocks onboarding design |
| School consent and parent consent interaction model | Legal | High | Blocks compliance implementation |
| Final tone and copy framework for student encouragement | Product + Content | High | Blocks student UX completion |
| Approved break activity set validated by specialist | Product + Clinical | High | Blocks break content finalization |
| Simulated lesson content sourcing and IP clearance | Legal + Content | High | Blocks mission content population |
| Hosting and security model suitable for compliance posture | Engineering + Security | High | Blocks production deployment |
| Struggle-detection thresholds for pilot | Engineering + Data | Medium | Blocks alert tuning |

If these decisions are unresolved, the product may continue internal development but must not be released to external pilot users.

## 12. Technical Architecture

### 12.1 Recommended Application Architecture

The MVP should use a framework-backed PHP application rather than raw PHP scripts.

Recommended stack:

- Backend: PHP 8.3 with Laravel
- Frontend: server-rendered HTML with lightweight JavaScript for interactive flows
- Database: PostgreSQL
- Auth and storage: Supabase services or equivalent managed infrastructure, provided the authorization model remains application-controlled and auditable
- Hosting: managed environment with staging and production separation, secret management, logging, backups, and access controls

Rationale:

- Faster implementation of auth, policy enforcement, queues, notifications, and testing
- Cleaner support for relationship-heavy permissions
- Better auditability for sensitive data
- Lower delivery risk than bare PHP and unstructured vanilla JavaScript

### 12.2 Core System Components

- Authentication and identity service
- Onboarding and consent service
- Classroom and assignment service
- Student mission runtime
- Break and intervention service
- Messaging and notification service
- Analytics instrumentation service
- Audit and compliance logging service

### 12.3 Data Model

The original schema is expanded below to support the actual product requirements.

#### Core Identity

- `users`
  - id
  - email
  - role
  - account_status
  - created_at
  - last_login_at
- `user_profiles`
  - user_id
  - display_name
  - preferred_name
  - grade_level
  - learning_profile
  - settings_json

#### Tenancy and Relationships

- `organizations`
  - id
  - type (`home`, `school`)
  - name
  - status
- `classrooms`
  - id
  - organization_id
  - teacher_owner_id
  - name
  - grade_level
- `student_guardians`
  - id
  - student_user_id
  - guardian_user_id
  - relationship_type
  - permission_scope
- `classroom_enrollments`
  - id
  - classroom_id
  - student_user_id
  - status
- `teacher_guardian_links`
  - id
  - teacher_user_id
  - guardian_user_id
  - student_user_id
  - status

#### Consent and Compliance

- `consent_records`
  - id
  - student_user_id
  - guardian_user_id
  - consent_type
  - consent_method
  - granted_at
  - revoked_at
  - metadata_json
- `data_access_events`
  - id
  - actor_user_id
  - subject_user_id
  - resource_type
  - resource_id
  - action
  - timestamp
  - context_json
- `deletion_requests`
  - id
  - requester_user_id
  - subject_user_id
  - requested_at
  - status
  - completed_at

#### Curriculum and Missions

- `missions`
  - id
  - classroom_id nullable
  - created_by_user_id
  - title
  - description
  - due_date
  - difficulty
  - status
- `mission_steps`
  - id
  - mission_id
  - step_order
  - step_type
  - content_json
- `mission_assignments`
  - id
  - mission_id
  - assigned_to_student_id nullable
  - assigned_to_classroom_id nullable
  - assigned_by_user_id
  - start_at
  - due_at

#### Progress and Behavioral Support

- `student_progress`
  - id
  - student_user_id
  - mission_assignment_id
  - status
  - started_at
  - completed_at
  - last_step_id
- `progress_events`
  - id
  - student_user_id
  - mission_assignment_id
  - event_name
  - event_payload_json
  - created_at
- `breaks`
  - id
  - student_user_id
  - triggered_by_user_id nullable
  - trigger_source
  - break_type
  - reflection
  - started_at
  - completed_at
- `struggle_signals`
  - id
  - student_user_id
  - mission_assignment_id nullable
  - signal_type
  - severity
  - detected_at
  - metadata_json

#### Messaging and Notifications

- `conversations`
  - id
  - conversation_type
  - related_student_id nullable
- `conversation_participants`
  - id
  - conversation_id
  - user_id
- `messages`
  - id
  - conversation_id
  - from_user_id
  - content
  - created_at
  - read_at
- `notification_preferences`
  - id
  - user_id
  - preference_json
- `notifications`
  - id
  - user_id
  - notification_type
  - payload_json
  - delivered_at
  - read_at

#### Gamification

- `avatars`
  - id
  - student_user_id
  - appearance_json
- `student_tokens`
  - id
  - student_user_id
  - balance
- `token_ledger`
  - id
  - student_user_id
  - delta
  - reason
  - created_at
- `achievements`
  - id
  - student_user_id
  - achievement_type
  - awarded_at
  - metadata_json

### 12.4 Authorization Model

Authorization must not rely on role alone. It must enforce:

- relationship to the student
- organization context
- classroom membership
- consent state
- record type sensitivity

### 12.5 LLM Integration Pathway

The MVP remains rules-based for coaching. The application should preserve a swappable coaching boundary:

- `coaching_interface`
- `rules_coaching_service`
- future `llm_coaching_service`

All future generated content must pass child-safety filtering and logging requirements before display.

## 13. UX and Content Requirements

### 13.1 Student Tone

Language must be encouraging, age-appropriate, and non-patronizing.

Approved tone principles:

- clear
- calm
- respectful
- effort-positive
- not cartoonish

### 13.2 Sample Tone Targets

- "That's a solid effort. Let's build on it."
- "You can take this one step at a time."
- "A break can help. You are not stuck here."

### 13.3 Content Constraints

- No shame-based language
- No overly juvenile stickers or reward copy for older students
- No pressure language around speed
- No dark patterns around break denial

## 14. Delivery Plan

The original 8-week plan is only feasible with a dedicated multi-person team working in parallel across product/design, backend, frontend, and compliance/legal support. For planning purposes, the MVP should be treated as a 12-week build unless staffing clearly supports parallel execution.

### 14.1 Delivery Assumption

Minimum staffing assumption:

- 1 product lead
- 1 designer
- 1 backend engineer
- 1 frontend engineer
- 1 fractional legal/compliance partner
- 1 fractional QA/support resource during pilot prep

### 14.2 Proposed 12-Week Plan

#### Weeks 1-2: Foundations and Decision Closure

- finalize consent and operating-context rules
- finalize information architecture and role permissions
- establish design system and accessibility standards
- define analytics taxonomy and audit requirements
- stand up environments and base application architecture

#### Weeks 3-4: Identity, Relationships, and Compliance

- auth flows for all three roles
- consent records and restricted-access logic
- account linking and invitation flows
- organization, classroom, and relationship models
- audit logging foundation

#### Weeks 5-6: Student Mission Runtime

- single-action dashboard
- mission step flow
- daily-first task orientation
- simulated content support
- basic progress tracking

#### Weeks 7-8: Break, Reward, and Struggle Systems

- break request flow
- breathing, movement, and reflection activities
- cooldown and anti-abuse rules
- token economy, avatar, trophy case
- heuristic struggle detection and logging

#### Weeks 9-10: Parent and Teacher Surfaces

- parent dashboard, alerts, and resources
- teacher dashboard, assignment management, and interventions
- parent-teacher messaging
- notification preferences

#### Weeks 11-12: Hardening and Pilot Readiness

- accessibility QA
- security review
- FERPA and COPPA workflow verification
- analytics and reporting verification
- pilot user acceptance testing
- legal docs and support documentation

### 14.3 If 8 Weeks Is Non-Negotiable

An 8-week timeline requires parallel execution with at least two engineers, rapid legal turnaround, and no unresolved blocker decisions after week 2. If those assumptions are false, the timeline is not credible.

## 15. Launch Readiness Criteria

The MVP is ready for external pilot when:

- all three user roles can complete their core workflows
- both operating contexts are functional
- consent workflows are implemented and legally approved
- sensitive record access is logged
- accessibility acceptance criteria pass for core flows
- analytics events are verified in staging
- simulated lesson content is approved for use
- parent and teacher messaging is working and permission-safe
- production hosting, backups, and incident paths are documented

## 16. Open Questions

Open questions remain, but they are now explicitly categorized by release impact.

### 16.1 Blocking Questions

- What exact legal model governs under-13 school-led onboarding?
- What exact verifiable consent methods are approved for home-led onboarding?
- Which break activities are clinically acceptable for the target age range?
- What content set is legally safe for simulated missions?
- What hosting setup satisfies the required security posture?

### 16.2 Non-Blocking Questions

- Which heuristics perform best for struggle detection during the first pilot?
- Which reward pacing best supports 11-14 year olds without feeling juvenile?
- Which LLM provider should be evaluated for post-MVP coaching?

## 17. Summary of Revisions from v1.0

This revision keeps the full requested MVP feature set but makes the document build-ready by:

- clarifying that the product supports both home-led and school-led contexts
- adding explicit launch blockers for unresolved legal and product decisions
- converting accessibility into an MVP requirement
- expanding the data model to match the actual permission and relationship complexity
- replacing role-only authorization assumptions with relationship-aware authorization
- defining a concrete analytics event model
- reframing the delivery plan around realistic staffing and sequencing
- recommending a framework-backed PHP architecture rather than raw scripts
