# Roadmap: Level.AI

## Overview

This roadmap delivers a fundraising demo of Level.AI, an AI-assisted learning platform for middle school students with ADHD/Dyslexia. The journey builds from authentication infrastructure through the core student experience (the differentiator), then adds teacher and parent dashboards, and culminates with demo-ready content. Each phase delivers a verifiable capability; the student learning experience receives the most focus as it embodies the "one thing at a time" thesis that defines the product.

## Phases

**Phase Numbering:**
- Integer phases (1, 2, 3): Planned milestone work
- Decimal phases (2.1, 2.2): Urgent insertions (marked with INSERTED)

Decimal phases appear between their surrounding integers in numeric order.

- [ ] **Phase 1: Foundation & Auth** - Supabase integration, multi-role auth, RLS, compliance infrastructure, design system
- [ ] **Phase 2: Student Learning Experience** - Sequential lesson flow, breaks, TTS, accessibility settings
- [ ] **Phase 3: Teacher Dashboard** - Classroom management, assignments, progress monitoring
- [ ] **Phase 4: Parent Dashboard** - Progress visibility, messaging, alert preferences
- [ ] **Phase 5: Demo Content & Polish** - Real lessons, seeding, rehearsal preparation

## Phase Details

### Phase 1: Foundation & Auth
**Goal**: Users can securely create accounts, authenticate with appropriate role routing, and the system enforces data isolation at the database level with compliance-ready architecture
**Depends on**: Nothing (first phase)
**Requirements**: AUTH-01, AUTH-02, AUTH-03, AUTH-04, AUTH-05, AUTH-06, AUTH-07, DSGN-01, DSGN-02, DSGN-03, DSGN-04, DSGN-05
**Success Criteria** (what must be TRUE):
  1. User can create account with email/password and is routed to role-appropriate dashboard (student/parent/teacher)
  2. Parent can link to child's student account during signup with consent workflow visible
  3. Session persists across browser refresh without re-authentication
  4. RLS policies prevent any user from accessing data outside their authorized scope (verified via test queries)
  5. All screens use the calm visual design system (cream backgrounds, dark gray text, meaningful color only)
**Plans**: 3 plans

Plans:
- [ ] 01-01-PLAN.md — Supabase setup, auth middleware, signup/login flows, role routing, dashboard shells
- [ ] 01-02-PLAN.md — Database schema with RLS, parent-child linking via invite codes, COPPA consent, audit logging
- [ ] 01-03-PLAN.md — Design system polish: color tokens, role accent colors, copy audit, decorative element removal

### Phase 2: Student Learning Experience
**Goal**: Students with ADHD/Dyslexia can complete lessons because the interface presents one thing at a time, breaks are always available, and accessibility settings adapt to individual needs
**Depends on**: Phase 1
**Requirements**: STUD-01, STUD-02, STUD-03, STUD-04, STUD-05, STUD-06, STUD-07, STUD-08, STUD-09, STUD-10, STUD-11, STUD-12, STUD-13, STUD-14
**Success Criteria** (what must be TRUE):
  1. Student sees single recommended task on dashboard and can enter lesson showing one question/action per screen
  2. Student can navigate forward/back through lesson steps with progress saved and displayed
  3. Break button is always visible; taking a break provides guided breathing (4-7-8), movement option, and reflection before returning
  4. Break cooldown prevents taking another break within 10 minutes of returning
  5. Text-to-speech reads content aloud with synchronized word highlighting
  6. Student can adjust text size, line/letter spacing, and background/text colors
**Plans**: TBD

Plans:
- [ ] 02-01: TBD
- [ ] 02-02: TBD
- [ ] 02-03: TBD

### Phase 3: Teacher Dashboard
**Goal**: Teachers can manage classrooms, assign lessons, and monitor student progress to understand who needs help and who is succeeding
**Depends on**: Phase 2
**Requirements**: TCHR-01, TCHR-02, TCHR-03, TCHR-04, TCHR-05, TCHR-06, TCHR-07, TCHR-08
**Success Criteria** (what must be TRUE):
  1. Teacher can create a classroom and add/remove students
  2. Teacher can assign lessons to entire class or individual students
  3. Teacher can view classroom dashboard showing all students' progress at a glance
  4. Teacher can drill into individual student's completion status and break patterns
  5. Teacher can remotely trigger a break for a specific student who may be struggling
**Plans**: TBD

Plans:
- [ ] 03-01: TBD
- [ ] 03-02: TBD

### Phase 4: Parent Dashboard
**Goal**: Parents can monitor their child's learning progress, communicate with teachers, and configure how they receive updates
**Depends on**: Phase 1 (auth/linking), Phase 2 (student data to view)
**Requirements**: PRNT-01, PRNT-02, PRNT-03, PRNT-04, PRNT-05, PRNT-06
**Success Criteria** (what must be TRUE):
  1. Parent can view child's progress dashboard showing completion rates and recent activity
  2. Parent can see child's break frequency and patterns over time
  3. Parent can send and receive messages with child's teacher
  4. Parent can configure alert preferences for what notifications they want to receive
**Plans**: TBD

Plans:
- [ ] 04-01: TBD
- [ ] 04-02: TBD

### Phase 5: Demo Content & Polish
**Goal**: Demo has real, compelling content and is rehearsed to the point of reliability for investor presentations
**Depends on**: Phase 2, Phase 3, Phase 4
**Requirements**: CONT-01, CONT-02, CONT-03
**Success Criteria** (what must be TRUE):
  1. One subject exists with 3-5 complete lessons created by founder (not placeholder content)
  2. Each lesson demonstrates the full step-by-step flow with TTS-compatible content
  3. Demo data is seeded and stable (can reset to known state)
  4. Demo has been rehearsed 5+ times with video backup available
**Plans**: TBD

Plans:
- [ ] 05-01: TBD

## Progress

**Execution Order:**
Phases execute in numeric order: 1 -> 2 -> 3 -> 4 -> 5

| Phase | Plans Complete | Status | Completed |
|-------|----------------|--------|-----------|
| 1. Foundation & Auth | 0/3 | Planned | - |
| 2. Student Learning Experience | 0/3 | Not started | - |
| 3. Teacher Dashboard | 0/2 | Not started | - |
| 4. Parent Dashboard | 0/2 | Not started | - |
| 5. Demo Content & Polish | 0/1 | Not started | - |

---
*Roadmap created: 2026-02-04*
*Last updated: 2026-04-02*
