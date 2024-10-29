<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= esc($assignment['assignment_name']) ?> | LearnXa</title>
    <?php include(APPPATH . 'Views/student/include/student-head.php'); ?>
    <style>
        .assignment-details-container {
            display: flex;
            flex-wrap: wrap;
        }

        .assignment-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 15px;
            /* border: 1px solid #e0e0e0; */
            /* border-radius: 10px; */
            margin-bottom: 15px;
        }

        .assignment-info {
            flex: 2;
            padding: 15px;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            margin-right: 15px;
        }

        .assignment-header {
            flex: 1;
        }

        .submission-form {
            flex: 1;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
        }


        .grade-circle {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: conic-gradient(#d3d3d3 0%, #d3d3d3 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5em;
            color: white;
        }

        .grade-circle .grade-text {
            position: absolute;
            font-size: 24px;
            font-weight: bold;
        }

        /* Responsive styling for mobile screens */
        @media (max-width: 768px) {
            .grade-circle {
                width: 60px;
                height: 60px;
                font-size: 1em;
                margin-left: 10px;
            }
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

                    <div class="assignment-details">
                        <div class="assignment-header">
                            <div class="category-header" style="font-size:17px;">
                                <?= esc($assignment['assignment_name']) ?>
                            </div>
                            <p><strong>Course: <span class="text-primary"><?= esc($assignment['course_title']) ?></span></strong></p>
                            <p><strong class="text-danger">Due Date:</strong> <?= date('jS F Y', strtotime($assignment['created_at'])) ?></p>
                        </div>
                        <?php if ($grade !== null): ?>
                        <div class="grade-circle" id="gradeCircle" data-grade="<?= $grade ?>">
                            <div class="grade-text" id="gradeText"><?= $grade ?>%</div>
                        </div>
                        <?php else: ?>
                        <p class="text-danger">No grade available yet.</p>
                        <?php endif; ?>

                        <!-- <div class="grade-circle" id="gradeCircle">
                            <div class="grade-text" id="gradeText">0%</div>
                        </div> -->
                    </div>
                    <hr>

                    <div class="assignment-details-container">
                        <div class="assignment-info">
                            <div class="category-header" style="font-size:17px;">
                                Assignment Details
                            </div>

                            <p><?= ($assignment['assignment_description']) ?></p>
                        </div>

                        <div class="submission-form">
                            <div class="category-header" style="font-size:17px;">
                                Submit Your Work
                            </div>
                            <?php if ($existingSubmission) : ?>
                            <div class="alert alert-success">
                                Your submission has been received! You can edit your submission until the due date.
                            </div>
                            <div class="category-header" style="font-size:17px;">
                                Your Submission
                            </div>
                            <p><strong>File:</strong> <a href="<?= base_url($existingSubmission['file_path']) ?>"
                                    target="_blank"><?= basename($existingSubmission['file_path']) ?></a></p>
                                    <a href="<?= base_url($existingSubmission['file_path']) ?>" 
                                    download="<?= basename($existingSubmission['file_path']) ?>">
                                    Download
                                    </a>

                                    
                            <p><strong>Comments:</strong> <?= esc($existingSubmission['comments']) ?></p>
                            <p><strong>Submitted At:</strong>
                                <?= date('jS F Y', strtotime($existingSubmission['submitted_at'])) ?></p>

                            <div class="category-header" style="font-size:17px;">Edit Submission</div>
                            <form action="/student/submit-assignment/<?= esc($assignment['assignment_id']) ?>"
                                method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="mb-3">
                                    <label for="submissionFile" class="form-label">Upload File</label>
                                    <input type="file" class="form-control" id="submissionFile" name="assignment_file"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="comments" class="form-label">Comments (optional)</label>
                                    <textarea class="form-control" id="comments" name="comments"
                                        rows="3"><?= esc($existingSubmission['comments']) ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Update Submission</button>
                            </form>
                            <?php else : ?>
                            <form action="/student/submit-assignment/<?= esc($assignment['assignment_id']) ?>"
                                method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="mb-3">
                                    <label for="submissionFile" class="form-label">Upload File</label>
                                    <input type="file" class="form-control" id="submissionFile" name="assignment_file"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="comments" class="form-label">Comments (optional)</label>
                                    <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Submit Assignment</button>
                            </form>
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
        // Function to update the grade circle dynamically
        function updateGradeCircle(grade) {
            const gradeCircle = document.getElementById('gradeCircle');
            const gradeText = document.getElementById('gradeText');

            // Update the text inside the circle
            gradeText.textContent = `${grade}%`;

            // Determine the color based on the grade
            let color;
            if (grade >= 75) {
                color = 'green';
            } else if (grade >= 50) {
                color = 'orange';
            } else {
                color = 'red';
            }

            // Set the background to represent the percentage
            gradeCircle.style.background = `conic-gradient(${color} ${grade}%, #d3d3d3 ${grade}%)`;
        }

        // Example usage: Update the grade circle with 80%
        updateGradeCircle(grade);

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
</body>

</html>