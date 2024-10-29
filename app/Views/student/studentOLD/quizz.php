<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Page | LearnXa</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        .quiz-container {
            padding: 2rem;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .quiz-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .course-list {
            list-style: none;
            padding: 0;
        }
        .course-list li {
            margin-bottom: 1rem;
        }
        .course-list a {
            display: block;
            padding: 1rem;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
        }
        .course-list a:hover {
            background-color: #0056b3;
        }
        .quiz-list {
            margin-top: 2rem;
        }
        .quiz-list .card {
            margin-bottom: 1rem;
        }
        .quiz-list .card-header {
            background-color: #007bff;
            color: #fff;
        }
        .quiz-list .card-body {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 col-md-6">
            <?php include(APPPATH . 'Views/student/include/student-sidebar.php'); ?>
        </div>

        <div class="col-lg-10 col-md-6">
            <?php include(APPPATH . 'Views/student/include/student-navbar.php'); ?>

            <div class="main-container mt-2 p-2" id="mainContent">
                <div class="quiz-container">
                    <div class="quiz-header">
                        Available Courses
                    </div>
                    <ul class="course-list">
                        <!-- Example of course list items -->
                        <li><a href="javascript:void(0);" onclick="showQuizzes('course1');">Course 1</a></li>
                        <li><a href="javascript:void(0);" onclick="showQuizzes('course2');">Course 2</a></li>
                        <li><a href="javascript:void(0);" onclick="showQuizzes('course3');">Course 3</a></li>
                        <!-- More courses can be dynamically added here -->
                    </ul>
                    <div class="quiz-list" id="quizList">
                        <!-- Quizzes will be displayed here -->
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
    function showQuizzes(courseId) {
        const quizList = document.getElementById('quizList');
        quizList.innerHTML = '';

        // Example quizzes for each course (this should be dynamically loaded from your backend)
        const quizzes = {
            'course1': [
                { id: 1, name: 'Quiz 1 for Course 1' },
                { id: 2, name: 'Quiz 2 for Course 1' }
            ],
            'course2': [
                { id: 3, name: 'Quiz 1 for Course 2' },
                { id: 4, name: 'Quiz 2 for Course 2' }
            ],
            'course3': [
                { id: 5, name: 'Quiz 1 for Course 3' },
                { id: 6, name: 'Quiz 2 for Course 3' }
            ]
        };

        if (quizzes[courseId]) {
            quizzes[courseId].forEach(quiz => {
                const quizCard = document.createElement('div');
                quizCard.className = 'card';
                quizCard.innerHTML = `
                    <div class="card-header">${quiz.name}</div>
                    <div class="card-body">
                        <a href="quiz.php?quiz_id=${quiz.id}" class="btn btn-primary">Take Quiz</a>
                    </div>
                `;
                quizList.appendChild(quizCard);
            });
        }
    }

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
