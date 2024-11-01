<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Users;
use App\Models\QuestionsModel;
use App\Models\CourseModel;
use App\Models\CourseuserModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;


class UserController extends BaseController
{


    protected $questionsModel;
    protected $userModel;
    protected $courseModel;
    protected $courseuserModel;

    public function __construct()
    {
        $this->questionsModel = new QuestionsModel();
        $this->userModel = new Users();
        $this->courseModel = new CourseModel();
        helper('csv'); // Load the CSV helper
    }


    

    public function index()
    {
        $users = $this->userModel->findAll();
        $courses = $this->courseModel->findAll();

        // If you want to show the list of users for a specific course, you need to handle it accordingly
        // Here we're just returning the basic list for demonstration
        return view('admin/users/index', [
            'users' => $users,
            'courses' => $courses,
            // For simplicity, these are left out in this context, you would fetch them in the appropriate method
            'assignedusers' => [],
            'allusers' => $users
        ]);
    }


    
    public function list()
    {
        $userModel = new Users();
        $search = $this->request->getGet('search');
        $sort = $this->request->getGet('sort');
        $page = $this->request->getGet('page') ?? 1;

        $query = $userModel;

        // Apply search filter
        if ($search) {
            $query = $query->like('username', $search)
                        ->orlike('email', $search)
                        ->orlike('first_name', $search)
                        ->orlike('last_name', $search)
                        ->orlike('phone_number', $search)
                        ->orLike('payment_confirmation_code', $search);
        }

        // Apply sorting
        if ($sort) {
            if ($sort == 'name_asc') {
                $query = $query->orderBy('username', 'ASC'); // Updated to match user fields
            } elseif ($sort == 'name_desc') {
                $query = $query->orderBy('username', 'DESC');
            } elseif ($sort == 'id_asc') {
                $query = $query->orderBy('id', 'ASC'); // Updated to match user fields
            } elseif ($sort == 'id_desc') {
                $query = $query->orderBy('id', 'DESC');
            }
        }

        $usersPerPage = 20;
        $users = $query->paginate($usersPerPage, 'default', $page);

        // Count results with filters applied
        $totalUsers = $query->countAllResults(false);

        return $this->response->setJSON([
            'users' => $users,
            'pagination' => [
                'currentPage' => $page,
                'totalPages' => ceil($totalUsers / $usersPerPage)
            ]
        ]);
    }



   


