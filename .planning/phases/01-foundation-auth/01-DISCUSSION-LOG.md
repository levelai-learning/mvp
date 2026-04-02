# Phase 1: Foundation & Auth - Discussion Log

> **Audit trail only.** Do not use as input to planning, research, or execution agents.
> Decisions are captured in CONTEXT.md — this log preserves the alternatives considered.

**Date:** 2026-04-02
**Phase:** 01-foundation-auth
**Areas discussed:** Signup/Login flow, Role routing, Data architecture, Visual system

---

## Signup/Login Flow

### Account Creation Order

| Option | Description | Selected |
|--------|-------------|----------|
| Auth first, then onboard | User creates account, then onboarding steps | |
| Onboard first, then auth | Keep current flow — preferences first, account at end | ✓ |
| Combined flow | Merge auth into onboarding steps | |

**User's choice:** Onboard first, then auth
**Notes:** Reduces upfront friction. Existing 5-step onboarding preserved.

### Role Selection Timing

| Option | Description | Selected |
|--------|-------------|----------|
| During onboarding | Add role selection as onboarding step | |
| At account creation | Role chosen with email/password | |
| Separate paths | Different entry points per role on landing page | ✓ |

**User's choice:** Separate paths
**Notes:** Landing page shows role buttons, each leading to tailored flow.

### Parent-Child Linking

| Option | Description | Selected |
|--------|-------------|----------|
| Invite code | Teacher/admin creates student, parent enters code to link | ✓ |
| Parent creates child | Parent signs up first, creates child account | |
| Email matching | Parent enters child's email/ID to link | |
| You decide | Claude picks simplest for demo | |

**User's choice:** Invite code

### COPPA Consent Placement

| Option | Description | Selected |
|--------|-------------|----------|
| Parent flow only | Parent sees consent when linking to child | ✓ |
| Both flows | Parent consents, student sees confirmation | |
| You decide | Claude picks for demo | |

**User's choice:** Parent flow only

---

## Role Routing

### URL Structure

| Option | Description | Selected |
|--------|-------------|----------|
| Role prefixes | /student/home, /teacher/dashboard, /parent/dashboard | ✓ |
| Shared URLs | Same URLs, PHP renders per role | |
| You decide | Claude picks cleanest approach | |

**User's choice:** Role prefixes

### Post-Login Behavior

| Option | Description | Selected |
|--------|-------------|----------|
| Role dashboard | Straight to dashboard | ✓ |
| Welcome back | Brief transition screen then dashboard | |
| Resume last page | Return to last visited page | |

**User's choice:** Role dashboard

### Auth Guard Behavior

| Option | Description | Selected |
|--------|-------------|----------|
| Redirect to login | Redirect to /login, return after auth | ✓ |
| Landing page | Always redirect to landing page | |
| You decide | Standard approach | |

**User's choice:** Redirect to login with return-to logic

---

## Data Architecture

### Audit Logging Detail

| Option | Description | Selected |
|--------|-------------|----------|
| Login events only | Sign-in, sign-out, failed attempts | |
| Data access events | Log student data views | |
| Full audit trail | All reads/writes with user, timestamp, resource | ✓ |
| You decide | Claude picks for demo | |

**User's choice:** Full audit trail

### RLS Strictness

| Option | Description | Selected |
|--------|-------------|----------|
| Full isolation | Individual-level data isolation per user | ✓ |
| Role-based | Policies based on role only | |
| You decide | Claude picks | |

**User's choice:** Full isolation

### Teacher-Classroom Model

| Option | Description | Selected |
|--------|-------------|----------|
| One teacher, one class | Simplest for demo | ✓ |
| One teacher, many classes | More realistic, more UI | |
| You decide | Claude picks | |

**User's choice:** One teacher, one class

---

## Visual System

### CSS Architecture

| Option | Description | Selected |
|--------|-------------|----------|
| Single file, organized | One app.css with clear sections | |
| Split by concern | Separate files per concern | |
| You decide | Claude picks based on existing patterns | ✓ |

**User's choice:** Claude's discretion

### Theme Support

| Option | Description | Selected |
|--------|-------------|----------|
| Keep both | Light and dark themes | ✓ |
| Light only for now | Defer dark mode | |
| You decide | Claude decides | |

**User's choice:** Keep both

### Open Dyslexic Toggle

| Option | Description | Selected |
|--------|-------------|----------|
| Keep it | Preserve font toggle | ✓ |
| Remove it | Align with research exclusion | |
| Replace with choices | Offer 2-3 font options | |

**User's choice:** Keep it

### Role Visual Treatment

| Option | Description | Selected |
|--------|-------------|----------|
| Subtle accent color | Different accent per role | ✓ |
| Identical design | Same visual treatment | |
| You decide | Claude picks | |

**User's choice:** Subtle accent color per role

---

## Claude's Discretion

- CSS architecture (single file organized vs split by concern)

## Deferred Ideas

None — discussion stayed within phase scope.
