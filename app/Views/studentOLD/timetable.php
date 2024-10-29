<!DOCTYPE html>
<html lang="en">

<head>
    <title>Timetable - LearnXa</title>

    <?php include(APPPATH . 'Views/student/include/student-head.php'); ?>
    
    <style>
         .fc-sun {
            color: red;
        }

        .fc-ltr .fc-dayGrid-view .fc-day-top .fc-day-number {
            float: none;
        }

        .fc-day-top {
            text-align: center !important;
        }
    </style>
</head>

<body style="background-color: #f2f2f2;">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-6">
                <?php include(APPPATH . 'Views/student/include/student-sidebar.php'); ?>

            </div>


            <div class="col-lg-10 col-md-6 ">
            <?php include(APPPATH . 'Views/student/include/student-navbar.php'); ?>

                <!-- Hero Section -->
                <div class="main-container mt-2 p-2" id="mainContent">
                    <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                    <?php endif; ?>
                    <section class="showcase">
                        <div class="container">
                            <div class="pb-2 mt-4 mb-2 border-bottom">
                                <div class="mb-3 font-weight-bold">Python Programming Class Timetable</div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 gedf-main">
                                    <span id="loading">Loading...</span>
                                    <span id="load-calendar"></span>
                                </div>
                            </div>
                        </div>
                    </section>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('packages/core/main.js'); ?>"></script>
    <script src="<?= base_url('packages/interaction/main.js'); ?>"></script>
    <script src="<?= base_url('packages/moment/main.js'); ?>"></script>
    <script src="<?= base_url('packages/moment-timezone/main.js'); ?>"></script>
    <script src="<?= base_url('packages/daygrid/main.js'); ?>"></script>
    <script src="<?= base_url('packages/timegrid/main.js'); ?>"></script>
    <script src="<?= base_url('packages/list/main.js'); ?>"></script>
    <script src="<?= base_url('packages/google-calendar/main.js'); ?>"></script>
    <script>
        // Calendar Integration with Google
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('load-calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                // load plugins
                plugins: ['interaction', 'dayGrid', 'timeGrid', 'list', 'googleCalendar',
                    'momentTimezonePlugin', 'momentPlugin'
                ],
                firstDay: 1,
                locale: 'en',
                timeZone: 'local',
                editable: true,
                selectable: true,
                selectHelper: true,
                displayEventTime: true, // don't show the time column in list view
                buttonIcons: true, // show the prev/next text
                weekNumbers: false,
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                // calendar header
                header: {
                    left: 'prevYear, prev,next, nextYear, today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                // change button text
                buttonText: {
                    today: "Today",
                    month: "Month",
                    week: "Week",
                    day: "Day",
                    listMonth: 'List'
                },
                // THIS KEY WON'T WORK IN PRODUCTION!!!
                // To make your own Google API key, follow the directions here:
                // http://fullcalendar.io/docs/google_calendar/
                googleCalendarApiKey: 'AIzaSyB6to01Dz3W6iHj5oQjkvt4JOybvT0J4eA',
                // US Holidays
                eventSources: [{
                        // url: "odewayemayomi@gmail.com",
                        url: "d6cba05f633ff08bc8401ec6a1b101a8766fb17adfcbd31194185b76f6fe6a60@group.calendar.google.com",
                        dataType: 'jsonp',
                        className: 'feed_one'
                    },
                    {
                        url: "<?= base_url();?>event/loadEventData",
                        dataType: 'jsonp',
                        className: 'feed_two',
                    }
                ],

                loading: function (bool) {
                    document.getElementById('loading').style.display =
                        bool ? 'block' : 'none';
                },

            });

            calendar.render();
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
    <!-- Custom JS -->
    <script src="scripts.js"></script>
</body>

</html>