<?php
$pageTitle   = 'Students';
$currentPage = 'students';
include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/nav-teacher.php';
?>

<main class="page-wrapper page-wrapper--full fade-in">

  <!-- Page Header -->
  <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:28px;">
    <div>
      <h1 class="page-title">Students</h1>
      <p class="page-subtitle" style="margin-bottom:0;">Period 3 &mdash; 12 students enrolled</p>
    </div>
    <div style="display:flex;gap:8px;margin-top:6px;">
      <button class="btn btn-outline">Export Report</button>
      <button class="btn btn-primary" style="background:var(--color-blue);border-color:var(--color-blue);">+ Add Student</button>
    </div>
  </div>

  <!-- Student Cards Grid -->
  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(340px,1fr));gap:20px;">

    <!-- Alex Chen -->
    <div class="card" style="padding:20px;">
      <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
        <div style="width:44px;height:44px;border-radius:var(--radius-full);background:var(--color-green-light);display:flex;align-items:center;justify-content:center;font-size:1.25rem;">😊</div>
        <div style="flex:1;">
          <div style="font-weight:700;font-size:0.9375rem;">Alex Chen</div>
          <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Learning style: ADHD</div>
        </div>
        <span style="padding:2px 10px;border-radius:var(--radius-full);font-size:0.75rem;font-weight:600;background:var(--color-green-light);color:var(--color-green);">Active</span>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:14px;">
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">82%</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Completion</div>
        </div>
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">1.4</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Breaks/Day</div>
        </div>
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">3.2h</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Avg/Day</div>
        </div>
      </div>
      <div style="font-size:0.8125rem;color:var(--color-text-secondary);margin-bottom:10px;">Current: Algebra &mdash; Linear Equations (75%)</div>
      <div class="progress-bar-wrap"><div class="progress-bar" style="width:75%;"></div></div>
      <div style="display:flex;gap:8px;margin-top:14px;">
        <button class="btn btn-outline btn-sm" style="flex:1;">View Details</button>
        <button class="btn btn-ghost btn-sm">Send Break</button>
      </div>
    </div>

    <!-- Maya Johnson -->
    <div class="card" style="padding:20px;">
      <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
        <div style="width:44px;height:44px;border-radius:var(--radius-full);background:var(--color-purple-light);display:flex;align-items:center;justify-content:center;font-size:1.25rem;">🎨</div>
        <div style="flex:1;">
          <div style="font-weight:700;font-size:0.9375rem;">Maya Johnson</div>
          <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Learning style: Dyslexia</div>
        </div>
        <span style="padding:2px 10px;border-radius:var(--radius-full);font-size:0.75rem;font-weight:600;background:var(--color-green-light);color:var(--color-green);">On Track</span>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:14px;">
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">95%</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Completion</div>
        </div>
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">0.8</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Breaks/Day</div>
        </div>
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">3.8h</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Avg/Day</div>
        </div>
      </div>
      <div style="font-size:0.8125rem;color:var(--color-text-secondary);margin-bottom:10px;">Current: Reading &mdash; Chapter 4 Review (100%)</div>
      <div class="progress-bar-wrap"><div class="progress-bar" style="width:100%;"></div></div>
      <div style="display:flex;gap:8px;margin-top:14px;">
        <button class="btn btn-outline btn-sm" style="flex:1;">View Details</button>
        <button class="btn btn-ghost btn-sm">Send Break</button>
      </div>
    </div>

    <!-- Jordan Williams -->
    <div class="card" style="padding:20px;">
      <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
        <div style="width:44px;height:44px;border-radius:var(--radius-full);background:var(--color-orange-light);display:flex;align-items:center;justify-content:center;font-size:1.25rem;">🚀</div>
        <div style="flex:1;">
          <div style="font-weight:700;font-size:0.9375rem;">Jordan Williams</div>
          <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Learning style: ADHD</div>
        </div>
        <span style="padding:2px 10px;border-radius:var(--radius-full);font-size:0.75rem;font-weight:600;background:var(--color-orange-light);color:var(--color-orange);">Needs Help</span>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:14px;">
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">48%</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Completion</div>
        </div>
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">3.1</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Breaks/Day</div>
        </div>
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">2.1h</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Avg/Day</div>
        </div>
      </div>
      <div style="font-size:0.8125rem;color:var(--color-text-secondary);margin-bottom:10px;">Current: Science &mdash; Ecosystems (40%)</div>
      <div class="progress-bar-wrap"><div class="progress-bar" style="width:40%;"></div></div>
      <div style="display:flex;gap:8px;margin-top:14px;">
        <button class="btn btn-outline btn-sm" style="flex:1;">View Details</button>
        <button class="btn btn-ghost btn-sm">Send Break</button>
      </div>
    </div>

    <!-- Sam Patel -->
    <div class="card" style="padding:20px;">
      <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
        <div style="width:44px;height:44px;border-radius:var(--radius-full);background:var(--color-yellow-light);display:flex;align-items:center;justify-content:center;font-size:1.25rem;">🌟</div>
        <div style="flex:1;">
          <div style="font-weight:700;font-size:0.9375rem;">Sam Patel</div>
          <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Learning style: General Focus</div>
        </div>
        <span style="padding:2px 10px;border-radius:var(--radius-full);font-size:0.75rem;font-weight:600;background:var(--color-green-light);color:var(--color-green);">Active</span>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:14px;">
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">74%</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Completion</div>
        </div>
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">1.2</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Breaks/Day</div>
        </div>
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">3.0h</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Avg/Day</div>
        </div>
      </div>
      <div style="font-size:0.8125rem;color:var(--color-text-secondary);margin-bottom:10px;">Current: Writing &mdash; Essay Draft (60%)</div>
      <div class="progress-bar-wrap"><div class="progress-bar" style="width:60%;"></div></div>
      <div style="display:flex;gap:8px;margin-top:14px;">
        <button class="btn btn-outline btn-sm" style="flex:1;">View Details</button>
        <button class="btn btn-ghost btn-sm">Send Break</button>
      </div>
    </div>

    <!-- Lily Okafor -->
    <div class="card" style="padding:20px;">
      <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
        <div style="width:44px;height:44px;border-radius:var(--radius-full);background:var(--color-blue-light);display:flex;align-items:center;justify-content:center;font-size:1.25rem;">🎵</div>
        <div style="flex:1;">
          <div style="font-weight:700;font-size:0.9375rem;">Lily Okafor</div>
          <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Learning style: Dyslexia</div>
        </div>
        <span style="padding:2px 10px;border-radius:var(--radius-full);font-size:0.75rem;font-weight:600;background:var(--color-blue-light);color:var(--color-blue);">On Break</span>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:14px;">
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">67%</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Completion</div>
        </div>
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">2.3</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Breaks/Day</div>
        </div>
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">2.8h</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Avg/Day</div>
        </div>
      </div>
      <div style="font-size:0.8125rem;color:var(--color-text-secondary);margin-bottom:10px;">Current: Math &mdash; Fractions Review (50%)</div>
      <div class="progress-bar-wrap"><div class="progress-bar" style="width:50%;"></div></div>
      <div style="display:flex;gap:8px;margin-top:14px;">
        <button class="btn btn-outline btn-sm" style="flex:1;">View Details</button>
        <button class="btn btn-ghost btn-sm">Send Break</button>
      </div>
    </div>

    <!-- Ethan Morales -->
    <div class="card" style="padding:20px;">
      <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
        <div style="width:44px;height:44px;border-radius:var(--radius-full);background:var(--color-green-light);display:flex;align-items:center;justify-content:center;font-size:1.25rem;">⚡</div>
        <div style="flex:1;">
          <div style="font-weight:700;font-size:0.9375rem;">Ethan Morales</div>
          <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Learning style: ADHD</div>
        </div>
        <span style="padding:2px 10px;border-radius:var(--radius-full);font-size:0.75rem;font-weight:600;background:var(--color-green-light);color:var(--color-green);">On Track</span>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:14px;">
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">91%</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Completion</div>
        </div>
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">0.6</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Breaks/Day</div>
        </div>
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">3.5h</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Avg/Day</div>
        </div>
      </div>
      <div style="font-size:0.8125rem;color:var(--color-text-secondary);margin-bottom:10px;">Current: Math &mdash; Fractions Review (90%)</div>
      <div class="progress-bar-wrap"><div class="progress-bar" style="width:90%;"></div></div>
      <div style="display:flex;gap:8px;margin-top:14px;">
        <button class="btn btn-outline btn-sm" style="flex:1;">View Details</button>
        <button class="btn btn-ghost btn-sm">Send Break</button>
      </div>
    </div>

    <!-- Ava Thompson -->
    <div class="card" style="padding:20px;">
      <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
        <div style="width:44px;height:44px;border-radius:var(--radius-full);background:var(--color-orange-light);display:flex;align-items:center;justify-content:center;font-size:1.25rem;">🌻</div>
        <div style="flex:1;">
          <div style="font-weight:700;font-size:0.9375rem;">Ava Thompson</div>
          <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Learning style: Dyslexia</div>
        </div>
        <span style="padding:2px 10px;border-radius:var(--radius-full);font-size:0.75rem;font-weight:600;background:var(--color-orange-light);color:var(--color-orange);">Needs Help</span>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:14px;">
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">38%</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Completion</div>
        </div>
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">3.8</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Breaks/Day</div>
        </div>
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">1.9h</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Avg/Day</div>
        </div>
      </div>
      <div style="font-size:0.8125rem;color:var(--color-text-secondary);margin-bottom:10px;">Current: Reading &mdash; Vocabulary (25%)</div>
      <div class="progress-bar-wrap"><div class="progress-bar" style="width:25%;"></div></div>
      <div style="display:flex;gap:8px;margin-top:14px;">
        <button class="btn btn-outline btn-sm" style="flex:1;">View Details</button>
        <button class="btn btn-ghost btn-sm">Send Break</button>
      </div>
    </div>

    <!-- Noah Kim -->
    <div class="card" style="padding:20px;">
      <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
        <div style="width:44px;height:44px;border-radius:var(--radius-full);background:var(--color-green-light);display:flex;align-items:center;justify-content:center;font-size:1.25rem;">🎮</div>
        <div style="flex:1;">
          <div style="font-weight:700;font-size:0.9375rem;">Noah Kim</div>
          <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Learning style: General Focus</div>
        </div>
        <span style="padding:2px 10px;border-radius:var(--radius-full);font-size:0.75rem;font-weight:600;background:var(--color-green-light);color:var(--color-green);">Active</span>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:14px;">
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">71%</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Completion</div>
        </div>
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">1.0</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Breaks/Day</div>
        </div>
        <div style="text-align:center;padding:10px;background:var(--color-bg);border-radius:var(--radius-sm);">
          <div style="font-weight:700;font-size:1.125rem;">3.1h</div>
          <div style="font-size:0.6875rem;color:var(--color-text-muted);">Avg/Day</div>
        </div>
      </div>
      <div style="font-size:0.8125rem;color:var(--color-text-secondary);margin-bottom:10px;">Current: Science &mdash; Lab Report (55%)</div>
      <div class="progress-bar-wrap"><div class="progress-bar" style="width:55%;"></div></div>
      <div style="display:flex;gap:8px;margin-top:14px;">
        <button class="btn btn-outline btn-sm" style="flex:1;">View Details</button>
        <button class="btn btn-ghost btn-sm">Send Break</button>
      </div>
    </div>

  </div>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
