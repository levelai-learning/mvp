# Research Summary

**Project:** Level.AI - ADHD/Dyslexia Learning Platform for Middle School
**Domain:** EdTech with COPPA/FERPA compliance requirements
**Researched:** 2026-02-04
**Confidence:** MEDIUM-HIGH

---

## Project Context

Level.AI is a learning platform for middle school students (ages 11-14) with ADHD and/or Dyslexia. The core thesis is "one thing at a time" — reducing cognitive overload through sequential, focused task presentation rather than overwhelming dashboards. The platform serves three stakeholder types: students, parents, and teachers.

The tech stack is founder-constrained: PHP 8.2+, Vanilla JavaScript, and Supabase (PostgreSQL, Auth, Storage). The 8-week timeline targets a fundraising demo, not production release.

---

## Key Findings by Dimension

### Stack

1. **Supabase is the right choice for multi-role auth.** Custom JWT claims via Auth Hooks elegantly handle student/parent/teacher roles. The pattern is well-documented and production-proven.

2. **Use supabase-php/supabase-client (v1.2.0), NOT the official supabase-php.** The official library is stale (April 2023) and explicitly not production-ready. The community library was updated December 2025.

3. **Row Level Security (RLS) is non-negotiable.** RLS enforces authorization at the database level — PHP bugs cannot create data leaks. Always wrap `auth.uid()` in SELECT for 94% performance improvement.

4. **defuse/php-encryption is the standard for FERPA-required PII encryption.** AES-256, audited, 16M+ installs. Encrypt student PII from day one.

5. **Skip Supabase Realtime for MVP.** The complexity-to-value ratio is poor for a demo. Simple polling or page refresh suffices.

### Features

1. **Text-to-speech with synchronized word highlighting is table stakes.** Learning Ally, Bookshare, and Microsoft Immersive Reader have set this expectation. Dyslexic users cannot effectively use a learning platform without it.

2. **The "one thing at a time" thesis is research-validated.** Studies confirm monotropic focus and sequential instruction improve outcomes for neurodivergent learners. This is a genuine differentiator, not just a design preference.

3. **Guided breaks with breathing exercises are proven effective for ADHD.** 2-3 weekly breathing sessions over 2-3 months improved regulatory control in children with ADHD. This is a low-complexity, high-differentiation feature.

4. **DO NOT use "dyslexia fonts" (OpenDyslexic).** Peer-reviewed research shows no benefit and users prefer standard fonts. Focus on customizable spacing and sizing instead.

5. **Anti-features are as important as features.** No gamification, no leaderboards, no flashing animations, no notification bombardment. These actively harm the target audience.

### Architecture

1. **Three-tier separation: PHP orchestrates, Supabase enforces, PostgreSQL stores.** PHP handles routing, business logic, and view rendering. Supabase handles auth and API. RLS handles authorization. This separation prevents authorization bugs.

2. **Multi-tenant isolation via school_id in app_metadata.** Every tenant-scoped table includes school_id. The RLS policy `school_id = auth.school_id()` ensures cross-tenant data is never visible.

3. **Compliance infrastructure must be built before any student data collection.** Consent workflow, audit logging, and data retention policies are prerequisites, not afterthoughts.

4. **Parent-student linking requires explicit consent tracking.** The consent_records table tracks consent type, scope, verification method, and revocation — all COPPA requirements.

5. **Build order matters: Foundation -> Users -> Compliance -> Learning Features -> Polish.** Each layer depends on the previous. Skipping ahead creates architectural debt.

### Pitfalls

1. **COPPA-1: Delegating consent to schools is an FTC violation.** The Edmodo enforcement action explicitly called this out. EdTech providers bear bottom-line COPPA responsibility regardless of ToS language.

2. **TECH-1: Bypassing RLS with service role key defeats security.** Use anon key + user JWT for all user-facing operations. Service role key only for admin/background operations.

3. **ADHD-1: Cognitive overload from interface complexity.** Dashboards showing multiple actions cause paralysis. Every screen must have ONE primary action. Progress stats belong on separate screens.

4. **SOLO-3: Teacher adoption is deprioritized at your peril.** 73% of EdTech MVP failures are due to teacher adoption problems. Schools buy based on teacher experience. Demo must show teacher workflow.

5. **DEMO-4: Demo breaks during presentation.** Pre-recorded video backup is essential. Demo data must be seeded and stable. Rehearse 5+ times.

---

## Cross-Cutting Themes

### Theme 1: Compliance is Architecture, Not Documentation

COPPA and FERPA compliance appears in every research dimension. The stack research covers encryption and audit logging. The architecture research details consent workflows and multi-tenant isolation. The pitfalls research warns against treating compliance as an afterthought.

**Implication:** Build compliance-ready architecture from Phase 1. Consent workflow in auth flow. Audit logging in database design. This is a competitive advantage, not overhead.

### Theme 2: Simplicity as Differentiation

The features research validates the "one thing at a time" thesis. The pitfalls research warns against cognitive overload. The architecture research emphasizes a "thin orchestration layer." The stack research recommends skipping Realtime complexity.

