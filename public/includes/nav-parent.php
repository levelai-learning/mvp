<?php
// Parent navigation
$currentPage = $currentPage ?? '';
?>
<nav class="topnav topnav--parent">
  <a href="/parent/dashboard.php" class="topnav__logo">
    <div class="topnav__logo-mark">🌿</div>
    <span>LevelAI</span>
  </a>

  <div class="topnav__nav">
    <a href="/parent/dashboard.php" class="<?= $currentPage === 'dashboard' ? 'active' : '' ?>">Overview</a>
    <a href="/parent/messages.php"  class="<?= $currentPage === 'messages'  ? 'active' : '' ?>">Messages</a>
    <a href="/parent/settings.php"  class="<?= $currentPage === 'settings'  ? 'active' : '' ?>">Settings</a>
  </div>

  <div class="topnav__controls">
    <div class="theme-toggle">
      <span>Light</span>
      <div class="theme-toggle__track" data-theme-track>
        <div class="theme-toggle__thumb"></div>
      </div>
      <span>Dark</span>
    </div>

    <span class="topnav__datetime" data-clock></span>

    <div class="topnav__user">
      <div class="topnav__user-info">
        <div class="topnav__user-name">David Chen</div>
        <div class="topnav__user-role">Parent</div>
      </div>
      <div class="topnav__avatar-placeholder">👨</div>
    </div>
  </div>
</nav>
