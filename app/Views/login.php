<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | LearnXa</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet"> -->
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/packages/bootstrap/bootstrap.main.min.css">
    <link rel="stylesheet" href="/assets/css/course.css">
</head>

<body>
    <?php //include "./include/newNav2.php"; ?>


    <div class="form-wrapper">
        <div class="">
            <div class="container">
                <div class="form-header mb-3 d-flex justify-content-between align-items-center">
                    <a class="navbar-brand" href="index.php">Learn<span style="color: #007bff;">X</span>a</a>
                    <h5 class="mr-3">LOGIN</h5>
                </div>
                <div class="learnxa-login-container box-shadow">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="learnxa-login-side">
                                <div class="user-login-img">
                                    <img src="./assets/img/login.jpg" alt="">
                                </div>
                                <h5>LearnXa</h5>
                                <p>Log in to your Portal Account to access the LearnXa e-Learning Platform</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="containter">
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
                                <form action="<?= base_url('login') ?>" method="post" class="login-form text-left row g-3">
                                    <div class="mb-3">
                                        <label for="inputEmail4" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputPassword4" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password">
                                    </div>
                                    <button type="submit" class="enroll-btn mb-3">Login</button>
                                    <div>Don't have an account yet? <span style="color: #007bff;"><a
                                                href="generate-invoice.php">Register</a></span></div>
                                    <div>Forgot Password? <span style="color: #007bff;"><a
                                                href="forgot-password.php">Reset</a></span></div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
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