**Implication:** Resist the urge to add features. Every UI element must justify its cognitive cost. The calm, focused experience IS the product.

### Theme 3: Three-Stakeholder Complexity

Parents need consent workflows and visibility into child progress. Teachers need classroom management and assignment tools. Students need the calm learning experience. Each role has different RLS policies, different UI needs, different feature priorities.

**Implication:** Plan for three parallel tracks of work. Don't treat parent and teacher dashboards as afterthoughts — they're how the product gets bought.

### Theme 4: Demo-Mindset vs Production-Mindset

The 8-week timeline is for a fundraising demo. The pitfalls research emphasizes: build demo slices, not full features. Technical debt is acceptable. But compliance architecture must be real because investors will ask.

**Implication:** Happy path only. No edge cases until production. But consent flow UI and audit logging architecture must be demonstrable.

---

## Critical Decisions Required

### Decision 1: TTS Implementation Approach

**Options:**
- Web Speech API (free, inconsistent voices, browser-dependent)
- AWS Polly / Google TTS (paid, consistent, requires backend integration)

**Recommendation:** Start with Web Speech API for demo. Plan AWS Polly integration for production. The key is synchronized word highlighting, which is challenging regardless of TTS source.

### Decision 2: Parent Consent Verification Method

**Options:**
- Email verification only (simplest)
- Knowledge-based authentication (COPPA-approved)
- Signed form upload (strongest, most friction)

**Recommendation:** Email verification for demo. Document architecture supporting stronger methods for production. Investors will ask about this.

### Decision 3: Break Activity Content

**Options:**
- Build custom breathing animations
- License/embed existing content (Headspace, Smiling Mind)
- Simple timer with text instructions

**Recommendation:** Custom breathing animation (4-7-8 pattern) for demo — single visual with pacing guide. Movement breaks can be text-only instructions. Video content deferred to production.

### Decision 4: How Much Teacher Dashboard for Demo

**Options:**
- Full classroom management (weeks of work)
- View-only progress dashboard (days of work)
- Stub interface with mock data (hours of work)

**Recommendation:** Functional but minimal: create classroom, add students, assign content, view completion status. This shows the full loop (teacher assigns -> student completes -> teacher sees) without building full admin features.

---

## Conflicts & Tensions

### Tension 1: Compliance Completeness vs Demo Timeline

Full COPPA/FERPA compliance requires significant infrastructure. An 8-week demo timeline is aggressive.

**Resolution:** Build the architecture that WOULD support compliance. Consent flow UI visible. Audit tables exist. Encryption functions ready. Full implementation can follow — but the architectural decisions are made now.

### Tension 2: Three-Stakeholder Scope vs Solo Developer

Parent, teacher, and student UIs are effectively three products. A solo developer cannot build all three fully.

**Resolution:** Student experience is 60% of effort (it's the differentiation). Teacher dashboard is 25% (it's how schools buy). Parent dashboard is 15% (consent flow + basic visibility). Prioritize accordingly.

### Tension 3: "One Thing at a Time" vs Information Density

Parents and teachers need overview information. Students need focus. These are opposing UX patterns.

**Resolution:** The "one thing at a time" principle applies to student experience only. Parent/teacher dashboards can show aggregated information — they're different cognitive contexts.

---

## Roadmap Implications

Based on research, the suggested phase structure follows dependencies: Foundation -> User Management -> Compliance Infrastructure -> Learning Features -> Teacher/Parent Dashboards -> Demo Polish.

### Suggested Phase 1: Foundation & Auth
**Rationale:** Everything depends on authentication and database structure. RLS policies must be designed before any data is stored.
**Delivers:** Supabase project, core schema, PHP-Supabase integration, basic auth flows, security infrastructure (XSS/CSRF/headers).
**Addresses:** TECH-1 (RLS), TECH-2 (auth.uid()), TECH-3 (PHP version), TECH-5 (security).
**Research flag:** Standard patterns, well-documented.

### Suggested Phase 2: Multi-Role User System
**Rationale:** Users before content. Consent before student data. Teacher and parent infrastructure needed before student features.
**Delivers:** Profile management, role-based routing, parent-student linking, classroom creation.
**Addresses:** Three-stakeholder system foundation.
**Research flag:** Parent-student consent linking needs care — consult COPPA implementation guides.

### Suggested Phase 3: Compliance Infrastructure
**Rationale:** MUST be in place before collecting any student education records. This is non-negotiable.
**Delivers:** Consent workflow (UI + database), audit logging (supa_audit + access logs), data retention schema.
**Addresses:** COPPA-1, COPPA-3, FERPA-2.
**Research flag:** Consent verification methods may need deeper research during implementation.

### Suggested Phase 4: Student Learning Experience
**Rationale:** The core product differentiation. Depends on users and compliance infrastructure.
**Delivers:** Sequential lesson display, adjustable text settings, break timer with guided breathing, progress tracking, distraction-free mode.
**Addresses:** ADHD-1, ADHD-2, ADHD-3, DYS-1, DYS-2, DYS-3.
**Research flag:** TTS synchronization is non-trivial — may need implementation research.

