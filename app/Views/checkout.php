<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | LearnXa</title>
    <?php include(APPPATH . 'Views/include/head.php'); ?>
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

    <div class="row">
        <div class="col-lg-7 col-md-6 ">
            <div class="container course-description">
                <div class="course-details">
                    <h1>Checkout</h1>
                    <div class="order-details mt-3">
                        <h4>Order Details</h4>
                        <div class="d-flex justify-content-between">
                            <div class="order-details-img d-flex">
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
    <p>You can pay with Paystack or Flutterwave</p>
    <div class="payment-method">
        <input type="radio" id="paystack" name="paymentMethod" value="paystack" checked>
        <label for="paystack"><img src="./assets/img/paystack-ii.webp" alt="Paystack"></label>
        
        <input type="radio" id="flutterwave" name="paymentMethod" value="flutterwave">
        <label for="flutterwave"><img src="./assets/img/flutterwave-logo.png" alt="Flutterwave"></label>
        <!-- <input type="radio" id="flutterwave" name="paymentMethod" value="flutterwave" disabled>
    <label for="flutterwave"><img src="./assets/img/flutterwave-logo.png" alt="Flutterwave"></label> -->
    </div>
</div>


                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-6 order-summary">
            <div class="container course-description">
                
                <div class="order-box">
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
                                <?php $session = session(); ?>
            <?php if ($session->get('isLoggedIn')) : ?>
                        <button id="proceedToPayBtn" class="enroll-btn" onclick="payWithPaystack()">Proceed to Pay with Paystack</button>
                        <button class="fixed-bottom enroll-btn d-block d-md-none">Proceed to Pay ₦<?= number_format($coursePrice) ?></button>
                        <?php else : ?>
                            <a href="<?= base_url('login?redirect=' . current_url()); ?>" ><button class="btn btn-outline-blue enroll-btn"><i class="fas fa-user"></i> Login before Enrollment</button></a>

            <?php endif; ?>                        <p class="mt-5" style="font-size:12px">If you encountered any issue during the payment, kindly contact the Technical Support Desk. <br><strong>Tel:</strong> 08149594986 <br> <strong>Email:</strong> support@learnxa.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include(APPPATH . 'Views/include/footer1.php'); ?>

    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>

    <?php include(APPPATH . 'Views/include/js.php'); ?>


    <script>
        // Function to handle Paystack payment
        function payWithPaystack() {
            var handler = PaystackPop.setup({
                key: 'pk_live_36904b6efa931af23c7e4d04a60a911d2719a194', // Replace with your Paystack public key
                email: '<?= session()->get('email'); ?>', // Replace with user's email
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

        // Function to handle Flutterwave payment
        function payWithFlutterwave() {
            FlutterwaveCheckout({
                public_key: "FLWPUBK_TEST-8474764d531821c26fefd75c7730dcbd-X",
                tx_ref: "<?= uniqid('trx_'); ?>",
                amount: <?= session()->get('course_data')['price'] ?>,
                currency: "NGN",
                payment_options: "card, mobilemoney, ussd",
                meta: {
                    consumer_id: '<?= $courseId ?>'
                },
                customer: {
                    email: '<?= session()->get('email'); ?>',
                },
                onclose: function() {
                    alert('Payment process was not completed.');
                },
                callback: function (data) {
                    const reference = data.tx_ref;

                    // Check if the reference is valid
                    if (reference) {
                        // Redirect to your verification route with the reference
                        window.location.href = '<?= base_url('verifyCourseEnrollmentPaymentWithFlutter') ?>' + '?reference=' + reference;
                    } else {
                        alert('No payment reference found. Please try again.');
                    }
                }
            });
        }



        $(document).ready(function() {
    // Define the primary colors for each payment method
    const primaryColors = {
        paystack: '#3DC1FF', // Paystack's primary color
        flutterwave: '#FF5E00' // Flutterwave's primary color
    };

    // Function to update the button based on the selected payment method
    function updateButton(selectedPayment) {
    const proceedToPayBtn = $('#proceedToPayBtn');
    const mobilePayBtn = $('.fixed-bottom.enroll-btn.d-block.d-md-none');
    
    if (selectedPayment === 'paystack') {
        proceedToPayBtn.text('Proceed to Pay with Paystack');
        proceedToPayBtn.attr('onclick', 'payWithPaystack()');
        proceedToPayBtn.css('background-color', primaryColors.paystack);
        
        mobilePayBtn.text('Proceed to Pay ₦<?= number_format($coursePrice) ?> with Paystack');
        mobilePayBtn.attr('onclick', 'payWithPaystack()');
        mobilePayBtn.css('background-color', primaryColors.paystack);
    } else if (selectedPayment === 'flutterwave') {
        // Add a fallback message or make the button inactive if Flutterwave is selected
        proceedToPayBtn.text('Flutterwave payment option is currently unavailable');
        proceedToPayBtn.attr('onclick', '');
        proceedToPayBtn.css('background-color', '#ccc');  // Optional: gray out the button
    }
}


    // Event listener for changing the payment method
    $('input[name="paymentMethod"]').on('change', function() {
        const selectedPayment = $(this).val();
        updateButton(selectedPayment);
    });

    // Initialize with the default selected payment method
    updateButton($('input[name="paymentMethod"]:checked').val());
});




        // Switch payment method
        // $('input[name="paymentMethod"]').on('change', function() {
        //     const selectedPayment = $(this).val();
        //     const proceedToPayBtn = $('#proceedToPayBtn');

        //     if (selectedPayment === 'paystack') {
        //         proceedToPayBtn.text('Proceed to Pay with Paystack');
        //         proceedToPayBtn.attr('onclick', 'payWithPaystack()');
        //     } else if (selectedPayment === 'flutterwave') {
        //         proceedToPayBtn.text('Proceed to Pay with Flutterwave');
        //         proceedToPayBtn.style('background-color:orange');
        //         proceedToPayBtn.attr('onclick', 'payWithFlutterwave()');
        //     }
        // });
    </script>
</body>

</html>
