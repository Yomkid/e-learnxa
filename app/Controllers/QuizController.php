<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Models\QuizModel;
use App\Models\QuestionsModel;
use App\Models\CourseModel;
use App\Models\CourseQuizModel;


class QuizController extends BaseController
{


    protected $questionsModel;
    protected $quizModel;
    protected $courseModel;
    protected $courseQuizModel;

    public function __construct()
    {
        $this->questionsModel = new QuestionsModel();
        $this->quizModel = new QuizModel();
        $this->courseModel = new CourseModel();
        $this->courseQuizModel = new CourseQuizModel();
        helper('csv'); // Load the CSV helper
    }


    // public function index()
    // {
    //     $quizModel = new QuizModel();
    //     $courseModel = new CourseModel();
        
    //     $quizzes = $quizModel->findAll();
    //     $courses = $courseModel->findAll();
    
    //     // Corrected return statement with associative array
    //     return view('admin/quizzes/index', [
    //         'quizzes' => $quizzes,
    //         'courses' => $courses
    //     ]);
    // }

    public function index()
{
    $quizzes = $this->quizModel->findAll();
    $courses = $this->courseModel->findAll();

    // If you want to show the list of quizzes for a specific course, you need to handle it accordingly
    // Here we're just returning the basic list for demonstration
    return view('admin/quizzes/index', [
        'quizzes' => $quizzes,
        'courses' => $courses,
        // For simplicity, these are left out in this context, you would fetch them in the appropriate method
        'assignedQuizzes' => [],
        'allQuizzes' => $quizzes
    ]);
}

    

    public function create()
    {
        return view('admin/quizzes/create');
    }

    public function store()
    {
        $quizModel = new QuizModel();
        
        $data = [
            'quiz_name' => $this->request->getPost('quiz_name'),
            'quiz_description' => $this->request->getPost('quiz_description'),
        ];

        if ($quizModel->save($data)) {
            return redirect()->to('/quizzes')->with('success', 'Quiz created successfully.');
        } else {
            return redirect()->back()->with('errors', $quizModel->errors());
        }
    }

    public function list()
    {
        $quizModel = new QuizModel();
        $search = $this->request->getGet('search');
        $sort = $this->request->getGet('sort');
        $page = $this->request->getGet('page') ?? 1;

        $query = $quizModel;

        if ($search) {
            $query = $query->like('quiz_name', $search)
                           ->orLike('quiz_description', $search);
        }

        if ($sort) {
            if ($sort == 'name_asc') {
                $query = $query->orderBy('quiz_name', 'ASC');
            } elseif ($sort == 'name_desc') {
                $query = $query->orderBy('quiz_name', 'DESC');
            } elseif ($sort == 'id_asc') {
                $query = $query->orderBy('quiz_id', 'ASC');
            } elseif ($sort == 'id_desc') {
                $query = $query->orderBy('quiz_id', 'DESC');
            }
        }

        $quizzesPerPage = 10;
        $quizzes = $query->paginate($quizzesPerPage, 'default', $page);

        return $this->response->setJSON([
            'quizzes' => $quizzes,
            'pagination' => [
                'currentPage' => $page,
                'totalPages' => ceil($quizModel->countAllResults() / $quizzesPerPage)
            ]
        ]);
    }

    public function edit($id)
    {
        $quizModel = new QuizModel();
        $quiz = $quizModel->find($id);

        if ($quiz) {
            return $this->response->setJSON([
                'quiz' => $quiz
            ]);
        } else {
            return $this->response->setJSON([
                'error' => 'Quiz not found'
            ], ResponseInterface::HTTP_NOT_FOUND);
        }
    }

    public function update()
    {
        $quizModel = new QuizModel();
        $data = $this->request->getPost();

        if ($quizModel->save($data)) {
            return redirect()->to(base_url('quizzes'))->with('success', 'Quiz updated successfully');
        } else {
            return redirect()->to(base_url('quizzes'))->with('error', 'Failed to update quiz');
        }
    }



