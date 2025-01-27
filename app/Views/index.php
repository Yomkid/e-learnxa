<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(APPPATH . 'Views/include/head.php'); ?>
    <title>LearnXa | Online Platform to Explore Courses, Learn, and Achieve Skills</title>
    <meta name="description" content="LearnXa offers a dynamic online learning marketplace to explore courses and gain new skills. Start learning for as low as ₦2,000 today!">
    <meta name="keywords" content="online learning, e-learning, LearnXa, skill development, affordable courses, career growth">
    <meta name="author" content="LearnXa">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="canonical" href="https://learnxa.com">
    <meta property="og:title" content="LearnXa | Online Platform to Explore Courses, Learn, and Achieve Skills">
    <meta property="og:description" content="Discover LearnXa, the ultimate online learning marketplace where you can explore courses and achieve your educational goals.">
    <meta property="og:image" content="https://learnxa.com/assets/img/LearnXa_publicity_design.jpg">
    <meta property="og:url" content="https://learnxa.com">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="LearnXa | Online Platform to Explore Courses, Learn, and Achieve Skills">
    <meta name="twitter:description" content="Learn from industry experts with LearnXa. Affordable courses starting from ₦2,000.">
    <meta name="twitter:image" content="https://learnxa.com/assets/img/LearnXa_publicity_design.jpg">
    <link rel="icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Company",
      "name": "LearnXa",
      "url": "https://learnxa.com",
      "logo": "https://learnxa.com/assets/img/learnxalogo.png",
      "sameAs": [
        "https://www.facebook.com/LearnXa",
        "https://X.com/LearnXa",
        "https://www.instagram.com/LearnXa"
      ],
      "description": "LearnXa is a dynamic online learning platform offering affordable courses to help you develop new skills and grow your career."
    }
    </script>
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
    <!-- Navigation Bar -->
    <?php include(APPPATH . 'Views/include/navbar.php'); ?>


    <!-- Hero Section -->
    <div class="hero"
        style="background: url('./assets/img/hero_image.png') no-repeat center center/cover; min-height: 100vh;">
        <div class="hero-content d-flex align-items-center" style="height: 100%;">
            <div class="container col-xxl-8 px-4 py-5">
                <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                    <div class="col-lg-5 col-10 col-sm-8">
                        <img src="./assets/img/happyman.webp" class="d-block mx-lg-auto img-fluid"
                            alt="LearnXa Hero Image" width="700" height="500" loading="lazy">
                    </div>
                    <div class="col-lg-7">
                        <h1 class="display-5 fwt-bold text-body-emphasis lh-1 mb-3 text-responsive">
                            Learn, e<span style="color: #007bff;">X</span>plore, and Achieve with LearnXa
                        </h1>
                        <p class="lead text-responsive">
                            Discover a dynamic online learning marketplace with a growing selection of courses designed
                            to help you gain new skills. Learn from industry experts and embark on your educational
                            journey for just <strong class="text-danger">₦2,000</strong>!
                        </p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start" style="z-index: 1030;">
                            <a href="#startLearning">
                                <button type="button" class="btn btn-primary btn-lg px-4 me-md-2 mr-2"
                                    style="border-radius:none; cursor: pointer;">Explore</button>
                            </a>
                            <a href="/login">
                                <button type="button" class="btn btn-outline-primary btn-lg px-4"
                                    stylte="color:#007bff;">
                                    Start Learning
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <main id="startLearning">
        <div class="container mt-4">
            <div class="popular-categories">
                Develop new skills and launch a new career in just 6 months.
            </div>
            <!-- Quick Access Buttons -->


            <div class="topic-pagination-container">
                <div class="d-flex align-items-center mb-0">
                    <button class="scroll-button d-flex" onclick="scrollButtons(-200)"><i
                            class="fas fa-angle-left"></i></button>
                    <div class="button-container">
                        <div class="button-flex" id="buttonScrollContainer">
                           
                        </div>
                    </div>
                    <button class="scroll-button d-flex" onclick="scrollButtons(200)"><i
                            class="fas fa-angle-right"></i></button>
                    <!-- <button class="scroll-button d-flex" onclick="scrollButtons(200)"><i class="fas fa-chevron-circle-right"></i></button> -->
                </div>
                <hr class="mt-0">

                <h2 id="categoryHeader"></h2> <!-- This is for displaying the category name -->
                <p id="categoryDescription"></p> <!-- This is for displaying the category description -->

                <div class="d-flex align-items-center mb-0">
                    <!-- Left Scroll Button -->
                    <button class="scroll-buttonc left" onclick="courseScrollButtons(-300)" id="leftScrollButton"><i
                            class="fas fa-angle-left"></i></button>


                    <div class="courses-container" id="coursesContainer">
                        <!-- Courses will be displayed here -->
                    </div>

                    <!-- Right Scroll Button -->
                    <button class="scroll-buttonc right" onclick="courseScrollButtons(300)" id="rightScrollButton"><i
                            class="fas fa-angle-right"></i></button>
                </div>

            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Fetch and render categories
                    fetch('/api/categories') // Adjust the endpoint as necessary
                        .then(response => response.json())
                        .then(categories => {
                            const buttonContainer = document.getElementById('buttonScrollContainer');

                            // Reset the container before rendering
                            buttonContainer.innerHTML = '';

                            // Create category buttons dynamically
                            categories.forEach((category, index) => {
                                const categoryButton = document.createElement('button');
                                categoryButton.type = 'button';
                                categoryButton.className = 'btn btn-custom';
                                categoryButton.dataset.category = category
                                    .category_name; // Use the category name for data-category
                                categoryButton.dataset.description = category
                                    .category_description; // Store category description as data attribute
                                categoryButton.onclick = function () {
                                    showCourses(category.category_id, this, category
                                        .category_name, category.category_description);
                                };
                                categoryButton.textContent = category.category_name;
                                buttonContainer.appendChild(categoryButton);

                                // Automatically activate the first category button and load its courses
                                if (index === 0) {
                                    categoryButton.classList.add(
                                        'active'); // Set the first button as active
                                    showCourses(category.category_id, categoryButton, category
                                        .category_name, category.category_description
                                    ); // Load courses for the first category
                                }
                            });
                        })
                        .catch(error => {
                            console.error('There was a problem with the fetch operation:', error);
                        });

                    // Function to show courses based on the clicked category
                    function showCourses(categoryId, element, categoryName, categoryDescription) {
                        const coursesContainer = document.getElementById('coursesContainer');
                        const categoryHeader = document.getElementById(
                            'categoryHeader'); // Element for category name
                        const categoryDescriptionElement = document.getElementById(
                            'categoryDescription'); // Element for category description

                        if (!categoryHeader || !categoryDescriptionElement) {
                            console.error("Elements for category header or description not found!");
                            return;
                        }

                        coursesContainer.innerHTML = '';

                        // Update the category name and description
                        categoryHeader.textContent = categoryName;
                        categoryDescriptionElement.textContent = categoryDescription;

                        // Remove 'active' class from all buttons
                        const buttons = document.querySelectorAll('.btn-custom');
                        buttons.forEach(btn => btn.classList.remove('active'));

                        // Add 'active' class to the clicked button
                        element.classList.add('active');

                        // Fetch courses for the selected category
                        fetch(`/api/courses/category/${categoryId}`) // Adjust the endpoint as necessary
                            .then(response => response.json())
                            .then(courses => {
                                if (courses.length === 0) {
                                    coursesContainer.innerHTML =
                                        '<p>No courses available for this category.</p>';
                                    return;
                                }

                                // Render courses for the selected category
                                courses.forEach(course => {
                                    // const card = document.createElement('div');
                                    // card.className = 'course-card-homepage';

                                    const cardLink = document.createElement('a');
                                    cardLink.href =
                                        `/course/${course.slug}`; // Adjust the URL as necessary
                                    cardLink.className = 'course-card-homepage';

                                    const card = document.createElement('div');
                                    // card.className = 'course-card-homepage';

                                    const img = document.createElement('img');
                                    let courseImage = course.course_image ?
                                        `uploads/${course.course_image}` : course_title;
                                    img.src = courseImage;
                                    img.alt = course.course_title;
                                    card.appendChild(img);

                                    const cardBody = document.createElement('div');
                                    cardBody.className = 'card-body';

                                    const title = document.createElement('h4');
                                    title.className = 'card-title';
                                    title.textContent = course.course_title;
                                    cardBody.appendChild(title);

                                    const ratingContainer = document.createElement('div');
                                    ratingContainer.className = 'course-rating';

                                    const rating = document.createElement('span');
                                    rating.className = 'rating';
                                    rating.textContent = parseFloat(course.rating).toFixed(1);
                                    ratingContainer.appendChild(rating);

                                    const ratingStars = document.createElement('span');
                                    ratingStars.className = 'rating-stars';
                                    for (let i = 0; i < 5; i++) {
                                        const star = document.createElement('i');
                                        star.className = i < Math.floor(course.course_rating) ?
                                            'fa fa-star' : 'fa fa-star-half-alt';
                                        ratingStars.appendChild(star);
                                    }
                                    ratingContainer.appendChild(ratingStars);

                                    const ratingCount = document.createElement('span');
                                    ratingCount.className = 'rating-count';
                                    ratingCount.textContent = `(${course.rating_count})`;
                                    ratingContainer.appendChild(ratingCount);

                                    cardBody.appendChild(ratingContainer);

                                    const instructor = document.createElement('div');
                                    instructor.className = 'course-instructor';
                                    // instructor.textContent = course.instructor_id;
                                    instructor.textContent = 'Course by: OMPPEAK TECHNOLOGY';
                                    cardBody.appendChild(instructor);

                                    const price = document.createElement('div');
                                    price.className = 'course-price';

                                    // Format the price as a natural number with Naira currency
                                    const formattedPrice = new Intl.NumberFormat('en-NG', {
                                        style: 'currency',
                                        currency: 'NGN',
                                        maximumFractionDigits: 0
                                    }).format(course.price);

                                    price.textContent = formattedPrice;
                                    cardBody.appendChild(price);

                                    card.appendChild(cardBody);
                                    // coursesContainer.appendChild(card);
                                    cardLink.appendChild(card);
                                    coursesContainer.appendChild(cardLink);

                                });
                            })
                            .catch(error => {
                                console.error('Error fetching courses for category:', error);
                                coursesContainer.innerHTML =
                                    '<p>There was an error loading courses. Please try again later.</p>';
                            });
                    }
                });



                // Optional: Scroll buttons functionality
                function scrollButtons(offset) {
                    const container = document.getElementById('buttonScrollContainer');
                    container.scrollLeft += offset;
                }

                function courseScrollButtons(offset) {
                    const container = document.getElementById('coursesContainer');
                    container.scrollLeft += offset;
                }
            </script>
        </div>



        <!-- Popular Course Section -->
        <div class="container mt-0">
            <div class="d-flex justify-content-between heading mt-4">
                <a class="navbar-brand nav-logo" href="#">Learn<span style="color: #007bff;">X</span>a</a>
                <h2 class="course-category">Popular Courses</h2>
            </div>
            <!-- Scrollable Course Section -->
            <div class="scrollable-section-container">
                <button class="scroll-btn left-scroll" id="left-scroll-btn"><i class="fas fa-angle-left"></i></button>

                <div class="scrollable-section" id="scroltlable-section">
                    <?php foreach ($courses as $course): ?>
                    <a href="<?= base_url('course/' . $course['slug']); ?>" class="course-card">
                        <img src="<?= base_url('uploads/' . $course['course_image']) ?>"
                            alt="<?= $course['course_title'] ?>">
                        <div class="card-body">
                            <h4 class="card-title"><?= esc($course['course_title']) ?></h4>
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
                                <span class="rating-count">(<?= number_format($course['rating_count']) ?>)</span>
                            </div>
                            <p class="card-text"><?= esc($course['instructor_id']) ?></p>
                            <p class="card-text">₦<?= number_format($course['price']) ?></p>
                        </div>
                    </a>
                    <?php endforeach; ?>


                    <!-- Add more course cards as necessary -->
                </div>


                <button class="scroll-btn right-scroll" id="right-scroll-btn"><i
                        class="fas fa-angle-right"></i></button>
            </div>
            <a href="/courses"><button type="button" class="btn btn-outline-secondary btn-lg px-4">Explore &
                    Enroll</button></a>
        </div>



       
        <!-- Popular Category Section -->
        <div class="container mt-2">
            <div class="d-flex align-items-center justify-content-center mb-4">
                <div class="popular-categories">
                    Popular Categories
                </div>
                <div class="flex-grow-1 ml-3">
                    <div class="line"></div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($categories as $category): ?>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="<?= base_url('/category/' . $category['slug']); ?>">
                        <div class="category-card">
                            <div class="card-body">
                                <!-- <i class="fas fa-briefcase card-icon"></i> -->
                                <h5 class="card-title"><?= $category['category_name']; ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>

            </div>
        </div>

        <hr>


        <div class="course-listing">
            <?php foreach ($courses as $course): ?>
            <a href="<?= base_url('course/' . $course['slug']); ?>" class="course-item">
                <img src="<?= base_url('uploads/' . $course['course_image']) ?>" alt="<?= $course['course_title'] ?>"
                    class="course-image">
                <div class="course-details">
                    <h4 class="course-title"><?= $course['course_title']; ?></h4>
                    <p class="course-instructor"><?= $course['instructor_id']; ?></p>
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
                        <span class="rating-count">(<?= number_format($course['rating_count']) ?>)</span>
                    </div>
                    <!-- <p class="course-rating">
                        <span class="rating">4.6</span>
                        <span class="stars">⭐⭐⭐⭐⭐</span>
                        <span class="review-count">(<?= number_format($course['rating_count']); ?>)</span>
                    </p> -->
                    <p class="course-meta"><?= ($course['duration']) ?> total hours · <?= ($course['modules']) ?>
                        lectures · All Levels</p>
                    <p class="course-price">₦<?= number_format($course['price']) ?></p>
                </div>
            </a>
            <?php endforeach ?>


            <!-- More course items -->
        </div>


        <section id="updates" class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 update-content">
                        <h1>Experience Learning Like Never Before</h1>
                        <p>Join our virtual classes and get access to top-notch education from the comfort of your home.
                            Engage with expert instructors and collaborate with peers in real-time.</p>
                        <a href="/generate-invoice" class="btn btn-success">Join a Live Class</a>
                    </div>
                    <div class="col-lg-6 col-md-6 update-image">
                        <img src="./assets/img/liveclass.jpg" alt="Live Class Image">
                    </div>
                </div>
            </div>
        </section>


        <section id="updates" class="py-5">
            <div class="container-lg">
                <div class="row">
                    <div class="col-lg-6 col-md-6 update-image">
                        <img src="./assets/img/tutor3.jpg" alt="Live Class Image">
                    </div>
                    <div class="col-lg-6 col-md-6 update-content">
                        <h1>Become an Instructor on LearnXa</h1>
                        <p>Share your expertise and passion with a global audience. Create and deliver engaging courses,
                            grow your personal brand, and make a difference in the lives of learners worldwide.</p>
                        <a href="become-teacher" class=""
                            style="border-radius: none; background-color: black; color:white; padding: 10px; font-size: 16px">Start
                            Teaching Today</a>
                    </div>
                </div>
            </div>
        </section>







    </main>
    <?php include(APPPATH . 'Views/include/footer1.php'); ?>


    <?php include(APPPATH . 'Views/include/js.php'); ?>




</body>

</html>