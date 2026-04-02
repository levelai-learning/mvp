---
phase: 1
slug: foundation-auth
status: draft
nyquist_compliant: false
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
| **Full suite command** | Manual smoke test: step through each role's onboarding → login → dashboard |
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
| 01-01 | 01 | 1 | AUTH-01 | smoke | `curl -X POST /onboard/student/signup.php` | ❌ W0 | ⬜ pending |
| 01-02 | 01 | 1 | AUTH-02 | smoke | `curl -c cookies.txt /login.php` then follow redirect | ❌ W0 | ⬜ pending |
| 01-03 | 01 | 1 | AUTH-03 | manual | Browser refresh after login | Manual | ⬜ pending |
| 01-04 | 02 | 2 | AUTH-04 | manual | Enter invite code in parent onboarding | Manual | ⬜ pending |
| 01-05 | 02 | 2 | AUTH-05 | manual | Step through parent onboarding consent | Manual | ⬜ pending |
| 01-06 | 02 | 2 | AUTH-06 | SQL test | Query as wrong user in Supabase SQL Editor | Manual SQL | ⬜ pending |
| 01-07 | 02 | 2 | AUTH-07 | SQL test | Check `audit_log` table after actions | Manual SQL | ⬜ pending |
| 01-08 | 03 | 3 | DSGN-01 | visual | Browser screenshot — cream backgrounds | Manual | ⬜ pending |
| 01-09 | 03 | 3 | DSGN-02 | visual | Browser screenshot — dark gray text | Manual | ⬜ pending |
| 01-10 | 03 | 3 | DSGN-03 | visual | CSS audit — color only for meaning | Manual | ⬜ pending |
| 01-11 | 03 | 3 | DSGN-04 | content | Manual copy review — age-appropriate language | Manual | ⬜ pending |
| 01-12 | 03 | 3 | DSGN-05 | visual | CSS audit — no decorative fills/animations | Manual | ⬜ pending |

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

- [ ] All tasks have `<automated>` verify or Wave 0 dependencies
- [ ] Sampling continuity: no 3 consecutive tasks without automated verify
- [ ] Wave 0 covers all MISSING references
- [ ] No watch-mode flags
- [ ] Feedback latency < 60s
- [ ] `nyquist_compliant: true` set in frontmatter

**Approval:** pending
