<!DOCTYPE html>
<html lang="en">

<head>
    <title>Community | LearnXa</title>
    <?php include(APPPATH . 'Views/student/include/student-head.php'); ?>
    <style>
        .community-section {
            margin: 20px 0;
        }

        .post-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            background-color: #fff;
            padding: 15px;
            margin-bottom: 20px;
            transition: box-shadow 0.2s;
        }

        .post-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .post-header img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }

        .post-header .username {
            font-size: 18px;
            font-weight: bold;
        }

        .post-body {
            font-size: 15px;
        }

        .post-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .post-footer .date {
            font-size: 13px;
            color: #888;
        }

        .post-footer .actions {
            display: flex;
            gap: 10px;
        }

        .post-footer .actions button {
            border: none;
            background: none;
            color: #007bff;
            cursor: pointer;
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
                    <div class="community-section">
                        <div class="mb-4">
                            <div class="category-header" style="font-size:24px;">
                                Community
                            </div>
                            <p>Engage with fellow students and educators. Share your thoughts, ask questions, and collaborate.</p>
                        </div>
                        <hr>
                        <div class="row">
                            <!-- Example Post Card -->
                            <div class="col-lg-6 col-md-12 mb-1">
                                <div class="post-card">
                                    <div class="post-header">
                                        <img src="../assets/img/tutor1.jpg" alt="User Avatar" />
                                        <div class="username">John Doe</div>
                                    </div>
                                    <div class="post-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac ultricies ligula, in cursus risus. Integer in mauris vitae magna luctus hendrerit.</p>
                                    </div>
                                    <div class="post-footer">
                                        <div class="date">Posted on: 20th August 2024</div>
                                        <div class="actions">
                                            <button type="button"><i class="fas fa-thumbs-up"></i> Like</button>
                                            <button type="button"><i class="fas fa-comment"></i> Comment</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Add more post cards as needed -->
                            <div class="col-lg-6 col-md-12 mb-1">
                                <div class="post-card">
                                    <div class="post-header">
                                        <img src="../assets/img/user2.jpg" alt="User Avatar" />
                                        <div class="username">Jane Smith</div>
                                    </div>
                                    <div class="post-body">
                                        <p>Proin facilisis, quam in luctus ullamcorper, mauris purus fermentum nisi, eu condimentum nunc sapien at magna. Sed tempus sem a diam tincidunt, nec accumsan libero ultricies.</p>
                                    </div>
                                    <div class="post-footer">
                                        <div class="date">Posted on: 25th August 2024</div>
                                        <div class="actions">
                                            <button type="button"><i class="fas fa-thumbs-up"></i> Like</button>
                                            <button type="button"><i class="fas fa-comment"></i> Comment</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <form>
                                    <div class="form-group">
                                        <label for="newPost">Share Something with the Community</label>
                                        <textarea class="form-control" id="newPost" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Post</button>
                                </form>
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
