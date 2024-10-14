<!DOCTYPE html>
<html lang="en">

<head>
<?php include(APPPATH . 'Views/include/head.php'); ?>

    <title>Virtual Classes | LearnXa</title>
</head>

<body>
    <?php include(APPPATH . 'Views/include/newNav2.php'); ?>

    <section id="updates" class="py-5 bg-light">
        <div class=" container d-flex justify-content-between heading bg-light">
            <a class="navbar-brand nav-logo" href="#">Learn<span style="color: #007bff;">X</span>a</a>
            <h2 class="course-category">Virtual Class<i class="fas fa-chalkboard-teacher"></i></h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 update-content">
                    <h1>Experience Learning Like Never Before</h1>
                    <p>Join our virtual classes and get access to top-notch education from the comfort of your home.
                        Engage with expert instructors and collaborate with peers in real-time.</p>
                    <a href="#" class="btn btn-success">Join a Live Class</a>
                </div>
                <div class="col-lg-6 col-md-6 update-image">
                    <img src="./assets/img/liveclass.jpg" alt="Live Class Image">
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid mt-4">
        <h2 class="course-category">VIRTUAL CLASSES</h2>
        <div class="row">
            <?php foreach ($virtualClasses as $virtualClass): ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="course-card">
                    <img src="./assets/img/prog-lang-topic-img.jpg" alt="Course Image" />
                    <div class="card-body">
                        <h4 class="card-title"><?= esc($virtualClass['virtualclass_name']) ?></h4>

                        <?php
                                // Convert start and end dates to DateTime objects
                                $startDate = new DateTime($virtualClass['virtualclass_start_date']);
                                $endDate = new DateTime($virtualClass['virtualclass_end_date']);
                                $currentDate = new DateTime(); // Current date

                                // Format the start and end dates
                                $formattedStartDate = $startDate->format('F j, Y'); // October 11, 2024
                                $formattedEndDate = $endDate->format('F j, Y');

                                // Calculate the duration in days
                                $duration = $startDate->diff($endDate)->days;

                                // Determine status
                                if ($currentDate < $startDate) {
                                    $status = '<span style="color:orange;">Upcoming!</span>';
                                } elseif ($currentDate >= $startDate && $currentDate <= $endDate) {
                                    $status = '<span style="color:green;">Ongoing!</span>';
                                } else {
                                    $status = '<span style="color:red;">Ended</span>';
                                }
                            ?>
                        <div class="course-rating">
                            <span class="rating">4.5</span>
                            <span class="rating-stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-alt"></i>
                            </span>
                            <span class="rating-count">(34 Students Enrolled)</span>
                        </div>
                        <div class="rating-count"><strong>Start Date:</strong> <?= esc($formattedStartDate) ?></div>
                        <div class="rating-count"><strong>End Date:</strong> <?= esc($formattedEndDate) ?></div>
                        <div class="d-flex justify-content-between">
                            <span class="rating-count"><strong>Duration:</strong> <?= $duration ?> days</span>
                            <span class="rating-count"><strong>Status:</strong> <?= $status ?></span>
                        </div>
                        <div class="course-instructor">Instructors: OMPPEAK TECHNOLOGY</div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="course-price">₦50,000</div>
                            <button class="btn btn-primary">Enroll Now!</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <!-- <div class="col-lg-3 col-md-6 mb-4">
                <div class="course-card">
                    <img src="./assets/img/mobile-app-topic-img.webp" alt="Course Image" />
                    <div class="card-body">
                        <h4 class="card-title">Mobile App Development using Flutter (Complete Course)</h4>
                        
                        <div class="course-rating">
                            <span class="rating">4.5</span>
                            <span class="rating-stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-alt"></i>
                            </span>
                            <span class="rating-count">(34 Students Enrolled)</span>
                        </div>
                        <div class="rating-count">Start Date: Jan 11, 2024.</div>
                        <div class="rating-count">End Date: Feb 12, 2024.</div>
                        <div class="d-flex justify-content-between">
                            <span class="rating-count">Duration: 1 Month</span>
                            <span class="rating-count">Status: <span style="color:green;">Ongoing!</span></span>
                        </div>
                        <div class="course-instructor">James Degbaun</div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="course-price">₦5,900</div>
                            <button class="btn btn-primary">Enroll Now!</button>
                        </div>
                    </div>
                </div>
            </div> -->

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