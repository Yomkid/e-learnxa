<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Cards</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/course.css">
    <link rel="stylesheet" href="/assets/css/home.css">
</head>

<body>
    <?php include(APPPATH . 'Views/include/newNav2.php'); ?>
    <section id="updates" class="py-5 bg-litght">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 update-content">
                    <h1>Do You want to teach on LearnXa and Earn?</h1>
                    <p>Welcome, this is the big opportunity for you to earn as an instructor</p>
                    <a href="#" class="btn btn-success">Contact our Support Desk</a>
                </div>
                <div class="col-lg-6 col-md-6 update-image">
                    <img src="./assets/img/liveclass.jpg" alt="Live Class Image">
                </div>
            </div>
        </div>
    </section>
    <div class="container update-content">
        <div>
            <p>Chat support Desk on WhatsApp <a href="w.me/08149594986"><button type="button" class="btn btn-primary"><i
                            class="fas fa-whatsapp"></i>Message</button></a></p>
            <p> Call only on 09147407332</p>
            <p>Send mail to learnxa@gmail.com</p>
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