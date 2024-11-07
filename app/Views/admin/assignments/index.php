<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(APPPATH . 'Views/admin/include/head.php'); ?>
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


.badge-pill {
    font-size: 0.8em;
    padding: 5px 10px;
}
.badge-danger {
    background-color: #dc3545; /* Red for ungraded assignments */
    color: white;
}
.badge-success {
    background-color: #28a745; /* Green for graded assignments */
    color: white;
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
            <ul class="nav nav-tabs shadow-sm sticky" id="assignmentTabs" role="tablist">
                <li class="nav-item">
                    <a class="btn btn-primary" id="add-assignment-tab" data-toggle="modal" data-target="#createassignmentModal" role="tab"
                        aria-controls="add-assignment" aria-selected="false">ADD ASSIGNMENT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="assignment-bank-tab" data-toggle="tab" href="#assignment-bank" role="tab"
                        aria-controls="assignment-bank" aria-selected="true">Assignments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="add-bulk-assignment-tab" data-toggle="tab" href="#add-bulk-assignment" role="tab"
                        aria-controls="bulk-assignment" aria-selected="false">Bulk Upload</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="export-assignment-tab" data-toggle="tab" href="#export-assignment" role="tab"
                        aria-controls="export-assignment" aria-selected="false">Export</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="assign-assignments-tab" data-toggle="tab" href="#assign-assignments" role="tab"
                        aria-controls="assign-assignment" aria-selected="false">Assign</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="assignment-settings-tab" data-toggle="tab" href="#assignment-settings" role="tab"
                        aria-controls="assignment-settings" aria-selected="false">Settings</a>
                </li>

                <!-- Submitted Assignments Tab -->
                <li class="nav-item">
                    <a class="nav-link" id="submitted-assignments-tab" data-toggle="tab" href="#submitted-assignments" role="tab"
                    aria-controls="submitted-assignments" aria-selected="false">
                    Submitted Assignments 
                    <span id="ungradedCount" class="badge badge-pill badge-danger ml-2" style="display: none;">0</span>
                    <span id="gradedCount" class="badge badge-pill badge-success ml-1" style="display: none;">0</span>
                    </a>
                </li>

            </ul>


            <!-- Tab Content -->
            <div class="tab-content" id="questionTabsContent">
                <!-- Display validation errors if any -->
                <?php if (session()->has('message')) : ?>
                    <?= view('include/message') ?>
                <?php endif ?>

                <!-- Assignment List Tab -->
                <div class="tab-pane fade show active" id="assignment-bank" role="tabpanel" aria-labelledby="assignment-bank-tab">
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
                                        <th>Assignment Name</th>
                                        <th>Assignment Description</th>
                                        <th>Due Date</th>
                                        <th>Attachment</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="assignmentTableBody">
                                    <!-- Assignments will be loaded here via JavaScript -->
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
                    <form action="<?= base_url('admin/assignments/exportAssignments') ?>" method="post">
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
                    <form id="assignAssignmentsForm" action="<?= base_url('admin/assignments/assignAssignments') ?>" method="post">
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
                    <form id="assignmentSettingsForm" action="<?= base_url('admin/assignments/updateSettings') ?>" method="post">
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


                <!-- Assignment submissions -->
                <div class="tab-pane fade" id="submitted-assignments" role="tabpanel" aria-labelledby="submitted-assignments-tab">
                    <div class="row my-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" id="searchSubmitted" class="form-control" placeholder="Search submissions...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select id="sortSubmitted" class="form-control">
                                    <option value="date_asc">Sort by Date (Oldest)</option>
                                    <option value="date_desc">Sort by Date (Newest)</option>
                                    <option value="grade_asc">Sort by Grade (Lowest)</option>
                                    <option value="grade_desc">Sort by Grade (Highest)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>File</th>
                                        <th>Notes</th>
                                        <th>Course</th>
                                        <th>Submission Date</th>
                                        <th>Grade</th>
                                        <th>Edit Grade</th>
                                    </tr>
                                </thead>
                                <tbody id="submittedAssignmentsTableBody">
                                    <!-- Submissions will be loaded here via JavaScript -->
                                    
                                </tbody>
                            </table>
                            <nav>
                                <ul class="pagination" id="submittedPagination">
                                    <!-- Pagination links for submissions will be generated here -->
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
    
    <!-- Modal for Creating assignment -->
    <div class="modal fade" id="createassignmentModal" tabindex="-1" role="dialog" aria-labelledby="createassignmentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createassignmentModalLabel">Create New Assignment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="assignmentForm" action="<?= base_url('admin/assignments/store') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="assignment_name">Assignment Name</label>
                        <input type="text" id="assignment_name" name="assignment_name" class="form-control" value="<?= old('assignment_name') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="assignment_description">Description</label>
                        <textarea id="assignment_description" name="assignment_description" class="form-control" rows="4"><?= old('assignment_description') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <input type="date" id="due_date" name="due_date" class="form-control" value="<?= old('due_date') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="assignment_attachment">Attachment</label>
                        <input type="file" id="assignment_attachment" name="assignment_attachment" class="form-control" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip">
                    </div>
                        <button type="submit" class="btn btn-primary">Save Assignment</button>
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
                    <h5 class="modal-title" id="editassignmentModalLabel">Edit Assignment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editassignmentForm" action="<?= base_url('admin/assignments/update') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" id="edit_assignment_id" name="assignment_id">
                        <div class="form-group">
                            <label for="edit_assignment_name">Assignment Name</label>
                            <input type="text" id="edit_assignment_name" name="assignment_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_assignment_description">Description</label>
                            <textarea id="edit_assignment_description" name="assignment_description" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_due_date">Due Date</label>
                            <input type="date" id="edit_due_date" name="due_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_assignment_attachment">Attachment</label>
                            <input type="file" id="edit_assignment_attachment" name="assignment_attachment" class="form-control">
                            <small id="attachmentHelp" class="form-text text-muted">Leave empty if you don't want to change the attachment.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Assignment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Preview assignment -->
    <div class="modal fade" id="previewassignmentModal" tabindex="-1" role="dialog" aria-labelledby="previewassignmentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewassignmentModalLabel">Preview Assignment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div><strong>Assignment Name:</strong> <span id="preview_assignment_name"></span></div>
                    <div><strong>Assignment Description:</strong> <span id="preview_assignment_description"></span></div>
                    <div><strong>Due Date:</strong> <span id="preview_due_date"></span></div>
                    <div><strong>Attachment:</strong> <a href="#" id="preview_attachment" target="_blank">View Attachment</a></div>
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
            axios.get(`<?= base_url('admin/assignments/getAssignmentsForCourse') ?>/${course_id}`)
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

                axios.post(`<?= base_url('admin/assignments/removeAssignment') ?>/${courseId}/${assignmentId}`, {}, {
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

            axios.get('<?= base_url('admin/assignments/list') ?>', {
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


                // Clear the table before appending new data
                tbody.innerHTML = '';

                // Render the assignments
                assignments.forEach(assignment => {
                    const attachmentLink = assignment.attachment_path 
                        ? `<a href="${assignment.attachment_path}" target="_blank">Attachment</a>` 
                        : 'No attachment';
                    const row = `
                        <tr>
                            <td>${assignment.assignment_id}</td>
                            <td>${assignment.assignment_name}</td>
                            <td>${assignment.assignment_description}</td>
                            <td>${assignment.due_date ? new Date(assignment.due_date).toLocaleDateString() : 'No due date'}</td>
                            <td>${attachmentLink}</td>

                            <td>
                                <button class="btn btn-success btn-sm" onclick="openPreviewModal(${assignment.assignment_id})" data-toggle="modal" data-target="#previewassignmentModal">Preview</button>
                                <button class="btn btn-warning btn-sm" onclick="openEditModal(${assignment.assignment_id})" data-toggle="modal" data-target="#editassignmentModal">Edit</button>
                                <a href="<?= base_url('admin/assignments/delete/') ?>${assignment.assignment_id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this assignment?')">Delete</a>
                            </td>
                        </tr>
                    `;
                    tbody.insertAdjacentHTML('beforeend', row);
                });

                // Clear pagination and render new pages
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
            axios.get('<?= base_url('admin/assignments/list') ?>', {
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

                // Clear the table before appending new data
                tbody.innerHTML = '';

                // Render the assignments
                assignments.forEach(assignment => {
                    const attachmentLink = assignment.attachment_path 
                        ? `<a href="${assignment.attachment_path}" target="_blank">Attachment</a>` 
                        : 'No attachment';
                    const row = `
                        <tr>
                            <td>${assignment.assignment_id}</td>
                            <td>${assignment.assignment_name}</td>
                            <td>${assignment.assignment_description}</td>
                            <td>${assignment.due_date ? new Date(assignment.due_date).toLocaleDateString() : 'No due date'}</td>
                            <td>${attachmentLink}</td>

                            <td>
                                <button class="btn btn-success btn-sm" onclick="openPreviewModal(${assignment.assignment_id})" data-toggle="modal" data-target="#previewassignmentModal">Preview</button>
                                <button class="btn btn-warning btn-sm" onclick="openEditModal(${assignment.assignment_id})" data-toggle="modal" data-target="#editassignmentModal">Edit</button>
                                <a href="<?= base_url('admin/assignments/delete/') ?>${assignment.assignment_id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this assignment?')">Delete</a>
                            </td>
                        </tr>
                    `;
                    tbody.insertAdjacentHTML('beforeend', row);
                });

                // Clear pagination and render new pages
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
            axios.get('<?= base_url('admin/assignments/edit/') ?>' + assignmentId)
            .then(response => {
                const assignment = response.data.assignment;

                document.getElementById('edit_assignment_id').value = assignment.assignment_id;
                document.getElementById('edit_assignment_name').value = assignment.assignment_name;
                editEditorInstance.setData(assignment.assignment_description);
                document.getElementById('edit_due_date').value = assignment.due_date || '';

                $('#editassignmentModal').modal('show');
            })
            .catch(error => {
                console.error(error);
            });
        }


        // Open the Preview modal with assignment data
        function openPreviewModal(assignmentId) {
            axios.get('<?= base_url('admin/assignments/preview/') ?>' + assignmentId)
            .then(response => {
                const assignment = response.data.assignment;
                document.getElementById('preview_assignment_name').textContent = assignment.assignment_name;
                document.getElementById('preview_assignment_description').textContent = assignment.assignment_description;
                document.getElementById('preview_due_date').textContent = assignment.due_date || 'No due date';
            })
            .catch(error => console.error(error));
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

        // Wait until the DOM content is fully loaded
        document.addEventListener("DOMContentLoaded", function() {
            
            // Fetch the initial assignment counts and display badges
            fetchSubmissionCounts();

            // Fetch assignments data and render them in the table on initial load
            fetchAssignments();

            // Event listeners for search and sort functionality
            document.getElementById("searchSubmitted").addEventListener("input", fetchAssignments);
            document.getElementById("sortSubmitted").addEventListener("change", fetchAssignments);

            /**
             * Fetch submission counts for graded and ungraded assignments and update badges
             */
            function fetchSubmissionCounts() {
                fetch('assignments/getSubmissionCounts')
                    .then(response => response.json())
                    .then(data => {
                        const { ungradedCount, gradedCount } = data;
                        const ungradedBadge = document.getElementById("ungradedCount");
                        const gradedBadge = document.getElementById("gradedCount");

                        // Display the ungraded count only if there are ungraded submissions
                        if (ungradedCount > 0) {
                            ungradedBadge.textContent = ungradedCount;
                            ungradedBadge.style.display = 'inline-block';
                        } else {
                            ungradedBadge.style.display = 'none';
                        }

                        // Display the graded count only if there are graded submissions
                        if (gradedCount > 0) {
                            gradedBadge.textContent = gradedCount;
                            gradedBadge.style.display = 'inline-block';
                        } else {
                            gradedBadge.style.display = 'none';
                        }
                    })
                    .catch(error => console.error('Error fetching submission counts:', error));
            }

            /**
             * Fetch assignments based on search term and sort option, and render them in the table
             */
            function fetchAssignments() {
                const searchTerm = document.getElementById("searchSubmitted").value;
                const sortOption = document.getElementById("sortSubmitted").value;

                console.log("Fetching assignments with search term:", searchTerm);
                console.log("Sort option:", sortOption);

                fetch(`admin/assignments/getSubmittedAssignments?search=${encodeURIComponent(searchTerm)}&sort=${sortOption}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok: ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log("Fetched assignments data:", data);
                        renderAssignments(data);
                    })
                    .catch(error => {
                        console.error('Error fetching assignments:', error);
                    });
            }

            /**
             * Render assignments data into the table
             * @param {Array} assignments - Array of assignment objects
             */
            function renderAssignments(assignments) {
                const tableBody = document.getElementById("submittedAssignmentsTableBody");
                tableBody.innerHTML = ""; // Clear previous content

                if (assignments.length === 0) {
                    // If no assignments, show a message
                    tableBody.innerHTML = `<tr><td colspan="7" class="text-center">No assignments found</td></tr>`;
                    return;
                }

                assignments.forEach(assignment => {
                    const row = document.createElement("tr");

                    row.innerHTML = `
                        <td>${assignment.username}</td>
                        <td><a href="${assignment.file_path}" target="_blank">Attachment</a></td>
                        <td>${assignment.comments}</td>
                        <td>${assignment.course_name}</td>
                        <td>${new Date(assignment.submitted_at).toLocaleString()}</td>
                        <td id="grade-${assignment.submission_id}">${assignment.grade || 'Not graded'}</td>
                        <td>
                            <form id="updateGradeForm-${assignment.submission_id}" onsubmit="event.preventDefault(); updateGrade(${assignment.submission_id}, this)">
                                <input type="number" name="grade" class="form-control grade-input" placeholder="Enter grade" min="0" max="100" value="${assignment.grade || ''}" required>
                                <button type="submit" class="btn btn-primary btn-sm mt-1">Update</button>
                            </form>
                        </td>
                    `;

                    tableBody.appendChild(row);
                });

            }

         

        });

        function updateGrade(submissionId, formElement) {
            const formData = new FormData(formElement);

            fetch('admin/assignments/updateGrade', {
                method: 'POST',
                body: new URLSearchParams({
                    submission_id: submissionId,
                    grade: formData.get('grade')
                }),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Locate the grade cell and update its content
                    document.getElementById(`grade-${submissionId}`).innerText = formData.get('grade');
                    alert("Grade updated successfully.");
                } else {
                    alert("Failed to update grade: " + data.message);
                }
            })
            .catch(error => {
                console.error('Error updating grade:', error);
            });
        }








    </script>


</body>
</html>