    public function delete($id)
    {
        $quizModel = new QuizModel();
        
        if ($quizModel->delete($id)) {
            return redirect()->to('/quizzes')->with('success', 'Quiz deleted successfully.');
        } else {
            return redirect()->back()->with('errors', 'Failed to delete quiz.');
        }
    }

    
    public function createQuestion()
    {
        $questionModel = new QuestionsModel();
        
        $data = [
            'quiz_id' => $this->request->getPost('quiz_id'),
            'question_text' => $this->request->getPost('question_text'),
            'option_a' => $this->request->getPost('option_a'),
            'option_b' => $this->request->getPost('option_b'),
            'option_c' => $this->request->getPost('option_c'),
            'option_d' => $this->request->getPost('option_d'),
            'correct_option' => $this->request->getPost('correct_option'),
            'explanation' => $this->request->getPost('explanation'),
        ];

        if ($questionModel->save($data)) {
            return redirect()->to('/questions')->with('success', 'Question created successfully.');
        } else {
            return redirect()->back()->with('errors', $questionModel->errors());
        }
    }


    public function assignQuizzes()
    {
        // Get the selected course ID and quiz IDs from the request
        $courseId = $this->request->getPost('course_id');
        $selectedQuizzes = $this->request->getPost('quizzes');
    
        // Validate the course ID and quiz IDs
        if (empty($courseId) || empty($selectedQuizzes)) {
            return redirect()->back()->withInput()->with('errors', 'Course ID or Quizzes are missing')->with('message_type', 'error');
        }
    
        // Load models
        $courseQuizModel = new CourseQuizModel();
        $quizModel = new QuizModel();
    
        // Validate that the course ID exists
        $courseExists = (new CourseModel())->find($courseId);
        if (!$courseExists) {
            return redirect()->back()->withInput()->with('errors', 'Invalid course ID')->with('message_type', 'error');
        }
    
        // Validate each quiz ID
        foreach ($selectedQuizzes as $quizId) {
            $quizExists = $quizModel->find($quizId);
            if (!$quizExists) {
                return redirect()->back()->withInput()->with('errors', 'Invalid quiz ID: ' . $quizId)->with('message_type', 'error');
            }
        }
    
        // Insert each quiz-course relationship into the course_quizzes table
        foreach ($selectedQuizzes as $quizId) {
            $courseQuizModel->insert([
                'course_id' => $courseId,
                'quiz_id' => $quizId
            ]);
        }
    
        $successMessage = "The quizzes have been assigned to the course successfully";
        return redirect()->to('/quizzes')
            ->with('success', $successMessage)
            ->with('message_type', 'success')
            ->with('message', $successMessage);
    }
    


    // public function viewCourse($courseId)
    // {
    //     $course = $this->courseModel->find($courseId);
    //     $assignedQuizzes = $this->courseQuizModel->where('course_id', $courseId)->findAll();

    //     $quizzes = [];
    //     foreach ($assignedQuizzes as $assignedQuiz) {
    //         $quizzes[] = $this->quizModel->find($assignedQuiz['quiz_id']);
    //     }

    //     // Fetch all quizzes for the add/remove functionality
    //     $allQuizzes = $this->quizModel->findAll();

    //     return view('admin/quizzes/index', [
    //         'course' => $course,
    //         'assignedQuizzes' => $quizzes,
    //         'allQuizzes' => $allQuizzes
    //     ]);
    // }


    // public function viewCourse($courseId)
    // {
    //     $courseModel = new CourseModel();
    //     $quizModel = new QuizModel();
    //     $courseQuizModel = new CourseQuizModel();
    
    //     // Fetch course details
    //     $course = $courseModel->find($courseId);
    
    //     // Fetch assigned quiz IDs
    //     $assignedQuizIds = $courseQuizModel->where('course_id', $courseId)->findColumn('quiz_id');
    
