
    <?php include(APPPATH . 'Views/admin/include/head.php'); ?>
    <title>Modules Management | LearnXa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            <div class="mb-3 font-weight-bold">MODULES MANAGEMENT</div>
            <a href="<?= base_url('admin/modules/create') ?>" class="btn btn-primary mb-3">Create Module</a>
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Course</th>
                                <th>Module Name</th>
                                <th>Module Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($modules as $module): ?>
                            <tr>
                                <td><?= $module['module_id'] ?></td>
                                <td><?= $module['course_id'] ?></td>
                                <td><?= $module['module_name'] ?></td>
                                <td><?= $module['module_description'] ?></td>
                                <td>
                                    <a href="<?= base_url('admin/modules/edit/'.$module['module_id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= base_url('admin/modules/delete/'.$module['module_id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this module?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <?php include(APPPATH . 'Views/admin/include/js.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
