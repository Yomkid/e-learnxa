<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// General Route for the webpage
$routes->get('/', 'Home::index');
$routes->get('become-teacher', 'Pages::becomeTeacher');
$routes->get('category', 'Pages::category');
// $routes->get('course-description', 'Pages::courseDescription');
$routes->get('virtual-courses', 'Pages::virtualClassCourses');
$routes->get('instructor', 'Pages::instructor');
$routes->get('login', 'Pages::login');
$routes->get('generate-invoice', 'AuthReg::generateInvoice');
$routes->get('invoice', 'AuthReg::Invoice'); // Use POST for form submission
$routes->get('acknowledgement-slip', 'AuthReg::acknowledgementSlip');
$routes->get('activate', 'AuthReg::activationPage');
$routes->get('email-test', 'EmailTest::index');
$routes->get('calendar', 'Pages::calendar');
$routes->get('calend', 'Pages::calendarR');
$routes->get('verify-payment', 'PaymentController::verifyPayment');
// $routes->get('courses', 'Pages::courses');
$routes->get('courses', 'CourseController::index');
$routes->get('course/(:segment)', 'CourseController::description/$1'); // View course details by slug
$routes->post('courses/update/(:num)', 'CourseController::updateCourse/$1'); // Update an existing course by ID
// $routes->get('checkout', 'Pages::courseCheckout');
$routes->get('enroll/(:num)', 'CourseController::enroll/$1');
$routes->get('checkout', 'CheckoutController::index');

// Checkout Payment
// $routes->post('/checkout', 'PaystackController::checkout');
// $routes->get('/paystack/callback', 'PaystackController::callback');
$routes->get('/verifyCourseEnrollmentPayment', 'PaymentController::verifyEnrollmentPayment'); //For Enrollment Payment Verification
$routes->get('/verifyCourseEnrollmentPaymentWithFlutter', 'PaymentController::verifyCourseEnrollmentPaymentWithFlutter'); //For Flutterwave
$routes->get('/testing', 'EnrollmentController::indexT'); //For Enrollment Payment Verification
// $routes->get('/thank-you', 'PaymentController::thankYou');
// $routes->get('/payment-failed', 'PaymentController::paymentFailed');








// Country and States
$routes->get('populate-countries', 'CountryController::populateCountries');
$routes->get('populate-states', 'StateController::populateStates');


// Student Routes


// AuthReg
$routes->post('login', 'AuthReg::login');
$routes->post('invoice-process', 'AuthReg::processInvoice'); // Use POST for form submission
$routes->post('activate', 'AuthReg::activateAccount');

// Logout Route
$routes->get('logout', 'AuthReg::logout');





// $routes->group('student', function($routes) {
$routes->group('student', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('/', 'AuthReg::dashboard');
    $routes->get('enrolled-courses', 'Pages::enrolledCourses');
    $routes->get('course-details', 'Pages::enrolledCourseDetails');
    $routes->get('e-learning', 'Pages::eLearning');
    $routes->get('quiz', 'Pages::quiz');
    $routes->get('payment', 'Pages::payment');
    $routes->get('timetable', 'Pages::timeTable');
    $routes->get('profile', 'Pages::profile');
    // $routes->get('assignments', 'Pages::assignment');
    $routes->get('community', 'Pages::Community');
    $routes->get('notification', 'Pages::Notification');
    $routes->get('virtual-class', 'Pages::VirtualClass');
    $routes->get('results', 'Pages::Results');
    $routes->get('archievement', 'Pages::Archievement');
    $routes->get('feedback', 'Pages::Feedback');
    $routes->get('courses/(:num)', 'Student\Courses::details/$1');
    $routes->get('assignments', 'Student\Assignments::index');
    $routes->get('assignments/(:num)', 'Student\Assignments::details/$1');
    $routes->get('profile', 'Student\Profile::index');
});




$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->get('users', 'Admin\Users::index');
    $routes->get('courses', 'Admin\Courses::index');
    $routes->get('instructors', 'Admin\Instructors::index');
    $routes->get('settings', 'Admin\Settings::index');
});



