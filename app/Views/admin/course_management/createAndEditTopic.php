<?php include(APPPATH . 'Views/admin/include/head.php'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
<style>
   #loading {
    display: none; /* Hidden by default */
    position: fixed;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
  }
  
  .spinner {
    /* border: 4px solid rgba(0, 0, 0, 0.1); */
    border: 4px solid rgba(9, 116, 237, 0.1);
    width: 36px;
    height: 36px;
    border-radius: 50%;
    /* border-top-color: #333; */
    border-top-color: #007bff;
    animation: spin 1s ease-in-out infinite;
  }
  
  @keyframes spin {
    to {
      transform: rotate(360deg);
    }
  }
</style>

<body>
    <?php include(APPPATH . 'Views/admin/include/sidebar.php'); ?>
    <main id="main" class="main p-0">
        <?php include(APPPATH . 'Views/admin/include/nav2.php'); ?>
        <!-- Loading Spinner -->
        <div id="loading">
            <div class="spinner"></div>
        </div>
        <div class="container mt-2" id="mainContent">
            <div class="mb-3 font-weight-bold">Create/Edit Topic</div>
            <section class="create-edit-course">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="<?= base_url('topic/save') ?>" method="post" enctype="multipart/form-data"
                            onsubmit="showLoadingSpinner()">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="categoryID">Select Categories</label>
                                        <?php if (!empty($categories)): ?>
                                        <?php foreach ($categories as $category): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="categories[]"
                                                value="<?= $category['category_id'] ?>"
                                                id="category<?= $category['category_id'] ?>">
                                            <label class="form-check-label"
                                                for="category<?= $category['category_id'] ?>">
                                                <?= $category['category_name'] ?>
                                            </label>
                                        </div>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <p>No categories found.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <!-- Display validation errors if any -->
                                    <?php if (session()->has('message')) : ?>
                                    <?= view('include/message') ?>
                                    <?php endif ?>
                                    
                                    <div class="form-group">
                                        <label for="TopicName">Topic Name</label>
                                        <input type="text" class="form-control" id="topicName" name="topic-name"
                                            placeholder="Enter Topic Name" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Topic</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <?php include(APPPATH . 'Views/admin/include/js.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/script.js"></script>
    <script src="<?= base_url('/assets/js/main-scripts.js'); ?>"></script>
    <script>
        function showLoadingSpinner() {
            document.getElementById('loading').style.display = 'flex';
        }
    </script>
</body>

</html>