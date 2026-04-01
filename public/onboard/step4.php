<?php
$pageTitle = 'How You Learn Best';
include __DIR__ . '/../../public/includes/bootstrap.php'; include BASE_PATH . '/includes/head.php';
include BASE_PATH . '/includes/nav-onboard.php';
?>

<main class="onboard-wrap fade-in">
  <div class="onboard-card" style="max-width:700px;">

    <button class="onboard-close" onclick="window.location='/index.php'" aria-label="Skip setup">×</button>

    <div class="onboard-step-header">
      <div class="onboard-step-badge">4</div>
      <div class="onboard-step-label">Step 4 of 5</div>
    </div>

    <h1 class="onboard-title">How do you learn best?</h1>
    <p class="onboard-subtitle">
      Select your primary learning style to help us personalize your dashboard experience.
    </p>

    <div class="style-grid">
      <div class="style-card" data-style-card="adhd" role="radio" tabindex="0">
        <div class="style-card__icon">⚡</div>
        <div class="style-card__title">ADHD</div>
        <div class="style-card__desc">I prefer short bursts of focus with frequent breaks and highly visual task management.</div>
      </div>

      <div class="style-card" data-style-card="dyslexia" role="radio" tabindex="0">
        <div class="style-card__icon">📚</div>
        <div class="style-card__title">Dyslexia</div>
        <div class="style-card__desc">I benefit from specialized fonts, clear spacing, and audio-assisted reading options.</div>
      </div>

      <div class="style-card" data-style-card="general" role="radio" tabindex="0">
        <div class="style-card__icon">🧠</div>
        <div class="style-card__title">General Focus</div>
        <div class="style-card__desc">I just need a clean, distraction-free environment to organize my tasks and thoughts.</div>
      </div>
    </div>

    <div class="onboard-footer">
      <a href="/onboard/step3.php" class="onboard-back">← Back</a>
      <button
        class="btn btn-primary"
        data-next-btn
        disabled
        onclick="window.location='/onboard/step5.php'"
      >
        Next Step →
      </button>
    </div>

  </div>

</main>

<?php include BASE_PATH . '/includes/footer.php'; ?>
