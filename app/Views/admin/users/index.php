
    <?php include(APPPATH . 'Views/admin/include/head.php'); ?>
<</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-90XYHBSS6Z"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-90XYHBSS6Z');
</script>

<body>
    <?php include(APPPATH . 'Views/admin/include/sidebar.php'); ?>
    <main id="main" class="main p-0">
        <?php include(APPPATH . 'Views/admin/include/nav2.php'); ?>
        <div class="container mt-2" id="mainContent">
            <div class="mb-3 font-weight-bold">USER MANAGEMENT</div>

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="userTabs" role="tablist">
                <li class="nav-item">
                    <a class="btn nav-link btn-primary shadow bg-primary" id="add-user-tab" data-toggle="modal" data-target="#createUserModal" role="tab"
                    aria-controls="add-user" aria-selected="false">ADD USER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="user-list-tab" data-toggle="tab" href="#user-list" role="tab"
                    aria-controls="user-list" aria-selected="true">User Lists</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="upload-bulk-user-tab" data-toggle="tab" href="#upload-bulk-user" role="tab"
                    aria-controls="bulk-user" aria-selected="false">Upload Bulk Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="export-user-tab" data-toggle="tab" href="#export-user" role="tab"
                    aria-controls="export-user" aria-selected="false">Export Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="user-settings-tab" data-toggle="tab" href="#user-settings" role="tab"
                    aria-controls="user-settings" aria-selected="false">Settings</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="userTabsContent">
                <!-- Display validation errors if any -->
                <?php if (session()->has('message')) : ?>
                    <?= view('include/message') ?>
                <?php endif ?>

                <!-- User List Tab -->
                <div class="tab-pane fade show active" id="user-list" role="tabpanel"
                    aria-labelledby="user-list-tab">
                    <div class="row my-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" id="userSearch" class="form-control" placeholder="Search users...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select id="userSort" class="form-control">
                                    <option value="name_asc">Sort by Name (A-Z)</option>
                                    <option value="name_desc">Sort by Name (Z-A)</option>
                                    <option value="id_asc">Sort by ID (Ascending)</option>
                                    <option value="id_desc">Sort by ID (Descending)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Reg No.</th>
                                        <th>Tel</th>
                                        <th>Reg Date</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="userTableBody">
                                    <!-- Users will be loaded here via JavaScript -->
                                </tbody>
                            </table>
                            <nav>
                                <ul class="pagination" id="pagination">
                                    <!-- Pagination links will be generated here -->
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

               <!-- Bulk Upload Section -->
                <div class="tab-pane fade" id="upload-bulk-user" role="tabpanel" aria-labelledby="upload-bulk-user-tab">
                    <div id="uploadStatus"></div> <!-- Status display -->

                    <form id="bulkUploadForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="users_file">Upload Users File (CSV/Excel)</label>
                            <input type="file" id="users_file" name="file" class="form-control" accept=".csv, .xlsx" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>

                <!-- Export Users Section -->
                <div class="tab-pane fade" id="export-user" role="tabpanel" aria-labelledby="export-user-tab">
                    <form id="exportUsersForm" method="post" action="admin/users/exportUsers" target="_blank">
                        <label for="user_id">User ID:</label>
                        <select id="user_id" name="user_id" class="form-control">
                                <option value="">All Users</option>
                                <?php if (!empty($users)): ?>
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?= $user['user_id'] ?>"><?= $user['first_name'] .' '. $user['last_name']; ?> (<?= $user['email'] ?>)</option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" id="start_date" name="start_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" id="end_date" name="end_date" class="form-control">
                        </div>

                        <button type="button" onclick="downloadUsersExport()" class="btn btn-primary">Export Users</button>
                    </form>

                    <!-- <form id="exportUsersForm" action="<?= base_url('admin/users/exportUsers') ?>" method="post">
                        <div class="form-group">
                            <label for="user_id">Select User</label>
                            <select id="user_id" name="user_id" class="form-control">
                                <option value="">All Users</option>
                                <?php if (!empty($users)): ?>
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?= $user['user_id'] ?>"><?= $user['username'] ?> (<?= $user['email'] ?>)</option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" id="start_date" name="start_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" id="end_date" name="end_date" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Export Users</button>
                    </form> -->


                </div>

                <!-- User Settings Section -->
                <div class="tab-pane fade mt-2" id="user-settings" role="tabpanel" aria-labelledby="user-settings-tab">
                    <form id="userSettingsForm" action="<?= base_url('admin/users/updateSettings') ?>" method="post">
                        <div class="form-group">
                            <label for="default_role">Default User Role</label>
                            <select id="default_role" name="default_role" class="form-control">
                                <option value="subscriber">Subscriber</option>
                                <option value="editor">Editor</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="account_activation">Account Activation</label>
                            <select id="account_activation" name="account_activation" class="form-control">
                                <option value="0">Manual Activation</option>
                                <option value="1">Automatic Activation</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password_policy">Password Policy</label>
                            <textarea id="password_policy" name="password_policy" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    
        <!-- Modal for Creating User -->
    <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Create New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="userForm" action="<?= base_url('admin/users/store') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="user_name">User Name</label>
                            <input type="text" id="user_name" name="user_name" class="form-control" value="<?= old('user_name') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="user_description">Description</label>
                            <textarea id="user_description" name="user_description" class="form-control" rows="4"><?= old('user_description') ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="total_marks">Total Marks</label>
                            <input type="number" name="total_marks" id="total_marks" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="duration">Duration (in minutes)</label>
                            <input type="number" name="duration" id="duration" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="passing_score">Passing Score</label>
                            <input type="number" name="passing_score" id="passing_score" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="max_attempts">Maximum Attempts</label>
                            <input type="number" name="max_attempts" id="max_attempts" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="is_active">Is Active</label>
                            <input type="checkbox" name="is_active" id="is_active" value="1">
                        </div>

                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="shuffle_questions">Shuffle Questions</label>
                            <input type="checkbox" name="shuffle_questions" id="shuffle_questions" value="1">
                        </div>

                        <div class="form-group">
                            <label for="shuffle_answers">Shuffle Answers</label>
                            <input type="checkbox" name="shuffle_answers" id="shuffle_answers" value="1">
                        </div>

                        <div class="form-group">
                            <label for="published">Published</label>
                            <input type="checkbox" name="published" id="published" value="1">
                        </div>

                        <div class="form-group">
                            <label for="access_code">Access Code</label>
                            <input type="text" name="access_code" id="access_code" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="user_type">User Type</label>
                            <select name="user_type" id="user_type" class="form-control">
                                <option value="practice">Practice</option>
                                <option value="test">Test</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="attempt_mode">Attempt Mode</label>
                            <select name="attempt_mode" id="attempt_mode" class="form-control">
                                <option value="single">Single</option>
                                <option value="multiple">Multiple</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="retake_delay">Retake Delay (in hours)</label>
                            <input type="number" name="retake_delay" id="retake_delay" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="allow_review">Allow Review</label>
                            <input type="checkbox" name="allow_review" id="allow_review" value="1">
                        </div>

                        <div class="form-group">
                            <label for="feedback_enabled">Enable Feedback</label>
                            <input type="checkbox" name="feedback_enabled" id="feedback_enabled" value="1">
                        </div>

                        <div class="form-group">
                            <label for="feedback_message">Feedback Message</label>
                            <textarea name="feedback_message" id="feedback_message" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image_url">Image</label>
                            <input type="file" name="image_url" id="image_url" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Save User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing User -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" action="<?= base_url('admin/users/update') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" id="edit_user_id" name="user_id">
                        <div class="form-group">
                            <label for="edit_user_name">User Name</label>
                            <input type="text" id="edit_user_name" name="user_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_user_description">Description</label>
                            <textarea id="edit_user_description" name="user_description" class="form-control" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Previewing User -->
    <div class="modal fade" id="previewUserModal" tabindex="-1" role="dialog" aria-labelledby="previewUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>User Name: John Doe</div>
                    <div>User Description: Sample user description</div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            // Initialize Select2 for user role selection
            $('#user_role').select2();

            // Check if elements exist before attaching event listeners and loading users
            const userSearch = document.getElementById('userSearch');
            const userSort = document.getElementById('userSort');

            if (userSearch) {
                userSearch.addEventListener('input', loadUsers);
            }
            if (userSort) {
                userSort.addEventListener('change', loadUsers);
            }

            // Load users only if both elements exist
            if (userSearch && userSort) {
                loadUsers();
            }
        });

        function loadUsers() {
            const searchElem = document.getElementById('userSearch');
            const sortElem = document.getElementById('userSort');

            // Check if search and sort elements exist before using them
            const search = searchElem ? searchElem.value : '';
            const sort = sortElem ? sortElem.value : '';

            axios.get('<?= base_url('admin/users/list') ?>', {
                params: { search: search, sort: sort }
            })
            .then(response => {
                const users = response.data.users;
                const pagination = response.data.pagination;
                const tbody = document.getElementById('userTableBody');
                const paginationElem = document.getElementById('pagination');

                // Populate table with user data
                tbody.innerHTML = '';
                users.forEach(user => {
                    const row = `
                        <tr>
                            <td>${user.user_id}</td>
                            <td>${user.first_name} ${user.last_name}</td>
                            <td>${user.email}</td>
                            <td>${user.username}</td>
                            <td>${user.payment_confirmation_code}</td>
                            <td>${user.phone_number}</td>
                            <td>${user.created_at}</td>
                            <td>${user.role_id}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="openEditModal(${user.user_id})">Edit</button>
                                <a href="<?= base_url('admin/users/delete/') ?>${user.user_id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this User?')">Delete</a>
                            </td>
                        </tr>
                    `;
                    tbody.insertAdjacentHTML('beforeend', row);
                });

                // Pagination
                paginationElem.innerHTML = '';
                for (let i = 1; i <= pagination.totalPages; i++) {
                    const activeClass = i === pagination.currentPage ? 'active' : '';
                    const pageItem = `
                        <li class="page-item ${activeClass}">
                            <a class="page-link" href="#" onclick="loadPage(${i})">${i}</a>
                        </li>
                    `;
                    paginationElem.insertAdjacentHTML('beforeend', pageItem);
                }
            })
            .catch(error => console.error(error));
        }


        function loadPage(page) {
            axios.get('<?= base_url('admin/users/list') ?>', {
                params: {
                    search: document.getElementById('userSearch').value,
                    sort: document.getElementById('userSort').value,
                    page: page
                }
            })
            .then(response => {
                const users = response.data.users;
                const pagination = response.data.pagination;
                const tbody = document.getElementById('userTableBody');
                tbody.innerHTML = '';

                users.forEach(user => {
                    const row = `
                        <tr>
                            <td>${user.user_id}</td>
                            <td>${user.first_name} ${user.last_name}</td>
                            <td>${user.email}</td>
                            <td>${user.username}</td>
                            <td>${user.payment_confirmation_code}</td>
                            <td>${user.phone_number}</td>
                            <td>${user.created_at}</td>
                            <td>${user.role_id}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="openEditModal(${user.user_id})">Edit</button>
                                <a href="<?= base_url('admin/users/delete/') ?>${user.user_id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this User?')">Delete</a>
                            </td>
                        </tr>
                    `;
                    tbody.insertAdjacentHTML('beforeend', row);
                });

                const paginationElem = document.getElementById('pagination');
                paginationElem.innerHTML = '';
                for (let i = 1; i <= pagination.totalPages; i++) {
                    const activeClass = i === pagination.currentPage ? 'active' : '';
                    const pageItem = `
                        <li class="page-item ${activeClass}">
                            <a class="page-link" href="#" onclick="loadPage(${i})">${i}</a>
                        </li>
                    `;
                    paginationElem.insertAdjacentHTML('beforeend', pageItem);
                }
            })
            .catch(error => console.error(error));
        }

        function openEditModal(userId) {
            axios.get('<?= base_url('admin/users/edit/') ?>' + userId)
            .then(response => {
                const user = response.data.user;
                document.getElementById('edit_user_id').value = user.user_id;
                document.getElementById('edit_user_name').value = user.user_name;
                document.getElementById('edit_user_email').value = user.email;
                document.getElementById('edit_user_role').value = user.role;
                $('#editUserModal').modal('show');
            })
            .catch(error => console.error(error));
        }

       

        document.getElementById("bulkUploadForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('users/bulkUpload', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('uploadStatus').innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                    loadUsers(); // Reload users after successful upload
                } else {
                    document.getElementById('uploadStatus').innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                }
            })
            .catch(error => {
                document.getElementById('uploadStatus').innerHTML = `<div class="alert alert-danger">An error occurred. Please try again.</div>`;
                console.error('Error:', error);
            });
        });


        function downloadUsersExport() {
            const form = document.getElementById('exportUsersForm');
            const formData = new FormData(form);

            fetch('users/exportUsers', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) throw new Error('Failed to download the user export file.');

                return response.blob();
            })
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `users_export_${new Date().toISOString()}.csv`;
                document.body.appendChild(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
            })
            .catch(error => {
                console.error('Download error:', error);
                alert('An error occurred while downloading the file.');
            });
        }

    </script>



</body>
</html>
