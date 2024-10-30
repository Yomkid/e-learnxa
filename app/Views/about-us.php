<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(APPPATH . 'Views/include/head.php'); ?>

    <title>About LearnXa | LearnXa</title>

    <style>
        .about-page {
            max-width: 800px;
            margin: auto;
        }

        .about-page h2 {
            font-size: 24px;
            font-weight: bold;
        }

        .founder-info img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
            padding: 5px;
            border: rgb(9, 25, 60) solid 2px;
        }
    </style>
</head>

<body>
    <?php include(APPPATH . 'Views/include/navbar.php'); ?>
    <section id="updates" class="py-5 bg-light">
        <div class=" container d-flex justify-content-between heading bg-light">
            <a class="navbar-brand nav-logo" href="#">Learn<span style="color: #007bff;">X</span>a</a>
            <h2 class="course-category">About LearnXa<i class="fas fa-chalkboard-teacher"></i></h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 update-content">
                    <h1>Experience Learning Like Never Before</h1>
                    <p>Welcome to LearnXa, your one-stop destination for transforming your learning experience. LearnXa is an
                innovative online learning marketplace designed to empower individuals and organizations to embrace the
                boundless possibilities of knowledge and growth. We offer a wide selection of courses aimed at helping
                you gain new skills, taught by industry experts to ensure you stay ahead in your educational and
                professional journey.</p>
                    <a href="#" class="btn btn-success">Join a Live Class</a>
                </div>
                <div class="col-lg-6 col-md-6 update-image">
                    <img src="./assets/img/liveclass.jpg" alt="Live Class Image">
                </div>
            </div>
        </div>
    </section>

    <div class="container about-page mt-4">

        <!-- <a href="javascript:history.back()" class="text-dark d-flex align-items-center gap-1 sticky-back-button">
            <i class="far fa-arrow-alt-circle-left fa-1x sticky-top mr-5"></i> <span>Back</span>
        </a> -->
        <div class="content-section">
            <!-- <h2>About LearnXa</h2>
            <hr>
            <p>
                Welcome to LearnXa, your one-stop destination for transforming your learning experience. LearnXa is an
                innovative online learning marketplace designed to empower individuals and organizations to embrace the
                boundless possibilities of knowledge and growth. We offer a wide selection of courses aimed at helping
                you gain new skills, taught by industry experts to ensure you stay ahead in your educational and
                professional journey.
            </p> -->
            <p>
                At LearnXa, we are committed to making learning accessible and affordable for all. With courses starting
                at just ₦2,000, you can embark on a journey of continuous education and skill development that fits your
                schedule and budget. Whether you want to master technology, business, personal development, or creative
                skills, LearnXa provides the tools and resources you need to succeed.
            </p>
            <p>
                We also offer a seamless learning experience through our platform, providing access to video lessons,
                interactive quizzes, downloadable resources, and community forums for engaging with instructors and
                fellow learners. LearnXa is designed to support your growth every step of the way, ensuring a
                transformative and enriching journey in the world of online learning.
            </p>

            <h2>About the LearnXa App</h2>
            LearnXa offers a Progressive Web App (PWA) experience that provides seamless and efficient access across all
            devices and platforms. Whether you are using a smartphone, tablet, or desktop, the LearnXa app delivers a
            smooth, app-like experience without needing to download from an app store.

            As a PWA, LearnXa combines the best of web and mobile apps, ensuring fast loading times, offline access, and
            push notifications to keep you updated on your learning progress. The app is optimized for performance and
            works across all major browsers, making it accessible whether you're on Windows, macOS, Linux, Android, or
            iOS.

            Enjoy the flexibility of learning anytime, anywhere with the convenience of the LearnXa app.
            <div id="installButtonContainer" style="display:none;">
                <!-- Button for PWA Install -->
                <button id="installButton" class="install-button">
                    <span class="install-button-icon">
                        <img src="./assets/icons/icon-white-192x192.png" alt="Install Icon" class="shadow-sm">
                    </span>
                    <span class="install-button-text"><svg class="bi bi-download mb-1" fill="currentColor" height="24"
                            viewBox="0 0 16 16" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z">
                            </path>
                            <path
                                d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z">
                            </path>
                        </svg> Install LearnXa App</span>
                </button>
            </div>
        </div>

        <div class="content-section mt-4">
            <h2>Our Founder</h2>
            <div class="founder-info d-flex mt-3">
                <img src="./assets/img/profile-img.jpg" alt="Mayomi P. Odewaye" class="mr-3" />
                <div>
                    <h4>Mayomi P. Odewaye</h4>
                    <p>Software Engineer / Data Analyst / Project Manager</p>
                    <p>OMPPEAK TECHNOLOGY, Inc.</p>
                </div>
            </div>
            <p class="mt-3">
                Mayomi P. Odewaye is the visionary behind LearnXa. With a wealth of experience in software engineering,
                data analysis, and project management, Mayomi brings expertise and passion to the platform. Specializing
                in Python programming, machine learning, web development, and PHP, Mayomi has dedicated his career to
                teaching and mentoring aspiring developers. As the founder of LearnXa, he is committed to creating
                innovative solutions that transform the educational landscape and provide individuals with the tools
                they need to succeed.
            </p>
        </div>

        <div class="content-section mt-4">
            <h2>Our Parent Company</h2>
            <p>
                LearnXa is proudly developed and operated under the guidance of OMPPEAK TECHNOLOGY, Inc., a leader in
                technological innovation and digital services. As a subsidiary, LearnXa benefits from OMPPEAK
                TECHNOLOGY’s extensive resources, expertise, and commitment to excellence, ensuring we deliver
                high-quality educational services to our users. Together, we strive to advance learning and support
                individuals, educators, and organizations in their pursuit of knowledge and professional growth.
            </p>
        </div>
    </div>

    <?php include(APPPATH . 'Views/include/footer1.php'); ?>

    <?php include(APPPATH . 'Views/include/js.php'); ?>

    <script>
        $(document).ready(function () {
            var prevScrollpos = window.pageYOffset;
            var navbar = document.querySelector('.navbar');

            function handleScroll() {
                var currentScrollPos = window.pageYOffset;

                if (prevScrollpos > currentScrollPos) {
                    navbar.style.top = "0";
                } else {
                    navbar.style.top = "-80px";
                }

                prevScrollpos = currentScrollPos;
            }

            window.addEventListener('scroll', handleScroll);
        });
    </script>
</body>

</html>