    // Email function included
    public function bulkUpload()
    {
        $file = $this->request->getFile('file');

        if ($file->isValid() && !$file->hasMoved()) {
            $extension = $file->getClientExtension();

            if ($extension === 'csv') {
                try {
                    $csvReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Csv');
                    $spreadsheet = $csvReader->load($file->getTempName());
                    $data = $spreadsheet->getActiveSheet()->toArray();

                    $headers = array_map('strtolower', $data[0]);
                    $requiredHeaders = [
                        'first_name', 'last_name', 'other_name', 'username', 'email', 'phone_number',
                        'registration_number', 'gender', 'password', 'activation_key', 'role_id', 'student_type',
                        'profile_picture', 'bio', 'payment_status', 'amount_paid', 'payment_confirmation_code',
                        'status', 'state_id', 'country_id', 'address', 'last_login_date'
                    ];

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

                    // Fetch all valid state and country IDs from the database
                    $db = \Config\Database::connect();
                    $validStates = array_column($db->table('states')->select('state_id')->get()->getResultArray(), 'state_id');
                    $validCountries = array_column($db->table('countries')->select('country_id')->get()->getResultArray(), 'country_id');

                    $skippedRows = [];
                    $duplicateEntries = [];
                    foreach ($data as $key => $row) {
                        if ($key === 0) continue; // Skip header row

                        $userData = [];
                        foreach ($requiredHeaders as $header) {
                            $userData[$header] = isset($row[$columnIndices[$header]]) ? trim($row[$columnIndices[$header]]) : null;
                        }

                        // Validate essential fields
                        if (!$userData['first_name'] || !$userData['last_name'] || !$userData['username'] || !$userData['email'] || !$userData['password']) {
                            log_message('error', "Row $key skipped due to missing essential data.");
                            $skippedRows[] = $key;
                            continue;
                        }

                        // Check state_id and country_id, skip them if invalid
                        if (!in_array($userData['state_id'], $validStates)) {
                            log_message('error', "Row $key has invalid state_id: " . $userData['state_id'] . ". Skipping.");
                            $userData['state_id'] = null; // Set to null if invalid
                        }

                        if (!in_array($userData['country_id'], $validCountries)) {
                            log_message('error', "Row $key has invalid country_id: " . $userData['country_id'] . ". Skipping.");
                            $userData['country_id'] = null; // Set to null if invalid
                        }

                        // Check for duplicates in the database before inserting
                        $existingUser = $this->userModel->where('username', $userData['username'])
                                                        ->orWhere('email', $userData['email'])
                                                        ->first();
                        if ($existingUser) {
                            log_message('info', "Row $key skipped due to duplicate entry: " . json_encode($userData));
                            $duplicateEntries[] = [
                                'username' => $userData['username'],
                                'email' => $userData['email']
                            ];
                            $skippedRows[] = $key;
                            continue; // Skip this row
                        }

                        // Process fields and insert data
                        $userData['password_hash'] = password_hash($userData['password'], PASSWORD_BCRYPT);
                        $userData['created_at'] = date('Y-m-d H:i:s');
                        $userData['updated_at'] = date('Y-m-d H:i:s');

                        if (!$this->userModel->insert($userData)) {
                            log_message('error', 'Database Insert Error for Row ' . $key . ': ' . json_encode($this->userModel->errors()));
                            $skippedRows[] = $key;
                            continue;
                        }

                        // Send registration email to the new user
                        $this->sendRegistrationEmail($userData['email'], $userData['first_name']);

                    }

                    return $this->response->setJSON([
                        'status' => 'success',
                        'message' => 'Users uploaded successfully.',
                        'skipped_rows' => $skippedRows,
                        'duplicate_entries' => $duplicateEntries
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

    private function sendRegistrationEmail($email, $firstName)
    {
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setFrom('info@learnxa.com', 'LearnXa');
        $emailService->setSubject('LearnXa Registration Successful');
        $emailService->setMessage("Hello $firstName,<br><br>Your registration was successful! You can now visit <a href='learnxa.com'>learnxa.com</a> to access your account.<br><br>Regards,<br>LearnXa Team");

        if (!$emailService->send()) {
            log_message('error', "Failed to send email to $email");
        }
    }


  
    

    public function create()
    {
        return view('users/create');
    }

   

    public function store()
    {
        $userModel = new Users();
        
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

        if ($userModel->save($data)) {
            return redirect()->to('/users')->with('success', 'User created successfully.');
        } else {
            return redirect()->back()->withInput()->with('errors', $userModel->errors());
        }
    }


    public function updateSettings()
    {
        $userModel = new Users();

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

        // Update the User settings in the database
        $userId = $this->request->getPost('quiz_id');
        if ($userModel->update($userId, $data)) {
            return redirect()->to('/users')->with('success', 'User settings updated successfully.');
        } else {
            return redirect()->back()->with('errors', $userModel->errors());
        }
    }
    // QuizController.php
    public function getUserSettings($userId)
    {
        $user  = $this->userModel->find($userId); // Assuming you have a `userModel` with `find()` method
        if ($user  ) {
            return $this->response->setJSON($user  );
        } else {
            return $this->response->setStatusCode(404, 'User not found')->setJSON(['error' => 'User not found']);
        }
    }




    public function edit($id)
    {
        $userModel = new Users();
        $user  = $userModel->find($id);

        if ($user  ) {
            return $this->response->setJSON([
                'user' => $user  
            ]);
        } else {
            return $this->response->setJSON([
                'error' => 'User not found'
            ], ResponseInterface::HTTP_NOT_FOUND);
        }
    }

    public function update()
    {
        $userModel = new Users();
        $data = $this->request->getPost();

        if ($userModel->save($data)) {
            return redirect()->to(base_url('users'))->with('success', 'User updated successfully');
        } else {
            return redirect()->to(base_url('users'))->with('error', 'Failed to update quiz');
        }
    }



    // Working perfectly
    public function delete($id)
    {
        $userModel = new Users();
        
        if ($userModel->delete($id)) {
            return redirect()->to('admin/users')->with('success', 'User deleted successfully.');
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


    public function assignusers()
    {
        // Get the selected course ID and User IDs from the request
        $courseId = $this->request->getPost('course_id');
        $selectedusers = $this->request->getPost('users');
    
        // Validate the course ID and User IDs
        if (empty($courseId) || empty($selectedusers)) {
            return redirect()->back()->withInput()->with('errors', 'Course ID or users are missing')->with('message_type', 'error');
        }
    
        // Load models
        // $courseuserModel = new CourseUsers();
        $userModel = new Users();
    
        // Validate that the course ID exists
        $courseExists = (new CourseModel())->find($courseId);
        if (!$courseExists) {
            return redirect()->back()->withInput()->with('errors', 'Invalid course ID')->with('message_type', 'error');
        }
    
        // Validate each User ID
        foreach ($selectedusers as $userId) {
            $userExists = $userModel->find($userId);
            if (!$userExists) {
                return redirect()->back()->withInput()->with('errors', 'Invalid User ID: ' . $userId)->with('message_type', 'error');
            }
        }
    
        
    
        $successMessage = "The users have been assigned to the course successfully";
        return redirect()->to('/users')
            ->with('success', $successMessage)
            ->with('message_type', 'success')
            ->with('message', $successMessage);
    }
    


    public function addusers()
    {
        $courseId = $this->request->getPost('course_id');
        $selectedusers = $this->request->getPost('users');

        foreach ($selectedusers as $userId) {
            if (!$this->courseuserModel->where('course_id', $courseId)->where('quiz_id', $userId)->first()) {
                $this->courseuserModel->insert([
                    'course_id' => $courseId,
                    'quiz_id' => $userId
                ]);
            }
        }

        return redirect()->to(base_url('users/'.$courseId))->with('success', 'users added successfully.');
    }

    public function removeQuiz($courseId, $userId)
    {
        // $courseId = $this->request->getPost('course_id');
        // $userId = $this->request->getPost('quiz_id');
    
        log_message('debug', 'Received Course ID: ' . $courseId);
        log_message('debug', 'Received User ID: ' . $userId);
    
        if (!is_numeric($courseId) || !is_numeric($userId)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid input.'
            ]);
        }
    
        $deleted = $this->courseuserModel->where('course_id', $courseId)
                                         ->where('quiz_id', $userId)
                                         ->delete();
    
        if ($deleted) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'User removed successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to remove quiz.'
            ]);
        }
    
    }




    public function exportUsers()
    {
        $userId = $this->request->getPost('user_id'); // Fetch user ID from the form, if provided
        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // Build the query with filters
        $query = $this->userModel->select('*'); // Adjust fields as needed to match User fields

        if (!empty($userId)) {
            $query = $query->where('user_id', $userId);
        }

        if (!empty($startDate) && !empty($endDate)) {
            $query = $query->where('created_at >=', $startDate)
                        ->where('created_at <=', $endDate);
        }

        $users = $query->findAll();

        if (empty($users)) {
            return $this->response->setJSON(['error' => 'No users found for the specified criteria']);
        }

        // Load the CSV helper
        helper('csv');

        // Prepare data for CSV
        $csvData = [];
        $csvHeader = [
            'User ID',
            'First Name',
            'Last Name',
            'Email',
            'Username',
            'Phone Number',
            'Registration Date',
            'Gender',
            'Status',
            'Country ID',
            'State ID',
            'Address',
            'Last Login Date',
            'Role ID'
        ];

        // Add header row
        $csvData[] = $csvHeader;

        // Populate the CSV with data from each user
        foreach ($users as $user) {
            $csvData[] = [
                $user['user_id'],
                $user['first_name'],
                $user['last_name'],
                $user['email'],
                $user['username'],
                $user['phone_number'],
                $user['created_at'],
                $user['gender'],
                $user['status'],
                $user['country_id'],
                $user['state_id'],
                $user['address'],
                $user['last_login_date'],
                $user['role_id']
            ];
        }

        // Create CSV file and force download
        $filename = 'users_export_' . date('YmdHis') . '.csv';
        $csvContent = csv_from_array($csvData);

        return $this->response
                    ->setHeader('Content-Type', 'text/csv')
                    ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                    ->setBody($csvContent);
    }



  
}
