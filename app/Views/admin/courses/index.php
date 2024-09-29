<?php include(APPPATH .'Views/admin/include/head.php'); ?>
<title>Course Management | LearnXa</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    #progressContainer {
        display: none;
        margin-top: 10px;
    }

    #imagePreview {
        display: none;
        margin-top: 10px;
        max-width: 100%;
    }


    #cancelIcon {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: rgba(255, 255, 255, 0.7);
        border-radius: 50%;
        cursor: pointer;
        display: none;
    }

    #zoomedImageContainer {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    #zoomedImage {
        max-width: 90%;
        max-height: 90%;
    }
</style>

<body>
    <?php include(APPPATH . 'Views/admin/include/sidebar.php'); ?>
    <main id="main" class="main p-0">
        <?php include(APPPATH . 'Views/admin/include/nav2.php'); ?>
        <div class="container mt-2" id="mainContent">
            <div class="mb-3 font-weight-bold">COURSE MANAGEMENT</div>


            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="courseTabs" role="tablist">
        
                <li class="nav-item">
                    <a class="nav-link active" id="course-bank-tab" data-toggle="tab" href="#course-bank" role="tab"
                        aria-controls="course-bank" aria-selected="true">Course Lists</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="add-course-tab" data-toggle="tab" href="#add-course" role="tab"
                        aria-controls="course" aria-selected="false">Upload Course</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="export-course-tab" data-toggle="tab" href="#export-course" role="tab"
                        aria-controls="export-course" aria-selected="false">Export course</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="assign-courses-tab" data-toggle="tab" href="#assign-courses" role="tab"
                        aria-controls="assign-course" aria-selected="false">Assign course</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="course-settings-tab" data-toggle="tab" href="#course-settings" role="tab"
                        aria-controls="course-settings" aria-selected="false">Settings</a>
                </li>
            </ul>


            <!-- Tab Content -->
            <div class="tab-content" id="courseTabsContent">
                <!-- Display validation errors if any -->
                <?php if (session()->has('message')) : ?>
                    <?= view('include/message') ?>
                <?php endif ?>

                <!-- Courses Tab -->
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
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Enrollment</th>
                                        <th>Modules</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="assignmentTableBody">
                                    <?php foreach($courses as $course): ?>
                                        <tr>
                                            <td><?= $course['course_id'] ?></td>
                                            <td><?= $course['course_title'] ?></td>
                                            <td>₦<?= number_format($course['price']) ?></td>
                                            <td><?= number_format($course['enrollment_count']) ?></td>
                                            <td><?= $course['modules'] ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/course/edit/'.$course['course_id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="<?= base_url('admin/course/delete/'.$course['course_id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this course?')">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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
                <div class="tab-pane fade" id="add-course" role="tabpanel" aria-labelledby="add-course-tab">
                    
                    <section class="create-edit-course">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <!-- Loading Spinner -->
                                <div id="loading">
                                    <div class="spinner"></div>
                                </div>
                                <form action="<?= base_url('admin/course/save') ?>" method="post" enctype="multipart/form-data"
                                    onsubmit="showLoadingSpinner()" novalidayte>
                                    <!-- Display validation errors if any -->
                                    <?php if (session()->has('message')) : ?>
                                    <?= view('include/message') ?>
                                    <?php endif ?>

                                    <div class="row">
                                        <div class="col-md-9">
                                            <!-- :::::::::::::::::Course Title::::::::::::::: -->
                                            <div class="form-group">
                                                <label for="courseTitle" class="font-weight-bold">Course Title</label>
                                                <input type="text" class="form-control" id="courseTitle" name="course_title"
                                                    placeholder="Enter course title" required>
                                            </div>

                                            <!-- :::::::::::::::::Course Tagline::::::::::::::: -->
                                            <div class="form-group">
                                                <label for="courseTagline" class="font-weight-bold">Course Tagline</label>
                                                <textarea class="form-control" id="courseTagline" name="course_tagline" rows="3"
                                                    placeholder="Enter Course Tagline"></textarea>
                                            </div>

                                            <!-- :::::::::::::::::Course Overview::::::::::::::: -->
                                            <div class="form-group">
                                                <label for="courseOverview" class="font-weight-bold">Course Overview</label>
                                                <textarea class="form-control" id="courseOverview" name="course_overview"
                                                    rows="3" placeholder="Enter Course Overview"></textarea>
                                            </div>
                                            <!-- :::::::::::::::::Skills you'll aquired::::::::::::::: -->
                                            <div class="form-group">
                                                <label for="skillsAcquired" class="font-weight-bold">Skills Acquired</label>
                                                <textarea class="form-control" id="skillsAcquired" name="skills_acquired"
                                                    rows="3" placeholder="Enter skills acquired"></textarea>
                                            </div>
                                            <!-- :::::::::::::::::Requirements::::::::::::::: -->
                                            <div class="form-group">
                                                <label for="requirements" class="font-weight-bold">Requirements</label>
                                                <textarea class="form-control" id="requirements" name="requirements" rows="3"
                                                    placeholder="Enter course requirements"></textarea>
                                            </div>

                                            <!-- :::::::::::::::::Course Compact::::::::::::::: -->
                                            <div class="font-weight-bold">Course Compact</div>
                                            <div class="accordion" id="accordionExample">
                                                <!-- Dynamic Accordion Sections will be added here -->
                                            </div>
                                            <button type="button" id="addSection" class="btn btn-secondary mt-3">Add
                                                Section</button>


                                            <!-- :::::::::::::::::Description::::::::::::::: -->
                                            <div class="form-group">
                                                <label for="courseDescription" class="font-weight-bold">Course
                                                    Description</label>
                                                <!-- <textarea id="courseDescription" name="course_description" class="form-control"></textarea> -->
                                                <textarea id="courseDescription" name="course_description"
                                                    class="form-control"></textarea>
                                            </div>
                                            <!-- :::::::::::::::::Course Image::::::::::::::: -->
                                            <div class="form-group">
                                                <label for="courseImage" class="font-weight-bold">Course Image</label>
                                                <input type="file" class="form-control-file" id="courseImage"
                                                    name="course_image">
                                                <div id="progressContainer">
                                                    <progress id="progressBar" value="0" max="100" class="w-100"></progress>
                                                </div>
                                                <div id="imagePreviewContainer" style="position: relative;">
                                                    <img id="imagePreview" src="#" alt="Image Preview" width="200">
                                                    <div id="cancelIcon" onclick="removeImage()">&times;</div>
                                                </div>
                                            </div>


                                            <div id="zoomedImageContainer" onclick="closeZoomedImage()">
                                                <img id="zoomedImage" src="#" alt="Zoomed Image">
                                            </div>

                                        </div>
                                        <div class="col-md-3 pt-2 border">
                                            <!-- Select Topic -->
                                            <div class="form-group">
                                                <label for="courseTopic">Topic</label>
                                                <select class="form-control" id="courseTopic" name="topic_ids[]"
                                                multiple required>
                                                <!-- <select class="form-control" id="courseTopic" name="topic_ids[]"
                                                    multiple="multiple" multiple required> -->
                                                    <?php foreach ($topics as $topic) : ?>
                                                    <option value="<?= $topic['topic_id'] ?>"><?= $topic['topic_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                
                                        <!-- Assign Instructor -->
                                        <div class="form-group">
                                            <label for="courseInstructor">Instructor</label>
                                            <select class="form-control" id="courseInstructor" name="instructor_id" requinred>
                                                <option value="">Select Instructor</option>
                                                <!-- Populate this with instructor data from the database -->
                                            </select>
                                        </div>

                                        <!-- Course Price -->
                                        <div class="form-group">
                                            <label for="coursePrice">Price</label>
                                            <input type="number" step="0.01" class="form-control" id="coursePrice" name="price"
                                                placeholder="Enter course price" value="0.00" rejquired>
                                        </div>

                                        <!-- Rating -->
                                        <div class="form-group">
                                            <label for="courseRating">Rating</label>
                                            <input type="number" step="0.01" class="form-control" id="courseRating"
                                                name="rating" placeholder="Enter course rating" value="0.00" requijred>
                                        </div>

                                        <!-- Rating Count -->
                                        <div class="form-group">
                                            <label for="ratingCount">Rating Count</label>
                                            <input type="number" class="form-control" id="ratingCount" name="rating_count"
                                                placeholder="Enter rating count" value="0" requijkred>
                                        </div>

                                        <!-- Course Duration -->
                                        <div class="form-group">
                                            <label for="courseDuration">Duration</label>
                                            <input type="text" class="form-control" id="courseDuration" name="duration"
                                                placeholder="Enter course duration" requirred>
                                        </div>

                                        <!-- Course Languages -->
                                        <div class="form-group">
                                            <label for="courseLanguage">Language</label>
                                            <input type="text" class="form-control" id="courseLanguage" name="language"
                                                placeholder="Enter course language" renquirred>
                                        </div>

                                        <!-- Enrollment Count -->
                                        <div class="form-group">
                                            <label for="enrollmentCount">Enrollment Count</label>
                                            <input type="number" class="form-control" id="enrollmentCount"
                                                name="enrollment_count" placeholder="Enter enrollment count" value="0" req>
                                        </div>

                                        <!-- Uploaded Date -->
                                        <div class="form-group">
                                            <label for="uploadedDate">Uploaded Date</label>
                                            <input type="date" class="form-control" id="uploadedDate" name="uploaded_date"
                                                requikred>
                                        </div>

                                        <!-- Course Modules Number -->
                                        <!-- Total Course Module -->
                                        <div class="form-group mt-3">
                                            <label for="courseModuleCount">Total Course Module</label>
                                            <input type="number" step="0" class="form-control" id="courseModuleCount"
                                                name="course_module_count" placeholder="Course Module" value="0" readonly>
                                        </div>

                                        <!-- Is Featured -->
                                        <div class="form-group">
                                            <label for="isFeatured">Is Featured</label>
                                            <select class="form-control" id="isFeatured" name="is_featured">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                        <!-- Course Type -->
                                        <div class="form-group">
                                            <label for="isFeatured">Course Type</label>
                                            <select class="form-control" id="courseType" name="course_type">
                                                <option value="0">Course On Demand</option>
                                                <option value="1">Virtual Course</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-primary col-md-12">Upload Course</button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </section>
                </div>                

            </div>

        </div>
    </main>


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <?php include(APPPATH . 'Views/admin/include/js.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/script.js"></script>
    <script>
        // $(document).ready(function () {
        //     $('#courseTopic').multiselect({
        //         includeSelectAllOption: true,
        //         enableFiltering: true,
        //         buttonWidth: '100%',
        //         nonSelectedText: 'Select Topic',
        //         numberDisplayed: 1
        //     });
        // });

        $(document).ready(function() {
    $('#courseTopic').select2({
        placeholder: 'Select Topics',
        allowClear: true
    });
});
        document.addEventListener('DOMContentLoaded', function () {
            let sectionCount = 0;

            document.getElementById('addSection').addEventListener('click', function () {
                addSection();
            });

            function addSection() {
                const sectionId = `section${sectionCount}`;
                const editorId = `editor${sectionCount}`;

                const sectionTemplate = `
                    <div class="card" id="${sectionId}">
                        <div class="card-header" id="heading${sectionCount}">
                            <h2 class="mb-0">
                                <input type="text" class="form-control" name="section_titles[]" placeholder="Section Title">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse${sectionCount}" aria-expanded="false" aria-controls="collapse${sectionCount}">
                                    Edit Section Content
                                </button>
                                <button type="button" class="btn btn-danger btn-sm float-right removeSection" data-section-id="${sectionId}">Remove</button>
                            </h2>
                        </div>
                        <div id="collapse${sectionCount}" class="collapse" aria-labelledby="heading${sectionCount}" data-parent="#accordionExample">
                            <div class="card-body">
                                <textarea id="${editorId}" name="sections[]" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>`;

                document.getElementById('accordionExample').insertAdjacentHTML('beforeend', sectionTemplate);

                ClassicEditor
                    .create(document.querySelector(`#${editorId}`))
                    .catch(error => {
                        console.error(error);
                    });

                sectionCount++;
                updateModuleCount();
            }







            // const editors = ['#courseDescription', '#skillsAcquired', '#requirements', '#courseTagline',
            //     '#courseOverview'
            // ];

            // editors.forEach(selector => {
            //     ClassicEditor
            //         .create(document.querySelector(selector))
            //         .then(editor => {
            //             console.log(`Editor was initialized on ${selector}`, editor);
            //         })
            //         .catch(error => {
            //             console.error(`There was a problem initializing the editor on ${selector}`,
            //                 error);
            //         });
            // });


            // ClassicEditor
            //     .create(document.querySelector('#courseDescription'))
            //     .then(editor => {
            //         console.log('Editor was initialized', editor);
            //     })
            //     .catch(error => {
            //         console.error('There was a problem initializing the editor.', error);
            //     });


            function updateModuleCount() {
                const totalModules = document.getElementById('accordionExample').childElementCount;
                document.getElementById('courseModuleCount').value = totalModules;
            }

            function removeSection(sectionId) {
                const sectionElement = document.getElementById(sectionId);
                if (sectionElement) {
                    sectionElement.remove();
                    updateModuleCount();
                }
            }

            document.getElementById('accordionExample').addEventListener('click', function (event) {
                if (event.target.classList.contains('removeSection')) {
                    const sectionId = event.target.getAttribute('data-section-id');
                    if (confirm('Are you sure you want to remove this section?')) {
                        removeSection(sectionId);
                    }
                }
            });


            document.getElementById('courseImage').addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();

                    const progressBar = document.getElementById('progressBar');
                    const progressContainer = document.getElementById('progressContainer');
                    const imagePreview = document.getElementById('imagePreview');
                    const cancelIcon = document.getElementById('cancelIcon');

                    progressContainer.style.display = 'block';

                    reader.onprogress = function (e) {
                        if (e.lengthComputable) {
                            const percentLoaded = Math.round((e.loaded / e.total) * 100);
                            progressBar.value = percentLoaded;
                        }
                    };

                    reader.onload = function (e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                        progressContainer.style.display = 'none';
                        cancelIcon.style.display = 'block';
                    };

                    reader.readAsDataURL(file);
                }
            });

            function removeImage() {
                document.getElementById('courseImage').value = '';
                document.getElementById('imagePreview').style.display = 'none';
                document.getElementById('cancelIcon').style.display = 'none';
                document.getElementById('imagePreview').src = '#';
            }

            document.getElementById('imagePreview').addEventListener('click', function () {
                const zoomedImageContainer = document.getElementById('zoomedImageContainer');
                const zoomedImage = document.getElementById('zoomedImage');
                zoomedImage.src = this.src;
                zoomedImageContainer.style.display = 'flex';
            });

            function closeZoomedImage() {
                document.getElementById('zoomedImageContainer').style.display = 'none';
            }
        });



        document.addEventListener('DOMContentLoaded', function () {
            const editors = ['#courseDescription', '#skillsAcquired', '#requirements',
                '#courseTagline', '#courseOverview'
            ];
            const editorInstances = {};

            editors.forEach(selector => {
                ClassicEditor
                    .create(document.querySelector(selector))
                    .then(editor => {
                        editorInstances[selector] = editor;
                        console.log(`Editor was initialized on ${selector}`, editor);
                    })
                    .catch(error => {
                        console.error(
                            `There was a problem initializing the editor on ${selector}`,
                            error);
                    });
            });

            window.validateForm = function () {
                let isValid = true;

                Object.keys(editorInstances).forEach(selector => {
                    const editor = editorInstances[selector];
                    const editorData = editor.getData();

                    if (!editorData) {
                        isValid = false;
                        alert(
                            `The field ${selector.replace('#', '')} cannot be empty.`);
                    }
                });

                return isValid;
            };
        });
    </script>

</body>

</html>