<nav class="navbar navbar-expand-lg px-3">
    <a class="navbar-brand" href="/">Learn<span style="color: #007bff;">X</span>a</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="/category" id="categoriesDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-th-large" aria-hidden="true"></i> Categories
                </a>
                <div class="dropdown-menu" aria-labelledby="categoriesDropdown">
                    <a class="dropdown-item" href="/category">Web Development</a>
                    <a class="dropdown-item" href="/category">Data Science</a>
                    <a class="dropdown-item" href="/category">Business</a>
                    <a class="dropdown-item" href="/category">Design</a>
                    <a class="dropdown-item" href="/category">Marketing</a>
                </div>
            </li>
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
                <a class="nav-link" href="<?= base_url('courses'); ?>">Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/become-teacher">Become a Teacher</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/virtual-courses">Live Class</a>
            </li>
            <?php $session = session(); ?>
            <?php //if ('isLoggedIn') : ?>
                <?php if ($session->get('isLoggedIn')) : ?>
                    <li class="nav-item">
                        <!-- <a class="btn mr-2 btn-danger" href="#">Logout</a> -->
                    </li>
                     <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> Profile
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="profile">Dashboard</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a>
                    </div>
                </li>
                    <?php else : ?>
            <li class="nav-item">
                <a href="login"><button class="btn mr-2 btn-outline-blue"><i
                            class="fas fa-user"></i> Login</button></a>
            </li>
            <li class="nav-item">
                <a href="generate-invoice"><button class="btn btn-outline-blue join">Join Now!</button></a>
            </li>
            <?php endif; ?>
           
        </ul>
    </div>
</nav>