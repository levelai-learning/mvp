<?php
$pageTitle    = 'Schedule';
$currentPage  = 'schedule';
include 'includes/head.php';
include 'includes/nav-app.php';
?>

<main class="page-wrapper fade-in" style="max-width:860px;">

  <!-- Header -->
  <div class="schedule-header">
    <div>
      <h1 class="page-title">Your Schedule</h1>
      <p style="font-size:0.9375rem;color:var(--color-text-secondary);margin-top:4px;">
        Here's what your day looks like. Take it one step at a time.
      </p>
    </div>
    <div class="view-toggle" style="margin-top:6px;">
      <button class="active">Full Day</button>
      <button>Next Day</button>
    </div>
  </div>

  <!-- Currently Running Banner -->
  <div class="currently-running">
    <div class="currently-running__left">
      <div class="currently-running__icon">🕐</div>
      <div>
        <div class="currently-running__title">Currently Running</div>
        <div class="currently-running__sub">Morning Focus Block · Ends in 45m</div>
      </div>
    </div>
    <a href="/task.php" class="btn btn-primary btn-sm">Resume Task</a>
  </div>

  <!-- Timeline -->
  <div class="timeline">

    <!-- 8:00 AM — Done -->
    <div class="timeline-item">
      <div class="timeline-time">
        <div class="timeline-time__hour">08:00 AM</div>
        <div class="timeline-time__duration">45 mins</div>
      </div>
      <div class="timeline-track">
        <div class="timeline-dot done"></div>
        <div class="timeline-line"></div>
      </div>
      <div class="timeline-content">
        <div class="timeline-block done">
          <div class="timeline-block__title">
            <span style="margin-right:6px;">📖</span> Morning Reading
          </div>
          <div class="timeline-block__desc">Chapter 4: Ecosystems</div>
        </div>
      </div>
    </div>

    <!-- 9:00 AM — Active -->
    <div class="timeline-item">
      <div class="timeline-time">
        <div class="timeline-time__hour active">09:00 AM</div>
        <div class="timeline-time__duration">90 mins</div>
      </div>
      <div class="timeline-track">
        <div class="timeline-dot active"></div>
        <div class="timeline-line"></div>
      </div>
      <div class="timeline-content">
        <div class="timeline-block active">
          <div class="timeline-block__badge badge-priority">🔵 High Priority</div>
          <div class="timeline-block__title">Math Focus</div>
          <div class="timeline-block__desc">Algebra: Linear Equations practice worksheet and video review.</div>
          <div class="timeline-block__footer">
            <span>2 of 3 tasks remaining</span>
            <a href="/task.php">View Tasks →</a>
          </div>
        </div>
      </div>
    </div>

    <!-- 10:30 AM — Break -->
    <div class="timeline-item">
      <div class="timeline-time">
        <div class="timeline-time__hour">10:30 AM</div>
        <div class="timeline-time__duration">15 mins</div>
      </div>
      <div class="timeline-track">
        <div class="timeline-dot break"></div>
        <div class="timeline-line"></div>
      </div>
      <div class="timeline-content">
        <div class="timeline-block break-block">
          <div class="timeline-block__title">🧘 Scheduled Break</div>
          <div class="timeline-block__desc">Time to stretch and grab water.</div>
        </div>
      </div>
    </div>

    <!-- 10:45 AM — Upcoming -->
    <div class="timeline-item">
      <div class="timeline-time">
        <div class="timeline-time__hour">10:45 AM</div>
        <div class="timeline-time__duration">60 mins</div>
      </div>
      <div class="timeline-track">
        <div class="timeline-dot"></div>
        <div class="timeline-line"></div>
      </div>
      <div class="timeline-content">
        <div class="timeline-block">
          <div class="timeline-block__title">🔬 Science Lab</div>
          <div class="timeline-block__desc">Review biology slides for tomorrow's quiz.</div>
        </div>
      </div>
    </div>

    <!-- 12:00 PM — Lunch -->
    <div class="timeline-item">
      <div class="timeline-time">
        <div class="timeline-time__hour">12:00 PM</div>
        <div class="timeline-time__duration">45 mins</div>
      </div>
      <div class="timeline-track">
        <div class="timeline-dot lunch"></div>
        <div class="timeline-line" style="display:none;"></div>
      </div>
      <div class="timeline-content">
        <div class="timeline-block lunch-block">
          <div class="timeline-block__title">🍽️ Lunch Time</div>
        </div>
      </div>
    </div>

  </div>

</main>

<?php include 'includes/footer.php'; ?>
