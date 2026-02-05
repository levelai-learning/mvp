# Pitfalls Research: Level.AI

**Project:** Learning platform for middle school students (11-14) with ADHD/Dyslexia
**Researched:** 2026-02-04
**Overall Confidence:** HIGH (multiple verified sources per pitfall)

---

## Compliance Pitfalls

### COPPA-1: Delegating Consent Responsibility to Schools

**What goes wrong:** EdTech providers assume schools will handle parental consent, putting responsibility in Terms of Service. The FTC explicitly called this out in the Edmodo enforcement action as violating the FTC Act.

**Why it happens:** Schools already have relationships with parents; seems logical they'd handle consent. But EdTech providers bear bottom-line COPPA responsibility regardless of what ToS says.

**Consequences:** FTC enforcement action, fines up to $50,120 per violation (2025 rate), forced product changes.

**Warning signs:**
- No parental consent flow in product
- ToS language like "schools are responsible for obtaining consent"
- Relying on school's blanket technology consent forms

**Prevention:**
- Build consent workflow architecture even for demo
- Document consent collection approach in investor materials
- Show the UI for parental consent flow, even if backend isn't complete
- Never include ToS language shifting consent responsibility

**Phase to address:** Foundation/Auth phase - consent workflow architecture

**Confidence:** HIGH - Based on [FTC Edmodo enforcement action](https://perkinscoie.com/insights/update/ftcs-coppa-enforcement-action-provides-lessons-edtech-providers) and [COPPA compliance guidance](https://www.commonsenseprivacy.net/post/top-5-coppa-tips-edtech-kidtech)

---

### COPPA-2: Third-Party SDK Data Leakage

**What goes wrong:** Your code is COPPA-compliant, but a third-party SDK (analytics, crash reporting, ad network) collects persistent identifiers or behavioral data without proper consent.

**Why it happens:** SDKs are black boxes. Developers add them for functionality without auditing data collection practices.

**Consequences:** COPPA violation even though your code is clean. Liability falls on you, not the SDK provider.

**Warning signs:**
- Using any Google Analytics, Facebook SDK, or ad-related libraries
- Adding third-party services without checking COPPA compliance
- No data flow audit of what leaves the application

**Prevention:**
- For demo: Use NO third-party tracking/analytics
- Document any third-party services and their data practices
- If analytics needed, use privacy-respecting alternatives (Plausible, Fathom)
- Supabase is self-contained, which is good - don't add extras

**Phase to address:** All phases - ongoing vigilance

**Confidence:** HIGH - Based on [FTC COPPA guidance](https://blog.promise.legal/startup-central/coppa-compliance-in-2025-a-practical-guide-for-tech-edtech-and-kids-apps/)

---

### COPPA-3: Indefinite Data Retention

**What goes wrong:** Student data is kept forever "because storage is cheap" or because no deletion policy was implemented.

**Why it happens:** Building deletion is extra work. Keeping data seems harmless. But COPPA requires data be kept only as long as "reasonably necessary."

**Consequences:** Edmodo was cited for retaining data indefinitely, then for 2 years post-inactivity without justification.

**Warning signs:**
- No data retention policy documented
- No account deletion flow
- No automated data cleanup processes
- Storing data "in case we need it later"

**Prevention:**
- Document data retention policy in architecture
- Design database with deletion in mind (soft delete with TTL)
- For demo: Show data management UI even if not fully functional
- For investor pitch: Mention proactive compliance approach

**Phase to address:** Database design phase

**Confidence:** HIGH - Based on [Edmodo FTC action](https://perkinscoie.com/insights/update/ftcs-coppa-enforcement-action-provides-lessons-edtech-providers)

---

### COPPA-4: Underestimating 2025 Rule Changes

**What goes wrong:** Building to 2020-era COPPA requirements, not realizing the 2025 amendments significantly expand scope.

**Why it happens:** Most COPPA guidance online is pre-2025. The new rule goes into effect June 2025 with full compliance by April 2026.

**Key 2025 changes:**
- **Geolocation data** now explicitly covered
- **Biometric data** (face, voice) explicitly covered
- **Separate consent required** for third-party advertising disclosure
- **New consent methods:** Knowledge-based auth, text-plus, facial recognition
- **Direct notice** requirements for parents expanded

**Warning signs:**
- Not tracking COPPA rule updates
- Assuming old compliance guides are current
- Not planning for biometric/geolocation implications

**Prevention:**
- Track [FTC COPPA updates](https://www.ftc.gov/business-guidance/resources/complying-coppa-frequently-asked-questions)
- Design architecture assuming 2025 rules (stricter)
- For demo: Mention awareness of new requirements to investors

**Phase to address:** Architecture documentation

**Confidence:** HIGH - Based on [FTC 2025 Final Rule](https://www.dwt.com/blogs/privacy--security-law-blog/2025/05/coppa-rule-ftc-amended-childrens-privacy)

---

### FERPA-1: No Written Agreement with Schools

**What goes wrong:** Operating as a "school official" under FERPA without proper data sharing agreement documentation.

**Why it happens:** Demo phase doesn't involve real schools. But architecture should support contractual requirements.

**Consequences:** Schools can't legally use the product. Post-demo sales blocked by compliance gaps.

**Warning signs:**
- No template for school data sharing agreement
- No documentation of what data is shared/stored
- Assuming FERPA only applies to schools, not vendors

**Prevention:**
- Document data flows (what PII is stored, where, for how long)
- Have template DPA (Data Processing Agreement) ready for schools
- For investor pitch: Show compliance readiness as selling point

**Phase to address:** Documentation/launch prep phase

**Confidence:** MEDIUM - Based on [FERPA vendor guidance](https://studentprivacy.ed.gov/audience/education-technology-vendors)

---

### FERPA-2: Using Student Data Beyond Educational Purpose

**What goes wrong:** Student data used for analytics, marketing, product improvement, or ML training beyond direct educational function.

**Why it happens:** Data is valuable. Tempting to use it for "making the product better." But FERPA limits use to educational purposes.

**Consequences:** FERPA violation, loss of school contracts, reputation damage.

**Warning signs:**
- Analytics on student behavior patterns for non-educational purposes
- Using student data to train ML models
- Sharing aggregated data without proper de-identification

**Prevention:**
- Document explicit purpose limitations for all data
- Supabase's RLS helps isolate data access
- For demo: Keep data strictly educational
- For architecture: Build audit logging to prove compliance

**Phase to address:** Database/logging architecture

**Confidence:** HIGH - Based on [EdTech FERPA guidance](https://ed.link/community/ferpa/)

---

## ADHD/Dyslexia UX Pitfalls

### ADHD-1: Cognitive Overload from Interface Complexity

**What goes wrong:** Dashboard shows too much at once. Students see all assignments, notifications, progress bars, and options. Brain freezes, nothing gets done.

**Why it happens:** Developers want to provide helpful information. More info seems better. But for ADHD brains, more info = paralysis.

**Research finding:** Students with ADHD experience "substantial cognitive overload because of their continuous efforts to self-regulate." Digital platforms requiring multitasking or tab-switching "exacerbate this issue."

**Warning signs:**
- Dashboard shows more than one primary action
- Multiple navigation options visible simultaneously
- Progress information competing with action items
- Notifications appearing during task completion

**Prevention:**
- One thing at a time is the correct approach - validate against this constantly
- Each screen should have ONE primary call to action
- Progress/stats are separate screens, not always-visible widgets
- Hide complexity behind progressive disclosure

**Phase to address:** Every UI phase - core design principle

**Confidence:** HIGH - Based on [K-12 ADHD accessibility research](https://pressbooks.pub/alttexts2025/chapter/accessibility-barriers-in-k-12-digital-learning-platforms-for-students-with-adhd/) and [PMC study](https://pmc.ncbi.nlm.nih.gov/articles/PMC11020716/)

---

### ADHD-2: Break System Without Structure

**What goes wrong:** Break button exists but leads to unstructured time. Students take breaks that never end, or feel guilty about taking them.

**Why it happens:** "Just pause" seems sufficient. But ADHD brains need structure to transition back to work.

**Research finding:** "Taking pre-determined, systematic breaks during a study session had mood benefits and appeared to have efficiency benefits over taking self-regulated breaks."

**Warning signs:**
- Break = timer only, no activity
- No guided return-to-work transition
- No reflection on why break was needed
- Punitive framing of breaks (limiting, shaming)

**Prevention:**
- Guided break activities (breathing, movement, reflection)
- Gentle reflection prompt before returning: "Ready to continue?" not "Break over"
- Track break patterns as insight, not punishment
- Cooldown prevents abuse without shaming (10-min minimum between breaks is in PROJECT.md - good)

**Phase to address:** Break system implementation

**Confidence:** HIGH - Based on [Pomodoro ADHD research](https://pubmed.ncbi.nlm.nih.gov/36859717/) and [ADHD productivity studies](https://www.getinflow.io/post/pomodoro-technique-adhd-productivity)

---

### ADHD-3: Wrong Timing for Focus Sessions

**What goes wrong:** Default to 25-minute Pomodoro intervals. For ADHD, especially kids, this is often too long.

**Why it happens:** 25 minutes is "standard." But ADHD research suggests different optimal intervals.

**Research finding:** "While neurotypical individuals may thrive with traditional 25-minute sessions, many with ADHD benefit from shorter 10-15 minute focused periods, especially when building the habit."

**Warning signs:**
- Fixed lesson lengths without flexibility
- No ability to save progress mid-lesson
- Assuming all students have same focus capacity
- No adaptation based on student patterns

**Prevention:**
- Lessons broken into 5-10 minute segments
- Progress saved after each question/action
- Allow students to take breaks without losing progress
- Track optimal session lengths per student (future feature)

**Phase to address:** Lesson structure design

**Confidence:** MEDIUM - Research-based but individual variation is high

---

### ADHD-4: Notification/Alert Overload

**What goes wrong:** Push notifications, badges, alerts, and reminders constantly interrupt focus. Each one derails attention.

**Why it happens:** Notifications seem helpful - reminding about due dates, celebrating progress. But interruptions devastate ADHD focus.

**Research finding:** "Hopping between all these apps and platforms, students with ADHD can become not only overwhelmed by trying to make sense of these multiple cognitive burdens."

**Warning signs:**
- Push notifications for non-urgent items
- Celebratory animations/sounds interrupting flow
- Badge counts visible during lessons
- External notifications not discussed in UX

**Prevention:**
- Minimal in-app notifications (only critical)
- Celebrations at natural stopping points, not mid-flow
- No visible notification counts during lessons
- Teacher/parent notifications separate from student experience

**Phase to address:** Notification system design

**Confidence:** HIGH - Based on [Times Higher Ed research](https://www.timeshighereducation.com/campus/adhd-higher-education-digital-learning-making-it-worse)

---

### DYS-1: Relying on "Dyslexia Fonts"

**What goes wrong:** Implementing OpenDyslexic or similar fonts thinking they're evidence-based solutions. They're not.

**Why it happens:** These fonts are heavily marketed. Intuition suggests they'd help. But research consistently shows no benefit.

**Research findings:**
- "Results show no improvement in reading rate or accuracy" for OpenDyslexic
- "Reading performance of children with and without dyslexia at word and text level are not better when they read in Dyslexie compared to Arial and Times New Roman"
- Participants "strongly preferred Verdana or Helvetica over the OpenDyslexic alternative"

**Warning signs:**
- Using OpenDyslexic as default
- Marketing "dyslexia-friendly fonts" as feature
- Not offering user choice in typography

**Prevention:**
- Use standard, highly-legible fonts (Verdana, Helvetica, system fonts)
- Allow user customization (font size, spacing)
- Focus on actual evidence-based practices: line spacing, chunk size, multi-modal content

**Phase to address:** Visual design system

**Confidence:** HIGH - Based on [peer-reviewed studies](https://pmc.ncbi.nlm.nih.gov/articles/PMC5629233/) and [Edutopia analysis](https://www.edutopia.org/article/do-dyslexia-fonts-actually-work/)

---

### DYS-2: Text-Heavy Interfaces

**What goes wrong:** Instructions, labels, navigation all rely primarily on text. Dyslexic users struggle to parse and process.

**Why it happens:** Text is the default. Icons alone can be ambiguous. But text-heavy interfaces create barriers.

**Research finding:** "Text-heavy interfaces can alienate users with dyslexia or ADHD."

**Warning signs:**
- Long instruction paragraphs
- Navigation relies entirely on text labels
- No icons or visual cues
- Dense help documentation

**Prevention:**
- Icons paired with short text labels
- Instructions broken into numbered steps with icons
- Visual progress indicators
- Audio/visual alternatives for text content

**Phase to address:** UI component design, lesson design

**Confidence:** HIGH - Based on [cognitive accessibility research](https://uxdesign.cc/adhd-dyslexic-perspective-on-cognitive-accessibility-using-cognitive-ux-design-principles-f46349a609d6)

---

### DYS-3: No Multi-Modal Content Options

**What goes wrong:** Lesson content is text-only. Students who struggle with reading can't access the material.

**Why it happens:** Text is easiest to produce. Audio/visual requires more effort. But dyslexic learners often process audio better than text.

**Research finding:** "Ensure information can be accessed in a variety of ways (visual, auditory, activity, text)."

**Warning signs:**
- Lessons are read-only
- No text-to-speech option
- No audio alternatives
- No video/visual explanations

**Prevention:**
- Build text-to-speech into lesson infrastructure (browser API available)
- Consider audio for key instructions
- Visual diagrams/illustrations where applicable
- For demo: At minimum, use browser TTS for lesson content

**Phase to address:** Lesson infrastructure

**Confidence:** HIGH - Based on [IDA assistive technology guidance](https://dyslexiaida.org/instructional-and-assistive-technology-maximizing-the-benefits-for-students-who-struggle/)

---

## Technical Pitfalls (PHP + Supabase)

### TECH-1: RLS Bypassed in Backend

**What goes wrong:** PHP backend uses service role key everywhere, bypassing Row Level Security. Security depends entirely on application logic, not database-enforced rules.

**Why it happens:** Service role key "just works" - no permission errors. Easier to develop with. But RLS is then meaningless.

**Consequences:** Security vulnerabilities, data leaks between users, compliance issues.

**Warning signs:**
- Using service role key for user-facing operations
- RLS policies exist but are never tested
- "It works in development" without testing RLS

**Prevention:**
- Use anon key + user JWT for user-facing requests
- Service role key ONLY for admin operations (background jobs, migrations)
- Test RLS policies explicitly: can student A see student B's data?
- Documented pattern: which key for which operation

**Phase to address:** Auth/database foundation phase

**Confidence:** HIGH - Based on [Supabase RLS documentation](https://supabase.com/docs/guides/database/postgres/row-level-security) and [GitHub issues](https://github.com/orgs/supabase/discussions/36423)

---

### TECH-2: auth.uid() Returns NULL

**What goes wrong:** RLS policies use `auth.uid()` but user isn't properly authenticated. Policies fail silently or block all access.

**Why it happens:** PHP backend doesn't properly pass user JWT context to Supabase client. Requests appear anonymous.

**Warning signs:**
- "Permission denied" errors on simple queries
- RLS policies work in Supabase dashboard but not from PHP
- Having to disable RLS "to make it work"

**Prevention:**
- Ensure PHP client initializes with user JWT for user operations
- Test: log `auth.uid()` in a database function to verify it's populated
- Separate client instances: one with service key (admin), one with user JWT (user-facing)

**Phase to address:** Auth implementation

**Confidence:** HIGH - Based on [Supabase RLS troubleshooting](https://supabase.com/docs/guides/troubleshooting/rls-simplified-BJTcS8)

---

### TECH-3: PHP 8.2 Requirement Overlooked

**What goes wrong:** Server runs PHP 8.1 or earlier. Official Supabase PHP client requires PHP 8.2+.

**Why it happens:** Not checking version requirements before starting development.

**Warning signs:**
- Composer install fails with version conflicts
- Features work locally but fail on hosting

**Prevention:**
- Verify PHP version early: `php -v`
- Check hosting environment supports PHP 8.2+
- Document PHP version requirement in project setup

**Phase to address:** Environment setup (Phase 0)

**Confidence:** HIGH - Based on [Packagist requirements](https://packagist.org/packages/supabase-php/supabase-client)

---

### TECH-4: No Session Management Strategy

**What goes wrong:** JWT tokens expire, users get logged out unexpectedly. Refresh token flow not implemented. Data loss or frustrating UX.

**Why it happens:** Initial auth works, but token lifecycle isn't handled. Supabase tokens expire (1 hour default).

**Warning signs:**
- Users randomly logged out
- API errors after ~1 hour of use
- No token refresh logic

**Prevention:**
- Implement token refresh before expiration
- Store refresh token securely (HTTP-only cookie)
- Handle "session expired" gracefully (auto-refresh or gentle prompt)
- For demo: Ensure demo session can last full investor meeting

**Phase to address:** Auth implementation

**Confidence:** MEDIUM - Standard JWT concern, Supabase-specific implementation needed

---

### TECH-5: No Framework = Re-inventing Security

**What goes wrong:** Without a framework, common security patterns must be manually implemented. XSS, CSRF, SQL injection, session fixation vulnerabilities appear.

**Why it happens:** Frameworks handle security by default. Raw PHP requires explicit implementation of every protection.

**Specific risks:**
- Output escaping (XSS)
- CSRF tokens for forms
- Prepared statements for any raw SQL
- Secure session configuration
- HTTP security headers

**Prevention:**
- Create security helper library early
- Use `htmlspecialchars()` for all output
- Implement CSRF token system
- Use Supabase client (not raw SQL) for all queries
- Set security headers: CSP, X-Frame-Options, etc.
- Regular security checklist review

**Phase to address:** Foundation phase - security infrastructure

**Confidence:** HIGH - Standard PHP security concerns

---

## Solo Developer Pitfalls

### SOLO-1: Building Full Features Instead of Demo Slices

**What goes wrong:** Spending weeks on complete authentication system when demo only needs happy-path flow. Over-engineering before validation.

**Why it happens:** Developer instincts say "do it right." But demo has different requirements than production.

**Research finding:** "Demos are essentially functional sales collateral. When building a demo, developers are building to throw away."

**Warning signs:**
- Implementing edge cases before happy path works
- Building admin features before core user flow
- Refactoring code that works "to make it cleaner"
- Working on non-visible infrastructure

**Prevention:**
- Define demo scope explicitly: what does investor need to SEE?
- Each feature: "Is this visible in demo?" If no, defer.
- Happy path first, always
- Technical debt is acceptable in demo code

**Phase to address:** Every phase - scope discipline

**Confidence:** HIGH - Based on [demo vs production guidance](https://jacobian.org/2020/jan/16/demos-prototypes-mvps/)

---

### SOLO-2: Underestimating Compliance Work

**What goes wrong:** Compliance treated as "documentation we'll do later." But architecture decisions made early affect compliance feasibility.

**Research finding:** "EdTech has the most complex regulatory environment outside of FinTech, with hidden compliance costs representing 30-40% of MVP budget if not planned from day one."

**Warning signs:**
- No compliance consideration in database design
- Audit logging as "nice to have"
- Assuming compliance = paperwork
- No consent flow architecture

**Prevention:**
- Compliance-ready architecture from Phase 1
- Audit logging in database design
- Consent workflow in auth flow
- Document compliance approach for investors

**Phase to address:** Foundation/architecture phase

**Confidence:** HIGH - Based on [EdTech compliance research](https://digitaldefynd.com/IQ/edtech-startup-mistakes/)

---

### SOLO-3: Teacher Adoption Deprioritized

**What goes wrong:** Beautiful student experience, but teacher tools are afterthought. Schools buy based on teacher experience, not student experience.

**Research finding:** "73% of EdTech MVP failures are due to teacher adoption problems, not student engagement."

**Warning signs:**
- Teacher dashboard is last phase
- No teacher input on requirements
- Assuming students will demand the product
- Not demonstrating teacher workflow in investor demo

**Prevention:**
- Teacher dashboard in demo scope (can be simpler than student UX)
- Show teacher-to-student connection: assign work, see progress
- Teacher efficiency is the sales pitch to schools
- Demo should show: teacher assigns → student completes → teacher sees result

**Phase to address:** Teacher features - early enough for demo

**Confidence:** HIGH - Based on [EdTech failure research](https://appinventiv.com/blog/why-education-startups-fail/)

---

### SOLO-4: Scope Creep from "Quick Adds"

**What goes wrong:** "Just one more feature" accumulates. Each is 2-4 hours. Weeks disappear.

**Why it happens:** Ideas are exciting. Solo developer has no one to say "not now." Each feature seems small.

**Warning signs:**
- Feature list growing between phases
- "While I'm in here, I'll also..."
- Working on features not in original scope
- Timeline slipping without scope reduction

**Prevention:**
- Written scope per phase - additions require removing something
- "P1" list for post-demo features
- Time-box: if feature takes >4 hours, defer it
- Weekly scope check: am I building what I planned?

**Phase to address:** Every phase - ongoing discipline

**Confidence:** HIGH - Universal solo developer pitfall

---

### SOLO-5: No Real User Testing Before Demo

**What goes wrong:** Demo shows to investors without any testing by target users. UX assumptions are wrong. Investors ask "have users tried this?" - no.

**Why it happens:** Solo developer is "too busy building." Users are hard to find. Testing feels premature.

**Warning signs:**
- No students/teachers have seen the product
- Assumptions about UX untested
- "I know what they need" thinking
- Demo without testimonials or user feedback

**Prevention:**
- Find 2-3 test users (students with ADHD/Dyslexia, a teacher)
- Can be informal: "try this for 10 minutes, tell me what's confusing"
- Video record sessions if users consent
- Incorporate feedback before investor demo
- Testimonials/quotes for pitch

**Phase to address:** Pre-demo testing phase

**Confidence:** HIGH - Based on [MVP research failure data](https://www.fuselio.com/blog/10-mvp-mistakes-startups-should-avoid-2025)

---

## Demo/Fundraising Pitfalls

### DEMO-1: Overselling Technical Completeness

**What goes wrong:** Demo appears production-ready. Investors ask about deployment timeline. Reality: months of work remain.

**Why it happens:** Demo is polished. Tempting to not mention what's missing. But this creates expectation mismatch.

**Warning signs:**
- Not disclosing demo limitations
- Implying features work that don't
- No roadmap to production

**Prevention:**
- Be clear: "This is a demo showing UX vision"
- Have realistic timeline to production
- List what's demo-only vs. production-ready
- Investors prefer honesty to surprise discoveries later

**Phase to address:** Demo preparation, investor materials

**Confidence:** HIGH - Based on [investor pitch guidance](https://qubit.capital/blog/how-to-build-investor-trust-edtech)

---

### DEMO-2: Not Demonstrating Compliance Awareness

**What goes wrong:** Investor asks "How do you handle COPPA?" Answer is vague. Red flag for EdTech investment.

**Research finding:** "EdTech startups must navigate complex regulatory landscapes. Proactively addressing these concerns in your pitch deck builds investor confidence."

**Warning signs:**
- No compliance slide in deck
- Can't explain COPPA/FERPA approach
- "We'll figure it out later" attitude

**Prevention:**
- Compliance slide in pitch deck
- Demo compliance-ready architecture (consent flow, audit logging)
- Know specific requirements: COPPA parental consent, FERPA data minimization
- Frame as competitive advantage: "We're built for compliance from day one"

**Phase to address:** Investor materials, architecture documentation

**Confidence:** HIGH - Based on [EdTech fundraising guidance](https://qubit.capital/blog/how-to-build-investor-trust-edtech)

---

### DEMO-3: Hype Over Traction

**What goes wrong:** Pitch focuses on vision and features. No evidence of market demand, user interest, or validation.

**Research finding:** "Investors want evidence of adoption, not hype or shiny dashboards. The 2021 playbook of raising on vision alone is dead."

**Warning signs:**
- No user testimonials
- No letters of intent from schools
- No waitlist or expressed interest
- Pure feature demo without validation

**Prevention:**
- Get 2-3 schools to express interest (email is enough)
- User testing quotes: "My student actually finished their homework"
- Show problem validation: statistics on ADHD/Dyslexia and current tool failures
- Even small numbers matter: "3 teachers said they'd try this"

**Phase to address:** Pre-demo outreach and testing

**Confidence:** HIGH - Based on [EdTech investor expectations](https://qubit.capital/blog/how-to-build-investor-trust-edtech)

---

### DEMO-4: Demo Breaks During Presentation

**What goes wrong:** Live demo fails. API timeout. Login error. Data doesn't load. Credibility damaged.

**Why it happens:** Demo environment not hardened. Edge cases hit. Network issues.

**Warning signs:**
- Only tested on local machine
- No fallback plan
- Dependent on live API calls
- No pre-loaded demo data

**Prevention:**
- Pre-recorded video backup for critical flows
- Demo data seeded and stable (not dependent on live calls)
- Rehearse demo 5+ times
- Have offline fallback (screenshots, video) ready
- Test on demo day network conditions

**Phase to address:** Demo preparation phase

**Confidence:** HIGH - Universal demo risk

---

### DEMO-5: Wrong Demo Audience Focus

**What goes wrong:** Demo shows student experience to investors who care about business model, or shows admin features when differentiation is UX.

**Why it happens:** Not tailoring demo to audience.

**Warning signs:**
- Same demo for all audiences
- Not knowing what investors care about
- Spending too long on features, not enough on differentiation

**Prevention:**
- Lead with differentiation: the "one thing at a time" student experience
- Show full loop: teacher assigns → student completes with breaks → teacher sees
- Have business model slides, but demo is about UX differentiation
- Time the demo: 10 minutes max, leave time for questions

**Phase to address:** Demo preparation and rehearsal

**Confidence:** HIGH - Based on [EdTech pitch guidance](https://www.failory.com/pitch-deck/edtech)

---

## Prevention Checklist

### Pre-Development (Foundation Phase)

- [ ] PHP 8.2+ verified on development and hosting environments
- [ ] Supabase project created with RLS enabled on all tables
- [ ] Security helper library created (XSS, CSRF, headers)
- [ ] Demo scope document: what must be visible to investors?
- [ ] Compliance architecture documented (consent flow, audit logging, data retention)

### Architecture Decisions

- [ ] Service role key vs. user JWT usage documented
- [ ] RLS policies designed for multi-tenant (student can only see their data)
- [ ] Audit logging table structure designed
- [ ] Parental consent workflow architected
- [ ] Data retention policy documented

### UX Implementation

- [ ] Every screen reviewed: "Is there only ONE primary action?"
- [ ] Break system includes guided activities, not just timer
- [ ] No dyslexia fonts - using Verdana/system fonts with customization options
- [ ] Text-to-speech option for lesson content
- [ ] Icons paired with text for navigation
- [ ] No notifications/badges during lesson flow

### Technical Implementation

- [ ] Token refresh implemented before expiration
- [ ] RLS tested explicitly: can user A see user B's data?
- [ ] No third-party tracking/analytics SDKs
- [ ] Security headers configured (CSP, X-Frame-Options)
- [ ] Demo data seeded and stable

### Pre-Demo

- [ ] 2-3 real users have tested (students, teachers)
- [ ] User feedback incorporated
- [ ] Demo rehearsed 5+ times
- [ ] Video backup recorded
- [ ] Compliance slide in deck
- [ ] Timeline to production documented
- [ ] Letters of interest from schools (ideal)

### Investor Readiness

- [ ] Can explain COPPA approach in 2 sentences
- [ ] Can explain FERPA approach in 2 sentences
- [ ] Demo shows full loop: teacher → student → teacher
- [ ] Demo under 10 minutes
- [ ] Honest about what's demo vs. production-ready

---

## Phase Mapping Summary

| Phase | Critical Pitfalls to Address |
|-------|------------------------------|
| Environment Setup | TECH-3 (PHP version) |
| Foundation/Auth | TECH-1, TECH-2, TECH-4, COPPA-1, SOLO-2 |
| Database Design | COPPA-3, FERPA-2, TECH-1 |
| Student UX | ADHD-1, ADHD-3, ADHD-4, DYS-1, DYS-2, DYS-3 |
| Break System | ADHD-2 |
| Teacher Dashboard | SOLO-3 |
| Content/Lessons | ADHD-3, DYS-3 |
| Demo Prep | DEMO-1, DEMO-2, DEMO-3, DEMO-4, DEMO-5 |
| Throughout | SOLO-1, SOLO-4, COPPA-2 |

---

## Sources

### Compliance
- [FTC COPPA Compliance Guide 2025](https://blog.promise.legal/startup-central/coppa-compliance-in-2025-a-practical-guide-for-tech-edtech-and-kids-apps/)
- [FTC Edmodo Enforcement Action](https://perkinscoie.com/insights/update/ftcs-coppa-enforcement-action-provides-lessons-edtech-providers)
- [FTC 2025 COPPA Rule Amendments](https://www.dwt.com/blogs/privacy--security-law-blog/2025/05/coppa-rule-ftc-amended-childrens-privacy)
- [FERPA EdTech Vendor Guidance](https://studentprivacy.ed.gov/audience/education-technology-vendors)
- [Verifiable Parental Consent Methods](https://securiti.ai/ftc-coppa-final-rule-amendments/)

### ADHD/Dyslexia UX
- [K-12 ADHD Accessibility Barriers](https://pressbooks.pub/alttexts2025/chapter/accessibility-barriers-in-k-12-digital-learning-platforms-for-students-with-adhd/)
- [Cognitive Load in Online Learning](https://pmc.ncbi.nlm.nih.gov/articles/PMC11020716/)
- [Pomodoro Technique for ADHD Research](https://pubmed.ncbi.nlm.nih.gov/36859717/)
- [OpenDyslexic Effectiveness Study](https://pmc.ncbi.nlm.nih.gov/articles/PMC5629233/)
- [Cognitive Accessibility UX Principles](https://uxdesign.cc/adhd-dyslexic-perspective-on-cognitive-accessibility-using-cognitive-ux-design-principles-f46349a609d6)

### Technical
- [Supabase RLS Documentation](https://supabase.com/docs/guides/database/postgres/row-level-security)
- [Supabase PHP RLS Issues](https://github.com/orgs/supabase/discussions/36423)
- [Supabase RLS Troubleshooting](https://supabase.com/docs/guides/troubleshooting/rls-simplified-BJTcS8)

### Solo Developer/Demo
- [EdTech MVP Failures Research](https://appinventiv.com/blog/why-education-startups-fail/)
- [Demo vs Prototype vs MVP](https://jacobian.org/2020/jan/16/demos-prototypes-mvps/)
- [EdTech Investor Pitch Guidance](https://qubit.capital/blog/how-to-build-investor-trust-edtech)
- [MVP Mistakes 2025](https://www.fuselio.com/blog/10-mvp-mistakes-startups-should-avoid-2025)
