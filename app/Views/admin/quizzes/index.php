
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

</style>

</head>
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
            <div class="mb-3 font-weight-bold">QUIZ MANAGEMENT</div>
            <!-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createQuizModal">Create Quiz</button> -->


            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="quizTabs" role="tablist">
                <li class="nav-item">
                    <a class="btn nav-link btn-primary shadow bg-primary" id="add-quiz-tab" data-toggle="modal" data-target="#createQuizModal" role="tab"
                        aria-controls="add-quiz" aria-selected="false">ADD QUIZ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="quiz-bank-tab" data-toggle="tab" href="#quiz-bank" role="tab"
                        aria-controls="quiz-bank" aria-selected="true">Quiz Lists</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="add-bulk-quiz-tab" data-toggle="tab" href="#add-bulk-quiz" role="tab"
                        aria-controls="bulk-quiz" aria-selected="false">Upload Bulk quiz</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="export-quiz-tab" data-toggle="tab" href="#export-quiz" role="tab"
                        aria-controls="export-quiz" aria-selected="false">Export Quiz</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="assign-quizzes-tab" data-toggle="tab" href="#assign-quizzes" role="tab"
                        aria-controls="assign-quiz" aria-selected="false">Assign Quiz</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="quiz-settings-tab" data-toggle="tab" href="#quiz-settings" role="tab"
                        aria-controls="quiz-settings" aria-selected="false">Settings</a>
                </li>
            </ul>


            <!-- Tab Content -->
            <div class="tab-content" id="questionTabsContent">
                <!-- Display validation errors if any -->
                <?php if (session()->has('message')) : ?>
                    <?= view('include/message') ?>
                <?php endif ?>

                <!-- Question Bank Tab -->
                <div class="tab-pane fade show active" id="quiz-bank" role="tabpanel"
                    aria-labelledby="quiz-bank-tab">
                    <div class="row my-2">
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

                <!-- Bulk Upload Section -->
                <div class="tab-pane fade" id="add-bulk-quiz" role="tabpanel" aria-labelledby="add-bulk-quiz-tab">
                    
                    <form id="bulkUploadForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="quizzes_file">Upload Quiz File (CSV/Excel)</label>
                            <input type="file" id="quizzes_file" name="quizzes_file" class="form-control" accept=".csv, .xlsx" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>

                </div>

                <!-- Export to CSV -->
                <div class="tab-pane fade" id="export-quiz" role="tabpanel" aria-labelledby="export-quiz-tab">
                    <form action="<?= base_url('admin/quizzes/exportQuizzes') ?>" method="post">
                        <div class="form-group">
                            <label for="quiz_id">Select Quiz</label>
                            <select id="quiz_id" name="quiz_id" class="form-control">
                                <option value="">All Quizzes</option>
                                <?php if (!empty($quizzes)): ?>
                                    <?php foreach ($quizzes as $quiz): ?>
                                        <option value="<?= $quiz['quiz_id'] ?>"><?= $quiz['quiz_name'] ?></option>
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
               <!-- Assign Quizzes to Course --> <!-- Assign Quizzes to Course -->
                <div class="tab-pane fade mt-2" id="assign-quizzes" role="tabpanel" aria-labelledby="assign-quizzes-tab">
                    <form id="assignQuizzesForm" action="<?= base_url('admin/quizzes/assignQuizzes') ?>" method="post">
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
                        <div id="quizSection"></div>
                    </form>
                </div>

                <!-- Quiz Settings -->
                <div class="tab-pane fade mt-2" id="quiz-settings" role="tabpanel" aria-labelledby="quiz-settings-tab">
                    <form id="quizSettingsForm" action="<?= base_url('admin/quizzes/updateSettings') ?>" method="post">
                        <!-- Select Quiz -->
                        <div class="form-group">
                            <label for="quiz_id">Select Quiz</label>
                            <select id="settingQuizId" name="quiz_id" class="form-control" required>
                                <!-- Populate with existing quizzes -->
                                <?php foreach ($quizzes as $quiz): ?>
                                    <option value="<?= $quiz['quiz_id'] ?>"><?= $quiz['quiz_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Quiz Name -->
                        <div class="form-group">
                            <label for="quiz_name">Quiz Name</label>
                            <input type="text" id="quiz_name" name="quiz_name" class="form-control" required>
                        </div>

                        <!-- Quiz Description -->
                        <div class="form-group">
                            <label for="quiz_description">Quiz Description</label>
                            <textarea id="quiz_description" name="quiz_description" class="form-control"></textarea>
                        </div>

                        <!-- Total Marks -->
                        <div class="form-group">
                            <label for="total_marks">Total Marks</label>
                            <input type="number" id="total_marks" name="total_marks" class="form-control" placeholder="Enter total marks">
                        </div>

                        <!-- Duration -->
                        <div class="form-group">
                            <label for="duration">Duration (minutes)</label>
                            <input type="number" id="duration" name="duration" class="form-control" placeholder="Enter time limit in minutes">
                        </div>

                        <!-- Passing Score -->
                        <div class="form-group">
                            <label for="passing_score">Passing Score (%)</label>
                            <input type="number" id="passing_score" name="passing_score" class="form-control" placeholder="Enter passing score percentage">
                        </div>

                        <!-- Max Attempts -->
                        <div class="form-group">
                            <label for="max_attempts">Max Attempts</label>
                            <input type="number" id="max_attempts" name="max_attempts" class="form-control" placeholder="Enter maximum attempts allowed">
                        </div>

                        <!-- Quiz Status -->
                        <div class="form-group">
                            <label for="is_active">Quiz Status</label>
                            <select id="is_active" name="is_active" class="form-control">
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>

                        <!-- Start Date -->
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" id="start_date" name="start_date" class="form-control">
                        </div>

                        <!-- End Date -->
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" id="end_date" name="end_date" class="form-control">
                        </div>

                        <!-- Shuffle Questions -->
                        <div class="form-group">
                            <label for="shuffle_questions">Shuffle Questions</label>
                            <input type="checkbox" id="shuffle_questions" name="shuffle_questions" value="1">
                        </div>

                        <!-- Shuffle Answers -->
                        <div class="form-group">
                            <label for="shuffle_answers">Shuffle Answers</label>
                            <input type="checkbox" id="shuffle_answers" name="shuffle_answers" value="1">
                        </div>

                        <!-- Published Status -->
                        <div class="form-group">
                            <label for="published">Published</label>
                            <input type="checkbox" id="published" name="published" value="1">
                        </div>

                        <!-- Access Code -->
                        <div class="form-group">
                            <label for="access_code">Access Code (if required)</label>
                            <input type="text" id="access_code" name="access_code" class="form-control" placeholder="Enter access code">
                        </div>

                        <!-- Quiz Type -->
                        <div class="form-group">
                            <label for="quiz_type">Quiz Type</label>
                            <select id="quiz_type" name="quiz_type" class="form-control">
                                <option value="graded">Graded</option>
                                <option value="practice">Practice</option>
                            </select>
                        </div>

                        <!-- Attempt Mode -->
                        <div class="form-group">
                            <label for="attempt_mode">Attempt Mode</label>
                            <select id="attempt_mode" name="attempt_mode" class="form-control">
                                <option value="single">Single Attempt</option>
                                <option value="multiple">Multiple Attempts</option>
                            </select>
                        </div>

                        <!-- Retake Delay (hours) -->
                        <div class="form-group">
                            <label for="retake_delay">Retake Delay (hours)</label>
                            <input type="number" id="retake_delay" name="retake_delay" class="form-control" placeholder="Delay between attempts">
                        </div>

                        <!-- Allow Review -->
                        <div class="form-group">
                            <label for="allow_review">Allow Review</label>
                            <input type="checkbox" id="allow_review" name="allow_review" value="1">
                        </div>

                        <!-- Feedback Enabled -->
                        <div class="form-group">
                            <label for="feedback_enabled">Feedback Enabled</label>
                            <input type="checkbox" id="feedback_enabled" name="feedback_enabled" value="1">
                        </div>

                        <!-- Feedback Message -->
                        <div class="form-group">
                            <label for="feedback_message">Feedback Message</label>
                            <textarea id="feedback_message" name="feedback_message" class="form-control" placeholder="Enter feedback message"></textarea>
                        </div>

                        

                    

                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </form>
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
                    <form id="quizForm" action="<?= base_url('admin/quizzes/store') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="quiz_name">Quiz Name</label>
                            <input type="text" id="quiz_name" name="quiz_name" class="form-control" value="<?= old('quiz_name') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="quiz_description">Description</label>
                            <textarea id="quiz_description" name="quiz_description" class="form-control" rows="4"><?= old('quiz_description') ?></textarea>
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
                            <label for="quiz_type">Quiz Type</label>
                            <select name="quiz_type" id="quiz_type" class="form-control">
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
                    <form id="editQuizForm" action="<?= base_url('admin/quizzes/update') ?>" method="post">
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
    <!-- Modal for Editing Quiz -->
    <div class="modal fade" id="previewQuizModal" tabindex="-1" role="dialog" aria-labelledby="previewQuizModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewQuizModalLabel">Edit Quiz</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>Quiz Name: Babados afana</div>
                    <div>Quiz Description: ajalarusure</div>
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
                        fetchQuizzesForCourse(course_id);
                    }
                });
            });

            function fetchQuizzesForCourse(course_id) {
                axios.get(`<?= base_url('admin/quizzes/getQuizzesForCourse') ?>/${course_id}`)
                    .then(response => {
                        var quizzes = response.data.assignedQuizzes;
                        var availableQuizzes = response.data.allQuizzes;
                        var quizSection = $('#quizSection');

                        quizSection.empty();

                        var availableQuizzesHtml = `
                        
                            <div class="form-group">
                                <label for="quiz_ids">Select Quizzes to Assign</label>
                                <select id="quiz_ids" name="quizzes[]" class="form-control" multiple="multiple" required>
                                    ${availableQuizzes.map(quiz => `<option value="${quiz.quiz_id}">${quiz.quiz_name}</option>`).join('')}
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Assign Quizzes</button>`;

                        quizSection.append(availableQuizzesHtml);

                        $('#quiz_ids').select2();

                        if (quizzes.length > 0) {
                            var tableHtml = `
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Quiz Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>`;

                            quizzes.forEach(quiz => {
                                tableHtml += `
                                    <tr>
                                        <td>${quiz.quiz_name}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeQuizFromCourse(${course_id}, ${quiz.quiz_id})">Remove</button>
                                        </td>
                                    </tr>`;
                            });

                            tableHtml += `
                                    </tbody>
                                </table>`;

                            quizSection.append(tableHtml);
                        } else {
                            quizSection.append('<p>No quizzes assigned to this course. Please assign quizzes.</p>');
                        }

                    
                    })
                    .catch(error => {
                        console.error('Error fetching quizzes for course:', error);
                    });
            }

        
            function removeQuizFromCourse(courseId, quizId) {
    if (confirm('Are you sure you want to remove this quiz from the course?')) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (!csrfToken) {
            console.error('CSRF token not found.');
            return;
        }

        axios.post(`<?= base_url('admin/quizzes/removeQuiz') ?>/${courseId}/${quizId}`, {}, {
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => {
            console.log(response.data); // Log response for debugging
            if (response.data.status === 'success') {
                alert(response.data.message);
                fetchQuizzesForCourse(courseId); // Refresh the list
            } else {
                alert(response.data.message);
            }
        })
        .catch(error => {
            console.error('Error removing quiz from course:', error);
        });
    }
}






        
        
        
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

            axios.get('<?= base_url('admin/quizzes/list') ?>', {
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
                                <button class="btn btn-success btn-sm" onclick="openPreviewModal(${quiz.quiz_id})" data-toggle="modal" data-target="#previewQuizModal">Preview</button>
                                <button class="btn btn-warning btn-sm" onclick="openEditModal(${quiz.quiz_id})" data-toggle="modal" data-target="#editQuizModal">Edit</button>
                                <a href="<?= base_url('admin/quizzes/delete/') ?>${quiz.quiz_id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Quiz?')">Delete</a>
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
            axios.get('<?= base_url('admin/quizzes/list') ?>', {
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
                                <a href="<?= base_url('admin/quizzes/delete/') ?>${quiz.quiz_id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Quiz?')">Delete</a>
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
            axios.get('<?= base_url('admin/quizzes/edit/') ?>' + quizId)
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



        document.getElementById('settingQuizId').addEventListener('change', function () {
    let quizId = this.value;
    // let quizId = 1;

    if (quizId) {
        fetch(`<?= base_url('admin/quizzes/getQuizSettings/') ?>${quizId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Fetched quiz data:', data);  // Log fetched data
                if (data) {
                    document.getElementById('quiz_name').value = data.quiz_name || '';
                    document.getElementById('quiz_description').value = data.quiz_description || '';
                    document.getElementById('total_marks').value = data.total_marks || '';
                    document.getElementById('duration').value = data.duration || '';
                    document.getElementById('passing_score').value = data.passing_score || '';
                    document.getElementById('max_attempts').value = data.max_attempts || '';
                    document.getElementById('is_active').checked = data.is_active == 1;
                    document.getElementById('start_date').value = data.start_date || '';
                    document.getElementById('end_date').value = data.end_date || '';
                    document.getElementById('shuffle_questions').checked = data.shuffle_questions == 1;
                    document.getElementById('shuffle_answers').checked = data.shuffle_answers == 1;
                    document.getElementById('published').checked = data.published == 1;
                    document.getElementById('access_code').value = data.access_code || '';
                    document.getElementById('quiz_type').value = data.quiz_type || 'graded';
                    document.getElementById('attempt_mode').value = data.attempt_mode || 'single';
                    document.getElementById('retake_delay').value = data.retake_delay || '';
                    document.getElementById('allow_review').checked = data.allow_review == 1;
                    document.getElementById('feedback_enabled').checked = data.feedback_enabled == 1;
                    document.getElementById('feedback_message').value = data.feedback_message || '';
                    document.getElementById('category_id').value = data.category_id || '';
                    document.getElementById('course_id').value = data.course_id || '';
                }
            })
            .catch(error => console.error('Error fetching quiz settings:', error));
    }
});


document.getElementById('bulkUploadForm').addEventListener('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    axios.post('<?= base_url('admin/quizzes/bulkUpload') ?>', formData)
        .then(response => {
            if (response.data.success) {
                alert(response.data.success);
                // Reload the list of quizzes or update UI as needed
            } else {
                alert('Error: ' + response.data.error);
            }
        })
        .catch(error => {
            console.error('An error occurred:', error);
        });
});



    </script>


</body>
</html>
