<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quizzes | LearnXa</title>
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

        .card {
            border: 1px solid #ddd;
            border-radius: 0px;
        }

        .card img {
            max-height: 150px;
            object-fit: cover;
            width: 100%;
            border-radius: 5px;
        }


        .progress-container {
            /* position: fixed; */
            /* top: 75px;
            right: 4px; */
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 1030;
            /* Ensure it's on top of other elements */
        }


        .progress-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            /* background: conic-gradient(#4caf50 var(--percentage), #e0e0e0 0); */
            /* background-color: #007bff; */
            background: conic-gradient(var(--color1) 0% 25%,
                    var(--color2) 25% 50%,
                    var(--color3) 50% 75%,
                    var(--color4) 75% 100%);
            clip-path: circle(50%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin: 0 auto;
            transition: background 0.3s;
        }

        .progress-circle::before {
            content: attr(data-percentage) '%';
            width: 45px;
            height: 45px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            font-weight: bold;
            color: #333;
            position: absolute;
        }

        .progress-text {
            font-size: 1rem;
            text-align: center;
            margin-top: 10px;
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
                            Quizzes
                        </div>
                        <p>Below are the quiz assigned to the course(s) you enrolled for.</p>
                    </div>
                    <hr>


                    <div class="container mt-4">
                        <div class="row">
                            <?php if (!empty($quizzes)) : ?>
                            <?php foreach ($quizzes as $quiz): ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title"><?= esc($quiz['quiz_name']) ?></h6>
                                        <strong>Course:</strong> <?= $quiz['course_title'] ?>
                                        
                                        <!-- <div class="progress-container">
                                            <div class="progress-circle" data-percentage="<?= number_format($quiz['highest_score'] ?? 0) ?>"
                                                style="--percentage: <?= number_format($quiz['highest_score'] ?? 0) * 3.6; ?> deg;">
                                            </div>
                                        </div> -->
                                        <hr>
                                        <div class="d-flex align-items-centter justify-content-between">
                                            <p class="card-text">
                                                <strong>Duration:</strong> <?= $quiz['duration'] ?> minutes<br>
                                                <strong>Passing Score:</strong> <?= $quiz['passing_score'] ?>%<br>
                                                <strong>Total Marks:</strong> <?= $quiz['total_marks'] ?><br>
                                                <strong>Attempts Allowed:</strong>
                                                <?= $quiz['max_attempts'] ? $quiz['max_attempts'] : 'Unlimited' ?><br>
                                                <strong>Type:</strong> <?= ucfirst($quiz['quiz_type']) ?><br>
                                                <strong>Status:</strong>
                                                <?= ($quiz['published'] && $quiz['is_active']) ? 'Available' : 'Unavailable' ?><br>
                                                <strong>Highest Score:</strong> <?= isset($quiz['highest_score']) ? number_format($quiz['highest_score']) : 'N/A' ?><br>
                                                <strong>Attempted:</strong> <?= esc($quiz['attempt_count']) ?> times<br>
                                            </p>
                                            <div class="progress-container mt-n5">
                                            <div class="progress-circle" data-percentage="<?= number_format($quiz['highest_score'] ?? 0) ?>"
                                                style="--percentage: <?= number_format($quiz['highest_score'] ?? 0) * 3.6; ?> deg;">
                                            </div>
                                            
                                        </div>
                                        </div>
                                        
                                        <?php if (!empty($quiz['image_url'])): ?>
                                        <img src="<?= esc($quiz['image_url']) ?>" alt="Quiz Thumbnail"
                                            class="img-fluid mb-3" hidden>
                                        <?php endif; ?>
                                        <!-- <p><?= ($quiz['quiz_description']) ?></p> -->
                                        <strong>Last Attempt:</strong> <?= isset($quiz['last_attempt_date']) ? date('Y-m-d', strtotime($quiz['last_attempt_date'])) : 'No attempts yet' ?><br>

                                        <!-- Conditionally display "Start" button based on quiz status and attempt limit -->
                                        <?php if (!$quiz['published'] || !$quiz['is_active']): ?>
                                            <!-- Unavailable quiz -->
                                            <button class="btn btn-secondary w-100" disabled>
                                                <i class="fa fa-lock"></i> Unavailable
                                            </button>
                                        <?php elseif ($quiz['attempt_count'] >= 3): ?>
                                            <!-- Exceeded attempt limit -->
                                            <button class="btn btn-secondary w-100" disabled>Limit Reached</button>
                                        <?php else: ?>
                                            <!-- Quiz available and within attempt limit -->
                                            <a href="/student/quiz/<?= esc($quiz['quiz_id']) ?>" class="btn btn-primary w-100">Start</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php else : ?>
                            <div class="col-12">
                                <p class="text-danger">No quizzes available.</p>
                            </div>
                            <?php endif; ?>
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



        // Progress Circle Styling
        document.querySelectorAll('.progress-circle').forEach(function (circle) {
            var percentage = circle.getAttribute('data-percentage');
            var degrees = (percentage / 100) * 360;
            circle.style.setProperty('--percentage', degrees + 'deg');
            circle.style.setProperty('--color1', percentage >= 25 ? '#f44336' : '#e0e0e0');
            circle.style.setProperty('--color2', percentage >= 50 ? '#ff9800' : '#e0e0e0');
            circle.style.setProperty('--color3', percentage >= 75 ? '#ffeb3b' : '#e0e0e0');
            circle.style.setProperty('--color4', percentage === 100 ? '#4caf50' : '#e0e0e0');
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