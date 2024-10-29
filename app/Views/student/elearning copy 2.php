<!DOCTYPE html>
<html lang="en">

<head>
    <title>Learning Page - eLearning Platform</title>
    <?php include(APPPATH . 'Views/student/include/student-head.php'); ?>
    <style>
        .sidebar-sticky {
            /* position: -webkit-sticky;
            position: sticky; */
            position: fixed;
            top: 80px;
            /* padding: 20px; */
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            height: 100%;
            width: 320px;
            /* overflow: auto; */
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #007bff transparent;
            scroll-behavior: smooth;
        }

        .progress {
            height: 20px;
        }

        .progress-bar {
            line-height: 20px;
        }

        .card-custom {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .course-video {
            width: 100%;
            height: 400px;
            background-color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 24px;
        }

        .course-materials ul {
            list-style: none;
            padding-left: 0;
        }

        .course-materials ul li {
            padding: 10px 0;
            display: flex;
            align-items: center;
        }

        .course-materials ul li i {
            margin-right: 10px;
            color: #007bff;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            color: white;
        }

        .course-info p {
            margin-bottom: 5px;
        }


        .sidebar-module-list {
            list-style-type: none;
            padding-left: 0;
            position: relative;
        }

        .sidebar-module-list li {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            transition: background-color 0.3s;
            padding: 10px;
            border-radius: 5px;
            font-size: 15px;
            color: #000;
            /* Default color */
            position: relative;
        }

        .sidebar-module-list i {
            background-color: #f8f9fa;
            border-radius: 100%;
            color: #007bff;
        }

        .sidebar-module-list li::before {
            content: "";
            position: absolute;
            left: 15px;
            /* Adjust as per icon's margin */
            top: 0;
            bottom: -20px;
            /* Extend the line below the icon */
            width: 2px;
            z-index: -1;
        }

        .sidebar-module-list li.completed::before {
            background-color: #007bff;
            /* blue color for completed line */
        }

        .sidebar-module-list li.uncompleted::before {
            background-color: rgba(139, 142, 144, 0.205);
        }

        .sidebar-module-list li:first-child::before {
            top: 50%;
        }

        .sidebar-module-list li:last-child::before {
            display: none;
        }

        .sidebar-module-list li:hover {
            background-color: #007bff;
            color: white !important;
        }

        .sidebar-module-list .active {
            background-color: #007bff;
            color: white !important;
        }

        .sidebar-module-list .active i {
            color: white !important;
            /* Change icon color on hover */
            background-color: #007bff !important;
        }

        .sidebar-module-list li a {
            color: inherit;
            text-decoration: none;
            margin-left: 10px;
            flex-grow: 1;
            transition: color 0.3s;
        }

        .sidebar-module-list li a:hover {
            text-decoration: none;
        }

        .sidebar-module-list li i {
            margin-right: 10px;
            transition: color 0.3s;
        }

        .sidebar-module-list li.completed i {
            color: #007bff;
            /* Green color for completed icon */
        }

        .sidebar-module-list li.uncompleted i {
            color: rgba(139, 142, 144, 0.205);
            /* Faded green color for uncompleted icon */
        }

        .sidebar-module-list li:hover i {
            color: white !important;
            /* Change icon color on hover */
            background-color: #007bff !important;
        }

        .progress-container {
            position: fixed;
            top: 75px;
            right: 4px;
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 1030;
            /* Ensure it's on top of other elements */
        }


        .progress-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            /* background: conic-gradient(#4caf50 var(--percentage), #e0e0e0 0); */
            /* background-color: #007bff; */
            background: conic-gradient(var(--color1) 0% 25%,
                    var(--color2) 25% 50%,
                    var(--color3) 50% 75%,
                    var(--color4) 75% 100%);
            clip-path: circle(50%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin: 0 auto;
            transition: background 0.3s;
        }

        .progress-circle::before {
            content: attr(data-percentage) '%';
            width: 45px;
            height: 45px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            font-weight: bold;
            color: #333;
            position: absolute;
        }

        .progress-text {
            font-size: 1rem;
            text-align: center;
            margin-top: 10px;
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            max-width: 100%;
            background: #000;
        }

        .video-container iframe,
        .video-container object,
        .video-container embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <?php include(APPPATH . 'Views/student/include/elearningNavbar.php'); ?>
    <div class="container mt-1">
        <div class="row">
            <div class="col-lg-4">
                <div class="sidebar-sticky bg-light">
                    <div class="text-center mt-2">
                        <h5>Course Modules</h5>
                    </div>
                    <hr>
                    <ul class="sidebar-module-list">
                        <!-- PHP Loop to dynamically generate modules -->
                        <?php foreach ($modules as $module): ?>
                        <li
                            class="<?= $module['completed'] ? 'completed' : 'uncompleted'; ?> <?= $module['active'] ? 'active' : ''; ?>">
                            <i class="fas fa-check-circle"></i>
                            <a href="<?= base_url('student/module/' . $module['module_id']); ?>">
                                <?= $module['module_name']; ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 mt-3">
                <div class="progress-container">
                    <div class="progress-circle" data-percentage="<?= $overallProgress; ?>"
                        style="--percentage: <?= $overallProgress * 3.6; ?>deg;">
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary">Previous</button>
                    <button type="button" class="btn btn-primary">Next Module</button>
                </div>

                <div class="video-container mt-3">
                    <iframe src="" frameborder="0" allow="autoplay; fullscreen; picture-in-picture"
                        allowfullscreen></iframe>
                    <script src="https://player.vimeo.com/api/player.js"></script>
                </div>

                <div class="mt-1">
                    <h6><?= $currentModule['lesson_title']; ?></h6>
                    <p><?= $currentModule['lesson_content']; ?></p>

                    <div class="course-materials">
                        <h4>Course Materials</h4>
                        <ul>
                            <?php foreach ($materials as $material): ?>
                            <li><i class="fas fa-file-alt"></i> <a
                                    href="<?= base_url('uploads/' . $material['file']); ?>"><?= $material['name']; ?></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="mt-4">
                        <h3>Progress</h3>
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" style="width: <?= $progress; ?>%;"
                                aria-valuenow="<?= $progress; ?>" aria-valuemin="0" aria-valuemax="100">
                                <?= $progress; ?>%</div>
                        </div>
                    </div>
                </div>
                <footer class="bg-light py-4 mt-5">
                    <div class="container text-center">
                        <p>&copy; 2024 LearnXa. All rights reserved.</p>
                    </div>
                </footer>
            </div>
        </div>
    </div>

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
    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>