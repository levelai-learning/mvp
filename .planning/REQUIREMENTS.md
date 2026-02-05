# Requirements: Level.AI

**Defined:** 2026-02-04
**Core Value:** Students with ADHD/Dyslexia can actually complete their schoolwork because the interface never overwhelms them.

## v1 Requirements

Requirements for fundraising demo. Each maps to roadmap phases.

### Authentication & Compliance

- [ ] **AUTH-01**: User can create account with email and password
- [ ] **AUTH-02**: User is routed to appropriate dashboard based on role (student/parent/teacher)
- [ ] **AUTH-03**: Session persists across browser refresh
- [ ] **AUTH-04**: Parent account links to child's student account during signup
- [ ] **AUTH-05**: Consent workflow UI is visible and functional (architecture-ready for full COPPA)
- [ ] **AUTH-06**: Row Level Security enforces data access at database level
- [ ] **AUTH-07**: Audit logging captures data access events (FERPA-ready)

### Student Learning Experience

- [ ] **STUD-01**: Student sees single recommended task on dashboard ("What do I do now?")
- [ ] **STUD-02**: Lessons display one question/action per screen (sequential flow)
- [ ] **STUD-03**: Student can navigate forward/back through lesson steps
- [ ] **STUD-04**: Progress is saved and displayed (X of Y steps complete)
- [ ] **STUD-05**: Break button is always visible during lessons
- [ ] **STUD-06**: Break includes guided breathing activity (4-7-8 pattern)
- [ ] **STUD-07**: Break includes movement prompt option
- [ ] **STUD-08**: Break includes reflection prompt before returning
- [ ] **STUD-09**: Break cooldown prevents abuse (10-min minimum between breaks)
- [ ] **STUD-10**: Text-to-speech reads content aloud
- [ ] **STUD-11**: Word highlighting syncs with TTS playback
- [ ] **STUD-12**: Student can adjust text size
- [ ] **STUD-13**: Student can adjust line/letter spacing
- [ ] **STUD-14**: Student can change background/text colors

### Teacher Experience

- [ ] **TCHR-01**: Teacher can create a classroom
- [ ] **TCHR-02**: Teacher can add students to classroom
- [ ] **TCHR-03**: Teacher can remove students from classroom
- [ ] **TCHR-04**: Teacher can create/assign lessons to entire class
- [ ] **TCHR-05**: Teacher can assign lessons to individual students
- [ ] **TCHR-06**: Teacher can view classroom dashboard showing all students' progress
- [ ] **TCHR-07**: Teacher can view individual student's completion status
- [ ] **TCHR-08**: Teacher can remotely trigger a break for a specific student

### Parent Experience

- [ ] **PRNT-01**: Parent can view child's progress dashboard
- [ ] **PRNT-02**: Parent can see child's completion rates
- [ ] **PRNT-03**: Parent can see child's break frequency/patterns
- [ ] **PRNT-04**: Parent can send message to child's teacher
- [ ] **PRNT-05**: Parent can read messages from teacher
- [ ] **PRNT-06**: Parent can configure alert preferences (what to be notified about)

### Visual Design

