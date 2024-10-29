<!DOCTYPE html>
<html lang="en">

<head>
    <title>React - The Complete Guide 2024 (incl. Next.js, Redux) | LearnXa</title>
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
                            React - The Complete Guide 2024 (incl. Next.js, Redux)
                        </div>
                        <p>Below are the details of React - The Complete Guide 2024 (incl. Next.js, Redux)</p>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 mb-1">
                            <div class="course-card">
                                <img src="../assets/img/web_dev.jpeg" alt="Course Image" />
                            </div>
                            <div class="category-header" style="font-size:17px;">
                                Course Instructor
                            </div>
                            <div class="instructor d-flex align-items-center justify-content-bettween mb-4">
                                <img src="../assets/img/animated.jpeg" alt="">
                                <div>Odewaye Mayomi <P></P>
                                </div>
                            </div>
                            <div class="d-md-none">
                                <div class="category-header" style="font-size:17px;">
                                    Course Progress
                                </div>
                                <div class="progress mb-4">
                                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50"
                                        aria-valuemin="0" aria-valuemax="100">50%</div>
                                </div>
                            </div>
                            <a href="/student/e-learning"><button class="btn btn-primary w-100">Continue Learning</button></a>
                            <hr>
                        </div>
                        <div class="col-lg-9 col-md-6 mb-4">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-6 mb-1">
                                    <div class="card text-left bg-color-1">
                                        <div class="card-body">
                                            <h5 class="card-title">10 Modules</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 mb-1">
                                    <div class="card text-left bg-color-2">
                                        <div class="card-body">
                                            <h5 class="card-title">1 Certificate</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 mb-1">
                                    <div class="card text-left bg-color-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Final Exam</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 mb-1">
                                    <div class="card text-left bg-color-4">
                                        <div class="card-body">
                                            <h5 class="card-title">15 Assignments</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 mb-1">
                                    <div class="card text-left bg-color-5">
                                        <div class="card-body">
                                            <h5 class="card-title">17 Quiz</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 mb-1">
                                    <div class="card text-left bg-color-6">
                                        <div class="card-body">
                                            <h5 class="card-title">17 Materials</h5>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="">
                                <div class="category-header" style="font-size:17px;">
                                    Course Progress
                                </div>
                                <div class="progress mb-4">
                                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50"
                                        aria-valuemin="0" aria-valuemax="100">50%</div>
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