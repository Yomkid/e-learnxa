<!DOCTYPE html>
<html lang="en">

<head>
    <title>Enrolled Courses | LearnXa</title>
    <?php include(APPPATH . 'Views/student/include/student-head.php'); ?>
    <style>
        .course-card {
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            background-color: #fff;
            margin: 0.5rem 0;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            color: #00c3ff;
        }

        .course-card img {
            border: 1px solid #e0e0e0;
            width: 100%;
            height: 150px;
            object-fit: cover;
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

                    <div class="">
                        <div class="category-header" style="font-size:17px;">
                            Enrolled Courses
                        </div>
                        <p>Below are your enrolled courses. Kindly continue where you stopped and finish to earn your certificate.</p>
                    </div>
                    <hr>
                    <!-- <div class="row">
                        <?php if (!empty($enrolledCourses)): ?>
                            <?php foreach ($enrolledCourses as $course): ?>
                                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                    <a href="<?= base_url('student/course-details/' . $course['course_id']); ?>">
                                        <div class="course-card">
                                            <img src="<?= base_url('uploads/' . $course['course_image']); ?>" alt="<?= esc($course['course_title']); ?>" />
                                            <div class="card-body">
                                                <h4 class="card-title"><?= esc($course['course_title']); ?></h4>
                                                <div class="progress mb-4">
                                                    <div class="progress-bar" role="progressbar" style="width: <?= $course['overallProgress']; ?>%;" aria-valuenow="<?= $course['overallProgress']; ?>" aria-valuemin="0" aria-valuemax="100"><?= $course['overallProgress']; ?>%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-danger"><strong>You have not enrolled in any courses yet.</strong></p>
                            <a class="btn btn-primary" href="<?= base_url('/courses'); ?>">Check Courses and Enroll</a>
                        <?php endif; ?>
                    </div> -->
                    <div class="row">               
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success">
                                <strong><?= session()->getFlashdata('success'); ?></strong>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($enrolledCourses)): ?>
                            <?php foreach ($enrolledCourses as $course): ?>
                                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                    <a href="<?= base_url('student/course-details/' . $course['course_id']); ?>">
                                        <div class="course-card">
                                            <img src="<?= base_url('uploads/' . $course['course_image']); ?>" alt="<?= esc($course['course_title']); ?>" />
                                            <div class="card-body">
                                                <h4 class="card-title"><?= esc($course['course_title']); ?></h4>
                                                <div class="progress mb-4">
                                                    <div class="progress-bar" role="progressbar" style="width: <?= $course['overallProgress']; ?>%;" aria-valuenow="<?= $course['overallProgress']; ?>" aria-valuemin="0" aria-valuemax="100"><?= $course['overallProgress']; ?>%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-danger"><strong>You have not enrolled in any courses yet.</strong></p>
                            <a class="btn btn-primary" href="<?= base_url('/courses'); ?>">Check Courses and Enroll</a>
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
        // Sidebar and search functionalities
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('show');
        });

        document.getElementById('mainContent').addEventListener('click', function (e) {
            if (!document.getElementById('sidebar').contains(e.target) && e.target.id !== 'sidebarToggle') {
                document.getElementById('sidebar').classList.remove('show');
            }
        });

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
