<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(APPPATH . 'Views/admin/include/head.php'); ?>
    <title>Assignment Management | LearnXa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <meta name="csrf-token" content="<?= csrf_hash() ?>">

<style>
    .select2-container--default .select2-results__option {
    display: flex;
    align-items: center;
}

</style>


</head>
<body>
    <?php include(APPPATH . 'Views/admin/include/sidebar.php'); ?>
    <main id="main" class="main p-0">
        <?php include(APPPATH . 'Views/admin/include/nav2.php'); ?>
        <div class="container mt-2" id="mainContent">
            <div class="mb-3 font-weight-bold">ASSIGNMENT MANAGEMENT</div>
            <!-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createassignmentModal">Create assignment</button> -->


            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="assignmentTabs" role="tablist">
                <li class="nav-item">
                    <a class="btn nav-link" id="add-assignment-tab" data-toggle="modal" data-target="#createassignmentModal" role="tab"
                        aria-controls="add-assignment" aria-selected="false">ADD ASSIGNMENT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="assignment-bank-tab" data-toggle="tab" href="#assignment-bank" role="tab"
                        aria-controls="assignment-bank" aria-selected="true">assignment Lists</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="add-bulk-assignment-tab" data-toggle="tab" href="#add-bulk-assignment" role="tab"
                        aria-controls="bulk-assignment" aria-selected="false">Upload Bulk assignment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="export-assignment-tab" data-toggle="tab" href="#export-assignment" role="tab"
                        aria-controls="export-assignment" aria-selected="false">Export assignment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="assign-assignments-tab" data-toggle="tab" href="#assign-assignments" role="tab"
                        aria-controls="assign-assignment" aria-selected="false">Assign assignment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="assignment-settings-tab" data-toggle="tab" href="#assignment-settings" role="tab"
                        aria-controls="assignment-settings" aria-selected="false">Settings</a>
                </li>
            </ul>


            <!-- Tab Content -->
            <div class="tab-content" id="questionTabsContent">
                <!-- Display validation errors if any -->
                <?php if (session()->has('message')) : ?>
                    <?= view('include/message') ?>
                <?php endif ?>

                <!-- Question Bank Tab -->
                <div class="tab-pane fade show active" id="assignment-bank" role="tabpanel"
                    aria-labelledby="assignment-bank-tab">
                    <div class="row my-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" id="search" class="form-control" placeholder="Search assignments...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                        <select id="sort" class="form-control">
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
                                        <th>assignment Name</th>
                                        <th>assignment Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="assignmentTableBody">
                                    <!-- assignments will be loaded here via JavaScript -->
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
                <div class="tab-pane fade" id="add-bulk-assignment" role="tabpanel" aria-labelledby="add-bulk-assignment-tab">
                    
                    <form id="bulkUploadForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="assignment_file">Upload assignment File (CSV/Excel)</label>
                            <input type="file" id="assignment_file" name="assignment_file" class="form-control" accept=".csv, .xlsx" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>

                <!-- Export to CSV -->
                <div class="tab-pane fade" id="export-assignment" role="tabpanel" aria-labelledby="export-assignment-tab">
                    <form action="<?= base_url('assignments/exportAssignments') ?>" method="post">
                        <div class="form-group">
                            <label for="assignment_id">Select assignment</label>
                            <select id="assignment_id" name="assignment_id" class="form-control">
                                <option value="">All assignments</option>
                                <?php if (!empty($assignments)): ?>
                                    <?php foreach ($assignments as $assignment): ?>
                                        <option value="<?= $assignment['assignment_id'] ?>"><?= $assignment['assignment_name'] ?></option>
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
                        <button type="submit" class="btn btn-primary">Export Questions</button>
                    </form>
                </div>
               <!-- Assign assignments to Course --> <!-- Assign assignments to Course -->
                <div class="tab-pane fade mt-2" id="assign-assignments" role="tabpanel" aria-labelledby="assign-assignments-tab">
                    <form id="assignAssignmentsForm" action="<?= base_url('assignments/assignAssignments') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="course_id">Select Course</label>
                            <select id="assign_course_id" name="course_id" class="form-control" required>
                                <option value="">Select a course</option>
                                <?php if (!empty($courses)): ?>
                                    <?php foreach ($courses as $course): ?>
                                        <option value="<?= $course['course_id'] ?>" data-image="<?= base_url('uploads/' . $course['course_image']) ?>">
                                            <?= $course['course_title'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div id="assignmentSection"></div>
                    </form>
                </div>



                <!-- assignment Settings -->
                <div class="tab-pane fade mt-2" id="assignment-settings" role="tabpanel" aria-labelledby="assignment-settings-tab">
                    <form id="assignmentSettingsForm" action="<?= base_url('assignments/updateSettings') ?>" method="post">
                        <!-- Select assignment -->
                        <div class="form-group">
                            <label for="assignment_id">Select assignment</label>
                            <select id="assignment_id" name="assignment_id" class="form-control">
                                <!-- Populate with existing assignments -->
                                <?php foreach ($assignments as $assignment): ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <!-- assignment Status -->
                        <div class="form-group">
                            <label for="assignment_status">assignment Status</label>
                            <select id="assignment_status" name="assignment_status" class="form-control">
                                <option value="not_published">Not Published (Hidden)</option>
                                <option value="unlocked">Unlocked (Early Access)</option>
                                <option value="published">Published (Publicly Visible)</option>
                            </select>
                        </div>
                        
                        <!-- Assign assignment and Dates -->
                        <div class="form-group">
                            <label for="assign_assignment_dates">Assign assignment and Dates</label>
                            <input type="text" id="assign_assignment_dates" name="assign_assignment_dates" class="form-control" placeholder="Enter course and date details">
                        </div>
                        
                        <!-- Time Limit -->
                        <div class="form-group">
                            <label for="time_limit">Time Limit (minutes)</label>
                            <input type="number" id="time_limit" name="time_limit" class="form-control" placeholder="Enter time limit in minutes">
                        </div>
                        
                        <!-- Attempts Allowed -->
                        <div class="form-group">
                            <label for="attempts_allowed">Attempts Allowed</label>
                            <input type="number" id="attempts_allowed" name="attempts_allowed" class="form-control" placeholder="Enter number of attempts allowed">
                        </div>
                        
                        <!-- Passing Score -->
                        <div class="form-group">
                            <label for="passing_score">Passing Score (%)</label>
                            <input type="number" id="passing_score" name="passing_score" class="form-control" placeholder="Enter passing score percentage">
                        </div>
                        
                        <!-- Grades -->
                        <div class="form-group">
                            <label for="grades">Grades</label>
                            <select id="grades" name="grades" class="form-control">
                                <option value="letter">Letter Grades</option>
                                <option value="percentage">Percentage</option>
                            </select>
                        </div>
                        
                        <!-- Retakes -->
                        <div class="form-group">
                            <label for="retakes">Retakes Allowed</label>
                            <input type="number" id="retakes" name="retakes" class="form-control" placeholder="Enter number of retakes allowed">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </form>
                </div>

            </div>
    </main>
    
    <!-- Modal for Creating assignment -->
    <div class="modal fade" id="createassignmentModal" tabindex="-1" role="dialog" aria-labelledby="createassignmentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createassignmentModalLabel">Create New assignment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="assignmentForm" action="<?= base_url('assignments/store') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="assignment_name">assignment Name</label>
                            <input type="text" id="assignment_name" name="assignment_name" class="form-control" value="<?= old('assignment_name') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="assignment_description">Description</label>
                            <textarea id="assignment_description" name="assignment_description" class="form-control" rows="4"><?= old('assignment_description') ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save assignment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing assignment -->
    <div class="modal fade" id="editassignmentModal" tabindex="-1" role="dialog" aria-labelledby="editassignmentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editassignmentModalLabel">Edit assignment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editassignmentForm" action="<?= base_url('assignments/update') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" id="edit_assignment_id" name="assignment_id">
                        <div class="form-group">
                            <label for="edit_assignment_name">assignment Name</label>
                            <input type="text" id="edit_assignment_name" name="assignment_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_assignment_description">Description</label>
                            <textarea id="edit_assignment_description" name="assignment_description" class="form-control" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update assignment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Editing assignment -->
    <div class="modal fade" id="previewassignmentModal" tabindex="-1" role="dialog" aria-labelledby="previewassignmentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewassignmentModalLabel">Edit assignment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>assignment Name: Babados afana</div>
                    <div>assignment Description: ajalarusure</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        
            $(document).ready(function() {
                $('#assign_course_id').select2();
                $('#assign_course_id').change(function() {
                    var course_id = $(this).val();
                    if (course_id) {
                        fetchassignmentsForCourse(course_id);
                    }
                });
            });

            function fetchassignmentsForCourse(course_id) {
                axios.get(`<?= base_url('assignments/getAssignmentsForCourse') ?>/${course_id}`)
                    .then(response => {
                        var assignments = response.data.assignedAssignments;
                        var availableAssignments = response.data.allAssignments;
                        var assignmentSection = $('#assignmentSection');

                        assignmentSection.empty();

                        var availableAssignmentsHtml = `
                        
                            <div class="form-group">
                                <label for="assignment_ids">Select assignments to Assign</label>
                                <select id="assignment_ids" name="assignments[]" class="form-control" multiple="multiple" required>
                                    ${availableAssignments.map(assignment => `<option value="${assignment.assignment_id}">${assignment.assignment_name}</option>`).join('')}
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Assign assignments</button>`;

                        assignmentSection.append(availableAssignmentsHtml);

                        $('#assignment_ids').select2();

                        if (assignments.length > 0) {
                            var tableHtml = `
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>assignment Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>`;

                            assignments.forEach(assignment => {
                                tableHtml += `
                                    <tr>
                                        <td>${assignment.assignment_name}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeAssignmentFromCourse(${course_id}, ${assignment.assignment_id})">Remove</button>
                                        </td>
                                    </tr>`;
                            });

                            tableHtml += `
                                    </tbody>
                                </table>`;

                            assignmentSection.append(tableHtml);
                        } else {
                            assignmentSection.append('<p>No assignments assigned to this course. Please assign assignments.</p>');
                        }

                    
                    })
                    .catch(error => {
                        console.error('Error fetching assignments for course:', error);
                    });
            }

        
            function removeAssignmentFromCourse(courseId, assignmentId) {
    if (confirm('Are you sure you want to remove this assignment from the course?')) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (!csrfToken) {
            console.error('CSRF token not found.');
            return;
        }

        axios.post(`<?= base_url('assignments/removeAssignment') ?>/${courseId}/${assignmentId}`, {}, {
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => {
            console.log(response.data); // Log response for debugging
            if (response.data.status === 'success') {
                alert(response.data.message);
                fetchassignmentsForCourse(courseId); // Refresh the list
            } else {
                alert(response.data.message);
            }
        })
        .catch(error => {
            console.error('Error removing assignment from course:', error);
        });
    }
}






        
        
        
        let editorInstance;
        let editEditorInstance;
        let isFormDirty = false;


        document.addEventListener('DOMContentLoaded', function() {



            




           
            



            ClassicEditor
                .create(document.querySelector('#assignment_description'))
                .then(editor => {
                    editorInstance = editor;

                    // Track changes in CKEditor content
                    editor.model.document.on('change:data', () => {
                        isFormDirty = true;
                    });
                })
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor
                .create(document.querySelector('#edit_assignment_description'))
                .then(editor => {
                    editEditorInstance = editor;

                    // Track changes in CKEditor content
                    editor.model.document.on('change:data', () => {
                        isFormDirty = true;
                    });
                })
                .catch(error => {
                    console.error(error);
                });

            document.getElementById('assignmentForm').addEventListener('submit', function() {
                if (editorInstance) {
                    document.getElementById('assignment_description').value = editorInstance.getData();
                }
                isFormDirty = false; // Reset the form dirty flag on submit
            });

            document.getElementById('editassignmentForm').addEventListener('submit', function() {
                if (editEditorInstance) {
                    document.getElementById('edit_assignment_description').value = editEditorInstance.getData();
                }
                isFormDirty = false; // Reset the form dirty flag on submit
            });

            loadassignments();

            document.getElementById('search').addEventListener('input', loadassignments);
            document.getElementById('sort').addEventListener('change', loadassignments);
        });

        function loadassignments() {
            const search = document.getElementById('search').value;
            const sort = document.getElementById('sort').value;

            axios.get('<?= base_url('assignments/list') ?>', {
                params: {
                    search: search,
                    sort: sort
                }
            })
            .then(response => {
                const assignments = response.data.assignments;
                const pagination = response.data.pagination;
                const tbody = document.getElementById('assignmentTableBody');
                const paginationElem = document.getElementById('pagination');

                tbody.innerHTML = '';
                assignments.forEach(assignment => {
                    const row = `
                        <tr>
                            <td>${assignment.assignment_id}</td>
                            <td>${assignment.assignment_name}</td>
                            <td>${assignment.assignment_description}</td>
                            <td>
                                <button class="btn btn-success btn-sm" onclick="openPreviewModal(${assignment.assignment_id})" data-toggle="modal" data-target="#previewassignmentModal">Preview</button>
                                <button class="btn btn-warning btn-sm" onclick="openEditModal(${assignment.assignment_id})" data-toggle="modal" data-target="#editassignmentModal">Edit</button>
                                <a href="<?= base_url('assignments/delete/') ?>${assignment.assignment_id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this assignment?')">Delete</a>
                            </td>
                        </tr>
                    `;
                    tbody.insertAdjacentHTML('beforeend', row);
                });

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
            .catch(error => {
                console.error(error);
            });
        }

        function loadPage(page) {
            axios.get('<?= base_url('assignments/list') ?>', {
                params: {
                    search: document.getElementById('search').value,
                    sort: document.getElementById('sort').value,
                    page: page
                }
            })
            .then(response => {
                const assignments = response.data.assignments;
                const pagination = response.data.pagination;
                const tbody = document.getElementById('assignmentTableBody');
                const paginationElem = document.getElementById('pagination');

                tbody.innerHTML = '';
                assignments.forEach(assignment => {
                    const row = `
                        <tr>
                            <td>${assignment.assignment_id}</td>
                            <td>${assignment.assignment_name}</td>
                            <td>${assignment.assignment_description}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="openEditModal(${assignment.assignment_id})" data-toggle="modal" data-target="#editassignmentModal">Edit</button>
                                <a href="<?= base_url('assignments/delete/') ?>${assignment.assignment_id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this assignment?')">Delete</a>
                            </td>
                        </tr>
                    `;
                    tbody.insertAdjacentHTML('beforeend', row);
                });

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
            .catch(error => {
                console.error(error);
            });
        }

        function openEditModal(assignmentId) {
            axios.get('<?= base_url('assignments/edit/') ?>' + assignmentId)
            .then(response => {
                const assignment = response.data.assignment;

                document.getElementById('edit_assignment_id').value = assignment.assignment_id;
                document.getElementById('edit_assignment_name').value = assignment.assignment_name;
                editEditorInstance.setData(assignment.assignment_description);

                $('#editassignmentModal').modal('show');
            })
            .catch(error => {
                console.error(error);
            });
        }

        $('#createassignmentModal').on('hide.bs.modal', function(e) {
            if (isFormDirty) {
                if (!confirm('You have unsaved changes. Are you sure you want to close the modal?')) {
                    e.preventDefault();
                } else {
                    isFormDirty = false;
                }
            }
        });

        $('#editassignmentModal').on('hide.bs.modal', function(e) {
            if (isFormDirty) {
                if (!confirm('You have unsaved changes. Are you sure you want to close the modal?')) {
                    e.preventDefault();
                } else {
                    isFormDirty = false;
                }
            }
        });

        window.addEventListener('beforeunload', function(event) {
            if (isFormDirty) {
                event.preventDefault();
                event.returnValue = 'Changes you made may not be saved.';
            }
        });
    </script>


</body>
</html>
