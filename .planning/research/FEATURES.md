# Features Research: ADHD/Dyslexia EdTech Platform

**Domain:** Learning platform for middle school students (11-14) with ADHD/Dyslexia
**Researched:** 2026-02-04
**Overall Confidence:** MEDIUM-HIGH

---

## Existing Solutions Analyzed

### ModMath (Dyslexia/Dyscalculia Math)
- **Core function:** Digital graph paper for math without handwriting
- **Key features:** Each number/symbol gets own box, touchscreen keypad, zoom focus, assignment import from Google Drive, document library
- **Platforms:** iPad, MacBook, Chromebook, Android tablets
- **Source:** [ModMath](https://www.modmath.com/), [ADDitude Magazine](https://www.additudemag.com/a-free-app-to-turn-your-child-into-a-math-master/)

### Learning Ally (Audiobooks for Dyslexia)
- **Core function:** Human-narrated audiobooks with synchronized text highlighting
- **Key features:** 80,000+ audiobooks, word-by-word highlighting synced with audio, adjustable letter spacing/line height/margins, customizable font/background/highlight colors, 10-second rewind, speed control, bookmarking, note-taking
- **2025 updates:** Streaming audio (no full downloads required), enhanced accessibility
- **Source:** [Learning Ally](https://learningally.org/), [AT HelpDesk](https://athelpdesk.org/learning-ally-audiobooks-for-students/)

### Bookshare (Accessible Reading Library)
- **Core function:** 1.4M accessible book titles in multiple formats
- **Key features:** Audio + highlighted synchronized text, braille output, customizable voices/speed/colors, dyslexic font option, large font (18-24pt), increased character spacing (7-14%)
- **Pricing:** Free for US schools and qualifying students
- **Research basis:** Evidence-based design for readability improvements
- **Source:** [Bookshare](https://www.bookshare.org/), [Benetech](https://benetech.org/accessible-reading-learning/bookshare/)

### Tiimo (ADHD Visual Planner)
- **Core function:** Visual daily planner designed for neurodivergent users
- **Key features:** Icons and color cues instead of text lists, reduces cognitive load, visual representation of time
- **Recognition:** iPhone App of the Year 2025
- **Source:** [Tiimo](https://www.tiimoapp.com/)

### Microsoft Immersive Reader
- **Core function:** Free accessibility tool across Microsoft products
- **Key features:** Text-to-speech with customizable speed/voice, line focus (one line at a time), syllable breakdown, word/letter spacing adjustment, parts-of-speech identification, 81 language support
- **Integration:** Word, OneNote, Teams, Edge, Minecraft Education
- **Research:** Proven to increase reading comprehension for struggling readers
- **Source:** [Microsoft Education](https://www.microsoft.com/en-us/education/blog/2025/05/making-learning-more-accessible-with-microsoft-education/)

### Breathwrk / Headspace / Smiling Mind (Mindfulness)
- **Core function:** Guided breathing and mindfulness exercises
- **Key ADHD features:** Short exercises, rhythmic breathing for autonomic regulation, age-specific content
- **Research:** 2-3 weekly breathing sessions over 2-3 months improved regulatory control in children with ADHD
- **Source:** [ADDitude Magazine](https://www.additudemag.com/deep-breathing-exercises-for-adhd-meditation/), [Learning Scientists](https://www.learningscientists.org/blog/2025/3/20-1)

### Inflow (ADHD Management App)
- **Core function:** ADHD skill-building using CBT principles
- **Key features:** Bite-sized lessons, interactive exercises, live expert events, co-working focus rooms, peer support, customizable focus levels, "ADHD mode" toggle
- **Source:** [Inflow](https://www.getinflow.io/post/best-apps-for-adhd)

---

## Table Stakes

Features users expect. Missing = product feels incomplete or unusable for this audience.

| Feature | Why Expected | Complexity | Notes |
|---------|--------------|------------|-------|
| **Text-to-Speech (TTS)** | Core accommodation for dyslexia; bypasses decoding difficulty | Medium | Requires quality voices, speed control. Consider using Web Speech API or paid service like AWS Polly |
| **Synchronized text highlighting** | Visual tracking while audio plays; proven to improve comprehension | Medium-High | Must be word-by-word synced, not just line-by-line |
| **Adjustable text display** | Font size, spacing, line height customization | Low-Medium | Standard accessibility; allow user control |
| **Clean, low-stimulation UI** | Reduces cognitive overload; ADHD users sensitive to visual clutter | Low | Cream/pastel colors, minimal animations, rounded shapes align with project thesis |
| **Break reminders/timers** | ADHD students need externalized time awareness and structured breaks | Low-Medium | Pomodoro-style or customizable intervals |
| **Visual progress indication** | Students need to see where they are; reduces anxiety about "how much left" | Low | Progress bars, step indicators |
| **Clear navigation** | Cognitive load from confusing interfaces disproportionately affects ADHD | Low | One clear action per screen aligns with "one thing at a time" thesis |
| **Save progress/bookmarking** | Interrupted sessions are common; must not lose work | Low-Medium | Auto-save, resume from last position |
| **Basic progress tracking** | Parents/teachers need visibility into student engagement and completion | Medium | Dashboard showing activity, completion, time spent |
| **Content chunking** | Long content overwhelms; 5-7 minute lessons recommended | Low | Structure content in digestible units |

### Table Stakes Complexity Summary
- **Low complexity (5):** Clean UI, navigation, progress bars, content chunking, text display
- **Medium complexity (5):** TTS, break timers, bookmarking, basic tracking, highlighting

---

## Differentiators

Features that would set Level.AI apart. Not universally expected, but create competitive advantage.

| Feature | Value Proposition | Complexity | Notes |
|---------|-------------------|------------|-------|
| **"One thing at a time" sequential design** | Core thesis: reduce cognitive load by showing only current task, no visible distractions | Medium | Unique positioning; research supports monotropic focus for neurodivergent learners |
| **Guided break activities (breathing, movement, reflection)** | Not just "take a break" but structured, calming activities | Medium | Breathing exercises proven to improve ADHD regulatory control; movement breaks aid focus |
| **Calm visual environment (cream backgrounds, meaningful color only)** | Intentionally anti-gamification aesthetic; reduces overstimulation | Low | Well-researched: soft pastels, muted tones, minimal visual noise |
| **Three-stakeholder system (Student/Parent/Teacher)** | Most apps are student-only; coordinated support improves outcomes | High | Requires role-based auth, different dashboards, communication features |
| **B2B school integration** | IEP/504 alignment, school-wide deployment, teacher tools | High | Significant for go-to-market; requires admin features, bulk management |
| **Adaptive break timing** | Learn when student needs breaks based on usage patterns | High | AI/ML component; could start with fixed intervals, evolve later |
| **Reflection prompts** | "How did that feel?" emotional regulation integration | Low-Medium | Metacognition support; differentiates from pure content delivery |
| **Movement break videos** | Physical activity breaks, not just screen-based breathing | Medium | Video content production required; could use existing content initially |
| **Distraction-free mode** | One-click to hide all navigation, focus purely on current content | Low | Easy win; many apps have cluttered chrome |
| **Parent insight reports** | Weekly/daily summaries of student activity, struggles, wins | Medium | Email or in-app; builds parent engagement |
| **Teacher intervention alerts** | Notify when student struggling (repeated failures, long gaps) | Medium-High | Requires threshold logic, notification system |

### Differentiator Prioritization for Demo
Given this is for fundraising demo, not production:
1. **High-impact, low-complexity:** Calm visual design, "one thing at a time" flow, distraction-free mode, reflection prompts
2. **Demo-worthy, medium-complexity:** Guided breathing breaks, basic three-stakeholder views
3. **Defer to production:** Adaptive timing, teacher alerts, full B2B integration

---

## Anti-Features

Things to deliberately NOT build for this audience. Common mistakes in EdTech.

| Anti-Feature | Why Avoid | What to Do Instead |
|--------------|-----------|-------------------|
| **Heavy gamification (badges, points, leaderboards)** | Can cause overstimulation; reward systems may encourage compulsive behavior rather than learning; distracts from calm focus | Use subtle progress indicators; intrinsic motivation through completion and reflection |
| **Flashing/animated elements** | Triggers overstimulation for ADHD; distracting rather than engaging | Static or very subtle transitions; no attention-grabbing animations |
| **Leaderboards/social comparison** | Creates anxiety; ADHD/dyslexia students often have shame around performance | Focus on personal progress only; never compare to peers |
| **Complex, branching navigation** | Increases cognitive load; requires remembering where you are | Linear, sequential progression; clear "back" and "forward" |
| **Multitasking requirements** | ADHD brains struggle with task-switching; tab-switching exacerbates focus issues | One task at a time; no parallel workflows |
| **Long-form content without breaks** | Attention fatigue; working memory limits for dyslexia | Chunk everything; built-in break points |
| **"Dyslexia fonts" as primary solution** | Research shows no proven benefit; may reduce reading speed | Offer as option but default to clean sans-serif (Arial, Verdana); focus on spacing, sizing |
| **Timed pressure elements** | Increases anxiety; penalizes processing speed differences | Untimed or generous time limits; progress saved regardless of time |
| **Penalty for mistakes** | Shame and anxiety; discourages risk-taking | Neutral feedback; focus on learning not scoring |
| **Notification bombardment** | Breaks focus; adds cognitive load | Minimal, user-controlled notifications; batch updates |
| **Constant audio/sound effects** | Sensory overload for many ADHD users | Silent by default; audio only when intentionally playing TTS or break activities |
| **Required social features** | Social anxiety common; adds complexity | Optional at most; never required for core functionality |

### Anti-Feature Rationale
The core thesis "one thing at a time" naturally conflicts with most gamification patterns. The calm visual environment requirement conflicts with attention-grabbing design. These anti-features are not arbitrary - they flow directly from the project's design philosophy and target audience needs.

---

## Feature Dependencies

```
CORE INFRASTRUCTURE
|
+-- User Authentication System
|   +-- Role-based access (Student/Parent/Teacher)
|   |   +-- Student dashboard
|   |   +-- Parent dashboard
|   |   +-- Teacher dashboard
|   +-- Progress data storage
|       +-- Activity tracking
|       +-- Completion tracking
|       +-- Time tracking
|
+-- Content Delivery System
|   +-- Text content storage/display
|   |   +-- Adjustable text display (font, size, spacing)
|   |   +-- Text-to-Speech integration
|   |       +-- Synchronized highlighting
|   +-- Sequential "one thing at a time" flow
|       +-- Progress indication
|       +-- Distraction-free mode
|
+-- Break System
|   +-- Break timer/reminder
|       +-- Guided breathing exercises
|       +-- Movement break content
|       +-- Reflection prompts
|
+-- Reporting System (depends on: Auth + Progress data)
    +-- Basic progress tracking
        +-- Parent insight reports
        +-- Teacher intervention alerts
```

### Critical Path for MVP/Demo
1. **Must build first:** User auth, basic content display, sequential flow
2. **Must build second:** Progress tracking, adjustable text, break timer
3. **Must build third:** TTS with highlighting, role-based dashboards
4. **Can add later:** Guided breaks, reports, alerts, adaptive features

---

## Complexity Assessment

### Low Complexity (Days to build)
| Feature | Effort Estimate | Notes |
|---------|-----------------|-------|
| Clean, low-stimulation UI | 2-3 days | CSS/design system; cream backgrounds, soft colors |
| Adjustable text display | 1-2 days | Font size/spacing controls; localStorage persistence |
| Clear navigation | 1-2 days | Design decision more than dev work |
| Visual progress indication | 1 day | Progress bar component |
| Content chunking | 0 days (content decision) | Structure content appropriately |
| Distraction-free mode | 0.5 days | Toggle to hide UI chrome |
| Reflection prompts | 1 day | Simple form after activities |

### Medium Complexity (Weeks to build)
| Feature | Effort Estimate | Notes |
|---------|-----------------|-------|
| Text-to-Speech | 1-2 weeks | Web Speech API is easy; quality voices need AWS Polly/Google TTS |
| Synchronized highlighting | 2-3 weeks | Need word timing data or real-time sync; non-trivial |
| Break timer system | 1 week | Timer + notification + state management |
| Save progress/bookmarking | 1 week | Database schema, auto-save logic |
| Basic progress tracking | 1-2 weeks | Event logging, aggregation, simple dashboard |
| Guided breathing exercises | 1-2 weeks | Animation, timing, possibly audio/video |
| "One thing at a time" flow | 1-2 weeks | UX pattern throughout; affects whole architecture |
| Parent insight reports | 1-2 weeks | Data aggregation, email or in-app display |

### High Complexity (Months to build)
| Feature | Effort Estimate | Notes |
|---------|-----------------|-------|
| Three-stakeholder system | 2-4 weeks | Role-based auth, three different UIs, permission logic |
| Teacher intervention alerts | 2-3 weeks | Threshold logic, notification infrastructure, teacher workflow |
| B2B school integration | 4-8 weeks | Admin portal, bulk user management, reporting, possibly SSO |
| Adaptive break timing | 4-6 weeks | ML component, data collection, personalization engine |

### Demo Scope Recommendation
For a fundraising demo (not production), focus on:
1. **Week 1:** Auth, visual design system, basic content display with sequential flow
2. **Week 2:** Text controls, progress indicators, break timer
3. **Week 3:** TTS (basic), one guided breathing break, stub dashboards for all three roles
4. **Week 4:** Polish, simple progress tracking, parent view of student activity

This produces a demo that shows:
- The "one thing at a time" core thesis
- The calm visual environment
- All three user types (even if limited functionality)
- Key accessibility features (TTS, text controls)
- The break system concept

---

## Sources

### Competitor Products
- [ModMath](https://www.modmath.com/)
- [Learning Ally](https://learningally.org/)
- [Bookshare](https://www.bookshare.org/)
- [Tiimo](https://www.tiimoapp.com/)
- [Inflow ADHD](https://www.getinflow.io/)
- [Microsoft Immersive Reader](https://learn.microsoft.com/en-us/training/educator-center/product-guides/immersive-reader/)

### Design Research
- [Smashing Magazine: Designing for Neurodiversity](https://www.smashingmagazine.com/2025/06/designing-for-neurodiversity/)
- [Neurodiversity Design System](https://www.neurodiversity.design/)
- [ADHD Accessibility Barriers in K-12 Platforms](https://pressbooks.pub/alttexts2025/chapter/accessibility-barriers-in-k-12-digital-learning-platforms-for-students-with-adhd/)
- [Neuroinclusive Design for ADHD (Inflow case study)](https://www.tamarasredojevic.com/work/inflow)

### Academic Research
- [Cognitive Load and Neurodiversity in Online Learning (2024)](https://www.frontiersin.org/journals/education/articles/10.3389/feduc.2024.1437673/full)
- [Gamified Education for ADHD (2025 RCT)](https://www.frontiersin.org/journals/education/articles/10.3389/feduc.2025.1668260/full)
- [OpenDyslexic Font Research](https://pmc.ncbi.nlm.nih.gov/articles/PMC5629233/) - Note: Research shows no proven benefit
- [Mindfulness for ADHD](https://www.learningscientists.org/blog/2025/3/20-1)

### Color/Visual Design
- [Calm UX Trends 2025](https://raw.studio/blog/the-aesthetics-of-calm-ux-how-blur-and-muted-themes-are-redefining-digital-design/)
- [Best Colors for ADHD](https://neurolaunch.com/best-colors-for-adhd/)
- [ADHD-Friendly Environments](https://www.theartofdesignmagazine.com/designing-for-focus-and-calm-the-power-of-adhd-friendly-environments/)

### EdTech/School Integration
- [PowerSchool Special Programs](https://www.powerschool.com/blog/special-education-software/)
- [Amplio Platform](https://ampliolearning.com/platform/)
- [AI in Special Education 2025](https://www.ezducate.ai/blogs/ai-in-special-education-2025-the-complete-reality-check-for-parents-educators/)

---

## Key Takeaways for Level.AI

1. **The "one thing at a time" thesis is research-validated.** Monotropic focus, sequential instruction, and reduced multitasking requirements are established best practices for neurodivergent learners. This is a genuine differentiator, not just a design preference.

2. **Calm visual design is table stakes, but few do it well.** Most EdTech defaults to bright colors and gamification. Level.AI's cream/pastel approach aligns with current research and 2025 UX trends toward "calm UX."

3. **Text-to-speech with synchronized highlighting is expected.** Learning Ally, Bookshare, and Microsoft Immersive Reader have set this standard. Don't launch without at least basic TTS.

4. **Guided breaks with breathing exercises are proven effective.** This is a differentiator that can be relatively simple to implement and has research backing for ADHD benefit.

5. **Three-stakeholder system is ambitious but valuable.** Most apps are student-only. Parent/teacher visibility is a B2B selling point but adds significant complexity.

6. **Avoid gamification traps.** The instinct to add badges/points is strong in EdTech, but this conflicts with the calm, focused experience this audience needs.

7. **"Dyslexia fonts" are not the answer.** Peer-reviewed research shows no benefit; focus instead on customizable spacing, sizing, and colors.
