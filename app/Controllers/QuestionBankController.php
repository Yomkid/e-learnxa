<?php

namespace App\Controllers;

use App\Models\QuestionsModel;
use App\Models\QuizModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


class QuestionBankController extends Controller
{
    protected $questionsModel;
    protected $quizModel;

    public function __construct()
    {
        $this->questionsModel = new QuestionsModel();
        $this->quizModel = new QuizModel();
        helper('csv'); // Load the CSV helper
    }

    public function index()
    {
        $data['quizzes'] = $this->quizModel->findAll();
        return view('admin/questionbank/index', $data);
    }

    public function getQuizzes()
    {
        // This function is to be used for fetching quizzes via AJAX if needed
        $quizzes = $this->quizModel->findAll();
        return $this->response->setJSON($quizzes);
    }


    public function list()
    {
        $search = $this->request->getGet('search');
        $sort = $this->request->getGet('sort');
        $page = $this->request->getGet('page') ?? 1;
        $perPage = 10; // Number of questions per page

        $builder = $this->questionsModel;

        if ($search) {
            $builder->like('question_text', $search);
        }

        if ($sort) {
            $builder->orderBy($sort);
        }

        $totalQuestions = $builder->countAllResults(false);
        $questions = $builder->paginate($perPage);
        $pagination = $this->questionsModel->pager;

        return $this->response->setJSON([
            'questions' => $questions,
            'pagination' => [
                'totalPages' => $pagination->getPageCount(),
                'currentPage' => $page
            ]
        ]);
    }






    public function multiQuestionStore()
    {
        $validation = \Config\Services::validation();

        // Define validation rules for multiple questions
        $rules = [
            'questions' => 'required',
            'questions.*.quiz_id' => 'required|integer',
            'questions.*.question_text' => 'required|unique_multi_question[quiz_id]',
            'questions.*.option_a' => 'required',
            'questions.*.option_b' => 'required',
            'questions.*.option_c' => 'required',
            'questions.*.option_d' => 'required',
            'questions.*.correct_answer' => 'required',
            'questions.*.explanation' => 'required'
        ];
    

        $questions = json_decode($this->request->getPost('questions'), true);

        if (!$validation->setRules($rules)->run(['questions' => $questions])) {
            $errors = $validation->getErrors();
            return $this->response->setJSON(['error' => 'This question is already exists for this particular Quiz', 'details' => $errors]);
        }
    


        
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->response->setJSON(['error' => 'Invalid JSON data']);
        }
        
        if (!is_array($questions)) {
            return $this->response->setJSON(['error' => 'No questions found to process']);
        }
    
        $successCount = 0;
        $errorCount = 0;
    
        foreach ($questions as $question) {
            $data = [
                'quiz_id' => $question['quiz_id'],
                'question_text' => $question['question_text'],
                'option_a' => $question['option_a'],
                'option_b' => $question['option_b'],
                'option_c' => $question['option_c'],
                'option_d' => $question['option_d'],
                'correct_option' => $question['correct_answer'],
                'explanation' => $question['explanation'],
            ];
    
            if ($this->questionsModel->save($data)) {
                $successCount++;
            } else {
                $errorCount++;
            }
        }
    
        if ($successCount > 0) {
            return $this->response->setJSON(['success' => "$successCount questions added successfully"]);
        } else {
            return $this->response->setJSON(['error' => 'Failed to add questions']);
        }
    }
    


    public function store()
    {
        $validation = \Config\Services::validation();
    
        $rules = [
            'quiz_id' => 'required|integer',
            'question_text' => 'required|unique_question[quiz_id]',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_answer' => 'required',
            'explanation' => 'required'
        ];
    
        if (!$this->validate($rules)) {
            $errors = $validation->getErrors();
            return $this->response->setJSON(['error' => 'This question is already exists for this particular Quiz']);
        }
    
        $data = [
            'quiz_id' => $this->request->getPost('quiz_id'),
            'question_text' => $this->request->getPost('question_text'),
            'option_a' => $this->request->getPost('option_a'),
            'option_b' => $this->request->getPost('option_b'),
            'option_c' => $this->request->getPost('option_c'),
            'option_d' => $this->request->getPost('option_d'),
            'correct_option' => $this->request->getPost('correct_answer'),
            'explanation' => $this->request->getPost('explanation'),
        ];


        if ($this->questionsModel->save($data)) {
            return $this->response->setJSON(['success' => 'Question added successfully']);
        } else {
            return $this->response->setJSON(['error' => 'Failed to add the question']);
        }
    
        // $this->questionsModel->save($data);
        // return $this->response->setJSON(['status' => 'success', 'message' => 'Question added successfully']);
    }
     



    public function update()
    {
       
        $data = [
            'question_id' => $this->request->getPost('question_id'),
            'question_text' => $this->request->getPost('question_text'),
            'question_options' => json_encode($this->request->getPost('question_options')), // Save as JSON
            'correct_option' => $this->request->getPost('correct_answer'),
        ];

        $this->questionsModel->save($data);
        return $this->response->setJSON(['success' => 'Question updated successfully']);
    }

    public function delete($id)
    {
        $this->questionsModel->delete($id);
        // return $this->response->setJSON(['success' => 'Question deleted successfully']);
        return redirect()->back()->with('success','Question deleted successfully');
    }



