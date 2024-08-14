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
        return view('questionbank/index', $data);
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
    
        // if (!$this->validate($rules)) {
        //     $errors = $validation->getErrors();
        //     return $this->response->setJSON(['error' => 'Validation failed', 'details' => $errors]);
        // }
    
        
    
        // $questionsJson = $this->request->getPost('questions');
    
        // // Decode JSON string into PHP array
        // $questions = json_decode($questionsJson, true);
        // // $questions = json_decode($this->request->getPost('questions'), true);


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


    // public function bulkUpload()
    // {
    //     if ($this->request->getFile('questions_file') && $this->request->getPost('quiz_id')) {
    //         $quizId = $this->request->getPost('quiz_id');
    //         $file = $this->request->getFile('questions_file');

    //         if ($file->isValid() && !$file->hasMoved()) {
    //             $filePath = WRITEPATH . 'uploads/' . $file->store();

    //             // Process the CSV file
    //             $questions = $this->parseCSV($filePath);

    //             $successCount = 0;
    //             $errorCount = 0;

    //             foreach ($questions as $question) {
    //                 $data = [
    //                     'quiz_id' => $quizId,
    //                     'question_text' => $question['question_text'],
    //                     'option_a' => $question['option_a'],
    //                     'option_b' => $question['option_b'],
    //                     'option_c' => $question['option_c'],
    //                     'option_d' => $question['option_d'],
    //                     'correct_option' => $question['correct_answer'],
    //                     'explanation' => $question['explanation'],
    //                 ];

    //                 if ($this->questionsModel->save($data)) {
    //                     $successCount++;
    //                 } else {
    //                     $errorCount++;
    //                 }
    //             }

    //             return $this->response->setJSON(['success' => "$successCount questions added successfully"]);
    //         }
    //     }

    //     return $this->response->setJSON(['error' => 'File upload failed']);
    // }

// private function parseCSV($filePath)
// {
//     $file = fopen($filePath, 'r');
//     $questions = [];

//     // Assuming the first row contains column headers
//     $headers = fgetcsv($file);

//     while ($row = fgetcsv($file)) {
//         $questions[] = array_combine($headers, $row);
//     }

//     fclose($file);
//     return $questions;
// }



// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

public function bulkUpload()
{
    $validation = \Config\Services::validation();
    $rules = [
        'quiz_id' => 'required|integer',
        'questions_file' => 'uploaded[questions_file]|max_size[questions_file,1024]|ext_in[questions_file,csv,xlsx]'
    ];

    if (!$this->validate($rules)) {
        $errors = $validation->getErrors();
        // return $this->response->setJSON(['error' => 'Validation failed', 'details' => $errors]);
        return $this->response->setJSON(['error' => 'You are a Bad Person, why are you uploading bad file when you were told to upload only Excel and CSV. Haba!', 'details' => $errors]);
    }

    $quizId = $this->request->getPost('quiz_id');
    $file = $this->request->getFile('questions_file');

    if ($file->isValid() && !$file->hasMoved()) {
        $filePath = WRITEPATH . 'uploads/' . $file->store();
        $questions = [];

        if ($file->getClientExtension() == 'csv') {
            $questions = $this->parseCSV($filePath);
        } elseif ($file->getClientExtension() == 'xlsx') {
            $questions = $this->parseExcel($filePath);
        }

        $successCount = 0;
        $errorCount = 0;

        foreach ($questions as $question) {
            $data = [
                'quiz_id' => $quizId,
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

        return $this->response->setJSON(['success' => "$successCount questions added successfully"]);
    }

    return $this->response->setJSON(['error' => 'File upload failed']);
}


private function parseCSV($filePath)
{
    $file = fopen($filePath, 'r');
    $questions = [];
    $headers = fgetcsv($file);

    while ($row = fgetcsv($file)) {
        // Check if the row is empty or has empty required fields
        if (empty(array_filter($row))) {
            continue;
        }
        $questions[] = array_combine($headers, $row);
    }

    fclose($file);
    return $questions;
}


private function parseExcel($filePath)
{
    $reader = new Xlsx();
    $spreadsheet = $reader->load($filePath);
    $sheet = $spreadsheet->getActiveSheet();
    $questions = [];
    $headers = $sheet->rangeToArray('A1:G1')[0];

    foreach ($sheet->getRowIterator(2) as $row) {
        $rowData = $sheet->rangeToArray('A' . $row->getRowIndex() . ':G' . $row->getRowIndex())[0];

        // Check if the row is empty or has empty required fields
        if (empty(array_filter($rowData))) {
            continue;
        }
        
        $questions[] = array_combine($headers, $rowData);
    }

    return $questions;
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







// Below CSV and Excel Funtions are working well, it jus that I need to adjust it to skip empty rows

// private function parseCSV($filePath)
// {
//     $file = fopen($filePath, 'r');
//     $questions = [];
//     $headers = fgetcsv($file);

//     while ($row = fgetcsv($file)) {
//         $questions[] = array_combine($headers, $row);
//     }

//     fclose($file);
//     return $questions;
// }

// private function parseExcel($filePath)
// {
//     $reader = new Xlsx();
//     $spreadsheet = $reader->load($filePath);
//     $sheet = $spreadsheet->getActiveSheet();
//     $questions = [];
//     $headers = $sheet->rangeToArray('A1:G1')[0];

//     foreach ($sheet->getRowIterator(2) as $row) {
//         $rowData = $sheet->rangeToArray('A' . $row->getRowIndex() . ':G' . $row->getRowIndex())[0];
//         $questions[] = array_combine($headers, $rowData);
//     }

//     return $questions;
// }



    // public function upload()
    // {
    //     if (!$this->request->getFile('file')) {
    //         return $this->response->setJSON(['error' => 'No file uploaded']);
    //     }

    //     $file = $this->request->getFile('file');
    //     $extension = $file->getExtension();

    //     if ($extension === 'csv') {
    //         $this->uploadCSV($file);
    //     } elseif ($extension === 'xlsx') {
    //         $this->uploadExcel($file);
    //     } else {
    //         return $this->response->setJSON(['error' => 'Invalid file type']);
    //     }

    //     return $this->response->setJSON(['success' => 'Questions uploaded successfully']);
    // }

    // private function uploadCSV($file)
    // {
    //     $file->move(WRITEPATH . 'uploads');
    //     $path = WRITEPATH . 'uploads/' . $file->getName();
    //     $handle = fopen($path, 'r');

    //     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    //         $this->questionsModel->save([
    //             'question_text' => $data[0],
    //             'question_options' => json_encode([
    //                 'a' => $data[1],
    //                 'b' => $data[2],
    //                 'c' => $data[3],
    //                 'd' => $data[4]
    //             ]),
    //             'correct_answer' => $data[5],
    //         ]);
    //     }

    //     fclose($handle);
    // }

    // private function uploadExcel($file)
    // {
    //     $file->move(WRITEPATH . 'uploads');
    //     $path = WRITEPATH . 'uploads/' . $file->getName();
        
    //     $spreadsheet = IOFactory::load($path);
    //     $worksheet = $spreadsheet->getActiveSheet();
    //     $data = $worksheet->toArray();

    //     foreach ($data as $row) {
    //         if (empty($row[0])) continue; // Skip empty rows

    //         $this->questionsModel->save([
    //             'question_text' => $row[0],
    //             'question_options' => json_encode([
    //                 'a' => $row[1],
    //                 'b' => $row[2],
    //                 'c' => $row[3],
    //                 'd' => $row[4]
    //             ]),
    //             'correct_option' => $row[5],
    //         ]);
    //     }
    // }
}
