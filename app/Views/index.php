<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LearnXa | Online Platform to eXplore courses, learn and Archieve Skills</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Internal links -->
    <!-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/include/styles.css">
    <link rel="stylesheet" href="/assets/css/course.css">
    <link rel="stylesheet" href="/assets/css/home.css">
</head>

<body>
    <!-- Navigation Bar -->
    <?php include(APPPATH . 'Views/include/newNav2.php'); ?>


    <!-- Hero Section -->
    <!-- Hero Section -->
    <div class="hero" style="background: url('./assets/img/hero_image.png') no-repeat center center/cover;">
        <div class="hero-content">
            <div class="container col-xxl-8 px-4 py-5">
                <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                    <div class="col-lg-5 col-10 col-sm-8">
                        <img src="./assets/img/happyman.webp" class="d-block mx-lg-auto img-fluid"
                            alt="Bootstrap Themes" width="700" height="500" loading="lazy">
                    </div>
                    <div class="col-lg-7">
                        <h1 class="display-5 fwt-bold text-body-emphasis lh-1 mb-3">eXplore, Learn and Achieve with
                            LearnXa</h1>
                        <p class="lead">Online learning and teaching marketplace with 5K+ courses & 10M students. Taught
                            by experts to help you acquire new skills. Enroll with jus ₦2,000</p>
                        <!-- <a href="login"><button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Start Learning</button></a> -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start" style="z-index: 1030;">
                            <a href="generate-invoice"><button type="button" class="btn btn-primary btn-lg px-4 me-md-2 mr-2"
                                style="border-radius:none; cursor: pointer;">Join Virtual Class</button></a>
                                <a href="/login">
                            <button type="button" class="btn btn-outline-secondary btn-lg px-4"
                                style="color:white;">Start Learning</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="brand-partners mt-4">
        <div class="container">
            <div class="brand-partners-wrapper">
                <div class="brand-partners-content">
                    <h2 class="brand-partners-content-heading">
                        We collaborates with companies and organizations
                    </h2>
                    <ul class="brand-partners-logos-list brand-partners-list">

                        <li class="brand-partners-list-item">
                            <img src="./assets/img/favicon.png" alt="learnxa-partners logo" width="48" height="48"
                                loading="lazy">
                        </li>
                        <li class="brand-partners-list-item">
                            <img src="./assets/img/favicon.png" alt="learnxa-partners logo" width="48" height="48"
                                loading="lazy">
                        </li>
                        <li class="brand-partners-list-item">
                            <img src="./assets/img/napeslogo.jpg" alt="learnxa-partners logo" width="48" height="48"
                                loading="lazy">
                        </li>
                        <li class="brand-partners-list-item">
                            <img src="./assets/img/favicon.png" alt="learnxa-partners logo" width="48" height="48"
                                loading="lazy">
                        </li>
                        <li class="brand-partners-list-item">
                            <img src="./assets/img/favicon.png" alt="learnxa-partners logo" width="48" height="48"
                                loading="lazy">
                        </li>
                        <li class="brand-partners-list-item">
                            <img src="./assets/img/favicon.png" alt="learnxa-partners logo" width="48" height="48"
                                loading="lazy">
                        </li>
                        <li class="brand-partners-list-item">
                            <img src="./assets/img/favicon.png" alt="learnxa-partners logo" width="48" height="48"
                                loading="lazy">
                        </li>
                        <li class="brand-partners-list-item">
                            <img src="./assets/img/favicon.png" alt="learnxa-partners logo" width="48" height="48"
                                loading="lazy">
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>



    <main id="#startLearning">
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
                            <button type="button" class="btn btn-custom active" data-category="data-analyst"
                                onclick="showCourses('data-analyst', this)">Data Analyst</button>
                            <button type="button" class="btn btn-custom" data-category="python"
                                onclick="showCourses('python', this)">Python</button>
                            <button type="button" class="btn btn-custom" data-category="web-development"
                                onclick="showCourses('web-development', this)">Web Development</button>
                            <button type="button" class="btn btn-custom" data-category="past-question"
                                onclick="showCourses('past-question', this)">Past Question</button>
                            <button type="button" class="btn btn-custom" data-category="advertisement"
                                onclick="showCourses('advertisement', this)">Advertisement</button>
                            <button type="button" class="btn btn-custom" data-category="career-courses"
                                onclick="showCourses('career-courses', this)">Career Courses</button>
                            <button type="button" class="btn btn-custom" data-category="skills"
                                onclick="showCourses('skills', this)">Skills</button>
                            <button type="button" class="btn btn-custom" data-category="technology"
                                onclick="showCourses('technology', this)">Technology</button>
                        </div>
                    </div>
                    <button class="scroll-button d-flex" onclick="scrollButtons(200)"><i
                            class="fas fa-angle-right"></i></button>
                    <!-- <button class="scroll-button d-flex" onclick="scrollButtons(200)"><i class="fas fa-chevron-circle-right"></i></button> -->
                </div>
                <hr class="mt-0">
                <div class="category-header" id="categoryHeader">
                    <!-- Category title and description will be displayed here -->
                </div>
                <div class="courses-container" id="coursesContainer">
                    <!-- Courses will be displayed here -->
                </div>
            </div>
        </div>


        <script>
            const categories = {
                'data-analyst': {
                    title: 'Data Analyst',
                    description: 'Collect, organize, and transform data to make informed decisions',
                    courses: [{
                            title: 'Introduction to Data Analysis',
                            image: './assets/img/py4web.jpg',
                            rating: 4.5,
                            reviews: 1234,
                            instructor: 'Mayomi Peter',
                            price: '₦41,900'
                        },
                        {
                            title: 'Introduction to Data Analysis',
                            image: './assets/img/py4web.jpg',
                            rating: 4.5,
                            reviews: 1234,
                            instructor: 'Mayomi Peter',
                            price: '₦41,900'
                        },
                        {
                            title: 'Introduction to Data Analysis',
                            image: './assets/img/py4web.jpg',
                            rating: 4.5,
                            reviews: 1234,
                            instructor: 'Mayomi Peter',
                            price: '₦41,900'
                        },
                        {
                            title: 'Introduction to Data Analysis',
                            image: './assets/img/py4web.jpg',
                            rating: 4.5,
                            reviews: 1234,
                            instructor: 'Mayomi Peter',
                            price: '₦41,900'
                        },
                        {
                            title: 'Introduction to Data Analysis',
                            image: './assets/img/py4web.jpg',
                            rating: 4.5,
                            reviews: 1234,
                            instructor: 'Mayomi Peter',
                            price: '₦41,900'
                        },
                        // More courses...
                    ]
                },
                'python': {
                    title: 'Python',
                    description: 'Learn Python programming from basics to advanced topics',
                    courses: [{
                            title: 'Python for Beginners',
                            image: './assets/img/python.jpeg',
                            rating: 4.7,
                            reviews: 987,
                            instructor: 'Jane Doe',
                            price: '₦35,000'
                        },
                        // More courses...
                    ]
                },
                'web-development': {
                    title: 'Web Development',
                    description: 'Become a web developer by learning HTML, CSS, JavaScript, and more',
                    courses: [{
                            title: 'React - The Complete Guide 2024 (incl. Next.js, Redux)',
                            image: './assets/img/web_dev.jpeg',
                            rating: 4.5,
                            reviews: 1234,
                            instructor: 'John Smith',
                            price: '₦41,900'
                        },
                        // More courses...
                    ]
                },
                'past-question': {
                    title: 'Past Question',
                    description: 'Access past exam questions for effective preparation',
                    courses: [{
                            title: 'Past Question Paper 1',
                            image: './assets/img/past_question.jpeg',
                            rating: 4.2,
                            reviews: 543,
                            instructor: 'Alice Brown',
                            price: '₦20,000'
                        },
                        // More courses...
                    ]
                },
                'advertisement': {
                    title: 'Advertisement',
                    description: 'Master the art of digital marketing and advertising',
                    courses: [{
                            title: 'Introduction to Digital Marketing',
                            image: './assets/img/advertisement.jpeg',
                            rating: 4.8,
                            reviews: 890,
                            instructor: 'Mark Lee',
                            price: '₦50,000'
                        },
                        // More courses...
                    ]
                },
                'career-courses': {
                    title: 'Career Courses',
                    description: 'Enhance your career with specialized courses and certifications',
                    courses: [{
                            title: 'Resume Writing',
                            image: './assets/img/career_courses.jpeg',
                            rating: 4.6,
                            reviews: 654,
                            instructor: 'Chris Green',
                            price: '₦30,000'
                        },
                        // More courses...
                    ]
                },
                'skills': {
                    title: 'Skills',
                    description: 'Develop essential skills for personal and professional growth',
                    courses: [{
                            title: 'Time Management',
                            image: './assets/img/skills.jpeg',
                            rating: 4.4,
                            reviews: 234,
                            instructor: 'Linda White',
                            price: '₦25,000'
                        },
                        // More courses...
                    ]
                },
                'technology': {
                    title: 'Technology',
                    description: 'Stay ahead with the latest technology trends and skills',
                    courses: [{
                            title: 'Introduction to AI',
                            image: './assets/img/technology.jpeg',
                            rating: 4.9,
                            reviews: 1456,
                            instructor: 'David Black',
                            price: '₦60,000'
                        },
                        // More courses...
                    ]
                }
            };

            function showCourses(category, element) {
                const coursesContainer = document.getElementById('coursesContainer');
                const categoryHeader = document.getElementById('categoryHeader');
                coursesContainer.innerHTML = '';

                // Remove active class from all buttons
                const buttons = document.querySelectorAll('.btn-custom');
                buttons.forEach(btn => btn.classList.remove('active'));

                // Add active class to the clicked button
                element.classList.add('active');

                // Display category title and description
                if (categories[category]) {
                    categoryHeader.innerHTML = `<h2>${categories[category].title}</h2>
                                            <p>${categories[category].description}</p>`;

                    categories[category].courses.forEach(course => {
                        const card = document.createElement('div');
                        card.className = 'course-card-homepage';

                        const img = document.createElement('img');
                        img.src = course.image;
                        img.alt = 'Course Image';
                        card.appendChild(img);

                        const cardBody = document.createElement('div');
                        cardBody.className = 'card-body';

                        const title = document.createElement('h4');
                        title.className = 'card-title';
                        title.textContent = course.title;
                        cardBody.appendChild(title);

                        const ratingContainer = document.createElement('div');
                        ratingContainer.className = 'course-rating';

                        const rating = document.createElement('span');
                        rating.className = 'rating';
                        rating.textContent = course.rating;
                        ratingContainer.appendChild(rating);

                        const ratingStars = document.createElement('span');
                        ratingStars.className = 'rating-stars';
                        for (let i = 0; i < 5; i++) {
                            const star = document.createElement('i');
                            star.className = i < Math.floor(course.rating) ? 'fa fa-star' :
                                'fa fa-star-half-alt';
                            ratingStars.appendChild(star);
                        }
                        ratingContainer.appendChild(ratingStars);

                        const ratingCount = document.createElement('span');
                        ratingCount.className = 'rating-count';
                        ratingCount.textContent = `(${course.reviews})`;
                        ratingContainer.appendChild(ratingCount);

                        cardBody.appendChild(ratingContainer);

                        const instructor = document.createElement('div');
                        instructor.className = 'course-instructor';
                        instructor.textContent = course.instructor;
                        cardBody.appendChild(instructor);

                        const price = document.createElement('div');
                        price.className = 'course-price';
                        price.textContent = course.price;
                        cardBody.appendChild(price);

                        card.appendChild(cardBody);

                        coursesContainer.appendChild(card);
                    });
                } else {
                    categoryHeader.innerHTML = '';
                    coursesContainer.textContent = 'No courses available for this category.';
                }
            }



            // Initially show courses for the active category
            const activeButton = document.querySelector('.btn-custom.active');
            const activeCategory = activeButton.dataset.category;
            showCourses(activeCategory, activeButton);



            //  function scrollButtons(distance) {
            //                 const container = document.querySelector('.button-container .d-flex');
            //                 container.scrollBy({
            //                     left: distance,
            //                     behavior: 'smooth'
            //                 });
            //             }

            document.addEventListener("DOMContentLoaded", function () {
                const activeButton = document.querySelector('.btn-custom.active');
                const activeCategory = activeButton.getAttribute('data-category');
                showCourses(activeCategory, activeButton);

                const slider = document.getElementById('buttonScrollContainer');

                // Drag to scroll functionality
                let isDown = false;
                let startX;
                let scrollLeft;

                slider.addEventListener('mousedown', (e) => {
                    isDown = true;
                    startX = e.pageX - slider.offsetLeft;
                    scrollLeft = slider.scrollLeft;
                    slider.style.cursor = 'grabbing';
                    e.preventDefault(); // Prevent default behavior
                });

                slider.addEventListener('mouseleave', () => {
                    isDown = false;
                    slider.style.cursor = 'grab';
                });

                slider.addEventListener('mouseup', () => {
                    isDown = false;
                    slider.style.cursor = 'grab';
                });

                slider.addEventListener('mousemove', (e) => {
                    if (!isDown) return;
                    e.preventDefault(); // Prevent default behavior
                    const x = e.pageX - slider.offsetLeft;
                    const walk = (x - startX) * 2; // Adjust scrolling speed
                    slider.scrollLeft = scrollLeft - walk;
                });
            });

            function scrollButtons(distance) {
                const container = document.querySelector('.button-container .button-flex');
                container.scrollBy({
                    left: distance,
                    behavior: 'smooth'
                });
            }




            // Below scripts commented can still be used 


            // function scrollButtons(distance) {
            //     const container = document.querySelector('.button-container .d-flex');
            //     container.scrollBy({
            //         left: distance,
            //         behavior: 'smooth'
            //     });
            // }
            // const courses = {
            //     'data-analyst': [{
            //             title: 'Introduction to Data Analysis',
            //             image: './assets/img/web_dev.jpeg',
            //             rating: 4.5,
            //             reviews: 1234,
            //             instructor: 'Mayomi Peter',
            //             price: '₦41,900'
            //         },
            //         {
            //             title: 'Introduction to Data Analysis',
            //             image: './assets/img/py4web.jpg',
            //             rating: 4.5,
            //             reviews: 1234,
            //             instructor: 'Mayomi Peter',
            //             price: '₦41,900'
            //         },
            //         {
            //             title: 'Introduction to Data Analysis',
            //             image: './assets/img/math.jpg',
            //             rating: 4.5,
            //             reviews: 1234,
            //             instructor: 'Mayomi Peter',
            //             price: '₦41,900'
            //         },
            //         {
            //             title: 'Introduction to Data Analysis',
            //             image: './assets/img/c++.jpg',
            //             rating: 4.5,
            //             reviews: 1234,
            //             instructor: 'Mayomi Peter',
            //             price: '₦41,900'
            //         },
            //         {
            //             title: 'Introduction to Data Analysis',
            //             image: './assets/img/py4web.jpg',
            //             rating: 4.5,
            //             reviews: 1234,
            //             instructor: 'Mayomi Peter',
            //             price: '₦41,900'
            //         },
            //         // More courses...
            //     ],
            //     'python': [{
            //             title: 'Python for Beginners',
            //             image: './assets/img/py4web.jpg',
            //             rating: 4.7,
            //             reviews: 987,
            //             instructor: 'Jane Doe',
            //             price: '₦35,000'
            //         },
            //         {
            //             title: 'Python for Beginners',
            //             image: './assets/img/py4web.jpg',
            //             rating: 4.7,
            //             reviews: 987,
            //             instructor: 'Jane Doe',
            //             price: '₦35,000'
            //         },
            //         {
            //             title: 'Python for Beginners',
            //             image: './assets/img/py4web.jpg',
            //             rating: 4.7,
            //             reviews: 987,
            //             instructor: 'Jane Doe',
            //             price: '₦35,000'
            //         },
            //         // More courses...
            //     ],
            //     'web-development': [{
            //             title: 'React - The Complete Guide 2024 (incl. Next.js, Redux)',
            //             image: './assets/img/web_dev.jpeg',
            //             rating: 4.5,
            //             reviews: 1234,
            //             instructor: 'John Smith',
            //             price: '₦41,900'
            //         },
            //         // More courses...
            //     ],
            //     'past-question': [{
            //             title: 'Past Question Paper 1',
            //             image: './assets/img/past_question.jpeg',
            //             rating: 4.2,
            //             reviews: 543,
            //             instructor: 'Alice Brown',
            //             price: '₦20,000'
            //         },
            //         // More courses...
            //     ],
            //     'advertisement': [{
            //             title: 'Introduction to Digital Marketing',
            //             image: './assets/img/advertisement.jpeg',
            //             rating: 4.8,
            //             reviews: 890,
            //             instructor: 'Mark Lee',
            //             price: '₦50,000'
            //         },
            //         // More courses...
            //     ],
            //     'career-courses': [{
            //             title: 'Resume Writing',
            //             image: './assets/img/career_courses.jpeg',
            //             rating: 4.6,
            //             reviews: 654,
            //             instructor: 'Chris Green',
            //             price: '₦30,000'
            //         },
            //         // More courses...
            //     ],
            //     'skills': [{
            //             title: 'Time Management',
            //             image: './assets/img/skills.jpeg',
            //             rating: 4.4,
            //             reviews: 234,
            //             instructor: 'Linda White',
            //             price: '₦25,000'
            //         },
            //         // More courses...
            //     ],
            //     'technology': [{
            //             title: 'Introduction to AI',
            //             image: './assets/img/technology.jpeg',
            //             rating: 4.9,
            //             reviews: 1456,
            //             instructor: 'David Black',
            //             price: '₦60,000'
            //         },
            //         // More courses...
            //     ]
            // };

            // function showCourses(category, element) {
            //     const coursesContainer = document.getElementById('coursesContainer');
            //     coursesContainer.innerHTML = '';

            //     // Remove active class from all buttons
            //     const buttons = document.querySelectorAll('.btn-custom');
            //     buttons.forEach(btn => btn.classList.remove('active'));

            //     // Add active class to the clicked button
            //     element.classList.add('active');

            //     if (courses[category]) {
            //         courses[category].forEach(course => {
            //             const card = document.createElement('div');
            //             card.className = 'course-card-homepage';

            //             const img = document.createElement('img');
            //             img.src = course.image;
            //             img.alt = 'Course Image';
            //             card.appendChild(img);

            //             const cardBody = document.createElement('div');
            //             cardBody.className = 'card-body';

            //             const title = document.createElement('h4');
            //             title.className = 'card-title';
            //             title.textContent = course.title;
            //             cardBody.appendChild(title);

            //             const ratingContainer = document.createElement('div');
            //             ratingContainer.className = 'course-rating';

            //             const rating = document.createElement('span');
            //             rating.className = 'rating';
            //             rating.textContent = course.rating;
            //             ratingContainer.appendChild(rating);

            //             const ratingStars = document.createElement('span');
            //             ratingStars.className = 'rating-stars';
            //             for (let i = 0; i < 5; i++) {
            //                 const star = document.createElement('i');
            //                 star.className = i < Math.floor(course.rating) ? 'fa fa-star' :
            //                     'fa fa-star-half-alt';
            //                 ratingStars.appendChild(star);
            //             }
            //             ratingContainer.appendChild(ratingStars);

            //             const ratingCount = document.createElement('span');
            //             ratingCount.className = 'rating-count';
            //             ratingCount.textContent = `(${course.reviews})`;
            //             ratingContainer.appendChild(ratingCount);

            //             cardBody.appendChild(ratingContainer);

            //             const instructor = document.createElement('div');
            //             instructor.className = 'course-instructor';
            //             instructor.textContent = course.instructor;
            //             cardBody.appendChild(instructor);

            //             const price = document.createElement('div');
            //             price.className = 'course-price';
            //             price.textContent = course.price;
            //             cardBody.appendChild(price);

            //             card.appendChild(cardBody);

            //             coursesContainer.appendChild(card);
            //         });
            //     } else {
            //         coursesContainer.textContent = 'No courses available for this category.';
            //     }
            // }

            // // Initially show courses for the active category
            // // document.addEventListener("DOMContentLoaded", function() {
            // //     const activeButton = document.querySelector('.btn-custom.active');
            // //     const activeCategory = activeButton.getAttribute('data-category');
            // //     showCourses(activeCategory, activeButton);
            // // });
            // // Initially show courses for the active category
            // const activeButton = document.querySelector('.btn-custom.active');
            // const activeCategory = activeButton.dataset.category;
            // showCourses(activeCategory, activeButton);
        </script>
        </div>
        <!-- Popular Course Section -->
        <div class="container mt-0">
            <div class="d-flex justify-content-between heading mt-4">
                <a class="navbar-brand nav-logo" href="#">Learn<span style="color: #007bff;">X</span>a</a>
                <h2 class="course-category">Popular Courses</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="course-description">
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
                    <a href="course-description">
                        <div class="course-card">
                            <img src="./assets/img/datasci-topic-img.jpg" alt="Course Image" />
                            <div class="card-body">
                                <h4 class="card-title">Data Science Roadmap - A Complete Course Using Python and Excel
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
                                <div class="course-price">₦43,900</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="course-description">
                        <div class="course-card">
                            <img src="./assets/img/webdev-topic-img.jpg" alt="Course Image" />
                            <div class="card-body">
                                <h4 class="card-title">Fullstack Web Development using CodeIgniter (Build 4 Giants
                                    Projects)
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
                    <a href="course-description">
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
                <a href="courses"><button type="button" class="btn btn-outline-secondary btn-lg px-4"
                        style="color:black;">Show
                        more</button></a>
            </div>

        </div>
        <!-- Vitual Class Section -->
        <div class="container mt-0 mb-0">
            <div class="d-flex justify-content-between heading mt-4">
                <a class="navbar-brand nav-logo" href="#">Learn<span style="color: #007bff;">X</span>a</a>
                <h2 class="course-category">Live Class Courses [Apprentiship Courses]</h2>
            </div>
            <p>With these programs, you cand subsribed to build valuable skills, earn career credentials, when you
                enroll for the virtual class.</p>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="course-description">
                        <div class="course-card">
                            <img src="./assets/img/dbms-topic-img.png" alt="Course Image" />
                            <div class="card-body">
                                <h4 class="card-title">DataBase Management System using SQL, MS-Access, MongoDB and
                                    MySQL
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
                    <a href="course-description">
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
                    <a href="course-description">
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
                    <a href="course-description">
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
            <a href="virtual-class-courses"><button type="button" class="btn btn-outline-secondary btn-lg px-4"
                    style="color:black;">Explore &
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
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="category">
                        <div class="category-card">
                            <div class="card-body">
                                <i class="fas fa-briefcase card-icon"></i>
                                <h5 class="card-title">Business & Management</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="category">
                        <div class="category-card">
                            <div class="card-body">
                                <i class="fas fa-robot card-icon"></i>
                                <h5 class="card-title">Embedded System and Robotics</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="category">
                        <div class="category-card">
                            <div class="card-body">
                                <i class="fas fa-laptop-code card-icon"></i>
                                <h5 class="card-title">IT & Software</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="category">
                        <div class="category-card">
                            <div class="card-body">
                                <i class="fas fa-chalkboard-teacher card-icon"></i>
                                <h5 class="card-title">Teaching & Academic</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="category">
                        <div class="category-card">
                            <div class="card-body">
                                <i class="fas fa-briefcase card-icon"></i>
                                <h5 class="card-title">Business & Management</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="category">
                        <div class="category-card">
                            <div class="card-body">
                                <i class="fas fa-robot card-icon"></i>
                                <h5 class="card-title">Embedded System and Robotics</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="category">
                        <div class="category-card">
                            <div class="card-body">
                                <i class="fas fa-laptop-code card-icon"></i>
                                <h5 class="card-title">IT & Software</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="category">
                        <div class="category-card">
                            <div class="card-body">
                                <i class="fas fa-chalkboard-teacher card-icon"></i>
                                <h5 class="card-title">Teaching & Academic</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <hr>



        <section id="updates" class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 update-content">
                        <h1>Experience Learning Like Never Before</h1>
                        <p>Join our virtual classes and get access to top-notch education from the comfort of your home.
                            Engage with expert instructors and collaborate with peers in real-time.</p>
                        <a href="virtual-class-courses" class="btn btn-success">Join a Live Class</a>
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
                        <a href="become-teacher-on-learnxa" class=""
                            style="border-radius: none; background-color: black; color:white; padding: 10px; font-size: 16px">Start
                            Teaching Today</a>
                    </div>
                </div>
            </div>
        </section>







    </main>
    <?php include(APPPATH . 'Views/include/footer1.php'); ?>



    <script>

    </script>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Custom JS -->
    <script src="scripts.js"></script>
</body>

</html>