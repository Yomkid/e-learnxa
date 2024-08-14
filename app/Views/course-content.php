<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FpiUpdates</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/styles.css">
    <style>
        .sidebar {
            color: white;
            background-color: rgb(9, 60, 9);
            height: 100vh;
            border-radius: 15px;
            position: fixed;
            top: 0;
            padding-top: 20px;
            padding-bottom: 20px;
            transition: transform 0.3s ease;
            left: auto;
            z-index: 1030;
        }

        .main-content {
            height: 100vh;
            border-radius: 15px;
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            padding: 20px;
            overflow: auto;
            z-index: 1020;
        }

        .content {
            padding-top: 20px;
        }

        .active-menu {
            border-right: green solid 4px;
            background-color: #495057;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(4, 244, 8, 0.1);
        }

        .sidebar .nav-link {
            color: white;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #495057;
            transform: translateX(-5px);
        }

        .sidebar .nav-item+.nav-item {
            margin-top: 10px;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .box-shadow {
            border-radius: 15px;
        }

        .content-hero-section {
            background: url('./assets/img/fpicover.PNG') no-repeat center center/cover;
            height: 25vh;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .profile-hero-text {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .instructor img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
            border: green solid 2px;
        }

        .navbar-nav .dropdown-menu {
            right: 0;
            left: auto;
        }

        .custom-btn {
            background-color: none;
            font-size: 17px;
            color: black;
            border: none;
            border-radius: none;
            padding: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .custom-btn:hover {
            background-color: none;
        }

        .custom-search-form input {
            border-radius: none;
            border: none;
            padding: 10px;
        }

        .custom-search-form button {
            border-radius: none;
            border: none;
            background-color: none;
            color: black;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .custom-search-form button:hover {
            background-color: none;
        }

        .dropdown-toggle::after {
            display: none !important;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #333;
        }

        .navbar-light .navbar-nav .nav-link:hover {
            color: #007bff;
        }

        .dropdown-menu {
            padding: 10px;
            border-radius: 5px;
        }

        .dropdown-menu h5 {
            margin: 0;
            font-size: 16px;
        }

        .dropdown-menu h6 {
            margin: 0;
            font-size: 14px;
            color: grey;
        }

        @media (max-width: 768px) {
            .custom-search-form {
                display: none;
            }

            .custom-btn#searchIcon {
                display: inline-block;
            }
        }

        @media (min-width: 769px) {
            .custom-btn#searchIcon {
                display: none;
            }
        }
    </style>
</head>

<body style="background-color: #f0fff7;">
    <!-- Navigation Bar -->

    <div class="main-container container-fluid box-shadow" stylle="background-color: #ffff; border-radius: 15px;">
        <div class="row">
            <div class="col-lg-2 col-md-6 mt-3">
                <div class="box-shadow">
                    <div class="sidebar d-flex flex-column" id="sidebar">
                        <a href="#"
                            class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none justify-content-center">
                            <h5 style="font-weight: bolder;">LearnXa</h5>
                        </a>
                        <hr>
                        <ul class="nav nav-pills flex-column mb-auto">
                            <li class="nav-item">
                                <a href="#" class="nav-link active-menu">
                                    <i class="fas fa-tachometer-alt"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link">
                                    <i class="fas fa-credit-card"></i>
                                    Payment
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link">
                                    <i class="fas fa-clipboard-list"></i>
                                    Registration
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link">
                                    <i class="fas fa-book"></i>
                                    Courses
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link">
                                    <i class="fas fa-tasks"></i>
                                    Assignments
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link">
                                    <i class="fas fa-pencil-alt"></i>
                                    Tests
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link">
                                    <i class="fas fa-chart-line"></i>
                                    Result
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-10 col-md-6 main-content">
                <?php include(APPPATH . 'Views/include/newNav1.php'); ?>
                <!-- Hero Section -->
                <div class="box-shadow">
                    <div class="content-hero-section">
                        <div class="container text-white bottom-text">
                            <div class="row">
                                <!-- Hero Text -->
                                <div class="col-md-6 profile-hero-text pt-3 pl-5">
                                    <div class="text-white">
                                        <p>May 30, 2024</p>
                                    </div>
                                    <div>
                                        <h5 class="fw-bolder" style="font-weight: bold; font-size: 24px;">Welcome back,
                                            Mayor!</h5>
                                        <p style="font-size: small;">Always stay connected in your student portal</p>
                                    </div>
                                </div>
                                <div class="col-md-6 text-center text-md-right align-items-right justify-content-right">
                                    <img src="./assets/img/student.PNG" alt=""
                                        style="max-width: fit-content; width:140px;" class="img-fluid"
                                        style="max-width: 100%; height: auto;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 mx-auto">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <div class="popular-categories" style="font-size:17px;">
                                        Finance
                                    </div>
                                </div>
                                <div class="row card-group">
                                    <div class="col-md-4 col-sm-6 mb-3">
                                        <div class="card card-custom">
                                            <div class="card-body text-center">
                                                <i class="fas fa-file-alt card-icon"></i>
                                                <h5 class="card-title mt-3">Fee Schedule</h5>
                                                <p class="card-text">Manage your fee schedules.</p>
                                                <a href="#" class="btn btn-primary">View</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-3">
                                        <div class="card card-custom">
                                            <div class="card-body text-center">
                                                <i class="fas fa-wallet card-icon"></i>
                                                <h5 class="card-title mt-3">Payments</h5>
                                                <p class="card-text">View your payment history.</p>
                                                <a href="#" class="btn btn-primary">View</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-3">
                                        <div class="card card-custom">
                                            <div class="card-body text-center">
                                                <i class="fas fa-calendar-alt card-icon"></i>
                                                <h5 class="card-title mt-3">Payment Plan</h5>
                                                <p class="card-text">Create a payment plan.</p>
                                                <a href="#" class="btn btn-primary">Create</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="card card-custom">
                                    <div class="card-body text-center">
                                        <i class="fas fa-file-alt card-icon"></i>
                                        <h5 class="card-title mt-3">Finance Summary</h5>
                                        <p class="card-text">View your finance summary.</p>
                                        <a href="#" class="btn btn-primary">View</a>
                                    </div>
                                </div>
                                <div class="card card-custom mt-3">
                                    <div class="card-body text-center">
                                        <i class="fas fa-wallet card-icon"></i>
                                        <h5 class="card-title mt-3">Payments</h5>
                                        <p class="card-text">View your payment history.</p>
                                        <a href="#" class="btn btn-primary">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-custom mt-3">
                            <div class="card-body">
                                <h5 class="card-title">Transaction History</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2023-01-01</td>
                                            <td>Tuition Fee</td>
                                            <td>$500</td>
                                            <td>Paid</td>
                                        </tr>
                                        <tr>
                                            <td>2023-02-01</td>
                                            <td>Library Fee</td>
                                            <td>$50</td>
                                            <td>Pending</td>
                                        </tr>
                                        <tr>
                                            <td>2023-03-01</td>
                                            <td>Lab Fee</td>
                                            <td>$100</td>
                                            <td>Paid</td>
                                        </tr>
                                        <tr>
                                            <td>2023-04-01</td>
                                            <td>Hostel Fee</td>
                                            <td>$200</td>
                                            <td>Paid</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 mx-auto">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <div class="popular-categories" style="font-size:17px;">
                                        Registration
                                    </div>
                                </div>
                                <div class="row card-group">
                                    <div class="col-md-4 col-sm-6 mb-3">
                                        <div class="card card-custom">
                                            <div class="card-body text-center">
                                                <i class="fas fa-file-alt card-icon"></i>
                                                <h5 class="card-title mt-3">View Courses</h5>
                                                <p class="card-text">See all available courses.</p>
                                                <a href="#" class="btn btn-primary">View</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-3">
                                        <div class="card card-custom">
                                            <div class="card-body text-center">
                                                <i class="fas fa-calendar-alt card-icon"></i>
                                                <h5 class="card-title mt-3">Timetable</h5>
                                                <p class="card-text">Check your class schedule.</p>
                                                <a href="#" class="btn btn-primary">View</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-3">
                                        <div class="card card-custom">
                                            <div class="card-body text-center">
                                                <i class="fas fa-book card-icon"></i>
                                                <h5 class="card-title mt-3">Register</h5>
                                                <p class="card-text">Register for new courses.</p>
                                                <a href="#" class="btn btn-primary">Register</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="card card-custom">
                                    <div class="card-body text-center">
                                        <i class="fas fa-file-alt card-icon"></i>
                                        <h5 class="card-title mt-3">Registration Summary</h5>
                                        <p class="card-text">View your registration summary.</p>
                                        <a href="#" class="btn btn-primary">View</a>
                                    </div>
                                </div>
                                <div class="card card-custom mt-3">
                                    <div class="card-body text-center">
                                        <i class="fas fa-wallet card-icon"></i>
                                        <h5 class="card-title mt-3">Documents</h5>
                                        <p class="card-text">View your registration documents.</p>
                                        <a href="#" class="btn btn-primary">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-custom mt-3">
                            <div class="card-body">
                                <h5 class="card-title">Courses</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Course Code</th>
                                            <th>Course Title</th>
                                            <th>Credits</th>
                                            <th>Instructor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>CSE101</td>
                                            <td>Introduction to Computer Science</td>
                                            <td>3</td>
                                            <td>Prof. John Doe</td>
                                        </tr>
                                        <tr>
                                            <td>MATH101</td>
                                            <td>Calculus I</td>
                                            <td>4</td>
                                            <td>Dr. Jane Smith</td>
                                        </tr>
                                        <tr>
                                            <td>PHY101</td>
                                            <td>Physics I</td>
                                            <td>3</td>
                                            <td>Prof. Mark Johnson</td>
                                        </tr>
                                        <tr>
                                            <td>ENG101</td>
                                            <td>English Literature</td>
                                            <td>2</td>
                                            <td>Ms. Emily Brown</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add more content here -->

            </div>
        </div>
    </div>
</body>

</html>
