<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(APPPATH . 'Views/admin/include/head.php'); ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include(APPPATH . 'Views/admin/include/sidebar.php'); ?>
    <main id="main" class="main p-0">
        <?php include(APPPATH . 'Views/admin/include/nav2.php'); ?>
        <div class="container mt-2" id="mainContent">
            <div class="mb-3 font-weight-bold">Quiz Management</div>
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createQuizModal">Create Quiz</button>
            
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
                        <tbody>
                            <?php foreach($quizzes as $quiz): ?>
                            <tr>
                                <td><?= $quiz['quiz_id'] ?></td>
                                <td><?= $quiz['quiz_name'] ?></td>
                                <td><?= $quiz['quiz_description'] ?></td>
                                <td>
                                    <a href="<?= base_url('quizzes/edit/'.$quiz['quiz_id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= base_url('quizzes/delete/'.$quiz['quiz_id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Quiz?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
                    <form action="<?= base_url('quizzes/store') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="quiz_name">Quiz Name</label>
                            <input type="text" id="quiz_name" name="quiz_name" class="form-control" value="<?= old('quiz_name') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="quiz_description">Description</label>
                            <textarea id="quiz_description" name="quiz_description" class="form-control" rows="4" required><?= old('quiz_description') ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Quiz</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php //include(APPPATH . 'Views/admin/include/js.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // CKEDITOR.replace('quiz_description');
        if (!editorInstance) {
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
    }
    </script>
    <!-- Script to handle unsaved changes warning -->
    <script>
        let isFormDirty = false;

        document.getElementById('quizForm').addEventListener('input', function() {
            isFormDirty = true;
        });

        document.getElementById('addQuizBtn').addEventListener('click', function() {
            // Clear CKEditor content from textarea to get the latest data
            document.getElementById('quiz_description').value =  editorInstance['quiz_description'].getData();
        });

        window.addEventListener('beforeunload', function(event) {
            if (isFormDirty) {
                event.preventDefault();
                event.returnValue = '';
            }
        });

        $('#createQuizModal').on('hide.bs.modal', function(e) {
            if (isFormDirty) {
                if (!confirm('You have unsaved changes. Are you sure you want to close the modal?')) {
                    e.preventDefault();
                } else {
                    // Clear the form dirty flag
                    isFormDirty = false;
                }
            }
        });
    </script>

</body>
</html>
