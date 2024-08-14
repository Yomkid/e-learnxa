<!-- <aside id="sidebar" class="sidebar "> -->
  <style>
    .navbar-brand {
            font-size: 30px;
            font-weight: 700;
            color: white !important;
            text-decoration: none !important;
        }

        .navbar-brand {
            display: inline-block;
            /* padding-top: .3125rem;
            padding-bottom: .3125rem; */
            margin-right: 1rem;
            /* font-size: 1.25rem; */
            line-height: inherit;
            white-space: nowrap;
        }
  </style>
<aside id="sidebar" class="d-flex flex-column flex-shrink-0 p-3 sidebar">
  <!-- <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <img src="../assets/img/jeta-logo-dark.png" alt="Jeta Logo" width="100px">
        </a> -->
  <!-- <div class="logo-section mb-3 mb-md-0 me-md-auto"> -->
  <div class="logo-section">
    <!-- <a href="/" class="d-flex align-items-center link-dark text-decoration-none">
      <img src="../assets/img/jeta-logo-dark.png" alt="LearnXa Logo" width="90px">
    </a> -->
    <a class="navbar-brand" href="" style="font-weight: 500px;">
      <div>Learn<span style="color: #007bff;">X</span>a</div>
    </a>
    <!-- <a class="navbar-brand" href="" style="font-weight: 500px;">
      <div><span style="color: green;">JE</span><span style="color: red;">T</span><span style="color: green;">A</span>-MLD <br>CBT-App</div>
    </a> -->
    <hr>
  </div>

  <ul class="nav nav-pills flex-column mb-auto">
    MENU
    <li>
      <a href="<?= base_url('admin') ?>" class="nav-link link-light">
        <i class="bi bi-speedometer2 me-2"></i>
        Dashboard
      </a>
    </li>
    <li class="nav-item accordion-item">
      <a href="<?= base_url('analytics') ?>" class="collapsed nav-link link-light active-menu" data-bs-toggle="collapse"
        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
        <i class="bi bi-speedometer2 me-2"></i>
        E-Management
      </a>
      <ul id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse nav nav-pills mb-auto bg-black">
        <li>
          <a href="#test.php" class="nav-link link-light">
            <i class="bi bi-file-earmark-text me-2"></i>
            Add Course
          </a>
        </li>
        <li>
          <a href="#user.php" class="nav-link link-light">
            <i class="bi bi-file-earmark-text me-2"></i>
            View Courses
          </a>
        </li>
        <li>
          <a href="#user.php" class="nav-link link-light">
            <i class="bi bi-file-earmark-text me-2"></i>
            Edit Course
          </a>
        </li>
      </ul>
    </li>
    <!-- User Management -->
    
    <li>
      <a href="<?= base_url('announcements') ?>" class="nav-link link-light">
        <i class="bi bi-file-earmark-text me-2"></i>
        Announcements
      </a>
    </li>
    <li>
      <a href="<?= base_url('analytics') ?>" class="nav-link link-light">
        <i class="bi bi-file-earmark-text me-2"></i>
        User Management
      </a>
    </li>

    <!-- Classs -->
    <li>
      <a href="<?= base_url('analytics') ?>" class="nav-link link-light">
        <i class="bi bi-journal-text me-2"></i>
        Analytics
      </a>
    </li>
    <li>
      <a href="<?= base_url('backup') ?>" class="nav-link link-light">
        <i class="bi bi-journal-text me-2"></i>
        Data Backup
      </a>
    </li>
    <li>
      <a href="<?= base_url('course-details') ?>" class="nav-link link-light">
        <i class="bi bi-journal-text me-2"></i>
        Course Details
      </a>
    </li>
    <li>
      <a href="<?= base_url('course-performance-report') ?>" class="nav-link link-light">
        <i class="bi bi-journal-text me-2"></i>
        Course Performance
      </a>
    </li>
    <li>
      <a href="<?= base_url('coupon') ?>" class="nav-link link-light">
        <i class="bi bi-journal-text me-2"></i>
        Coupon
      </a>
    </li>
    <li>
      <a href="<?= base_url('course') ?>" class="nav-link link-light">
        <i class="bi bi-journal-text me-2"></i>
        Course
      </a>
    </li>
    <!-- Classs -->
    <li>
      <a href="<?= base_url('lesson') ?>" class="nav-link link-light">
        <i class="bi bi-journal-text me-2"></i>
        Lesson
      </a>
    </li>
    <!-- Settings -->
    <li>
      <a href="<?= base_url('create-role') ?>" class="nav-link link-light">
        <i class="bi bi-gear me-2"></i>
        Create Role
      </a>
    </li>
    <!-- Notification -->
    <li>
      <a href="<?= base_url('edit-role') ?>" class="nav-link link-light">
        <i class="bi bi-bell me-2"></i>
        Edit Role
      </a>
    </li>
    <!-- Integration -->
    <li>
      <a href="<?= base_url('createUser') ?>" class="nav-link link-light">
        <i class="bi bi-code-slash me-2"></i>
        Create User
      </a>
    </li>
    <!-- Results and Analytics -->
    <li>
      <a href="<?= base_url('editUser') ?>" class="nav-link link-light">
        <i class="bi bi-graph-up me-2"></i>
        Edit User
      </a>
    </li>

    <li>
      <a href="<?= base_url('emailTemplates') ?>" class="nav-link link-light">
        <i class="bi bi-chat-text me-2"></i>
        Email Templates
      </a>
    </li>

    PRODUCT
    <li class="nav-item">
      <a href="<?= base_url('enrollment-details') ?>" class="nav-link link-light">
        <i class="bi bi-speedometer2 me-2"></i>
        Enrollment Details
      </a>
    </li>
    SETTINGS
    <li class="nav-item">
      <a href="<?= base_url('enrollment-list') ?>" class="nav-link link-light">
        <i class="bi bi-speedometer2 me-2"></i>
        Enrollment List
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('enrollment-list') ?>" class="nav-link link-light">
        <i class="bi bi-speedometer2 me-2"></i>
        Enrollment List
      </a>
    </li>

  </ul>
</aside>
<!-- </aside> -->