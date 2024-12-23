<?php include(APPPATH . 'Views/admin/include/head.php'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

<meta name="csrf-token" content="<?= csrf_hash() ?>">

<style>
    i {
        color: #007bff;
    }

    .logo-section {
        position: sticky;
        top: 0;
        z-index: 1000;
        text-align: center;
        font-weight: bolder;
    }

    .select2-container--default .select2-results__option {
        display: flex;
        align-items: center;
    }

    .right-sidebar {
        border-left: 1px solid #ddd;
        padding: 15px;
        background-color: #f9f9f9;
        height: 100%;
    }

    /* Spinner container */
    #spinner {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        /* Semi-transparent background */
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1050;
    }

    /* Spinner container */
    .spinner-container {
        position: relative;
        display: flex;
        align-items: center;
        /* Center logo and spinner vertically */
        justify-content: center;
        /* Center logo and spinner horizontally */
        text-align: center;
    }

    /* Logo styling */
    .spinner-logo {
        font-size: 28px;
        font-weight: bold;
        /* margin-bottom: 20px; */
        color: #000;
        width: 100px;
        height: 100px;
        display: flex;
        align-items: center;
        /* Vertically center text */
        justify-content: center;
        /* Horizontally center text */
        border-radius: 50%;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    /* Logo text styling */
    .spinner-logo .navbar-brand {
        font-size: 18px;
        color: #000;
    }

    /* Spinner circle */
    .spinner-circle {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 120px;
        height: 120px;
        border: 4px solid transparent;
        border-top: 4px solid #007bff;
        /* LearnXa Primary Color */
        border-right: 4px solid #007bff;
        border-radius: 50%;
        transform: translate(-50%, -50%);
        /* Center the spinner circle */
        animation: spin 1.5s linear infinite;
    }

    /* Spinner rotation animation */
    @keyframes spin {
        0% {
            transform: translate(-50%, -50%) rotate(0deg);
        }
        100% {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }

    /* Drag and Drop Area */
    .attachment-drop-area {
        border: 2px dashed #007bff;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        color: #6c757d;
    }

    .attachment-drop-area:hover {
        background-color: #f8f9fa;
    }

    /* File Previews */
    .attachment-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .attachment-item {
        position: relative;
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        width: 100px;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        background-color: #fff;
    }

    .attachment-item img,
    .attachment-item video,
    .attachment-item audio {
        max-width: 80px;
        max-height: 60px;
        margin-bottom: 5px;
    }

    .attachment-item .file-icon {
        font-size: 24px;
        color: #007bff;
    }

    .attachment-item span {
        font-size: 12px;
        text-align: center;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 80px;
    }

    .attachment-item .remove-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: #dc3545;
        color: #fff;
        border: none;
        border-radius: 50%;
        font-size: 14px;
        cursor: pointer;
        width: 20px;
        height: 20px;
        line-height: 18px;
        text-align: center;
    }
</style>

<body>
    <?php include(APPPATH . 'Views/admin/include/sidebar.php'); ?>
    <main id="main" class="main p-0">
        <?php include(APPPATH . 'Views/admin/include/nav2.php'); ?>
        <div class="container mt-2" id="mainContent">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-9">
                    <div class="mb-3 font-weight-bold">Announcements</div>

                    <div id="spinner" class="d-none">
                        <div class="spinner-container">
                            <div class="spinner-logo">
                                <div class="navbar-brand text-center">
                                    <span>Learn<span style="color: #007bff;">X</span>a</span>
                                </div>
                            </div>
                            <div class="spinner-circle"></div>
                        </div>
                    </div>

                    <section class="announcements">
                        <div id="responseMessage"></div>
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <form id="announcementForm" method="POST"
                                    action="<?= site_url('admin/announcements/send_announcement'); ?>">
                                    <div class="mb-3">
                                        <label for="userSelection" class="form-label">Select Recipients</label>
                                        <select class="form-control" id="userSelection" name="recipients[]"
                                            multiple="multiple">
                                            <option value="all">All Users</option>
                                            <?php if (!empty($users)): ?>
                                            <?php foreach ($users as $user): ?>
                                            <option value="<?= esc($user['email']); ?>">
                                                <?= esc($user['username']); ?> (<?= esc($user['email']); ?>)
                                            </option>
                                            <?php endforeach; ?>
                                            <?php else: ?>
                                            <option disabled>No users available</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="announcementTitle" class="form-label">Announcement Title</label>
                                        <input type="text" class="form-control" id="announcementTitle" name="title"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="announcementContent" class="form-label">Announcement Content</label>
                                        <textarea class="form-control" id="announcementContent" name="content"
                                            rows="5"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="attachments" class="form-label">Attachments</label>
                                        <div id="attachmentDropArea" class="attachment-drop-area">
                                            <p>Drag & Drop files here or click to select</p>
                                            <input type="file" id="attachments" name="attachments[]" multiple
                                                style="display: none;">
                                        </div>
                                        <div id="attachmentPreview" class="attachment-preview mt-3">
                                            <!-- Previews will appear here -->
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-primary">Send Announcement</button>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Right Sidebar -->
                <div class="col-lg-3 right-sidebar">
                    <h5>Announcement Tips</h5>
                    <ul>
                        <li>Keep your message concise and clear.</li>
                        <li>Ensure the title reflects the content of the announcement.</li>
                        <li>Verify recipient list before sending.</li>
                        <li>Preview your announcement content to avoid errors.</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <?php include(APPPATH . 'Views/admin/include/js.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize Select2
            $('#userSelection').select2({
                placeholder: "Select recipients",
                allowClear: true,
                width: '100%',
            });

            // Initialize CKEditor
            let editorInstance;
            ClassicEditor
                .create(document.querySelector('#announcementContent'))
                .then(editor => {
                    editorInstance = editor;
                })
                .catch(error => {
                    console.error('Error initializing CKEditor:', error);
                });

            // Form submission handler
            $('#announcementForm').on('submit', function (e) {
                e.preventDefault();

                // Ensure CKEditor content is synced
                if (editorInstance) {
                    const announcementContent = editorInstance.getData();
                    if (!announcementContent.trim()) {
                        alert("Announcement content is required.");
                        return;
                    }
                    $('#announcementContent').val(announcementContent);
                }

                // Show the spinner
                $('#spinner').removeClass('d-none');

                const formData = new FormData(this);

                // AJAX submission
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        // Hide the spinner
                        $('#spinner').addClass('d-none');

                        // Display success message
                        const messageHtml =
                            `<div class="alert alert-success">${response.message}</div>`;
                        $('#responseMessage').html(messageHtml);

                        // Reset form elements
                        $('#userSelection').val(null).trigger('change');
                        if (editorInstance) editorInstance.setData('');
                    },
                    error: function (xhr) {
                        // Hide the spinner
                        $('#spinner').addClass('d-none');

                        // Display error message
                        const errorMessage = xhr.responseJSON && xhr.responseJSON.error ?
                            xhr.responseJSON.error :
                            'An unexpected error occurred';
                        const messageHtml =
                            `<div class="alert alert-danger">${errorMessage}</div>`;
                        $('#responseMessage').html(messageHtml);
                    }
                });
            });
        });


        document.addEventListener('DOMContentLoaded', () => {
            const dropArea = document.getElementById('attachmentDropArea');
            const fileInput = document.getElementById('attachments');
            const previewContainer = document.getElementById('attachmentPreview');

            const fileIcons = {
                image: 'fa-file-image',
                video: 'fa-file-video',
                audio: 'fa-file-audio',
                document: 'fa-file-alt',
                default: 'fa-file'
            };

            // Click on drop area to open file input
            dropArea.addEventListener('click', () => fileInput.click());

            // Handle drag and drop
            dropArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropArea.classList.add('dragover');
            });

            dropArea.addEventListener('dragleave', () => dropArea.classList.remove('dragover'));

            dropArea.addEventListener('drop', (e) => {
                e.preventDefault();
                dropArea.classList.remove('dragover');
                handleFiles(e.dataTransfer.files);
            });

            // Handle file selection
            fileInput.addEventListener('change', (e) => handleFiles(e.target.files));

            // Handle files and generate previews
            function handleFiles(files) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = () => {
                        const fileType = file.type.split('/')[0];
                        const previewItem = document.createElement('div');
                        previewItem.className = 'attachment-item';

                        if (fileType === 'image') {
                            const img = document.createElement('img');
                            img.src = reader.result;
                            previewItem.appendChild(img);
                        } else if (fileType === 'video' || fileType === 'audio') {
                            const media = document.createElement(fileType);
                            media.src = reader.result;
                            media.controls = true;
                            previewItem.appendChild(media);
                        } else {
                            const icon = document.createElement('i');
                            icon.className = `fas ${fileIcons[fileType] || fileIcons.default}`;
                            previewItem.appendChild(icon);
                        }

                        const fileName = document.createElement('span');
                        fileName.textContent = file.name;
                        previewItem.appendChild(fileName);

                        const removeBtn = document.createElement('button');
                        removeBtn.className = 'remove-btn';
                        removeBtn.innerHTML = '&times;';
                        removeBtn.onclick = () => previewItem.remove();
                        previewItem.appendChild(removeBtn);

                        previewContainer.appendChild(previewItem);
                    };

                    reader.readAsDataURL(file);
                });
            }
        });
    </script>

</body>

</html>