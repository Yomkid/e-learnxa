<!DOCTYPE html>
<html lang="en">

<head>
    <title>Virtual Class | LearnXa</title>
    <?php include(APPPATH . 'Views/student/include/student-head.php'); ?>
    <style>
        .virtual-class-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            background-color: #fff;
            padding: 15px;
            margin-bottom: 15px;
            transition: box-shadow 0.2s;
        }

        .virtual-class-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .virtual-class-card img {
            border-radius: 10px;
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .virtual-class-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .virtual-class-header .title {
            font-size: 18px;
            font-weight: bold;
        }

        .virtual-class-details {
            font-size: 14px;
        }

        .virtual-class-footer {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #888;
            margin-top: 10px;
        }

        .virtual-class-footer .date {
            font-size: 12px;
        }

        .virtual-class-footer .actions button {
            border: none;
            background: none;
            color: #007bff;
            cursor: pointer;
            font-size: 12px;
        }

        .virtual-class-footer .actions button:hover {
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
                    <div class="virtual-class-section">
                        <div class="mb-4">
                            <div class="category-header" style="font-size:24px;">
                                Virtual Class
                            </div>
                            <p>Participate in live virtual classes, view upcoming schedules, and access past sessions from your courses.</p>
                        </div>
                        <hr>
                        <div class="row">
                            <!-- Example Virtual Class Card -->
                            <div class="col-lg-6 col-md-12 mb-1">
                                <div class="virtual-class-card">
                                    <div class="virtual-class-header">
                                        <img src="../assets/img/cplus.jpg" alt="Virtual Class Image" />
                                        <div class="title">Introduction to JavaScript</div>
                                    </div>
                                    <div class="virtual-class-details">
                                        <p>Date: August 25, 2024</p>
                                        <p>Time: 10:00 AM - 12:00 PM</p>
                                        <p>Instructor: John Doe</p>
                                        <p>Join the session using the link below:</p>
                                        <a href="https://example.com/virtual-class-link" class="btn btn-primary">Join Class</a>
                                    </div>
                                    <div class="virtual-class-footer">
                                        <div class="date">August 20, 2024</div>
                                        <div class="actions">
                                            <button type="button">Add to Calendar</button>
                                            <button type="button">View Recording</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Add more virtual class cards as needed -->
                            <div class="col-lg-6 col-md-12 mb-1">
                                <div class="virtual-class-card">
                                    <div class="virtual-class-header">
                                        <img src="../assets/img/datasci-topic-img.jpg" alt="Virtual Class Image" />
                                        <div class="title">Advanced CSS Techniques</div>
                                    </div>
                                    <div class="virtual-class-details">
                                        <p>Date: August 27, 2024</p>
                                        <p>Time: 2:00 PM - 4:00 PM</p>
                                        <p>Instructor: Jane Smith</p>
                                        <p>Join the session using the link below:</p>
                                        <a href="https://example.com/virtual-class-link" class="btn btn-primary">Join Class</a>
                                    </div>
                                    <div class="virtual-class-footer">
                                        <div class="date">August 22, 2024</div>
                                        <div class="actions">
                                            <button type="button">Add to Calendar</button>
                                            <button type="button">View Recording</button>
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
