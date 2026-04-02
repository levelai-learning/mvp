<?php
$pageTitle   = 'Settings';
$currentPage = 'settings';
include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/nav-parent.php';
?>

<main class="page-wrapper fade-in" style="max-width:860px;">

  <h1 class="page-title" style="margin-bottom:28px;">Settings</h1>

  <!-- Profile Section -->
  <div class="card" style="padding:24px;margin-bottom:20px;">
    <h2 style="font-size:1.0625rem;font-weight:700;margin:0 0 16px 0;">Profile</h2>
    <div style="display:flex;align-items:center;gap:16px;margin-bottom:20px;">
      <div style="width:56px;height:56px;border-radius:var(--radius-full);background:var(--color-purple-light);display:flex;align-items:center;justify-content:center;font-size:1.5rem;">👨</div>
      <div>
        <div style="font-weight:700;font-size:1rem;">David Chen</div>
        <div style="font-size:0.8125rem;color:var(--color-text-secondary);">david.chen@email.com</div>
      </div>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
      <div class="form-group">
        <label class="form-label">First Name</label>
        <input type="text" class="form-input" value="David">
      </div>
      <div class="form-group">
        <label class="form-label">Last Name</label>
        <input type="text" class="form-input" value="Chen">
      </div>
      <div class="form-group" style="grid-column:span 2;">
        <label class="form-label">Email</label>
        <input type="email" class="form-input" value="david.chen@email.com">
      </div>
    </div>
  </div>

  <!-- Linked Children -->
  <div class="card" style="padding:24px;margin-bottom:20px;">
    <h2 style="font-size:1.0625rem;font-weight:700;margin:0 0 16px 0;">Linked Children</h2>
    <div style="padding:14px 16px;border:1px solid var(--color-border);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:space-between;">
      <div style="display:flex;align-items:center;gap:12px;">
        <div style="width:36px;height:36px;border-radius:var(--radius-full);background:var(--color-green-light);display:flex;align-items:center;justify-content:center;font-size:1rem;">😊</div>
        <div>
          <div style="font-weight:600;font-size:0.9375rem;">Alex Chen</div>
          <div style="font-size:0.8125rem;color:var(--color-text-secondary);">7th Grade &bull; Ms. Rivera's class</div>
        </div>
      </div>
      <span style="padding:2px 10px;border-radius:var(--radius-full);font-size:0.75rem;font-weight:600;background:var(--color-green-light);color:var(--color-green);">Linked</span>
    </div>
    <button class="btn btn-outline btn-sm" style="margin-top:12px;">+ Link Another Child</button>
  </div>

  <!-- Notification Preferences -->
  <div class="card" style="padding:24px;margin-bottom:20px;">
    <h2 style="font-size:1.0625rem;font-weight:700;margin:0 0 16px 0;">Notification Preferences</h2>
    <div style="display:flex;flex-direction:column;gap:0;">

      <div style="display:flex;justify-content:space-between;align-items:center;padding:14px 0;border-bottom:1px solid var(--color-border);">
        <div>
          <div style="font-weight:600;font-size:0.9375rem;">Daily Progress Summary</div>
          <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Receive a summary of your child's progress each evening</div>
        </div>
        <label class="toggle-switch">
          <input type="checkbox" checked>
          <div class="toggle-switch__track"><div class="toggle-switch__thumb"></div></div>
        </label>
      </div>

      <div style="display:flex;justify-content:space-between;align-items:center;padding:14px 0;border-bottom:1px solid var(--color-border);">
        <div>
          <div style="font-weight:600;font-size:0.9375rem;">Break Alerts</div>
          <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Get notified when your child takes more than 3 breaks in a day</div>
        </div>
        <label class="toggle-switch">
          <input type="checkbox" checked>
          <div class="toggle-switch__track"><div class="toggle-switch__thumb"></div></div>
        </label>
      </div>

      <div style="display:flex;justify-content:space-between;align-items:center;padding:14px 0;border-bottom:1px solid var(--color-border);">
        <div>
          <div style="font-weight:600;font-size:0.9375rem;">Teacher Messages</div>
          <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Receive an alert when Ms. Rivera sends a message</div>
        </div>
        <label class="toggle-switch">
          <input type="checkbox" checked>
          <div class="toggle-switch__track"><div class="toggle-switch__thumb"></div></div>
        </label>
      </div>

      <div style="display:flex;justify-content:space-between;align-items:center;padding:14px 0;border-bottom:1px solid var(--color-border);">
        <div>
          <div style="font-weight:600;font-size:0.9375rem;">Lesson Completion</div>
          <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Get notified when your child completes a lesson</div>
        </div>
        <label class="toggle-switch">
          <input type="checkbox">
          <div class="toggle-switch__track"><div class="toggle-switch__thumb"></div></div>
        </label>
      </div>

      <div style="display:flex;justify-content:space-between;align-items:center;padding:14px 0;">
        <div>
          <div style="font-weight:600;font-size:0.9375rem;">Weekly Report Email</div>
          <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Receive a detailed weekly summary every Sunday evening</div>
        </div>
        <label class="toggle-switch">
          <input type="checkbox">
          <div class="toggle-switch__track"><div class="toggle-switch__thumb"></div></div>
        </label>
      </div>

    </div>
  </div>

  <!-- Privacy & Consent -->
  <div class="card" style="padding:24px;margin-bottom:20px;">
    <h2 style="font-size:1.0625rem;font-weight:700;margin:0 0 16px 0;">Privacy &amp; Consent</h2>
    <div style="display:flex;flex-direction:column;gap:12px;">
      <div style="padding:14px 16px;background:var(--color-green-light);border-radius:var(--radius-md);display:flex;align-items:center;gap:10px;">
        <span style="font-size:1.125rem;">&#10003;</span>
        <div>
          <div style="font-weight:600;font-size:0.875rem;color:var(--color-green);">COPPA Consent Provided</div>
          <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Consent granted on Mar 15, 2026 for Alex Chen</div>
        </div>
      </div>
      <div style="font-size:0.8125rem;color:var(--color-text-secondary);padding:0 4px;">
        Your child's data is protected under COPPA and FERPA guidelines. Only you, Alex's teacher, and authorized school administrators can access their learning data.
      </div>
      <div style="display:flex;gap:8px;">
        <button class="btn btn-outline btn-sm">Download My Data</button>
        <button class="btn btn-ghost btn-sm" style="color:var(--color-red);">Revoke Consent</button>
      </div>
    </div>
  </div>

  <!-- Save Footer -->
  <div style="display:flex;justify-content:flex-end;gap:8px;padding:16px 0;">
    <button class="btn btn-outline">Cancel</button>
    <button class="btn btn-primary" style="background:var(--color-purple);border-color:var(--color-purple);">Save Changes</button>
  </div>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
