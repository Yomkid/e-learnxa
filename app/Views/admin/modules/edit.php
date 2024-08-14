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
            <div class="mb-3 font-weight-bold">Edit Module</div>
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="<?= base_url('modules/update/'.$module['module_id']) ?>" method="post">
                        <div class="form-group">
                            <label for="course_id">Course</label>
                            <select class="form-control" id="course_id" name="course_id" required>
                                <option value="">Select Course</option>
                                <?php foreach ($courses as $course) : ?>
                                <option value="<?= $course['course_id'] ?>" <?= $module['course_id'] == $course['course_id'] ? 'selected' : '' ?>><?= $course['course_title'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="module_name">Module Name</label>
                            <input type="text" class="form-control" id="module_name" name="module_name" value="<?= $module['module_name'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="module_description">Module Description</label>
                            <textarea class="form-control" id="module_description" name="module_description" rows="3"><?= $module['module_description'] ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Module</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php include(APPPATH . 'Views/admin/include/js.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
