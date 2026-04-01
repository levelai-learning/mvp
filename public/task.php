<?php
$pageTitle    = 'Algebra: Linear Equations';
$currentPage  = 'tasks';
include 'includes/head.php';
include 'includes/nav-app.php';

$totalSecs = 45 * 60;
$circum    = round(2 * M_PI * 72, 2);
?>

<main class="page-wrapper fade-in" style="max-width:760px;">

  <!-- Task header -->
  <div class="task-header">
    <a href="/home.php" class="task-back">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
      Back to Tasks
    </a>
    <div class="task-subject-badge">
      🔢 Math
    </div>
  </div>

  <!-- Focus card -->
  <div class="task-focus-card">
    <h1 class="task-focus-card__title">Algebra: Linear Equations</h1>
    <p class="task-focus-card__desc">
      Complete the practice worksheet and review the video lesson on solving for x. Focus on isolating the variable.
    </p>

    <!-- Timer Ring -->
    <div class="timer-ring">
      <svg width="160" height="160" viewBox="0 0 160 160">
        <circle cx="80" cy="80" r="72" fill="none" stroke="var(--color-border)" stroke-width="8"/>
        <circle
          cx="80" cy="80" r="72"
          fill="none"
          stroke="var(--color-green)"
          stroke-width="8"
          stroke-linecap="round"
          stroke-dasharray="<?= $circum ?>"
          stroke-dashoffset="0"
          data-timer-ring
          style="transition:stroke-dashoffset 1s linear;"
        />
      </svg>
      <div class="timer-ring__label">
        <div class="timer-ring__time" data-timer>45:00</div>
        <div class="timer-ring__sub">Remaining</div>
      </div>
    </div>

    <div class="task-actions">
      <button class="btn btn-primary" data-timer-start style="min-width:160px;">
        ▶ Start Timer
      </button>
      <button class="btn btn-outline" data-complete-task>
        ✓ Complete
      </button>
    </div>
  </div>

  <!-- Checklist -->
  <div class="checklist-card">
    <div class="checklist-header">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-text-secondary)" stroke-width="2">
        <polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
      </svg>
      Task Steps
    </div>

    <div class="checklist-item checked" data-checklist-item>
      <div class="checklist-checkbox">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
          <polyline points="20 6 9 17 4 12"/>
        </svg>
      </div>
      <span class="checklist-label">Watch introductory video</span>
    </div>

    <div class="checklist-item active" data-checklist-item>
      <div class="checklist-checkbox"></div>
      <span class="checklist-label">Complete worksheet problems 1–10</span>
    </div>

    <div class="checklist-item" data-checklist-item>
      <div class="checklist-checkbox"></div>
      <span class="checklist-label">Check answers with key</span>
    </div>

  </div>

</main>

<?php include 'includes/footer.php'; ?>
