<!DOCTYPE html>
<html lang="en">

<head>

    <title>Enrolled Courses | LeanXa</title>
    <?php include(APPPATH . 'Views/student/include/student-head.php'); ?>
    <style>
        .course-card {
            /* border: 1px solid #e0e0e0; */
            /* border-radius: 10px; */
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            background-color: #fff;
            margin: 0.5rem 0;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            color: #00c3ff;
        }

        .course-card img {
            border: 1px solid #e0e0e0;
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
    </style>
</head>

<body style="background-color: #f2f2f2;">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-6">
                <?php include(APPPATH . 'Views/student/include/student-sidebar.php'); ?>
            </div>


            <div class="col-lg-10 col-md-6">
                <?php include(APPPATH . 'Views/student/include/student-navbar.php'); ?>

                <div class="main-container mt-2 p-2" id="mainContent">

                    <div class="">
                        <div class="category-header" style="font-size:17px;">
                            Enrolled Courses
                        </div>
                        <p>Below are your enrolled courses, kindly continue where you stopped and finish to earn
                            your
                            certificate</p>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <a href="/student/course-details">
                            <div class="course-card">
                                <img src="../assets/img/web_dev.jpeg" alt="Course Image" />
                                <div class="card-body">
                                    <h4 class="card-title">React - The Complete Guide 2024 (incl. Next.js, Redux)</h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 70%;"
                                            aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70%</div>
                                    </div>
                                    <!-- <button class="btn btn-primary w-100">View course</button> -->
                                </div>
                            </div>
                        </a>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="course-card">
                                <img src="../assets/img/py4web.jpg" alt="Course Image" />
                                <div class="card-body">
                                    <h4 class="card-title">Learn Python Programming for Web Development (In Ten Easy
                                        Steps)</h4>
                                    <!-- <p class="card-text">Brief description of the course content goes here.</p> -->
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 70%;"
                                            aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70%</div>
                                    </div>
                                    <!-- <button class="btn btn-primary w-100">View course</button> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="course-card">
                                <img src="../assets/img/math.jpg" alt="Course Image" />
                                <div class="card-body">
                                    <h4 class="card-title">Mathematics - Numerical Analysis</h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 70%;"
                                            aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70%</div>
                                    </div>
                                    <button class="btn btn-primary w-100">View course</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="course-card">
                                <img src="../assets/img/c++.jpg" alt="Course Image" />
                                <div class="card-body">
                                    <h4 class="card-title">Introduction to Object Oriented Programming with C++</h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 70%;"
                                            aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70%</div>
                                    </div>
                                    <button class="btn btn-primary w-100">View course</button>
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