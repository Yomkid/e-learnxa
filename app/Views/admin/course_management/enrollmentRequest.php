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
            <div class="mb-3 font-weight-bold">Enrollment Requests</div>
            <section class="enrollment-requests">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="enrollmentRequestsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student Name</th>
                                <th>Course Name</th>
                                <th>Enrollment Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Enrollment request data will be dynamically inserted here -->
                            <tr>
                                <td>1</td>
                                <td>Jane Smith</td>
                                <td>Data Structures and Algorithms</td>
                                <td>2024-06-20</td>
                                <td>Pending</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-success">Approve</a>
                                    <a href="#" class="btn btn-sm btn-danger">Reject</a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Michael Johnson</td>
                                <td>Machine Learning Fundamentals</td>
                                <td>2024-06-21</td>
                                <td>Pending</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-success">Approve</a>
                                    <a href="#" class="btn btn-sm btn-danger">Reject</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <?php include(APPPATH . 'Views/admin/include/js.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/script.js"></script>
    <script>
        $(document).ready(function() {
            $('#enrollmentRequestsTable').DataTable();
        });
    </script>
</body>
</html>
