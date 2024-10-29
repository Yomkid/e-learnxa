<!DOCTYPE html>
<html lang="en">

<head>
    <title>Learning Page - eLearning Platform</title>
    <?php include(APPPATH . 'Views/student/include/student-head.php'); ?>
    <meta name="csrf-token" content="<?= csrf_hash() ?>">

    <style>
        .sidebar-sticky {
            position: fixed;
            top: 80px;
            z-index: 1000;
            height: 100%;
            width: 320px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #007bff transparent;
            scroll-behavior: smooth;
            transition: transform 0.3s ease;
            transform: translateX(-100%);
        }

        .sidebar-sticky.open {
            transform: translateX(0);
            /* Slide sidebar in */
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

        .module-button {
            padding: 10px;
            cursor: pointer;
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


        .responsive-iframe {
            width: 100%;
            /* Make the container fill the width of its parent */
            position: relative;
            /* Set the position to relative for absolute positioning of the iframe */
            padding-bottom: 56.25%;
            /* 16:9 aspect ratio */
            background: #000;
            /* Optional background color */
            overflow: hidden;
            /* Ensures the iframe stays within the boundaries */
        }


        .responsive-iframe iframe,
        .responsive-iframe embed,
        .responsive-iframe object {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }


        .lesson-title {
            background-color: #ffa938;
            font-size: 20px;
            padding: 10px;
        }

        #lesson-content h1 {
            font-size: 20px;
        }

        #lesson-content h2 {
            font-size: 20px;
        }

        #lesson-content h3 {
            font-size: 18px;
        }

        #lesson-content h4 {
            font-size: 14px;
        }


        .sidebar-slide {
            transition: transform 0.3s ease;
            transform: translateX(-320px);
            /* Initially hide sidebar */
        }

        .sidebar-open {
            transform: translateX(0);
            /* Show sidebar */
        }

        .toggle-icon {
            cursor: pointer;
            font-size: 24px;
        }

        .module.completed {
        background-color: #e0ffe0; /* Light green background for completed modules */
        border-left: 5px solid #28a745; /* Green border */
        }

    </style>
</head>

