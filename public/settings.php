<?php
$pageTitle    = 'Settings & Accessibility';
$currentPage  = 'settings';
include 'includes/head.php';
include 'includes/nav-app.php';
?>

<main class="page-wrapper fade-in">

  <h1 class="page-title">Settings &amp; Accessibility</h1>
  <p class="page-subtitle">Customize your learning experience for maximum comfort and focus.</p>

  <div class="settings-layout">

    <!-- Sidebar Nav -->
    <nav class="settings-nav">
      <a href="#profile"       class="active">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        Profile
      </a>
      <a href="#accessibility">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
        Accessibility
      </a>
      <a href="#learning">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
        Learning Style
      </a>
      <a href="#notifications">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0"/></svg>
        Notifications
      </a>
    </nav>

    <!-- Main Content -->
    <div>

      <!-- Profile Section -->
      <div class="settings-section" id="profile">
        <div class="settings-section-title">Profile &amp; Personalization</div>

        <div class="profile-avatar-row">
          <div class="profile-avatar-wrap">
            <div class="profile-avatar-placeholder" data-user-avatar>🌿</div>
            <div class="profile-avatar-change" onclick="window.location='/onboard/step3.php'" title="Change avatar">📷</div>
          </div>
          <div style="font-size:0.8125rem;color:var(--color-text-muted);">
            <a href="/onboard/step3.php" style="color:var(--color-green);font-weight:600;">Choose preset avatar</a>
          </div>
        </div>

        <div style="display:grid;gap:14px;">
          <div class="form-group">
            <label class="form-label" for="settingsFullName">Full Name</label>
            <input class="form-input" type="text" id="settingsFullName" value="Alex Johnson" autocomplete="name">
          </div>
          <div class="form-group">
            <label class="form-label" for="settingsPreferred">Preferred Name (Displayed on Dashboard)</label>
            <input class="form-input" type="text" id="settingsPreferred" data-preferred-input value="Alex" autocomplete="nickname">
          </div>
        </div>
      </div>

      <!-- Accessibility Section -->
      <div class="settings-section" id="accessibility">
        <div class="settings-section-title">Accessibility</div>

        <!-- Dyslexic Font -->
        <div class="a11y-feature-card active" id="dyslexicCard">
          <div class="a11y-feature-header">
            <div class="a11y-feature-title">
              <span style="width:24px;height:24px;background:var(--color-blue-light);border-radius:6px;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:0.875rem;color:var(--color-blue);">A</span>
              Open Dyslexic Font
            </div>
            <label class="toggle-switch">
              <input type="checkbox" id="dyslexicToggle">
              <div class="toggle-switch__track"></div>
            </label>
          </div>
          <p style="font-size:0.8125rem;color:var(--color-text-secondary);margin-bottom:8px;">
            Enhances readability for users with dyslexia by using unique letter shapes.
          </p>
          <div class="a11y-font-preview">
            "The quick brown fox jumps over the lazy dog." This is a preview of how your text will look.
          </div>
        </div>

        <!-- Color Theme -->
        <div class="a11y-feature-card active-yellow">
          <div class="a11y-feature-header">
            <div class="a11y-feature-title">
              <span style="width:24px;height:24px;background:var(--color-orange-light);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:0.875rem;">🌓</span>
              Color Theme
            </div>
          </div>
          <p style="font-size:0.8125rem;color:var(--color-text-secondary);margin-bottom:12px;">
            Switch between light and dark modes to reduce eye strain.
          </p>
          <div class="theme-btn-group">
            <button class="theme-btn active" data-theme-choice="light">
              ☀️ Light
            </button>
            <button class="theme-btn" data-theme-choice="dark">
              🌙 Dark
            </button>
          </div>
        </div>
      </div>

      <!-- Learning Style -->
      <div class="settings-section" id="learning">
        <div class="settings-section-title">Learning Focus</div>

        <p style="font-size:0.875rem;color:var(--color-text-secondary);margin-bottom:16px;">
          Select your primary focus to help us tailor the dashboard experience to your needs.
        </p>

        <div class="style-grid" style="grid-template-columns:1fr 1fr;">
          <div class="style-card selected" data-style-card="adhd" role="radio" tabindex="0">
            <div class="style-card__icon">⚡</div>
            <div class="style-card__title">ADHD Focus</div>
            <div class="style-card__desc">Emphasis on breaking tasks down, frequent breaks, and clear visual cues.</div>
          </div>
          <div class="style-card" data-style-card="dyslexia" role="radio" tabindex="0">
            <div class="style-card__icon">📚</div>
            <div class="style-card__title">Dyslexia Support</div>
            <div class="style-card__desc">Emphasis on readable fonts, audio options, and reduced text density.</div>
          </div>
        </div>

        <!-- Save footer (sticky) -->
        <div class="settings-save-footer">
          <div class="settings-unsaved" data-unsaved style="display:none;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
            Unsaved changes
          </div>
          <div style="display:flex;gap:12px;margin-left:auto;">
            <button class="btn btn-ghost btn-sm" data-cancel-settings>Cancel</button>
            <button class="btn btn-primary btn-sm" data-save-settings>Save Changes</button>
          </div>
        </div>
      </div>

      <!-- Notifications -->
      <div class="settings-section" id="notifications">
        <div class="settings-section-title">Notifications</div>

        <div class="settings-row">
          <div class="settings-row__info">
            <div class="settings-row__label">Break reminders</div>
            <div class="settings-row__desc">Remind me when it's time for a scheduled break</div>
          </div>
          <label class="toggle-switch">
            <input type="checkbox" checked>
            <div class="toggle-switch__track"></div>
          </label>
        </div>

        <div class="settings-row">
          <div class="settings-row__info">
            <div class="settings-row__label">Task completions</div>
            <div class="settings-row__desc">Celebrate when I finish a task</div>
          </div>
          <label class="toggle-switch">
            <input type="checkbox" checked>
            <div class="toggle-switch__track"></div>
          </label>
        </div>

        <div class="settings-row">
          <div class="settings-row__info">
            <div class="settings-row__label">Teacher messages</div>
            <div class="settings-row__desc">Notify me of messages from my teacher</div>
          </div>
          <label class="toggle-switch">
            <input type="checkbox" checked>
            <div class="toggle-switch__track"></div>
          </label>
        </div>

        <div class="settings-row">
          <div class="settings-row__info">
            <div class="settings-row__label">Daily goal reminders</div>
            <div class="settings-row__desc">Remind me of my learning goal each morning</div>
          </div>
          <label class="toggle-switch">
            <input type="checkbox">
            <div class="toggle-switch__track"></div>
          </label>
        </div>

      </div>

    </div>
  </div>

</main>

<?php include 'includes/footer.php'; ?>
