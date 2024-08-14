<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Description</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet"> -->
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/assets/css/course.css">
    <style>
        .about-instructor-page {
            max-width: 800px;
        }
    </style>
</head>

<body>
    <?php include(APPPATH . 'Views/include/newNav2.php'); ?>

    <div class="container about-instructor-page mt-4">
        <div class="course-details">
            <h2>Instructor</h2>
            <hr>
            <div class="order-details mt-3">
                <div class="d-flex justify-content-between">
                    <div class="instructor-page-img d-flex">
                        <img src="./assets/img/profile-img.jpg" alt="Instructor Image" />
                        <div class="checkout-course-title mx-2">
                            <h4>Mayomi Odewaye P</h4>
                            <p>Software Engineer/Data Analyst/Project Manager</p>
                            <p>OMPPEAK TECHNOLOGY, Inc.</p>
                            <p>35 Courses</p>
                            <p>89 Students</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="my-4">
                <h2>About Instructor</h2>
                <div id="course-description" class="fade-text">
                    <p>
                        Odewaye Mayomi is a dynamic and accomplished Software Developer who has made significant
                        contributions to the fields of Python programming, Machine Learning, Web Development, and
                        PHP.
                        Currently pursuing a degree in Computer Engineering at Federal Polytechnics Ilaro, Mayomi's
                        academic background and practical experience synergize to create a valuable skill set that
                        he
                        shares with the world.
                    </p>
                    <p>
                        With a strong passion for teaching, Mayomi has taken to the online realm to provide
                        tutorials
                        that help individuals navigate the complexities of Python programming and its applications
                        in
                        both Machine Learning and Web Development. His tutorials cater to a diverse audience, making
                        these technical subjects more accessible and understandable to newcomers and seasoned
                        developers
                        alike.
                    </p>
                    <p>
                        But Mayomi's impact goes beyond his tutorials. His commitment to mentorship has led him to
                        become a guiding light for numerous students seeking to establish themselves in the realm of
                        software development. Through patient guidance and insightful advice, he empowers aspiring
                        developers to unlock their potential and excel in their chosen paths.
                    </p>
                    <p>
                        Mayomi's expertise isn't confined to a single programming language or domain. His
                        proficiency in
                        PHP, coupled with his comprehensive grasp of software development principles, equips him to
                        tackle a wide range of projects and challenges. His holistic approach to programming
                        reflects
                        his dedication to continuous learning and adaptability in an ever-evolving field.

                    </p>
                    <p>
                        In the midst of his educational pursuits as an undergraduate at Federal Polytechnics Ilaro,
                        Mayomi maintains a steadfast commitment to sharing his knowledge and experience with the
                        community. His journey as a Computer Engineering student underscores his dedication to both
                        his
                        personal growth and the growth of others.
                    </p>
                    <p>
                        In conclusion, Odewaye Mayomi stands as an exceptional software developer, educator, and
                        mentor.
                        Through his tutorials, mentorship, and ongoing educational journey, he serves as an
                        inspiring
                        figure within the software development landscape, embodying the spirit of continuous
                        learning,
                        collaboration, and empowerment.
                    </p>
                </div>
                <div id="toggle-button" class="show-more-less-btn mt-3">Show More <i class="fas fa-caret-down"></i>
                </div>
            </div>

            <hr>
            <div class="instructor-courses">
                <h2>Instructor courses</h2>
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="course-card">
                            <img src="./assets/img/web_dev.jpeg" alt="Course Image" />
                            <div class="card-body">
                                <h4 class="card-title">React - The Complete Guide 2024 (incl. Next.js, Redux)</h4>

                                <div class="course-rating">
                                    <span class="rating">4.5</span>
                                    <span class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-alt"></i>
                                    </span>
                                    <span class="rating-count">(1,234)</span>
                                </div>
                                <div class="course-instructor">Mayomi Peter</div>
                                <div class="course-price">₦41,900</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="course-card">
                            <img src="./assets/img/py4web.jpg" alt="Course Image" />
                            <div class="card-body">
                                <h4 class="card-title">Learn Python Programming for Web Development (In Ten Easy
                                    Steps)</h4>
                                <div class="course-rating">
                                    <span class="rating">4.5</span>
                                    <span class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-alt"></i>
                                    </span>
                                    <span class="rating-count">(1,234)</span>
                                </div>
                                <div class="course-instructor">Instructor Name</div>
                                <div class="course-price">$19.99</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="course-card">
                            <img src="./assets/img/math.jpg" alt="Course Image" />
                            <div class="card-body">
                                <h4 class="card-title">Mathematics - Numerical Analysis</h4>
                                <div class="course-rating">
                                    <span class="rating">4.5</span>
                                    <span class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-alt"></i>
                                    </span>
                                    <span class="rating-count">(1,234)</span>
                                </div>
                                <div class="course-instructor">Instructor Name</div>
                                <div class="course-price">$19.99</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="course-card">
                            <img src="./assets/img/c++.jpg" alt="Course Image" />
                            <div class="card-body">
                                <h4 class="card-title">Introduction to Object Oriented Programming with C++</h4>
                                <div class="course-rating">
                                    <span class="rating">4.5</span>
                                    <span class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-alt"></i>
                                    </span>
                                    <span class="rating-count">(1,234)</span>
                                </div>
                                <div class="course-instructor">Instructor Name</div>
                                <div class="course-price">$19.99</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include(APPPATH . 'Views/include/footer1.php'); ?>



    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            var prevScrollpos = window.pageYOffset;
            var navbar = document.querySelector('.navbar');
            var heading = document.querySelector('.course-heading');

            function handleScroll() {
                var currentScrollPos = window.pageYOffset;

                if (prevScrollpos > currentScrollPos) {
                    navbar.style.top = "0";
                } else {
                    navbar.style.top = "-80px";
                }

                if (currentScrollPos > 0) {
                    heading.style.display = "block";
                } else {
                    heading.style.display = "none";
                }

                prevScrollpos = currentScrollPos;
            }

            window.addEventListener('scroll', handleScroll);

            heading.style.display = "none"; // Ensure it's hidden initially
        });


        // script.js
        document.addEventListener('DOMContentLoaded', function () {
            const toggleButton = document.getElementById('toggle-button');
            const courseDescription = document.getElementById('course-description');

            toggleButton.addEventListener('click', function () {
                if (courseDescription.classList.contains('expanded')) {
                    courseDescription.classList.remove('expanded');
                    toggleButton.innerHTML = 'Show More <i class="fas fa-caret-down"></i>';
                } else {
                    courseDescription.classList.add('expanded');
                    toggleButton.innerHTML = 'Show Less <i class="fas fa-caret-up"></i>';
                }
            });
        });
    </script>
</body>

</html>