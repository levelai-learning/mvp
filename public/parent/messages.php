<?php
$pageTitle   = 'Messages';
$currentPage = 'messages';
include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/nav-parent.php';
?>

<main class="page-wrapper fade-in" style="max-width:860px;">

  <!-- Page Header -->
  <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:28px;">
    <div>
      <h1 class="page-title">Messages</h1>
      <p class="page-subtitle" style="margin-bottom:0;">Conversation with Alex's teacher</p>
    </div>
    <button class="btn btn-primary" style="background:var(--color-purple);border-color:var(--color-purple);">+ New Message</button>
  </div>

  <!-- Conversation Thread -->
  <div class="card" style="padding:0;overflow:hidden;">

    <!-- Teacher info header -->
    <div style="padding:16px 20px;border-bottom:1px solid var(--color-border);display:flex;align-items:center;gap:12px;background:var(--color-bg);">
      <div style="width:40px;height:40px;border-radius:var(--radius-full);background:var(--color-blue-light);display:flex;align-items:center;justify-content:center;font-size:1.125rem;">👩‍🏫</div>
      <div>
        <div style="font-weight:700;font-size:0.9375rem;">Ms. Rivera</div>
        <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Period 3 &mdash; 7th Grade ELA &amp; Math</div>
      </div>
    </div>

    <!-- Messages -->
    <div style="padding:20px;display:flex;flex-direction:column;gap:20px;">

      <!-- Teacher message -->
      <div style="display:flex;gap:10px;max-width:85%;">
        <div style="width:32px;height:32px;border-radius:var(--radius-full);background:var(--color-blue-light);display:flex;align-items:center;justify-content:center;font-size:0.875rem;flex-shrink:0;">👩‍🏫</div>
        <div>
          <div style="background:var(--color-bg);padding:12px 16px;border-radius:0 var(--radius-md) var(--radius-md) var(--radius-md);">
            <p style="font-size:0.875rem;margin:0;">Hi David! Just wanted to let you know that Alex has been doing really well in math this week. He finished the fractions unit ahead of schedule and his quiz score was excellent.</p>
          </div>
          <div style="font-size:0.75rem;color:var(--color-text-muted);margin-top:4px;">Ms. Rivera &bull; Mon, Mar 31 at 10:15 AM</div>
        </div>
      </div>

      <!-- Parent message -->
      <div style="display:flex;gap:10px;max-width:85%;margin-left:auto;flex-direction:row-reverse;">
        <div style="width:32px;height:32px;border-radius:var(--radius-full);background:var(--color-purple-light);display:flex;align-items:center;justify-content:center;font-size:0.875rem;flex-shrink:0;">👨</div>
        <div>
          <div style="background:var(--color-purple-light);padding:12px 16px;border-radius:var(--radius-md) 0 var(--radius-md) var(--radius-md);">
            <p style="font-size:0.875rem;margin:0;">That's great to hear! He's been excited about the math work. Is there anything we should focus on at home to keep the momentum going?</p>
          </div>
          <div style="font-size:0.75rem;color:var(--color-text-muted);margin-top:4px;text-align:right;">You &bull; Mon, Mar 31 at 12:42 PM</div>
        </div>
      </div>

      <!-- Teacher message -->
      <div style="display:flex;gap:10px;max-width:85%;">
        <div style="width:32px;height:32px;border-radius:var(--radius-full);background:var(--color-blue-light);display:flex;align-items:center;justify-content:center;font-size:0.875rem;flex-shrink:0;">👩‍🏫</div>
        <div>
          <div style="background:var(--color-bg);padding:12px 16px;border-radius:0 var(--radius-md) var(--radius-md) var(--radius-md);">
            <p style="font-size:0.875rem;margin:0;">The best thing is just encouraging him to take his time and use the break feature when he needs it. He sometimes rushes through reading assignments &mdash; if you notice him getting frustrated with the reading homework, remind him it's okay to pause.</p>
          </div>
          <div style="font-size:0.75rem;color:var(--color-text-muted);margin-top:4px;">Ms. Rivera &bull; Mon, Mar 31 at 2:08 PM</div>
        </div>
      </div>

      <!-- Parent message -->
      <div style="display:flex;gap:10px;max-width:85%;margin-left:auto;flex-direction:row-reverse;">
        <div style="width:32px;height:32px;border-radius:var(--radius-full);background:var(--color-purple-light);display:flex;align-items:center;justify-content:center;font-size:0.875rem;flex-shrink:0;">👨</div>
        <div>
          <div style="background:var(--color-purple-light);padding:12px 16px;border-radius:var(--radius-md) 0 var(--radius-md) var(--radius-md);">
            <p style="font-size:0.875rem;margin:0;">Good advice, will do. We've been practicing the breathing exercises at home too and he really likes them.</p>
          </div>
          <div style="font-size:0.75rem;color:var(--color-text-muted);margin-top:4px;text-align:right;">You &bull; Tue, Apr 1 at 8:30 AM</div>
        </div>
      </div>

      <!-- Teacher message (latest) -->
      <div style="display:flex;gap:10px;max-width:85%;">
        <div style="width:32px;height:32px;border-radius:var(--radius-full);background:var(--color-blue-light);display:flex;align-items:center;justify-content:center;font-size:0.875rem;flex-shrink:0;">👩‍🏫</div>
        <div>
          <div style="background:var(--color-bg);padding:12px 16px;border-radius:0 var(--radius-md) var(--radius-md) var(--radius-md);">
            <p style="font-size:0.875rem;margin:0;">Alex did great on today's algebra lesson! He's been really focused this week. Heads up: we're starting a new science unit next week. The reading assignments will be a bit longer, so the break reminders will be especially helpful.</p>
          </div>
          <div style="font-size:0.75rem;color:var(--color-text-muted);margin-top:4px;">Ms. Rivera &bull; Today at 2:30 PM</div>
        </div>
      </div>

    </div>

    <!-- Compose -->
    <div style="padding:16px 20px;border-top:1px solid var(--color-border);display:flex;gap:10px;background:var(--color-surface);">
      <input type="text" class="form-input" placeholder="Type a message..." style="flex:1;margin:0;">
      <button class="btn btn-primary" style="background:var(--color-purple);border-color:var(--color-purple);white-space:nowrap;">Send</button>
    </div>

  </div>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