### Suggested Phase 5: Teacher Dashboard
**Rationale:** Schools buy based on teacher experience. Demo must show full loop.
**Delivers:** Classroom overview, assignment creation, student progress view.
**Addresses:** SOLO-3 (teacher adoption).
**Research flag:** Standard CRUD patterns.

### Suggested Phase 6: Parent Dashboard
**Rationale:** Consent flow already built; this adds visibility.
**Delivers:** Child progress view, activity summaries.
**Research flag:** Standard patterns — piggybacks on Phase 3 consent work.

### Suggested Phase 7: Demo Polish & Preparation
**Rationale:** Demo reliability is critical for fundraising.
**Delivers:** Demo data seeding, rehearsal, video backup, investor materials.
**Addresses:** DEMO-1 through DEMO-5.
**Research flag:** No technical research needed — execution focus.

### Phase Ordering Rationale

1. **Auth before data:** RLS policies require user context. Building features first leads to retrofitting auth.
2. **Compliance before student data:** COPPA requires consent before data collection. Architectural debt here is expensive.
3. **Student experience before dashboards:** The differentiation is in student UX. Dashboards are visibility into existing features.
4. **Teacher before parent:** Teacher adoption drives sales. Parents need less functionality for demo.

### Research Flags Summary

**Needs deeper research during planning:**
- Phase 3 (Compliance): COPPA consent verification methods for 2025 rule
- Phase 4 (Student UX): TTS word-level synchronization implementation

**Standard patterns (skip research):**
- Phase 1 (Foundation): Well-documented Supabase patterns
- Phase 5-6 (Dashboards): Standard CRUD, no novel challenges
- Phase 7 (Demo): Execution, not research

---

## Confidence Assessment

| Area | Confidence | Notes |
|------|------------|-------|
| Stack | MEDIUM-HIGH | Supabase patterns well-documented; PHP library is community-maintained |
| Features | HIGH | Multiple competitor analyses, academic research on ADHD/dyslexia UX |
| Architecture | HIGH | Directly from Supabase official documentation |
| Pitfalls | HIGH | Multiple verified sources per pitfall, including FTC enforcement actions |

**Overall confidence:** MEDIUM-HIGH

### Gaps to Address

1. **TTS synchronization implementation:** Web Speech API doesn't provide word timing. May need to pre-process content with timing markers or explore alternatives. Research during Phase 4 planning.

2. **2025 COPPA rule specifics:** New biometric and geolocation provisions. Level.AI unlikely to use these, but should document non-use explicitly.

3. **PHP Supabase client limitations:** Community library is recent (Dec 2025). May encounter edge cases. Plan for thin abstraction layer to enable future migration.

4. **Real user validation:** No actual ADHD/dyslexia students or teachers consulted yet. Budget time for user testing before demo.

---

## Quick Reference

**Stack:** PHP 8.2 + Supabase (Auth, PostgreSQL, Storage) + supabase-php/supabase-client + defuse/php-encryption + Monolog

**Table Stakes:** TTS with highlighting, adjustable text, break timer, progress tracking, clean UI, sequential flow

**Differentiators:** "One thing at a time" design, guided breathing breaks, calm visual environment, three-stakeholder system

**Watch Out For:**
- COPPA consent responsibility cannot be delegated to schools (FTC violation)
- RLS must be enforced, not bypassed with service key
- One primary action per screen (cognitive overload kills ADHD users)
- Teacher dashboard is required for demo (schools buy on teacher experience)
- Demo breaks = credibility destroyed (rehearse, backup video)

---

## Sources

### Primary (HIGH confidence)
- [Supabase Custom Claims & RBAC](https://supabase.com/docs/guides/database/postgres/custom-claims-and-role-based-access-control-rbac)
- [Supabase Row Level Security](https://supabase.com/docs/guides/database/postgres/row-level-security)
- [FTC Edmodo Enforcement Action](https://perkinscoie.com/insights/update/ftcs-coppa-enforcement-action-provides-lessons-edtech-providers)
- [COPPA 2025 Amendments](https://www.dwt.com/blogs/privacy--security-law-blog/2025/05/coppa-rule-ftc-amended-childrens-privacy)
- [K-12 ADHD Accessibility Research](https://pressbooks.pub/alttexts2025/chapter/accessibility-barriers-in-k-12-digital-learning-platforms-for-students-with-adhd/)

### Secondary (MEDIUM confidence)
- [supabase-php/supabase-client on Packagist](https://packagist.org/packages/supabase-php/supabase-client)
- [Supabase Multi-Tenancy Guide](https://roughlywritten.substack.com/p/supabase-multi-tenancy-simple-and)
- [OpenDyslexic Effectiveness Study](https://pmc.ncbi.nlm.nih.gov/articles/PMC5629233/)
- [Pomodoro ADHD Research](https://pubmed.ncbi.nlm.nih.gov/36859717/)

### Tertiary (requires validation)
- EdTech failure statistics (cited but primary sources not verified)
- Exact PHP library feature coverage (test during implementation)

---

*Research completed: 2026-02-04*
*Ready for roadmap: yes*
