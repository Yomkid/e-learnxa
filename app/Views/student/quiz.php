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


        .timer {
            border: #007bff 1px solid;
            background-color: #007bff;
            color: #fff;
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 20px;
            position: fixed;
            /* top: 68px;
            left: 338px; */
            display: flex;
            flex-direction: column;
            align-items: center;
            /* z-index: 1030; */
            padding: 10px;
            margin-left: -20px;
            margin-top: -44px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .personal-details {
            border: #007bff 1px solid;
            padding: 10px;
            margin: 10px;
        }

        .student-name-container {
            background-color: #007bff;
            margin: 0 10px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            padding: 10px;

        }


        .student-img-lg img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
            /* border: rgb(9, 25, 60) solid 2px; */
            border: #007bff solid 2px;
            padding: 5px;
        }



        .questionNums {
            padding: 10px;
            border: 1.5px solid #dee2e6;
            /* equivalent to var(--grey-400) */
            position: sticky;
            top: 60px;
            background-color: #fff;
            /* Ensure it doesn't overlap other elements */
        }

        .questionNum {
            font-size: 13px;
            color: #343a40;
            /* equivalent to var(--grey-800) */
            border: 1.5px solid #dee2e6;
            /* equivalent to var(--grey-400) */
            height: 35px;
            width: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
        }

        .questionNum.completed {
            background-color: #d4edda;
            /* Light green for completed questions */
            border-color: #c3e6cb;
        }


        .calculator {
            position: fixed;
            top: 190px;
            right: 40px;
            width: 200px;
            background-color: #7b7777;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 999;
            transition: transform 0.5s ease-in-out;
            transform: translateX(100%);
            overflow: auto;
            max-height: calc(100vh - 190px);
            /* Ensures it stays within the viewport */
        }

        /* Slide animation classes */
        .slide-right {
            transform: translateX(120%);
        }

        .slide-left {
            transform: translateX(0);
        }

        /* Floating Button */
        .floating-button {
            position: fixed;
            bottom: 5px;
            right: 40px;
            background-color: #007bff;
            color: white;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 999;
        }

        .floating-button:hover {
            background-color: #0056b3;
        }

        /* Calculator buttons */
        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 5px;
        }

        .buttons button {
            padding: 10px;
            font-size: 16px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
        }

        .buttons button:hover {
            background-color: #e0e0e0;
        }

        .buttons button:active {
            background-color: #d0d0d0;
        }

      /* Sidebar styles */
        .quiz-sidebar {
            position: fixed;
            top: 80px; /* Adjust based on your header height */
            left: -100%; /* Hide the sidebar off-screen */
            width: 100%; /* Full width for smaller screens */
            max-width: 320px; /* Fixed width for larger screens */
            height: calc(100vh - 80px); /* Full height minus the top offset */
            background-color: #f8f9fa;
            z-index: 1100;
            overflow-y: auto;
            transition: left 0.4s ease; /* Smooth sliding animation */
            /* padding: 10px; */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* When the sidebar is open, slide it into view */
        .quiz-sidebar.open {
            left: 0; /* Slide the sidebar in from the left */
        }

        /* Additional styling for larger screens */
        @media (min-width: 992px) {
            .quiz-sidebar {
                position: sticky; /* Sidebar stays sticky on larger screens */
                left: 0; /* No sliding needed on larger screens */
                width: auto;
            }

            .main-content {
            padding: 20px;
            transition: margin-left 0.4s ease; /* Smooth transition */
        }
        }

        .main-content {
            /* padding: 20px; */
            transition: margin-left 0.4s ease; /* Smooth transition */
        }

        /* For smaller screens */
        @media (max-width: 991px) {
            .quiz-sidebar {
                width: 100%; /* Sidebar takes 100% width */
                top: auto;
                height: auto;
            }
            

        
        }

        /* For very small screens (e.g., mobile) */
        @media (max-width: 576px) {
        
            /* Show a button to toggle the sidebar */
            .sidebar-toggle {
                display: block;
                position: fixed;
                top: 10px;
                right: 10px;
                background-color: #007bff;
                color: white;
                padding: 10px;
                border-radius: 5px;
                z-index: 1100;
                cursor: pointer;
            }

            /* Sidebar visible when the toggle button is clicked */
            .quiz-sidebar.open {
                position: fixed;
                top: 60px;
                left: 0;
                width: 100%;
                height: calc(100vh - 50px);
                background-color: #f8f9fa;
                z-index: 1000;
                overflow-y: auto;
                /* padding: 20px; */
            }

            
        }

        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.4s ease;
        }

        .quiz-sidebar.open ~ .overlay {
            opacity: 1;
            visibility: visible;
        }

        .sub-brand{
            background-color: #0056b3;
            padding: 5px;
            color: #fff;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .loader {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }




    </style>
</head>

<body>
    <?php include(APPPATH . 'Views/student/include/quizNavbar.php'); ?>
    <div class="container-fluid mt-1">
        <div class="row">
   
            <div  class="col-lg-3">
                <div id="quizSidebar" class="quiz-sidebar  bg-light">
                    <div class="text-center mt-2">
                        <h5>QUIZ CENTER</h5>
                    </div>
                    <hr>
                    <div>
                        <div class="student-img-lg d-flex text-center align-items-center justify-content-center mb-4">
                            <img src="<?= base_url('../assets/img/animated.jpeg'); ?>" alt="Instructor Image">
                        </div>

                        <div class="student-name-container w-10o0"><?= strtoupper(session('first_name'))?>
                            <?= strtoupper(session('last_name'))?></div>
                        <div class="personal-details">

                            <div class="bctn btn-primtary"><strong>App No:</strong>
                                <?= session('payment_confirmation_code')?></div>
                            <div class="bttn btn-primtary"><strong>Course Title:</strong>
                                <?= esc($quiz['course_title'])?></div>
                        </div>
                    </div>
                    <footer class="bg-light py-4 mt-5 d-md-none">
                            <div class="container text-center">
                                <p>&copy; 2024 LearnXa. All rights reserved.</p>
                            </div>
                        </footer>
                </div>
                <!-- Overlay -->
                <div class="overlay"></div>
            </div>

            <div class="col-lg-9 main-content">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="quiz-container">
                        <div class="timer" id="timer">00:00</div>

                            <form id="quiz-form">
                                <div class="question mt-2">
                                    <!-- Question content will be dynamically inserted here -->
                                    <!-- <div class="loader"></div> -->
                                </div>
                            </form>
                            <div id="result" class="mt-3"></div>
                            
                        </div>
                        


                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-primary btn-previous"
                                onclick="previousQuestion()">Previous</button>
                            <button type="button" class="btn btn-primary btn-next"
                                onclick="nextQuestion()">Next</button>
                        </div>

                        <div class="pagination mt-3">
                            <nav>
                                <ul class="pagination">
                                    <!-- Pagination buttons will be dynamically inserted here -->
                                </ul>
                            </nav>
                        </div>


                            <!-- Modal for Submit Confirmation -->
                        <div class="modal fade" id="submitConfirmationModal" tabindex="-1" aria-labelledby="submitConfirmationLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="submitConfirmationLabel">Submit Quiz</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to submit your quiz?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger" id="confirmSubmitButton">Yes, Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <!-- <button type="button" class="btn btn-primary" onclick="submitQuiz()">Submit</button> -->
                            <button id="submit-button" class="btn btn-primary" onclidck="submitQuiz()" disabled>Submit
                                Quiz</button>

                        </div>

                        <footer class="bg-light py-4 mt-5 d-ms-none">
                            <div class="container text-center">
                                <p>&copy; 2024 LearnXa. All rights reserved.</p>
                            </div>
                        </footer>
                    </div>
                    <div class="col-lg-4">
                        
                        <div class="bg-light">
                            <div class="text-center btn-primary p-2" id="attemptedCount">
                                <strong></strong>
                            </div>
                            <div class="questionNums row row-cols-5 gx-2 gy-3 justify-content-center mt-1" id="questionGrid">
                                <!-- Question numbers will be generated here -->
                            </div>
                        </div>

                        <!-- Floating Button -->
                        <button id="calculator-toggle" class="floating-button btn btn-primary">
                                Open Calculator <i class="fas fa-calculator"></i>
                            </button>

                            <!-- Calculator -->
                            <div id="calculator" class="calculator slide-right">
                                <input type="text" id="display" class="form-control mb-3" readonly />
                                <div class="buttons">
                                    <button class="btn btn-light">7</button>
                                    <button class="btn btn-light">8</button>
                                    <button class="btn btn-light">9</button>
                                    <button class="btn btn-danger">C</button>
                                    <button class="btn btn-light">4</button>
                                    <button class="btn btn-light">5</button>
                                    <button class="btn btn-light">6</button>
                                    <button class="btn btn-secondary">/</button>
                                    <button class="btn btn-light">1</button>
                                    <button class="btn btn-light">2</button>
                                    <button class="btn btn-light">3</button>
                                    <button class="btn btn-secondary">*</button>
                                    <button class="btn btn-light">0</button>
                                    <button class="btn btn-light">.</button>
                                    <button class="btn btn-secondary">=</button>
                                    <button class="btn btn-secondary">+</button>
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
        <script>
            let questionBank = [];
            let currentQuestionIndex = 0;
            const quizId = <?= $quizId ?>;
            let answeredQuestions = new Set(Object.keys(JSON.parse(localStorage.getItem(`answers_${quizId}`)) || {}));
            const totalTime = <?= $duration ?> * 60;
            let remainingTime = parseInt(localStorage.getItem(`remainingTime_${quizId}`)) || totalTime;
            let timerInterval;

            async function fetchQuestions(quizId) {
                document.querySelector('.question').innerHTML = '<div class="loader"></div>';
                try {
                    const response = await fetch(`${quizId}/questions`);
                    if (!response.ok) throw new Error('Network response was not ok');
                    questionBank = await response.json();

                    if (questionBank.length > 0) {
                        showQuestion(currentQuestionIndex);
                        updatePagination(currentQuestionIndex);
                        startTimer();
                    } else {
                        document.querySelector('.question').innerHTML = '<p>No questions available for this quiz.</p>';
                    }
                } catch (error) {
                    console.error('Error fetching questions:', error);
                    document.querySelector('.question').innerHTML = '<p>Error loading questions. Please try again.</p>';
                }
            }

            function showQuestion(index) {
                const questionContainer = document.querySelector('.question');
                // questionContainer.innerHTML = '<div class="loader"></div>'; // Loader while loading question

                setTimeout(() => {
                    const questionData = questionBank[index];
                    if (questionData) {
                        const options = {
                            'A': questionData.option_a,
                            'B': questionData.option_b,
                            'C': questionData.option_c,
                            'D': questionData.option_d
                        };

                        questionContainer.innerHTML = `
                            <h5>${index + 1}. ${questionData.question_text}</h5>
                            ${Object.keys(options).map(key => `
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="question${questionData.question_id}" value="${key}" id="q${questionData.question_id}${key}" ${isAnswered(questionData.question_id, key) ? 'checked' : ''} onchange="updateAnswer(${questionData.question_id}, '${key}')">
                                    <label class="form-check-label" for="q${questionData.question_id}${key}">${options[key]}</label>
                                </div>
                            `).join('')}`;

                        document.querySelector('.btn-previous').style.display = index === 0 ? 'none' : 'inline-block';
                        document.querySelector('.btn-next').style.display = index === questionBank.length - 1 ? 'none' : 'inline-block';
                        updatePagination(index);
                    }
                }, 300); // Optional delay for smoother transition
            }

            function updatePagination(index) {
                const paginationElement = document.getElementById('pagination');
                if (paginationElement) {
                    paginationElement.textContent = `Question ${index + 1} of ${questionBank.length}`;
                }
            }

            function nextQuestion() {
                if (currentQuestionIndex < questionBank.length - 1) {
                    currentQuestionIndex++;
                    showQuestion(currentQuestionIndex);
                }
            }

            function previousQuestion() {
                if (currentQuestionIndex > 0) {
                    currentQuestionIndex--;
                    showQuestion(currentQuestionIndex);
                }
            }

            function updateAnswer(questionId, selectedOption) {
                let savedAnswers = JSON.parse(localStorage.getItem(`answers_${quizId}`)) || {};
                savedAnswers[questionId] = selectedOption;
                localStorage.setItem(`answers_${quizId}`, JSON.stringify(savedAnswers));
                answeredQuestions.add(questionId.toString());
                renderQuestionsAttempted();
                checkAnsweredQuestions();
            }

            function isAnswered(questionId, option) {
                const savedAnswers = JSON.parse(localStorage.getItem(`answers_${quizId}`)) || {};
                return savedAnswers[questionId] === option;
            }

            function renderQuestionsAttempted() {
                const questionNumsContainer = document.querySelector('.questionNums');
                questionNumsContainer.innerHTML = '';
                const totalQuestions = questionBank.length;
                const savedAnswers = JSON.parse(localStorage.getItem(`answers_${quizId}`)) || {};
                const answeredCount = Object.keys(savedAnswers).length;

                const attemptedText = document.querySelector('.btn-primary strong');
                if (attemptedText) {
                    attemptedText.textContent = `Questions Attempted ${answeredCount}/${totalQuestions}`;
                }

                questionBank.forEach((_, index) => {
                    const questionCol = document.createElement('div');
                    questionCol.classList.add('col');
                    const questionNumDiv = document.createElement('div');
                    questionNumDiv.classList.add('questionNum');
                    questionNumDiv.textContent = index + 1;
                    if (savedAnswers[questionBank[index].question_id]) questionNumDiv.classList.add('completed');
                    questionNumDiv.addEventListener('click', () => {
                        currentQuestionIndex = index;
                        showQuestion(currentQuestionIndex);
                    });
                    questionCol.appendChild(questionNumDiv);
                    questionNumsContainer.appendChild(questionCol);
                });
            }

            function checkAnsweredQuestions() {
                const submitButton = document.getElementById('submit-button');
                submitButton.disabled = answeredQuestions.size === 0;
            }

            function startTimer() {
                const timerElement = document.getElementById('timer');
                if (!timerElement) return;

                clearInterval(timerInterval);
                timerInterval = setInterval(() => {
                    if (remainingTime <= 0) {
                        clearInterval(timerInterval);
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

            async function submitQuiz() {
                const resultContainer = document.getElementById('result');
                resultContainer.innerHTML = '<div class="loader"></div>'; // Loader while submitting
                clearInterval(timerInterval);
                let answers = JSON.parse(localStorage.getItem(`answers_${quizId}`)) || {};
                const userId = <?= session('user_id') ?>;
                const courseId = <?= $courseId ?>;
                const totalMarks = <?= $totalMarks ?>;
                const timeTaken = totalTime - remainingTime;

                try {
                    const response = await fetch(`/student/quiz/submit`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            user_id: userId,
                            quiz_id: quizId,
                            course_id: courseId,
                            answers: answers,
                            time_taken: timeTaken
                        })
                    });

                    const result = await response.json();
                    resultContainer.innerHTML = `
                        <p>${result.message}</p>
                        <p>Your score: ${result.score}/${totalMarks}</p>
                        <p>Status: ${result.isPassed ? 'Passed' : 'Failed'}</p>
                    `;

                    document.getElementById('submit-button').textContent = "Retake Quiz";
                    document.getElementById('submit-button').onclick = retakeQuiz;
                    localStorage.removeItem(`remainingTime_${quizId}`);
                    localStorage.removeItem(`answers_${quizId}`);
                } catch (error) {
                    console.error('Error submitting quiz:', error);
                    resultContainer.innerHTML = '<p>Error submitting quiz. Please try again.</p>';
                }
            }

            function retakeQuiz() {
                document.getElementById('result').innerHTML = '<div class="loader"></div>';
                localStorage.removeItem(`answers_${quizId}`);
                localStorage.removeItem(`remainingTime_${quizId}`);
                currentQuestionIndex = 0;
                remainingTime = totalTime;
                answeredQuestions.clear();

                fetchQuestions(quizId).then(() => {
                    showQuestion(currentQuestionIndex);
                    renderQuestionsAttempted();
                    startTimer();
                });

                document.getElementById('result').innerHTML = '';
                document.getElementById('submit-button').textContent = "Submit Quiz";
                document.getElementById('submit-button').onclick = () => $('#submitConfirmationModal').modal('show');
            }

            document.addEventListener('DOMContentLoaded', function () {
                fetchQuestions(quizId).then(() => {
                    renderQuestionsAttempted();
                    showQuestion(currentQuestionIndex);
                    checkAnsweredQuestions();
                });

                const submitButton = document.getElementById('submit-button');
                const confirmSubmitButton = document.getElementById('confirmSubmitButton');

                if (submitButton) {
                    submitButton.onclick = () => $('#submitConfirmationModal').modal('show');
                }

                if (confirmSubmitButton) {
                    confirmSubmitButton.onclick = () => {
                        $('#submitConfirmationModal').modal('hide');
                        submitQuiz();
                    };
                }
            });
        </script>





  



</body>

</html>