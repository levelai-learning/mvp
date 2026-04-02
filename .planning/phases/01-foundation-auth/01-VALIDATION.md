---
phase: 1
slug: foundation-auth
status: draft
nyquist_compliant: true
wave_0_complete: false
created: 2026-04-02
---

# Phase 1 — Validation Strategy

> Per-phase validation contract for feedback sampling during execution.

---

## Test Infrastructure

| Property | Value |
|----------|-------|
| **Framework** | None — PHP/vanilla JS project, no test runner configured |
| **Config file** | None — Wave 0 installs Composer + dependencies |
| **Quick run command** | `php -l public/includes/*.php` (syntax check) |
| **Full suite command** | Manual smoke test: step through each role's onboarding -> login -> dashboard |
| **Estimated runtime** | ~60 seconds (manual) |

---

## Sampling Rate

- **After every task commit:** `php -l` on modified PHP files + load affected page in browser
- **After every plan wave:** Step through each role's full onboarding + login + dashboard landing
- **Before `/gsd:verify-work`:** All 5 success criteria verified manually
- **Max feedback latency:** 60 seconds

---

## Per-Task Verification Map

| Task ID | Plan | Wave | Requirement | Test Type | Automated Command | File Exists | Status |
|---------|------|------|-------------|-----------|-------------------|-------------|--------|
| 01-01-T1 | 01 | 1 | AUTH-01 | syntax | `php -l public/includes/bootstrap.php && php -l public/includes/supabase-client.php && php -l public/includes/auth-middleware.php && php -l public/router.php && php -l public/includes/head.php && test -f composer.json && test -f .env.example` | Wave 0 | ⬜ pending |
| 01-01-T2 | 01 | 1 | AUTH-01 | syntax | `php -l public/index.php && php -l public/onboard/student/step1.php && php -l public/onboard/student/signup.php` | Wave 0 | ⬜ pending |
| 01-01-T3 | 01 | 1 | AUTH-02 | syntax | `php -l public/onboard/parent/step1.php && php -l public/onboard/parent/signup.php && php -l public/onboard/teacher/step1.php && php -l public/onboard/teacher/signup.php && php -l public/login.php && php -l public/logout.php && php -l public/student/home.php && php -l public/parent/dashboard.php && php -l public/teacher/dashboard.php` | Wave 0 | ⬜ pending |
| 01-01-T4 | 01 | 1 | AUTH-03 | manual | Browser refresh after login — checkpoint:human-verify | Manual | ⬜ pending |
| 01-02-T1 | 02 | 2 | AUTH-06, AUTH-07 | file+syntax | `test -f database/schema.sql && test -f database/rls-policies.sql && test -f database/auth-hook.sql && test -f database/audit-triggers.sql && grep -c "enable row level security" database/schema.sql && php -l public/includes/auth-middleware.php` | Wave 0 | ⬜ pending |
| 01-02-T2 | 02 | 2 | AUTH-04, AUTH-05 | syntax | `php -l public/onboard/parent/invite.php && php -l public/onboard/parent/consent.php && php -l public/onboard/parent/signup.php && php -l public/teacher/invite.php` | Wave 0 | ⬜ pending |
| 01-02-T3 | 02 | 2 | AUTH-04-07 | manual | Run SQL in Supabase, test parent-child linking — checkpoint:human-verify | Manual | ⬜ pending |
| 01-03-T1 | 03 | 2 | DSGN-01-03, DSGN-05 | grep | `grep "\-\-color-bg:.*#FFFEF5" public/assets/css/app.css && grep "\-\-color-text-primary:.*#333333" public/assets/css/app.css && grep 'data-role="student"' public/assets/css/app.css` | Exists | ⬜ pending |
| 01-03-T2 | 03 | 2 | DSGN-04 | grep+syntax | `grep "CURRENT_USER" public/includes/nav-app.php && grep "CURRENT_ROLE" public/includes/nav-app.php && grep "logout.php" public/includes/nav-app.php` | Exists | ⬜ pending |

*Status: ⬜ pending · ✅ green · ❌ red · ⚠️ flaky*

---

## Wave 0 Requirements

- [ ] `composer.json` — initialize with `composer init`, then `composer require supabase-php/supabase-client defuse/php-encryption`
- [ ] `.env` file — create with SUPABASE_URL, SUPABASE_ANON_KEY, SUPABASE_SERVICE_KEY
- [ ] Supabase project — create at supabase.com, copy credentials
- [ ] `public/includes/supabase-client.php` — new file, Supabase client init
- [ ] `public/includes/auth-middleware.php` — new file, token verification

---

## Manual-Only Verifications

| Behavior | Requirement | Why Manual | Test Instructions |
|----------|-------------|------------|-------------------|
| Session persists on refresh | AUTH-03 | Requires real browser session | Login, close tab, reopen, verify still authenticated |
| Parent-child linking | AUTH-04 | Multi-step flow across two user accounts | Create student, get invite code, create parent with code, verify link |
| Consent UI visible | AUTH-05 | Visual + interaction verification | Step through parent onboarding, verify consent step appears |
| RLS cross-user isolation | AUTH-06 | Requires authenticated DB queries as different users | In Supabase SQL Editor: `SET request.jwt.claims = '{"sub":"user_b"}'; SELECT * FROM student_data;` — should return 0 rows for user_b accessing user_a's data |
| Audit log entries | AUTH-07 | Requires checking DB after actions | Perform login + data read, then query `audit_log` table for entries |
| Visual design compliance | DSGN-01-05 | Visual/content review | Screenshot all screens, verify cream backgrounds, dark gray text, no decorative elements |

---

## Validation Sign-Off

- [x] All tasks have `<automated>` verify or Wave 0 dependencies
- [x] Sampling continuity: no 3 consecutive tasks without automated verify
- [x] Wave 0 covers all MISSING references
- [x] No watch-mode flags
- [x] Feedback latency < 60s
- [x] `nyquist_compliant: true` set in frontmatter

**Approval:** ready