// Admin Routes
$routes->get('admin/analytics', 'Pages::analyticsAndReports'); //Good
$routes->get('admin/announcements', 'Pages::Announcements'); //Good 
$routes->get('admin/backup', 'Pages::backupRestore'); //Good
$routes->get('admin/course-details', 'Pages::courseDetails');
$routes->get('admin/course-performance-report', 'Pages::coursePerformanceReport'); //It should be in analytics
$routes->get('admin/coupon', 'Pages::createAndEditCoupon'); //it should be under products
$routes->get('admin/course', 'Pages::createAndEditCourse'); //Good
$routes->get('admin/category', 'Pages::createAndEditCategory'); //Good it should be under course
$routes->get('admin/topic', 'Pages::createAndEditTopic');//Good it should be under course
$routes->get('admin/create-role', 'Pages::createRole'); //It should be under use management
$routes->get('admin/edit-role', 'Pages::editRole'); //under role (modal)
$routes->get('admin/createUser', 'Pages::createUser'); //Under usermanagement ***
$routes->get('admin/editUser', 'Pages::editUser'); //Under User
$routes->get('admin/emailTemplates', 'Pages::emailTemplates'); //Under announcement
$routes->get('admin/enrollment-details', 'Pages::enrollmentDetails'); //Under Usermanagement
$routes->get('admin/enrollment-list', 'Pages::enrollmentList'); //Under Usermanagement
$routes->get('admin/enrollment-management', 'Pages::enrollmentManagement'); //Under Usermanagement or Enrollment
$routes->get('admin/enrollment-request', 'Pages::enrollmentRequest'); //Under request
$routes->get('admin/faq-management', 'Pages::faqManagement'); //faq
$routes->get('admin/financial-management', 'Pages::financialManagement'); //Good
$routes->get('admin/financial-report', 'Pages::financialReport'); //Under financial managemet
$routes->get('admin/general-settings', 'Pages::generalSettings'); //Settings
$routes->get('admin/instructor-assignment', 'Pages::instructorAssignment'); //Should be under User Management
$routes->get('admin/integration-settings', 'Pages::integrationSettings'); //Should be under settings
$routes->get('admin/payment-gateway-setup', 'Pages::paymentGatewaySetup'); //Under Payment Management (Settings)
$routes->get('admin/transaction-list', 'Pages::transactionList');
$routes->get('admin/user', 'Pages::user');
$routes->get('admin/user-rofile', 'Pages::userProfile');




// Course Management Backend Logics
$routes->post('course/save', 'CourseController::saveCourse');
$routes->post('category/save', 'CourseManagementController::saveCategory');
$routes->post('topic/save', 'CourseManagementController::saveTopic');


// Admin Authentication Routes
$routes->get('admin/register', 'AdminController::register');
$routes->post('admin/eregister', 'AdminController::saveAdmin');



//Routes for Success and Error Message
$routes->get('success', 'AdminController:::success');
$routes->get('error', 'AdminController:::error');


