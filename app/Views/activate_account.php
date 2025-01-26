<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(APPPATH . 'Views/include/head.php'); ?>
    <title>Activate Account | LearnXa</title>
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


    <div class="form-wrapper">
        <div class="">
            <div class="container">
                <div class="form-header mb-3 text-center p-2">
                    <h4 class="form-head-text text-light text-center">ACTIVATE YOUR ACCOUNT <i class="fas fa-key"></i>
                    </h4>
                    <p>Enter your Payment Confirmation Code to Activate your Account</p>
                </div>
                <div class="learnxa-login-container box-shadow">
                    <!-- Display success or error message -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?= base_url('activate') ?>" method="post" class="form">
                        <div class="row text-left fw-500">
                            <div class="col-md-12">
                                <input type="text" class="form-control mb-3" id="inputPcc" name="pcc"
                                    placeholder="Enter your Payment Confirmation Code Here" required>
                                <button type="submit" class="enroll-btn">Activate Account</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <p class="text-center text-light">Forgot Payment Confirmation Code? <span style="color: #007bff;"
                    class="font-weight-bold"><a href="requery.php" style="color: #007bff;">Requery</a></span></p>
        </div>
    </div>



    <?php include(APPPATH . 'Views/include/js.php'); ?>


    <script>

    </script>
</body>

</html>