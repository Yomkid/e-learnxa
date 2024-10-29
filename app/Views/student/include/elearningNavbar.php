<nav class="navbar navbar-expand-lg px-3">
    <a class="navbar-brand" href="/student">Learn<span style="color: #007bff;">X</span>a</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            
            <form class="form-inline my-2 my-lg-0">
                <div class="input-group">
                    <input class="form-control" type="search" placeholder="Search courses" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-blue" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <h6><?= $courseTitle ?></h6>
                </a>
            </li>
            <button class="btn btn-primary d-lg-none mb-3" type="button" id="toggle-sidebar">
                    <i class="fas fa-bars"></i> Modules
                </button>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="#">Dashboard</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout">Logout</a>
                </div>
            </li>
        </ul>
    </div>
    <button class="btn btn-primary d-lg-none" type="button" id="toggle-sidebar">
                    <i class="fas fa-bars"></i> Modules
                </button>
</nav>