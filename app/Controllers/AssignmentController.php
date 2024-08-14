<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AssignmentModel;
use App\Models\CourseModel;
use App\Models\CourseAssignmentModel;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

// use App\Models\CourseQuizModel;


class AssignmentController extends BaseController
{


    protected $assignmentsModel;
    protected $assignmentModel;
    protected $courseModel;
    protected $courseAssignmentModel;
    // protected $courseQuizModel;

    public function __construct()
    {
        $this->assignmentModel = new AssignmentModel();
        $this->courseModel = new CourseModel();
        $this->courseAssignmentModel = new CourseAssignmentModel();
        // $this->courseQuizModel = new CourseQuizModel();
        helper('csv'); // Load the CSV helper
    }


    // public function index()
    // {
    //     $assignmentModel = new AssignmentModel();
    //     $courseModel = new CourseModel();
        
    //     $assignments = $assignmentModel->findAll();
    //     $courses = $courseModel->findAll();
    
    //     // Corrected return statement with associative array
    //     return view('assignments/index', [
    //         'assignments' => $assignments,
    //         'courses' => $courses
    //     ]);
    // }

    public function index()
{
    $assignments = $this->assignmentModel->findAll();
    $courses = $this->courseModel->findAll();

    // If you want to show the list of assignments for a specific course, you need to handle it accordingly
    // Here we're just returning the basic list for demonstration
    return view('assignments/index', [
        'assignments' => $assignments,
        'courses' => $courses,
        // For simplicity, these are left out in this context, you would fetch them in the appropriate method
        'assignedassignments' => [],
        'allassignments' => $assignments
    ]);
}

    

    public function create()
    {
        return view('assignments/create');
    }

    public function store()
    {
        $assignmentModel = new AssignmentModel();
        
        $data = [
            'assignment_name' => $this->request->getPost('assignment_name'),
            'assignment_description' => $this->request->getPost('assignment_description'),
        ];

        if ($assignmentModel->save($data)) {
            return redirect()->to('/assignments')->with('success', 'assignment created successfully.');
        } else {
            return redirect()->back()->with('errors', $assignmentModel->errors());
        }
    }

    public function list()
    {
        $assignmentModel = new AssignmentModel();
        $search = $this->request->getGet('search');
        $sort = $this->request->getGet('sort');
        $page = $this->request->getGet('page') ?? 1;

        $query = $assignmentModel;

        if ($search) {
            $query = $query->like('assignment_name', $search)
                           ->orLike('assignment_description', $search);
        }

        if ($sort) {
            if ($sort == 'name_asc') {
                $query = $query->orderBy('assignment_name', 'ASC');
            } elseif ($sort == 'name_desc') {
                $query = $query->orderBy('assignment_name', 'DESC');
            } elseif ($sort == 'id_asc') {
                $query = $query->orderBy('assignment_id', 'ASC');
            } elseif ($sort == 'id_desc') {
                $query = $query->orderBy('assignment_id', 'DESC');
            }
        }

        $assignmentsPerPage = 10;
        $assignments = $query->paginate($assignmentsPerPage, 'default', $page);

        return $this->response->setJSON([
            'assignments' => $assignments,
            'pagination' => [
                'currentPage' => $page,
                'totalPages' => ceil($assignmentModel->countAllResults() / $assignmentsPerPage)
            ]
        ]);
    }

    public function edit($id)
    {
        $assignmentModel = new AssignmentModel();
        $assignment = $assignmentModel->find($id);

        if ($assignment) {
            return $this->response->setJSON([
                'assignment' => $assignment
            ]);
        } else {
            return $this->response->setJSON([
                'error' => 'assignment not found'
            ], ResponseInterface::HTTP_NOT_FOUND);
        }
    }

    public function update()
    {
        $assignmentModel = new AssignmentModel();
        $data = $this->request->getPost();

        if ($assignmentModel->save($data)) {
            return redirect()->to(base_url('assignments'))->with('success', 'assignment updated successfully');
        } else {
            return redirect()->to(base_url('assignments'))->with('error', 'Failed to update assignment');
        }
    }



    public function delete($id)
    {
        $assignmentModel = new AssignmentModel();
        
        if ($assignmentModel->delete($id)) {
            return redirect()->to('/assignments')->with('success', 'assignment deleted successfully.');
        } else {
            return redirect()->back()->with('errors', 'Failed to delete assignment.');
        }
    }

    
    public function createQuestion()
    {
        $assignmentModel = new AssignmentModel();
        
        $data = [
            'assignment_id' => $this->request->getPost('assignment_id'),
            'question_text' => $this->request->getPost('question_text'),
            'option_a' => $this->request->getPost('option_a'),
            'option_b' => $this->request->getPost('option_b'),
            'option_c' => $this->request->getPost('option_c'),
            'option_d' => $this->request->getPost('option_d'),
            'correct_option' => $this->request->getPost('correct_option'),
            'explanation' => $this->request->getPost('explanation'),
        ];

        if ($assignmentModel->save($data)) {
            return redirect()->to('/questions')->with('success', 'Question created successfully.');
        } else {
            return redirect()->back()->with('errors', $assignmentModel->errors());
        }
    }


