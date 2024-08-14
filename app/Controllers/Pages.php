<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\TopicsModel;
use App\Models\CourseModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pages extends BaseController
{

    
    public function calendar()
    {
        return view('calendar/calendar.php');
    }
    public function calendarR()
    {
        return view('calend.php');
    }
    public function Admin()
    {
        return view('admin/index.php');
    }
    public function login()
    {
        return view('login.php');
    }


    // :::::::::::::: STUDENT CONTROLLER FOR VIEWS :::::::::::::::::::
    public function enrolledCourses()
    {
        return view('student/enrolled-courses.php');
    }
    public function enrolledCourseDetails()
    {
        return view('student/enrolled-course-details.php');
    }
    public function quiz()
    {
        return view('student/quizMain.php');
    }
    public function eLearning()
    {
        return view('student/elearning.php');
    }
    public function payment()
    {
        return view('student/payment.php');
    }
    public function timeTable()
    {
        return view('student/timetable.php');
    }
    public function Assignment()
    {
        return view('student/assignment.php');
    }
    public function Community()
    {
        return view('student/community.php');
    }
    public function Notification()
    {
        return view('student/notification.php');
    }
    public function VirtualClass()
    {
        return view('student/virtual_class.php');
    }
    public function Results()
    {
        return view('student/results.php');
    }
    public function Archievement()
    {
        return view('student/archievement.php');
    }
    public function Feedback()
    {
        return view('student/feedback.php');
    }


    // :::::::::::::: PAGES CONTROLLER FOR VIEWS :::::::::::::::::::
    public function becomeTeacher()
    {
        return view('become-teacher-on-learnxa.php');
    }
    public function category()
    {
        return view('category.php');
    }
    public function courseDescription()
    {
        return view('course-description.php');
    }
    public function virtualClassCourses()
    {
        return view('virtual-class-courses.php');
    }
    public function instructor()
    {
        return view('instructor.php');
    }

    public function courseCheckout()
    {
        return view('checkout.php');
    }
    public function courses()
    {
        return view('courses.php');
    }
    public function profile()
    {
        return view('student/profile.php');
    }

    // :::::::::::::: ADMIN CONTROLLER FOR VIEWS :::::::::::::::::::

    // Analytics and Reports
    public function AnalyticsAndReports()
    {
        return view('admin/AnalyticsAndReports.php');
    }

    // Announcements (Notification)
    public function Announcements()
    {
        return view('admin/Announcements.php');
    }

    // Backup and Restore
    public function BackupRestore()
    {
        return view('admin/backupRestore.php');
    }

    // Course Details
    public function courseDetails()
    {
        return view('admin/courseDetails.php');
    }

    // Course Management\
    public function courseManagement()
    {
        return view('admin/courseManagement.php');
    }

    // Course Performance Reports
    public function coursePerformanceReport()
    {
        return view('admin/coursePerformanceReport.php');
    }

    // Create and Edit Coupon
    public function createAndEditCoupon()
    {
        return view('admin/createAndEditCoupon.php');
    }

    // Create and Edit Course
    public function createAndEditCourse()
    {
        $topicModel = new TopicsModel();
        $data['topics'] = $topicModel->findAll();

        // return view('create_course', $data);
        return view('admin/course_management/createAndEditCourse', $data);
    }

    // Create and Edit Category
    public function createAndEditCategory()
    {
        return view('admin/createAndEditCategory.php');
    }

    
    // Create and Edit Topic
    public function createAndEditTopic()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();

        return view('admin/createAndEditTopic.php', ['categories' => $categories]);
    }

    // Create and Edit Lesson\
    public function createAndEditLesson()
    {
        $courseModel = new CourseModel();
        $data['courses'] = $courseModel->findAll();
        return view('admin/createAndEditLesson', $data);
    }

    // Create and Edit Module
    public function createAndEditModule()
    {
        return view('admin/createAndEditModule.php');
    }

    // Create and Edit Assignment
    public function createAndEditAssignment()
    {
        $courseModel = new CourseModel();
        $data['courses'] = $courseModel->findAll();
        return view('admin/createAndEditAssignment', $data);
    }
    // Create and Edit Videos
    public function createAndEditVideo()
    {
        $courseModel = new CourseModel();
        $data['courses'] = $courseModel->findAll();
        return view('admin/createAndEditVideo', $data);
    }
    // Create and Edit Quiz
    public function createAndEditQuiz()
    {
        $courseModel = new CourseModel();
        $data['courses'] = $courseModel->findAll();
        return view('admin/createAndEditQuiz', $data);
    }

    // Create Role
    public function createRole()
    {
        return view('admin/createRole.php');
    }

    // Edit Role
    public function editRole()
    {
        return view('admin/editRole.php');
    }

    // Create User
    public function createUser()
    {
        return view('admin/createUser.php');
    }

    // Edit User
    public function editUser()
    {
        return view('admin/editUser.php');
    }

    // Email Templates (Sending of mail to the users)
    public function emailTemplates()
    {
        return view('admin/emailTemplates.php');
    }

    // Enrollment Details
    public function enrollmentDetails()
    {
        return view('admin/enrollmentDetails.php');
    }

    // Enrollment List
    public function enrollmentList()
    {
        return view('admin/enrollmentList.php');
    }

    // Enrollment Management
    public function enrollmentManagement()
    {
        return view('admin/enrollmentManagement.php');
    }

    // Enrollment Request
    public function enrollmentRequest()
    {
        return view('admin/enrollmentRequest.php');
    }

    // FAQ Management (Frequently Ask Question)
    public function faqManagement()
    {
        return view('admin/faqManagement.php');
    }

    // Financial Management
    public function financialManagement()
    {
        return view('admin/financialManagement.php');
    }

    // Financial Report
    public function financialReport()
    {
        return view('admin/financialReport.php');
    }

    // General Settings
    public function generalSettings()
    {
        return view('admin/generalSettings.php');
    }

    // Instructor Assignment
    public function instructorAssignment()
    {
        return view('admin/instructorAssignment.php');
    }

    // Integration Settings
    public function integrationSettings()
    {
        return view('admin/integrationSettings.php');
    }

    // Lesson List
    public function lessonList()
    {
        return view('admin/lessonList.php');
    }

    // Module List
    public function moduleList()
    {
        return view('admin/moduleList.php');
    }

    // Payment Gateway Setup
    public function paymentGatewaySetup()
    {
        return view('admin/paymentGatewaySetup.php');
    }

    // Quiz Management
    public function quizManagement()
    {
        return view('admin/quizManagement.php');
    }

    // Role Management
    public function roleManagement()
    {
        return view('admin/roleManagement.php');
    }

    // Security Settings
    public function securitySettings()
    {
        return view('admin/securitySettings.php');
    }

    // Transaction List
    public function transactionList()
    {
        return view('admin/transactionList.php');
    }

    // Users
    public function user()
    {
        return view('admin/user.php');
    }

    // User Management
    public function userManagement()
    {
        return view('admin/userManagement.php');
    }

    // User Profile
    public function userProfile()
    {
        return view('admin/userProfile.php');
    }
}
