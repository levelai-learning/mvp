<?php
$pageTitle    = 'Home';
$currentPage  = 'home';
include 'includes/head.php';
include 'includes/nav-app.php';
?>

<main class="page-wrapper page-wrapper--full fade-in">

  <!-- Page Header -->
  <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:28px;">
    <div>
      <h1 class="page-title">
        <span data-greeting>Good morning</span>, <span data-name>Alex</span> 👋
      </h1>
      <p class="page-subtitle" style="margin-bottom:0;">Here's your learning plan for today.</p>
    </div>
    <div style="display:flex;gap:8px;margin-top:6px;">
      <div class="view-toggle">
        <button class="active">Full Day</button>
        <button>Next Day</button>
      </div>
    </div>
  </div>

  <!-- Dashboard Grid -->
  <div class="dashboard-grid">

    <!-- Left Column -->
    <div>

      <!-- Up Next Card -->
      <div class="up-next-card">
        <div style="flex:1;">
          <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
            <span class="up-next-badge">↑ Up Next</span>
            <span style="font-size:0.8125rem;color:var(--color-text-muted);display:flex;align-items:center;gap:4px;">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              Est. 45 mins
            </span>
          </div>
          <h2 class="up-next-card__title">Algebra: Linear Equations</h2>
          <p class="up-next-card__desc">
            Complete the practice worksheet and review the video lesson on solving for x.
          </p>
          <a href="/task.php" class="btn btn-primary">
            Start Task →
          </a>
        </div>

        <!-- Progress Ring -->
        <div class="progress-circle">
          <svg width="90" height="90" viewBox="0 0 90 90">
            <circle cx="45" cy="45" r="38" fill="none" stroke="var(--color-border)" stroke-width="7"/>
            <circle
              cx="45" cy="45" r="38"
              fill="none"
              stroke="var(--color-orange)"
              stroke-width="7"
              stroke-linecap="round"
              stroke-dasharray="<?= round(2 * M_PI * 38, 2) ?>"
              stroke-dashoffset="<?= round(2 * M_PI * 38 * 0.75, 2) ?>"
            />
          </svg>
          <div class="progress-circle__label">
            25%<br><span>Completed</span>
          </div>
        </div>
      </div>

      <!-- Timeline Schedule -->
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

      </div><!-- /timeline -->
    </div>

    <!-- Right Column -->
    <div>

      <!-- Subjects widget -->
      <div class="widget-card">
        <div class="widget-title">Subjects</div>
        <div class="subjects-grid">
          <div class="subject-card">
            <div class="subject-card__icon">📖</div>
            <div class="subject-card__name">Reading</div>
            <div class="subject-card__time">56 mins</div>
          </div>
          <div class="subject-card">
            <div class="subject-card__icon">🔬</div>
            <div class="subject-card__name">Science</div>
            <div class="subject-card__time">25 mins</div>
          </div>
          <div class="subject-card">
            <div class="subject-card__icon">🔢</div>
            <div class="subject-card__name">Math</div>
            <div class="subject-card__time">34 mins</div>
          </div>
          <div class="subject-card">
            <div class="subject-card__icon">✏️</div>
            <div class="subject-card__name">Writing</div>
            <div class="subject-card__time">76 mins</div>
          </div>
        </div>
      </div>

      <!-- Daily Goal widget -->
      <div class="widget-card">
        <div class="goal-icon">🎯</div>
        <div class="goal-text">Daily Learning Goal</div>
        <div class="goal-subtext">You've completed 40% of today's study target. Keep going!</div>
        <div class="progress-bar-wrap">
          <div class="progress-bar" style="width:40%;"></div>
        </div>
        <div class="progress-bar-labels">
          <span>0 hrs</span>
          <span>Goal: 4 hrs</span>
        </div>
      </div>

    </div>
  </div><!-- /dashboard-grid -->

</main>

<?php include 'includes/footer.php'; ?>
