<nav class="navbar navbar-expand-lg px-3">
    <a class="navbar-brand" href="/student/quizzes">Learn<span style="color: #007bff;">X</span>a |<span class="sub-brand">CBTApp</span></a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categories
                </a>
                <div class="dropdown-menu" aria-labelledby="categoriesDropdown">
                    <a class="dropdown-item" href="#">Web Development</a>
                    <a class="dropdown-item" href="#">Data Science</a>
                    <a class="dropdown-item" href="#">Business</a>
                    <a class="dropdown-item" href="#">Design</a>
                    <a class="dropdown-item" href="#">Marketing</a>
                </div>
            </li> -->
            <!-- <div>
                <h5>| CBTApp</h5>
            </div> -->
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <h6><?= esc($quiz['course_title']) ?></h6>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="#">Dashboard</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Logout</a>
                </div>
            </li>

        </ul>

    </div>

    <div class="custom-btn d-lg-none" type="button" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </div>

</nav>