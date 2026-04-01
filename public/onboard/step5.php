<?php
$pageTitle = "You're All Set!";
include __DIR__ . '/../../public/includes/bootstrap.php'; include BASE_PATH . '/includes/head.php';
include BASE_PATH . '/includes/nav-onboard.php';
?>

<main class="onboard-wrap fade-in">
  <div class="onboard-card" style="max-width:560px;text-align:center;">

    <div class="onboard-step-header" style="justify-content:center;">
      <div class="onboard-step-badge">5</div>
      <div class="onboard-step-label">Step 5 of 5</div>
    </div>

    <!-- Avatar display — populated by JS from session state -->
    <div class="finish-avatar" id="finishAvatar">
      <div class="avatar-circle" style="width:90px;height:90px;background:var(--color-border);border-radius:50%;font-size:2.5rem;display:flex;align-items:center;justify-content:center;border:3px solid var(--color-border-md);margin:0 auto;">
        🌿
      </div>
      <div class="finish-avatar__badge">✓</div>
    </div>

    <h1 class="finish-title" style="margin-top:16px;">
      You're all set, <span class="name" data-name>Alex</span>!
    </h1>
    <p class="finish-desc">
      Your dashboard is beautifully organized and personalized for your focus style.
      We've set up a calm, sensory-friendly space just for you.
    </p>

    <div class="finish-reassurance">
      <div class="finish-reassurance-card">
        <div class="finish-reassurance-card__icon">🛡️</div>
        <div>
          <div class="finish-reassurance-card__title">Safe Space</div>
          <div class="finish-reassurance-card__desc">No pressure, no clutter. Just your tasks, at your own pace.</div>
        </div>
      </div>
      <div class="finish-reassurance-card">
        <div class="finish-reassurance-card__icon">⚙️</div>
        <div>
          <div class="finish-reassurance-card__title">Always Adaptable</div>
          <div class="finish-reassurance-card__desc">Adjust fonts, themes, and layouts anytime from settings.</div>
        </div>
      </div>
    </div>

    <div class="onboard-footer" style="justify-content:space-between;">
      <a href="/onboard/step4.php" class="onboard-back">← Back</a>
      <a href="/home.php" class="btn btn-primary btn-lg">
        Start Learning 🚀
      </a>
    </div>

  </div>
</main>

<script>
// Render the chosen avatar on this page
document.addEventListener('DOMContentLoaded', () => {
  const avatar = JSON.parse(sessionStorage.getItem('levelai_avatar') || 'null');
  if (avatar) {
    document.getElementById('finishAvatar').querySelector('.avatar-circle').innerHTML =
      `<span style="font-size:2.5rem;">${avatar.emoji}</span>`;
    document.getElementById('finishAvatar').querySelector('.avatar-circle').style.background = avatar.bg;
  }
});
</script>

<?php include BASE_PATH . '/includes/footer.php'; ?>
