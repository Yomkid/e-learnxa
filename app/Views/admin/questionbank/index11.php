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
            <div class="mb-3 font-weight-bold">QUESTION BANK MANAGEMENT</div>

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="questionTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="question-bank-tab" data-toggle="tab" href="#question-bank" role="tab"
                        aria-controls="question-bank" aria-selected="true">Question Bank</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="add-question-tab" data-toggle="tab" href="#add-question" role="tab"
                        aria-controls="add-question" aria-selected="false">Add Question</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="add-bulk-question-tab" data-toggle="tab" href="#add-bulk-question" role="tab"
                        aria-controls="add-question" aria-selected="false">Upload Bulk Question</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="add-multi-question-tab" data-toggle="tab" href="#add-multi-question" role="tab"
                        aria-controls="add-question" aria-selected="false">Add Multiple Questions</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="questionTabsContent">
                <!-- Question Bank Tab -->
                <div class="tab-pane fade show active" id="question-bank" role="tabpanel"
                    aria-labelledby="question-bank-tab">
                    <!-- Search and Filter -->
                    <div class="row my-3">
                        <div class="col-md-6">
                            <input type="text" id="search" class="form-control mb-2" placeholder="Search questions...">
                        </div>
                        <div class="col-md-6">
                            <select id="sort" class="form-control">
                                <option value="">Sort by...</option>
                                <option value="name">Name</option>
                                <option value="date">Date Added</option>
                            </select>
                        </div>
                    </div>

                    <!-- Questions List -->
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Question</th>
                                        <th>Options</th>
                                        <th>Answer</th>
                                        <th>Explanation</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="questionTableBody">
                                    <!-- Dynamic content will be loaded here -->
                                </tbody>
                            </table>
                            <ul id="pagination" class="pagination">
                                <!-- Pagination will be loaded here -->
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Add Question Tab -->
                <div class="tab-pane fade" id="add-question" role="tabpanel" aria-labelledby="add-question-tab">
                    <div class="mb-3">
                        <h5>Add New Question</h5>
                        <form id="addQuestionForm">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="quiz_id_bulk">Select Quiz</label>
                                <select id="quiz_id" name="quiz_id" class="form-control" required>
                                    <option value="">Select Quiz</option>
                                    <?php if (!empty($quizzes)): ?>
                                        <?php foreach ($quizzes as $quiz): ?>
                                            <option value="<?= $quiz['quiz_id'] ?>"><?= $quiz['quiz_name'] ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="question_text">Question</label>
                                <input type="text" id="question_text" name="question_text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="option_a">Option A</label>
                                <input type="text" id="option_a" name="option_a" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="option_b">Option B</label>
                                <input type="text" id="option_b" name="option_b" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="option_c">Option C</label>
                                <input type="text" id="option_c" name="option_c" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="option_d">Option D</label>
                                <input type="text" id="option_d" name="option_d" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="correct_answer">Correct Answer</label>
                                <select id="correct_answer" name="correct_answer" class="form-control" required>
                                    <option value="">Select Correct Answer</option>
                                    <option value="option_a">A</option>
                                    <option value="option_b">B</option>
                                    <option value="option_c">C</option>
                                    <option value="option_d">D</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="explanation">Explanation</label>
                                <textarea id="explanation" name="explanation" class="form-control" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Question</button>
                        </form>
                    </div>
                </div>


                <!-- Bulk Upload Section -->
                <div class="tab-pane fade" id="add-bulk-question" role="tabpanel" aria-labelledby="add-question-tab">
                    <div class="mb-3">
                        <h5>Upload Questions in Bulk</h5>
                        <form id="uploadForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="quiz_id_bulk">Select Quiz</label>
                                <select id="quiz_id_bulk" name="quiz_id" class="form-control" required>
                                    <!-- Populate this dropdown with quizzes -->
                                </select>
                            </div>
                            <input type="file" id="fileUpload" name="file" class="form-control mb-2" accept=".csv, .xlsx">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                        <div id="bulkUploadPagination"></div>
                    </div>
                </div>


                <!-- Multi-Question Upload Section -->
                <div class="tab-pane fade" id="add-multi-question" role="tabpanel" aria-labelledby="add-multi-question-tab">
                    <div class="form-group">
                        <label for="quiz_id">Select Quiz</label>
                        <select id="quizId" name="quiz_id" class="form-control" required>
                            <option value="">Select Quiz</option>
                            <?php if (!empty($quizzes)): ?>
                                <?php foreach ($quizzes as $quiz): ?>
                                    <option value="<?= $quiz['quiz_id'] ?>"><?= $quiz['quiz_name'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="accordion" id="multiQuestionAccordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Add Multiple Questions
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#multiQuestionAccordion">
                                <div class="card-body">
                                    <form id="multiQuestionForm">
                                        <div id="questionsContainer">
                                            <!-- Dynamic question forms will be appended here -->
                                        </div>
                                        <button type="button" class="btn btn-secondary" id="addQuestionBtn">Add Another Question</button>
                                        <button type="submit" class="btn btn-primary">Save All Questions</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Modal for Editing Quiz -->
            <!-- Edit Question Modal -->
            <div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="editQuestionModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="editQuestionForm">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editQuestionModalLabel">Edit Question</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="edit_question_id" name="question_id">
                                
                                <div class="form-group">
                                    <label for="edit_question_text">Question</label>
                                    <input type="text" id="edit_question_text" name="question_text" class="form-control" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="edit_option_a">Option A</label>
                                    <input type="text" id="edit_option_a" name="option_a" class="form-control" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="edit_option_b">Option B</label>
                                    <input type="text" id="edit_option_b" name="option_b" class="form-control" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="edit_option_c">Option C</label>
                                    <input type="text" id="edit_option_c" name="option_c" class="form-control" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="edit_option_d">Option D</label>
                                    <input type="text" id="edit_option_d" name="option_d" class="form-control" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="edit_correct_answer">Correct Answer</label>
                                    <select id="edit_correct_answer" name="correct_answer" class="form-control" required>
                                        <option value="">Select Correct Answer</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="edit_explanation">Explanation</label>
                                    <textarea id="edit_explanation" name="explanation" class="form-control" rows="4" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <?php include(APPPATH . 'Views/admin/include/js.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            loadQuestions();

            // Search and Sort event listeners
            document.getElementById('search').addEventListener('input', loadQuestions);
            document.getElementById('sort').addEventListener('change', loadQuestions);

            // Upload form submission
            // document.getElementById('uploadForm').addEventListener('submit', function (e) {
            //     e.preventDefault();
            //     let formData = new FormData(this);
            //     axios.post('<base_url('questionbank/upload') ?>', formData)
            //         .then(response => {
            //             alert('Questions uploaded successfully');
            //             loadQuestions();
            //         })
            //         .catch(error => {
            //             console.error(error);
            //         });
            // });







            // Add single question form submission
            document.getElementById('addQuestionForm').addEventListener('submit', function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                axios.post('<?= base_url('questionbank/store') ?>', formData)
                    .then(response => {
                        // Check if the response has an error or success message
                        if (response.data.success) {
                            alert(response.data.success);
                            loadQuestions();
                            var addQuestionModal = new bootstrap.Modal(document.getElementById('addQuestionModal'));
                            addQuestionModal.hide();
                        } else if (response.data.error) {
                            alert(response.data.error);
                        }
                    })
                    .catch(error => {
                        // Display any validation errors or server errors
                        if (error.response && error.response.data && error.response.data.error) {
                            alert(error.response.data.error);
                        } else {
                            // console.error(error);
                            alert('An error occurred while adding the question.');
                        }
                    });
            });


        

            // Button to add new question form
            document.getElementById('addQuestionBtn').addEventListener('click', function () {
                addQuestionForm();
            });

            // Initial question form
            addQuestionForm();


            // Function to update correct answer options
            function updateCorrectAnswerOptions(questionIndex) {
                const correctAnswerSelect = document.getElementById(`correct_answer_${questionIndex}`);
                correctAnswerSelect.innerHTML = '<option value="">Select Correct Answer</option>';

                const optionInputs = ['option_a', 'option_b', 'option_c', 'option_d'];
                optionInputs.forEach(idPrefix => {
                    const optionValue = document.getElementById(`${idPrefix}_${questionIndex}`).value;
                    if (optionValue) {
                        const option = document.createElement('option');
                        option.value = optionValue;
                        option.textContent = optionValue;
                        correctAnswerSelect.appendChild(option);
                    }
                });
            }

          

            // Function to open the edit modal
            function openEditModal(questionId) {
                axios.get('<?= base_url('questionbank/edit/') ?>' + questionId)
                    .then(response => {
                        const question = response.data.question;

                        document.getElementById('edit_question_id').value = question.question_id;
                        document.getElementById('edit_question_text').value = question.question_text;
                        document.getElementById('edit_option_a').value = question.option_a;
                        document.getElementById('edit_option_b').value = question.option_b;
                        document.getElementById('edit_option_c').value = question.option_c;
                        document.getElementById('edit_option_d').value = question.option_d;
                        document.getElementById('edit_correct_answer').value = question.correct_answer;
                        document.getElementById('edit_explanation').value = question.explanation;

                        // Show the edit modal
                        var editQuestionModal = new bootstrap.Modal(document.getElementById('editQuestionModal'));
                        editQuestionModal.show();
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }

            // Handle the update question form
            document.getElementById('editQuestionForm').addEventListener('submit', function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                axios.post('<?= base_url('questionbank/update') ?>', formData)
                    .then(response => {
                        alert('Question updated successfully');
                        loadQuestions();
                        var editQuestionModal = new bootstrap.Modal(document.getElementById('editQuestionModal'));
                        editQuestionModal.hide();
                    })
                    .catch(error => {
                        console.error(error);
                });
            });


             // Function to add a new question form
             function addQuestionForm() {
                const questionIndex = document.querySelectorAll('.question-form').length;
                const questionHtml = `
                    <div class="question-form mb-3">
                        <div class="form-group">
                            <label for="question_text_${questionIndex}">Question</label>
                            <input type="text" id="question_text_${questionIndex}" class="form-control question-text" name="question_text" required>
                        </div>
                        <div class="form-group">
                            <label for="option_a_${questionIndex}">Option A</label>
                            <input type="text" id="option_a_${questionIndex}" class="form-control option-a" name="option_a" required>
                        </div>
                        <div class="form-group">
                            <label for="option_b_${questionIndex}">Option B</label>
                            <input type="text" id="option_b_${questionIndex}" class="form-control option-b" name="option_b" required>
                        </div>
                        <div class="form-group">
                            <label for="option_c_${questionIndex}">Option C</label>
                            <input type="text" id="option_c_${questionIndex}" class="form-control option-c" name="option_c" required>
                        </div>
                        <div class="form-group">
                            <label for="option_d_${questionIndex}">Option D</label>
                            <input type="text" id="option_d_${questionIndex}" class="form-control option-d" name="option_d" required>
                        </div>
                        <div class="form-group">
                            <label for="correct_answer_${questionIndex}">Correct Answer</label>
                            <select id="correct_answer_${questionIndex}" class="form-control correct-answer" name="correct_answer" required>
                                <option value="">Select Correct Answer</option>
                                <option value="option_a_${questionIndex}">Option A</option>
                                <option value="option_b_${questionIndex}">Option B</option>
                                <option value="option_c_${questionIndex}">Option C</option>
                                <option value="option_d_${questionIndex}">Option D</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="explanation_${questionIndex}">Explanation</label>
                            <textarea id="explanation_${questionIndex}" class="form-control explanation" rows="4" required></textarea>
                        </div>
                    </div>
                `;

                document.getElementById('questionsContainer').insertAdjacentHTML('beforeend', questionHtml);
            }

            // Add event listener to the "Add Another Question" button
            document.getElementById('addQuestionBtn').addEventListener('click', addQuestionForm);

            // Multi-question form submission
            document.getElementById('multiQuestionForm').addEventListener('submit', function (e) {
                e.preventDefault();

                let questions = [];
                let quiz_id = document.getElementById('quizId').value; // Get quiz_id value

                if (!quiz_id) {
                    alert('Please select a quiz.');
                    return;
                }

                // Iterate over each question form and collect data
                document.querySelectorAll('.question-form').forEach(form => {
                    let question = {
                        quiz_id: quiz_id, // Include quiz_id
                        question_text: form.querySelector('.question-text').value,
                        option_a: form.querySelector('.option-a').value,
                        option_b: form.querySelector('.option-b').value,
                        option_c: form.querySelector('.option-c').value,
                        option_d: form.querySelector('.option-d').value,
                        correct_answer: form.querySelector('.correct-answer').value,
                        explanation: form.querySelector('.explanation').value
                    };
                    questions.push(question);
                });

                // Create FormData and append questions array
                let formData = new FormData();
                formData.append('questions', JSON.stringify(questions)); // Send questions array as JSON

                axios.post('<?= base_url('questionbank/multiQuestionStore') ?>', formData)
                    .then(response => {
                        if (response.data.success) {
                            alert(response.data.success);
                            // Optionally, refresh or update the questions list
                            loadQuestions();
                            var multiQuestionModal = new bootstrap.Modal(document.getElementById('multiQuestionModal'));
                            multiQuestionModal.hide();
                        } else {
                            alert('Error: ' + response.data.error);
                        }
                    })
                    .catch(error => {
                        console.error('An error occurred:', error);
                    });
            });

            // Function to load questions with search and sort options
            function loadQuestions() {
                const search = document.getElementById('search').value;
                const sort = document.getElementById('sort').value;

                axios.get('<?= base_url('questionbank/list') ?>', {
                    params: {search, sort}
                })
                .then(response => {
                    const questions = response.data.questions;
                    const pagination = response.data.pagination;
                    const tbody = document.getElementById('questionTableBody');
                    const paginationElem = document.getElementById('pagination');

                    tbody.innerHTML = '';
                    questions.forEach(question => {
                        // Concatenate options
                        const options = `
                            A: ${question.option_a}<br>
                            B: ${question.option_b}<br>
                            C: ${question.option_c}<br>
                            D: ${question.option_d}
                        `;
                        const row = `
                            <tr>
                                <td>${question.question_id}</td>
                                <td>${question.question_text}</td>
                                <td>${options}</td>
                                <td>${question.correct_option}</td>
                                <td>${question.explanation}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="openEditModal(${question.question_id})" data-toggle="modal" data-target="#editQuestionModal">Edit</button>
                                    <a href="<?= base_url('questionbank/delete/') ?>${question.question_id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this question?')">Delete</a>
                                </td>
                            </tr>
                        `;
                        tbody.insertAdjacentHTML('beforeend', row);
                    });

                    // Handle pagination
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

            // Function to load a specific page of questions
            function loadPage(page) {
                axios.get('<?= base_url('questionbank/list') ?>', {
                        params: {
                            search: document.getElementById('search').value,
                            sort: document.getElementById('sort').value,
                            page
                        }
                    })
                    .then(response => {
                        const questions = response.data.questions;
                        const pagination = response.data.pagination;
                        const tbody = document.getElementById('questionTableBody');
                        const paginationElem = document.getElementById('pagination');

                        tbody.innerHTML = '';
                        questions.forEach(question => {
                            // Concatenate options
                            const options = `
                                A: ${question.option_a}<br>
                                B: ${question.option_b}<br>
                                C: ${question.option_c}<br>
                                D: ${question.option_d}
                            `;
                            const row = `
                                <tr>
                                    <td>${question.question_id}</td>
                                    <td>${question.question_text}</td>
                                    <td>${question.options}</td>
                                    <td>${question.correct_answer}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" onclick="openEditModal(${question.question_id})">Edit</button>
                                        <a href="<?= base_url('questionbank/delete/') ?>${question.question_id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this question?')">Delete</a>
                                    </td>
                                </tr>
                            `;
                            tbody.insertAdjacentHTML('beforeend', row);
                        });

                        // Handle pagination
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


        });


            
       



    </script>
</body>

</html>