$routes->group('admin', function($routes) {
    $routes->get('/', 'Pages::Admin'); //Good

    // Module route
    $routes->group('modules', ['namespace' => 'App\Controllers'], function($routes) {
        $routes->get('/', 'ModuleController::index'); // List all modules
        $routes->get('create', 'ModuleController::create'); // Show the form to create a new module
        $routes->post('store', 'ModuleController::store'); // Handle the form submission to create a new module
        $routes->get('edit/(:num)', 'ModuleController::edit/$1'); // Show the form to edit an existing module
        $routes->post('update/(:num)', 'ModuleController::update/$1'); // Handle the form submission to update an existing module
        $routes->get('delete/(:num)', 'ModuleController::delete/$1'); // Delete an existing module
    });

    // Quiz route
    $routes->group('quizzes', ['namespace' => 'App\Controllers'], function($routes) {
        $routes->get('/', 'QuizController::index'); // List all quizzes
        $routes->get('create', 'QuizController::create'); // Show the form to create a new quiz
        $routes->get('list', 'QuizController::list');
        $routes->post('assignQuizzes', 'QuizController::assignQuizzes'); // Assign Quizzes to a course
        $routes->post('store', 'QuizController::store'); // Handle the form submission to create a new quiz
        $routes->get('edit/(:num)', 'QuizController::edit/$1'); // Show the form to edit an existing quiz
        $routes->post('update', 'QuizController::update/$1'); // Handle the form submission to update an existing quiz
        $routes->get('delete/(:num)', 'QuizController::delete/$1'); // Delete an existing quiz
        $routes->get('view/(:num)', 'QuizController::viewCourse/$1');
        $routes->post('addQuizzes', 'QuizController::addQuizzes');
        $routes->post('removeQuiz/(:num)/(:num)', 'QuizController::removeQuiz/$1/$2');
        $routes->get('getQuizzesForCourse/(:num)', 'QuizController::getQuizzesForCourse/$1');
    });


    // Questions Routes
    $routes->group('questionbank', ['namespace' => 'App\Controllers'], function($routes) {
        $routes->get('/', 'QuestionBankController::index'); // List all questions
        $routes->get('list', 'QuestionBankController::list'); // List questions with search, sort, and pagination
        $routes->post('store', 'QuestionBankController::store'); // Add a new question
        $routes->post('multiQuestionStore', 'QuestionBankController::multiQuestionStore'); // Add a new question
        $routes->post('bulkUpload', 'QuestionBankController::bulkUpload'); // Add a new bulk question
        $routes->post('exportQuestions', 'QuestionBankController::exportQuestions'); // Add a new question
        $routes->get('edit/(:num)', 'QuestionBankController::edit/$1'); // Get question details for editing
        $routes->post('update', 'QuestionBankController::update'); // Update an existing question
        $routes->get('delete/(:num)', 'QuestionBankController::delete/$1'); // Delete a question
        $routes->post('upload', 'QuestionBankController::upload'); // Bulk upload questions from file
    });


    // Assignments route
    $routes->group('assignments', ['namespace' => 'App\Controllers'], function($routes) {
        $routes->get('/', 'AssignmentController::index'); // List all quizzes
        $routes->get('create', 'AssignmentController::create'); // Show the form to create a new quiz
        $routes->get('list', 'AssignmentController::list');
        $routes->post('assignAssignments', 'AssignmentController::assignAssignments'); // Assign Quizzes to a course
        $routes->post('store', 'AssignmentController::store'); // Handle the form submission to create a new quiz
        $routes->get('edit/(:num)', 'AssignmentController::edit/$1'); // Show the form to edit an existing quiz
        $routes->post('update', 'AssignmentController::update/$1'); // Handle the form submission to update an existing quiz
        $routes->post('exportAssignments', 'AssignmentController::exportAssignments'); // Add a new question
        $routes->get('delete/(:num)', 'AssignmentController::delete/$1'); // Delete an existing quiz
        $routes->get('view/(:num)', 'AssignmentController::viewCourse/$1');
        $routes->post('addQuizzes', 'AssignmentController::addQuizzes');
        $routes->post('removeAssignment/(:num)/(:num)', 'AssignmentController::removeAssignment/$1/$2');
        $routes->get('getAssignmentsForCourse/(:num)', 'AssignmentController::getAssignmentsForCourse/$1');
    });

    // Materials route
    $routes->group('materials', ['namespace' => 'App\Controllers'], function($routes) {
        $routes->get('/', 'MaterialController::index'); // List all quizzes
        $routes->get('create', 'MaterialController::create'); // Show the form to create a new quiz
        $routes->get('list', 'MaterialController::list');
        $routes->post('assignMaterials', 'MaterialController::assignMaterials'); // Assign Quizzes to a course
        $routes->post('store', 'MaterialController::store'); // Handle the form submission to create a new quiz
        $routes->get('edit/(:num)', 'MaterialController::edit/$1'); // Show the form to edit an existing quiz
        $routes->post('update', 'MaterialController::update/$1'); // Handle the form submission to update an existing quiz
        $routes->post('exportMaterials', 'MaterialController::exportMaterials'); // Add a new question
        $routes->get('delete/(:num)', 'MaterialController::delete/$1'); // Delete an existing quiz
        $routes->get('view/(:num)', 'MaterialController::viewCourse/$1');
        $routes->post('addMaterials', 'MaterialController::addMaterials');
        $routes->post('removeMaterial/(:num)/(:num)', 'MaterialController::removeMaterial/$1/$2');
        $routes->get('getMaterialsForCourse/(:num)', 'MaterialController::getMaterialsForCourse/$1');
    });

    // Timetables route
    $routes->group('timetables', ['namespace' => 'App\Controllers'], function($routes) {
        $routes->get('/', 'TimetableController::index'); // List all quizzes
        $routes->get('create', 'TimetableController::create'); // Show the form to create a new quiz
        $routes->get('list', 'TimetableController::list');
        $routes->post('assignTimetables', 'TimetableController::assignTimetables'); // Assign Quizzes to a course
        $routes->post('store', 'TimetableController::store'); // Handle the form submission to create a new quiz
        $routes->get('edit/(:num)', 'TimetableController::edit/$1'); // Show the form to edit an existing quiz
        $routes->post('update', 'TimetableController::update/$1'); // Handle the form submission to update an existing quiz
        $routes->post('exportTimetables', 'TimetableController::exportTimetables'); // Add a new question
        $routes->get('delete/(:num)', 'TimetableController::delete/$1'); // Delete an existing quiz
        $routes->get('view/(:num)', 'TimetableController::viewCourse/$1');
        $routes->post('addTimetables', 'TimetableController::addTimetables');
        $routes->post('removeTimetable/(:num)/(:num)', 'TimetableController::removeTimetable/$1/$2');
        $routes->get('getTimetablesForCourse/(:num)', 'TimetableController::getTimetablesForCourse/$1');
        $routes->get('getTimetableDetails/(:num)', 'TimetableController::getTimetableDetails/$1');
    });

    // VirtualClasses route
    $routes->group('virtualclasses', ['namespace' => 'App\Controllers'], function($routes) {
        $routes->get('/', 'VirtualClassController::index'); // List all quizzes
        $routes->get('create', 'VirtualClassController::create'); // Show the form to create a new quiz
        $routes->get('list', 'VirtualClassController::list');
        $routes->post('store', 'VirtualClassController::store'); // Handle the form submission to create a new quiz
        $routes->get('edit/(:num)', 'VirtualClassController::edit/$1'); // Show the form to edit an existing quiz
        $routes->post('update', 'VirtualClassController::update/$1'); // Handle the form submission to update an existing quiz
        $routes->post('exportVirtualClasses', 'VirtualClassController::exportVirtualClasses'); // Add a new question
        $routes->get('delete/(:num)', 'VirtualClassController::delete/$1'); // Delete an existing quiz
        $routes->get('view/(:num)', 'VirtualClassController::viewCourse/$1');
        $routes->post('addVirtualClasses', 'VirtualClassController::addVirtualClasses');
        $routes->post('assignCoursesForVirtualClass', 'VirtualClassController::assignCoursesForVirtualClass'); // Assign Quizzes to a course
        $routes->get('getCoursesForVirtualClass/(:num)', 'VirtualClassController::getCoursesForVirtualClass/$1');
        $routes->post('removeCourseFromVirtualClass/(:num)/(:num)', 'VirtualClassController::removeCourseFromVirtualClass/$1/$2');
        $routes->get('getVirtualClassDetails/(:num)', 'VirtualClassController::getVirtualClassDetails/$1');
        $routes->get('getTimetablesForClass/(:num)', 'VirtualClassController::getTimetablesForClass/$1');
        $routes->post('assignVirtualClassesTimetable', 'VirtualClassController::assignVirtualClassesTimetable');
        $routes->post('removeVirtualClassTimetable/(:num)/(:num)', 'VirtualClassController::removeVirtualClassTimetable/$1/$2');

    });



    // Lesson Routes
    $routes->group('lesson', function($routes) {
        $routes->get('/', 'LessonController::index');
        // getModules
        $routes->get('getModules', 'LessonController::getModules');
        $routes->get('getModuleDetails', 'LessonController::getModuleDetails');
        $routes->get('getAllLessons', 'LessonController::getAllLessons');
        // Save Lesson
        $routes->post('save', 'LessonController::saveLesson');
    });

});


