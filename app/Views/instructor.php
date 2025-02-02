<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(APPPATH . 'Views/include/head.php'); ?>
    <title>Odewaye Mayomi | LearnXa</title>
    
    <style>
        .about-instructor-page {
            max-width: 800px;
        }
    </style>
</head>
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
            
        </div>
    </div>

    <?php include(APPPATH . 'Views/include/footer1.php'); ?>



    <?php include(APPPATH . 'Views/include/js.php'); ?>


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