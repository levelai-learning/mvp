# Phase 1: Foundation & Auth - Context

**Gathered:** 2026-04-02
**Status:** Ready for planning

<domain>
## Phase Boundary

Secure account creation with role-based routing (Student, Parent, Teacher), database-level data isolation via Supabase RLS, COPPA/FERPA-ready architecture (audit logging, consent workflow), and the foundational visual design system. Everything later phases build on.

Requirements: AUTH-01 through AUTH-07, DSGN-01 through DSGN-05.

</domain>

<decisions>
## Implementation Decisions

### Signup/Login Flow
- **D-01:** Onboard first, then auth. Users go through the existing preference/avatar steps, then create their account (email/password) at the end. Reduces upfront friction.
- **D-02:** Separate entry paths per role. Landing page shows "I'm a student" / "I'm a parent" / "I'm a teacher" buttons, each leading to a tailored onboarding and signup flow.
- **D-03:** Parent-child linking via invite code. Teacher or admin creates student account, gives parent a code. Parent enters code during their signup to link accounts.
- **D-04:** COPPA consent appears in parent flow only. Parent sees consent step when linking to child's account. Student never sees consent UI — parent consented on their behalf.

### Role Routing
- **D-05:** URL structure uses role prefixes: /student/home, /teacher/dashboard, /parent/dashboard. Clear separation, easy to protect with PHP middleware.
- **D-06:** After login, users go straight to their role dashboard. No intermediate welcome screen. Student sees single task, teacher sees classroom, parent sees child progress.
- **D-07:** Unauthenticated users hitting protected pages get redirected to /login. After successful login, redirect back to the originally requested page.

### Data Architecture
- **D-08:** Full audit trail logging. All data reads/writes logged with user, timestamp, and resource. Most impressive for investor demo demonstrating FERPA-readiness.
- **D-09:** Full RLS isolation. Students see only their own data, parents see only linked children, teachers see only their classroom students. No exceptions.
- **D-10:** One teacher, one classroom model. Each teacher has exactly one classroom for the demo. No classroom switching needed — simplest approach.

### Visual System
- **D-11:** Keep both light and dark themes. Already partially built — polish both for Phase 1.
- **D-12:** Keep the Open Dyslexic font toggle. Shows user choice and accessibility awareness even if research is mixed.
- **D-13:** Subtle accent color per role. Same base design (cream backgrounds, dark gray text) but student/parent/teacher each get a different accent color for nav/buttons. Helps distinguish roles during demos.

### Claude's Discretion
- CSS architecture: Claude decides whether to keep single app.css (organized with sections) or split into multiple files based on what works best with the existing PHP includes pattern.

</decisions>

<canonical_refs>
## Canonical References

**Downstream agents MUST read these before planning or implementing.**

No external specs — requirements fully captured in decisions above and in:
- `.planning/PROJECT.md` — Core value, design principles, tech decisions, constraints
- `.planning/REQUIREMENTS.md` — AUTH-01 through AUTH-07, DSGN-01 through DSGN-05 acceptance criteria
- `.planning/research/SUMMARY.md` — Stack and architecture research findings

</canonical_refs>

<code_context>
## Existing Code Insights

### Reusable Assets
- `index.html` — Landing page with hero, nav, theme toggle. Can be adapted for role selection entry points.
- `onboard/step1-5.html` — 5-step onboarding flow (preferences, avatar). Reusable as post-role-selection onboarding.
- `assets/css/app.css` — Existing styles with cream backgrounds, dark gray text, theme toggle, component patterns.
- `assets/js/app.js` — Session state helper using sessionStorage. Will need to be replaced/augmented with Supabase auth.
- `public/includes/` — PHP includes (bootstrap.php, head.php, nav-app.php, nav-onboard.php, footer.php). Foundation for role-based PHP routing.

### Established Patterns
- Static HTML with PHP includes for templating (public/ directory)
- sessionStorage for client-side state (will be replaced by Supabase auth)
- Single CSS file with component-scoped styles
- Theme toggle (light/dark) via CSS custom properties

### Integration Points
- Supabase JS client needs to be added (no current integration)
- PHP backend needs Supabase REST API calls for server-side auth checks
- Existing nav components need role-aware rendering
- router.php exists but needs to be extended for role-prefixed URLs

</code_context>

<specifics>
## Specific Ideas

No specific external references mentioned — open to standard approaches within the decisions captured above.

</specifics>

<deferred>
## Deferred Ideas

None — discussion stayed within phase scope.

</deferred>

---

*Phase: 01-foundation-auth*
*Context gathered: 2026-04-02*
