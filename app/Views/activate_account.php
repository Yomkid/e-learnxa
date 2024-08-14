<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activate Account | LearnXa</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet"> -->
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/course.css">
</head>

<body>
    <?php include(APPPATH . 'Views/include/newNav2.php'); ?>


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



    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>

    </script>
</body>

</html>