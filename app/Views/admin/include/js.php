<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

<script>
 function showLoadingSpinner() {
    document.getElementById('loading').style.display = 'flex';
}

// Initialize CKEditor instance
let isFormDirty = false;
let editorInstance;
let currentModuleId = null;
let formDataStore = {};

// Initialize CKEditor only if it’s not already initialized
if (!editorInstance) {
    ClassicEditor
        .create(document.querySelector('#lessonContent'))
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

function setFormDirty() {
    isFormDirty = true;
}

function saveFormData(moduleId) {
    if (moduleId) {
        formDataStore[moduleId] = {
            ...$('#lessonForm').serializeArray().reduce((acc, field) => {
                acc[field.name] = field.value;
                return acc;
            }, {}),
            lesson_content: editorInstance ? editorInstance.getData() : ''
        };
    }
}

function restoreFormData(moduleId) {
    if (formDataStore[moduleId]) {
        Object.keys(formDataStore[moduleId]).forEach(name => {
            if (name === 'lesson_content') {
                editorInstance.setData(formDataStore[moduleId][name]);
            } else {
                $(`[name="${name}"]`).val(formDataStore[moduleId][name]).trigger('change');
            }
        });
    }
}

function clearFormData(moduleId) {
    if (moduleId) {
        delete formDataStore[moduleId];
    }
}

// Track form changes
$('#lessonForm input, #lessonForm textarea, #lessonForm select').change(setFormDirty);

$('#hasVideo').change(function () {
    $('#videoField').toggleClass('d-none', $(this).val() !== '1');
});

$('#hasQuiz').change(function () {
    $('#quizField').toggleClass('d-none', $(this).val() !== '1');
});

$('#hasAssignment').change(function () {
    $('#assignmentField').toggleClass('d-none', $(this).val() !== '1');
});

$('#hasResource').change(function () {
    $('#resourceField').toggleClass('d-none', $(this).val() !== '1');
});

$('#courseSelect').change(function () {
    var courseId = $(this).val();
    if (courseId) {
        $.ajax({
            url: '<?= base_url('admin/lesson/getModules') ?>',
            type: 'GET',
            data: { course_id: courseId },
            success: function (response) {
                var modules = response.modules;
                var moduleList = $('#moduleList');
                moduleList.empty();
                if (modules.length > 0) {
                    modules.forEach(function (module) {
                        moduleList.append('<button type="button" class="btn btn-outline-primary text-left module-btn" data-module-id="' + module.module_id + '">' + module.module_name + '</button>');
                    });
                } else {
                    moduleList.append('<p>No modules found for the selected course.</p>');
                }
            },
            error: function (error) {
                console.error('Error fetching modules:', error);
            }
        });
    } else {
        $('#moduleList').empty();
    }
});

$(document).on('click', '.module-btn', function () {
    if (isFormDirty && !confirm('You have unsaved changes. Do you want to discard them and switch to another module?')) {
        return;
    }

    var moduleId = $(this).data('module-id');
    $('#module_id').val(moduleId);
    $('.module-btn').removeClass('active-module');
    $(this).addClass('active-module');

    saveFormData(currentModuleId);

    $.ajax({
        url: '<?= base_url('admin/lesson/getModuleDetails') ?>',
        type: 'GET',
        data: { module_id: moduleId },
        success: function (response) {
            if (response.lesson_title) {
                $('#lessonTitle').val(response.lesson_title);
                editorInstance.setData(response.lesson_content || ''); // Set CKEditor data
                $('#hasVideo').val(response.has_video);
                $('#videoField').toggleClass('d-none', response.has_video !== '1');
                $('#videoSelection').val(response.video_id || '');
                $('#hasQuiz').val(response.has_quiz);
                $('#quizField').toggleClass('d-none', response.has_quiz !== '1');
                $('#quizSelection').val(response.quiz_id || '');
                $('#hasAssignment').val(response.has_assignment);
                $('#assignmentField').toggleClass('d-none', response.has_assignment !== '1');
                $('#assignmentSelection').val(response.assignment_id || '');
                $('#hasResource').val(response.has_resource);
                $('#resourceField').toggleClass('d-none', response.has_resource !== '1');
                $('#resourceSelection').val(response.resource_id || '');
                $('#duration').val(response.duration || '');

                $('#lessonFormContainer').addClass('d-none');
                $('#editLessonBtn').removeClass('d-none');

                // Set the lesson_id
                $('#lesson_id').val(response.lesson_id || '');

                restoreFormData(moduleId);
                currentModuleId = moduleId;
                isFormDirty = false;
            } else {
                $('#lessonTitle').val('');
                editorInstance.setData(''); // Clear CKEditor content
                $('#hasVideo').val('0');
                $('#videoField').addClass('d-none');
                $('#hasQuiz').val('0');
                $('#quizField').addClass('d-none');
                $('#hasAssignment').val('0');
                $('#assignmentField').addClass('d-none');
                $('#hasResource').val('0');
                $('#resourceField').addClass('d-none');
                $('#duration').val('');

                $('#lessonFormContainer').removeClass('d-none');
                $('#editLessonBtn').addClass('d-none');

                // Clear the lesson_id
                $('#lesson_id').val('');

                restoreFormData(moduleId);
                currentModuleId = moduleId;
                isFormDirty = false;
            }
        },
        error: function (error) {
            console.error('Error fetching module details:', error);
        }
    });
});

$('#editLessonBtn').click(function () {
    $('#lessonFormContainer').removeClass('d-none');
    $('#editLessonBtn').addClass('d-none');
});

$('#lessonForm').on('submit', function (event) {
    event.preventDefault();

    $('#loadingAnimation').removeClass('d-none');
    var formData = $(this).serialize() + '&lesson_content=' + encodeURIComponent(editorInstance.getData());

    $.ajax({
        url: '<?= base_url('admin/lesson/save') ?>',
        type: 'POST',
        data: formData,
        success: function (response) {
            if (response.message_type === 'success') {
                alert(response.message || 'Lesson saved successfully');
                clearFormData(currentModuleId);
                isFormDirty = false;
                $('#lessonFormContainer').addClass('d-none');
                $('#editLessonBtn').removeClass('d-none');
            } else {
                alert(response.message || 'Failed to save the lesson');
            }
        },
        error: function (error) {
            alert('Failed to save the lesson');
        },
        complete: function () {
            $('#loadingAnimation').addClass('d-none');
        }
    });
});




    $(document).ready(function() {
        // Handle the change event for `hasQuiz` dropdown
        $('#hasQuiz').change(function () {
            const hasQuiz = $(this).val();
            const courseId = $('#courseSelect').val();
            const quizField = $('#quizField');
            const quizSelection = $('#quizSelection');

            if (hasQuiz == '1' && courseId) {
                // Show the quiz field
                quizField.removeClass('d-none');

                // Fetch quizzes for the selected course
                fetchQuizzesForCourse(courseId)
                    .then(quizzes => {
                        // Populate the quiz dropdown
                        quizSelection.html(quizzes.map(quiz => 
                            `<option value="${quiz.quiz_id}">${quiz.quiz_name}</option>`
                        ).join(''));
                    })
                    .catch(error => {
                        console.error('Error fetching quizzes:', error);
                    });
            } else {
                // Hide the quiz field if "No" is selected
                quizField.addClass('d-none');
                quizSelection.html(''); // Clear quiz options
            }
        });

        // Fetch quizzes for a course
        function fetchQuizzesForCourse(courseId) {
            return $.ajax({
                url: `<?= base_url('quizzes/getQuizzesForCourse') ?>/${courseId}`,
                type: 'GET',
                dataType: 'json'
            }).then(response => response.allQuizzes || [])
            .catch(error => {
                console.error('Error fetching quizzes:', error);
                return [];
            });
    }
    });
    
    $(document).ready(function() {
        // Handle the change event for `hasQuiz` dropdown
        $('#hasAssignment').change(function () {
            const hasAssignment = $(this).val();
            const courseId = $('#courseSelect').val();
            const assignmentField = $('#assignmentField');
            const assignmentSelection = $('#assignmentSelection');

            if (hasAssignment == '1' && courseId) {
                // Show the assignment field
                assignmentField.removeClass('d-none');

                // Fetch assignments for the selected course
                fetchAssignmentsForCourse(courseId)
                    .then(assignments => {
                        // Populate the quiz dropdown
                        assignmentSelection.html(assignments.map(assignment => 
                            `<option value="${assignment.assignment_id}">${assignment.assignment_name}</option>`
                        ).join(''));
                    })
                    .catch(error => {
                        console.error('Error fetching assignments:', error);
                    });
            } else {
                // Hide the assignment field if "No" is selected
                assignmentField.addClass('d-none');
                assignmentSelection.html(''); // Clear quiz options
            }
        });

        // Fetch quizzes for a course
        function fetchAssignmentsForCourse(courseId) {
            return $.ajax({
                url: `<?= base_url('assignments/getAssignmentsForCourse') ?>/${courseId}`,
                type: 'GET',
                dataType: 'json'
            }).then(response => response.allAssignments || [])
            .catch(error => {
                console.error('Error fetching assignments:', error);
                return [];
            });
    }
    });




    window.onbeforeunload = function () {
        if (isFormDirty) {
            return 'You have unsaved changes. Are you sure you want to leave this page?';
        }
    };
</script>
