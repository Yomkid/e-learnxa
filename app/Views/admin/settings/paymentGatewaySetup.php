<?php include(APPPATH .'Views/admin/include/head.php'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
<style>
    i {
        color: #007bff;
    }

    .logo-section {
        position: sticky;
        top: 0;
        z-index: 1000;
        text-align: center;
        font-weight: bolder;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-check label {
        font-weight: normal;
    }
</style>

<body>
<?php include(APPPATH . 'Views/admin/include/sidebar.php'); ?>
    <main id="main" class="main p-0">
        <?php include(APPPATH . 'Views/admin/include/nav2.php'); ?>
        <div class="container mt-2" id="mainContent">
            <div class="mb-3 font-weight-bold">Set Up Payment Gateways</div>
            <section class="payment-gateways">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- Payment gateway settings form -->
                        <form>
                            <h5 class="mb-4">PayPal Settings</h5>
                            <div class="form-group">
                                <label for="paypalClientId">PayPal Client ID</label>
                                <input type="text" class="form-control" id="paypalClientId" placeholder="Enter PayPal Client ID">
                            </div>
                            <div class="form-group">
                                <label for="paypalSecret">PayPal Secret</label>
                                <input type="text" class="form-control" id="paypalSecret" placeholder="Enter PayPal Secret">
                            </div>
                            <div class="form-group">
                                <label for="paypalMode">PayPal Mode</label>
                                <select class="form-control" id="paypalMode">
                                    <option>Sandbox</option>
                                    <option>Live</option>
                                </select>
                            </div>
                            <hr>
                            <h5 class="mb-4">Stripe Settings</h5>
                            <div class="form-group">
                                <label for="stripePublishableKey">Stripe Publishable Key</label>
                                <input type="text" class="form-control" id="stripePublishableKey" placeholder="Enter Stripe Publishable Key">
                            </div>
                            <div class="form-group">
                                <label for="stripeSecretKey">Stripe Secret Key</label>
                                <input type="text" class="form-control" id="stripeSecretKey" placeholder="Enter Stripe Secret Key">
                            </div>
                            <hr>
                            <h5 class="mb-4">PayStack Settings</h5>
                            <div class="form-group">
                                <label for="paystackPublicKey">PayStack Public Key</label>
                                <input type="text" class="form-control" id="paystackPublicKey" placeholder="Enter PayStack Public Key">
                            </div>
                            <div class="form-group">
                                <label for="paystackSecretKey">PayStack Secret Key</label>
                                <input type="text" class="form-control" id="paystackSecretKey" placeholder="Enter PayStack Secret Key">
                            </div>
                            <hr>
                            <h5 class="mb-4">Flutterwave Settings</h5>
                            <div class="form-group">
                                <label for="flutterwavePublicKey">Flutterwave Public Key</label>
                                <input type="text" class="form-control" id="flutterwavePublicKey" placeholder="Enter Flutterwave Public Key">
                            </div>
                            <div class="form-group">
                                <label for="flutterwaveSecretKey">Flutterwave Secret Key</label>
                                <input type="text" class="form-control" id="flutterwaveSecretKey" placeholder="Enter Flutterwave Secret Key">
                            </div>
                            <hr>
                            <h5 class="mb-4">Other Payment Gateway Settings</h5>
                            <div class="form-group">
                                <label for="otherGatewayName">Gateway Name</label>
                                <input type="text" class="form-control" id="otherGatewayName" placeholder="Enter Gateway Name">
                            </div>
                            <div class="form-group">
                                <label for="otherGatewayApiKey">API Key</label>
                                <input type="text" class="form-control" id="otherGatewayApiKey" placeholder="Enter API Key">
                            </div>
                            <div class="form-group">
                                <label for="otherGatewaySecretKey">Secret Key</label>
                                <input type="text" class="form-control" id="otherGatewaySecretKey" placeholder="Enter Secret Key">
                            </div>
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <?php include(APPPATH . 'Views/admin/include/js.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/script.js"></script>
</body>
</html>
