<?php include(APPPATH .'Views/admin/include/head.php'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

    .profile-section .card-title {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .profile-section .card-text {
        font-size: 1.1rem;
    }
</style>

<body>
<?php include(APPPATH . 'Views/admin/include/sidebar.php'); ?>
    <main id="main" class="main p-0">
        <?php include(APPPATH . 'Views/admin/include/nav2.php'); ?>
        <div class="container mt-2" id="mainContent">
            <div class="mb-3 font-weight-bold">User Profile</div>
            <section class="profile-section">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <img src="../assets/img/tutor1.jpg" class="rounded-circle img-fluid mb-3" alt="User Image" style="width:150px; height:150px; object-fit:cover">
                                <h5 class="card-title">John Doe</h5>
                                <p class="card-text">Role: Admin</p>
                                <p class="card-text">Email: john.doe@example.com</p>
                                <p class="card-text">Joined: 2024-01-15</p>
                                <p class="card-text">Status: Active</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">User Activity</h5>
                                <ul class="list-group">
                                    <!-- Activity Entry 1 -->
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div><strong>Logged in:</strong> 2024-04-10 10:00 AM</div>
                                            <div class="text-muted">1 hour ago</div>
                                        </div>
                                    </li>
                                    <!-- Activity Entry 2 -->
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div><strong>Submitted Test:</strong> Test 123</div>
                                            <div class="text-muted">2 hours ago</div>
                                        </div>
                                    </li>
                                    <!-- Add more activity entries as needed -->
                                </ul>
                            </div>
                        </div>
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
