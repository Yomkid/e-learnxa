<!DOCTYPE html>
<html lang="en">

<head>
    <title>Achievements | LearnXa</title>
    <?php include(APPPATH . 'Views/student/include/student-head.php'); ?>
    <style>
        .achievement-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            background-color: #fff;
            margin: 0.5rem 0;
        }

        .achievement-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            color: #00c3ff;
        }

        .achievement-card img {
            border: 1px solid #e0e0e0;
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .achievement-title {
            font-size: 18px;
            font-weight: bold;
            margin: 1rem 0;
        }

        .achievement-description {
            font-size: 16px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-90XYHBSS6Z"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-90XYHBSS6Z');
</script>
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
                            Achievements
                        </div>
                        <p>Below are your achievements and awards earned through the platform.</p>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="achievement-card">
                                <img src="../assets/img/achievement1.jpg" alt="Achievement 1" />
                                <div class="p-3">
                                    <div class="achievement-title">Achievement Title 1</div>
                                    <div class="achievement-description">
                                        A brief description of the achievement, including any important details or milestones reached.
                                    </div>
                                    <a href="#" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="achievement-card">
                                <img src="../assets/img/achievement2.jpg" alt="Achievement 2" />
                                <div class="p-3">
                                    <div class="achievement-title">Achievement Title 2</div>
                                    <div class="achievement-description">
                                        A brief description of the achievement, including any important details or milestones reached.
                                    </div>
                                    <a href="#" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="achievement-card">
                                <img src="../assets/img/achievement3.jpg" alt="Achievement 3" />
                                <div class="p-3">
                                    <div class="achievement-title">Achievement Title 3</div>
                                    <div class="achievement-description">
                                        A brief description of the achievement, including any important details or milestones reached.
                                    </div>
                                    <a href="#" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <!-- Add more achievement cards as needed -->
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
