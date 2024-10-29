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
