<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(APPPATH . 'Views/admin/include/head.php'); ?>
    <title>Materials Management | LearnXa</title>
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
            <div class="mb-3 font-weight-bold">MATERIAL MANAGEMENT</div>
            <!-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createMaterialModal">Create Material</button> -->


            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="materialTabs" role="tablist">
                <li class="nav-item">
                    <a class="btn nav-link" id="add-material-tab" data-toggle="modal" data-target="#createMaterialModal" role="tab"
                        aria-controls="add-material" aria-selected="false">ADD Material</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="material-bank-tab" data-toggle="tab" href="#material-bank" role="tab"
                        aria-controls="material-bank" aria-selected="true">Material Lists</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="add-bulk-material-tab" data-toggle="tab" href="#add-bulk-material" role="tab"
                        aria-controls="bulk-material" aria-selected="false">Upload Bulk Material</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="export-material-tab" data-toggle="tab" href="#export-material" role="tab"
                        aria-controls="export-material" aria-selected="false">Export Material</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="assign-materials-tab" data-toggle="tab" href="#assign-materials" role="tab"
                        aria-controls="assign-material" aria-selected="false">Assign Material</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="material-settings-tab" data-toggle="tab" href="#material-settings" role="tab"
                        aria-controls="material-settings" aria-selected="false">Settings</a>
                </li>
            </ul>


            <!-- Tab Content -->
            <div class="tab-content" id="questionTabsContent">
                <!-- Display validation errors if any -->
                <?php if (session()->has('message')) : ?>
                    <?= view('include/message') ?>
                <?php endif ?>

                <!-- Question Bank Tab -->
                <div class="tab-pane fade show active" id="material-bank" role="tabpanel"
                    aria-labelledby="material-bank-tab">
                    <div class="row my-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" id="search" class="form-control" placeholder="Search Materials...">
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
                                        <th>Material Name</th>
                                        <th>Material Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="materialTableBody">
                                    <!-- Materials will be loaded here via JavaScript -->
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
                <div class="tab-pane fade" id="add-bulk-material" role="tabpanel" aria-labelledby="add-bulk-material-tab">
                    
                    <form id="bulkUploadForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="material_file">Upload Material File (CSV/Excel)</label>
                            <input type="file" id="material_file" name="material_file" class="form-control" accept=".csv, .xlsx" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>

                <!-- Export to CSV -->
                <div class="tab-pane fade" id="export-material" role="tabpanel" aria-labelledby="export-material-tab">
                    <form action="<?= base_url('admin/materials/exportMaterials') ?>" method="post">
                        <div class="form-group">
                            <label for="material_id">Select Material</label>
                            <select id="material_id" name="material_id" class="form-control">
                                <option value="">All Materials</option>
                                <?php if (!empty($materials)): ?>
                                    <?php foreach ($materials as $material): ?>
                                        <option value="<?= $material['material_id'] ?>"><?= $material['material_name'] ?></option>
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
               <!-- Assign Materials to Course --> <!-- Assign Materials to Course -->
                <div class="tab-pane fade mt-2" id="assign-materials" role="tabpanel" aria-labelledby="assign-materials-tab">
                    <form id="assignMaterialsForm" action="<?= base_url('admin/materials/assignMaterials') ?>" method="post">
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
                        <div id="materialSection"></div>
                    </form>
                </div>



                <!-- Material Settings -->
                <div class="tab-pane fade mt-2" id="material-settings" role="tabpanel" aria-labelledby="material-settings-tab">
                    <form id="materialSettingsForm" action="<?= base_url('admin/materials/updateSettings') ?>" method="post">
                        <!-- Select Material -->
                        <div class="form-group">
                            <label for="material_id">Select Material</label>
                            <select id="material_id" name="material_id" class="form-control">
                                <!-- Populate with existing Materials -->
                                <?php foreach ($materials as $material): ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <!-- Material Status -->
                        <div class="form-group">
                            <label for="material_status">Material Status</label>
                            <select id="material_status" name="material_status" class="form-control">
                                <option value="not_published">Not Published (Hidden)</option>
                                <option value="unlocked">Unlocked (Early Access)</option>
                                <option value="published">Published (Publicly Visible)</option>
                            </select>
                        </div>
                        
                        <!-- Assign Material and Dates -->
                        <div class="form-group">
                            <label for="assign_material_dates">Assign Material and Dates</label>
                            <input type="text" id="assign_material_dates" name="assign_material_dates" class="form-control" placeholder="Enter course and date details">
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
    
    <!-- Modal for Creating Material -->
    <div class="modal fade" id="createMaterialModal" tabindex="-1" role="dialog" aria-labelledby="createMaterialModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createMaterialModalLabel">Create New Material</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="materialForm" action="<?= base_url('admin/materials/store') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="material_name">Material Name</label>
                            <input type="text" id="material_name" name="material_name" class="form-control" value="<?= old('material_name') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="material_description">Description</label>
                            <textarea id="material_description" name="material_description" class="form-control" rows="4"><?= old('material_description') ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="material_file">Upload Material File</label>
                            <input type="file" id="materialFile" name="material_file" class="form-control" accept=".csv, .xlsx, .pdf, .docs, .docx, .txt, .jpg, .jpeg, .png" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Material</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Material -->
    <div class="modal fade" id="editMaterialModal" tabindex="-1" role="dialog" aria-labelledby="editMaterialModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMaterialModalLabel">Edit Material</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editMaterialForm" action="<?= base_url('admin/materials/update') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" id="edit_material_id" name="material_id">
                        <div class="form-group">
                            <label for="edit_material_name">Material Name</label>
                            <input type="text" id="edit_material_name" name="material_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_material_description">Description</label>
                            <textarea id="edit_material_description" name="material_description" class="form-control" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Material</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Editing Material -->
    <div class="modal fade" id="previewMaterialModal" tabindex="-1" role="dialog" aria-labelledby="previewMaterialModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewMaterialModalLabel">Edit Material</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>Material Name: Babados afana</div>
                    <div>Material Description: ajalarusure</div>
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
                        fetchMaterialsForCourse(course_id);
                    }
                });
            });

            function fetchMaterialsForCourse(course_id) {
                axios.get(`<?= base_url('admin/materials/getMaterialsForCourse') ?>/${course_id}`)
                    .then(response => {
                        var Materials = response.data.assignedmaterials;
                        var availableMaterials = response.data.allmaterials;
                        var MaterialSection = $('#materialSection');

                        MaterialSection.empty();

                        var availableMaterialsHtml = `
                        
                            <div class="form-group">
                                <label for="material_ids">Select Materials to Assign</label>
                                <select id="material_ids" name="materials[]" class="form-control" multiple="multiple" required>
                                    ${availableMaterials.map(material => `<option value="${material.material_id}">${material.material_name}</option>`).join('')}
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Assign Materials</button>`;

                        MaterialSection.append(availableMaterialsHtml);

                        $('#material_ids').select2();

                        if (Materials.length > 0) {
                            var tableHtml = `
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Material Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>`;

                            Materials.forEach(material => {
                                tableHtml += `
                                    <tr>
                                        <td>${material.material_name}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeMaterialFromCourse(${course_id}, ${material.material_id})">Remove</button>
                                        </td>
                                    </tr>`;
                            });

                            tableHtml += `
                                    </tbody>
                                </table>`;

                            MaterialSection.append(tableHtml);
                        } else {
                            MaterialSection.append('<p>No Materials assigned to this course. Please assign Materials.</p>');
                        }

                    
                    })
                    .catch(error => {
                        console.error('Error fetching Materials for course:', error);
                    });
            }

        
            function removeMaterialFromCourse(courseId, MaterialId) {
                if (confirm('Are you sure you want to remove this Material from the course?')) {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    if (!csrfToken) {
                        console.error('CSRF token not found.');
                        return;
                    }

                    axios.post(`<?= base_url('admin/materials/removeMaterial') ?>/${courseId}/${materialId}`, {}, {
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => {
                        console.log(response.data); // Log response for debugging
                        if (response.data.status === 'success') {
                            alert(response.data.message);
                            fetchMaterialsForCourse(courseId); // Refresh the list
                        } else {
                            alert(response.data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error removing Material from course:', error);
                    });
                }
            }




        
        
        let editorInstance;
        let editEditorInstance;
        let isFormDirty = false;


        document.addEventListener('DOMContentLoaded', function() {


            ClassicEditor
                .create(document.querySelector('#material_description'))
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
                .create(document.querySelector('#edit_material_description'))
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

            document.getElementById('materialForm').addEventListener('submit', function() {
                if (editorInstance) {
                    document.getElementById('material_description').value = editorInstance.getData();
                }
                isFormDirty = false; // Reset the form dirty flag on submit
            });

            document.getElementById('editMaterialForm').addEventListener('submit', function() {
                if (editEditorInstance) {
                    document.getElementById('edit_material_description').value = editEditorInstance.getData();
                }
                isFormDirty = false; // Reset the form dirty flag on submit
            });

            loadMaterials();

            document.getElementById('search').addEventListener('input', loadMaterials);
            document.getElementById('sort').addEventListener('change', loadMaterials);
        });

        function loadMaterials() {
            const search = document.getElementById('search').value;
            const sort = document.getElementById('sort').value;

            axios.get('<?= base_url('admin/admin/materials/list') ?>', {
                params: {
                    search: search,
                    sort: sort
                }
            })
            .then(response => {
                const Materials = response.data.materials;
                const pagination = response.data.pagination;
                const tbody = document.getElementById('materialTableBody');
                const paginationElem = document.getElementById('pagination');

                tbody.innerHTML = '';
                Materials.forEach(material => {
                    const row = `
                        <tr>
                            <td>${material.material_id}</td>
                            <td>${material.material_name}</td>
                            <td>${material.material_description}</td>
                            <td>
                                <button class="btn btn-success btn-sm" onclick="openPreviewModal(${material.material_id})" data-toggle="modal" data-target="#previewMaterialModal">Preview</button>
                                <button class="btn btn-warning btn-sm" onclick="openEditModal(${material.material_id})" data-toggle="modal" data-target="#editMaterialModal">Edit</button>
                                <a href="<?= base_url('admin/materials/delete/') ?>${material.material_id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Material?')">Delete</a>
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
            axios.get('<?= base_url('admin/materials/list') ?>', {
                params: {
                    search: document.getElementById('search').value,
                    sort: document.getElementById('sort').value,
                    page: page
                }
            })
            .then(response => {
                const Materials = response.data.materials;
                const pagination = response.data.pagination;
                const tbody = document.getElementById('materialTableBody');
                const paginationElem = document.getElementById('pagination');

                tbody.innerHTML = '';
                Materials.forEach(material => {
                    const row = `
                        <tr>
                            <td>${material.material_id}</td>
                            <td>${material.material_name}</td>
                            <td>${material.material_description}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="openEditModal(${material.material_id})" data-toggle="modal" data-target="#editMaterialModal">Edit</button>
                                <a href="<?= base_url('admin/materials/delete/') ?>${material.material_id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Material?')">Delete</a>
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

        function openEditModal(materialId) {
            axios.get('<?= base_url('admin/materials/edit/') ?>' + MaterialId)
            .then(response => {
                const Material = response.data.material;

                document.getElementById('edit_material_id').value = Material.material_id;
                document.getElementById('edit_material_name').value = Material.material_name;
                editEditorInstance.setData(material.material_description);

                $('#editMaterialModal').modal('show');
            })
            .catch(error => {
                console.error(error);
            });
        }

        $('#createMaterialModal').on('hide.bs.modal', function(e) {
            if (isFormDirty) {
                if (!confirm('You have unsaved changes. Are you sure you want to close the modal?')) {
                    e.preventDefault();
                } else {
                    isFormDirty = false;
                }
            }
        });

        $('#editMaterialModal').on('hide.bs.modal', function(e) {
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
