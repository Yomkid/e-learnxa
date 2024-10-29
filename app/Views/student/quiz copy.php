<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quiz Center - LearnXa</title>
    <?php include(APPPATH . 'Views/student/include/student-head.php'); ?>
    <link rel="stylesheet" href="/assets/css/learningpage.css">
    <style>
        .quiz-container {
            padding: 20px;
            background-color: #f9f9f9;
        }

        .quiz-container h2 {
            margin-bottom: 20px;
        }

        .quiz-container .question {
            margin-bottom: 20px;
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .btn-previous,
        .btn-next {
            display: inline-block;
        }

        .pagination-button.active {
            background-color: #007bff;
            color: white;
        }

        .pagination-button.answered {
            background-color: #28a745;
            /* Green color for answered questions */
            color: white;
        }

        /* .timer {
            border: #007bff 1px solid;
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 20px;
            padding: 10px;
            z-index: 1030;
        } */

        .timer {
            border: #007bff 1px solid;
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 20px;
            position: fixed;
            top: 89px;
            right: 4px;
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 1030;
            padding: 10px;
        }

        .personal-details {
            border: #007bff 1px solid;
            padding: 10px;
            margin: 10px;
        }


        .student-img-lg img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
            border: rgb(9, 25, 60) solid 2px;
        }
    </style>
</head>

