<div class="sidebar d-flex flex-column" id="sidebar">
    <a class="navbar-brand text-center text-light" href="/learnxa-lite">Learn<span style="color: #007bff;">X</span>a</a>
    <!-- <hr style="color: #ffff"> -->
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="/student" class="nav-link">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="/student/enrolled-courses" class="nav-link">
                <i class="fas fa-book"></i>
                Courses
            </a>
        </li>
        <li>
            <a href="/student/assignments" class="nav-link">
                <i class="fas fa-tasks"></i>
                Assignments
            </a>
        </li>
        <li>
            <a href="quiz" class="nav-link">
                <i class="fas fa-pencil-alt"></i>
                Quiz
            </a>
        </li>
        <li>
            <a href="/student/timetable" class="nav-link">
                <i class="fas fa-pencil-alt"></i>
                Timetable
            </a>
        </li>
        <li>
            <a href="/student/payment" class="nav-link">
                <i class="fas fa-credit-card"></i>
                Payment
            </a>
        </li>
        <li>
            <a href="/student/community" class="nav-link">
                <i class="fas fa-users"></i>
                Community
            </a>
        </li>
        <li>
            <a href="/student/virtual-class" class="nav-link">
                <i class="fas fa-chalkboard-teacher"></i>
                Virtual Class
            </a>
        </li>
        <li>
            <a href="/student/results" class="nav-link">
                <i class="fas fa-chart-line"></i>
                Results
            </a>
        </li>
        <li>
            <a href="/student/archievement" class="nav-link">
                <i class="fas fa-medal"></i>
                Achievement
            </a>
        </li>
        <li>
            <a href="/student/notification" class="nav-link">
                <i class="fas fa-bell"></i>
                Notification
            </a>
        </li>
        <li>
            <a href="/student/feedback" class="nav-link">
                <i class="fas fa-comment-dots"></i>
                Feedback
            </a>
        </li>
        <li>
            <a href="/student/profile" class="nav-link">
                <i class="fas fa-user"></i>
                Profile
            </a>
        </li>
        <li>
            <a href="logout" class="nav-link">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
        </li>
    </ul>
    <footer class="mt-auto text-center"
        style="padding: 10px; background-color: #343a40; color: white; font-size: 14px;">
        <div class="container">
            <p class="mb-0">
                &copy; <span id="currentYear"></span> LearnXa
            </p>
        </div>
    </footer>
</div>

<!-- Add this script before the closing body tag to dynamically update the year -->
<script>
    // For Active link in Sidebar and Navbar or any Nav links
    document.addEventListener("DOMContentLoaded", function () {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active-menu');
            }
        });
    });

    // For Current Year
    document.getElementById('currentYear').textContent = new Date().getFullYear();
</script>