<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Login | LearnXa</title>
    <?php include(APPPATH . 'Views/include/head.php'); ?>
<style>
    .input-group-text {
            cursor: pointer;
        }
</style>
</head>

<body>
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
                                        <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="password" required
                                        aria-required="true">
                                        <span class="input-group-text" id="togglePassword"
                                        aria-label="Toggle password visibility">
                                        <i class="material-icons">visibility</i>
                                </div>
                                    </span>
                                    </div>
                                    <?php if ($redirect = service('request')->getGet('redirect')): ?>
                            <input type="hidden" name="redirect" value="<?= esc($redirect); ?>">
                            <?php endif; ?>
                                    <button type="submit" class="enroll-btn mb-3">Login</button>
                                    <div>Don't have an account yet? <span style="color: #007bff;"><a
                                                href="/generate-invoice">Register</a></span></div>
                                    <div>Forgot Password? <span style="color: #007bff;"><a
                                                href="#forgot-password">Reset</a></span></div>
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
// Toggle password visibility
$('#togglePassword').on('click', function () {
                var passwordInput = $('#password');
                var icon = $(this).find('i');
                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    icon.text('visibility_off');
                } else {
                    passwordInput.attr('type', 'password');
                    icon.text('visibility');
                }
            });
    </script>
</body>

</html>