<!DOCTYPE html>
<html lang="en">

<head>
    <title>Assignments | LearnXa</title>
    <?php include(APPPATH . 'Views/student/include/student-head.php'); ?>
    <style>
        .assignment-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            background-color: #fff;
            margin: 0.5rem 0;
        }

        .assignment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            color: #00c3ff;
        }

        .assignment-card img {
            border-bottom: 1px solid #e0e0e0;
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .assignment-card .category-header {
            font-size: 17px;
            margin-top: 10px;
        }

        .assignment-card p {
            font-size: 14px;
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
                    <div class="mb-4">
                        <div class="category-header" style="font-size:24px;">
                            Assignments
                        </div>
                        <p>Below are your assignments.</p>
                    </div>
                    <hr>
                    <div class="row">
                        <!-- Example Assignment Card -->
                        <div class="col-lg-4 col-md-6 mb-1">
                            <div class="assignment-card">
                                <img src="../assets/img/assignment1.jpeg" alt="Assignment Image" />
                                <div class="p-2">
                                    <div class="category-header">
                                        Assignment 1: Introduction to Programming
                                    </div>
                                    <p>Due Date: 20th August 2024</p>
                                    <a href="/student/assignments/1" class="btn btn-primary w-100">View Assignment</a>
                                </div>
                            </div>
                        </div>
                        <!-- Add more assignment cards as needed -->
                        <div class="col-lg-4 col-md-6 mb-1">
                            <div class="assignment-card">
                                <img src="../assets/img/assignment2.jpeg" alt="Assignment Image" />
                                <div class="p-2">
                                    <div class="category-header">
                                        Assignment 2: Advanced CSS Techniques
                                    </div>
                                    <p>Due Date: 25th August 2024</p>
                                    <a href="/student/assignments/2" class="btn btn-primary w-100">View Assignment</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-1">
                            <div class="assignment-card">
                                <img src="../assets/img/assignment3.jpeg" alt="Assignment Image" />
                                <div class="p-2">
                                    <div class="category-header">
                                        Assignment 3: JavaScript Basics
                                    </div>
                                    <p>Due Date: 30th August 2024</p>
                                    <a href="/student/assignments/3" class="btn btn-primary w-100">View Assignment</a>
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
