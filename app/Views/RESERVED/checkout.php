<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Description</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet"> -->
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/assets/css/course.css">
    <link rel="stylesheet" href="/assets/css/home.css">
    <style>

    </style>
</head>

<body>
<?php include(APPPATH . 'Views/include/newNav2.php'); ?>

    <div class="row">
        <div class="col-lg-7 col-md-6 pt-4">
            <div class="container course-descrtiption">
                <div class="course-details ">
                    <h1>Checkout</h1>
                    <div class="order-details mt-3">
                        <h4>Order Details</h4>
                        <div class="d-flex justify-content-between">
                            <div class="order-details-img d-flex">
                                <!-- <img src="./assets/img/py4web.jpg" alt="Course Image" /> -->
                                <img src="<?= base_url('uploads/' . $courseImage) ?>" alt="Course Image" />
                                <div class="checkout-course-title mx-2">
                                    <p><strong><?= $courseTitle ?></strong></p>
                                    <div class="checkout-course-price">
                                        <p>₦<?= number_format($coursePrice) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="payment-method-container border p-3 my-4">
                        <h2>Payment Method</h2>
                        <div class="payment-method">
                            <img src="./assets/img/paystack-ii.webp" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-6 order-summary">
            <div class="container course-descrtiption">
                
                <div class="order-box pt-5">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                    <?php endif; ?>
                    <h4>Order Summary</h4>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <p>Cost Price</p>
                            <p>₦<?= number_format($coursePrice) ?></p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p>VAT</p>
                            <p>0</p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <p><strong>Total</strong></p>
                            <p><strong>₦<?= number_format($coursePrice) ?></strong></p>
                        </div>
                        <p>By proceeding to make payment you agree to these <span style="color: #007bff;">Terms of
                                Service.</span></p>
                        <button class="enroll-btn" onclick="payWithCard()">Proceed to Pay</button>
                        <button class="fixed-bottom enroll-btn d-block d-md-none">Proceed to Pay ₦<?= number_format($coursePrice) ?></button>
                        <p class="mt-5" style="font-size:12px">If you encountered any issue during the payment, kindly contact the Technical Support Desk. <br><strong>Tel:</strong> 08149594986 <br> <strong>Email:</strong> support@learnxa.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include(APPPATH . 'Views/include/footer1.php'); ?>


    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>

    <script>
        function payWithCard() {
            var handler = PaystackPop.setup({
                key: 'pk_test_18bd358872baeae63db2133cc291cd2e92df0015', // Replace with your Paystack public key
                // email: '< session()->get('user_email'); ?>', // Replace with user's email
                email: 'odewayemayomi@gmail.com', // Replace with user's email
                amount: <?= session()->get('course_data')['price'] * 100; ?>, // Amount in kobo
                currency: 'NGN',
                ref: '<?= uniqid('trx_'); ?>', // Generate a unique transaction reference
                metadata: {
                    
                    courseId: '<?= $courseId ?>'
                },
                callback: function(response) {
                    // Payment successful, redirect to verification route
                    window.location.href = '<?= base_url('verifyCourseEnrollmentPayment') ?>' + '?reference=' + response.reference;
                },
                onClose: function() {
                    alert('Payment process was not completed.');
                }
            });
            handler.openIframe();
        }

    </script>
</body>

</html>