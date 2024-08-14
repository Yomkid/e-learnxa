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
        .thumbnail-container {
            position: relative;
            width: 100%;
            padding-top: 56.25%;
            /* 16:9 Aspect Ratio */
            background-size: cover;
            background-position: center;
            cursor: pointer;
        }

        .thumbnail-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .play-icon,
        .course-review-text {
            position: absolute;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .play-icon {
            font-size: 3rem;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .course-review-text {
            bottom: 10px;
            left: 10px;
            font-size: 1.2rem;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php include(APPPATH . 'Views/include/newNav2.php'); ?>
    <div class="course-heading">
        <h2 class="coursepage-title">The Complete JavaScript Course 2024: From Zero to Expert!</h2>
        <div class="course-rating">
            <span class="rating">4.5</span>
            <span class="rating-stars" style="color: #ffc107;">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-alt"></i>
            </span>
            <span class="rating-count">(1,234)</span>
        </div>
    </div>
    <div class="hero-section">
        <div class="container">
            <div class="col-8 py-4">
                <div class="d-flex flex-column justify-content-between">
                    <div>
                        <!-- <ul class="breadcrumbs">
                            <li><a href="#">Development</a></li>
                            <li><a href="#">Web Development</a></li>
                            <li>JavaScript</li>
                        </ul> -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Development</a></li>
                                <li class="breadcrumb-item"><a href="#">Web Development</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="#">JavaScript</a></li>
                            </ol>
                        </nav>
                        <h1>The Complete JavaScript Course 2024: From Zero to Expert!</h1>
                        <p>The modern JavaScript course for everyone! Master JavaScript with projects, challenges, and
                            theory. Many courses in one!</p>
                        <div class="course-rating">
                            <span class="rating">4.5</span>
                            <span class="rating-stars" style="color: #ffc107;">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-alt"></i>
                            </span>
                            <span class="rating-count">(1,234)</span>
                        </div>
                    </div>
                    <div class="mt-1">
                        <div class="course-instructor d-flex align-items-center">
                            <div class="instructor">
                                <img src="./assets/img/animated.jpeg" alt="">
                            </div>
                            <div>
                                Instructor: <span class="hero-section-instructor-name"><a
                                        href="#instructor-section">Busola
                                        Fajana</a></span>
                            </div>
                        </div>
                        <div class="d-flex mt-2 align-items-center justify-content-between">
                            <div class="">Uploaded on <b>June 3, 2024</b></div>
                            <div>Language: <b>Pidgin English</b></div>
                            <span><b>23</b> already enrolled</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container course-description">
        <div class="row">
            <div class="col-8">
                <div class="course-details">
                    <h2>Course Overview</h2>
                    <p><strong>This course will take you from a complete</strong> beginner to a proficient web
                        developer. You will learn
                        HTML, CSS, JavaScript, and other essential web technologies. By the end of this course, you will
                        be able to build modern, responsive websites and web applications.</p>

                    <div class="descriptions-container border p-3 my-4">
                        <h2>Skills you'll aquired</h2>
                        <ul class="multi-column-list">
                            <li><i class="fas fa-check"></i> HTML5 and CSS3</li>
                            <li><i class="fas fa-check"></i> JavaScript and jQuery</li>
                            <li><i class="fas fa-check"></i> Responsive Web Design</li>
                            <li><i class="fas fa-check"></i> Front-end Frameworks</li>
                            <li><i class="fas fa-check"></i> Back-end Development</li>
                            <li><i class="fas fa-check"></i> Database Management</li>
                            <li><i class="fas fa-check"></i> Version Control with Git</li>
                        </ul>
                    </div>
                    <div class="descriptions-container mb-4">
                        <h2 class="mb-3">Course Compact</h2>
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">
                                        Introduction to the Course
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <strong>This is the first item's accordion body.</strong> It is shown by
                                        default, until the collapse plugin adds the appropriate classes that we use to
                                        style each element. These classes control the overall appearance, as well as the
                                        showing and hiding via CSS transitions. You can modify any of this with custom
                                        CSS or overriding our default variables. It's also worth noting that just about
                                        any HTML can go within the <code>.accordion-body</code>, though the transition
                                        does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseTwo">
                                        Computer Basics
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <strong>This is the second item's accordion body.</strong> It is hidden by
                                        default, until the collapse plugin adds the appropriate classes that we use to
                                        style each element. These classes control the overall appearance, as well as the
                                        showing and hiding via CSS transitions. You can modify any of this with custom
                                        CSS or overriding our default variables. It's also worth noting that just about
                                        any HTML can go within the <code>.accordion-body</code>, though the transition
                                        does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseThree">
                                        Getting Stated with HTML and CSS
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <strong>This is the third item's accordion body.</strong> It is hidden by
                                        default, until the collapse plugin adds the appropriate classes that we use to
                                        style each element. These classes control the overall appearance, as well as the
                                        showing and hiding via CSS transitions. You can modify any of this with custom
                                        CSS or overriding our default variables. It's also worth noting that just about
                                        any HTML can go within the <code>.accordion-body</code>, though the transition
                                        does limit overflow.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2>Requirements</h2>
                    <ul style="list-style-type: disc; padding-left: 20px;">
                        <li> No prior programming experience required</li>
                        <li> A computer with internet access</li>
                        <li> A willingness to learn and practice</li>
                    </ul>

                    <div class="my-4">
                        <h2>Description</h2>
                        <div id="course-description" class="fade-text">
                            <p>
                                The Complete JavaScript Course 2024: From Zero to Expert! Welcome to "The Complete
                                JavaScript Course 2024: From Zero to Expert!" Whether you are a complete beginner or an
                                experienced developer looking to deepen your understanding of JavaScript, this course is
                                designed to take you from the very basics to advanced concepts, equipping you with the
                                skills needed to become a JavaScript expert.
                            </p>
                            <p>
                                What You'll Learn:
                                Foundations of JavaScript:
                                Understand the core syntax and structure of JavaScript.
                                Master data types, variables, operators, and control structures.
                                Learn about functions, scope, and closures.
                            </p>
                            <p>
                                Advanced JavaScript Concepts:
                                Dive deep into object-oriented programming with JavaScript.
                                Explore prototypes, inheritance, and the this keyword.
                                Understand asynchronous JavaScript, including callbacks, promises, and async/await.
                            </p>
                            <p>
                                DOM Manipulation:
                                Learn how to interact with and manipulate the Document Object Model (DOM).
                                Master event handling, form validation, and DOM traversal.
                            </p>
                            <p>
                                Modern JavaScript (ES6+):
                                Get up to speed with the latest features and syntax introduced in ECMAScript 6 and
                                beyond.
                                Learn about arrow functions, template literals, destructuring, and modules.
                            </p>
                            <p>
                                JavaScript in the Browser:
                                Understand how JavaScript works in the browser environment.
                                Learn about web APIs, AJAX, and fetch for making HTTP requests.
                                Explore front-end frameworks and libraries like React, Angular, or Vue.js (brief
                                overview).
                            </p>
                            <p>
                                JavaScript on the Server:
                                Introduction to server-side JavaScript with Node.js.
                                Learn how to build RESTful APIs and work with databases.
                                Explore frameworks like Express.js.
                            </p>
                            <p>
                                Project-Based Learning:
                                Build real-world projects to apply your knowledge and gain practical experience.
                                Work on interactive web applications, dynamic web pages, and server-side scripts.
                                Develop a portfolio of projects to showcase your skills to potential employers.
                            </p>
                            <p>
                                Best Practices and Performance Optimization:
                                Learn about code quality, debugging, and testing in JavaScript.
                                Understand how to write clean, maintainable, and efficient code.
                                Explore techniques for optimizing performance and improving user experience.
                            </p>
                            <p>
                                Why Enroll in This Course?
                                Comprehensive Curriculum: This course covers everything from basic to advanced
                                JavaScript concepts, ensuring a thorough understanding of the language.
                                Hands-On Projects: Apply what you learn by building real-world projects, enhancing your
                                practical skills.
                                Expert Instructors: Learn from industry experts with years of experience in JavaScript
                                development.
                                Lifetime Access: Get lifetime access to course materials, including future updates.
                                Community Support: Join a community of learners and developers, where you can ask
                                questions, share knowledge, and collaborate on projects.
                            </p>
                            <p>
                                Who Is This Course For?
                                Beginners: Those new to programming or JavaScript will find the course accessible and
                                easy to follow.
                                Intermediate Developers: Developers with some experience in JavaScript looking to deepen
                                their knowledge and advance their skills.
                                Experienced Developers: Seasoned programmers seeking to master JavaScript and stay
                                updated with the latest trends and best practices.
                                Enroll today and start your journey to becoming a JavaScript expert. Transform your
                                skills, build dynamic web applications, and open doors to exciting career opportunities
                                in web development!
                            </p>
                        </div>
                        <div id="toggle-button" class="show-more-less-btn mt-3">Show More <i
                                class="fas fa-caret-down"></i>
                        </div>

                    </div>

                    <div class="instructor-section" id="instructor-section">
                        <h2>Meet the Instructor</h2>
                        <div class="d-flex align-items-start">
                            <div class="instructor-section-img">
                                <img src="./assets/img/animated.jpeg" alt="">
                            </div>
                            <div class="instructor-details">
                                <a href="instructor.php">
                                    <h4 style="color: #007bff; font-weight:bold;">Matthew Morris</h4>
                                </a>
                                <p style="font-size: 16px; font-weight:500;">Senior Web Developer and Educator</p>
                            </div>
                        </div>
                        <div class="about-instructor mt-4">
                            <p>With over 10 years of experience in web development and teaching, Matthew Morris brings a
                                wealth of
                                knowledge and a passion for coding to this comprehensive JavaScript course.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="sidebar-course-container">
                    <!-- <img src="./assets/img/py4web.jpg" alt="Course Image" /> -->
                    <!-- <img src="./assets/img/py4web.jpg" alt="Course Image" data-toggle="modal"
                        data-target="#videoModal" /> -->
                    <!-- <img id="video-thumbnail" src="" alt="Course Image" onclick="playVideo()" style="cursor: pointer;" />
                    <iframe id="vimeo-video" src="https://player.vimeo.com/video/76979871" frameborder="0"
                        allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="display: none;"></iframe> -->
                    <!-- <div class="thumbnail-container" onclick="playVideo()">
                        <img id="video-thumbnail" src="" alt="Course Image" />
                        <div class="play-icon">
                            <i class="fas fa-play-circle"></i>
                        </div>
                        <div class="course-review-text">Course Review</div>
                    </div>
                    <iframe id="vimeo-video" src="https://player.vimeo.com/video/76979871" frameborder="0"
                        allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
                        style="display: none;"></iframe> -->

                    <div class="thumbnail-container" id="video-thumbnail-container" data-toggle="modal"
                        data-target="#videoModal">
                        <div class="thumbnail-overlay"></div>
                        <div class="play-icon">
                            <i class="fas fa-play-circle" data-toggle="modal" data-target="#videoModal"></i>
                        </div>
                        <div class="course-review-text">Click to preview this course</div>
                    </div>

                    <div class="mx-4">
                        <div class="d-flex justify-content-between align-items-center my-3">
                            <div class="coursepage-price">₦41,900</div>
                        </div>
                        <a href="checkout.php"><button class="enroll-btn">Enroll Now</button></a>
                        <div class="course-info">
                            <div>Course Features:</div>
                            <p><i class="fas fa-clock"></i> 40 Hours</p>
                            <p><i class="fas fa-tv"></i> Live Class and Video Suggestions</p>
                            <p><i class="fas fa-book"></i> 18 Articles</p>
                            <p><i class="fas fa-download"></i> 12 Downloadable Resourses</p>
                            <p><i class="fas fa-user-graduate"></i> 43 Practicals</p>
                            <p><i class="fas fa-user-graduate"></i> 54 Hands on Project</p>
                            <p><i class="fas fa-certificate"></i> Certificate upon Completion</p>
                            <p><i class="fas fa-car"></i> Live Interactions</p>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content"
                            style="background-color: rgb(9, 25, 60); color: white; border-radius:none;">
                            <div class="modal-header">
                                <!-- <h6 class="modal-title" id="videoModalLabel">Course Preview</h6> -->
                                <h5 class="modal-title" id="videoModalLabel"><strong>The Complete JavaScript Course
                                        2024: From Zero to Expert!</strong></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    style="color: white;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/860473251"
                                        allowfullscreen></iframe>
                                </div>
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
        function fetchVimeoThumbnail(videoId) {
            fetch(`https://vimeo.com/api/v2/video/${videoId}.json`)
                .then(response => response.json())
                .then(data => {
                    const thumbnailUrl = data[0].thumbnail_large;
                    document.getElementById('video-thumbnail-container').style.backgroundImage =
                        `url(${thumbnailUrl})`;
                })
                .catch(error => console.error('Error fetching thumbnail:', error));
        }

        // function playVideo() {
        //     document.getElementById('video-thumbnail-container').style.display = 'none';
        //     document.getElementById('vimeo-video').style.display = 'block';
        // }

        document.addEventListener('DOMContentLoaded', function () {
            const videoId = '860473251'; // Replace with your Vimeo video ID
            fetchVimeoThumbnail(videoId);

            // Add click event listener to play video on thumbnail click
            document.getElementById('video-thumbnail-container').addEventListener('click', playVideo);
        });
        // function fetchVimeoThumbnail(videoId) {
        //     fetch(`https://vimeo.com/api/v2/video/${videoId}.json`)
        //         .then(response => response.json())
        //         .then(data => {
        //             const thumbnailUrl = data[0].thumbnail_large;
        //             document.getElementById('video-thumbnail').src = thumbnailUrl;
        //         })
        //         .catch(error => console.error('Error fetching thumbnail:', error));
        // }

        // function playVideo() {
        //     document.getElementById('video-thumbnail').style.display = 'none';
        //     document.getElementById('vimeo-video').style.display = 'block';
        // }

        // document.addEventListener('DOMContentLoaded', function () {
        //     const videoId = '76979871'; // Replace with your Vimeo video ID
        //     fetchVimeoThumbnail(videoId);
        // });

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