<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title><?= $title ?> | LearnXa</title>

    

   
    <!-- Open Graph tags for social media sharing (Facebook, LinkedIn, etc.) -->
    <meta property="og:title" content="<?= $title ?>">
    <meta property="og:description" content="<?= $overview ?>">
    <meta property="og:image" content="<?= base_url('uploads/' . $image) ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="<?= base_url('course/' . $slug) ?>"> <!-- Include slug here -->
    <meta property="og:type" content="article">
    <!-- <meta name="description" content="<?= $overview ?>"> -->
    <meta property="og:description" content="<?= $overview ?>">
    <meta name="author" content="Odewaye Mayomi">


    <!-- Twitter Card for social media sharing -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $title ?>">
    <meta name="twitter:description" content="<?= $overview ?>">
    <meta name="twitter:image" content="<?= $image ?>">
    <meta name="twitter:url" content="<?= base_url('course/' . $slug) ?>"> <!-- Include slug here -->

    <!-- Optional: Keywords for SEO -->
    <meta name="keywords" content="<?= $overview ?>">


    <!-- Add any other meta tags for specific requirements -->

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

        /* Styling for the sidebar on desktop */
        .sidebar-course-content {
            padding: 15px;
        }

        .sidebar-course-container .course-info {
            margin-top: 20px;
        }

        .sidebar-course-container .coursepage-price {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .sidebar-course-container .enroll-btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            /* border-radius: 5px; */
            font-size: 1rem;
            cursor: pointer;
        }

        .sidebar-course-container .enroll-btn:hover {
            background-color: #0056b3;
        }

        /* Styling for the fixed container on mobile screens */
        .fixed-bottom-container {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        .fixed-bottom-container .coursepage-price {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .fixed-bottom-container .enroll-btn {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 0;
            font-size: 1.25rem;
        }

        .fixed-bottom-container .enroll-btn:hover {
            background-color: #0056b3;
        }

        .thumbnail-course-title h2 {
            font-weight: bold;
            font-size: 1.5rem;
            /* Adjust the size as needed */
        }

        
        /* Hide the fixed container on desktop */
        @media (min-width: 768px) {
            .fixed-bottom-container {
                display: none;
            }
        }

        @media (max-width: 767px) {
            .hero-section {
                display: none;
            }

            .thumbnail-container {
                display: block;
                /* margin-top: 20px; */
            }

            .thumbnail-breadcrumb-item + .thumbnail-breadcrumb-item::before {
                content:'/ ';
                color: #6c757d; /* Change separator color */
            }
            .thumbnail-breadcrumb {
                color:#007bff;
            }
        }

        

        /* Smaller size for mobile screens */
        @media (max-width: 767.98px) {
            h2{
                font-size: 1.5rem; /* Adjust as needed */
            }
        }

        .hidden {
            display: none !important;
        }




        ul.multi-column-list {
            padding-left: 0; /* Remove default padding */
            list-style-type: none; /* Remove default list styling */
            column-count: 2; /* Default column count */
            column-gap: 1rem; /* Space between columns */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            ul.multi-column-list {
                column-count: 1; /* Single column on smaller screens */
            }
        }

    </style>
</head>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/67236ed42480f5b4f596b0d4/1ibh6htl1';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-90XYHBSS6Z"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-90XYHBSS6Z');
</script>

<body>
<?php include(APPPATH . 'Views/include/navbar.php'); ?>

    <div class="course-heading hidden d-md-block">
        <h2 class="coursepage-title"><?= $title ?></h2>
        <div class="course-rating">
            <span class="rating"><?= number_format($rating, 1) ?></span>
            <span class="rating-stars" style="color: #ffc107;">
                <?php for ($i = 0; $i < floor($rating); $i++) : ?>
                    <i class="fa fa-star"></i>
                <?php endfor; ?>
                <?php if ($rating - floor($rating) > 0) : ?>
                    <i class="fa fa-star-half-alt"></i>
                <?php endif; ?>
            </span>
            <span class="rating-count">(<?= esc($rating_count) ?>)</span>
        </div>
    </div>

    <!-- Hero Section for Desktop -->
    <div class="hero-section d-none d-md-block">
        <div class="container-md">
            <div class="col-md-8 py-4">
                <div class="d-flex flex-column justify-content-between">
                    <div>
                        <!-- <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Development</a></li>
                                <li class="breadcrumb-item"><a href="#">Web Development</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="#">JavaScript</a></li>
                            </ol>
                        </nav> -->
                        <br>
                        <h1><?= $title ?></h1>
                        <p><?= $tagline ?></p>
                        <div class="course-rating">
                            <span class="rating"><?= esc($rating) ?></span>
                            <span class="rating-stars" style="color: #ffc107;">
                                <?php for ($i = 0; $i < floor($rating); $i++) : ?>
                                    <i class="fa fa-star"></i>
                                <?php endfor; ?>
                                <?php if ($rating - floor($rating) > 0) : ?>
                                    <i class="fa fa-star-half-alt"></i>
                                <?php endif; ?>
                            </span>
                            <span class="rating-count">(<?= esc($rating_count) ?>)</span>
                        </div>
                    </div>
                    <div class="mt-1">
                        <div class="course-instructor d-flex align-items-center">
                            <div class="instructor">
                                <img src="../assets/img/profile-img.jpg" alt="">
                            </div>
                            <div>
                                Instructor: <span class="hero-section-instructor-name"><a
                                        href="#instructor-section">Mayomi Odewaye</a></span>
                            </div>
                        </div>
                        <div class="d-flex mt-2 align-items-center justify-content-between">
                            <div class="">Created on <b><?= $created_at ?></b></div>
                            <div>Language: <b><?= $language ?></b></div>
                            <span><b><?= $enrollment_count ?></b> Students already enrolled</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Container for Mobile Thumbnail and Course Info -->
    <div class="d-md-none">
        <!-- Thumbnail for Mobile -->
        <!-- <nav class="container mt-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="thumbnail-breadcrumb-item"><a href="#">Development</a></li>
                <li class="thumbnail-breadcrumb-item"><a href="#">Web Development</a></li>
                <li class="thumbnail-breadcrumb-item active" aria-current="page">JavaScript</li>
            </ol>
        </nav> -->


        <div class="thumbnail-container" style="background-image: url('/uploads/<?= $image ?>');"></div>


        <!-- For Video Thumbnail -->
        <!-- <div class="thumbnail-container video-thumbnail" data-video-id="860473251" data-toggle="modal"
            data-target="#videoModal">
            <div class="thumbnail-overlay"></div>
            <div class="play-icon">
                <i class="fas fa-play-circle" data-toggle="modal" data-target="#videoModal"></i>
            </div>
            <div class="course-review-text text-center">Preview this course</div>
        </div> -->

        <div class="container">
            <!-- Course Title for Mobile -->
            <div class="thumbnail-course-title mt-3">
                <h2><?= $title ?></h2>
            </div>

            <!-- Course Description for Mobile -->
            <div class="thumbnail-course-tagline">
                <p class="fs-6"><?= $tagline ?></p>
            </div>


            <!-- Course Rating -->
            <div class="course-rating">
                <span class="rating"><?= esc($rating) ?></span>
                <span class="rating-stars" style="color: #ffc107;">
                    <?php for ($i = 0; $i < floor($rating); $i++) : ?>
                        <i class="fa fa-star"></i>
                    <?php endfor; ?>
                    <?php if ($rating - floor($rating) > 0) : ?>
                        <i class="fa fa-star-half-alt"></i>
                    <?php endif; ?>
                </span>
                <span class="rating-count">(<?= esc($rating_count) ?>)</span>
                <span><b><?= $enrollment_count ?></b> Students already enrolled</span>
            </div>

            <div class="mt-1">
                <!-- Course Instructor -->
                <div class="course-instructor d-flex align-items-center">
                    <div class="instructor">
                        <img src="../assets/img/profile-img.jpg" alt="">
                    </div>
                    <div>
                        Course by: <span class="hero-section-instructor-name"><a href="#instructor-section"
                                style="color:#007bff;">Mayomi Odewaye</a></span>
                    </div>
                </div>
                <div class="mt-2">
                    <div><i class="fas fa-calendar-alt"></i> Created on <b><?= $created_at ?></b></div>
                    <div><i class="fas fa-globe"></i></i> Language: <b><?= $language ?></b></div>
                </div>
            </div>

            <!-- Price and Enroll Button -->
            <div class="sidebar-enroll">
                <div class="bg-white border-bottom py-3 px-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="coursepage-price">₦<?= number_format($price) ?></div>
                    </div>
                    <a href="<?= site_url('enroll/' . $course_id) ?>">
                        <button class="enroll-btn">Enroll Now</button>
                    </a>
                </div>
            </div>
        </div>

    </div>



    <div class="container course-description">
        <div class="row">
            <div class="col-md-8">
                <div class="course-details">
                    <h2>Course Overview</h2>
                    <?= $overview ?>

                    <!-- <div class="descriptions-container border p-3 my-4">
                        <h2>Skills you'll aquired</h2>
                        <ul class="multi-column-list">
                            <li><i class="fas fa-check"></i> </li>  
                        </ul>
                    </div> -->
                    <div class="descriptions-container border p-3 my-4">
                        <h2>Skills you'll aquired</h2>
                        <ul class="multi-column-list">
                        <?= $acquiring_skills ?>  
                        </ul>
                    </div>

                    


                    <!-- Display Course Info on Mobile Screen -->
                    <div class="course-info d-md-none">
                        <div class="font-weight-bold mb-1">Course Features:</div>
                        <div class="lh-sm">
                            <p><i class="fas fa-clock"></i> <?= $duration ?> Hours</p>
                            <p><i class="fas fa-tv"></i> Live Class and Video Suggestions</p>
                            <p><i class="fas fa-book"></i> 18 Articles</p>
                            <p><i class="fas fa-download"></i> 12 Downloadable Resources</p>
                            <p><i class="fas fa-user-graduate"></i> 43 Practicals</p>
                            <p><i class="fas fa-user-graduate"></i> 54 Hands-on Projects</p>
                            <p><i class="fas fa-certificate"></i> Certificate upon Completion</p>
                            <p><i class="fas fa-car"></i> Live Interactions</p>
                        </div>
                    </div>


                    <div class="descriptions-container mb-4">
                        <h2 class="mb-3">Course Compact</h2>
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <?php foreach ($compactTitles as $index => $title): ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button <?php echo $index === 0 ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapse<?php echo $index; ?>" aria-expanded="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                                            aria-controls="panelsStayOpen-collapse<?php echo $index; ?>">
                                            <?php echo htmlspecialchars($title); ?>
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapse<?php echo $index; ?>" class="accordion-collapse collapse <?php echo $index === 0 ? 'show' : ''; ?>">
                                        <div class="accordion-body">
                                            <?php echo $compactContents[$index]; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>




                    

                    <h2>Requirements</h2>
                    <ul style="list-style-type: disc; padding-left: 20px;">
                        <?= $requirements ?>
                    </ul>

                    <div class="my-4">
                        <h2>Description</h2>
                        <div id="course-description" class="fade-text">
                        <?= $descriptions ?>
                        </div>
                        <div id="toggle-button" class="show-more-less-btn mt-3">Show More <i
                                class="fas fa-caret-down"></i>
                        </div>

                    </div>

                    <div class="instructor-section" id="instructor-section">
                        <h2>Meet the Instructor</h2>
                        <div class="d-flex align-items-start">
                            <div class="instructor-section-img">
                                <img src="../assets/img/profile-img.jpg" alt="">
                            </div>
                            <div class="instructor-details">
                                <a href="<?= base_url('/instructor'); ?>">
                                    <h4 style="color: #007bff; font-weight:bold;">Mayomi Odewaye</h4>
                                </a>
                                <p style="font-size: 16px; font-weight:500;">Software Engineer / Data Analyst / Project Manager</p>
                            </div>
                        </div>
                        <div class="about-instructor mt-4">
                            <p>Mayomi Odewaye is a dynamic and accomplished professional who has made significant contributions to the fields of software engineering, data analysis, and project management. With a strong academic background and practical experience in Python programming, Machine Learning, Web Development, and PHP, Mayomi is passionate about teaching and mentoring aspiring developers. As the founder of KrossCheck, Mayomi is dedicated to providing innovative solutions that enhance the educational experience and streamline academic processes.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-none d-md-block">
                <div class="sidebar-course-container">


                <!-- Image Thumbnail -->
                <div class="thumbnail-container" style="background-image: url('/uploads/<?= $image ?>');"></div>



                    <!-- Video Thumbnail and Course Info (It will be used Later) -->
                    <!-- <div class="thumbnail-container video-thumbnail" data-video-id="860473251" data-toggle="modal"
                        data-target="#videoModal">
                        <div class="thumbnail-overlay"></div>
                        <div class="play-icon">
                            <i class="fas fa-play-circle" data-toggle="modal" data-target="#videoModal"></i>
                        </div>
                        <div class="course-review-text">Click to preview this course</div>
                    </div> -->


                    <div class="sidebar-course-content">

                        <!-- Sidebar Enroll Section -->
                        <div class="sidebar-enroll d-none d-md-block">
                            <div class="bg-white border-bottom pb-1 px-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="coursepage-price">₦<?= number_format($price) ?></div>
                                </div>
                                <?php if ($isEnrolled): ?>
                                    <a href="<?= site_url('student/course-details/' . $course_id) ?>">
                                        <button class="enroll-btn">Enrolled (Continue Learning)</button>
                                    </a>
                                <?php else: ?>
                                    <a href="<?= site_url('enroll/' . $course_id) ?>">
                                        <button class="enroll-btn">Enroll Now</button>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="course-info">
                            <div>Course Features:</div>
                            <p><i class="fas fa-clock"></i> <?= $duration ?> Hours</p>
                            <p><i class="fas fa-tv"></i> Live Class and Video Suggestions</p>
                            <p><i class="fas fa-book"></i> 18 Articles</p>
                            <p><i class="fas fa-download"></i> 12 Downloadable Resources</p>
                            <p><i class="fas fa-user-graduate"></i> 43 Practicals</p>
                            <p><i class="fas fa-user-graduate"></i> 54 Hands-on Projects</p>
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
                            style="background-color: rgb(9, 25, 60); color: white; border-radius: none;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="videoModalLabel"><strong><?= $title ?></strong></h5>
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

            <!-- Fixed container for mobile screens -->
            <div class="fixed-bottom-container d-block d-md-none">
                <div class="bg-white border-top py-2 px-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="coursepage-price">₦<?= number_format($price) ?></div>
                        
                        <?php if ($isEnrolled): ?>
                            <a href="<?= site_url('student/course-details/' . $course_id) ?>">
                                <button class="enroll-btn">Enrolled (Continue Learning)</button>
                            </a>
                        <?php else: ?>
                            <a href="<?= site_url('enroll/' . $course_id) ?>">
                                <button class="enroll-btn">Enroll Now</button>
                            </a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php include(APPPATH . 'Views/include/footer1.php'); ?>


    <?php include(APPPATH . 'Views/include/js.php'); ?>


    <script>
        function fetchVimeoThumbnail(videoId, element) {
            fetch(`https://vimeo.com/api/v2/video/${videoId}.json`)
                .then(response => response.json())
                .then(data => {
                    const thumbnailUrl = data[0].thumbnail_large;
                    element.style.backgroundImage = `url(${thumbnailUrl})`;
                })
                .catch(error => console.error('Error fetching thumbnail:', error));
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Get all video thumbnail elements
            const videoThumbnails = document.querySelectorAll('.video-thumbnail');

            videoThumbnails.forEach(thumbnail => {
                // Get the video ID from a data attribute
                const videoId = thumbnail.getAttribute('data-video-id');

                // Fetch and apply the thumbnail
                fetchVimeoThumbnail(videoId, thumbnail);

                // Add click event listener to play video on thumbnail click
                thumbnail.addEventListener('click', playVideo);
            });
        });

        function playVideo() {
            // Function to play video (implement as needed)
            console.log('Play video triggered');
        }



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
                    heading.classList.remove('hidden');
                } else {
                    heading.classList.add('hidden');
                }

                prevScrollpos = currentScrollPos;
            }

            window.addEventListener('scroll', handleScroll);

            heading.classList.add('hidden'); // Ensure it's hidden initially
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