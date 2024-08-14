<?php include(APPPATH .'Views/admin/include/head.php'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
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
            <div class="mb-3 font-weight-bold">System Settings</div>
            <section class="system-settings">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="platformName">Platform Name</label>
                                <input type="text" class="form-control" id="platformName" placeholder="Enter platform name">
                            </div>
                            <div class="form-group">
                                <label for="platformEmail">Platform Email</label>
                                <input type="email" class="form-control" id="platformEmail" placeholder="Enter platform email">
                            </div>
                            <div class="form-group">
                                <label for="platformTimezone">Timezone</label>
                                <select class="form-control" id="platformTimezone">
                                    <option>UTC</option>
                                    <option>PST</option>
                                    <option>EST</option>
                                    <!-- Add more timezones as needed -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="platformLanguage">Language</label>
                                <select class="form-control" id="platformLanguage">
                                    <option>English</option>
                                    <option>Spanish</option>
                                    <option>French</option>
                                    <!-- Add more languages as needed -->
                                </select>
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
