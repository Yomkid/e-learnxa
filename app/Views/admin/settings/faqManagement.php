<?php include(APPPATH .'Views/admin/include/head.php'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
</style>

<body>
<?php include(APPPATH . 'Views/admin/include/sidebar.php'); ?>
    <main id="main" class="main p-0">
        <?php include(APPPATH . 'Views/admin/include/nav2.php'); ?>
        <div class="container mt-2" id="mainContent">
            <div class="mb-3 font-weight-bold">FAQ Management</div>
            <section class="faq-management">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- FAQ list -->
                        <div class="accordion" id="faqAccordion">
                            <div class="card">
                                <div class="card-header" id="faqHeadingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#faqCollapseOne" aria-expanded="true"
                                            aria-controls="faqCollapseOne">
                                            How do I reset my password?
                                        </button>
                                    </h2>
                                </div>

                                <div id="faqCollapseOne" class="collapse show" aria-labelledby="faqHeadingOne"
                                    data-parent="#faqAccordion">
                                    <div class="card-body">
                                        To reset your password, go to the login page and click on the "Forgot
                                        Password"
                                        link. Follow the instructions to reset your password.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="faqHeadingTwo">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#faqCollapseTwo" aria-expanded="false"
                                            aria-controls="faqCollapseTwo">
                                            How can I enroll in a course?
                                        </button>
                                    </h2>
                                </div>
                                <div id="faqCollapseTwo" class="collapse" aria-labelledby="faqHeadingTwo"
                                    data-parent="#faqAccordion">
                                    <div class="card-body">
                                        To enroll in a course, go to the course catalog and click on the "Enroll"
                                        button
                                        next to the course you want to take.
                                    </div>
                                </div>
                            </div>
                            <!-- Add more FAQ items as needed -->
                        </div>
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
</body>
</html>
