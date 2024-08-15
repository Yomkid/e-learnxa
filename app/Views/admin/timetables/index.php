<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(APPPATH . 'Views/admin/include/head.php'); ?>
    <title>Timetable Management | LearnXa</title>
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
    <link href='packages/core/main.css' rel='stylesheet' />
    <link href='packages/daygrid/main.css' rel='stylesheet' />
    <link href='packages/list/main.css' rel='stylesheet' />

    <style>
        /* styles.css */
        body,
        html {
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
            pointer-events: none;
            /* Makes the watermark non-interactive */
            user-select: none;
            /* Prevents text selection */
        }

        .watermark img {
            width: 300px;
            /* Adjust the size as needed */
            height: auto;
        }
    </style>


</head>

<body>
    <?php include(APPPATH . 'Views/admin/include/sidebar.php'); ?>
    <main id="main" class="main thecontent p-0">
        <?php include(APPPATH . 'Views/admin/include/nav2.php'); ?>
        <div class="container mt-2" id="mainContent">
            <div class="mb-3 font-weight-bold">TIMETABLE MANAGEMENT</div>
            <!-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createTimetableModal">Create Timetable</button> -->


            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="timetableTabs" role="tablist">
                <li class="nav-item">
                    <a class="btn nav-link" id="add-timetable-tab" data-toggle="modal"
                        data-target="#createTimetableModal" role="tab" aria-controls="add-timetable"
                        aria-selected="false">ADD Timetable</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="timetable-bank-tab" data-toggle="tab" href="#timetable-bank"
                        role="tab" aria-controls="timetable-bank" aria-selected="true">Timetable Lists</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="add-bulk-timetable-tab" data-toggle="tab" href="#add-bulk-timetable"
                        role="tab" aria-controls="bulk-timetable" aria-selected="false">Import</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="export-timetable-tab" data-toggle="tab" href="#export-timetable" role="tab"
                        aria-controls="export-timetable" aria-selected="false">Export</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="assign-timetables-tab" data-toggle="tab" href="#assign-timetables"
                        role="tab" aria-controls="assign-timetable" aria-selected="false">Assign</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="timetable-calendar-preview-tab" data-toggle="tab"
                        href="#timetable-calendar-preview" role="tab" aria-controls="timetable-calendar-preview"
                        aria-selected="false">Calendars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="timetable-preview-tab" data-toggle="tab" href="#timetable-preview"
                        role="tab" aria-controls="timetable-preview" aria-selected="false">Timetables</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="timetable-settings-tab" data-toggle="tab" href="#timetable-settings"
                        role="tab" aria-controls="timetable-settings" aria-selected="false">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="timetable-calnedar-setup-tab" data-toggle="tab"
                        href="#timetable-calendar-setup" role="tab" aria-controls="timetable-calendar-setup"
                        aria-selected="false">Setup</a>
                </li>
            </ul>


            <!-- Tab Content -->
            <div class="tab-content" id="questionTabsContent">
                <!-- Display validation errors if any -->
                <?php if (session()->has('message')) : ?>
                <?= view('include/message') ?>
                <?php endif ?>

                <!-- Timetable Bank Tab -->
                <div class="tab-pane fade show active" id="timetable-bank" role="tabpanel"
                    aria-labelledby="timetable-bank-tab">
                    <div class="row my-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" id="search" class="form-control" placeholder="Search Timetables...">
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
                                        <th>Timetable Name</th>
                                        <th>Timetable URL</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="timetableTableBody">
                                    <!-- Timetables will be loaded here via JavaScript -->
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
                <div class="tab-pane fade" id="add-bulk-timetable" role="tabpanel"
                    aria-labelledby="add-bulk-timetable-tab">

                    <form id="bulkUploadForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="timetable_file">Upload Timetable File (CSV/Excel)</label>
                            <input type="file" id="timetable_file" name="timetable_file" class="form-control"
                                accept=".csv, .xlsx" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>

                <!-- Export to CSV -->
                <div class="tab-pane fade" id="export-timetable" role="tabpanel" aria-labelledby="export-timetable-tab">
                    <form action="<?= base_url('timetables/exportTimetables') ?>" method="post">
                        <div class="form-group">
                            <label for="timetable_id">Select Timetable</label>
                            <select id="timetable_id" name="timetable_id" class="form-control">
                                <option value="">All Timetables</option>
                                <?php if (!empty($timetables)): ?>
                                <?php foreach ($timetables as $timetable): ?>
                                <option value="<?= $timetable['timetable_id'] ?>"><?= $timetable['timetable_name'] ?>
                                </option>
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
                <!-- Assign Timetables to Course -->
                <!-- Assign Timetables to Course -->
                <div class="tab-pane fade mt-2" id="assign-timetables" role="tabpanel"
                    aria-labelledby="assign-timetables-tab">
                    <form id="assignTimetablesForm" action="<?= base_url('timetables/assignTimetables') ?>"
                        method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="course_id">Select Course</label>
                            <select id="assign_course_id" name="course_id" class="form-control" required>
                                <option value="">Select a course</option>
                                <?php if (!empty($courses)): ?>
                                <?php foreach ($courses as $course): ?>
                                <option value="<?= $course['course_id'] ?>"
                                    data-image="<?= base_url('uploads/' . $course['course_image']) ?>">
                                    <?= $course['course_title'] ?>
                                </option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div id="timetableSection"></div>
                    </form>
                </div>



                <!-- Timetable Calendar -->
                <div class="tab-pane fade mt-2" id="timetable-calendar-preview" role="tabpanel"
                    aria-labelledby="timetable-calendar-preview-tab">
                    <!-- Select Timetable -->
                    <div class="form-group">
                        <label for="timetable_calendar_id">Select Timetable</label>
                        <select id="timetable_calendar_id" name="timetable_calendar_id" class="form-control">
                            <!-- Populate with existing Timetables -->
                            <option value="" disabled selected>Select a timetable</option>
                            <?php foreach ($timetables as $timetable): ?>
                            <option value="<?= $timetable['timetable_id'] ?>"
                                data-url="<?= $timetable['timetable_url'] ?>"><?= $timetable['timetable_name'] ?>
                            </option>
                            <?php endforeach; ?>
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



                <!-- Timetable Preview -->
                <div class="tab-pane fade mt-2" id="timetable-preview" role="tabpanel"
                    aria-labelledby="timetable-preview-tab">
                    <!-- Select Timetable -->
                    <div class="form-group">
                        <label for="timetable_preview_id">Select Timetable</label>
                        <select id="timetable_preview_id" name="timetable_preview_id" class="form-control">
                            <!-- Populate with existing Timetables -->
                            <option value="" disabled selected>Select a timetable</option>
                            <?php foreach ($timetables as $timetable): ?>
                            <option value="<?= $timetable['timetable_id'] ?>"><?= $timetable['timetable_name'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="timetablePreview"></div>
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


                <!-- Timetable Settings -->
                <div class="tab-pane fade mt-2" id="timetable-settings" role="tabpanel"
                    aria-labelledby="timetable-settings-tab">
                    <form id="timetableSettingsForm" action="<?= base_url('timetables/updateSettings') ?>"
                        method="post">
                        <!-- Select Timetable -->
                        <div class="form-group">
                            <label for="timetable_id">Select Timetable</label>
                            <select id="timetable_id" name="timetable_id" class="form-control">
                                <!-- Populate with existing Timetables -->
                                <?php foreach ($timetables as $timetable): ?>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <!-- Timetable Status -->
                        <div class="form-group">
                            <label for="timetable_status">Timetable Status</label>
                            <select id="timetable_status" name="timetable_status" class="form-control">
                                <option value="not_published">Not Published (Hidden)</option>
                                <option value="unlocked">Unlocked (Early Access)</option>
                                <option value="published">Published (Publicly Visible)</option>
                            </select>
                        </div>

                        <!-- Assign Timetable and Dates -->
                        <div class="form-group">
                            <label for="assign_timetable_dates">Assign Timetable and Dates</label>
                            <input type="text" id="assign_timetable_dates" name="assign_timetable_dates"
                                class="form-control" placeholder="Enter course and date details">
                        </div>

                        <!-- Time Limit -->
                        <div class="form-group">
                            <label for="time_limit">Time Limit (minutes)</label>
                            <input type="number" id="time_limit" name="time_limit" class="form-control"
                                placeholder="Enter time limit in minutes">
                        </div>

                        <!-- Attempts Allowed -->
                        <div class="form-group">
                            <label for="attempts_allowed">Attempts Allowed</label>
                            <input type="number" id="attempts_allowed" name="attempts_allowed" class="form-control"
                                placeholder="Enter number of attempts allowed">
                        </div>

                        <!-- Passing Score -->
                        <div class="form-group">
                            <label for="passing_score">Passing Score (%)</label>
                            <input type="number" id="passing_score" name="passing_score" class="form-control"
                                placeholder="Enter passing score percentage">
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
                            <input type="number" id="retakes" name="retakes" class="form-control"
                                placeholder="Enter number of retakes allowed">
                        </div>

                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </form>
                </div>

                <!-- Timetable Calendar Setup -->
                <div class="tab-pane fade mt-2" id="timetable-calendar-setup" role="tabpanel"
                    aria-labelledby="timetable-calendar-setup-tab">
                    <form id="timetableSetupForm" action="<?= base_url('timetables/updateSettings') ?>" method="post">


                        <!-- Calendar API Key Setup -->
                        <div class="form-group">
                            <label for="assign_timetable_dates">API Key Setup</label>
                            <input type="text" id="calendar_apikey_setup" name="calendar_apikey_setup"
                                class="form-control" placeholder="Enter Calendar APIKey">
                        </div>


                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </form>
                </div>

            </div>

            <div class="watermark">
                <img src="./assets/img/omppeak-logo.png" alt="Watermark">
            </div>
    </main>

    <!-- Modal for Creating Timetable -->
    <div class="modal fade" id="createTimetableModal" tabindex="-1" role="dialog"
        aria-labelledby="createTimetableModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTimetableModalLabel">Create New Timetable</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="timetableForm" action="<?= base_url('timetables/store') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="timetable_name">Timetable Name</label>
                            <input type="text" id="timetable_name" name="timetable_name" class="form-control"
                                value="<?= old('timetable_name') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="timetable_url">Timetable Calendar URL</label>
                            <input type="text" id="timetable_url" name="timetable_url" class="form-control"
                                value="<?= old('timetable_url') ?>" required>
                        </div>
                        <!-- <div class="form-group">
                            <label for="timetable_apikey">API KEY</label>
                            <input type="text" id="timetable_apikey" name="timetable_apikey" class="form-control" value="<?= old('timetable_apikey') ?>" required>
                        </div> -->
                        <div class="form-group">
                            <label for="timetable_description">Timetable Content</label>
                            <textarea id="timetable_description" name="timetable_description" class="form-control"
                                rows="4"><?= old('timetable_description') ?></textarea>
                        </div>


                        <button type="submit" class="btn btn-primary">Save Timetable</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Timetable -->
    <div class="modal fade" id="editTimetableModal" tabindex="-1" role="dialog"
        aria-labelledby="editTimetableModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTimetableModalLabel">Edit Timetable</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editTimetableForm" action="<?= base_url('timetables/update') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" id="edit_timetable_id" name="timetable_id">
                        <div class="form-group">
                            <label for="edit_timetable_name">Timetable Name</label>
                            <input type="text" id="edit_timetable_name" name="timetable_name" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="edit_timetable_description">Description</label>
                            <textarea id="edit_timetable_description" name="timetable_description" class="form-control"
                                rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Timetable</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Editing Timetable -->
    <div class="modal fade" id="previewTimetableModal" tabindex="-1" role="dialog"
        aria-labelledby="previewTimetableModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewTimetableModalLabel">Edit Timetable</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>Timetable Name: Babados afana</div>
                    <div>Timetable Description: ajalarusure</div>
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
        $(document).ready(function () {
            $('#export-options').hide();

            $('#export-btn').click(function () {
                $('#export-options').toggle();
            });

            $(document).click(function (event) {
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
            cell1.innerHTML = `<strong>${courseTitle} Timetable - LearnXa</strong>`;
        }

        document.getElementById('export-excel-btn').addEventListener('click', () => {
            // Select the table inside the timetablePreview div
            let table = document.querySelector('#timetablePreview table');
            let courseTitle = document.getElementById('timetable_preview_id').selectedOptions[0].text;

            if (table) {
                // Clone the table to add headers
                let clonedTable = table.cloneNode(true);
                addHeaderToTable(clonedTable, courseTitle);

                // Convert table to worksheet
                let worksheet = XLSX.utils.table_to_sheet(clonedTable);

                // Create a new workbook
                let workbook = XLSX.utils.book_new();

                // Append worksheet to workbook
                XLSX.utils.book_append_sheet(workbook, worksheet, 'Timetable');

                // Export to Excel with course title in filename
                XLSX.writeFile(workbook, `${courseTitle}_Timetable.xlsx`);
            } else {
                alert('No timetable data to export');
            }
        });

        document.getElementById('export-csv-btn').addEventListener('click', () => {
            // Select the table inside the timetablePreview div
            let table = document.querySelector('#timetablePreview table');
            let courseTitle = document.getElementById('timetable_preview_id').selectedOptions[0].text;

            if (table) {
                // Clone the table to add headers
                let clonedTable = table.cloneNode(true);
                addHeaderToTable(clonedTable, courseTitle);

                // Convert table to CSV
                let csv = XLSX.utils.sheet_to_csv(XLSX.utils.table_to_sheet(clonedTable));

                // Create a blob from the CSV string
                let blob = new Blob([csv], {
                    type: 'text/csv;charset=utf-8;'
                });

                // Create a link element to download the CSV with course title in filename
                let link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = `${courseTitle}_Timetable.csv`;
                link.click();
            } else {
                alert('No timetable data to export');
            }
        });

        document.getElementById('export-word-btn').addEventListener('click', () => {
            // Select the table inside the timetablePreview div
            let table = document.querySelector('#timetablePreview table');
            let courseTitle = document.getElementById('timetable_preview_id').selectedOptions[0].text;

            if (table) {
                // Clone the table to add headers
                let clonedTable = table.cloneNode(true);
                addHeaderToTable(clonedTable, courseTitle);

                // Convert table to HTML string
                let tableHTML = clonedTable.outerHTML;

                // Create a blob from the HTML string
                let blob = new Blob([tableHTML], {
                    type: 'application/msword;charset=utf-8;'
                });

                // Create a link element to download the Word document with course title in filename
                let link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = `${courseTitle}_Timetable.doc`;
                link.click();
            } else {
                alert('No timetable data to export');
            }
        });

        document.getElementById('export-pdf-btn').addEventListener('click', () => {
            // Select the table
            let table = document.querySelector('#timetablePreview table');
            let courseTitle = document.getElementById('timetable_preview_id').selectedOptions[0].text;

            if (!table) {
                alert('No table to export!');
                return;
            }

            // Clone the table to add headers
            let clonedTable = table.cloneNode(true);
            addHeaderToTable(clonedTable, courseTitle);

            // Create a new jsPDF instance
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            // Use autoTable to generate the PDF table
            doc.autoTable({
                html: clonedTable
            });

            // Save the PDF with course title in filename
            doc.save(`${courseTitle}_Timetable.pdf`);
        });



        $(document).ready(function () {
            $('#assign_course_id').select2();
            $('#assign_course_id').change(function () {
                var course_id = $(this).val();
                if (course_id) {
                    fetchTimetablesForCourse(course_id);
                }
            });


            $('#timetable_preview_id').change(function () {
                const timetableId = $(this).val();
                if (timetableId) {
                    $.ajax({
                        url: `<?= base_url('timetables/getTimetableDetails') ?>/${timetableId}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            if (response.timetable) {
                                $('#timetablePreview').html(`
                                <div class="mb-3 font-weight-bold border p-2 shadow-sm">${response.timetable.timetable_name} Timetable</div>
                                <p>${response.timetable.timetable_description}</p>
                            `);
                            } else {
                                $('#timetablePreview').html('<p>Timetable not found</p>');
                            }
                        },
                        error: function () {
                            $('#timetablePreview').html(
                                '<p>Failed to fetch timetable details</p>');
                        }
                    });
                } else {
                    $('#timetablePreview').html('');
                }
            });
        });

        function fetchTimetablesForCourse(course_id) {
            axios.get(`<?= base_url('timetables/getTimetablesForCourse') ?>/${course_id}`)
                .then(response => {
                    var Timetables = response.data.assignedTimetables;
                    var availableTimetables = response.data.alltimetables;
                    var TimetableSection = $('#timetableSection');

                    TimetableSection.empty();

                    var availableTimetablesHtml = `
                    
                        <div class="form-group">
                            <label for="timetable_ids">Select Timetables to Assign</label>
                            <select id="timetable_ids" name="timetables[]" class="form-control" multiple="multiple" required>
                                ${availableTimetables.map(Timetable => `<option value="${timetable.timetable_id}">${timetable.timetable_name}</option>`).join('')}
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Assign Timetables</button>`;

                    TimetableSection.append(availableTimetablesHtml);

                    $('#timetable_ids').select2();

                    if (timetables.length > 0) {
                        var tableHtml = `
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Timetable Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>`;

                        Timetables.forEach(Timetable => {
                            tableHtml += `
                                <tr>
                                    <td>${timetable.timetable_name}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="removeTimetableFromCourse(${course_id}, ${timetable.timetable_id})">Remove</button>
                                    </td>
                                </tr>`;
                        });

                        tableHtml += `
                                </tbody>
                            </table>`;

                        TimetableSection.append(tableHtml);
                    } else {
                        TimetableSection.append(
                            '<p>No Timetables assigned to this course. Please assign Timetables.</p>');
                    }


                })
                .catch(error => {
                    console.error('Error fetching Timetables for course:', error);
                });
        }


        function removeTimetableFromCourse(courseId, TimetableId) {
            if (confirm('Are you sure you want to remove this Timetable from the course?')) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                if (!csrfToken) {
                    console.error('CSRF token not found.');
                    return;
                }

                axios.post(`<?= base_url('timetables/removeTimetable') ?>/${courseId}/${timetableId}`, {}, {
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => {
                        console.log(response.data); // Log response for debugging
                        if (response.data.status === 'success') {
                            alert(response.data.message);
                            fetchTimetablesForCourse(courseId); // Refresh the list
                        } else {
                            alert(response.data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error removing Timetable from course:', error);
                    });
            }
        }


        $(document).ready(function () {
            $('#timetable_id').change(function () {
                const timetableId = $(this).val();
                if (timetableId) {
                    $.ajax({
                        url: `<?= base_url('timetables/getTimetableDetails') ?>/${timetableId}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            if (response.timetables) {
                                $('#timetablePreview').html(`
                                    <h3>${response.timetables.timetable_name}</h3>
                                    <p>${response.timetables.timetable_description}</p>
                                `);
                            } else {
                                $('#timetablePreview').html('<p>Timetable not found</p>');
                            }
                        },
                        error: function () {
                            $('#timetablePreview').html(
                                '<p>Failed to fetch timetable details</p>');
                        }
                    });
                } else {
                    $('#timetablePreview').html('');
                }
            });
        });





        let editorInstance;
        let editEditorInstance;
        let isFormDirty = false;


        document.addEventListener('DOMContentLoaded', function () {

            ClassicEditor
                .create(document.querySelector('#timetable_description'))
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
                .create(document.querySelector('#edit_timetable_description'))
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

            document.getElementById('timetableForm').addEventListener('submit', function () {
                if (editorInstance) {
                    document.getElementById('timetable_description').value = editorInstance.getData();
                }
                isFormDirty = false; // Reset the form dirty flag on submit
            });

            document.getElementById('editTimetableForm').addEventListener('submit', function () {
                if (editEditorInstance) {
                    document.getElementById('edit_timetable_description').value = editEditorInstance
                        .getData();
                }
                isFormDirty = false; // Reset the form dirty flag on submit
            });

            loadTimetables();

            document.getElementById('search').addEventListener('input', loadTimetables);
            document.getElementById('sort').addEventListener('change', loadTimetables);
        });

        function loadTimetables() {
            const search = document.getElementById('search').value;
            const sort = document.getElementById('sort').value;

            axios.get('<?= base_url('
                    timetables / list ') ?>', {
                        params: {
                            search: search,
                            sort: sort
                        }
                    })
                .then(response => {
                    const Timetables = response.data.timetables;
                    const pagination = response.data.pagination;
                    const tbody = document.getElementById('timetableTableBody');
                    const paginationElem = document.getElementById('pagination');

                    tbody.innerHTML = '';
                    Timetables.forEach(timetable => {
                        const row = `
                        <tr>
                            <td>${timetable.timetable_id}</td>
                            <td>${timetable.timetable_name}</td>
                            <td>${timetable.timetable_url}</td>
                            <td>
                                <button class="btn btn-success btn-sm" onclick="openPreviewModal(${timetable.timetable_id})" data-toggle="modal" data-target="#previewTimetableModal">Preview</button>
                                <button class="btn btn-warning btn-sm" onclick="openEditModal(${timetable.timetable_id})" data-toggle="modal" data-target="#editTimetableModal">Edit</button>
                                <a href="<?= base_url('timetables/delete/') ?>${timetable.timetable_id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Timetable?')">Delete</a>
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
            axios.get('<?= base_url('
                    timetables / list ') ?>', {
                        params: {
                            search: document.getElementById('search').value,
                            sort: document.getElementById('sort').value,
                            page: page
                        }
                    })
                .then(response => {
                    const Timetables = response.data.timetables;
                    const pagination = response.data.pagination;
                    const tbody = document.getElementById('timetableTableBody');
                    const paginationElem = document.getElementById('pagination');

                    tbody.innerHTML = '';
                    Timetables.forEach(Timetable => {
                        const row = `
                        <tr>
                            <td>${timetable.timetable_id}</td>
                            <td>${timetable.timetable_name}</td>
                            <td>${timetable.timetable_description}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="openEditModal(${timetable.timetable_id})" data-toggle="modal" data-target="#editTimetableModal">Edit</button>
                                <a href="<?= base_url('timetables/delete/') ?>${timetable.timetable_id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Timetable?')">Delete</a>
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

        function openEditModal(timetableId) {
            axios.get('<?= base_url('
                    timetables / edit / ') ?>' + TimetableId)
                .then(response => {
                    const Timetable = response.data.timetable;

                    document.getElementById('edit_timetable_id').value = Timetable.timetable_id;
                    document.getElementById('edit_timetable_name').value = Timetable.timetable_name;
                    editEditorInstance.setData(timetable.timetable_description);

                    $('#editTimetableModal').modal('show');
                })
                .catch(error => {
                    console.error(error);
                });
        }

        $('#createTimetableModal').on('hide.bs.modal', function (e) {
            if (isFormDirty) {
                if (!confirm('You have unsaved changes. Are you sure you want to close the modal?')) {
                    e.preventDefault();
                } else {
                    isFormDirty = false;
                }
            }
        });

        $('#editTimetableModal').on('hide.bs.modal', function (e) {
            if (isFormDirty) {
                if (!confirm('You have unsaved changes. Are you sure you want to close the modal?')) {
                    e.preventDefault();
                } else {
                    isFormDirty = false;
                }
            }
        });

        window.addEventListener('beforeunload', function (event) {
            if (isFormDirty) {
                event.preventDefault();
                event.returnValue = 'Changes you made may not be saved.';
            }
        });




        // // Calendar Setup Section
        // // Calendar Integration with Google
        // document.addEventListener('DOMContentLoaded', function () {
        //     var calendarEl = document.getElementById('load-calendar');

        //     var calendar = new FullCalendar.Calendar(calendarEl, {
        //         // load plugins
        //         plugins: ['interaction', 'dayGrid', 'timeGrid', 'list', 'googleCalendar',
        //             'momentTimezonePlugin', 'momentPlugin'
        //         ],
        //         firstDay: 1,
        //         locale: 'en',
        //         timeZone: 'local',
        //         editable: true,
        //         selectable: true,
        //         selectHelper: true,
        //         displayEventTime: true, // don't show the time column in list view
        //         buttonIcons: true, // show the prev/next text
        //         weekNumbers: false,
        //         navLinks: true, // can click day/week names to navigate views
        //         editable: true,
        //         eventLimit: true, // allow "more" link when too many events
        //         // calendar header
        //         header: {
        //             left: 'prevYear, prev,next, nextYear, today',
        //             center: 'title',
        //             right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        //         },
        //         // change button text
        //         buttonText: {
        //             today: "Today",
        //             month: "Month",
        //             week: "Week",
        //             day: "Day",
        //             listMonth: 'List'
        //         },
        //         // THIS KEY WON'T WORK IN PRODUCTION!!!
        //         // To make your own Google API key, follow the directions here:
        //         // http://fullcalendar.io/docs/google_calendar/
        //         // The API Key can only work for the particular email, to setup another API will be for another email
        //         googleCalendarApiKey: 'AIzaSyB6to01Dz3W6iHj5oQjkvt4JOybvT0J4eA',
        //         // US Holidays
        //         eventSources: [{
        //                 // Any URL must be related to the email used to created the APIKey
        //                 // url: "odewayemayomi@gmail.com",
        //                 // url: "elearnxa@gmail.com",
        //                 url: "d6cba05f633ff08bc8401ec6a1b101a8766fb17adfcbd31194185b76f6fe6a60@group.calendar.google.com",
        //                 dataType: 'jsonp',
        //                 className: 'feed_one'
        //             },
        //             {
        //                 // url: "<base_url();?>event/loadEventData",
        //                 // dataType: 'jsonp',
        //                 // className: 'feed_two',
        //             }
        //         ],

        //         loading: function (bool) {
        //             document.getElementById('loading').style.display =
        //                 bool ? 'block' : 'none';
        //         },

        //     });

        //     calendar.render();
        // });



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

            // Event handler for timetable selection
            document.getElementById('timetable_calendar_id').addEventListener('change', function () {
                var selectedOption = this.options[this.selectedIndex];
                var timetableUrl = selectedOption.getAttribute('data-url');

                // Update the calendar with new URL
                calendar.removeAllEventSources(); // Remove existing event sources
                if (timetableUrl) {
                    calendar.addEventSource({
                        url: timetableUrl,
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