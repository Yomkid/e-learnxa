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
</style>

<body>
<?php include(APPPATH . 'Views/admin/include/sidebar.php'); ?>
    <main id="main" class="main p-0">
        <?php include(APPPATH . 'Views/admin/include/nav2.php'); ?>
        <div class="container mt-2" id="mainContent">
            <div class="mb-3 font-weight-bold">Enrollment Details</div>
            <section class="enrollment-detail">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Student Information</h5>
                        <div class="row mb-3">
                            <div class="col-md-3">Student Name:</div>
                            <div class="col-md-9">John Doe</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">Course Name:</div>
                            <div class="col-md-9">Introduction to Programming</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">Enrollment Date:</div>
                            <div class="col-md-9">2024-06-22</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">Status:</div>
                            <div class="col-md-9">Active</div>
                        </div>
                        <h5 class="card-title mt-5 mb-4">Course Progress</h5>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                        </div>
                        <a href="#" class="btn btn-primary">View Course Details</a>
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
