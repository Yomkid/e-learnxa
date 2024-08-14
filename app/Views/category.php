<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category | LearnXa</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="./assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/course.css">
    <link rel="stylesheet" href="/assets/css/home.css">
</head>

<body>
    <?php include(APPPATH . 'Views/include/newNav2.php'); ?>

    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between heading mt-4">
            <a class="navbar-brand nav-logo" href="#">Learn<span style="color: #007bff;">X</span>a</a>
            <h2 class="course-category">IT & Software <i class="fas fa-code"></i></h2>
        </div>
        <p>You will see various subjects and courses under them</p>
        <h2 class="course-category">Web Technology</h2>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="<?= base_url('course-description'); ?>">
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
                                <span class="rating-count">(1,234)</span>
                            </div>
                            <div class="course-instructor">Birshir Adeola Shukro</div>
                            <div class="course-price">₦51,900</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="<?= base_url('course-description'); ?>">
                    <div class="course-card">
                        <img src="./assets/img/datasci-topic-img.jpg" alt="Course Image" />
                        <div class="card-body">
                            <h4 class="card-title">Data Science Roadmap - A Complete Course Using Python and Excel</h4>
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
                            <div class="course-price">₦43,900</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="<?= base_url('course-description'); ?>">
                    <div class="course-card">
                        <img src="./assets/img/webdev-topic-img.jpg" alt="Course Image" />
                        <div class="card-body">
                            <h4 class="card-title">Fullstack Web Development using CodeIgniter (Build 4 Giants Projects)
                            </h4>
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
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="<?= base_url('course-description'); ?>">
                    <div class="course-card">
                        <img src="./assets/img/fund-comp-topic-img.png" alt="Course Image" />
                        <div class="card-body">
                            <h4 class="card-title">Digital Computer Fundamental with full Hands on Projects</h4>
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
                            <div class="course-instructor">Kelvin Prank</div>
                            <div class="course-price">$19.99</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <hr>

        <h2 class="course-category">Digital Electronics Fundamental</h2>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="<?= base_url('course-description'); ?>">
                    <div class="course-card">
                        <img src="./assets/img/dbms-topic-img.png" alt="Course Image" />
                        <div class="card-body">
                            <h4 class="card-title">DataBase Management System using SQL, MS-Access, MongoDB and MySQL
                            </h4>
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
                            <div class="course-instructor">Alex Iwobi</div>
                            <div class="course-price">$19.99</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="<?= base_url('course-description'); ?>">
                    <div class="course-card">
                        <img src="./assets/img/prog-lang-topic-img.jpg" alt="Course Image" />
                        <div class="card-body">
                            <h4 class="card-title">2024 Complete Introduction to Programming Language</h4>
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
                            <div class="course-instructor">Alex Iwobi</div>
                            <div class="course-price">$19.99</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="<?= base_url('course-description'); ?>">
                    <div class="course-card">
                        <img src="./assets/img/backend-web-course-img.jpg" alt="Course Image" />
                        <div class="card-body">
                            <h4 class="card-title">Build an Ecommerce Website with PHP from Scratch [Backend Full
                                Course]</h4>
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
                            <div class="course-instructor">Alex Iwobi</div>
                            <div class="course-price">$19.99</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="<?= base_url('course-description'); ?>">
                    <div class="course-card">
                        <img src="./assets/img/front-end-web-course-img.jpg" alt="Course Image" />
                        <div class="card-body">
                            <h4 class="card-title">Certificate in FrontEnd Web Development using HTML, CSS, JS and
                                Frameworks</h4>
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
                            <div class="course-instructor">Kolawole John</div>
                            <div class="course-price">$19.99</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <hr>
        <h2 class="course-category">Teaching and Academics</h2>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="<?= base_url('course-description'); ?>">
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
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="<?= base_url('course-description'); ?>">
                    <div class="course-card">
                        <img src="./assets/img/py4web.jpg" alt="Course Image" />
                        <div class="card-body">
                            <h4 class="card-title">Learn Python Programming for Web Development (In Ten Easy Steps)</h4>
                            <!-- <p class="card-text">Brief description of the course content goes here.</p> -->
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
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="<?= base_url('course-description'); ?>">
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
                </a>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="<?= base_url('course-description'); ?>">
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
                </a>
            </div>
        </div>
    </div>
    <?php include(APPPATH . 'Views/include/footer1.php'); ?>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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