    public function assignassignments()
    {
        // Get the selected course ID and assignment IDs from the request
        $courseId = $this->request->getPost('course_id');
        $selectedassignments = $this->request->getPost('assignments');
    
        // Validate the course ID and assignment IDs
        if (empty($courseId) || empty($selectedassignments)) {
            return redirect()->back()->withInput()->with('errors', 'Course ID or assignments are missing')->with('message_type', 'error');
        }
    
        // Load models
        $courseAssignmentModel = new CourseAssignmentModel();
        $assignmentModel = new AssignmentModel();
    
        // Validate that the course ID exists
        $courseExists = (new CourseModel())->find($courseId);
        if (!$courseExists) {
            return redirect()->back()->withInput()->with('errors', 'Invalid course ID')->with('message_type', 'error');
        }
    
        // Validate each assignment ID
        foreach ($selectedassignments as $assignmentId) {
            $assignmentExists = $assignmentModel->find($assignmentId);
            if (!$assignmentExists) {
                return redirect()->back()->withInput()->with('errors', 'Invalid assignment ID: ' . $assignmentId)->with('message_type', 'error');
            }
        }
    
        // Insert each assignment-course relationship into the course_assignments table
        foreach ($selectedassignments as $assignmentId) {
            $courseAssignmentModel->insert([
                'course_id' => $courseId,
                'assignment_id' => $assignmentId
            ]);
        }
    
        $successMessage = "The assignments have been assigned to the course successfully";
        return redirect()->to('/assignments')
            ->with('success', $successMessage)
            ->with('message_type', 'success')
            ->with('message', $successMessage);
    }
    



    public function getAssignmentsForCourse($courseId)
{
    $assignmentModel = new AssignmentModel();
    $courseAssignmentModel = new CourseAssignmentModel();

    // Fetch assigned assignments for the course
    $assignedAssignmentIds = $courseAssignmentModel->where('course_id', $courseId)->findAll();
    $assignedAssignments = [];
    foreach ($assignedAssignmentIds as $entry) {
        $assignment = $assignmentModel->find($entry['assignment_id']);
        if ($assignment) {
            $assignedAssignments[] = $assignment;
        }
    }

    // Fetch all assignments
    $allAssignments = $assignmentModel->findAll();

    return $this->response->setJSON([
        'assignedAssignments' => $assignedAssignments,
        'allAssignments' => $allAssignments
    ]);
}

    

    public function addAssignments()
    {
        $courseId = $this->request->getPost('course_id');
        $selectedassignments = $this->request->getPost('assignments');

        foreach ($selectedassignments as $assignmentId) {
            if (!$this->courseAssignmentModel->where('course_id', $courseId)->where('assignment_id', $assignmentId)->first()) {
                $this->courseAssignmentModel->insert([
                    'course_id' => $courseId,
                    'assignment_id' => $assignmentId
                ]);
            }
        }

        return redirect()->to(base_url('assignments/'.$courseId))->with('success', 'assignments added successfully.');
    }

    public function removeassignment($courseId, $assignmentId)
   {
        // $courseId = $this->request->getPost('course_id');
        // $assignmentId = $this->request->getPost('assignment_id');
    
        log_message('debug', 'Received Course ID: ' . $courseId);
        log_message('debug', 'Received assignment ID: ' . $assignmentId);
    
        if (!is_numeric($courseId) || !is_numeric($assignmentId)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid input.'
            ]);
        }
    
        $deleted = $this->courseAssignmentModel->where('course_id', $courseId)
                                         ->where('assignment_id', $assignmentId)
                                         ->delete();
    
        if ($deleted) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'assignment removed successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to remove assignment.'
            ]);
        }
    
    }

    
    public function exportAssignments()
    {
        $assignmentId = $this->request->getPost('assignment_id');
        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // Build the query with filters
        $query = $this->assignmentModel->select('*');

        if (!empty($assignmentId)) {
            $query = $query->where('assignment_id', $assignmentId);
        }

        if (!empty($startDate) && !empty($endDate)) {
            $query = $query->where('created_at >=', $startDate)
                        ->where('created_at <=', $endDate);
        }

        $assignments = $query->findAll();

        if (empty($assignments)) {
            return $this->response->setJSON(['error' => 'No questions found for the specified criteria']);
        }

        // Load the CSV helper
        helper('csv');

        // Prepare data for CSV
        $csvData = [];
        $csvHeader = [
            'Assignment ID',
            'Assignment Name',
            'Assignment Description',
            'Created At'
        ];

        // Add header row
        $csvData[] = $csvHeader;

        foreach ($assignments as $assignment) {
            $csvData[] = [
                $assignment['assignment_id'],
                $assignment['assignment_name'],
                $assignment['assignment_description'],
                $assignment['created_at'],
            ];
        }

        // Create CSV file and force download
        $filename = 'assignments_export_' . date('YmdHis') . '.csv'; // Add a timestamp to filename
        $csvContent = csv_from_array($csvData);

        return $this->response
                    ->setHeader('Content-Type', 'text/csv')
                    ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                    ->setBody($csvContent);
    }



    
}
