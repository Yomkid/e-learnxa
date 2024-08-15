<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(APPPATH . 'Views/admin/include/head.php'); ?>
    <title>Virtual Class Management | LearnXa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Export to Excel library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <!-- Export as PDF library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.20/jspdf.plugin.autotable.min.js"></script>



    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <meta name="csrf-token" content="<?= csrf_hash() ?>">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" />

      <!--- FullCalendar plugin --->
      <link href="<?= base_url('packages/core/main.css') ?>" rel='stylesheet' />
    <link href="<?= base_url('packages/daygrid/main.css') ?>" rel='stylesheet' />
    <link href="<?= base_url('packages/list/main.css') ?>" rel='stylesheet' />

<style>
    /* styles.css */
    body, html {
        height: 100%;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .select2-container--default .select2-results__option {
        display: flex;
        align-items: center;
    }

    .fc-sun {
        color: red;
    }

    .fc-ltr .fc-dayGrid-view .fc-day-top .fc-day-number {
        float: none;
    }

    .fc-day-top {
        text-align: center !important;
    }

    .floating-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        #export-options {
            position: absolute;
            bottom: 60px;
            right: 0;
            display: none;
            z-index: 1001;
        }

        .export-options.card {
            width: 200px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .export-options .btn {
            margin-bottom: 10px;
        }


        /* For Watermark */
        .thecontent {
            position: relative;
            z-index: 1;
            padding: 20px;
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.1;
            z-index: 0;
            pointer-events: none; /* Makes the watermark non-interactive */
            user-select: none;    /* Prevents text selection */
        }

        .watermark img {
            width: 300px; /* Adjust the size as needed */
            height: auto;
        }
</style>


</head>
<body>
    <?php include(APPPATH . 'Views/admin/include/sidebar.php'); ?>
    <main id="main" class="main thecontent p-0">
        <?php include(APPPATH . 'Views/admin/include/nav2.php'); ?>
        <div class="container mt-2" id="mainContent">
            <div class="mb-3 font-weight-bold">VIRTUAL CLASS MANAGEMENT</div>
            <!-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createVirtualclassModal">Create Virtualclass</button> -->


            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="virtualclassTabs" role="tablist">
                <li class="nav-item">
                    <a class="btn nav-link" id="add-virtualclass-tab" data-toggle="modal" data-target="#createVirtualclassModal" role="tab"
                        aria-controls="add-virtualclass" aria-selected="false">ADD Virtualclass</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="virtualclass-bank-tab" data-toggle="tab" href="#virtualclass-bank" role="tab"
                        aria-controls="virtualclass-bank" aria-selected="true">Virtualclass Lists</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="add-bulk-virtualclass-tab" data-toggle="tab" href="#add-bulk-virtualclass" role="tab"
                        aria-controls="bulk-virtualclass" aria-selected="false">Import</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="export-virtualclass-tab" data-toggle="tab" href="#export-virtualclass" role="tab"
                        aria-controls="export-virtualclass" aria-selected="false">Export</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="assign-virtualclasses-tab" data-toggle="tab" href="#assign-virtualclasses" role="tab"
                        aria-controls="assign-virtualclass" aria-selected="false">Assign</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="virtualclass-calendar-preview-tab" data-toggle="tab" href="#virtualclass-calendar-preview" role="tab"
                        aria-controls="virtualclass-calendar-preview" aria-selected="false">Calendars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="virtualclass-preview-tab" data-toggle="tab" href="#virtualclass-preview" role="tab"
                        aria-controls="virtualclass-preview" aria-selected="false">virtualclasses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="virtualclass-settings-tab" data-toggle="tab" href="#virtualclass-settings" role="tab"
                        aria-controls="virtualclass-settings" aria-selected="false">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="virtualclass-calnedar-setup-tab" data-toggle="tab" href="#virtualclass-calendar-setup" role="tab"
                        aria-controls="virtualclass-calendar-setup" aria-selected="false">Setup</a>
                </li>
            </ul>


            <!-- Tab Content -->
            <div class="tab-content" id="questionTabsContent">
                <!-- Display validation errors if any -->
                <?php if (session()->has('message')) : ?>
                    <?= view('include/message') ?>
                <?php endif ?>

                <!-- Virtualclass Bank Tab -->
                <div class="tab-pane fade show active" id="virtualclass-bank" role="tabpanel"
                    aria-labelledby="virtualclass-bank-tab">
                    <div class="row my-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" id="search" class="form-control" placeholder="Search virtualClasses...">
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
                                        <th>Virtualclass Name</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Duration</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="virtualclassTableBody">
                                    <!-- virtualClasses will be loaded here via JavaScript -->
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
                <div class="tab-pane fade" id="add-bulk-virtualclass" role="tabpanel" aria-labelledby="add-bulk-virtualclass-tab">
                    
                    <form id="bulkUploadForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="virtualclass_file">Upload Virtualclass File (CSV/Excel)</label>
                            <input type="file" id="virtualclass_file" name="virtualclass_file" class="form-control" accept=".csv, .xlsx" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>

                <!-- Export to CSV -->
                <div class="tab-pane fade" id="export-virtualclass" role="tabpanel" aria-labelledby="export-virtualclass-tab">
                    <form action="<?= base_url('virtualclasses/exportvirtualclasses') ?>" method="post">
                        <div class="form-group">
                            <label for="virtualclass_id">Select Virtualclass</label>
                            <select id="virtualclass_id" name="virtualclass_id" class="form-control">
                                <option value="">All virtualClasses</option>
                                <?php if (!empty($virtualClasses)): ?>
                                    <?php foreach ($virtualClasses as $virtualclass): ?>
                                        <option value="<?= $virtualclass['virtualclass_id'] ?>"><?= $virtualclass['virtualclass_name'] ?></option>
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
                        <button type="submit" class="btn btn-primary">Export Calendars</button>
                    </form>
                </div>
               
               
               
                <!-- Assign Courses to Virtualclass -->
                <div class="tab-pane fade mt-2" id="assign-virtualclasses" role="tabpanel" aria-labelledby="assign-virtualclasses-tab">
                
                    <ul class="nav nav-tabs" id="virtualclassTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="assign-course-class-tab" data-toggle="tab" href="#assign-course-class" role="tab"
                                aria-controls="assign-course-class" aria-selected="true">Assign Courses to Class</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="assign-timetable-class-tab" data-toggle="tab" href="#assign-timetable-class" role="tab"
                                aria-controls="assign-timetable-class" aria-selected="true">Assign Timtable to Class</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="assignClassTab">

                    <div class="tab-pane fade show active" id="assign-course-class" role="tabpanel" aria-labelledby="virtualclass-bank-tab">
                        <form id="assignCoursesForm" action="<?= base_url('virtualclasses/assignCoursesForVirtualClass') ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label for="virtualclass_id">Select Virtual Class</label>
                                    <select id="assign_virtualclass_id" name="virtualclass_id" class="form-control" required onchange="fetchCoursesForClass(this.value)">
                                        <option value="">Select a Class</option>
                                        <?php if (!empty($virtualClasses)): ?>
                                            <?php foreach ($virtualClasses as $virtualClass): ?>
                                                <option value="<?= $virtualClass['virtualclass_id'] ?>" data-image="<?= base_url('uploads/' . $virtualClass['virtualclass_id']) ?>">
                                                    <?= $virtualClass['virtualclass_name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div id="courseSection"></div>
                            </form>
                        </div>

                        <div class="tab-pane fade mt-2" id="assign-timetable-class" role="tabpanel" aria-labelledby="assign-timetable-class-tab">
                            <form id="assignVirtualClassesForm" action="<?= base_url('virtualclasses/assignVirtualClassesTimetable') ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label for="virtualclass_id">Select Virtual Class</label>
                                    <select id="assign_virtualclass_id" name="virtualclass_id" class="form-control" required onchange="fetchTimetablesForClass(this.value)">
                                        <option value="">Select a Class</option>
                                        <?php if (!empty($virtualClasses)): ?>
                                            <?php foreach ($virtualClasses as $virtualClass): ?>
                                                <option value="<?= $virtualClass['virtualclass_id'] ?>" data-image="<?= base_url('uploads/' . $virtualClass['virtualclass_id']) ?>">
                                                    <?= $virtualClass['virtualclass_name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div id="timetablesSection"></div>
                            </form>
                        </div>
                    </div>
                </div>



                <!-- Virtualclass Calendar -->
                <div class="tab-pane fade mt-2" id="virtualclass-calendar-preview" role="tabpanel" aria-labelledby="virtualclass-calendar-preview-tab">
                    <!-- Select Virtualclass -->
                    <div class="form-group">
                        <label for="virtualclass_calendar_id">Select Virtualclass</label>
                        <select id="virtualclass_calendar_id" name="virtualclass_calendar_id" class="form-control">
                            <!-- Populate with existing virtualClasses -->
                            <option value="" disabled selected>Select a Virtualclass</option>
                            
                        </select>
                    </div>
                    <section class="showcase">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="pb-2 mt-4 mb-2 border-bottom">
                                    <div>Python Programming Class</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 gedf-main">
                                        <span id="loading">Loading...</span>
                                        <span id="load-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

               

                <!-- Virtualclass Preview -->
                <div class="tab-pane fade mt-2" id="virtualclass-preview" role="tabpanel" aria-labelledby="virtualclass-preview-tab">
                    <!-- Select Virtualclass -->
                    <div class="form-group">
                        <label for="virtualclass_preview_id">Select Virtualclass</label>
                        <select id="virtualclass_preview_id" name="virtualclass_preview_id" class="form-control">
                            <!-- Populate with existing virtualClasses -->
                            <option value="" disabled selected>Select a Virtualclass</option>
                            <?php foreach ($virtualClasses as $virtualclass): ?>
                                <option value="<?= $virtualclass['virtualclass_id'] ?>"><?= $virtualclass['virtualclass_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="virtualclassPreview"></div>
                    <!-- <div class="text-center">
                        <button id="export-btn" class="btn btn-success mb-2"><i class="fas fa-file-excel"></i>
                        Export to Excel</button>
                        <button id="export-csv-btn" class="btn btn-warning mb-2"><i class="fas fa-file-csv"></i>
                        Export to CSV</button>
                        <button id="export-word-btn" class="btn btn-primary mb-2"><i class="fas fa-file-word"></i>
                        Export to Word</button>
                        <button id="export-pdf-btn" class="btn btn-danger mb-2"><i class="fas fa-file-pdf"></i>
                        Export to PDF</button>
                    </div> -->

                    <!-- Floating Export Button -->
                    <div class="floating-btn">
                        <button id="export-btn" class="btn btn-primary">
                            <i class="fas fa-download"></i> Export
                        </button>
                        <div id="export-options" class="export-options card">
                            <div class="card-body">
                                <button id="export-excel-btn" class="btn btn-success btn-block mb-2">
                                    <i class="fas fa-file-excel"></i> Export as Excel
                                </button>
                                <button id="export-csv-btn" class="btn btn-info btn-block mb-2">
                                    <i class="fas fa-file-csv"></i> Export as CSV
                                </button>
                                <button id="export-word-btn" class="btn btn-primary btn-block mb-2">
                                    <i class="fas fa-file-word"></i> Export as Word
                                </button>
                                <button id="export-pdf-btn" class="btn btn-danger btn-block">
                                    <i class="fas fa-file-pdf"></i> Export as PDF
                                </button>
                            </div>
                        </div>
                    </div>
                      
                </div>


                <!-- Virtualclass Settings -->
                <div class="tab-pane fade mt-2" id="virtualclass-settings" role="tabpanel" aria-labelledby="virtualclass-settings-tab">
                    <form id="virtualClassesettingsForm" action="<?= base_url('virtualclasses/updateSettings') ?>" method="post">
                        <!-- Select Virtualclass -->
                        <div class="form-group">
                            <label for="virtualclass_id">Select Virtualclass</label>
                            <select id="virtualclass_id" name="virtualclass_id" class="form-control">
                                <!-- Populate with existing virtualClasses -->
                                <?php foreach ($virtualClasses as $virtualclass): ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        
                        <!-- Virtualclass Status -->
                        <div class="form-group">
                            <label for="virtualclass_status">Virtualclass Status</label>
                            <select id="virtualclass_status" name="virtualclass_status" class="form-control">
                                <option value="not_published">Not Published (Hidden)</option>
                                <option value="unlocked">Unlocked (Early Access)</option>
                                <option value="published">Published (Publicly Visible)</option>
                            </select>
                        </div>
                        
                        <!-- Assign Virtualclass and Dates -->
                        <div class="form-group">
                            <label for="assign_virtualclass_dates">Assign Virtualclass and Dates</label>
                            <input type="text" id="assign_virtualclass_dates" name="assign_virtualclass_dates" class="form-control" placeholder="Enter course and date details">
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

                <!-- Virtualclass Calendar Setup -->
                <div class="tab-pane fade mt-2" id="virtualclass-calendar-setup" role="tabpanel" aria-labelledby="virtualclass-calendar-setup-tab">
                    <form id="virtualClassesetupForm" action="<?= base_url('virtualclasses/updateSettings') ?>" method="post">
                       

                        <!-- Calendar API Key Setup -->
                        <div class="form-group">
                            <label for="assign_virtualclass_dates">API Key Setup</label>
                            <input type="text" id="calendar_apikey_setup" name="calendar_apikey_setup" class="form-control" placeholder="Enter Calendar APIKey">
                        </div>
                        
                        
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </form>
                </div>

            </div>

            <div class="watermark">
                <img src="./assets/img/omppeak-logo.png" alt="Watermark">
            </div>
    </main>
    
    <!-- Modal for Creating Virtualclass -->
    <div class="modal fade" id="createVirtualclassModal" tabindex="-1" role="dialog" aria-labelledby="createVirtualclassModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createVirtualclassModalLabel">Create New Virtualclass</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="virtualclassForm" action="<?= base_url('virtualclasses/store') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="virtualclass_name">Virtual Class Name</label>
                            <input type="text" id="virtualclass_name" name="virtualclass_name" class="form-control" value="<?= old('virtualclass_name') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="virtualclass_start_date">Virtual Class Start Date</label>
                            <input type="date" id="virtualclass_start_date" name="virtualclass_start_date" class="form-control" value="<?= old('virtualclass_start_date') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="virtualclass_end_date">Virtual Class End Date</label>
                            <input type="date" id="virtualclass_end_date" name="virtualclass_end_date" class="form-control" value="<?= old('virtualclass_end_date') ?>" required>
                        </div>
                        <!-- <div class="form-group">
                            <label for="virtualclass_apikey">API KEY</label>
                            <input type="text" id="virtualclass_apikey" name="virtualclass_apikey" class="form-control" value="<?= old('virtualclass_apikey') ?>" required>
                        </div> -->
                        <div class="form-group">
                            <label for="virtualclass_description">Virtualclass Content</label>
                            <textarea id="virtualclass_description" name="virtualclass_description" class="form-control" rows="4"><?= old('virtualclass_description') ?></textarea>
                        </div>
                        
                        
                        <button type="submit" class="btn btn-primary">Save Virtualclass</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Virtualclass -->
    <div class="modal fade" id="editVirtualclassModal" tabindex="-1" role="dialog" aria-labelledby="editVirtualclassModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editVirtualclassModalLabel">Edit Virtualclass</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editVirtualclassForm" action="<?= base_url('virtualclasses/update') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" id="edit_virtualclass_id" name="virtualclass_id">
                        <div class="form-group">
                            <label for="edit_virtualclass_name">Virtualclass Name</label>
                            <input type="text" id="edit_virtualclass_name" name="virtualclass_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_virtualclass_description">Description</label>
                            <textarea id="edit_virtualclass_description" name="virtualclass_description" class="form-control" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Virtualclass</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Editing Virtualclass -->
    <div class="modal fade" id="previewVirtualclassModal" tabindex="-1" role="dialog" aria-labelledby="previewVirtualclassModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewVirtualclassModalLabel">Edit Virtualclass</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>Virtualclass Name: Babados afana</div>
                    <div>Virtualclass Description: ajalarusure</div>
                </div>
            </div>
        </div>
    </div>


   
</div>


    <script src="<?= base_url('packages/core/main.js') ?>"></script>
    <script src="<?= base_url('packages/interaction/main.js') ?>"></script>
    <script src="<?= base_url('packages/moment/main.js') ?>"></script>
    <script src="<?= base_url('packages/moment-timezone/main.js') ?>"></script>
    <script src="<?= base_url('packages/daygrid/main.js') ?>"></script>
    <script src="<?= base_url('packages/timegrid/main.js') ?>"></script>
    <script src="<?= base_url('packages/list/main.js') ?>"></script>
    <script src="<?= base_url('packages/google-calendar/main.js') ?>"></script>
    <script>
       
        $(document).ready(function() {
            $('#export-options').hide();

            $('#export-btn').click(function() {
                $('#export-options').toggle();
            });

            $(document).click(function(event) {
                if (!$(event.target).closest('#export-btn, #export-options').length) {
                    $('#export-options').hide();
                }
            });
        });

        function addHeaderToTable(clonedTable, courseTitle) {
            // Create a header row
            let headerRow = clonedTable.insertRow(0);
            let cell1 = headerRow.insertCell(0);
            cell1.colSpan = clonedTable.rows[1].cells.length;
            cell1.style.textAlign = 'center';
            cell1.innerHTML = `<strong>${courseTitle} Virtualclass - LearnXa</strong>`;
        }

        document.getElementById('export-excel-btn').addEventListener('click', () => {
            // Select the table inside the VirtualclassPreview div
            let table = document.querySelector('#virtualclassPreview table');
            let courseTitle = document.getElementById('virtualclass_preview_id').selectedOptions[0].text;

            if (table) {
                // Clone the table to add headers
                let clonedTable = table.cloneNode(true);
                addHeaderToTable(clonedTable, courseTitle);

                // Convert table to worksheet
                let worksheet = XLSX.utils.table_to_sheet(clonedTable);

                // Create a new workbook
                let workbook = XLSX.utils.book_new();

                // Append worksheet to workbook
                XLSX.utils.book_append_sheet(workbook, worksheet, 'virtualclass');

                // Export to Excel with course title in filename
                XLSX.writeFile(workbook, `${courseTitle}_Virtualclass.xlsx`);
            } else {
                alert('No Virtualclass data to export');
            }
        });

        document.getElementById('export-csv-btn').addEventListener('click', () => {
            // Select the table inside the VirtualclassPreview div
            let table = document.querySelector('#virtualclassPreview table');
            let courseTitle = document.getElementById('virtualclass_preview_id').selectedOptions[0].text;

            if (table) {
                // Clone the table to add headers
                let clonedTable = table.cloneNode(true);
                addHeaderToTable(clonedTable, courseTitle);

                // Convert table to CSV
                let csv = XLSX.utils.sheet_to_csv(XLSX.utils.table_to_sheet(clonedTable));

                // Create a blob from the CSV string
                let blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });

                // Create a link element to download the CSV with course title in filename
                let link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = `${courseTitle}_Virtualclass.csv`;
                link.click();
            } else {
                alert('No Virtualclass data to export');
            }
        });

        document.getElementById('export-word-btn').addEventListener('click', () => {
            // Select the table inside the VirtualclassPreview div
            let table = document.querySelector('#virtualclassPreview table');
            let courseTitle = document.getElementById('virtualclass_preview_id').selectedOptions[0].text;

            if (table) {
                // Clone the table to add headers
                let clonedTable = table.cloneNode(true);
                addHeaderToTable(clonedTable, courseTitle);

                // Convert table to HTML string
                let tableHTML = clonedTable.outerHTML;

                // Create a blob from the HTML string
                let blob = new Blob([tableHTML], { type: 'application/msword;charset=utf-8;' });

                // Create a link element to download the Word document with course title in filename
                let link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = `${courseTitle}_Virtualclass.doc`;
                link.click();
            } else {
                alert('No Virtualclass data to export');
            }
        });

        document.getElementById('export-pdf-btn').addEventListener('click', () => {
            // Select the table
            let table = document.querySelector('#virtualclassPreview table');
            let courseTitle = document.getElementById('virtualclass_preview_id').selectedOptions[0].text;

            if (!table) {
                alert('No table to export!');
                return;
            }

            // Clone the table to add headers
            let clonedTable = table.cloneNode(true);
            addHeaderToTable(clonedTable, courseTitle);

            // Create a new jsPDF instance
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Use autoTable to generate the PDF table
            doc.autoTable({ html: clonedTable });

            // Save the PDF with course title in filename
            doc.save(`${courseTitle}_Virtualclass.pdf`);
        });


        
        $(document).ready(function() {
            $('#assign_course_id').select2();
            $('#assign_course_id').change(function() {
                var course_id = $(this).val();
                if (course_id) {
                    fetchCoursesForClass(course_id);
                }
            });


            $('#virtualclass_preview_id').change(function() {
            const virtualClassId = $(this).val();
            if (virtualClassId) {
                $.ajax({
                    url: `<?= base_url('virtualclasses/getVirtualClassDetails') ?>/${virtualClassId}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.virtualclass) {
                            $('#virtualclassPreview').html(`
                                <div class="mb-3 font-weight-bold border p-2 shadow-sm">${response.virtualclass.virtualclass_name} Virtualclass</div>
                                <p>${response.virtualclass.virtualclass_start_date}</p>
                                <p>${response.virtualclass.virtualclass_end_date}</p>
                                <p>${response.virtualclass.virtualclass_description}</p>
                            `);
                        } else {
                            $('#virtualclassPreview').html('<p>Virtualclass not found</p>');
                        }
                    },
                    error: function() {
                        $('#virtualclassPreview').html('<p>Failed to fetch Virtualclass details</p>');
                    }
                });
            } else {
                $('#virtualclassPreview').html('');
            }
        });
        });


       // Fetching Courses for Class
function fetchCoursesForClass(class_id) {
    // Make an API call to fetch courses assigned and available for the selected class
    axios.get(`<?= base_url('virtualclasses/getCoursesForVirtualClass') ?>/${class_id}`)
        .then(response => {
            var assignedCourses = response.data.assignedCourses; // Courses already assigned to the class
            var availableCourses = response.data.allCourses; // All available courses that can be assigned
            var courseSection = $('#courseSection'); // The section where the form and tables will be inserted

            // Clear the course section before appending new content
            courseSection.empty();

            // Generate the HTML for the available courses select dropdown
            var availableCoursesHtml = `
                <div class="form-group">
                    <label for="course_ids">Select Courses to Assign</label>
                    <select id="course_ids" name="courses[]" class="form-control" multiple="multiple" required>
                        ${availableCourses.map(course => `<option value="${course.course_id}">${course.course_title}</option>`).join('')}
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Assign Courses</button>
            `;

            // Append the available courses dropdown to the course section
            courseSection.append(availableCoursesHtml);

            // Initialize the select2 plugin for the courses dropdown
            $('#course_ids').select2();

            // Check if there are any assigned courses
            if (assignedCourses.length > 0) {
                // Generate the HTML for the table displaying assigned courses
                var tableHtml = `
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                // Loop through the assigned courses and add each to the table
                assignedCourses.forEach(course => {
                    tableHtml += `
                        <tr>
                            <td>${course.course_title}</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" onclick="removeCourseFromVirtualClass(${class_id}, ${course.course_id})">Remove</button>
                            </td>
                        </tr>
                    `;
                });

                // Close the table HTML tags
                tableHtml += `
                        </tbody>
                    </table>
                `;

                // Append the generated table to the course section
                courseSection.append(tableHtml);
            } else {
                // If no courses are assigned, display a message
                courseSection.append('<p>No Courses assigned to this class. Please assign courses.</p>');
            }
        })
        .catch(error => {
            // Handle any errors that occur during the API call
            console.error('Error fetching courses for class:', error);
        });
}



    


       // Remove Virtual Class
   function removeCourseFromVirtualClass(virtualClassId, courseId) {
            if (confirm('Are you sure you want to remove this Course from the virtual class?')) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                if (!csrfToken) {
                    console.error('CSRF token not found.');
                    return;
                }

                axios.post(`<?= base_url('virtualclasses/removeCourseFromVirtualClass') ?>/${virtualClassId}/${courseId}`, {}, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => {
                    console.log(response.data); // Log response for debugging
                    if (response.data.status === 'success') {
                        alert(response.data.message);
                        fetchCoursesForClass(courseId); // Refresh the list
                    } else {
                        alert(response.data.message);
                    }
                })
                .catch(error => {
                    console.error('Error removing Course from Virtual Class:', error);
                });
            }
        }


        // Fetching Timetables for Class
        function fetchTimetablesForClass(timetable_id) {
            axios.get(`<?= base_url('virtualclasses/getTimetablesForClass') ?>/${timetable_id}`)
                .then(response => {
                    var assignedTimetables = response.data.assignedTimetables;
                    var availableTimetables = response.data.allTimetables;
                    var timetablesSection = $('#timetablesSection');

                    timetablesSection.empty();

                    var availableTimetablesHtml = `
                        <div class="form-group">
                            <label for="timetable_ids">Select Timetables to Assign</label>
                            <select id="timetable_ids" name="timeTables[]" class="form-control" multiple="multiple" required>
                                ${availableTimetables.map(timetable => `<option value="${timetable.timetable_id}">${timetable.timetable_name}</option>`).join('')}
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Assign Timetables</button>
                    `;

                    timetablesSection.append(availableTimetablesHtml);

                    $('#timetable_ids').select2();

                    if (assignedTimetables.length > 0) {
                        var tableHtml = `
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Timetable</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                        `;

                        assignedTimetables.forEach(timetable => {
                            tableHtml += `
                                <tr>
                                    <td>${timetable.timetable_name}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="removeTimetableFromClass(${timetable_id}, ${timetable.timetable_id})">Remove</button>
                                    </td>
                                </tr>
                            `;
                        });

                        tableHtml += `
                                </tbody>
                            </table>
                        `;

                        timetablesSection.append(tableHtml);
                    } else {
                        timetablesSection.append('No Timetable assigned to this class. Please assign Timetable.');
                    }
                })
                .catch(error => {
                    console.error('Error fetching Timetable for course:', error);
                });
        }


        // Remove Timetable Class
        function removeTimetableFromClass(virtualClassId, timetableId) {
            if (confirm('Are you sure you want to remove this Virtualclass from the course?')) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                if (!csrfToken) {
                    console.error('CSRF token not found.');
                    return;
                }

                axios.post(`<?= base_url('virtualclasses/removeVirtualClassTimetable') ?>/${virtualClassId}/${timetableId}`, {}, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => {
                    console.log(response.data); // Log response for debugging
                    if (response.data.status === 'success') {
                        alert(response.data.message);
                        fetchTimetablesForClass(timetableId); // Refresh the list
                    } else {
                        alert(response.data.message);
                    }
                })
                .catch(error => {
                    console.error('Error removing Virtualclass from course:', error);
                });
            }
        }

        // Fetching and populating of virtual class
        $(document).ready(function() {
            $('#virtualclass_id').change(function() {
                const VirtualClassId = $(this).val();
                if (virtualClassId) {
                    $.ajax({
                        url: `<?= base_url('virtualclasses/getVirtualclassDetails') ?>/${virtualClassId}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.virtualclasses) {
                                $('#virtualclassPreview').html(`
                                    <h3>${response.virtualclasses.virtualclass_name}</h3>
                                    <p>${response.virtualclasses.virtualclass_description}</p>
                                `);
                            } else {
                                $('#virtualclassPreview').html('<p>Virtualclass not found</p>');
                            }
                        },
                        error: function() {
                            $('#virtualclassPreview').html('<p>Failed to fetch Virtualclass details</p>');
                        }
                    });
                } else {
                    $('#virtualclassPreview').html('');
                }
            });
        });


        
        
        
        let editorInstance;
        let editEditorInstance;
        let isFormDirty = false;


        document.addEventListener('DOMContentLoaded', function() {

            ClassicEditor
                .create(document.querySelector('#virtualclass_description'))
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
                .create(document.querySelector('#edit_virtualclass_description'))
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

            document.getElementById('virtualclassForm').addEventListener('submit', function() {
                if (editorInstance) {
                    document.getElementById('virtualclass_description').value = editorInstance.getData();
                }
                isFormDirty = false; // Reset the form dirty flag on submit
            });

            document.getElementById('editVirtualclassForm').addEventListener('submit', function() {
                if (editEditorInstance) {
                    document.getElementById('edit_virtualclass_description').value = editEditorInstance.getData();
                }
                isFormDirty = false; // Reset the form dirty flag on submit
            });

            loadvirtualclasses();

            document.getElementById('search').addEventListener('input', loadvirtualclasses);
            document.getElementById('sort').addEventListener('change', loadvirtualclasses);
        });

        // Fetching of the classes and their details and check the status
        function loadvirtualclasses() {
            const search = document.getElementById('search').value;
            const sort = document.getElementById('sort').value;

            axios.get('<?= base_url('virtualclasses/list') ?>', {
                params: {
                    search: search,
                    sort: sort
                }
            })
            .then(response => {
                const virtualClasses = response.data.virtualClasses;
                const pagination = response.data.pagination;
                const tbody = document.getElementById('virtualclassTableBody');
                const paginationElem = document.getElementById('pagination');

                tbody.innerHTML = '';

                virtualClasses.forEach(virtualclass => {
                    const startDate = new Date(virtualclass.virtualclass_start_date);
                    const endDate = new Date(virtualclass.virtualclass_end_date);
                    const currentDate = new Date();

                    console.log(`Start Date: ${startDate}`);
                    console.log(`End Date: ${endDate}`);

                    // Calculate class duration in milliseconds
                    const durationMs = endDate - startDate;
                    console.log(`Duration in ms: ${durationMs}`);

                    const totalClassHours = Math.ceil(durationMs / (1000 * 60 * 60));
                    console.log(`Total Class Hours: ${totalClassHours}`);

                    const classDays = Math.floor(totalClassHours / 24);
                    const classHours = totalClassHours % 24;
                    console.log(`Class Days: ${classDays}, Class Hours: ${classHours}`);

                    // Determine status
                    let status = '';
                    if (currentDate < startDate) {
                        status = `<p class="text-primary">Upcoming</p>`;
                    } else if (currentDate > endDate) {
                        status = `<p class="text-muted">Ended</p>`;
                    } else {
                        const totalHoursLeft = Math.ceil((endDate - currentDate) / (1000 * 60 * 60));
                        const daysLeft = Math.floor(totalHoursLeft / 24);
                        const hoursLeft = totalHoursLeft % 24;
                        status = `<p class="text-success">Ongoing<br><span class="text-danger">${daysLeft} days ${hoursLeft} hours left</span></p>`;
                    }

                    // const durationDisplay = `${classDays} days${classHours > 0 ? ` ${classHours} hours` : ''}`;
                    const hoursPerDay = 10;
                    const totalHoursForTheClass = Math.floor(totalClassHours / hoursPerDay);
                    const durationDisplay = `${classDays} days ${totalHoursForTheClass}hours`;

                    const row = `
                        <tr>
                            <td>${virtualclass.virtualclass_id}</td>
                            <td>${virtualclass.virtualclass_name}</td>
                            <td>
                                <div class="text-center">
                                    ${virtualclass.virtualclass_start_date}<br>to<br>${virtualclass.virtualclass_end_date}
                                </div>
                            </td>
                            <td>${status}</td>
                            <td>${durationDisplay}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="openEditModal(${virtualclass.virtualclass_id})" data-toggle="modal" data-target="#editVirtualclassModal">Edit</button>
                                <a href="<?= base_url('virtualclasses/delete/') ?>${virtualclass.virtualclass_id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Virtualclass?')">Delete</a>
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


        // Loading page function so that all info will be retrieved
        function loadPage(page) {
            axios.get('<?= base_url('virtualclasses/list') ?>', {
                params: {
                    search: document.getElementById('search').value,
                    sort: document.getElementById('sort').value,
                    page: page
                }
            })
            .then(response => {
                const virtualClasses = response.data.virtualClasses;
                const pagination = response.data.pagination;
                const tbody = document.getElementById('virtualclassTableBody');
                const paginationElem = document.getElementById('pagination');

                tbody.innerHTML = '';
                virtualClasses.forEach(virtualclass => {
                    const row = `
                        <tr>
                            <td>${virtualclass.virtualclass_id}</td>
                            <td>${virtualclass.virtualclass_name}</td>
                            <td>${virtualclass.virtualclass_description}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="openEditModal(${virtualclass.virtualclass_id})" data-toggle="modal" data-target="#editVirtualclassModal">Edit</button>
                                <a href="<?= base_url('virtualclasses/delete/') ?>${virtualclass.virtualclass_id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Virtualclass?')">Delete</a>
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

        function openEditModal(virtualClassId) {
            axios.get('<?= base_url('virtualclasses/edit/') ?>' + VirtualclassId)
            .then(response => {
                const Virtualclass = response.data.virtualclass;

                document.getElementById('edit_virtualclass_id').value = Virtualclass.virtualclass_id;
                document.getElementById('edit_virtualclass_name').value = Virtualclass.virtualclass_name;
                editEditorInstance.setData(virtualClass.virtualclass_description);

                $('#editVirtualclassModal').modal('show');
            })
            .catch(error => {
                console.error(error);
            });
        }

        $('#createVirtualclassModal').on('hide.bs.modal', function(e) {
            if (isFormDirty) {
                if (!confirm('You have unsaved changes. Are you sure you want to close the modal?')) {
                    e.preventDefault();
                } else {
                    isFormDirty = false;
                }
            }
        });

        $('#editVirtualclassModal').on('hide.bs.modal', function(e) {
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


       
        // Calendar
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('load-calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['interaction', 'dayGrid', 'timeGrid', 'list', 'googleCalendar',
                    'momentTimezonePlugin', 'momentPlugin'
                ],
                initialView: 'dayGridMonth',
                firstDay: 1,
                locale: 'en',
                timeZone: 'local',
                editable: true,
                selectable: true,
                selectHelper: true,
                displayEventTime: true,
                buttonIcons: true,
                weekNumbers: false,
                navLinks: true,
                editable: true,
                eventLimit: true,
                header: {
                    left: 'prevYear, prev,next, nextYear, today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                buttonText: {
                    today: "Today",
                    month: "Month",
                    week: "Week",
                    day: "Day",
                    listMonth: 'List'
                },
                googleCalendarApiKey: 'AIzaSyB6to01Dz3W6iHj5oQjkvt4JOybvT0J4eA',
                eventSources: [], // Initially empty, will be updated on selection
                loading: function (bool) {
                    document.getElementById('loading').style.display = bool ? 'block' : 'none';
                },
            });

            calendar.render();

            // Event handler for Virtualclass selection
            document.getElementById('virtualclass_calendar_id').addEventListener('change', function () {
                var selectedOption = this.options[this.selectedIndex];
                var VirtualclassUrl = selectedOption.getAttribute('data-url');

                // Update the calendar with new URL
                calendar.removeAllEventSources(); // Remove existing event sources
                if (virtualClassUrl) {
                    calendar.addEventSource({
                        url: VirtualclassUrl,
                        dataType: 'jsonp',
                        className: 'feed_one'
                    });
                }
                calendar.refetchEvents(); // Refetch events
            });
        });


        // Toggle sidebar when the toggle button is clicked
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Close sidebar when clicking on the main content area
        document.getElementById('mainContent').addEventListener('click', function (e) {
            // Check if the click target is not the sidebar or the sidebar toggle button
            if (!document.getElementById('sidebar').contains(e.target) && e.target.id !== 'sidebarToggle') {
                document.getElementById('sidebar').classList.remove('show');
            }
        });

        // Toggle search form visibility when the search icon is clicked
        document.getElementById('searchIcon').addEventListener('click', function () {
            var searchForm = document.getElementById('searchForm');
            if (searchForm.classList.contains('d-none')) {
                searchForm.classList.remove('d-none');
                searchForm.classList.add('d-flex');
            } else {
                searchForm.classList.remove('d-flex');
                searchForm.classList.add('d-none');
            }
        });
    </script>


</body>
</html>
