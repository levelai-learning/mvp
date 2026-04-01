<?php
$pageTitle = 'Choose Your Avatar';
include __DIR__ . '/../../public/includes/bootstrap.php'; include BASE_PATH . '/includes/head.php';
include BASE_PATH . '/includes/nav-onboard.php';

// Avatar options: emoji + background color
$avatars = [
  ['emoji' => '🐱', 'bg' => '#A855F7', 'label' => 'Purple Cat'],
  ['emoji' => '🐟', 'bg' => '#3B82F6', 'label' => 'Blue Fish'],
  ['emoji' => '🐿️', 'bg' => '#22C55E', 'label' => 'Green Squirrel'],
  ['emoji' => '💙', 'bg' => '#EC4899', 'label' => 'Pink Heart'],
  ['emoji' => '⭐', 'bg' => '#EAB308', 'label' => 'Gold Star'],
  ['emoji' => '🚀', 'bg' => '#14B8A6', 'label' => 'Teal Rocket'],
  ['emoji' => '🔥', 'bg' => '#EF4444', 'label' => 'Red Flame'],
  ['emoji' => '🌙', 'bg' => '#6366F1', 'label' => 'Indigo Moon'],
  ['emoji' => '🌊', 'bg' => '#0EA5E9', 'label' => 'Sky Wave'],
];
?>

<main class="onboard-wrap fade-in">
  <div class="onboard-card" style="max-width:600px;">

    <button class="onboard-close" onclick="window.location='/index.php'" aria-label="Skip setup">×</button>

    <div class="onboard-step-header">
      <div class="onboard-step-badge">3</div>
      <div class="onboard-step-label">Step 3 of 5</div>
    </div>

    <h1 class="onboard-title">Choose your avatar</h1>
    <p class="onboard-subtitle">Pick a friendly face to personalize your dashboard.</p>

    <div class="avatar-grid" style="margin-bottom:16px;">
      <!-- Upload option -->
      <div class="avatar-option avatar-upload" style="aspect-ratio:1;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z"/>
          <circle cx="12" cy="13" r="4"/>
        </svg>
        <span>Upload</span>
      </div>

      <?php foreach ($avatars as $av): ?>
        <div
          class="avatar-option"
          data-avatar-option
          data-emoji="<?= $av['emoji'] ?>"
          data-bg="<?= $av['bg'] ?>"
          aria-label="<?= $av['label'] ?>"
          role="radio"
        >
          <div class="avatar-circle" style="background:<?= $av['bg'] ?>;">
            <span style="font-size:1.5rem;"><?= $av['emoji'] ?></span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="onboard-footer">
      <a href="/onboard/step2.php" class="onboard-back">← Back</a>
      <button
        class="btn btn-primary"
        data-next-btn
        disabled
        onclick="window.location='/onboard/step4.php'"
      >
        Next Step →
      </button>
    </div>

  </div>

</main>

<?php include BASE_PATH . '/includes/footer.php'; ?>
