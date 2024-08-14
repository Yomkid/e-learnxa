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
            <div class="mb-3 font-weight-bold">Financial Reports</div>
            <section class="financial-reports">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Select Report Type</h5>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Sales Summary</h6>
                                        <p class="card-text">View summary of sales transactions.</p>
                                        <a href="#" class="btn btn-primary">Generate Report</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Revenue Trends</h6>
                                        <p class="card-text">Monitor revenue trends over time.</p>
                                        <a href="#" class="btn btn-primary">Generate Report</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Customer Invoices</h6>
                                        <p class="card-text">Download customer invoice details.</p>
                                        <a href="#" class="btn btn-primary">Generate Report</a>
                                    </div>
                                </div>
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
