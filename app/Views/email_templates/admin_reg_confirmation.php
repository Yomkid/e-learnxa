<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful | LearnXa</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/course.css">
    <link rel="stylesheet" href="/assets/css/home.css">
    <style>
        .success-page {
            max-width: 600px;
            border: solid #f2f2f2 1px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            text-align: left;
        }

        .success-header {
            background-color: #007bff;
            /* background-color: #28a745; */
            color: #fff;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            font-weight: bold;
            font-size: 24px;
            text-align: center;
        }

        .success-content {
            padding: 20px;
        }

        .success-content .biller-info {
            font-weight: bold;
        }

        .success-footer {
            margin-top: 20px;
        }

        .navbar-brand {
            font-size: 30px;
            font-weight: 700;
            color: black !important;
            text-decoration: none !important;
        }

        .navbar-brand {
            display: inline-block;
            padding-top: .3125rem;
            padding-bottom: .3125rem;
            margin-right: 1rem;
            font-size: 1.25rem;
            line-height: inherit;
            white-space: nowrap;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container success-page">
        <a class="navbar-brand nav-logto text-dark" href="https://learnxa.com">Learn<span
                style="color: #007bff;">X</span>a</a>

        <div class="success-header">
            <i class="fas fa-check-circle"></i> Payment Successful
        </div>
        <div class="success-content">
            <p>Dear <?= $first_name ?> <?= $last_name ?>,</p>
            <p>Your Registration as a <?= $role_name; ?> has been successful. Your account will be acitvated after some
                minutes</p>

            <div class="col-md-6 col-sm-6">
                <div><span class="biller-info">Registration Number:
                        <strong><?= $registration_number ?></strong>.</div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div><span class="biller-info">Email:</span> <?= $email ?></div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div><span class="biller-info">Phone Number:</span> <?= $phone_number ?></div>
            </div>

            <p>Thank you for registering with us</p>
            <p>Happy Learning!</p>
            <a href="<?= base_url('activate') ?>" class="btn btn-primary">Activate your Account</a>


            <p>Best regards,</p>
            <p>LearnXa Team</p>
        </div>
        <div class='footer'>
            <p>If you have any questions, please contact us at <a href="mailto:LearnXa@gmail.com">LearnXa@gmail.com</a>
                or call 08149594986.</p>
            <hr>
            <p>&copy; <?= date('Y'); ?> LearnXa. All rights reserved.</p>
        </div>


    </div>
    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>