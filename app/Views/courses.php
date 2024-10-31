<!DOCTYPE html>
<html lang="en">
<head>
    <title>Courses | LearnXa</title>
    <?php include(APPPATH . 'Views/include/head.php'); ?>
</head>
<body>
    <?php include(APPPATH . 'Views/include/navbar.php'); ?>
    <div class="container-fluid mt-0">
        <div class="d-flex justify-content-between heading mt-4">
            <a class="navbar-brand nav-logo" href="#">Learn<span style="color: #007bff;">X</span>a</a>
            <h2 class="course-category">Available Courses</h2>
        </div>
        <div class="row">
            <?php if (!empty($courses)) : ?>
                <?php foreach ($courses as $course) : ?>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <a href="<?= site_url('course/' . esc($course['slug'])) ?>">
                            <div class="course-card">
                                <img src="/uploads/<?= esc($course['course_image']) ?>" alt="<?= esc($course['course_title']) ?>" class="card-img-top">
                                <div class="card-body">
                                    <h4 class="card-title"><?= esc($course['course_title']) ?></h4>
                                    <!-- <div class="course-tagline"><esc($course['course_tagline']) ?></div> -->
                                    <div class="course-rating">
                                        <span class="rating"><?= esc(number_format($course['rating'], 1)) ?></span>
                                        <span class="rating-stars">
                                            <?php for ($i = 0; $i < floor($course['rating']); $i++) : ?>
                                                <i class="fa fa-star"></i>
                                            <?php endfor; ?>
                                            <?php if ($course['rating'] - floor($course['rating']) > 0) : ?>
                                                <i class="fa fa-star-half-alt"></i>
                                            <?php endif; ?>
                                        </span>
                                        <span class="rating-count">(<?= esc($course['rating_count']) ?>)</span>
                                    </div>
                                    <div class="course-instructor">
                                        <?php
                                        // Assuming you fetch instructor details separately, replace this with the actual instructor name
                                        // $instructor = getInstructorNameById($course['instructor_id']);
                                        // echo esc($instructor);
                                        ?>
                                    </div>
                                    <div class="course-price">₦<?= esc(number_format($course['price'])) ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No courses available.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php include(APPPATH . 'Views/include/footer1.php'); ?>
    <?php include(APPPATH . 'Views/include/js.php'); ?>

    <script>
        $(document).ready(function () {
            var prevScrollpos = window.pageYOffset;
            var navbar = document.querySelector('.navbar');
            var heading = document.querySelector('.heading');
            var logo = document.querySelector('.heading .nav-logo');

            // Function to handle the scroll event
            function handleScroll() {
                var currentScrollPos = window.pageYOffset;

                // Show or hide the logo based on the scroll position
                if (prevScrollpos > currentScrollPos) {
                    navbar.style.top = "0";
                    heading.style.left = "0";
                } else {
                    navbar.style.top = "-80px";
                }

                if (currentScrollPos > 0) {
                    logo.style.display = "inline-block";
                } else {
                    logo.style.display = "none";
                    navbar.style.top = "0";
                }

                prevScrollpos = currentScrollPos;
            }

            // Attach the scroll event listener
            window.addEventListener('scroll', handleScroll);

            // Initial state
            logo.style.display = "none";
        });
    </script>
</body>
</html>
