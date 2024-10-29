<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration | LearnXa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/assets/css/course.css">
</head>

<body>
        <?php include(APPPATH . 'Views/include/navbar.php'); ?>
        <div class="form-wrapper">
            <div class="">
            <div class="container">
                <div class="form-header mb-3 text-center p-2">
                    <h4 class="form-head-text text-light text-center">Application Form Invoice</h4>
                    <p>To Register on LearnXa, you will need to generate an invoice and make a registration payment to
                        have access to your virtual and ready-made courses</p>
                </div>
                <div class="learnxa-login-container box-shadow">

                    <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                    <?php endif; ?>
                    <!-- Loading Spinner -->
                    <div id="loading">
                            <div class="spinner"></div>
                        </div>
                    <form id="loadingSpinner" action="<?= base_url('invoice-process') ?>" method="post" class="form" onsubmit="showLoadingSpinner()">
                        <div class="row text-left mb-3">
                            <div class="col-md-6">
                                <label for="inputFirstName5" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="inputFirstName5" name="first_name"
                                    value="<?= old('first_name') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="inputLastName5" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="inputLastName5" name="last_name"
                                    value="<?= old('last_name') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail5" class="form-label">Email</label>
                                <input type="email" class="form-control" id="inputEmail5" name="email"
                                    value="<?= old('email') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="inputPhoneNumber5" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="inputPhoneNumber5" name="phone_number"
                                    value="<?= old('phone_number') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="inputState5" class="form-label">State</label>
                                <input type="text" class="form-control" id="inputState5" name="state"
                                    value="<?= old('state') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="inputCountry5" class="form-label">Country</label>
                                <input type="text" class="form-control" id="inputCountry5" name="country"
                                    value="<?= old('country') ?>" required>
                            </div>
                            <div class="col-md-12">
                                <label for="inputAddress5" class="form-label">Address</label>
                                <input type="text" class="form-control" id="inputAddress5" name="address"
                                    value="<?= old('address') ?>" required>
                            </div>
                        </div>
                        <button type="submit" class="enroll-btn">Generate Invoice</button>
                    </form>
                </div>
            </div>
           
        </div>
    </div>
    
    <script src="<?= base_url('/assets/js/main-scripts.js'); ?>"></script>
    <?php include(APPPATH . 'Views/include/js.php'); ?>

</body>

</html>