- [ ] **DSGN-01**: Cream/off-white backgrounds (#FFFEF5) across all screens
- [ ] **DSGN-02**: Dark gray text (#333333), not pure black
- [ ] **DSGN-03**: Color used only for meaning (status, priority)
- [ ] **DSGN-04**: Age-appropriate language (encouraging, not childish)
- [ ] **DSGN-05**: No decorative fills, busy patterns, or flashing animations

### Content

- [ ] **CONT-01**: One subject with 3-5 complete lessons (founder-created)
- [ ] **CONT-02**: Each lesson demonstrates full step-by-step flow
- [ ] **CONT-03**: Content is TTS-compatible (proper sentence structure)

## v2 Requirements

Deferred to post-demo/fundraise. Tracked but not in current roadmap.

### Gamification

- **GAME-01**: Student can create and customize avatar
- **GAME-02**: Student earns tokens for completion and effort
- **GAME-03**: Student can view trophy case of personal achievements
- **GAME-04**: Missions have narrative framing

### Enhanced Analytics

- **ANLT-01**: Struggle detection via click patterns and time-on-task
- **ANLT-02**: Student-level trend analysis over time
- **ANLT-03**: Teacher alerts when student shows struggle patterns

### Educational Resources

- **RSRC-01**: Parent can access educational content about ADHD/Dyslexia
- **RSRC-02**: Personalized recommendations for home support

### Advanced Compliance

- **CMPL-01**: Full COPPA verification (knowledge-based or signed form)
- **CMPL-02**: SOC 2 Type I certification
- **CMPL-03**: Data retention automation (delete inactive after 1 year)

## Out of Scope

Explicitly excluded. Documented to prevent scope creep.

| Feature | Reason |
|---------|--------|
| LLM-powered coaching | MVP is rules-based; architecture anticipates future LLM integration |
| Eye-tracking detection | Requires hardware and significant ML investment |
| Mobile native apps | Web-responsive only; native requires separate compliance review |
| Multi-language support | English only for MVP |
| Third-party LMS integrations | Standalone for MVP; API design anticipates future connections |
| Competitive leaderboards | Research shows these discourage struggling learners |
| "Dyslexia fonts" (OpenDyslexic) | No proven benefit; may reduce reading speed |
| Real-time messaging | Async messaging sufficient for demo |
| Full curriculum integration | Demo uses 3-5 self-created lessons |

## Traceability

Which phases cover which requirements. Updated during roadmap creation.

| Requirement | Phase | Status |
|-------------|-------|--------|
| AUTH-01 | Phase 1 | Pending |
| AUTH-02 | Phase 1 | Pending |
| AUTH-03 | Phase 1 | Pending |
| AUTH-04 | Phase 1 | Pending |
| AUTH-05 | Phase 1 | Pending |
| AUTH-06 | Phase 1 | Pending |
| AUTH-07 | Phase 1 | Pending |
| STUD-01 | Phase 2 | Pending |
| STUD-02 | Phase 2 | Pending |
| STUD-03 | Phase 2 | Pending |
| STUD-04 | Phase 2 | Pending |
| STUD-05 | Phase 2 | Pending |
| STUD-06 | Phase 2 | Pending |
| STUD-07 | Phase 2 | Pending |
| STUD-08 | Phase 2 | Pending |
| STUD-09 | Phase 2 | Pending |
| STUD-10 | Phase 2 | Pending |
| STUD-11 | Phase 2 | Pending |
| STUD-12 | Phase 2 | Pending |
| STUD-13 | Phase 2 | Pending |
| STUD-14 | Phase 2 | Pending |
| TCHR-01 | Phase 3 | Pending |
| TCHR-02 | Phase 3 | Pending |
| TCHR-03 | Phase 3 | Pending |
| TCHR-04 | Phase 3 | Pending |
| TCHR-05 | Phase 3 | Pending |
| TCHR-06 | Phase 3 | Pending |
| TCHR-07 | Phase 3 | Pending |
| TCHR-08 | Phase 3 | Pending |
| PRNT-01 | Phase 4 | Pending |
| PRNT-02 | Phase 4 | Pending |
| PRNT-03 | Phase 4 | Pending |
| PRNT-04 | Phase 4 | Pending |
| PRNT-05 | Phase 4 | Pending |
| PRNT-06 | Phase 4 | Pending |
| DSGN-01 | Phase 1 | Pending |
| DSGN-02 | Phase 1 | Pending |
| DSGN-03 | Phase 1 | Pending |
| DSGN-04 | Phase 1 | Pending |
| DSGN-05 | Phase 1 | Pending |
| CONT-01 | Phase 5 | Pending |
| CONT-02 | Phase 5 | Pending |
| CONT-03 | Phase 5 | Pending |

**Coverage:**
- v1 requirements: 43 total
- Mapped to phases: 43
- Unmapped: 0

---
*Requirements defined: 2026-02-04*
*Last updated: 2026-02-04 after roadmap creation*
