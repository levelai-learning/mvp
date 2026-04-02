<?php
// Teacher navigation
$currentPage = $currentPage ?? '';
?>
<nav class="topnav topnav--teacher">
  <a href="/teacher/dashboard.php" class="topnav__logo">
    <div class="topnav__logo-mark">🌿</div>
    <span>LevelAI</span>
  </a>

  <div class="topnav__nav">
    <a href="/teacher/dashboard.php" class="<?= $currentPage === 'dashboard' ? 'active' : '' ?>">Classroom</a>
    <a href="/teacher/students.php" class="<?= $currentPage === 'students'  ? 'active' : '' ?>">Students</a>
    <a href="/teacher/lessons.php"  class="<?= $currentPage === 'lessons'   ? 'active' : '' ?>">Lessons</a>
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
        <div class="topnav__user-name">Ms. Rivera</div>
        <div class="topnav__user-role">Teacher</div>
      </div>
      <div class="topnav__avatar-placeholder">👩‍🏫</div>
    </div>
  </div>
</nav>