<body>
    <?php include(APPPATH . 'Views/student/include/quizNavbar.php'); ?>
    <div class="container mt-1">
        <div class="row">
            <div class="col-lg-4">
                <div class="sidebar-sticky bg-light">
                    <div class="text-center mt-2">
                        <h5>QUIZ</h5>
                    </div>
                    <hr>
                    <div>
                        <div class="student-img-lg d-flex text-center align-items-center justify-content-center mb-4">
                            <img src="<?= base_url('../assets/img/profile-img.jpg'); ?>" alt="Instructor Image">
                        </div>
                        <div class="btn btn-primary w-100"><?= strtoupper(session('first_name'))?> <?= strtoupper(session('last_name'))?></div>
                        <div class="personal-details">
                            <div class="bctn btn-primtary"><strong>App No:</strong> <?= session('payment_confirmation_code')?></div>
                            <div class="bttn btn-primtary"><strong>Course Title:</strong> <?= esc($quiz['course_title'])?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mt-3">
                <div class="quiz-container">
                <div class="timer" id="timer">00:00</div>
                    <form id="quiz-form">
                        <div class="question">
                            <!-- Question content will be dynamically inserted here -->
                        </div>
                    </form>
                    <div id="result" class="mt-3"></div>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button type="button" class="btn btn-primary btn-previous" onclick="previousQuestion()">Previous</button>
                    <button type="button" class="btn btn-primary btn-next" onclick="nextQuestion()">Next</button>
                </div>

                <div class="pagination mt-3">
                    <nav>
                        <ul class="pagination">
                            <!-- Pagination buttons will be dynamically inserted here -->
                        </ul>
                    </nav>
                </div>

                <div class="text-center mt-3">
                    <button type="button" class="btn btn-primary" onclick="submitQuiz()">Submit</button>
                </div>

                <footer class="bg-light py-4 mt-5">
                    <div class="container text-center">
                        <p>&copy; 2024 LearnXa. All rights reserved.</p>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        let questionBank = [];
        let currentQuestionIndex = 0;
        const quizId = <?= $quizId ?>; // Fetch the current quiz ID dynamically
        const answeredQuestions = new Set(JSON.parse(localStorage.getItem(`answeredQuestions_${quizId}`)) || []);

        // Timer settings
        const totalTime = <?= $duration ?> * 60; // 5 minutes in seconds
        let remainingTime = parseInt(localStorage.getItem(`remainingTime_${quizId}`)) || totalTime;

        async function fetchQuestions(quizId) {
            try {
                const response = await fetch(`${quizId}/questions`);
                if (!response.ok) throw new Error('Network response was not ok');

                questionBank = await response.json();
                console.log('Fetched Questions:', questionBank); // Log the fetched questions

                if (questionBank.length > 0) {
                    showQuestion(currentQuestionIndex); // Show the first question
                    updatePagination(currentQuestionIndex); // Initialize pagination
                } else {
                    document.querySelector('.question').innerHTML = '<p>No questions available for this quiz.</p>';
                }
            } catch (error) {
                console.error('Error fetching questions:', error);
                document.querySelector('.question').innerHTML = '<p>Error loading questions. Please try again.</p>';
            }
        }

        function showQuestion(index) {
            const questionData = questionBank[index];
            const questionContainer = document.querySelector('.question');

            if (questionData) {
                const options = [
                    questionData.option_a,
                    questionData.option_b,
                    questionData.option_c,
                    questionData.option_d
                ];

                questionContainer.innerHTML = `
                    <h5>${index + 1}. ${questionData.question_text}</h5>
                    ${options.map((option, idx) => `
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="question${index}" value="${option}" id="q${index}${idx}" ${isAnswered(index, option) ? 'checked' : ''}>
                            <label class="form-check-label" for="q${index}${idx}">${option}</label>
                        </div>
                    `).join('')}`;
            } else {
                questionContainer.innerHTML = '<p>Error: Question data is not available.</p>';
            }

            document.querySelector('.btn-previous').style.display = index === 0 ? 'none' : 'inline-block';
            document.querySelector('.btn-next').style.display = index === questionBank.length - 1 ? 'none' : 'inline-block';
            updatePagination(index);
        }

        function isAnswered(index, option) {
            const savedAnswers = JSON.parse(localStorage.getItem(`answers_${quizId}`)) || {};
            return savedAnswers[index] === option;
        }

        function previousQuestion() {
            if (currentQuestionIndex > 0) {
                currentQuestionIndex--;
                showQuestion(currentQuestionIndex);
                saveCurrentQuestionIndex();
            }
        }

        function nextQuestion() {
            if (currentQuestionIndex < questionBank.length - 1) {
                currentQuestionIndex++;
                showQuestion(currentQuestionIndex);
                saveCurrentQuestionIndex();
            }
        }

        function goToQuestion(index) {
            currentQuestionIndex = index;
            showQuestion(currentQuestionIndex);
            saveCurrentQuestionIndex();
        }

        function updatePagination(currentIndex) {
            const paginationContainer = document.querySelector('.pagination ul');
            paginationContainer.innerHTML = '';

            questionBank.forEach((_, index) => {
                const li = document.createElement('li');
                li.classList.add('page-item');
                li.innerHTML = `
                    <button class="page-link pagination-button ${currentIndex === index ? 'active' : ''} ${answeredQuestions.has(index) ? 'answered' : ''}" onclick="goToQuestion(${index})">${index + 1}</button>`;
                paginationContainer.appendChild(li);
            });
        }

        document.addEventListener('change', function (event) {
            if (event.target.matches('.form-check-input')) {
                answeredQuestions.add(currentQuestionIndex);
                updatePagination(currentQuestionIndex);

                const answers = JSON.parse(localStorage.getItem(`answers_${quizId}`)) || {};
                answers[currentQuestionIndex] = event.target.value;
                localStorage.setItem(`answers_${quizId}`, JSON.stringify(answers));
                localStorage.setItem(`answeredQuestions_${quizId}`, JSON.stringify(Array.from(answeredQuestions)));
            }
        });

        async function submitQuiz() {
            const answers = JSON.parse(localStorage.getItem(`answers_${quizId}`)) || {};
            const userId = <?= session('user_id') ?>;
            const courseId = <?= $courseId ?>;
            const timeTaken = totalTime - remainingTime;

            try {
                const response = await fetch(`/student/quiz/submit`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ user_id: userId, quiz_id: quizId, course_id: courseId, answers: answers, time_taken: timeTaken }),
                });

                const result = await response.json();

                if (response.ok) {
                    document.getElementById('result').innerHTML = `
                        <p>${result.message}</p>
                        <p>Your score: ${result.score}/${Object.keys(answers).length}</p>
                        <p>Status: ${result.isPassed ? 'Passed' : 'Failed'}</p>
                    `;
                } else {
                    document.getElementById('result').innerHTML = `<p>Error: ${result.message}</p>`;
                }
            } catch (error) {
                console.error('Error submitting quiz:', error);
                document.getElementById('result').innerHTML = '<p>Error submitting quiz. Please try again.</p>';
            }
        }

        function startTimer() {
            const timerElement = document.getElementById('timer');
            const intervalId = setInterval(() => {
                if (remainingTime <= 0) {
                    clearInterval(intervalId);
                    alert('Time is up! Your quiz will be submitted automatically.');
                    submitQuiz();
                } else {
                    remainingTime--;
                    const minutes = Math.floor(remainingTime / 60);
                    const seconds = remainingTime % 60;
                    timerElement.innerHTML = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                    localStorage.setItem(`remainingTime_${quizId}`, remainingTime);
                }
            }, 1000);
        }

        document.addEventListener('DOMContentLoaded', function () {
            fetchQuestions(quizId);
            startTimer();
        });

        function saveCurrentQuestionIndex() {
            localStorage.setItem(`currentQuestionIndex_${quizId}`, currentQuestionIndex);
        }
    </script>

</body>

</html>
