<!DOCTYPE html>
<html lang="en">

<head>
    <title>Notifications | LearnXa</title>
    <?php include(APPPATH . 'Views/student/include/student-head.php'); ?>
    <style>
        .notification-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            background-color: #fff;
            padding: 15px;
            margin-bottom: 15px;
            transition: box-shadow 0.2s;
        }

        .notification-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .notification-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .notification-header img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .notification-header .title {
            font-size: 16px;
            font-weight: bold;
        }

        .notification-body {
            font-size: 14px;
        }

        .notification-footer {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #888;
            margin-top: 10px;
        }

        .notification-footer .date {
            font-size: 12px;
        }

        .notification-footer .actions button {
            border: none;
            background: none;
            color: #007bff;
            cursor: pointer;
            font-size: 12px;
        }

        .notification-footer .actions button:hover {
            text-decoration: underline;
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
                    <div class="notification-section">
                        <div class="mb-4">
                            <div class="category-header" style="font-size:24px;">
                                Notifications
                            </div>
                            <p>Stay updated with the latest announcements, alerts, and notifications from your courses and instructors.</p>
                        </div>
                        <hr>
                        <div class="row">
                            <!-- Example Notification Card -->
                            <div class="col-lg-6 col-md-12 mb-1">
                                <div class="notification-card">
                                    <div class="notification-header">
                                    <i class="fas fa-bell" style="font-size: 24px; color: #007bff;"></i>
                                     <div class="title">Course Update</div>
                                    </div>
                                    <div class="notification-body">
                                        <p>We have updated the syllabus for the JavaScript course. Please review the new topics and schedule on the course page.</p>
                                    </div>
                                    <div class="notification-footer">
                                        <div class="date">August 15, 2024</div>
                                        <div class="actions">
                                            <button type="button">Mark as Read</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Add more notification cards as needed -->
                            <div class="col-lg-6 col-md-12 mb-1">
                                <div class="notification-card">
                                    <div class="notification-header">
                                    <i class="fas fa-bell" style="font-size: 24px; color: #007bff;"></i> 
                                    <div class="title">New Assignment</div>
                                    </div>
                                    <div class="notification-body">
                                        <p>A new assignment has been posted in the React Development course. Please complete it by the due date.</p>
                                    </div>
                                    <div class="notification-footer">
                                        <div class="date">August 20, 2024</div>
                                        <div class="actions">
                                            <button type="button">Mark as Read</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <!-- Optional: Pagination controls or load more button -->
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <li class="page-item disabled">
                                            <span class="page-link">Previous</span>
                                        </li>
                                        <li class="page-item active">
                                            <span class="page-link">1</span>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
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
