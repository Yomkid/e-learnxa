<?php include('./include/head.php'); ?>


<body>
    <!-- ======= Sidebar ======= -->
    <?php include(APPPATH . 'Views/admin/include/sidebar.php'); ?>
    <main id="main" class="main p-0">
        <?php include(APPPATH . 'Views/admin/include/nav2.php'); ?>
        <main class="container mt-2">
            <div class="mb-3 font-weight-bold">USER MANAGEMENT</div>
            <div class="d-flex align-items-center justify-content-between">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUser">Add
                    User</button>
                <button type="button" class="btn btn-success" data-toggle="modal"
                    data-target="#importExport">Import/Export</button>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserTitle">ADD USER</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputName5" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="inputName5">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputName5" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="inputName5">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail5" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="inputEmail5">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword5" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="inputPassword5">
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Add User</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="importExport" tabindex="-1" role="dialog" aria-labelledby="importExportTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: green; color: white">
                            <h5 class="modal-title" id="importExportTitle">Import/Export</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- User Import/Export -->
                            <div class="container">
                                <h2>User Import/Export</h2>
                                <div class="row mb-3">
                                    <!-- Import Users -->
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                Import Users
                                            </div>
                                            <div class="card-body">
                                                <form enctype="multipart/form-data">
                                                    <div class="mb-3">
                                                        <label for="importFile" class="form-label">Select CSV File to
                                                            Import:</label>
                                                        <input type="file" class="form-control" id="importFile"
                                                            accept=".csv">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Import</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Export Users -->
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                Export Users
                                            </div>
                                            <div class="card-body">
                                                <p>Export user data to CSV format.</p>
                                                <a href="#" class="btn btn-primary">Export Users</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Import</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User List Table -->
            <table class="table mt-4">
                <thead class="dark-theme">
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- User data will be dynamically populated here -->
                    <tr>
                        <td>1</td>
                        <td>john_doe</td>
                        <td>john@example.com</td>
                        <td>Admin</td>
                        <td>Active</td>
                        <td>
                            <!-- Action buttons (e.g., Edit, Delete) -->
                            <button class="btn btn-primary btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>john_doe</td>
                        <td>john@example.com</td>
                        <td>Admin</td>
                        <td>Active</td>
                        <td>
                            <!-- Action buttons (e.g., Edit, Delete) -->
                            <button class="btn btn-primary btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>john_doe</td>
                        <td>john@example.com</td>
                        <td>Admin</td>
                        <td>Active</td>
                        <td>
                            <!-- Action buttons (e.g., Edit, Delete) -->
                            <button class="btn btn-primary btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>john_doe</td>
                        <td>john@example.com</td>
                        <td>Admin</td>
                        <td>Active</td>
                        <td>
                            <!-- Action buttons (e.g., Edit, Delete) -->
                            <button class="btn btn-primary btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>john_doe</td>
                        <td>john@example.com</td>
                        <td>Admin</td>
                        <td>Active</td>
                        <td>
                            <!-- Action buttons (e.g., Edit, Delete) -->
                            <button class="btn btn-primary btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>john_doe</td>
                        <td>john@example.com</td>
                        <td>Admin</td>
                        <td>Active</td>
                        <td>
                            <!-- Action buttons (e.g., Edit, Delete) -->
                            <button class="btn btn-primary btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>john_doe</td>
                        <td>john@example.com</td>
                        <td>Admin</td>
                        <td>Active</td>
                        <td>
                            <!-- Action buttons (e.g., Edit, Delete) -->
                            <button class="btn btn-primary btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    <!-- More user rows will be added dynamically -->
                </tbody>
            </table>
        </main>

        <!-- User Details -->
        <div class="container">
            <h2>User Details</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Registration Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- User data will be dynamically generated here -->
                        <tr>
                            <td>1</td>
                            <td>JohnDoe</td>
                            <td>johndoe@example.com</td>
                            <td>Admin</td>
                            <td>2024-04-15</td>
                            <td>
                                <!-- Action buttons (Edit, Delete) -->
                                <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                        <!-- More user data rows will be added dynamically -->
                    </tbody>
                </table>
            </div>
        </div>


        <!-- User Roles and Permission -->
        <div class="container">
            <h2>User Roles and Permissions</h2>
            <div class="row">
                <div class="col-md-6">
                    <!-- Role Assignment Form -->
                    <h3>Assign Role to User</h3>
                    <form>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Enter username">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role">
                                <option selected>Select role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                                <!-- Add more roles here -->
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Assign Role</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <!-- Permissions Management -->
                    <h3>Manage Permissions</h3>
                    <!-- Add permission management UI here -->
                </div>
            </div>
        </div>




        <!-- User Authentication -->
        <div class="container">
            <h2>User Login</h2>
            <form>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>


        <!-- User Profile Management -->
        <div class="container">
            <h2>User Profile</h2>
            <form>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter username" disabled>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" disabled>
                </div>
                <div class="mb-3">
                    <label for="fullname" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullname" placeholder="Enter full name">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter new password">
                </div>
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>


        <!-- User Activity Logs -->
        <div class="container">
            <h2>User Activity Logs</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2024-04-01</td>
                            <td>User123</td>
                            <td>Login</td>
                            <td>User logged in successfully</td>
                        </tr>
                        <tr>
                            <td>2024-04-02</td>
                            <td>User456</td>
                            <td>Update Profile</td>
                            <td>User updated their profile information</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>





        <!-- User Search and Filtering -->
        <div class="container">
            <h2>User Search and Filtering</h2>
            <div class="row mb-3">
                <!-- Search Users -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Search Users
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="searchInput" class="form-label">Search by Name or Email:</label>
                                <input type="text" class="form-control" id="searchInput">
                            </div>
                            <button type="button" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
                <!-- Filter Users -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Filter Users
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="roleFilter" class="form-label">Filter by Role:</label>
                                <select class="form-select" id="roleFilter">
                                    <option value="">All Roles</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <!-- Add more filter options as needed -->
                            <button type="button" class="btn btn-primary">Apply Filters</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Display Search Results -->
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Search Results
                        </div>
                        <div class="card-body">
                            <!-- Display search results here -->
                            <p>No results found.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>













    </main>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
            <?php include(APPPATH . 'Views/admin/include/js.php'); ?>

    <!-- Bootstrap JS (optional, if you need any Bootstrap JavaScript features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>