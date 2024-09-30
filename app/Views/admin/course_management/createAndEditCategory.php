<?php include(APPPATH .'Views/admin/include/head.php'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
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
            <div class="mb-3 font-weight-bold">Create/Edit Category</div>
            <section class="create-edit-course">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- Display validation errors if any -->
     <?php if (session()->has('message')) : ?>
                                    <?= view('include/message') ?>
                                    <?php endif ?>
                        <form action="<?= base_url('admin/category/save') ?>" method="post" enctype="multipart/form-data" onsubmit="showLoadingSpinner()">
            
                            <div class="form-group">
                                <label for="categoryName">Category Name</label>
                                <input type="text" class="form-control" id="categoryName" name="category-name"
                                    placeholder="Enter Category Name" required>
                            </div>
                            <div class="form-group">
                                <label for="categoryDescription">Category Description</label>
                                <textarea class="form-control" id="categoryDescription" name="category-description"
                                    rows="3" placeholder="Enter Category description" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="categoryImage">Category Image</label>
                                <input type="file" class="form-control-file" id="categoryImage" name="category_image"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Course</button>
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
</body>

</html>