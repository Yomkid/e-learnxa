<!DOCTYPE html>
<html lang="en">

<head>
    <title>Assignments | LearnXa</title>
    <?php include(APPPATH . 'Views/student/include/student-head.php'); ?>
    <style>
        .assignment-card {
            border: 1px solid #e0e0e0;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            background-color: #fff;
            margin: 0.5rem 0;
        }

        /* .assignment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            color: #00c3ff;
        } */

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

        .grade-label {
            text-align: center;
            font-size: 1em;
            font-weight: bold;
            margin-top: 8px;
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
                            Assignments
                        </div>
                        <p>Below are your assignments.</p>
                    </div>
                    <hr class="my-1">
                    <div class="row">
                        <?php if (!empty($assignments)) : ?>
                            <?php foreach ($assignments as $assignment) : ?>
                                <div class="col-lg-4 col-md-6 mb-1 shadow-sm">
                                    <div class="assignment-card">
                                        <div class="p-2k">
                                            <div class="category-header">
                                                <?= esc($assignment['assignment_name']) ?>
                                            </div>
                                            <hr>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <div><strong>Given Date:</strong> <?= date('jS F Y', strtotime($assignment['created_at'])) ?></div>
                                                    <div><strong class="text-danger">Due Date:</strong> <?= date('jS F Y', strtotime($assignment['due_date'])) ?></div>
                                                </div>
                                            </div>
                                            <a href="/student/assignments/<?= esc($assignment['assignment_id']) ?>" class="btn btn-primary w-100">View Assignment</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="col-12">
                                <p>No assignments available.</p>
                            </div>
                        <?php endif; ?>
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
         // Function to update the grade circle and label dynamically
         function updateGradeCircle(grade) {
            const gradeCircle = document.getElementById('gradeCircle');
            const gradeText = document.getElementById('gradeText');
            const gradeLabel = document.getElementById('gradeLabel'); // Label for performance level

            // Update the text inside the circle
            gradeText.textContent = `${grade}%`;

            // Determine the color and performance label based on the grade
            let color, label;
            if (grade >= 90) {
                color = '#006400'; // Dark Green for Excellent
                label = 'Excellent';
            } else if (grade >= 75) {
                color = 'green'; // Green for Good
                label = 'Good';
            } else if (grade >= 50) {
                color = 'yellow'; // Yellow for Average
                label = 'Average';
            } else if (grade >= 25) {
                color = 'orange'; // Orange for Below Average
                label = 'Below Average';
            } else {
                color = 'red'; // Red for Poor
                label = 'Poor';
            }

            // Set the background to represent the percentage with the selected color
            gradeCircle.style.background = `conic-gradient(${color} ${grade}%, #d3d3d3 ${grade}%)`;

            // Update the performance level text
            gradeLabel.textContent = label;
        }

        // Example usage: Update the grade circle with the actual grade from the data attribute
        const grade = parseInt(document.getElementById('gradeCircle').getAttribute('data-grade'), 10);
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
    <!-- Custom JS -->
    <script src="scripts.js"></script>
</body>

</html>
