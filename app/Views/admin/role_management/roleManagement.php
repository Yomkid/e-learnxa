<?php include(APPPATH .'Views/admin/include/head.php'); ?>
<title>Role Management | LearnXa</title>

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
            <div class="mb-3 font-weight-bold">Role Management</div>
            <section class="role-management">
                <div class="mb-3">
                    <a href="create_role.php" class="btn btn-primary">Create New Role</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="roleTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Role Name</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Role data will be dynamically inserted here -->
                            <tr>
                                <td>1</td>
                                <td>Admin</td>
                                <td>Full Access</td>
                                <td>
                                    <a href="edit_role.php?id=1" class="btn btn-sm btn-info">Edit</a>
                                    <a href="delete_role.php?id=1" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Instructor</td>
                                <td>Create/Manage Courses</td>
                                <td>
                                    <a href="edit_role.php?id=2" class="btn btn-sm btn-info">Edit</a>
                                    <a href="delete_role.php?id=2" class="btn btn-sm btn-danger">Delete</a>
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
            $('#roleTable').DataTable();
        });
    </script>
</body>
</html>
