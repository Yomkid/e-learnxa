<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Content</title>
    <!-- Prism.js for syntax highlighting -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/themes/prism-okaidia.min.css" rel="stylesheet" />
    <style>
      
    </style>
</head>

<body>
    <div class="content">
        <!-- Content from the database -->
        <h1>Web Development Course</h1>
        <h2>Module 3: JavaScript Basics</h2>
        <p>In this module, you will learn the basics of JavaScript, including variables, functions, and events.</p>
        
        <!-- Example code snippet -->
        <pre class="language-javascript"><code class="language-javascript">
        // quiz.js

function submitQuiz() {
    const form = document.getElementById('quiz-form');
    const resultDiv = document.getElementById('result');
    let score = 0;

    // Answers for the quiz
    const answers = {
        question1: 'a',
        question2: 'c'
    };

    // Check the answers
    for (let [question, answer] of Object.entries(answers)) {
        const selectedOption = form.elements[question].value;
        if (selectedOption === answer) {
            score++;
        }
    }

    // Display the result
    const totalQuestions = Object.keys(answers).length;
    const percentage = (score / totalQuestions) * 100;
    resultDiv.innerHTML = `<h3>You scored ${percentage}%</h3>`;

    // Provide feedback based on the score
    if (percentage === 100) {
        resultDiv.innerHTML += `<p>Excellent! You got all the answers correct.</p>`;
    } else if (percentage >= 50) {
        resultDiv.innerHTML += `<p>Good job! But there's room for improvement.</p>`;
    } else {
        resultDiv.innerHTML += `<p>Keep practicing! You can do better.</p>`;
    }
}

        </code></pre>
    </div>

    <!-- Prism.js for syntax highlighting -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/components/prism-javascript.min.js"></script>
</body>

</html>
