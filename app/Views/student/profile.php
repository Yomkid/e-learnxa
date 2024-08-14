<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student Profile - LearnXa</title>
    <?php include(APPPATH . 'Views/student/include/student-head.php'); ?>
</head>

<body style="background-color: #f2f2f2;">



    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-6">
                <?php include(APPPATH . 'Views/student/include/student-sidebar.php'); ?>
            </div>


            <div class="col-lg-10 col-md-6 ">
                <?php include(APPPATH . 'Views/student/include/student-navbar.php'); ?>

                <div class="main-container mt-2 p-2" id="mainContent">
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

                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src="../assets/img/profile-img.jpg" alt="User"
                                            class="img-fluid rounded-circle mb-2" style="width: 100px;">
                                        <h4><?= session('first_name'); ?> <?= session('last_name'); ?></h4>
                                        <p class="text-muted"><?= session('first_name'); ?> Year Student</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Profile Information</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Full Name:</strong> <?= session('first_name'); ?>
                                                <?= session('last_name'); ?></p>
                                                <p><strong>Email:</strong> <?= session('email'); ?></p>
                                                <p><strong>Phone:</strong> <?= session('phone_number'); ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Department:</strong> <?= session('first_name'); ?></p>
                                                <p><strong>Year of Study:</strong> <?= session('first_name'); ?>
                                                </p>
                                                <p><strong>Enrollment Number:</strong>
                                                <?= session('payment_confirmation_code'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h4>Courses Enrolled</h4>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            <li class="list-group-item"></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h4>Recent Activities</h4>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            <li class="list-group-item"></li>
                                        </ul>
                                    </div>
                                </div>
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
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script>
        document.getElementById('currentYear').textContent = new Date().getFullYear();

        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('show');
        });

        document.getElementById('mainContent').addEventListener('click', function (e) {
            if (!document.getElementById('sidebar').contains(e.target) && e.target.id !== 'sidebarToggle') {
                document.getElementById('sidebar').classList.remove('show');
            }
        });

        document.getElementById('searchIcon').addEventListener('click', function () {
            var searchForm = document.getElementById('searchForm');
            if (searchForm.classList.contains('d-none')) {
                searchForm.classList.remove('d-none');
                searchForm.classList.add('d-flex');
            } else {
                searchForm.classList.remove('d-flex');
                searchForm.classList.add('d-none');
            }
        });
    </script>

</body>

</html>