    //     // Fetch assigned quizzes
    //     $assignedQuizzes = $quizModel->whereIn('quiz_id', $assignedQuizIds)->findAll();
    
    //     // Fetch all quizzes for the add/remove functionality
    //     $allQuizzes = $quizModel->findAll();
    
    //     // Debug output
    //     log_message('debug', print_r($allQuizzes, true));
    
    //     return view('admin/quizzes/index', [
    //         'course' => $course,
    //         'assignedQuizzes' => $assignedQuizzes,
    //         'allQuizzes' => $allQuizzes
    //     ]);
    // }


    public function getQuizzesForCourse($courseId)
{
    $quizModel = new QuizModel();
    $courseQuizModel = new CourseQuizModel();

    // Fetch assigned quizzes for the course
    $assignedQuizIds = $courseQuizModel->where('course_id', $courseId)->findAll();
    $assignedQuizzes = [];
    foreach ($assignedQuizIds as $entry) {
        $quiz = $quizModel->find($entry['quiz_id']);
        if ($quiz) {
            $assignedQuizzes[] = $quiz;
        }
    }

    // Fetch all quizzes
    $allQuizzes = $quizModel->findAll();

    return $this->response->setJSON([
        'assignedQuizzes' => $assignedQuizzes,
        'allQuizzes' => $allQuizzes
    ]);
}

    

    public function addQuizzes()
    {
        $courseId = $this->request->getPost('course_id');
        $selectedQuizzes = $this->request->getPost('quizzes');

        foreach ($selectedQuizzes as $quizId) {
            if (!$this->courseQuizModel->where('course_id', $courseId)->where('quiz_id', $quizId)->first()) {
                $this->courseQuizModel->insert([
                    'course_id' => $courseId,
                    'quiz_id' => $quizId
                ]);
            }
        }

        return redirect()->to(base_url('admin/quizzes/'.$courseId))->with('success', 'Quizzes added successfully.');
    }

    public function removeQuiz($courseId, $quizId)
   {
        // $courseId = $this->request->getPost('course_id');
        // $quizId = $this->request->getPost('quiz_id');
    
        log_message('debug', 'Received Course ID: ' . $courseId);
        log_message('debug', 'Received Quiz ID: ' . $quizId);
    
        if (!is_numeric($courseId) || !is_numeric($quizId)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid input.'
            ]);
        }
    
        $deleted = $this->courseQuizModel->where('course_id', $courseId)
                                         ->where('quiz_id', $quizId)
                                         ->delete();
    
        if ($deleted) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Quiz removed successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to remove quiz.'
            ]);
        }
    
    }

    
    // public function removeQuiz()
    // {
    //     $courseId = $this->request->getPost('course_id');
    //     $quizId = $this->request->getPost('quiz_id');

    //     // Log received values for debugging
    //     log_message('debug', 'Received Course ID: ' . $courseId);
    //     log_message('debug', 'Received Quiz ID: ' . $quizId);

    //     if (!is_numeric($courseId) || !is_numeric($quizId)) {
    //         return $this->response->setJSON([
    //             'status' => 'error',
    //             'message' => 'Invalid input.'
    //         ]);
    //     }

    //     // Attempt to delete the record
    //     $this->courseQuizModel->where('course_id', $courseId)
    //                           ->where('quiz_id', $quizId)
    //                           ->delete();

    //     // Check if any rows were affected by the delete operation
    //     if ($this->courseQuizModel->affectedRows() > 0) {
    //         return $this->response->setJSON([
    //             'status' => 'success',
    //             'message' => 'Quiz removed successfully.'
    //         ]);
    //     } else {
    //         return $this->response->setJSON([
    //             'status' => 'error',
    //             'message' => 'Failed to remove quiz. Record not found or already removed.'
    //         ]);
    //     }
    // }



    
}