public function bulkUpload()
{
    // Retrieve the quiz_id from the POST request
    $quizId = $this->request->getPost('quiz_id_bulk');
    $file = $this->request->getFile('questions_file');

    if ($file->isValid() && !$file->hasMoved()) {
        $extension = $file->getClientExtension();

        if ($extension === 'csv') {
            try {
                $csvReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Csv');
                $spreadsheet = $csvReader->load($file->getTempName());
                $data = $spreadsheet->getActiveSheet()->toArray();

                $headers = array_map('strtolower', $data[0]);
                $requiredHeaders = [
                    'question_text', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_option', 'explanation'
                ];

                // Check for missing required columns
                $columnIndices = [];
                foreach ($requiredHeaders as $header) {
                    if (!in_array($header, $headers)) {
                        return $this->response->setJSON([
                            'status' => 'error',
                            'message' => "Missing required column: $header"
                        ]);
                    }
                    $columnIndices[$header] = array_search($header, $headers);
                }

                $skippedRows = [];
                foreach ($data as $key => $row) {
                    if ($key === 0) continue; // Skip header row

                    $questionData = ['quiz_id' => $quizId]; // Add quiz_id here
                    foreach ($requiredHeaders as $header) {
                        $questionData[$header] = isset($row[$columnIndices[$header]]) ? trim($row[$columnIndices[$header]]) : null;
                    }

                    // Validate essential fields
                    if (!$questionData['quiz_id'] || !$questionData['question_text'] || !$questionData['correct_option']) {
                        log_message('error', "Row $key skipped due to missing essential data.");
                        $skippedRows[] = $key;
                        continue;
                    }

                    // Check if the question already exists in the quiz
                    $existingQuestion = $this->questionsModel
                        ->where('quiz_id', $questionData['quiz_id'])
                        ->where('question_text', $questionData['question_text'])
                        ->first();

                    if ($existingQuestion) {
                        log_message('info', "Row $key skipped due to duplicate question.");
                        $skippedRows[] = $key;
                        continue;
                    }

                    // Insert question into the database
                    $questionData['created_at'] = date('Y-m-d H:i:s');
                    $questionData['updated_at'] = date('Y-m-d H:i:s');

                    if (!$this->questionsModel->insert($questionData)) {
                        log_message('error', 'Database Insert Error for Row ' . $key . ': ' . json_encode($this->questionsModel->errors()));
                        $skippedRows[] = $key;
                        continue;
                    }
                }

                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Questions uploaded successfully.',
                    'skipped_rows' => $skippedRows
                ]);
            } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
                log_message('error', 'Spreadsheet Reader Error: ' . $e->getMessage());
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'File parsing failed due to an unexpected error.'
                ]);
            } catch (\Exception $e) {
                log_message('error', 'General Error: ' . $e->getMessage());
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'An unexpected error occurred while processing the file.'
                ]);
            }
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid file format. Please upload a CSV file.'
            ]);
        }
    } else {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'File upload failed.'
        ]);
    }
}




    public function exportQuestions()
    {
        $quizId = $this->request->getPost('quiz_id');
        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // Build the query with filters
        $query = $this->questionsModel->select('*');

        if (!empty($quizId)) {
            $query = $query->where('quiz_id', $quizId);
        }

        if (!empty($startDate) && !empty($endDate)) {
            $query = $query->where('created_at >=', $startDate)
                        ->where('created_at <=', $endDate);
        }

        $questions = $query->findAll();

        if (empty($questions)) {
            return $this->response->setJSON(['error' => 'No questions found for the specified criteria']);
        }

        // Load the CSV helper
        helper('csv');

        // Prepare data for CSV
        $csvData = [];
        $csvHeader = [
            'Quiz ID',
            'Question Text',
            'Option A',
            'Option B',
            'Option C',
            'Option D',
            'Correct Answer',
            'Explanation',
            'Created At'
        ];

        // Add header row
        $csvData[] = $csvHeader;

        foreach ($questions as $question) {
            $csvData[] = [
                $question['quiz_id'],
                $question['question_text'],
                $question['option_a'],
                $question['option_b'],
                $question['option_c'],
                $question['option_d'],
                $question['correct_option'],
                $question['explanation'],
                $question['created_at'],
            ];
        }

        // Create CSV file and force download
        $filename = 'questions_export_' . date('YmdHis') . '.csv'; // Add a timestamp to filename
        $csvContent = csv_from_array($csvData);

        return $this->response
                    ->setHeader('Content-Type', 'text/csv')
                    ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                    ->setBody($csvContent);
    }




}
