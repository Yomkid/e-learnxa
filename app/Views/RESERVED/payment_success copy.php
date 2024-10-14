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
            text-align: center;
        }

        .success-header {
            background-color: #28a745;
            color: #fff;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            font-weight: bold;
            font-size: 24px;
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
    </style>
</head>

<body>
    <div class="container success-page my-4">
        <div class="success-header">
            <i class="fas fa-check-circle"></i> Payment Successful
        </div>
        <div class="success-content">
            <p>Thank you for your payment, <?= $first_name ?> <?= $last_name ?>.</p>
            <p>Your Payment Confirmation Code (PCC) is <strong><?= $payment_confirmation_code ?></strong>.</p>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div><span class="biller-info">Email:</span> <?= $email ?></div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div><span class="biller-info">Phone Number:</span> <?= $phone_number ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                </div>
                <div class="col-md-6 col-sm-6">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                </div>
            </div>
        </div>
        <div class="success-footer">
            <p>If you have any questions, please contact us at <a href="mailto:LearnXa@gmail.com">LearnXa@gmail.com</a> or call 08149594986.</p>
            <a href="<?= base_url('activate') ?>" class="btn btn-primary">Activate your Account</a>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
