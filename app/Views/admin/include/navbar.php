<header style="margin: 0px">
    <!-- Navigation bar or header section -->
    <nav class="navbar fix-top navbar-expand-lg navbar-light" style="background-color: #ffff;">
        <div class="container">
            <!-- <i class="bi bi-list toggle-sidebar-btn"></i> -->
            <!-- <div class="d-flex align-items-center justify-content-between">
                <a class="navbar-brand toggle-sidebar-btn" href="#">
                    <span class="navbar-toggler-icon"></span>
                </a>
            </div> -->

            <div class="d-flex align-items-center">
                <!-- Sidebar toggle button for mobile view -->
                <div class="custom-btn d-md-none" type="button" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </div>
                <!-- Search Form -->
                <form class="custom-search-form d-none d-md-flex w-100 box-shadow">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                </form>
            </div>

        </div><!-- End Logo -->
        <!-- Logo and branding -->


        <!-- Toggler/collapsible button for small screens
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> -->
        <!-- Navigation links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-speedometer2"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-people-circle"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-list-check"></i>
                    </a>
                </li>
                <!-- Add more navigation links as needed -->
            </ul>

        </div>
        <!-- User profile and logout button -->
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
                id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../assets/img/author.jpg" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>Mayomi</strong>
            </a>
            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>
        </div>
    </nav>
</header>