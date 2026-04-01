<?php
$pageTitle = 'Your Preferred Name';
include __DIR__ . '/../../public/includes/bootstrap.php'; include BASE_PATH . '/includes/head.php';
include BASE_PATH . '/includes/nav-onboard.php';
?>

<main class="onboard-wrap fade-in">
  <div class="onboard-card">

    <button class="onboard-close" onclick="window.location='/index.php'" aria-label="Skip setup">×</button>

    <div class="onboard-step-header">
      <div class="onboard-step-badge">2</div>
      <div class="onboard-step-label">Step 2 of 5</div>
    </div>

    <h1 class="onboard-title">What should we call you?</h1>
    <p class="onboard-subtitle">
      This is the name we'll use across your dashboard and notifications to make you feel at home.
    </p>

    <form data-step2-form>
      <div class="form-group" style="margin-bottom:12px;">
        <label class="form-label" for="preferredName">Preferred Name</label>
        <input
          class="form-input"
          type="text"
          id="preferredName"
          name="preferredName"
          placeholder="e.g. Alex, JJ, or your first name"
          autocomplete="nickname"
          required
        >
      </div>
      <p class="form-hint">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" style="color:var(--color-blue)">
          <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
        </svg>
        You can always change this later in settings.
      </p>

      <div class="onboard-footer">
        <a href="/onboard/step1.php" class="onboard-back">← Back</a>
        <button type="submit" class="btn btn-primary" data-next-btn disabled>
          Next Step →
        </button>
      </div>
    </form>

  </div>

  <div class="onboard-scroll-hint">
    <span>Complete form to continue</span>
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path d="M12 5v14M5 12l7 7 7-7"/>
    </svg>
  </div>
</main>

<?php include BASE_PATH . '/includes/footer.php'; ?>
