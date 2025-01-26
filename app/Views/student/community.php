<!DOCTYPE html>
<html lang="en">

<head>
    <title>Community | LearnXa</title>
    <?php include(APPPATH . 'Views/student/include/student-head.php'); ?>
    <style>
        /* Community Section Styles */
        .community-section {
            margin: 20px 0;
        }

        .post-card {
            border: 1px solid #f1f1f1;
            border-radius: 15px;
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
        }

        .post-header {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .post-header img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
        }

        .post-header .username {
            font-size: 16px;
            font-weight: bold;
            color: #1da1f2;
        }

        .post-body {
            margin-top: 10px;
            font-size: 15px;
            color: #1c1c1e;
        }

        .post-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-size: 13px;
        }

        .post-footer .actions button {
            border: none;
            background: none;
            color: #1da1f2;
            cursor: pointer;
        }

        .new-post {
            background: #fff;
            border: 1px solid #f2f2f2;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .new-post textarea {
            background: #f1f1f1;
            color: #1c1c1e;
            border: none;
            width: 100%;
            border-radius: 10px;
            padding: 10px;
            font-size: 15px;
        }

        .new-post button {
            margin-top: 10px;
            background: #1da1f2;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
        }

        /* Right Sidebar Styles */
        .right-sidebar {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
        }

        .sidebar-section {
            margin-bottom: 20px;
        }

        .sidebar-section h5 {
            font-size: 18px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .sidebar-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .sidebar-item a {
            text-decoration: none;
            color: #1da1f2;
        }

        .sidebar-item a:hover {
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
            <!-- Sidebar -->
            <div class="col-lg-2 col-md-6">
                <?php include(APPPATH . 'Views/student/include/student-sidebar.php'); ?>
            </div>

            <!-- Main Content -->
            <div class="col-lg-7 col-md-6">
                <?php include(APPPATH . 'Views/student/include/student-navbar.php'); ?>

                <div class="main-container mt-2 p-2" id="mainContent">
                    <div class="community-section">
                        <div class="mb-4">
                            <div class="category-header" style="font-size:24px;">
                                Community
                            </div>
                            <p>Engage with fellow students and educators. Share your thoughts, ask questions, and
                                collaborate.</p>
                        </div>
                        <hr>
                        <!-- New Post -->
                        <div class="new-post">
                            <textarea rows="3" placeholder="What's happening?"></textarea>
                            <button type="button">Post</button>
                        </div>

                        <!-- Post Feed -->
                        <div class="post-card">
                            <div class="post-header">
                                <img src="../assets/img/boy-cartoon.jpeg" alt="User Avatar">
                                <div class="username">Morayo Peter</div>
                            </div>
                            <div class="post-body">
                                "Just completed my first full-stack project! 🚀 Huge shoutout to the LearnXa mentors for
                                their guidance. Couldn't have done it without you all! Here’s to more coding adventures.
                                🙌"
                            </div>
                            <div class="post-footer">
                                <div class="actions">
                                    <button><i class="fas fa-heart"></i> Like</button>
                                    <button><i class="fas fa-comment"></i> Comment</button>
                                </div>
                                <div class="date">20th August 2024</div>
                            </div>
                        </div>

                        <!-- Additional Posts -->
                        <div class="post-card">
                            <div class="post-header">
                                <img src="../assets/img/animated.jpeg" alt="User Avatar">
                                <div class="username">Jenny Smith</div>
                            </div>
                            <div class="post-body">
                                "Sharing some tips for effective study planning: 1️⃣ Break your tasks into small chunks,
                                2️⃣ Set realistic daily goals, and 3️⃣ Take regular breaks. Stay consistent and keep
                                learning! 💡 Have questions? Drop them below."
                            </div>
                            <div class="post-footer">
                                <div class="actions">
                                    <button><i class="fas fa-heart"></i> Like</button>
                                    <button><i class="fas fa-comment"></i> Comment</button>
                                </div>
                                <div class="date">25th August 2024</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <!-- Right Sidebar -->
            <div class="col-lg-3 d-none d-lg-block">
                <div class="right-sidebar">
                    <!-- Trending Topics -->
                    <div class="sidebar-section">
                        <h5>Trending Topics</h5>
                        <div class="sidebar-item"><a href="#">Exam Prep Tips</a></div>
                        <div class="sidebar-item"><a href="#">Group Projects</a></div>
                        <div class="sidebar-item"><a href="#">Coding Challenges</a></div>
                    </div>

                    <!-- Suggested Courses -->
                    <div class="sidebar-section">
                        <h5>Suggested Courses</h5>
                        <div class="sidebar-item">
                            <div class="sidebar-item-course">
                                <img src="../assets/img/helloclass-ui.webp" alt="Course Thumbnail"
                                    style="width: 50px; margin-right: 2px;">
                                <a href="#">UI/UX Design for Beginners</a>
                            </div>
                        </div>
                        <div class="sidebar-item">
                            <div class="sidebar-item-course">
                                <img src="../assets/img/datasci-topic-img.jpg" alt="Course Thumbnail"
                                    style="width: 50px; margin-right: 2px;">
                                <a href="#">Data Science Basics</a>
                            </div>
                        </div>
                        <div class="sidebar-item">
                            <div class="sidebar-item-course">
                                <img src="../assets/img/webdev-topic-img.jpg" alt="Course Thumbnail"
                                    style="width: 50px; margin-right: 2px;">
                                <a href="#">Web Development</a>
                            </div>
                        </div>
                        <a href="#" class="text-primary">Explore More Courses</a>
                    </div>

                    <!-- Upcoming Events -->
                    <div class="sidebar-section">
                        <h5>Upcoming Events</h5>
                        <div class="sidebar-item"><span>Live Class: Advanced JavaScript</span> <a href="#">Details</a>
                        </div>
                        <div class="sidebar-item"><span>Assignment Deadline: CSS Grid</span> <a href="#">Details</a>
                        </div>
                        <a href="#" class="text-primary">View Calendar</a>
                    </div>

                    <!-- Notifications -->
                    <div class="sidebar-section">
                        <h5>Notifications</h5>
                        <ul class="list-unstyled">
                            <li>Your assignment 'Intro to React' has been graded.</li>
                            <li>New reply to your question in 'Community Forum.'</li>
                        </ul>
                        <a href="#" class="text-primary">View All Notifications</a>
                    </div>

                    <!-- Top Community Posts -->
                    <div class="sidebar-section">
                        <h5>Top Community Posts</h5>
                        <ul class="list-unstyled">
                            <li>John Doe: "Does anyone have resources on cloud computing?"</li>
                        </ul>
                        <a href="#" class="text-primary">Join the Discussion</a>
                    </div>

                    <!-- Quick Actions -->
                    <div class="sidebar-section">
                        <h5>Quick Actions</h5>
                        <button class="btn btn-primary btn-block mb-2">Upload Assignment</button>
                        <button class="btn btn-primary btn-block">View Grades</button>
                    </div>

                    <!-- Help & Support -->
                    <div class="sidebar-section">
                        <h5>Need Help?</h5>
                        <a href="#" class="text-primary d-block">FAQ</a>
                        <button class="btn btn-secondary btn-block mt-2">Contact Support</button>
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
