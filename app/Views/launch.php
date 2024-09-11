<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(APPPATH . 'Views/include/head.php'); ?>

    <title>Launching Soon | LearnXa</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <style>
        body.dark-mode .hero-section {
            background-color: #1e1e1e !important;
            background-image: none;
        }

        .hero-section {
            position: relative;
            background-image: url('assets/img/hero_image.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 60px 0;
            min-height: 100vh;
            z-index: 1;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(248, 249, 250, 0.9);
            z-index: -1;
        }

        .hero-content {
            text-align: center;
            color: #333;
        }

        .hero-content h1 {
            font-size: 2rem;
            font-weight: bold;
        }

        .hero-content p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 30px;
        }

        .countdown {
            font-size: 2rem;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
        }

        .btn-notify {
            background-color: #007bff;
            color: #fff;
            border: none;
            font-weight: bold;
        }

        .btn-notify:hover {
            background-color: #0e4cee;
            color: #fff;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .social-icons {
            margin-top: 30px;
        }

        .social-icons img {
            width: 40px;
            margin: 0 15px;
            cursor: pointer;
        }

        .input-group .form-control,
        .input-group .btn-notify {
            height: auto;
            padding: 10px 15px;
            font-size: 1rem;
            border-radius: 0;
        }

        .input-group .btn-notify {
            line-height: 1.5;
        }
    </style>
</head>

<body>

    <div class="hero-section">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8 hero-content">

                    <!-- LearnXa Logo -->
                    <div class="logo">
                        <a class="navbar-brand text-center text-dark" href="/"
                            style="font-weight: 800; font-size:36px;">
                            Learn<span style="color: #007bff;">X</span>a
                        </a>
                    </div>

                    <!-- Launch Message -->
                    <h1>Our New Learning Platform is Launching Soon!</h1>
                    <p>Get ready for something amazing. We're creating a better learning experience for you on <b>October 1st, 2024!</b></p>

                    <!-- Countdown Timer -->
                    <div class="countdown" id="countdownTimer">00:00:00:00</div>

                    <!-- Notify Me Form -->
                    <form id="notifyForm" method="post" action="<?= base_url("notify-me"); ?>">
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Enter your email"
                                required>
                            <div class="input-group-append">
                                <button class="btn btn-notify" type="submit">Notify Me &rarr;</button>
                            </div>
                        </div>
                    </form>


                    <!-- Discount Information -->
                    <p class="mt-2">LearnXa offers a wide variety of courses designed to help you grow. Subscribe now
                        and get <span style="color: #d9534f; font-weight: bold;">50% off</span> when we launch!</p>

                    <!-- Social Media Icons -->
                    <!-- <p>Join Now!</p> -->
                    <div class="social-icons">
                        <a href="https://chat.whatsapp.com/FXCKGQOTJoa6SOepto75t6" target="_blank">
                            <i class="fab fa-whatsapp" style="font-size: 40px; margin: 0 15px;"></i>
                        </a>
                        <a href="https://t.me/learnxa" target="_blank">
                            <i class="fab fa-telegram" style="font-size: 40px; margin: 0 15px;"></i>
                        </a>
                        <a href="https://x.com/LearnXa" target="_blank">
                            <i class="fab fa-twitter" style="font-size: 40px; margin: 0 15px;"></i>
                        </a>
                    </div>
                    <a href="https://learnxa.com">learnxa.com</a>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Countdown Timer Script -->
    <script>
        var launchDate = new Date("Oct 1, 2024 12:00:00").getTime();

        var countdownFunction = setInterval(function () {
            var now = new Date().getTime();
            var distance = launchDate - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("countdownTimer").innerHTML = days + "d " + hours + "h " + minutes + "m " +
                seconds + "s ";

            if (distance < 0) {
                clearInterval(countdownFunction);
                document.getElementById("countdownTimer").innerHTML = "We Are Live!";
            }
        }, 1000);

        document.getElementById('notifyForm').addEventListener('submit', function (e) {
            e.preventDefault();

            var form = this;
            var formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again later.');
                });
        });
    </script>
</body>

</html>