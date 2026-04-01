/* ============================================================
   LevelAI — Demo JavaScript
   ============================================================ */

const LevelAI = (() => {

  /* ---------- Session State ---------- */
  const state = {
    get(key) { try { return JSON.parse(sessionStorage.getItem('levelai_' + key)); } catch { return null; } },
    set(key, val) { sessionStorage.setItem('levelai_' + key, JSON.stringify(val)); },
    all() {
      return {
        firstName: this.get('firstName') || '',
        lastName:  this.get('lastName')  || '',
        preferred: this.get('preferred') || 'Alex',
        avatar:    this.get('avatar')    || null,
        style:     this.get('style')     || 'adhd',
        dyslexic:  this.get('dyslexic')  || false,
        dark:      this.get('dark')      || false,
      };
    }
  };

  /* ---------- Theme & Font Helpers ---------- */
  function applyTheme() {
    const s = state.all();
    document.body.classList.toggle('dark', s.dark);
    document.body.classList.toggle('dyslexic', s.dyslexic);

    // Update all toggle UI instances
    document.querySelectorAll('[data-theme-track]').forEach(el => {
      el.classList.toggle('active', s.dark);
    });
    document.querySelectorAll('[data-font-btn]').forEach(el => {
      el.classList.toggle('active', s.dyslexic);
      el.textContent = s.dyslexic ? 'Using Open Dyslexic' : 'Change Font to Open Dyslexic';
    });
  }

  function toggleDark() {
    state.set('dark', !state.get('dark'));
    applyTheme();
  }

  function toggleFont() {
    state.set('dyslexic', !state.get('dyslexic'));
    applyTheme();
  }

  /* ---------- Clock ---------- */
  function startClock() {
    const els = document.querySelectorAll('[data-clock]');
    if (!els.length) return;
    function tick() {
      const now = new Date();
      const d = now.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
      const t = now.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
      els.forEach(el => el.textContent = `${d} • ${t}`);
    }
    tick();
    setInterval(tick, 15000);
  }

  /* ---------- Inject preferred name ---------- */
  function injectName() {
    const s = state.all();
    document.querySelectorAll('[data-name]').forEach(el => {
      el.textContent = s.preferred || 'Alex';
    });
  }

  /* ---------- Inject avatar ---------- */
  function injectAvatar() {
    const s = state.all();
    document.querySelectorAll('[data-user-avatar]').forEach(el => {
      if (s.avatar) {
        el.innerHTML = `<div class="avatar-circle" style="background:${s.avatar.bg};font-size:1.125rem;border-radius:50%;width:100%;height:100%;">${s.avatar.emoji}</div>`;
        el.classList.remove('topnav__avatar-placeholder');
        el.classList.add('topnav__avatar-placeholder');
      }
    });
  }

  /* ---------- Timer ---------- */
  let timerInterval = null;
  let timerSeconds  = 45 * 60;
  let timerRunning  = false;

  function formatTime(s) {
    const m = Math.floor(s / 60);
    const sec = s % 60;
    return `${String(m).padStart(2, '0')}:${String(sec).padStart(2, '0')}`;
  }

  function updateTimerUI() {
    const el = document.querySelector('[data-timer]');
    const ring = document.querySelector('[data-timer-ring]');
    if (el) el.textContent = formatTime(timerSeconds);
    if (ring) {
      const total = 45 * 60;
      const pct = timerSeconds / total;
      const circ = 2 * Math.PI * 72;
      ring.style.strokeDashoffset = circ * (1 - pct);
    }
  }

  function startTimer() {
    if (timerRunning) return;
    timerRunning = true;
    const btn = document.querySelector('[data-timer-start]');
    if (btn) btn.textContent = '⏸ Pause Timer';
    timerInterval = setInterval(() => {
      if (timerSeconds > 0) {
        timerSeconds--;
        updateTimerUI();
      } else {
        clearInterval(timerInterval);
        timerRunning = false;
        if (btn) btn.textContent = '▶ Start Timer';
      }
    }, 1000);
  }

  function pauseTimer() {
    clearInterval(timerInterval);
    timerRunning = false;
    const btn = document.querySelector('[data-timer-start]');
    if (btn) btn.textContent = '▶ Start Timer';
  }

  /* ---------- Checklist ---------- */
  function initChecklist() {
    document.querySelectorAll('[data-checklist-item]').forEach(item => {
      item.addEventListener('click', () => {
        const isChecked = item.classList.toggle('checked');
        item.classList.remove('active');
        // Advance active to next unchecked
        const all = [...document.querySelectorAll('[data-checklist-item]')];
        const nextUnchecked = all.find(i => !i.classList.contains('checked'));
        if (nextUnchecked) nextUnchecked.classList.add('active');
      });
    });
  }

  /* ---------- Break Options ---------- */
  function initBreakOptions() {
    document.querySelectorAll('[data-break-option]').forEach(opt => {
      opt.addEventListener('click', () => {
        document.querySelectorAll('[data-break-option]').forEach(o => o.classList.remove('selected'));
        opt.classList.add('selected');
      });
    });
  }

  /* ---------- Learning Style Cards ---------- */
  function initStyleCards() {
    document.querySelectorAll('[data-style-card]').forEach(card => {
      card.addEventListener('click', () => {
        document.querySelectorAll('[data-style-card]').forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
        const nextBtn = document.querySelector('[data-next-btn]');
        if (nextBtn) {
          nextBtn.disabled = false;
          state.set('style', card.dataset.styleCard);
        }
      });
    });
  }

  /* ---------- Avatar Grid ---------- */
  function initAvatarGrid() {
    document.querySelectorAll('[data-avatar-option]').forEach(opt => {
      opt.addEventListener('click', () => {
        document.querySelectorAll('[data-avatar-option]').forEach(o => o.classList.remove('selected'));
        opt.classList.add('selected');
        const nextBtn = document.querySelector('[data-next-btn]');
        if (nextBtn) nextBtn.disabled = false;
        state.set('avatar', {
          emoji: opt.dataset.emoji || '?',
          bg:    opt.dataset.bg    || '#ccc'
        });
      });
    });
  }

  /* ---------- SSO Demo Buttons ---------- */
  function initSSO() {
    document.querySelectorAll('[data-sso]').forEach(btn => {
      btn.addEventListener('click', () => {
        // Demo: just skip to step 2 with placeholder name
        state.set('firstName', 'Alex');
        state.set('lastName',  'Johnson');
        window.location.href = '/onboard/step2.html';
      });
    });
  }

  /* ---------- Step 1 Form ---------- */
  function initStep1Form() {
    const first = document.querySelector('#firstName');
    const last  = document.querySelector('#lastName');
    const next  = document.querySelector('[data-next-btn]');
    if (!first || !last || !next) return;

    function check() {
      next.disabled = !(first.value.trim() && last.value.trim());
    }

    first.addEventListener('input', check);
    last.addEventListener('input', check);

    // Pre-fill if returning
    const s = state.all();
    if (s.firstName) { first.value = s.firstName; }
    if (s.lastName)  { last.value  = s.lastName; }
    check();

    const form = document.querySelector('[data-step1-form]');
    if (form) {
      form.addEventListener('submit', e => {
        e.preventDefault();
        state.set('firstName', first.value.trim());
        state.set('lastName',  last.value.trim());
        window.location.href = '/onboard/step2.html';
      });
    }
  }

  /* ---------- Step 2 Form ---------- */
  function initStep2Form() {
    const input = document.querySelector('#preferredName');
    const next  = document.querySelector('[data-next-btn]');
    if (!input || !next) return;

    const s = state.all();
    if (s.preferred && s.preferred !== 'Alex') input.value = s.preferred;
    else if (s.firstName) input.value = s.firstName;

    function check() { next.disabled = !input.value.trim(); }
    input.addEventListener('input', check);
    check();

    const form = document.querySelector('[data-step2-form]');
    if (form) {
      form.addEventListener('submit', e => {
        e.preventDefault();
        state.set('preferred', input.value.trim() || s.firstName || 'Alex');
        window.location.href = '/onboard/step3.html';
      });
    }
  }

  /* ---------- Greet ---------- */
  function greetingText() {
    const h = new Date().getHours();
    if (h < 12) return 'Good morning';
    if (h < 17) return 'Good afternoon';
    return 'Good evening';
  }

  function injectGreeting() {
    const el = document.querySelector('[data-greeting]');
    if (el) el.textContent = greetingText();
  }

  /* ---------- Settings Page ---------- */
  function initSettings() {
    const s = state.all();

    // Dyslexic toggle
    const dyslexicToggle = document.querySelector('#dyslexicToggle');
    if (dyslexicToggle) {
      dyslexicToggle.checked = s.dyslexic;
      dyslexicToggle.addEventListener('change', () => {
        state.set('dyslexic', dyslexicToggle.checked);
        applyTheme();
        markUnsaved();
      });
    }

    // Theme buttons
    document.querySelectorAll('[data-theme-choice]').forEach(btn => {
      btn.classList.toggle('active', btn.dataset.themeChoice === (s.dark ? 'dark' : 'light'));
      btn.addEventListener('click', () => {
        const isDark = btn.dataset.themeChoice === 'dark';
        state.set('dark', isDark);
        applyTheme();
        document.querySelectorAll('[data-theme-choice]').forEach(b => {
          b.classList.toggle('active', b.dataset.themeChoice === btn.dataset.themeChoice);
        });
        markUnsaved();
      });
    });

    // Style cards
    document.querySelectorAll('[data-style-card]').forEach(card => {
      card.classList.toggle('selected', card.dataset.styleCard === s.style);
      card.addEventListener('click', () => {
        document.querySelectorAll('[data-style-card]').forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
        state.set('style', card.dataset.styleCard);
        markUnsaved();
      });
    });

    // Save / Cancel
    const saveBtn   = document.querySelector('[data-save-settings]');
    const cancelBtn = document.querySelector('[data-cancel-settings]');
    const unsaved   = document.querySelector('[data-unsaved]');
    if (saveBtn)   saveBtn.addEventListener('click', () => { hideUnsaved(); showSaved(); });
    if (cancelBtn) cancelBtn.addEventListener('click', () => { hideUnsaved(); });

    function markUnsaved() { if (unsaved) unsaved.style.display = 'flex'; }
    function hideUnsaved() { if (unsaved) unsaved.style.display = 'none'; }
    function showSaved() {
      if (saveBtn) { saveBtn.textContent = '✓ Saved!'; setTimeout(() => saveBtn.textContent = 'Save Changes', 2000); }
    }
  }

  /* ---------- Init ---------- */
  function init() {
    applyTheme();
    startClock();
    injectName();
    injectAvatar();
    injectGreeting();

    // Bind global controls
    document.querySelectorAll('[data-theme-track]').forEach(el => {
      el.addEventListener('click', toggleDark);
    });
    document.querySelectorAll('[data-font-btn]').forEach(el => {
      el.addEventListener('click', toggleFont);
    });

    // Timer
    const timerStart = document.querySelector('[data-timer-start]');
    if (timerStart) {
      updateTimerUI();
      timerStart.addEventListener('click', () => {
        if (timerRunning) pauseTimer(); else startTimer();
      });
    }

    const completeBtn = document.querySelector('[data-complete-task]');
    if (completeBtn) {
      completeBtn.addEventListener('click', () => {
        pauseTimer();
        window.location.href = '/home.html';
      });
    }

    initChecklist();
    initBreakOptions();
    initStyleCards();
    initAvatarGrid();
    initSSO();
    initStep1Form();
    initStep2Form();
    initSettings();
  }

  document.addEventListener('DOMContentLoaded', init);

  return { state, toggleDark, toggleFont };

})();
