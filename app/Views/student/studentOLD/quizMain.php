<?php
error_reporting(1);
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
    </style>
</head>

<body>
    <?php include(APPPATH . 'Views/student/include/quizNavbar.php'); ?>
    <div class="container mt-1">
        <div class="row">
            <div class="col-lg-4">
                <div class="sidebar-sticky bg-light">
                    <div class="text-center mt-2">
                        <h5>Course Quiz List</h5>
                    </div>
                    <hr>
                    <ul class="sidebar-module-list">
                        <li class="completed"><i class="fas fa-check-circle"></i><a href="#">Quiz 1: </a></li>
                        <li class="completed active"><i class="fas fa-check-circle"></i><a href="#">Quiz 2: HTML &
                                CSS Fundamentals</a></li>
                        <li class="uncompleted"><i class="fas fa-check-circle"></i><a href="#">Quiz 3: JavaScript
                                Basics</a></li>
                        <li class="uncompleted"><i class="fas fa-check-circle"></i><a href="#">Module 4: Advanced
                                JavaScript Concepts</a></li>
                        <li class="completed"><i class="fas fa-check-circle"></i><a href="#">Module 5: Responsive
                                Web Design</a></li>
                        <li class="completed"><i class="fas fa-check-circle"></i><a href="#">Module 6: Introduction
                                to Web Development</a></li>

                    </ul>
                </div>
            </div>
            <div class="col-lg-8 mt-3">
                <!-- <div class="progress-container">
                    <div class="progress-circle" data-percentage="75" style="--percentage: 270deg;"></div>
                </div> -->

                <script>
                    document.querySelectorAll('.progress-circle').forEach(function (circle) {
                        var percentage = circle.getAttribute('data-percentage');
                        var degrees = (percentage / 100) * 360;
                        var color1 = percentage >= 25 ? '#4caf50' : '#e0e0e0';
                        var color2 = percentage >= 50 ? '#ffeb3b' : '#e0e0e0';
                        var color3 = percentage >= 75 ? '#ff9800' : '#e0e0e0';
                        var color4 = percentage == 100 ? '#f44336' : '#e0e0e0';

                        circle.style.setProperty('--color1', color1);
                        circle.style.setProperty('--color2', color2);
                        circle.style.setProperty('--color3', color3);
                        circle.style.setProperty('--color4', color4);
                        circle.style.setProperty('--percentage', degrees + 'deg');
                    });
                </script>

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
                    <button type="button" class="btn btn-primary btn-previous"
                        onclick="previousQuestion()">Previous</button>
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
        const questionBank = [{
                question: "What does HTML stand for?",
                options: ["Hyper Text Markup Language", "Home Tool Markup Language",
                    "Hyperlinks and Text Markup Language"
                ],
                correctAnswer: "Hyper Text Markup Language"
            },
            {
                question: "What does CSS stand for?",
                options: ["Cascading Style Sheets", "Colorful Style Sheets", "Computer Style Sheets"],
                correctAnswer: "Cascading Style Sheets"
            },
            {
                question: "What does JS stand for?",
                options: ["JavaScript", "JavaScripting", "JustScript"],
                correctAnswer: "JavaScript"
            },
            {
                question: "What is Bootstrap?",
                options: ["A CSS framework", "A JavaScript library", "A programming language"],
                correctAnswer: "A CSS framework"
            },
            {
                question: "What does SQL stand for?",
                options: ["Structured Query Language", "Strong Question Language", "Structured Query Logic"],
                correctAnswer: "Structured Query Language"
            },
            {
                question: "What is PHP?",
                options: ["A server-side scripting language", "A client-side scripting language", "A database"],
                correctAnswer: "A server-side scripting language"
            },
            {
                question: "What is React?",
                options: ["A JavaScript library for building user interfaces", "A CSS framework", "A database"],
                correctAnswer: "A JavaScript library for building user interfaces"
            },
            {
                question: "What does JSON stand for?",
                options: ["JavaScript Object Notation", "JavaScript Online Notation", "JavaScript Object Native"],
                correctAnswer: "JavaScript Object Notation"
            },
            {
                question: "What is an API?",
                options: ["Application Programming Interface", "Application Programming Internet",
                    "Application Programming Interact"
                ],
                correctAnswer: "Application Programming Interface"
            },
            {
                question: "What does DOM stand for?",
                options: ["Document Object Model", "Document Object Manipulation", "Data Object Model"],
                correctAnswer: "Document Object Model"
            }
        ];

        let currentQuestionIndex = parseInt(localStorage.getItem('currentQuestionIndex')) || 0;
        const totalQuestions = questionBank.length;
        const answeredQuestions = new Set(JSON.parse(localStorage.getItem('answeredQuestions')) || []);

        // Timer settings
        const totalTime = 300; // 10 minutes in seconds
        let remainingTime = parseInt(localStorage.getItem('remainingTime')) || totalTime;

        function showQuestion(index) {
            const questionData = questionBank[index];
            const questionContainer = document.querySelector('.question');
            questionContainer.innerHTML = `
                <h5>${index + 1}. ${questionData.question}</h5>
                ${questionData.options.map((option, idx) => `
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="question${index}" value="${option}" id="q${index}${idx}" ${isAnswered(index, option) ? 'checked' : ''}>
                        <label class="form-check-label" for="q${index}${idx}">${option}</label>
                    </div>
                `).join('')}`;

            document.querySelector('.btn-previous').style.display = index === 0 ? 'none' : 'inline-block';
            document.querySelector('.btn-next').style.display = index === totalQuestions - 1 ? 'none' : 'inline-block';
            updatePagination(index);
        }

        function isAnswered(index, option) {
            const savedAnswers = JSON.parse(localStorage.getItem('answers')) || {};
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
            if (currentQuestionIndex < totalQuestions - 1) {
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
            document.querySelectorAll('.pagination-button').forEach((button, index) => {
                button.classList.toggle('active', index === currentIndex);
                button.classList.toggle('answered', answeredQuestions.has(index));
            });
        }

        document.addEventListener('change', function (event) {
            if (event.target.matches('.form-check-input')) {
                answeredQuestions.add(currentQuestionIndex);
                updatePagination(currentQuestionIndex);

                // Save the user's answer
                const answers = JSON.parse(localStorage.getItem('answers')) || {};
                answers[currentQuestionIndex] = event.target.value;
                localStorage.setItem('answers', JSON.stringify(answers));
                localStorage.setItem('answeredQuestions', JSON.stringify(Array.from(answeredQuestions)));
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            showQuestion(currentQuestionIndex);
            const paginationContainer = document.querySelector('.pagination ul');
            for (let i = 0; i < totalQuestions; i++) {
                const li = document.createElement('li');
                li.classList.add('page-item');
                li.innerHTML =
                    `<button class="page-link pagination-button" onclick="goToQuestion(${i})">${i + 1}</button>`;
                paginationContainer.appendChild(li);
            }


            // Timer functionality
            const timerElement = document.getElementById('timer');
            const timerInterval = setInterval(() => {
                if (remainingTime <= 0) {
                    clearInterval(timerInterval);
                    submitQuiz();
                } else {
                    remainingTime--;
                    localStorage.setItem('remainingTime', remainingTime);
                    const minutes = Math.floor(remainingTime / 60);
                    const seconds = remainingTime % 60;
                    timerElement.textContent =
                        `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                }
            }, 1000);
            updatePagination(currentQuestionIndex);
        });

        function saveCurrentQuestionIndex() {
            localStorage.setItem('currentQuestionIndex', currentQuestionIndex);
        }

        function submitQuiz() {
            // Logic to handle quiz submission
            alert('Quiz submitted!');
        }
    </script>
</body>

</html>