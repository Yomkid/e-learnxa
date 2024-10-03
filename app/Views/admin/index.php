<?php include(APPPATH .'Views/admin/include/head.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- <link href="https://unpkg.com/gridstack/dist/gridstack.min.css" rel="stylesheet"> -->
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

<!-- FullCalendar -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>

<!-- Map -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>




<style>
    i {
        color: #007bff;
    }

    /* Logo section styling */
    .logo-section {
        position: sticky;
        top: 0;
        z-index: 1000;
        text-align: center;
        font-weight: bolder;
        /* Ensure logo is above other sidebar content */

    }
</style>

<body>
    <!-- ======= Sidebar ======= -->
    <?php include(APPPATH . 'Views/admin/include/sidebar.php'); ?>

    <main id="main" class="main p-0">
        <?php include(APPPATH . 'Views/admin/include/nav2.php'); ?>

        <div class="container mt-2" id="mainContent">
            <div class="mb-3 font-weight-bold">ADMIN DASHBOARD</div>
            <!-- Dashboard Overview section -->
            <section class="dashboard-overview">
                <!-- Summary metrics -->
                <div class="row">
                    <div class="col-md-3 col-sm-3 mb-sm-2">
                        <div class="card shadow-sm">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div class="card-info">
                                    <h5 class="card-title small">Total Learners</h5>
                                    <p class="card-text font-weight-400 fs-3"><?= $totalUsers ?></p>
                                </div>
                                <div class="icon-container">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-sm-2">
                        <div class="card shadow-sm">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div class="card-info">
                                    <h5 class="card-title small">Total Courses</h5>
                                    <p class="card-text font-weight-400 fs-3"><?= $totalCourses ?></p>
                                </div>
                                <div class="icon-container">
                                    <i class="fas fa-tasks fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 mb-sm-2">
                        <div class="card shadow-sm">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div class="card-info">
                                    <h5 class="card-title small">Average Purchased</h5>
                                    <p class="card-text font-weight-400 fs-3"><?= $averagePurchased ?>%</p>
                                </div>
                                <div class="icon-container">
                                    <i class="fas fa-chart-line fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="card shadow-sm">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div class="card-info">
                                    <h5 class="card-title small">Sales Revenue</h5>
                                    <p class="card-text font-weight-400 fs-3">&#x20A6;<?= number_format($salesRevenue, 2) ?></p>
                                </div>
                                <div class="icon-container">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Add more summary metrics as needed -->
                </div>


                <!-- Graphs or charts displaying trends and statistics -->
                <div class="row mt-4">
                    <div class="col-md-7 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Course Performance</h5>
                                <!-- Dummy graph container -->
                                <canvas id="myChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <!-- <div class="row mt-4">
                            <div class="col-md-4">
                                <a href="#new-test">
                                    <div class="p-2 shadow-sm text-center learnxa-bg-blue">
                                        <h5 class="card-title">New Test</h5>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="#new-test">
                                    <div class="p-2 shadow-sm text-center learnxa-bg-blue">
                                        <h5 class="card-title">Manage Users</h5>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="#new-test">
                                    <div class="p-2 shadow-sm text-center learnxa-bg-blue">
                                        <h5 class="card-title">Tests</h5>
                                    </div>
                                </a>
                            </div>

                        </div> -->
                    </div>
                    <div class="col-md-5 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Top Course</h6>
                                <a href="#" class="text-primary">See All</a>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <?php if (!empty($topCourses)): ?>
                                        <?php foreach ($topCourses as $course): ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="<?= base_url('uploads/' . $course['course_image']) ?>" alt="<?= $course['course_title'] ?>" style="width: 50px; height: 50px; margin-right: 10px;">
                                                    <?= $course['course_title'] ?>
                                                </div>
                                                <span class="badge badge-primary badge-pill">₦<?= number_format($course['price']) ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <li class="list-group-item">No courses available.</li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>


                
                <!-- Recent Activities -->
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Recent Activity Feed</h5>
                                <ul class="list-group">
                                    <?php if (!empty($recentActivities)): ?>
                                        <?php foreach ($recentActivities as $activity): ?>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <div>
                                                    <strong><?= esc($activity['activity_type']) ?>:</strong> <?= esc($activity['details']) ?>
                                                </div>

                                                <div class="text-muted"><?= timeAgo($activity['created_at']) ?></div>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <li class="list-group-item">No recent activities available.</li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">System Status</h5>
                                <p>Current Status: <span class="text-success">Operational</span></p>
                                <p>Server Uptime: 99.9%</p>
                                <p>Database Connectivity: <span class="text-success">Connected</span></p>
                                <p>Maintenance: <span class="text-warning">Scheduled</span></p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Latest Transactions -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Latest Transactions</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="transactionTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Transaction data goes here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Calendar and Map Section -->
                <div class="mt-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card text-left shadow-sm">
                                <div class="card-body">
                                    <h4 class="card-title small">Schedule</h4>
                                    <div id='calendar'></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-left shadow-sm">
                                <div class="card-body">
                                    <h4 class="card-title small">Test Taken Locations</h4>
                                    <div id="map" style="height: 500px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </main>



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <?php include(APPPATH . 'Views/admin/include/js.php'); ?>

    <!-- Bootstrap JS (optional, if you need any Bootstrap JavaScript features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/script.js"></script>
    <!-- Dummy graph data and script -->
    <script>
        // Map
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize the map
            var map = L.map('map').setView([9.0820, 8.6753], 6); // Centered on Nigeria

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Define course purchase locations (replace with your data)
            var locations = [{
                    name: 'Lagos',
                    lat: 6.5244,
                    lng: 3.3792
                },
                {
                    name: 'Abuja',
                    lat: 9.0578,
                    lng: 7.4951
                },
                {
                    name: 'Kano',
                    lat: 12.0022,
                    lng: 8.5919
                },
                // Add more locations here
            ];

            // Add markers to the map
            locations.forEach(function (location) {
                L.marker([location.lat, location.lng]).addTo(map)
                    .bindPopup(location.name);
            });
        });
        // Calendar
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [{
                        title: 'Class 1',
                        start: '2024-08-07T10:00:00',
                        end: '2024-08-07T12:00:00'
                    },
                    {
                        title: 'Class 2',
                        start: '2024-08-08T14:00:00',
                        end: '2024-08-08T16:00:00'
                    },
                    // Add more events here
                ]
            });
            calendar.render();
        });

        // Dummy data for the graph
        const data = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Test Scores',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                data: [65, 59, 80, 81, 56, 55, 40]
            }]
        };

        // Create the graph using Chart.js
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });


        const labelys = ['January', 'February', 'March', 'April', 'May'];
        const dataBar = [65, 59, 80, 81, 56];
        // Doughnut Chart
        new Chart(document.getElementById('myCharty').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: labelys,
                datasets: [{
                    data: dataBar,
                    backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)', 'rgb(153, 102, 255)'
                    ]
                }]
            },
        });
    </script>

</body>

</html>