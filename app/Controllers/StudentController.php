<?php

namespace App\Controllers;

use App\Models\CourseEnrollmentModel;
use App\Models\AssignmentSubmissionModel;
use App\Models\AssignmentModel;
use App\Models\LessonModel;
use App\Models\ModuleModel;
use App\Models\MaterialModel;
use App\Models\CourseModel;
use App\Models\QuestionsModel;
use App\Models\QuizAttemptModel;
use App\Models\QuizModel;
use App\Models\StudentModuleProgressModel;
use App\Models\Users;
use CodeIgniter\Controller;

class StudentController extends Controller
{
    protected $courseEnrollmentModel;
    protected $assignmentSubmissionModel;
    protected $questionModel;
    protected $quizAttemptModel;
    protected $quizModel;


    public function __construct()
    {
        // Load the model
        $this->courseEnrollmentModel = new CourseEnrollmentModel();
        $this->questionModel = new QuestionsModel();
        $this->quizAttemptModel = new QuizAttemptModel();
        $this->quizModel = new QuizModel();

    }

    public function index()
    {
        // Assuming you have a session to check if the user is logged in
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('login')->with('error', 'Please log in first.');
        }

        // Get the logged-in user ID
        $userId = session('user_id'); // Assuming user_id is stored in the session

        $enrolledCourses = $this->courseEnrollmentModel->getEnrollmentsWithCourseDetails($userId);
        $limitedCourses = array_slice($enrolledCourses, 0, 2); // Change 2 to the number you want

        // Calculate overall progress for each course
        foreach ($limitedCourses as &$course) {
            $progressData = $this->calculateOverallProgress($course['course_id'], $userId);
            $course['overallProgress'] = $progressData['overallProgress'];
            // Check if the user has started any module in this course
            $course['hasStarted'] = $this->checkIfCourseStarted($course['course_id'], $userId);
        }

