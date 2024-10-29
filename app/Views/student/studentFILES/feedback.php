<!DOCTYPE html>
<html lang="en">
<head>
    <title>Feedback | LearnXa</title>
    <?php include(APPPATH . 'Views/student/include/student-head.php'); ?>
    <!-- Custom CSS -->
    <style>
        .feedback-container {
            padding: 2rem;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .feedback-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .feedback-form .form-group {
            margin-bottom: 1rem;
        }
        .feedback-form .form-control {
            border-radius: 4px;
        }
        .feedback-form .btn-submit {
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            padding: 0.5rem 1.5rem;
            border: none;
        }
        .feedback-form .btn-submit:hover {
            background-color: #0056b3;
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
                <div class="feedback-container">
                    <div class="feedback-header">
                        Feedback
                    </div>
                    <p>We value your feedback! Please fill out the form below to help us improve our platform.</p>
                    <form class="feedback-form" method="POST" action="submit_feedback.php">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="feedback">Feedback</label>
                            <textarea class="form-control" id="feedback" name="feedback" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-submit">Submit Feedback</button>
                    </form>
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
