# Level.AI

## What This Is

Level.AI is an AI-assisted learning platform for middle school students (ages 11-14) with ADHD and Dyslexia. The platform's "one thing at a time" design reduces cognitive overload, while an always-available break system with guided activities supports self-regulation. Three user types — Students, Parents, Teachers — form a connected ecosystem sold to schools and districts.

## Core Value

Students with ADHD/Dyslexia can actually complete their schoolwork because the interface never overwhelms them — one action per screen, breaks when needed, calm visual environment.

## Requirements

### Validated

(None yet — ship to validate)

### Active

**Student Experience**
- [ ] Single-action dashboard showing ONE recommended task
- [ ] Daily-first calendar view (weekly/monthly accessible)
- [ ] Step-by-step lesson flow (one question/action per screen)
- [ ] Always-visible "I need a break" button during lessons
- [ ] Guided break activities (breathing, movement, reflection)
- [ ] Break cooldown to prevent abuse (10-min minimum between breaks)
- [ ] Reflection prompt before returning from break
- [ ] Progress tracking and mission completion

**Teacher Experience**
- [ ] Classroom dashboard showing all students' status/progress
- [ ] Assignment management (create, assign, schedule missions)
- [ ] Ability to assign to individual students or whole class
- [ ] Remotely trigger break for specific student
- [ ] Send encouragement to students
- [ ] View student break/struggle patterns

**Parent Experience**
- [ ] Progress dashboard (completion rates, break frequency)
- [ ] Notification preferences configuration
- [ ] View of child's schedule and assignments

**Visual Design (Research-Validated)**
- [ ] Cream/off-white backgrounds (#FFFEF5)
- [ ] Dark gray text (#333333), not pure black
- [ ] Color used ONLY for meaning (priority, status)
- [ ] Age-appropriate tone (encouraging, not childish)

**Authentication & Compliance-Ready Architecture**
- [ ] Supabase Auth with role-based access (Student, Parent, Teacher)
- [ ] Row Level Security (RLS) policies
- [ ] Account hierarchy (parent → student, teacher → classroom → students)
- [ ] COPPA consent workflow (architecture ready)
- [ ] Audit logging structure (FERPA ready)
- [ ] PII encryption at rest and in transit

**Content**
- [ ] One subject, 3-5 real lessons demonstrating full flow
- [ ] Lessons created by founder (not licensed/mocked)

### Out of Scope

- Full curriculum integration — demo uses 3-5 self-created lessons
- Competitive leaderboards — research shows these discourage struggling learners
- Eye-tracking detection — requires hardware and ML investment
- LLM-powered coaching — MVP is rules-based; architecture anticipates future LLM
- Mobile native apps — web-responsive only for MVP
- Multi-language support — English only
- Third-party LMS integrations — standalone for MVP
- Real-time messaging — show UI, doesn't need to be real-time for demo
- Full compliance certification — architecture supports it, certification is post-demo
- Gamification (avatar, tokens, trophy case) — P1 if time permits, not core demo

## Context

**Problem:** Most EdTech platforms are designed for neurotypical learners — overwhelming interfaces, long-form content, competitive elements, rigid scheduling. Students with ADHD/Dyslexia (15-20% of students) disengage and fall behind.

**Solution thesis:** "One thing at a time" design + always-available breaks + calm visual environment = neurodivergent students can actually complete work.

**Demo purpose:** Prove to investors/partners that (1) the student experience works and is differentiated, (2) schools would actually buy this.

**Design principles from ADHD/Dyslexia specialists:**
1. One thing at a time — each screen presents ONE decision/action
2. Calm visual environment — cream backgrounds, no decorative color
3. Respectful rewards — effort and progress, not just completion
4. Supportive language — professional but encouraging
5. Breaks as support, not escape — structured activities, gentle reflection

**Tech decisions:**
- PHP 8.x (no frameworks) — founder's known stack
- Vanilla JavaScript — no framework overhead
- Supabase — database, auth, storage, RLS for security

**Target users:**
- Primary: Middle school students (11-14) with ADHD, Dyslexia, or both
- Buyer: Schools and districts (B2B)
- Secondary: Parents (monitoring), Teachers (classroom management)

## Constraints

- **Developer capacity**: Solo developer — scope must be achievable by one person
- **Timeline**: ~8 weeks target (flexible, not hard deadline)
- **Tech stack**: PHP 8.x + vanilla JS + Supabase — no frameworks
- **Content**: Self-created lessons — no external licensing dependencies
- **Launch type**: Demo for fundraising — not production launch with real students
- **Compliance**: Architecture must support COPPA/FERPA, but certification is post-demo

## Key Decisions

| Decision | Rationale | Outcome |
|----------|-----------|---------|
| Demo, not production MVP | Solo dev + 8 weeks = must be strategic about scope | — Pending |
| Student UX is the star | Core differentiation; parent/teacher can be simpler | — Pending |
| Real content, one subject | Proves concept without overwhelming content creation | — Pending |
| No frameworks (PHP, JS) | Founder's expertise, reduce learning curve | — Pending |
| Compliance-ready, not certified | Architecture supports it; certification post-fundraise | — Pending |
| Gamification as P1 | Nice for engagement but not core to thesis | — Pending |

---
*Last updated: 2026-02-04 after initialization*
