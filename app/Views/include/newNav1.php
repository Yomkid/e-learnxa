<nav class="navbar navbar-expand-lg pl-0 pr-0">
    <div class="container-fluid pl-0 pr-0 d-flex justify-content-between">
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

        <div class="d-flex align-items-center m-auto">
            <!-- Centered logo -->
            <div class="logo d-flex align-items-center justify-content-center">
                <a href="#">
                    <h5 style="font-weight: bolder; color:rgb(9, 25, 60)">LearnXa</h5>
                </a>
            </div>
        </div>

        <div class="d-flex align-items-center ml-auto">
            <!-- Search Form -->
            <div class="custom-btn d-md-none mr-2" id="searchIcon" type="button">
                <i class="fas fa-search"></i>
            </div>

            <!-- User Info and Notification Bell -->
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="./assets/img/profile-img.jpg" alt="User" class="mr-1"
                            style="width: 40px; height: 40px; border-radius: 50%;">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <div class="p-2">
                            <div style="color: black;">
                                <h5 class="mb-0">Mayor Odewaye</h5>
                            </div>
                            <h6 class="username mb-0" style="color: grey;">3rd Year</h6>
                        </div>
                    </div>
                </div>
                <button class="btn my-2 my-sm-0 " type="button"><i class="fas fa-bell"></i></button>
            </div>
        </div>
    </div>
</nav>