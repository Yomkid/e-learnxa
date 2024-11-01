<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(APPPATH . 'Views/student/include/student-head.php'); ?>
    <title><?= session('first_name'); ?> Profile | LearnXa</title>
</head>

<body style="background-color: #f2f2f2;">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-6">
                <?php include(APPPATH . 'Views/student/include/student-sidebar.php'); ?>
            </div>


            <div class="col-lg-10 col-md-6 ">
                <?php include(APPPATH . 'Views/student/include/student-navbar.php'); ?>


                <!-- Hero Section -->
                <div class="main-container mt-2 p-2" id="mainContent">
                    <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                    <?php endif; ?>
                    <div class="content-hero-section"
                        style="background: url(<?= base_url('assets/img/elearning.webp'); ?>) no-repeat center center/cover;">
                        <div class="container text-white bottom-text">
                            <div class="row">
                                <!-- Hero Text -->
                                <div class="col-md-6 profile-hero-text pt-3 pl-5">
                                    <!-- <div class="profile-hero-text"> -->
                                    <div class="text-white">
                                        <p><?= date('F j, Y'); ?></p>
                                    </div>
                                    <div>
                                        <!-- <h5 class="fw-bolder" style="font-weight: bold; font-size: 24px;">Welcome
                                            back,
                                            <?= session('first_name'); ?>!</h5> -->

                                        <?php
                                            date_default_timezone_set('Africa/Lagos'); // Set your timezone, e.g., 'Africa/Lagos'
                                            $hour = date('H');
                                            $greeting = '';

                                            if ($hour >= 5 && $hour < 12) {
                                                $greeting = 'Good morning';
                                            } elseif ($hour >= 12 && $hour < 17) {
                                                $greeting = 'Good afternoon';
                                            } else {
                                                $greeting = 'Good evening';
                                            }


                                            $isFirstLoginToday = session('isFirstLoginToday');
                                            $greetingMessage = '';

                                            if ($isFirstLoginToday) {
                                                $greetingMessage = $greeting . ', ' . session('first_name') . '! <br>Welcome onboard!';
                                            } else {
                                                $greetingMessage = $greeting . ', ' . session('first_name') . '! <br>Welcome back!';
                                            }
                                        ?>


                                        <h5 class="fw-bolder" style="font-weight: bold; font-size: 24px;">
                                            <?= $greetingMessage; ?>
                                        </h5>


                                        <p style="font-size: small;">Always stay connected in your student portal
                                        </p>
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <div class="col-md-6 text-center text-md-right align-items-right justify-content-right">
                                    <img src="../assets/img/student.png" alt=""
                                        style="max-width: fit-content; width:140px;" class="img-fluid"
                                        style="max-width: 100%; height: auto;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-lg-8 col-md-6 mx-auto">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div class="category-header" style="font-size:17px;">
                                            Quick Access
                                        </div>
                                    </div>
                                    <div class="row card-group">
                                        <a href="student/enrolled-courses" class="col-md-4 col-sm-6 mb-3">
                                            <div class="card card-custom">
                                                <div class="card-body text-center">
                                                    <i class="fas fa-graduation-cap card-icon"></i>
                                                    <h5 class="card-title mt-3">Courses</h5>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="student/assignments" class="col-md-4 col-sm-6 mb-3">
                                            <div class="card card-custom">
                                                <div class="card-body text-center">
                                                    <i class="fas fa-tasks card-icon"></i>
                                                    <h5 class="card-title mt-3">Assignment</h5>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="student/timetable" class="col-md-4 col-sm-6 mb-3">
                                            <div class="card card-custom">
                                                <div class="card-body text-center">
                                                    <i class="far fa-clock card-icon"></i>
                                                    <h5 class="card-title mt-3">Timetable</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div class="category-header" style="font-size:17px;">
                                            Enrolled Courses
                                        </div>
                                        <a href="student/enrolled-courses" class="seeAll">See all</a>
                                    </div>
                                    <div class="row card-group">
                                        <?php if (!empty($enrolledCourses)): ?>
                                        <?php foreach (array_slice($enrolledCourses, 0, 2) as $course): ?>
                                        <div class="col-md-6 col-sm-6 mb-3">
                                            <a
                                                href="<?= base_url('student/course-details/' . $course['course_id']); ?>">
                                                <div class="card card-custom" style="background-color: #f0f8ff;">
                                                    <div class="card-body d-flex justify-content-between">
                                                        <div>
                                                            <h5 class="card-title" style="font-size:16px;">
                                                                <?= esc($course['course_title']); ?></h5>
                                                            <button class="btn btn-blue px-4">View</button>
                                                            <div class="progress my-1">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width: <?= number_format($course['overallProgress'], 1); ?>%;" aria-valuenow="<?= number_format(number_format($course['overallProgress'], 1), 1); ?>"
                                                                    aria-valuemin="0" aria-valuemax="100"><?= number_format($course['overallProgress'], 1); ?>%</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <p class="text-danger"><strong>You have not enrolled in any courses yet.</strong></p>
                                        <a class="btn btn-primary mt-1" href="<?= base_url('/courses'); ?>">Check Courses and Enroll</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="side-content box-shadow">
                                        <div class="side-content p-3">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <div class="category-header" style="font-size:17px;">
                                                    Course Instructors
                                                </div>
                                                <div class="seeAll">See all</div>
                                            </div>
                                            <div class="instructor d-flex align-items-center justify-content-between">
                                                <img src="../assets/img/profile-img.jpg" alt="">

                                                <!-- <img src="../assets/img/animated.jpeg" alt="">
                                                <img src="../assets/img/animated.jpeg" alt="">
                                                <img src="../assets/img/animated.jpeg" alt=""> -->
                                            </div>
                                            <div class="list-group mt-3">
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div class="category-header" style="font-size:17px;">
                                                        Daily Notice
                                                    </div>
                                                    <div class="seeAll">See all</div>
                                                </div>

                                                <a href="#" class="list-group-item list-group-item-action">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="update-info">
                                                            <span>Asignments</span>
                                                        </div>

                                                    </div>
                                                </a>
                                                <a href="#" class="list-group-item list-group-item-action active-post">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="update-info">
                                                            <span>Complete your task</span>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="list-group-item list-group-item-action active-post">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="update-info">
                                                            <span>Complete your task</span>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#" class="list-group-item list-group-item-action active-post">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="update-info">
                                                            <span>Complete your task</span>
                                                        </div>
                                                    </div>
                                                </a>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>






    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script>
        // Toggle sidebar when the toggle button is clicked
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Close sidebar when clicking on the main content area
        document.getElementById('mainContent').addEventListener('click', function (e) {
            // Check if the click target is not the sidebar or the sidebar toggle button
            if (!document.getElementById('sidebar').contains(e.target) && e.target.id !== 'sidebarToggle') {
                document.getElementById('sidebar').classList.remove('show');
            }
        });

        // Toggle search form visibility when the search icon is clicked
        document.getElementById('searchIcon').addEventListener('click', function () {
            var searchForm = document.getElementById('searchForm');
            if (searchForm.classList.contains('d-none')) {
                searchForm.classList.remove('d-none');
                searchForm.classList.add('d-flex');
            } else {
                searchForm.classList.remove('d-flex');
                searchForm.classList.add('d-none');
            }
        });
    </script>
    <!-- Custom JS -->
    <script src="scripts.js"></script>
</body>

</html>