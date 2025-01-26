<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Result Review - LearnXa</title>
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
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-90XYHBSS6Z"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-90XYHBSS6Z');
</script>
<body>
    <?php include(APPPATH . 'Views/student/include/quizNavbar.php'); ?>
    <div class="container-fluid mt-1">
        <div class="row">
   
            <div  class="col-lg-3">
                <div id="quizSidebar" class="quiz-sidebar  bg-light">
                    <div class="text-center mt-2">
                        <h5>RESULT REVIEW</h5>
                    </div>
                    <hr>
                    <div>
                        <div class="student-img-lg d-flex text-center align-items-center justify-content-center mb-4">
                            <img src="<?= base_url('../assets/img/profile-img.jpg'); ?>" alt="Instructor Image">
                        </div>

                        <div class="student-name-container w-10o0">JOHNSON <?= strtoupper(session('first_name'))?>
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

                        <div id="review-section">
                            <?php foreach ($questions as $index => $question): ?>
                                <div class="question">
                                    <h4><?= esc($question['question_text']) ?></h4> <!-- Adjust based on how your question text is stored -->

                                    <!-- User's Answer -->
                                    <div class="user-answer">
                                        <strong>Your Answer:</strong>
                                        <span><?= isset($userAnswers[$index]) ? esc($userAnswers[$index]) : 'N/A' ?></span> <!-- User's answer based on index -->
                                    </div>

                                    <!-- Correct Answer -->
                                    <?php if (isset($question['correct_option'])): ?>
                                        <div class="correct-answer <?= isset($userAnswers[$index]) && $userAnswers[$index] == $question['correct_option'] ? 'text-success' : 'text-danger' ?>">
                                            <strong>Correct Answer:</strong>
                                            <span><?= esc($question['correct_option']) ?></span>
                                        </div>
                                    <?php else: ?>
                                        <div class="correct-answer text-warning">
                                            <strong>Correct Answer:</strong>
                                            <span>N/A</span>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Explanation -->
                                    <?php if (!empty($question['explanation'])): ?>
                                        <div class="explanation mt-2">
                                            <strong>Explanation:</strong>
                                            <p><?= esc($question['explanation']) ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>

                        </div>

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

                            <div>
                            <h3 class="text-center mt-2">Quiz Review</h3>
                        <p class="text-center text-muted">Your selected answers, correct answers, and explanations</p>

                        <h5>Score: <?= esc($score) ?> / <?= esc($totalMarks) ?></h5>
                        <p>Time Taken: <?= esc($timeTaken) ?> minutes</p>
                        <p>Status: <?= $isPassed ? 'Passed' : 'Failed' ?></p>
                      


                        

                        <div class="text-center mt-4">
                            <button id="download-button" class="btn btn-primary" onclick="downloadResults()">Download Review</button>
                        </div>
                            </div>
                        </div>

                        <!-- Floating Button -->
                        <button id="calculator-toggle" class="floating-button btn btn-primary">
                                Download Result <i class="fas fa-download"></i>
                            </button>

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
            
    // Initialize questions data
    const questions = <?= json_encode($questions) ?>;
    let currentQuestionIndex = 0;
    const userAnswers = new Array(questions.length).fill(null); // Store user answers

    // Function to render the current question
    function renderQuestion() {
        const questionContainer = document.querySelector('.quiz-container .question');
        const question = questions[currentQuestionIndex];
        questionContainer.innerHTML = `
            <h4>${question.question_text}</h4>
            <div class="user-answer">
                <strong>Your Answer:</strong>
                <span>${userAnswers[currentQuestionIndex] || 'N/A'}</span>
            </div>
            ${question.correct_option ? `
            <div class="correct-answer ${userAnswers[currentQuestionIndex] == question.correct_option ? 'text-success' : 'text-danger'}">
                <strong>Correct Answer:</strong> ${question.correct_option}
            </div>
            ` : ''}
            ${question.explanation ? `<div class="explanation mt-2"><strong>Explanation:</strong> ${question.explanation}</div>` : ''}
        `;
        updateNavigationButtons();
    }

    // Function for the Next button
    function nextQuestion() {
        if (currentQuestionIndex < questions.length - 1) {
            currentQuestionIndex++;
            renderQuestion();
        }
    }

    // Function for the Previous button
    function previousQuestion() {
        if (currentQuestionIndex > 0) {
            currentQuestionIndex--;
            renderQuestion();
        }
    }

    // Update button states based on question index
    function updateNavigationButtons() {
        document.querySelector('.btn-previous').disabled = (currentQuestionIndex === 0);
        document.querySelector('.btn-next').disabled = (currentQuestionIndex === questions.length - 1);
    }

    // Initialize the quiz display
    document.addEventListener('DOMContentLoaded', () => {
        renderQuestion();
        updateNavigationButtons();
    });
</script>

      






  



</body>

</html>