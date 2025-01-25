<!DOCTYPE html>
<html lang="en">

<head>
    <title>Results | LearnXa</title>
    <?php include(APPPATH . 'Views/student/include/student-head.php'); ?>
    <style>
        .result-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
            margin: 0.5rem 0;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .result-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .result-card img {
            border-bottom: 1px solid #e0e0e0;
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .result-card .card-body {
            padding: 15px;
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
                    <div class="category-header" style="font-size:17px;">
                        Your Results
                    </div>
                    <p>Below are your results for the recent assessments.</p>
                    <hr>
                    <div class="row">
                        <!-- Example Result Card -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="result-card">
                                <div class="card-body">
                                    <h5 class="card-title">The Complete JavaScript Course 2024: From Zero to Expert!</h5>
                                    <p class="card-text">Assignment Title: <strong>Assignment 1</strong></p>
                                    <p class="card-text">Score: <strong>85%</strong></p>
                                    <p class="card-text">Date: <strong>August 8, 2024</strong></p>
                                    <a href="/student/result/details/1" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <!-- Repeat for other results -->
                        <!-- Example Result Card -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="result-card">
                                <div class="card-body">
                                    <h5 class="card-title">The Complete JavaScript Course 2024: From Zero to Expert!</h5>
                                    <p class="card-text">Quiz Title: <strong>Quiz 1</strong></p>
                                    <p class="card-text">Score: <strong>90%</strong></p>
                                    <p class="card-text">Date: <strong>August 7, 2024</strong></p>
                                    <a href="/student/result/details/2" class="btn btn-primary">View Details</a>
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
