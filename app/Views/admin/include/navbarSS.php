<header id="header" class="header fixed-top d-flex align-items-center justify-content-between">

  <div class="d-flex align-items-center justify-content-between">
    <i class="bi bi-list toggle-sidebar-btn"></i>
    <a href="index.html" class="logo d-flex align-items-center">
      <!-- <span class="d-nonte d-lg-block"> <img src="./assets/img/logo.png" alt=""></span> -->
      <span class="d-nonte d-lg-block"> <img src="./assets/img/logoblak.png" alt="RepoRealm Logo" style="width: 150px;"></span>
    </a>
  </div><!-- End Logo -->

  <div class="align-items-center col-lg-7">
    <form action="/search" method="GET" class="search-form search-bar">
      <input type="search" name="q" placeholder="Search on RepoRealm" id="search-input" class="search-input">
      <button type="submit" id="search-button" class="search-button">Search</button>
    </form>
  </div>

  <nav class="header-nav ms-auto col-lg-">
    <ul class="d-flex align-items-center">
      <li class="nav-item mr-3 toggle-search-icon" style="color: white; font-weight:100; font-size: 25px;">
        <i class="bi bi-search"></i>
      </li>
      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>@Mayomi</h6>
            <span>Admin</span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center login" href="#">
              <i class="bi bi-box-arrow-right"></i>
              <span>Log Out</span>
            </a>
          </li>
        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->
    </ul>
  </nav><!-- End Icons Navigation -->
</header><!-- End Header -->