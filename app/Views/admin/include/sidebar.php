<style>
  .navbar-brand {
    display: inline-block;
    white-space: nowrap;
    font-size: 30px;
    font-weight: 700;
    color: black !important;
    text-decoration: none !important;
  }

  .link-dark.nav-link.active {
    border-right: red solid 4px !important;
    background-color: #007bff;
    color: white !important;
    font-weight: bold;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transform: translateX(-5px);
  }
  .active i{
    color: white !important;
    font-weight: bold;
  }

  .custom-divider {
    border-top: 2px solid #000;
    margin-top: 1rem;
    margin-bottom: 1rem;
  }

  .sidebar .font-weight-bold {
    font-weight: bold;
    margin: 10px 0;
  }
</style>

<aside id="sidebar" class="d-flex flex-column flex-shrink-0 p-3 bg-light sidebar" style="background-color: #fff;">
  <div class="logo-section text-center">
    <a class="navbar-brand" href="/" style="margin-bottom: 0;">
      <div>Learn<span style="color: #007bff;">X</span>a</div>
    </a>
  </div>
  <hr class="custom-divider">

  <ul class="nav nav-pills text-dark flex-column mb-auto">
    <div class="font-weight-bold"><i class="bi bi-speedometer2 me-2"></i> MENU</div>
    <li class="nav-item">
      <a href="/admin" class="nav-link link-dark">
        <i class="bi bi-speedometer2 me-2"></i>
        Dashboard
      </a>
    </li>
    <li>
      <a href="/admin/course" class="nav-link link-dark">
        <i class="bi bi-file-earmark-text me-2"></i>
        Manage Course
      </a>
    </li>
    <li>
      <a href="/admin/quizzes" class="nav-link link-dark">
        <i class="bi bi-file-earmark-text me-2"></i>
        Quiz Management
      </a>
    </li>
    <li>
      <a href="/admin/questionbank" class="nav-link link-dark">
        <i class="bi bi-journal-text me-2"></i>
        Question Bank
      </a>
    </li>
    <li>
      <a href="/admin/modules" class="nav-link link-dark">
        <i class="bi bi-journal-text me-2"></i>
        Course Modules
      </a>
    </li>
    <li>
      <a href="/admin/lesson" class="nav-link link-dark">
        <i class="bi bi-journal-text me-2"></i>
        Course Lessons
      </a>
    </li>
    <li>
      <a href="/admin/assignments" class="nav-link link-dark">
        <i class="bi bi-file-earmark-text me-2"></i>
        Assignments
      </a>
    </li>
    <li>
      <a href="/admin/timetables" class="nav-link link-dark">
        <i class="bi bi-gear me-2"></i>
        Timetables
      </a>
    </li>
    <li>
      <a href="/admin/virtualclasses" class="nav-link link-dark">
        <i class="bi bi-bell me-2"></i>
        Virtual Classes
      </a>
    </li>
    <li>
      <a href="#" class="nav-link link-dark">
        <i class="bi bi-code-slash me-2"></i>
        Integration
      </a>
    </li>
    <li>
      <a href="/admin/analytics" class="nav-link link-dark">
        <i class="bi bi-graph-up me-2"></i>
        Analytics
      </a>
    </li>
    <li>
      <a href="/admin/announcements" class="nav-link link-dark">
        <i class="bi bi-megaphone me-2"></i>
        Announcements
      </a>
    </li>
    <li>
      <a href="#" class="nav-link link-dark">
        <i class="bi bi-chat-text me-2"></i>
        Chat
      </a>
    </li>
    <li>
      <a href="#" class="nav-link link-dark">
        <i class="bi bi-chat-text me-2"></i>
        Community
      </a>
    </li>
    <hr class="custom-divider">
    <div class="font-weight-bold"><i class="bi bi-code-slash me-2"></i>INTEGRATION</div>
    <li class="nav-item">
      <a href="/admin/payment-gateway-setup" class="nav-link link-dark">
        <i class="bi bi-credit-card me-2"></i>
        Payment Integration
      </a>
    </li>
    <hr class="custom-divider">
    <div class="font-weight-bold"><i class="bi bi-gift me-2"></i>PRODUCTS</div>
    <li class="nav-item">
      <a href="/admin/coupon" class="nav-link link-dark">
        <i class="bi bi-tags me-2"></i>
        Coupons
      </a>
    </li>
    <hr class="custom-divider">
    <div class="font-weight-bold"><i class="bi bi-gear me-2"></i>SETTINGS</div>
    <li class="nav-item">
      <a href="/admin/backup" class="nav-link link-dark">
        <i class="bi bi-database me-2"></i>
        System Backup
      </a>
    </li>
    <li class="nav-item">
      <a href="/admin/general-settings" class="nav-link link-dark">
        <i class="bi bi-info-circle me-2"></i>
        System Info
      </a>
    </li>
  </ul>
</aside>

<script>
  // For Active link in Sidebar and Navbar or any Nav links
  document.addEventListener("DOMContentLoaded", function() {
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
      if (link.getAttribute('href') === currentPath) {
        link.classList.add('active');
      }
    });
  });
</script>
