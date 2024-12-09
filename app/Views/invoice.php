<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Payment Invoice | LearnXa</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/course.css">
    <link rel="stylesheet" href="/assets/css/home.css">
    <style>
        .invoice {
            max-width: 600px;
            border: solid #f2f2f2 1px;
            margin: 50px auto;
            background: white;
            /* place-items: center; */
        }

        .invoice-head-name {
            background-color: #011B33;
            color: #ffff;
            padding: 10px;
            border-radius: 10px 0px 0px 0px;
            font-weight: bold;
            font-size: 30px;
        }

        .biller-info {
            font-weight: bold;
        }
    </style>
</head>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/67236ed42480f5b4f596b0d4/1ibh6htl1';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<body>
    <div class="container invoice my-4">
        <div class="d-flex justify-content-between align-items-center mt-3">
            <a class="navbar-brand nav-logto" href="#/">Learn<span style="color: #007bff;">X</span>a</a>
            <h2 class="invoice-head-name">Invoice</h2>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div><span class="biller-info">Bill To:</span> <?= $first_name ?> <?= $last_name ?></div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div><span class="biller-info">Invoice#:</span> <?= $payment_confirmation_code ?></div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div><span class="biller-info">Email:</span> <?= $email ?></div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div><span class="biller-info">Date:</span> <?= date('M d, Y') ?></div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div><span class="biller-info">Tel:</span> <?= $phone_number ?></div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div><span class="biller-info">Address:</span> <?= $address ?></div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">Item Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">1</td>
                        <td>Registration Fee</td>
                        <td>2,000</td>
                        <td>1</td>
                        <td>2,000</td>
                    </tr>
                    <tr>
                        <td scope="row"></td>
                        <td></td>
                        <td></td>
                        <td>VAT</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td scope="row"></td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td>2,000</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <img src="./assets/img/payment-qrcode.jpg" alt="Payment QR Code" width="100px">
            </div>
            <div class="col-md-6 col-sm-6">
                <!-- <button type="submit" class="btn btn-success" onclick="payWithCard()">Pay with Card</button> -->
                <button type="submit" class="btn btn-success" onclick="payWithCard()">Click to Pay</button>
                <img src="./assets/img/paystack.webp" alt="Paystack">
            </div>
        </div>
        <p>If you experience any difficulties or issues kindly WhatsApp/Call 08149594986 or email LearnXa@gmail.com</p>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        function payWithCard() {
            var handler = PaystackPop.setup({
                key: 'pk_live_36904b6efa931af23c7e4d04a60a911d2719a194',
                email: '<?= $email ?>',
                amount: 200000, // Amount in kobo
                currency: 'NGN',
                
                ref: '<?= $payment_confirmation_code ?>',
                metadata: {
                    firstname: '<?= $first_name ?>',
                    lastname: '<?= $last_name ?>',
                    phone: '<?= $phone_number ?>',
                    state: '<?= $state ?>',
                    address: '<?= $address ?>',
                    country: '<?= $country ?>',
                },
                callback: function (response) {
                    // Payment successful, redirect to verification route
                    window.location.href = '<?= base_url('verify-payment') ?>' + '?reference=' + response.reference;
                },
                onClose: function () {
                    alert('Payment process was not completed.');
                }
            });
            handler.openIframe();
        }
    </script>
</body>
</html>