<body>
    <?php include(APPPATH . 'Views/student/include/elearningNavbar.php'); ?>
    <div class="container mt-1">
        <div class="row">
            <div class="col-lg-4">
                

                <div class="collapse d-lg-block" id="sidebar">
                    <div class="sidebar-sticky bg-light mb-2">
                        <div class="text-center mt-2">
                            <h5>Course Modules</h5>
                        </div>
                        <hr>
                        <ul class="sidebar-module-list" id="modules">
                            <?php foreach ($modules as $index => $module): ?>
                            <li class="module-button <?= $module['completed'] ? 'completed' : 'uncompleted'; ?> <?= $module['active'] ? 'active' : ''; ?>"
                                data-module-id="<?= $module['module_id']; ?>" data-index="<?= $index; ?>">
                                <i class="fas fa-check-circle"></i><?= $module['module_name']; ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 mt-3">
                <div class="progress-container">
                    <div class="progress-circle" data-percentage="<?= $overallProgress; ?>"
                        style="--percentage: <?= $overallProgress * 3.6; ?>deg;">
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-0">
                    <button type="button" class="btn btn-primary" id="prev-button" style="display: none;">Previous Module</button>
                    <button type="button" class="btn btn-primary" id="next-button" style="display: none;">Next Module</button>
                </div>

                <div class="mt-1">
                    <div id="lesson-content" class="mt-1"></div>

                    <div class="mt-4">
                        <h5>Progress</h5>
                        <div class="progress mb-4">
                            
                            <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                role="progressbar" style="width: <?= $overallProgress; ?>%;"
                                aria-valuenow="<?= $overallProgress; ?>" aria-valuemin="0" aria-valuemax="100">
                                <?= $overallProgress; ?>%
                            </div>

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    let modules = $('.module-button');
    let currentModuleIndex = 0;
    let lessons = [];

    function loadModule(index) {
        if (modules.length > 0) {
            const module = $(modules[index]);
            const moduleId = module.data('module-id');

            $('.module-button').removeClass('active');
            module.addClass('active');

            $.ajax({
                url: '<?= base_url('student/e-learning/' . $courseId . '/') ?>' + moduleId,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success' && response.data.length > 0) {
                        lessons = response.data;
                        loadLesson(0);
                    } else {
                        $('#lesson-content').html('<p>No lessons available for this module.</p>');
                        $('#prev-button').hide();
                        $('#next-button').hide();
                    }
                },
                error: function () {
                    $('#lesson-content').html('<p>An error occurred while fetching lesson data.</p>');
                    $('#prev-button').hide();
                    $('#next-button').hide();
                }
            });

            // Update button visibility
            updateButtonVisibility(index);
        }
    }

    function loadLesson(index) {
        if (lessons.length > 0) {
            const lesson = lessons[index];
            const contentWithMedia = processOembed(lesson.lesson_content);
            $('#lesson-content').html(`
                <div class="lesson-title mb-1"><h2>${lesson.lesson_title}</h2></div>
                <div class="lesson-content">${contentWithMedia}</div>
            `);
        } else {
            $('#lesson-content').html('<p>No lessons available for this module.</p>');
        }
    }

    function updateButtonVisibility(index) {
        $('#prev-button').toggle(index > 0); // Show "Previous" if not on the first module
        $('#next-button').toggle(index < modules.length - 1); // Show "Next" if not on the last module
    }

    function markModuleAsCompleted(moduleId, courseId) {
        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        if (!csrfTokenMeta) {
            console.error('CSRF token meta tag is missing.');
            return;
        }

        const csrfToken = csrfTokenMeta.getAttribute('content');

        fetch('<?= base_url('student/mark-module-completed') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ module_id: moduleId, course_id: courseId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Module marked as completed.');
            } else {
                alert('Failed to mark module as completed: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    $(document).ready(function () {
        loadModule(currentModuleIndex); // Load the first module on page load

        $('#next-button').click(function () {
            if (currentModuleIndex < modules.length - 1) {
                const currentModuleId = $(modules[currentModuleIndex]).data('module-id');
                markModuleAsCompleted(currentModuleId, <?= $courseId ?>); // Pass courseId here

                $(this).prop('disabled', true);
                $('#prev-button').prop('disabled', true);

                currentModuleIndex++;
                loadModule(currentModuleIndex);

                setTimeout(() => {
                    $(this).prop('disabled', false);
                    $('#prev-button').prop('disabled', false);
                }, 500);
            }
        });

        $('#prev-button').click(function () {
            if (currentModuleIndex > 0) {
                const currentModuleId = $(modules[currentModuleIndex]).data('module-id');
                markModuleAsCompleted(currentModuleId, <?= $courseId ?>);

                $(this).prop('disabled', true);
                $('#next-button').prop('disabled', true);

                currentModuleIndex--;
                loadModule(currentModuleIndex);

                setTimeout(() => {
                    $(this).prop('disabled', false);
                    $('#next-button').prop('disabled', false);
                }, 500);
            }
        });

        $('.module-button').click(function () {
            const previousModuleId = $(modules[currentModuleIndex]).data('module-id');
            markModuleAsCompleted(previousModuleId, <?= $courseId ?>);

            currentModuleIndex = $(this).data('index');
            loadModule(currentModuleIndex);
        });

        

        // Progress Circle Styling
        document.querySelectorAll('.progress-circle').forEach(function (circle) {
            var percentage = circle.getAttribute('data-percentage');
            var degrees = (percentage / 100) * 360;
            circle.style.setProperty('--percentage', degrees + 'deg');
            circle.style.setProperty('--color1', percentage >= 25 ? '#f44336' : '#e0e0e0');
            circle.style.setProperty('--color2', percentage >= 50 ? '#ff9800' : '#e0e0e0');
            circle.style.setProperty('--color3', percentage >= 75 ? '#ffeb3b' : '#e0e0e0');
            circle.style.setProperty('--color4', percentage === 100 ? '#4caf50' : '#e0e0e0');
        });
    });

    function processOembed(html) {
        return html.replace(/<oembed url="([^"]+)"><\/oembed>/g, function (match, url) {
            if (url.includes('vimeo.com')) {
                const videoId = url.split('/').pop().split('?')[0];
                return `<div class="responsive-iframe"><iframe src="https://player.vimeo.com/video/${videoId}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></div>`;
            } else if (url.includes('youtube.com') || url.includes('youtu.be')) {
                const videoId = new URL(url).searchParams.get('v') || url.split('/').pop().split('?')[0];
                return `<div class="responsive-iframe"><iframe src="https://www.youtube.com/embed/${videoId}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>`;
            } else {
                return `<p>Unsupported media type or URL: ${url}</p>`;
            }
        });
    }

    // Sidebar toggling
    $('#toggle-sidebar').click(function () {
            const sidebar = $('#sidebar .sidebar-sticky');
            sidebar.toggleClass('open');
            $(this).find('i').toggleClass('fa-bars fa-times');
        });

        $(window).resize(function () {
            const windowWidth = $(window).width();
            const sidebar = $('#sidebar .sidebar-sticky');
            if (windowWidth >= 992) sidebar.addClass('open');
            else sidebar.removeClass('open').find('#toggle-sidebar i').removeClass('fa-times').addClass('fa-bars');
        }).trigger('resize');
</script>



</body>

</html>