        // Load the dashboard view
        return view('student/index', [
            'enrolledCourses' => $limitedCourses
        ]);
    }

    

    public function enrolledCourses()
    {
        // Get the logged-in user ID
        $userId = session('user_id'); // Assuming user_id is stored in the session

        // Fetch all enrollments for the logged-in user
        $enrolledCourses = $this->courseEnrollmentModel->getEnrollmentsWithCourseDetails($userId);

        // Calculate overall progress for each course
        foreach ($enrolledCourses as &$course) {
            $progressData = $this->calculateOverallProgress($course['course_id'], $userId);
            $course['overallProgress'] = $progressData['overallProgress'];
            // Check if the user has started any module in this course
            $course['hasStarted'] = $this->checkIfCourseStarted($course['course_id'], $userId);
        }

        // Pass the enrolled courses data to the view
        return view('student/enrolled-courses', [
            'enrolledCourses' => $enrolledCourses
        ]);
    }



    public function courseDetail($courseId)
    {
        $userId = session('user_id');

        $courseDetails = $this->courseEnrollmentModel->getEnrollmentWithCourseDetails($userId, $courseId);

        if (empty($courseDetails)) {
            return redirect()->to('student/enrolled-courses')->with('error', 'Course not found or you are not enrolled in this course.');
        }

        $courseInfo = $courseDetails[0];
        $assignmentCount = $this->courseEnrollmentModel->countAssignmentsByCourse($courseId);
        $materialCount = $this->courseEnrollmentModel->countMaterialsByCourse($courseId);
        $quizCount = $this->courseEnrollmentModel->countQuizzesByCourse($courseId);
        $moduleCount = $this->courseEnrollmentModel->countModulesByCourse($courseId);

        // Get overall progress and module details
        $progressData = $this->calculateOverallProgress($courseId, $userId);

        // Check if the course has been started by the user
        $hasStarted = $this->checkIfCourseStarted($courseId, $userId);

        return view('student/enrolled-course-details', [
            'course' => $courseInfo,
            'assignments' => $courseDetails,
            'assignmentCount' => $assignmentCount,
            'materialCount' => $materialCount,
            'quizCount' => $quizCount,
            'moduleCount' => $moduleCount,
            'overallProgress' => $progressData['overallProgress'],
            'modules' => $progressData['modules'],
            'hasStarted' => $hasStarted
        ]);
    }



    


    public function completeModule($moduleId)
    {
        $userId = session('user_id');
        
        // Load the model
        $progressModel = new \App\Models\StudentModuleProgressModel();

        // Update progress in the database
        $progressModel->updateProgress($userId, $moduleId);
    }


    public function continueCourse($courseId)
    {
        $courseModel = new CourseModel();
        $studentId = session()->get('user_id');

        $course = $courseModel->find($courseId);
        $title = $course['course_title'];

        // Get overall progress and module details
        $progressData = $this->calculateOverallProgress($courseId, $studentId);

        return view('student/elearning', [
            'course' => $course,
            'courseTitle' => $title,
            'modules' => $progressData['modules'],
            'courseId' => $courseId,
            'overallProgress' => $progressData['overallProgress'],
            'currentModule' => $progressData['currentModule'],
            'currentLesson' => $progressData['currentLesson'],
            'materials' => $progressData['materials']
        ]);
    }


    public function markModuleCompleted()
    {
        if ($this->request->isAJAX()) {
            // Get CSRF token check and validate it if needed
            $moduleId = $this->request->getJSON()->module_id;
            $courseId = $this->request->getJSON()->course_id; // Retrieve course_id
            $studentId = session()->get('user_id');

            if ($moduleId && $studentId && $courseId) {
                $progressModel = new StudentModuleProgressModel();
                $existingProgress = $progressModel->where(['user_id' => $studentId, 'module_id' => $moduleId, 'course_id' => $courseId])->first();
                
                if ($existingProgress) {
                    // Update the progress as completed
                    $existingProgress['completed'] = 1;
                    $progressModel->update($existingProgress['student_module_progress_id'], $existingProgress);
                } else {
                    // Insert new progress record
                    $progressModel->insert([
                        'user_id' => $studentId,
                        'module_id' => $moduleId,
                        'course_id' => $courseId, // Save course_id
                        'completed' => 1,
                        'progress_percentage' => 50,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }

                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Missing module ID, user ID, or course ID.']);
            }
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request.']);
        }
    }

    private function calculateOverallProgress($courseId, $studentId)
    {
        $moduleModel = new ModuleModel();
        $lessonModel = new LessonModel();
        $progressModel = new StudentModuleProgressModel();
        $materialModel = new MaterialModel(); // Assuming you have a model for materials

        $modules = $moduleModel->getModulesByCourseId($courseId);
        $totalProgress = 0;
        $moduleCount = count($modules);
        $currentModule = null;
        $currentLesson = null;
        $materials = [];

        foreach ($modules as &$module) {
            $module['lessons'] = $lessonModel->getLessonsByModuleId($module['module_id']);
            
            $progress = $progressModel->where([
                'user_id' => $studentId,
                'module_id' => $module['module_id']
            ])->first();

            $module['completed'] = $progress ? (bool)$progress['completed'] : false;
            $module['active'] = $progress ? ($progress['progress_percentage'] > 0) : false;
            $module['progress_percentage'] = $progress ? $progress['progress_percentage'] : 0;

            // Accumulate progress for calculating the overall percentage
            $totalProgress += $module['progress_percentage'];

            // Set the current module to the first active module or default to the first module if none is active
            if ($currentModule === null && $module['active']) {
                $currentModule = $module;
            }
        }

        // If no module is currently active, set the first module as the current module
        if ($currentModule === null && !empty($modules)) {
            $currentModule = $modules[0];
        }

        // Determine the first lesson for the current module if it exists
        if ($currentModule && !empty($currentModule['lessons'])) {
            $currentLesson = $currentModule['lessons'][0];
            // Fetch materials for the current lesson
            $materials = $materialModel->getMaterialsByLessonId($currentLesson['lesson_id']);
        }

        // Calculate overall course progress (average of all modules)
        $overallProgress = $moduleCount > 0 ? ($totalProgress / $moduleCount) : 0;

        return [
            'modules' => $modules,
            'overallProgress' => $overallProgress,
            'currentModule' => $currentModule,
            'currentLesson' => $currentLesson,
            'materials' => $materials
        ];
    }


    // Private function to check if the user has started any module in the course
    private function checkIfCourseStarted($courseId, $userId)
    {
        $progressModel = new StudentModuleProgressModel();
        
        // Check if there is any progress record for the course's modules for the user
        $progress = $progressModel->where('user_id', $userId)
                                ->where('course_id', $courseId)
                                ->where('progress_percentage >', 0)
                                ->first();

        // Return true if a progress record is found, otherwise false
        return !empty($progress);
    }



    public function assignment()
    {
        // Get the logged-in user ID
        $userId = session('user_id');

        // Fetch the enrolled courses for the user
        $enrolledCourses = $this->courseEnrollmentModel->where('user_id', $userId)->findAll();

        // Collect course IDs
        $courseIds = array_column($enrolledCourses, 'course_id');

        // Fetch assignments for these courses
        $assignments = $this->courseEnrollmentModel->getAssignmentsByCourses($courseIds);

        // Pass the assignments to the view
        return view('student/assignment', ['assignments' => $assignments]);
    }


    public function viewAssignment($assignmentId)
    {
        // Get the logged-in user ID
        $userId = session('user_id');

        // Fetch the assignment details using the assignment ID
        $assignment = $this->courseEnrollmentModel->getAssignmentDetails($assignmentId, $userId);

        // Check if the assignment exists
        if (empty($assignment)) {
            return redirect()->to('student/assignments')->with('error', 'Assignment not found or you are not enrolled in this course.');
        }

        // Fetch existing submission details for this assignment
        $assignmentSubmissionModel = new AssignmentSubmissionModel();
        $existingSubmission = $assignmentSubmissionModel->where('assignment_id', $assignmentId)
                                                    ->where('user_id', $userId)
                                                    ->first();

        // Fetch the grade for this assignment
        $grade = $assignmentSubmissionModel->getGrade($assignmentId, $userId);

        // Pass the assignment details and submission info to the view
        return view('student/assignment-details', [
            'assignment' => $assignment,
            'existingSubmission' => $existingSubmission,
            'assignmentId' => $assignmentId, // Pass assignmentId for the form action
            'grade' => $grade['grade'] ?? null // In case there's no grade yet
        ]);
    }


    public function submitAssignment($assignmentId)
    {
        // Load the view for submitting the assignment
        return view('student/submit-assignment', ['assignmentId' => $assignmentId]);
    }

   
    public function processAssignmentSubmission($assignmentId)
    {
        // Load the model
        $assignmentSubmissionModel = new AssignmentSubmissionModel();
        $userModel = new Users();
        $assignmentModel = new AssignmentModel();

        // Get the logged-in user ID and details
        $userId = session('user_id'); // Assuming you are using sessions to track logged-in users
        $user = $userModel->find($userId); // Fetch the user details based on user ID
        $username = $user['username']; // Or whatever field holds the user's name


        // Fetch the assignment details
        $assignment = $assignmentModel->find($assignmentId); // Fetch the assignment details based on assignment ID
        $assignmentName = $assignment['assignment_name'];


        $file = $this->request->getFile('assignment_file'); // Fetch the file input
        $comments = $this->request->getPost('comments');

        // Check if there's an existing submission
        $existingSubmission = $assignmentSubmissionModel->where('assignment_id', $assignmentId)
            ->where('user_id', $userId)
            ->first();

        // Generate the new file name based on assignment ID, user ID, and user name
        // $newFileName = 'assignment_' . $assignmentId . '_user_' . $userId . '_' . $username . '.' . $file->getExtension();
        // $newFileName = 'assignment_' . $assignmentId . 'by' . '_' . $username . '.' . $file->getExtension();

        // Clean up the assignment name for the filename (remove spaces and special characters)
        $cleanAssignmentName = preg_replace('/[^A-Za-z0-9\-]/', '_', $assignmentName);

        // Generate the new file name based on assignment name, ID, username, and user ID
        $newFileName = "{$cleanAssignmentName}({$assignmentId})_by_{$username}({$userId})." . $file->getExtension();

        if ($existingSubmission) {
            // If the assignment is already submitted and the user tries to submit again
            if ($file === null) {
                // If no file is uploaded, just redirect back with success message
                return redirect()->back()->with('success', 'You have already submitted this assignment. Edit your submission to make changes.');
            }

            // Allow user to edit their submission
            if ($file->isValid() && !$file->hasMoved()) {
                $filePath = 'uploads/assignments/' . $newFileName;
                $file->move('uploads/assignments', $newFileName);
                
                // Update the existing submission
                $data = [
                    'file_path' => $filePath,
                    'comments'  => $comments,
                    'submitted_at' => date('Y-m-d H:i:s'),
                ];

                // Update the submission
                $assignmentSubmissionModel->update($existingSubmission['submission_id'], $data);
                return redirect()->to("/student/assignments/{$assignmentId}")->with('success', 'Your assignment has been updated successfully.');
            }

            // Handle file upload error
            return redirect()->back()->with('error', 'There was a problem uploading your assignment. Please try again.');
        } else {
            // New submission
            if ($file->isValid() && !$file->hasMoved()) {
                $filePath = 'uploads/assignments/' . $newFileName;
                $file->move('uploads/assignments', $newFileName);

                // Prepare data for insertion
                $data = [
                    'assignment_id' => $assignmentId,
                    'user_id'       => $userId,
                    'file_path'     => $filePath,
                    'comments'      => $comments,
                    'submitted_at'  => date('Y-m-d H:i:s'),
                ];

                // Insert the data using the model
                $assignmentSubmissionModel->insert($data);
                return redirect()->to("student/assignments/{$assignmentId}")->with('success', 'Assignment submitted successfully.');
            }

            // Handle file upload error
            return redirect()->back()->with('error', 'There was a problem uploading your assignment. Please try again.');
        }
    }  


    



    // For Quiz
    public function quiz()
    {
        // Get the logged-in user ID
        $userId = session('user_id');

        // Fetch the enrolled courses for the user
        $enrolledCourses = $this->courseEnrollmentModel->where('user_id', $userId)->findAll();

        // Collect course IDs
        $courseIds = array_column($enrolledCourses, 'course_id');

        // Fetch assignments for these courses
        $quizzes = $this->courseEnrollmentModel->getQuizzesByCourses($courseIds, $userId);

        // Pass the assignments to the view
        return view('student/quizzes', ['quizzes' => $quizzes]);
    }

    public function viewQuiz($quizId)
    {
        // Get the logged-in user ID
        $userId = session('user_id');

        // Fetch the quiz details using the quiz ID
        $quiz = $this->courseEnrollmentModel->getQuizDetails($quizId, $userId);

        // Check if the quiz exists
        if (empty($quiz)) {
            return redirect()->to('student/quizzes')->with('error', 'Quiz not found or you are not enrolled in this course.');
        }

        $quizId = $quiz['quiz_id'];
        $courseId = $quiz['course_id'];
        $duration = $quiz['duration'];
        $totalMarks = $quiz['total_marks'];
        // $courseTitle = $quiz['course_title'];

        // Pass the course details and submission info to the view
        return view('student/quiz', [
            'quiz' => $quiz,
            'quizId' => $quizId,
            'courseId' => $courseId,
            'duration' => $duration,
            'totalMarks' => $totalMarks,
        ]);
    }

    public function reviewQuiz($quizId)
    {
        // Get the logged-in user ID
        $userId = session('user_id');
    
        // Fetch the quiz attempt details for the user
        $quizAttempt = $this->courseEnrollmentModel->getQuizAttemptDetails($quizId, $userId);
        $quiz = $this->courseEnrollmentModel->getQuizDetails($quizId, $userId);
    
        // Check if the quiz attempt exists
        if (empty($quizAttempt)) {
            return redirect()->to('student/quizzes')->with('error', 'Quiz attempt not found or you are not enrolled in this course.');
        }
    
        // Get necessary details
        $quizId = $quiz['quiz_id'];
        $duration = $quiz['duration'];
        $courseId = $quizAttempt['course_id'];
        $score = $quizAttempt['score'];
        $timeTaken = $quizAttempt['time_taken'];
        $isPassed = $quizAttempt['is_passed'];
        $totalMarks = $quiz['total_marks'];
        $answers = json_decode($quizAttempt['answers'], true); // Decode JSON answers
    
        // Fetch the questions from the quiz
        $questions = $this->getQuizQuestions($quizId); // Now returns an array of questions
    
        // Pass data to the view
        return view('student/quiz-review', [
            'quiz' => $quiz,
            'quizId' => $quizId,
            'duration' => $duration,
            'quizAttempt' => $quizAttempt,
            'courseId' => $courseId,
            'score' => $score,
            'timeTaken' => $timeTaken,
            'isPassed' => $isPassed,
            'questions' => $questions,
            'userAnswers' => $answers,
            'totalMarks' => $totalMarks,
        ]);
    }
    
    private function getQuizQuestions($quizId)
    {
        // Load the model that interacts with your questions table
        return $this->courseEnrollmentModel->getQuestionsByQuizId($quizId);
    }
    

    public function getQuestions($quizId)
    {
        // Load the model that interacts with your questions table
        $questions = $this->courseEnrollmentModel->getQuestionsByQuizId($quizId);

        // Return the questions as a JSON response
        return $this->response->setJSON($questions);
    }
    


    public function submitQuiz()
    {
        if ($this->request->getMethod() === 'POST') {
            $data = $this->request->getJSON(true);

            // Validate the incoming data
            if (empty($data['user_id']) || empty($data['quiz_id']) || empty($data['answers'])) {
                return $this->response->setStatusCode(400)
                                    ->setJSON(['message' => 'Incomplete data provided.']);
            }

            // Calculate the score and get logs
            $result = $this->calculateScore($data['answers'], $data['quiz_id']);
            $score = $result['score'];
            $logs = $result['logs']; // Get logs from calculateScore

            $passingScore = $this->getPassingScore($data['quiz_id']); // Fetch from quiz
            $isPassed = $score >= $passingScore; // Check if the user passed

            $numberOfAttempts = $this->countAttempts($data['user_id'], $data['quiz_id']) + 1;

            // Prepare data for saving
            $quizAttemptData = [
                'user_id' => $data['user_id'],
                'course_id' => $data['course_id'],
                'quiz_id' => $data['quiz_id'],
                'attempt_date' => date('Y-m-d H:i:s'),
                'score' => $score,
                'status' => 'completed',
                'time_taken' => $data['time_taken'] ?? null, // Get from client-side, if available
                'is_passed' => $isPassed,
                'number_of_attempts' => $numberOfAttempts,
                'answers' => json_encode($data['answers']),
            ];

            // Save the data
            if ($this->quizAttemptModel->save($quizAttemptData)) {
                // Return the response with score, pass/fail, and logs
                return $this->response->setJSON([
                    'message' => 'Quiz submitted successfully!',
                    'score' => $score,
                    'isPassed' => $isPassed,
                    'logs' => $logs // Return logs as part of the response
                ]);
            } else {
                return $this->response->setStatusCode(500)
                                    ->setJSON(['message' => 'Error saving quiz attempt.']);
            }
        }
        return $this->response->setStatusCode(405)
                            ->setJSON(['message' => 'Invalid request method.']);
    }

    private function calculateScore($answers, $quizId)
    {
        // Fetch total marks and number of questions
        $totalMark = $this->getTotalMarkForQuiz($quizId);
        $logs = []; // Array to hold logs
        $logs[] = ['Total Mark' => $totalMark]; // Log total mark

        $correctAnswersData = $this->getCorrectAnswersForQuiz($quizId);
        $correctAnswers = $correctAnswersData['correctAnswers'];
        $logs[] = ['Correct Answers' => $correctAnswers]; // Log correct answers for debugging

        $totalQuestions = count($correctAnswers); // Total number of questions in the quiz
        $logs[] = ['Total Questions' => $totalQuestions]; // Log total questions

        // Calculate the per-question score based on total mark
        $scorePerQuestion = $totalMark / $totalQuestions;
        $logs[] = ['Score Per Question' => $scorePerQuestion]; // Log score per question

        $score = 0;

        // Iterate over the correct answers and compare with user answers
        foreach ($correctAnswers as $questionId => $correctAnswer) {
            // Check if the answer is present in the user's answers
            // Note: Use question ID as the key to retrieve user answers
            $userAnswer = isset($answers[$questionId]) ? $answers[$questionId] : 'N/A';

            // Log the details
            $logs[] = [
                'Question ID' => $questionId,
                'User Answer' => $userAnswer,
                'Correct Answer' => $correctAnswer,
            ];
            
            // Compare the user's answer with the correct answer
            if (strtoupper($correctAnswer) === strtoupper($userAnswer)) {
                $score += $scorePerQuestion; // Increment score by per-question score
                $logs[] = ['Question ID' => $questionId, 'Status' => 'Correct', 'Incremented Score' => $score];
            } else {
                $logs[] = ['Question ID' => $questionId, 'Status' => 'Incorrect'];
            }
        }

        // Return the logs along with the score for debugging purposes
        return ['score' => round($score, 2), 'logs' => $logs];
    }

    private function getCorrectAnswersForQuiz($quizId)
    {
        // Fetch questions for the given quiz ID
        $questions = $this->questionModel->where('quiz_id', $quizId)->findAll();
        $correctAnswers = [];

        foreach ($questions as $question) {
            // Map question ID to the correct option
            $correctAnswers[$question['question_id']] = $question['correct_option'];
        }

        // Prepare log for debugging
        $logData = [
            'quizId' => $quizId,
            'correctAnswers' => $correctAnswers
        ];

        // Log the correct answers array in JSON format
        error_log('Correct Answers: ' . json_encode($logData));

        // Return associative array of correct answers and logs
        return [
            'correctAnswers' => $correctAnswers, // The correct answers array
            'logs' => $logData // The logs in JSON format
        ];
    }

     
    private function countAttempts($userId, $quizId)
    {
        return $this->quizAttemptModel->where('user_id', $userId)
                                    ->where('quiz_id', $quizId)
                                    ->countAllResults();
    }

    private function getPassingScore($quizId)
    {
        $quiz = $this->quizModel->find($quizId);
        return $quiz['passing_score'] ?? 0; // Default to 0 if not set
    }

    private function getTotalMarkForQuiz($quizId)
    {
        $quiz = $this->quizModel->find($quizId);
        return $quiz['total_mark'] ?? 100; // Default to 100 if not set
    }
}
