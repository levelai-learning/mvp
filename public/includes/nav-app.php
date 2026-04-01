<?php
// Full in-app navigation shown after onboarding
$currentPage = $currentPage ?? '';
?>
<nav class="topnav">
  <a href="/home.php" class="topnav__logo">
    <div class="topnav__logo-mark">🌿</div>
    <span>LevelAI</span>
  </a>

  <div class="topnav__nav">
    <a href="/home.php"     class="<?= $currentPage === 'home'     ? 'active' : '' ?>">Home</a>
    <a href="/task.php"     class="<?= $currentPage === 'tasks'    ? 'active' : '' ?>">Tasks</a>
    <a href="/schedule.php" class="<?= $currentPage === 'schedule' ? 'active' : '' ?>">Schedule</a>
    <a href="/settings.php" class="<?= $currentPage === 'settings' ? 'active' : '' ?>">Settings</a>
  </div>

  <div class="topnav__controls">
    <button class="topnav__font-btn" data-font-btn>Change Font to Open Dyslexic</button>

    <div class="theme-toggle">
      <span>Light</span>
      <div class="theme-toggle__track" data-theme-track>
        <div class="theme-toggle__thumb"></div>
      </div>
      <span>Dark</span>
    </div>

    <span class="topnav__datetime" data-clock></span>

    <a href="/break.php" class="btn-break <?= $currentPage === 'break' ? 'active' : '' ?>">
      <?= $currentPage === 'break' ? 'In Break Mode' : 'Need a break' ?>
    </a>

    <div class="topnav__user">
      <div class="topnav__user-info">
        <div class="topnav__user-name" data-name>Alex</div>
        <div class="topnav__user-role">Student</div>
      </div>
      <div class="topnav__avatar-placeholder" data-user-avatar>👤</div>
    </div>
  </div>
</nav>
