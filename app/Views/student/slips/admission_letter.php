<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admission Letter - LearnXa</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { text-align: center; margin: 20px; }
        h2 { color: #2c3e50; }
        p { font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>LearnXa Admission Letter</h2>
        <p><strong>Full Name:</strong> <?= $first_name ?> <?= $last_name ?></p>
        <p><strong>Course:</strong> <?= $course_name ?></p>
        <p><strong>Department:</strong> <?= $department ?></p>
        <p>Congratulations! You have been admitted to LearnXa.</p>
        <p>Please complete your registration by following the instructions provided.</p>
        <p>Best regards,<br>LearnXa Admissions Office</p>
    </div>
</body>
</html>
