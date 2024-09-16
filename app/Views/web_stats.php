<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(APPPATH . 'Views/include/head.php'); ?>

    <title>Website Statistics | KrossCheck</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <style>
        .hero-section {
            background-color: #f8f9fa;
            min-height: 100vh;
            position: relative; /* Ensure the hero section has a relative position for the overlay */
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
            text-align: left;
            margin-bottom: 20px;
        }

        .hero-content h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .hero-content p {
            font-size: 1.2rem;
            color: #6c757d;
        }

        .btn-signup {
            background-color: #007bff;
            color: #fff;
            border: none;
            font-weight: bold;
        }

        .btn-signup:hover {
            background-color: #0e4cee;
            color: #fff;
        }

        .registration-form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <?php include(APPPATH . 'Views/include/navbar.php'); ?>

    <div class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="hero-content text-center">
                        <h1>Website Statistics</h1>
                        <p>Stay updated with our latest website metrics</p>
                    </div>
                    <div class="registration-form text-center">
                        <h2>Total Members: <?= esc($member_count) ?></h2>
                        <h2>Total Visitors: <?= esc($totalVisitors) ?></h2>
                        <h3>Recent Visitors:</h3>
                        <ul class="list-group">
                            <?php if (!empty($recent_visitors)) : ?>
                                <?php foreach ($recent_visitors as $visitor): ?>
                                    <li class="list-group-item">
                                        IP: <?= esc($visitor['ip_address']) ?> - 
                                        User Agent: <?= esc($visitor['user_agent']) ?> - 
                                        Visited on <?= esc($visitor['visit_date']) ?>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="list-group-item">No recent visitors.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include(APPPATH . 'Views/include/footer.php'); ?>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

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
