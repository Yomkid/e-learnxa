<!DOCTYPE html>
<html lang="en">

<head>
    <title>React - The Complete Guide 2024 (incl. Next.js, Redux) | LearnXa</title>
    <?php include(APPPATH . 'Views/student/include/student-head.php'); ?>

    <style>
        .course-card {
            /* border: 1px solid #e0e0e0; */
            /* border-radius: 10px; */
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            background-color: #fff;
            margin: 0.5rem 0;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            color: #00c3ff;
        }

        .course-card img {
            border: 1px solid #e0e0e0;
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
    </style>
</head>

<body style="background-color: #f2f2f2;">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-6">
                <?php include(APPPATH . 'Views/student/include/student-sidebar.php'); ?>
            </div>


            <div class="col-lg-10 col-md-6">
                <?php include(APPPATH . 'Views/student/include/student-navbar.php'); ?>

                <div class="main-container mt-2 p-2" id="mainContent">

                    <div class="">
                        <div class="category-header" style="font-size:17px;">
                            Payment Receipts
                        </div>
                        <p>Below are the receipts of the payments you have made so far</p>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">Item Description</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Timestamp</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td scope="row">1</td>
                                    <td>Registration Fee</td>
                                    <td>2,000</td>
                                    <td>1/9/2024</td>
                                    <td><button class="btn btn-success bg-transparent text-success">Download <i
                                                class="fas fa-download"></i></button></td>
                                </tr>
                                <tr class="">
                                    <td scope="row">2</td>
                                    <td>React - The Complete Guide 2024 (incl. Next.js, Redux) | LearnXa</td>
                                    <td>2,000</td>
                                    <td>1/9/2024</td>
                                    <td><button class="btn btn-success bg-transparent text-success">Download <i
                                                class="fas fa-download"></i></button></td>
                                </tr>

                                <tr class="">
                                    <td scope="row">3</td>
                                    <td>Python Programming for Computer Engineering Students</td>
                                    <td>2,000</td>
                                    <td>1/9/2024</td>
                                    <td><button class="btn btn-success bg-transparent text-success">Download <i
                                                class="fas fa-download"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>






        <!-- Bootstrap JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- FontAwesome for icons -->
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script>
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
        <!-- Custom JS -->
        <script src="scripts.js"></script>
</body>

</html>