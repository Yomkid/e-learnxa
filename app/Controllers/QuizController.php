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


    

    public function index()
    {
        $quizzes = $this->quizModel->findAll();
        $courses = $this->courseModel->findAll();

        // If you want to show the list of quizzes for a specific course, you need to handle it accordingly
        // Here we're just returning the basic list for demonstration
        return view('/admin/quizzes/index', [
            'quizzes' => $quizzes,
            'courses' => $courses,
            // For simplicity, these are left out in this context, you would fetch them in the appropriate method
            'assignedQuizzes' => [],
            'allQuizzes' => $quizzes
        ]);
    }

    

    public function create()
    {
        return view('/admin/quizzes/create');
    }

    // public function store()
    // {
    //     $quizModel = new QuizModel();
        
    //     $data = [
    //         'quiz_name' => $this->request->getPost('quiz_name'),
    //         'quiz_description' => $this->request->getPost('quiz_description'),
    //     ];

    //     if ($quizModel->save($data)) {
    //         return redirect()->to('/quizzes')->with('success', 'Quiz created successfully.');
    //     } else {
    //         return redirect()->back()->with('errors', $quizModel->errors());
    //     }
    // }

    public function store()
{
    $quizModel = new QuizModel();
    
    $data = [
        'quiz_name' => $this->request->getPost('quiz_name'),
        'quiz_description' => $this->request->getPost('quiz_description'),
        'total_marks' => $this->request->getPost('total_marks'),
        'duration' => $this->request->getPost('duration'),
        'passing_score' => $this->request->getPost('passing_score'),
        'max_attempts' => $this->request->getPost('max_attempts'),
        'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        'start_date' => $this->request->getPost('start_date'),
        'end_date' => $this->request->getPost('end_date'),
        'shuffle_questions' => $this->request->getPost('shuffle_questions') ? 1 : 0,
        'shuffle_answers' => $this->request->getPost('shuffle_answers') ? 1 : 0,
        'published' => $this->request->getPost('published') ? 1 : 0,
        'access_code' => $this->request->getPost('access_code'),
        'quiz_type' => $this->request->getPost('quiz_type'),
        'attempt_mode' => $this->request->getPost('attempt_mode'),
        'retake_delay' => $this->request->getPost('retake_delay'),
        'allow_review' => $this->request->getPost('allow_review') ? 1 : 0,
        'feedback_enabled' => $this->request->getPost('feedback_enabled') ? 1 : 0,
        'feedback_message' => $this->request->getPost('feedback_message'),
        'category_id' => $this->request->getPost('category_id'),
        'course_id' => $this->request->getPost('course_id'),
    ];

    // Handle image upload if present
    $image = $this->request->getFile('image_url');
    if ($image && $image->isValid() && !$image->hasMoved()) {
        $newImageName = $image->getRandomName();
        $image->move(WRITEPATH . 'uploads', $newImageName);
        $data['image_url'] = '/uploads/' . $newImageName;
    }

    if ($quizModel->save($data)) {
        return redirect()->to('/quizzes')->with('success', 'Quiz created successfully.');
    } else {
        return redirect()->back()->withInput()->with('errors', $quizModel->errors());
    }
}


    public function updateSettings()
    {
        $quizModel = new QuizModel();

        // Validate input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'quiz_id'            => 'required|is_natural_no_zero',
            'quiz_name'          => 'required|string|max_length[255]',
            'quiz_description'   => 'permit_empty|string',
            'total_marks'        => 'permit_empty|integer',
            'duration'           => 'permit_empty|integer',
            'passing_score'      => 'permit_empty|integer|greater_than_equal_to[0]|less_than_equal_to[100]',
            'max_attempts'       => 'permit_empty|integer',
            'is_active'          => 'permit_empty|integer',
            'start_date'         => 'permit_empty|valid_date',
            'end_date'           => 'permit_empty|valid_date',
            'shuffle_questions'  => 'permit_empty|integer',
            'shuffle_answers'    => 'permit_empty|integer',
            'published'          => 'permit_empty|integer',
            'access_code'        => 'permit_empty|string|max_length[20]',
            'quiz_type'          => 'permit_empty|string',
            'attempt_mode'       => 'permit_empty|string',
            'retake_delay'       => 'permit_empty|integer',
            'allow_review'       => 'permit_empty|integer',
            'feedback_enabled'   => 'permit_empty|integer',
            'feedback_message'   => 'permit_empty|string|max_length[255]',
            'category_id'        => 'permit_empty|integer',
            'course_id'          => 'permit_empty|integer'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Gather data from the form submission
        $data = [
            'quiz_name'          => $this->request->getPost('quiz_name'),
            'quiz_description'   => $this->request->getPost('quiz_description'),
            'total_marks'        => $this->request->getPost('total_marks'),
            'duration'           => $this->request->getPost('duration'),
            'passing_score'      => $this->request->getPost('passing_score'),
            'max_attempts'       => $this->request->getPost('max_attempts'),
            'is_active'          => $this->request->getPost('is_active') ? 1 : 0,
            'start_date'         => $this->request->getPost('start_date'),
            'end_date'           => $this->request->getPost('end_date'),
            'shuffle_questions'  => $this->request->getPost('shuffle_questions') ? 1 : 0,
            'shuffle_answers'    => $this->request->getPost('shuffle_answers') ? 1 : 0,
            'published'          => $this->request->getPost('published') ? 1 : 0,
            'access_code'        => $this->request->getPost('access_code'),
            'quiz_type'          => $this->request->getPost('quiz_type'),
            'attempt_mode'       => $this->request->getPost('attempt_mode'),
            'retake_delay'       => $this->request->getPost('retake_delay'),
            'allow_review'       => $this->request->getPost('allow_review') ? 1 : 0,
            'feedback_enabled'   => $this->request->getPost('feedback_enabled') ? 1 : 0,
            'feedback_message'   => $this->request->getPost('feedback_message'),
            'category_id'        => $this->request->getPost('category_id'),
            'course_id'          => $this->request->getPost('course_id')
        ];

        // Update the quiz settings in the database
        $quizId = $this->request->getPost('quiz_id');
        if ($quizModel->update($quizId, $data)) {
            return redirect()->to('/quizzes')->with('success', 'Quiz settings updated successfully.');
        } else {
            return redirect()->back()->with('errors', $quizModel->errors());
        }
    }
    // QuizController.php
    public function getQuizSettings($quizId)
    {
        $quiz = $this->quizModel->find($quizId); // Assuming you have a `QuizModel` with `find()` method
        if ($quiz) {
            return $this->response->setJSON($quiz);
        } else {
            return $this->response->setStatusCode(404, 'Quiz not found')->setJSON(['error' => 'Quiz not found']);
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

        return redirect()->to(base_url('/admin/quizzes/'.$courseId))->with('success', 'Quizzes added successfully.');
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


    // public function bulkUpload()
    // {
    //     try {
    //         $validation = \Config\Services::validation();
    //         $rules = [
    //             'quizzes_file' => 'uploaded[quizzes_file]|max_size[quizzes_file,1024]|ext_in[quizzes_file,csv,xlsx]'
    //         ];
    
    //         // Validate file upload
    //         if (!$this->validate($rules)) {
    //             $errors = $validation->getErrors();
    //             return $this->response->setJSON(['error' => 'Invalid file format. Please upload only Excel or CSV files.', 'details' => $errors]);
    //         }
    
    //         $file = $this->request->getFile('quizzes_file');
    
    //         if ($file->isValid() && !$file->hasMoved()) {
    //             $filePath = WRITEPATH . 'uploads/' . $file->store();
    //             $quizzes = [];
    
    //             // Parse file based on extension
    //             if ($file->getClientExtension() === 'csv') {
    //                 $quizzes = $this->parseCSV($filePath);
    //             } elseif ($file->getClientExtension() === 'xlsx') {
    //                 $quizzes = $this->parseExcel($filePath);
    //             }
    
    //             // Log parsed quizzes for debugging
    //             log_message('debug', 'Parsed quizzes data: ' . print_r($quizzes, true));
    
    //             // Initialize counters
    //             $successCount = 0;
    //             $errorCount = 0;
    //             $failedEntries = [];
    
    //             // Process each quiz entry
    //             foreach ($quizzes as $index => $quiz) {
    //                 // Prepare data and provide defaults
    //                 $data = [
    //                     'quiz_name' => $quiz['quiz_name'] ?? '',
    //                     'quiz_description' => $quiz['quiz_description'] ?? '',
    //                     'total_marks' => $quiz['total_marks'] ?? 0,
    //                     'duration' => $quiz['duration'] ?? 0,
    //                     'passing_score' => $quiz['passing_score'] ?? 0,
    //                     'max_attempts' => $quiz['max_attempts'] ?? 1,
    //                     'is_active' => isset($quiz['is_active']) ? (int)$quiz['is_active'] : 0,
    //                     'start_date' => $quiz['start_date'] ?? null,
    //                     'end_date' => $quiz['end_date'] ?? null,
    //                     'shuffle_questions' => isset($quiz['shuffle_questions']) ? (int)$quiz['shuffle_questions'] : 0,
    //                     'shuffle_answers' => isset($quiz['shuffle_answers']) ? (int)$quiz['shuffle_answers'] : 0,
    //                     'published' => isset($quiz['published']) ? (int)$quiz['published'] : 0,
    //                     'access_code' => $quiz['access_code'] ?? '',
    //                     'quiz_type' => $quiz['quiz_type'] ?? '',
    //                     'attempt_mode' => $quiz['attempt_mode'] ?? '',
    //                     'retake_delay' => $quiz['retake_delay'] ?? 0,
    //                     'allow_review' => isset($quiz['allow_review']) ? (int)$quiz['allow_review'] : 0,
    //                     'feedback_enabled' => isset($quiz['feedback_enabled']) ? (int)$quiz['feedback_enabled'] : 0,
    //                     'feedback_message' => $quiz['feedback_message'] ?? '',
    //                     'category_id' => $quiz['category_id'] ?? null,
    //                     'course_id' => $quiz['course_id'] ?? null
    //                 ];
    
    //                 // Attempt to save quiz data
    //                 if ($this->quizModel->save($data)) {
    //                     $successCount++;
    //                 } else {
    //                     $errorCount++;
    //                     $failedEntries[] = [
    //                         'row' => $index + 1,
    //                         'errors' => $this->quizModel->errors() // Capture model-specific errors
    //                     ];
    //                 }
    //             }
    
    //             // Return success and error information
    //             return $this->response->setJSON([
    //                 'success' => "$successCount quizzes added successfully",
    //                 'errors' => "$errorCount quizzes failed",
    //                 'failedEntries' => $failedEntries
    //             ]);
    //         }
    
    //         return $this->response->setJSON(['error' => 'File upload failed']);
    //     } catch (\Exception $e) {
    //         return $this->response->setJSON([
    //             'error' => 'An unexpected server error occurred.',
    //             'message' => $e->getMessage()
    //         ]);
    //     }
    // }

    public function bulkUpload()
{
    try {
        $validation = \Config\Services::validation();
        $rules = [
            'quizzes_file' => 'uploaded[quizzes_file]|max_size[quizzes_file,1024]|ext_in[quizzes_file,csv,xlsx]'
        ];

        // Validate file upload
        if (!$this->validate($rules)) {
            $errors = $validation->getErrors();
            return $this->response->setJSON(['error' => 'Invalid file format. Please upload only Excel or CSV files.', 'details' => $errors]);
        }

        $file = $this->request->getFile('quizzes_file');

        if ($file->isValid() && !$file->hasMoved()) {
            $filePath = WRITEPATH . 'uploads/' . $file->store();
            $quizzes = [];

            // Parse file based on extension
            if ($file->getClientExtension() === 'csv') {
                $quizzes = $this->parseCSV($filePath);
            } elseif ($file->getClientExtension() === 'xlsx') {
                $quizzes = $this->parseExcel($filePath);
            }

            log_message('debug', 'Parsed quizzes data: ' . print_r($quizzes, true));

            // Initialize counters
            $successCount = 0;
            $errorCount = 0;
            $failedEntries = [];

            // Process each quiz entry
            foreach ($quizzes as $index => $quiz) {
                // Check for required fields
                if (empty($quiz['quiz_name']) || empty($quiz['quiz_description'])) {
                    $errorCount++;
                    $failedEntries[] = [
                        'row' => $index + 1,
                        'error' => 'Missing required fields'
                    ];
                    continue; // Skip this entry
                }

                // Prepare data with defaults
                $data = [
                    'quiz_name' => $quiz['quiz_name'] ?? '',
                    'quiz_description' => $quiz['quiz_description'] ?? '',
                    // Add other fields as necessary
                ];

                // Attempt to save quiz data
                if ($this->quizModel->save($data)) {
                    $successCount++;
                } else {
                    $errorCount++;
                    $failedEntries[] = [
                        'row' => $index + 1,
                        'errors' => $this->quizModel->errors() // Capture model-specific errors
                    ];
                }
            }

            // Return success and error information
            return $this->response->setJSON([
                'success' => "$successCount quizzes added successfully",
                'errors' => "$errorCount quizzes failed",
                'failedEntries' => $failedEntries
            ]);
        }

        return $this->response->setJSON(['error' => 'File upload failed']);
    } catch (\Exception $e) {
        return $this->response->setJSON([
            'error' => 'An unexpected server error occurred.',
            'message' => $e->getMessage()
        ]);
    }
}

    


    private function parseCSV($filePath)
    {
        $file = fopen($filePath, 'r');
        $quizzes = [];
        $headers = fgetcsv($file);
    
        while ($row = fgetcsv($file)) {
            // Skip empty rows or rows with missing required fields
            if (empty(array_filter($row))) {
                continue;
            }
            $combinedData = array_combine($headers, $row);
            if ($combinedData) {
                $quizzes[] = $combinedData;
            }
        }
    
        fclose($file);
        return $quizzes;
    }
    

    private function parseExcel($filePath)
    {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $quizzes = [];
        $headers = $sheet->rangeToArray('A1:V1')[0]; // Adjust range based on your header fields
    
        foreach ($sheet->getRowIterator(2) as $row) {
            $rowData = $sheet->rangeToArray('A' . $row->getRowIndex() . ':V' . $row->getRowIndex())[0];
    
            // Skip empty rows or rows with missing required fields
            if (empty(array_filter($rowData))) {
                continue;
            }
    
            $combinedData = array_combine($headers, $rowData);
            if ($combinedData) {
                $quizzes[] = $combinedData;
            }
        }
    
        return $quizzes;
    }
    


    public function exportQuizzes()
    {
        $quizId = $this->request->getPost('quiz_id');
        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // Build the query with filters
        $query = $this->quizModel->select('*'); // Adjust fields as needed to match quiz fields

        if (!empty($quizId)) {
            $query = $query->where('quiz_id', $quizId);
        }

        if (!empty($startDate) && !empty($endDate)) {
            $query = $query->where('created_at >=', $startDate)
                        ->where('created_at <=', $endDate);
        }

        $quizzes = $query->findAll();

        if (empty($quizzes)) {
            return $this->response->setJSON(['error' => 'No quizzes found for the specified criteria']);
        }

        // Load the CSV helper
        helper('csv');

        // Prepare data for CSV
        $csvData = [];
        $csvHeader = [
            'Quiz ID',
            'Quiz Name',
            'Description',
            'Total Marks',
            'Duration',
            'Passing Score',
            'Max Attempts',
            'Is Active',
            'Start Date',
            'End Date',
            'Shuffle Questions',
            'Shuffle Answers',
            'Published',
            'Access Code',
            'Quiz Type',
            'Attempt Mode',
            'Retake Delay',
            'Allow Review',
            'Feedback Enabled',
            'Feedback Message',
            'Category ID',
            'Course ID',
            'Created At'
        ];

        // Add header row
        $csvData[] = $csvHeader;

        // Populate the CSV with data from each quiz
        foreach ($quizzes as $quiz) {
            $csvData[] = [
                $quiz['quiz_id'],
                $quiz['quiz_name'],
                $quiz['quiz_description'],
                $quiz['total_marks'],
                $quiz['duration'],
                $quiz['passing_score'],
                $quiz['max_attempts'],
                $quiz['is_active'],
                $quiz['start_date'],
                $quiz['end_date'],
                $quiz['shuffle_questions'],
                $quiz['shuffle_answers'],
                $quiz['published'],
                $quiz['access_code'],
                $quiz['quiz_type'],
                $quiz['attempt_mode'],
                $quiz['retake_delay'],
                $quiz['allow_review'],
                $quiz['feedback_enabled'],
                $quiz['feedback_message'],
                $quiz['category_id'],
                $quiz['course_id'],
                $quiz['created_at']
            ];
        }

        // Create CSV file and force download
        $filename = 'quizzes_export_' . date('YmdHis') . '.csv';
        $csvContent = csv_from_array($csvData);

        return $this->response
                    ->setHeader('Content-Type', 'text/csv')
                    ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                    ->setBody($csvContent);
    }


  
}
