<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(APPPATH . 'Views/admin/include/head.php'); ?>
    <style>
        .module-btn {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }

        .active-module {
            background-color: #007bff;
            color: white;
        }

        .loading-spinner {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            font-size: 1.2em;
            color: #333;
        }

        .d-none {
            display: none;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
            border-width: .3em;
        }
    </style>
</head>

<body>
    <?php include(APPPATH . 'Views/admin/include/sidebar.php'); ?>
    <main id="main" class="main p-0">
        <?php include(APPPATH . 'Views/admin/include/nav2.php'); ?>

        <div class="container mt-2" id="mainContent">
            <div class="mb-3 font-weight-bold">Create/Edit Lesson</div>
            <button id="refreshButton" class="btn btn-secondary">Refresh</button>
            <section class="create-edit-course">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="courseSelect">Select Course</label>
                            <select class="form-control fw-400" id="courseSelect" name="course_id">
                                <option value="">Select Course</option>
                                <?php foreach ($courses as $course) : ?>
                                    <option value="<?= $course['course_id'] ?>"><?= $course['course_title'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php if (session()->has('message')) : ?>
                            <?= view('include/message') ?>
                        <?php endif ?>

                        <div class="row">
                            <div class="col-md-8">
                                <hr>
                                <form id="lessonForm">
                                    <input type="hidden" id="module_id" name="module_id">
                                    <input type="hidden" id="lesson_id" name="lesson_id" value="">
                                    <div id="lessonFormContainer" class="d-none">
                                        <div class="form-group">
                                            <label for="lessonTitle">Lesson Title</label>
                                            <input type="text" class="form-control" id="lessonTitle" name="lesson_title" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="lessonContent">Lesson Content</label>
                                            <textarea id="lessonContent" name="lesson_content" class="form-control"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="hasVideo">Has Video</label>
                                            <select class="form-control" id="hasVideo" name="has_video">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                        <div class="form-group d-none" id="videoField">
                                            <label for="videoSelection">Select Video</label>
                                            <select class="form-control" id="videoSelection" name="video_id">
                                                <!-- Populate with video options -->
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="hasQuiz">Has Quiz</label>
                                            <select class="form-control" id="hasQuiz" name="has_quiz">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                        <div class="form-group d-none" id="quizField">
                                            <label for="quizSelection">Select Quiz</label>
                                            <select class="form-control" id="quizSelection" name="quiz_id">
                                                <!-- Populate with quiz options -->
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="hasAssignment">Has Assignment</label>
                                            <select class="form-control" id="hasAssignment" name="has_assignment">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                        <div class="form-group d-none" id="assignmentField">
                                            <label for="assignmentSelection">Select Assignment</label>
                                            <select class="form-control" id="assignmentSelection" name="assignment_id">
                                                <!-- Populate with assignment options -->
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="hasResource">Has Resource</label>
                                            <select class="form-control" id="hasResource" name="has_resource">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                        <div class="form-group d-none" id="resourceField">
                                            <label for="resourceSelection">Select Resource</label>
                                            <select class="form-control" id="resourceSelection" name="resource_id">
                                                <!-- Populate with resource options -->
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="duration">Duration (minutes)</label>
                                            <input type="number" class="form-control" id="duration" name="duration">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Save Lesson</button>
                                    </div>
                                </form>
                                <button id="editLessonBtn" class="btn btn-secondary d-none">Edit Lesson</button>
                                <div id="formSubmissionLoading" class="loading-spinner d-none">Submitting Lesson...</div>
                            </div>
                            <div class="col-md-4">
                                <div class="border p-1">
                                    <div class="form-group">
                                        <label for="moduleList">Select Module</label>
                                        <div id="moduleLoading" class="loading-spinner d-none">Loading Modules...</div>
                                        <div id="moduleList">The Selected Course Modules will be populated here</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="lessonLoading" class="loading-spinner d-none">Loading Lesson...</div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <?php include(APPPATH . 'Views/admin/include/js.php'); ?>
    <script src="<?= base_url('/assets/js/main-scripts.js'); ?>"></script>
    
</body>
</html>