<?php
$pageTitle    = 'Take a Break';
$currentPage  = 'break';
include 'includes/head.php';
include 'includes/nav-app.php';
?>

<main class="break-page fade-in">

  <div class="break-hero">
    <div class="break-hero__icon">🌿</div>
    <h1 class="break-hero__title">Time to Unwind</h1>
    <p class="break-hero__desc">
      You've earned a break. Choose a quick activity to reset your mind and body.
    </p>
  </div>

  <div class="break-grid">

    <div class="break-option" data-break-option>
      <div class="break-option__icon" style="background:var(--color-blue-light);">
        <span style="font-size:1.75rem;">⬛</span>
      </div>
      <div class="break-option__title">Box Breathing</div>
      <div class="break-option__desc">4 sec in, hold, out, hold</div>
    </div>

    <div class="break-option" data-break-option>
      <div class="break-option__icon" style="background:var(--color-blue-light);">
        <span style="font-size:1.75rem;">💨</span>
      </div>
      <div class="break-option__title">4-7-8 Breathing</div>
      <div class="break-option__desc">4 sec in, 7 hold, 8 out</div>
    </div>

    <div class="break-option" data-break-option>
      <div class="break-option__icon" style="background:var(--color-purple-light);">
        <span style="font-size:1.75rem;">👁️</span>
      </div>
      <div class="break-option__title">Eye Tracking</div>
      <div class="break-option__desc">Focus on slow moving target</div>
    </div>

    <div class="break-option" data-break-option>
      <div class="break-option__icon" style="background:var(--color-green-light);">
        <span style="font-size:1.75rem;">🚶</span>
      </div>
      <div class="break-option__title">Balance Movements</div>
      <div class="break-option__desc">Standing exercises</div>
    </div>

    <div class="break-option" data-break-option>
      <div class="break-option__icon" style="background:var(--color-purple-light);">
        <span style="font-size:1.75rem;">🌙</span>
      </div>
      <div class="break-option__title">Quiet Space</div>
      <div class="break-option__desc">Dim screen, low noise</div>
    </div>

  </div>

  <div class="break-return">
    <a href="/home.php" class="btn btn-outline btn-lg" style="border-radius:var(--radius-full);">
      ← Return to Dashboard
    </a>
  </div>

</main>

<?php include 'includes/footer.php'; ?>
