<nav class="navbar navbar-expand-lg px-3">
    <a class="navbar-brand" href="/">
        Learn<span style="color: #007bff;">X</span>a
    </a>
    <div class="navbar-toggler" type="button" id="navbarToggle">
        <i class="fas fa-bars" style="font-size: 24px;"></i>
    </div>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
        <a class="navbar-brand d-lg-none text-center" href="/">
        Learn<span style="color: #007bff;">X</span>a
    </a>
            <form class="form-inline my-2 my-lg-0 d-lg-none">
                <div class="input-group w-100">
                    <input class="form-control" type="search" placeholder="Search Anything" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-blue" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="/category" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-th-large" aria-hidden="true"></i> Categories
                </a>
                <div class="dropdown-menu" aria-labelledby="categoriesDropdown" id="categoriesDropdown">
                    <!-- Categories will be populated here -->
                </div>
            </li>
            <!-- Other items go here -->
             <!-- Search form for desktop devices only -->
        <form class="form-inline my-2 my-lg-0 d-none d-lg-flex ml-auto">
            <div class="input-group">
                <input class="form-control" type="search" placeholder="Search Anything" aria-label="Search">
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
                <a class="nav-link" href="/courses">Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/become-teacher">Become a Teacher</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/virtual-courses">Live Class</a>
            </li>
            <?php $session = session(); ?>
            <?php if ($session->get('isLoggedIn')) : ?>
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
                <a href="login"><button class="btn mr-2 btn-outline-blue"><i class="fas fa-user"></i> Login</button></a>
            </li>
            <li class="nav-item">
                <a href="generate-invoice"><button class="btn btn-outline-blue join">Join Now!</button></a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<script>
    document.getElementById('navbarToggle').addEventListener('click', function (event) {
    event.stopPropagation(); // Prevents the click event from propagating to the document
    const navbar = document.getElementById('navbarNav');
    const icon = this.querySelector('i');

    navbar.classList.toggle('show');
    if (navbar.classList.contains('show')) {
        icon.classList.remove('fa-bars');
        icon.classList.add('fa-times');
    } else {
        icon.classList.remove('fa-times');
        icon.classList.add('fa-bars');
    }
});

// Close navbar when clicking outside
document.addEventListener('click', function (event) {
    const navbar = document.getElementById('navbarNav');
    const icon = document.getElementById('navbarToggle').querySelector('i');

    if (navbar.classList.contains('show') && !navbar.contains(event.target)) {
        navbar.classList.remove('show');
        icon.classList.remove('fa-times');
        icon.classList.add('fa-bars');
    }
});

</script>
<style>


/* Base styles for the navbar */
.navbar {
    z-index: 1050;
    padding: 0.5rem 1rem; /* Adjust padding as needed */
}

/* Mobile view adjustments */
@media (max-width: 992px) {
    .navbar {
        height: auto; /* Ensure auto height for mobile */
    }
    
    /* Adjust the padding for the navbar brand (logo) */
    .navbar-brand {
        padding: 5px; /* Remove extra padding */
    }

    /* Adjust the navbar-toggler */
    .navbar-toggler {
        padding: 0.25rem 0.75rem; /* Adjust padding for the toggler */
        margin: 0;
        height: auto; /* Ensure it doesn't expand too much */
    }
    
    .navbar-collapse {
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        height: 100%;
        background-color: #f8f9fa;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
        transition: transform 0.3s ease-in-out;
        z-index: 1000;
        padding: 0.5rem 1rem; /* Adjust as needed */

    }
}



@media (min-width: 992px) {
    .navbar-collapse {
        position: static;
        width: auto;
        height: auto;
        background-color: transparent;
        box-shadow: none;
        display: flex !important; /* Ensure it displays as flex on large screens */
    }

    .navbar-collapse.show {
        left: auto;
    }
}

</style>