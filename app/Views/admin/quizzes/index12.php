<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(APPPATH . 'Views/admin/include/head.php'); ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <?php include(APPPATH . 'Views/admin/include/sidebar.php'); ?>
    <main id="main" class="main p-0">
        <?php include(APPPATH . 'Views/admin/include/nav2.php'); ?>
        <div class="container mt-2" id="mainContent">
            <div class="mb-3 font-weight-bold">QUIZ MANAGEMENT</div>
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createQuizModal">Create Quiz</button>

           <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" id="search" class="form-control" placeholder="Search quizzes...">
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
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Quiz Name</th>
                                <th>Quiz Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="quizTableBody">
                            <!-- Quizzes will be loaded here via JavaScript -->
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
    </main>
    
    <!-- Modal for Creating Quiz -->
    <div class="modal fade" id="createQuizModal" tabindex="-1" role="dialog" aria-labelledby="createQuizModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createQuizModalLabel">Create New Quiz</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="quizForm" action="<?= base_url('quizzes/store') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="quiz_name">Quiz Name</label>
                            <input type="text" id="quiz_name" name="quiz_name" class="form-control" value="<?= old('quiz_name') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="quiz_description">Description</label>
                            <textarea id="quiz_description" name="quiz_description" class="form-control" rows="4"><?= old('quiz_description') ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Quiz</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Quiz -->
    <div class="modal fade" id="editQuizModal" tabindex="-1" role="dialog" aria-labelledby="editQuizModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editQuizModalLabel">Edit Quiz</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editQuizForm" action="<?= base_url('quizzes/update') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" id="edit_quiz_id" name="quiz_id">
                        <div class="form-group">
                            <label for="edit_quiz_name">Quiz Name</label>
                            <input type="text" id="edit_quiz_name" name="quiz_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_quiz_description">Description</label>
                            <textarea id="edit_quiz_description" name="quiz_description" class="form-control" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Quiz</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let editorInstance;
        let editEditorInstance;
        let isFormDirty = false;

        document.addEventListener('DOMContentLoaded', function() {
            ClassicEditor
                .create(document.querySelector('#quiz_description'))
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
                .create(document.querySelector('#edit_quiz_description'))
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

            document.getElementById('quizForm').addEventListener('submit', function() {
                if (editorInstance) {
                    document.getElementById('quiz_description').value = editorInstance.getData();
                }
                isFormDirty = false; // Reset the form dirty flag on submit
            });

            document.getElementById('editQuizForm').addEventListener('submit', function() {
                if (editEditorInstance) {
                    document.getElementById('edit_quiz_description').value = editEditorInstance.getData();
                }
                isFormDirty = false; // Reset the form dirty flag on submit
            });

            loadQuizzes();

            document.getElementById('search').addEventListener('input', loadQuizzes);
            document.getElementById('sort').addEventListener('change', loadQuizzes);
        });

        function loadQuizzes() {
            const search = document.getElementById('search').value;
            const sort = document.getElementById('sort').value;

            axios.get('<?= base_url('quizzes/list') ?>', {
                params: {
                    search: search,
                    sort: sort
                }
            })
            .then(response => {
                const quizzes = response.data.quizzes;
                const pagination = response.data.pagination;
                const tbody = document.getElementById('quizTableBody');
                const paginationElem = document.getElementById('pagination');

                tbody.innerHTML = '';
                quizzes.forEach(quiz => {
                    const row = `
                        <tr>
                            <td>${quiz.quiz_id}</td>
                            <td>${quiz.quiz_name}</td>
                            <td>${quiz.quiz_description}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="openEditModal(${quiz.quiz_id})" data-toggle="modal" data-target="#editQuizModal">Edit</button>
                                <a href="<?= base_url('quizzes/delete/') ?>${quiz.quiz_id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Quiz?')">Delete</a>
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
            axios.get('<?= base_url('quizzes/list') ?>', {
                params: {
                    search: document.getElementById('search').value,
                    sort: document.getElementById('sort').value,
                    page: page
                }
            })
            .then(response => {
                const quizzes = response.data.quizzes;
                const pagination = response.data.pagination;
                const tbody = document.getElementById('quizTableBody');
                const paginationElem = document.getElementById('pagination');

                tbody.innerHTML = '';
                quizzes.forEach(quiz => {
                    const row = `
                        <tr>
                            <td>${quiz.quiz_id}</td>
                            <td>${quiz.quiz_name}</td>
                            <td>${quiz.quiz_description}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="openEditModal(${quiz.quiz_id})" data-toggle="modal" data-target="#editQuizModal">Edit</button>
                                <a href="<?= base_url('quizzes/delete/') ?>${quiz.quiz_id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Quiz?')">Delete</a>
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

        function openEditModal(quizId) {
            axios.get('<?= base_url('quizzes/edit/') ?>' + quizId)
            .then(response => {
                const quiz = response.data.quiz;

                document.getElementById('edit_quiz_id').value = quiz.quiz_id;
                document.getElementById('edit_quiz_name').value = quiz.quiz_name;
                editEditorInstance.setData(quiz.quiz_description);

                $('#editQuizModal').modal('show');
            })
            .catch(error => {
                console.error(error);
            });
        }

        $('#createQuizModal').on('hide.bs.modal', function(e) {
            if (isFormDirty) {
                if (!confirm('You have unsaved changes. Are you sure you want to close the modal?')) {
                    e.preventDefault();
                } else {
                    isFormDirty = false;
                }
            }
        });

        $('#editQuizModal').on('hide.bs.modal', function(e) {
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
