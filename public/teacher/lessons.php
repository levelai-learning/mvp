<?php
$pageTitle   = 'Lessons';
$currentPage = 'lessons';
include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/nav-teacher.php';
?>

<main class="page-wrapper page-wrapper--full fade-in">

  <!-- Page Header -->
  <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:28px;">
    <div>
      <h1 class="page-title">Lessons</h1>
      <p class="page-subtitle" style="margin-bottom:0;">Manage and assign lessons to your classroom.</p>
    </div>
    <div style="display:flex;gap:8px;margin-top:6px;">
      <button class="btn btn-primary" style="background:var(--color-blue);border-color:var(--color-blue);">+ Create Lesson</button>
    </div>
  </div>

  <!-- Filters -->
  <div style="display:flex;gap:8px;margin-bottom:24px;">
    <div class="view-toggle">
      <button class="active">All Subjects</button>
      <button>Math</button>
      <button>Reading</button>
      <button>Science</button>
      <button>Writing</button>
    </div>
  </div>

  <!-- Lessons List -->
  <div style="display:flex;flex-direction:column;gap:16px;">

    <!-- Lesson 1: Active -->
    <div class="card" style="padding:0;overflow:hidden;">
      <div style="display:flex;">
        <div style="width:6px;background:var(--color-green);flex-shrink:0;"></div>
        <div style="padding:20px;flex:1;">
          <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;">
            <div>
              <div style="display:flex;align-items:center;gap:10px;margin-bottom:4px;">
                <h3 style="font-size:1.0625rem;font-weight:700;margin:0;">Algebra: Linear Equations</h3>
                <span style="padding:2px 10px;border-radius:var(--radius-full);font-size:0.6875rem;font-weight:600;background:var(--color-green-light);color:var(--color-green);">Active</span>
              </div>
              <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Math &bull; 3 steps &bull; Est. 45 mins</div>
            </div>
            <div style="display:flex;gap:8px;">
              <button class="btn btn-outline btn-sm">Edit</button>
              <button class="btn btn-ghost btn-sm">Assign</button>
            </div>
          </div>
          <p style="font-size:0.875rem;color:var(--color-text-secondary);margin:0 0 12px 0;">Students practice solving for x using one- and two-step linear equations. Includes a video walkthrough, guided worksheet, and self-check quiz.</p>
          <div style="display:flex;gap:24px;font-size:0.8125rem;">
            <span><strong>Assigned to:</strong> 8 students</span>
            <span><strong>Completed:</strong> 3 of 8</span>
            <span><strong>Avg time:</strong> 38 mins</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Lesson 2: Active -->
    <div class="card" style="padding:0;overflow:hidden;">
      <div style="display:flex;">
        <div style="width:6px;background:var(--color-green);flex-shrink:0;"></div>
        <div style="padding:20px;flex:1;">
          <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;">
            <div>
              <div style="display:flex;align-items:center;gap:10px;margin-bottom:4px;">
                <h3 style="font-size:1.0625rem;font-weight:700;margin:0;">Reading: Chapter 4 &mdash; Ecosystems</h3>
                <span style="padding:2px 10px;border-radius:var(--radius-full);font-size:0.6875rem;font-weight:600;background:var(--color-green-light);color:var(--color-green);">Active</span>
              </div>
              <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Reading &bull; 4 steps &bull; Est. 35 mins</div>
            </div>
            <div style="display:flex;gap:8px;">
              <button class="btn btn-outline btn-sm">Edit</button>
              <button class="btn btn-ghost btn-sm">Assign</button>
            </div>
          </div>
          <p style="font-size:0.875rem;color:var(--color-text-secondary);margin:0 0 12px 0;">Read Chapter 4, highlight key vocabulary, answer comprehension questions, and write a one-paragraph summary of the food web concept.</p>
          <div style="display:flex;gap:24px;font-size:0.8125rem;">
            <span><strong>Assigned to:</strong> 12 students</span>
            <span><strong>Completed:</strong> 7 of 12</span>
            <span><strong>Avg time:</strong> 32 mins</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Lesson 3: Scheduled -->
    <div class="card" style="padding:0;overflow:hidden;">
      <div style="display:flex;">
        <div style="width:6px;background:var(--color-blue);flex-shrink:0;"></div>
        <div style="padding:20px;flex:1;">
          <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;">
            <div>
              <div style="display:flex;align-items:center;gap:10px;margin-bottom:4px;">
                <h3 style="font-size:1.0625rem;font-weight:700;margin:0;">Science: Ecosystems Quiz</h3>
                <span style="padding:2px 10px;border-radius:var(--radius-full);font-size:0.6875rem;font-weight:600;background:var(--color-blue-light);color:var(--color-blue);">Scheduled</span>
              </div>
              <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Science &bull; 2 steps &bull; Est. 25 mins</div>
            </div>
            <div style="display:flex;gap:8px;">
              <button class="btn btn-outline btn-sm">Edit</button>
              <button class="btn btn-ghost btn-sm">Assign</button>
            </div>
          </div>
          <p style="font-size:0.875rem;color:var(--color-text-secondary);margin:0 0 12px 0;">10-question quiz on ecosystems vocabulary and food web diagrams, followed by a short reflection on what was challenging.</p>
          <div style="display:flex;gap:24px;font-size:0.8125rem;">
            <span><strong>Assigned to:</strong> 12 students</span>
            <span><strong>Starts:</strong> Tomorrow 10:45 AM</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Lesson 4: Draft -->
    <div class="card" style="padding:0;overflow:hidden;">
      <div style="display:flex;">
        <div style="width:6px;background:var(--color-border-md);flex-shrink:0;"></div>
        <div style="padding:20px;flex:1;">
          <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;">
            <div>
              <div style="display:flex;align-items:center;gap:10px;margin-bottom:4px;">
                <h3 style="font-size:1.0625rem;font-weight:700;margin:0;">Writing: Persuasive Essay</h3>
                <span style="padding:2px 10px;border-radius:var(--radius-full);font-size:0.6875rem;font-weight:600;background:var(--color-bg);color:var(--color-text-muted);">Draft</span>
              </div>
              <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Writing &bull; 5 steps &bull; Est. 60 mins</div>
            </div>
            <div style="display:flex;gap:8px;">
              <button class="btn btn-outline btn-sm">Edit</button>
              <button class="btn btn-ghost btn-sm">Assign</button>
            </div>
          </div>
          <p style="font-size:0.875rem;color:var(--color-text-secondary);margin:0 0 12px 0;">Step-by-step persuasive essay: choose a topic, brainstorm arguments, write an outline, draft the essay, and self-review using a checklist.</p>
          <div style="display:flex;gap:24px;font-size:0.8125rem;">
            <span><strong>Not yet assigned</strong></span>
            <span><strong>Created:</strong> Mar 28</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Lesson 5: Completed -->
    <div class="card" style="padding:0;overflow:hidden;">
      <div style="display:flex;">
        <div style="width:6px;background:var(--color-border);flex-shrink:0;"></div>
        <div style="padding:20px;flex:1;opacity:0.7;">
          <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;">
            <div>
              <div style="display:flex;align-items:center;gap:10px;margin-bottom:4px;">
                <h3 style="font-size:1.0625rem;font-weight:700;margin:0;">Math: Fractions Review</h3>
                <span style="padding:2px 10px;border-radius:var(--radius-full);font-size:0.6875rem;font-weight:600;background:var(--color-bg);color:var(--color-text-muted);">Completed</span>
              </div>
              <div style="font-size:0.8125rem;color:var(--color-text-secondary);">Math &bull; 3 steps &bull; Est. 30 mins</div>
            </div>
            <div style="display:flex;gap:8px;">
              <button class="btn btn-outline btn-sm">Duplicate</button>
              <button class="btn btn-ghost btn-sm">View Results</button>
            </div>
          </div>
          <p style="font-size:0.875rem;color:var(--color-text-secondary);margin:0 0 12px 0;">Review adding, subtracting, and comparing fractions with visual models and practice problems.</p>
          <div style="display:flex;gap:24px;font-size:0.8125rem;">
            <span><strong>Completed by:</strong> 11 of 12 students</span>
            <span><strong>Avg score:</strong> 87%</span>
            <span><strong>Avg time:</strong> 26 mins</span>
          </div>
        </div>
      </div>
    </div>

  </div>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
