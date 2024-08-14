<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TimetableModel;
use App\Models\CourseModel;
use App\Models\CourseTimetableModel;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

// use App\Models\CourseQuizModel;


class TimetableController extends BaseController
{


    protected $timetableModel;
    protected $courseModel;
    protected $courseTimetableModel;
    // protected $courseQuizModel;

    public function __construct()
    {
        $this->timetableModel = new TimetableModel();
        $this->courseModel = new CourseModel();
        $this->courseTimetableModel = new CourseTimetableModel();
        // $this->courseQuizModel = new CourseQuizModel();
        helper('csv'); // Load the CSV helper
    }


    // public function index()
    // {
    //     $timetableModel = new TimetableModel();
    //     $courseModel = new CourseModel();
        
    //     $timetables = $timetableModel->findAll();
    //     $courses = $courseModel->findAll();
    
    //     // Corrected return statement with associative array
    //     return view('timetables/index', [
    //         'timetables' => $timetables,
    //         'courses' => $courses
    //     ]);
    // }

    public function index()
{
    $timetables = $this->timetableModel->findAll();
    $courses = $this->courseModel->findAll();

    // If you want to show the list of Timetables for a specific course, you need to handle it accordingly
    // Here we're just returning the basic list for demonstration
    return view('timetables/index', [
        'timetables' => $timetables,
        'courses' => $courses,
        // For simplicity, these are left out in this context, you would fetch them in the appropriate method
        'assignedtimetables' => [],
        'alltimetables' => $timetables
    ]);
}

    

    public function create()
    {
        return view('timetables/create');
    }

    public function store()
    {
        $timetableModel = new TimetableModel();
        
        $data = [
            'timetable_name' => $this->request->getPost('timetable_name'),
            'timetable_description' => $this->request->getPost('timetable_description'),
            'timetable_url' => $this->request->getPost('timetable_url'),
        ];

        if ($timetableModel->save($data)) {
            $successMessage = "The Timetable has been added successfully";
            return redirect()->to('/timetables')
                ->with('success', $successMessage)
                ->with('message_type', 'success')
                ->with('message', $successMessage);
            } else {
                return redirect()->back()->with('errors', $timetableModel->errors());
        }
    }

    public function list()
    {
        $timetableModel = new TimetableModel();
        $search = $this->request->getGet('search');
        $sort = $this->request->getGet('sort');
        $page = $this->request->getGet('page') ?? 1;

        $query = $timetableModel;

        if ($search) {
            $query = $query->like('timetable_name', $search)
                           ->orLike('timetable_description', $search);
        }

        if ($sort) {
            if ($sort == 'name_asc') {
                $query = $query->orderBy('timetable_name', 'ASC');
            } elseif ($sort == 'name_desc') {
                $query = $query->orderBy('timetable_name', 'DESC');
            } elseif ($sort == 'id_asc') {
                $query = $query->orderBy('timetable_id', 'ASC');
            } elseif ($sort == 'id_desc') {
                $query = $query->orderBy('timetable_id', 'DESC');
            }
        }

        $timetablesPerPage = 10;
        $timetables = $query->paginate($timetablesPerPage, 'default', $page);

        return $this->response->setJSON([
            'timetables' => $timetables,
            'pagination' => [
                'currentPage' => $page,
                'totalPages' => ceil($timetableModel->countAllResults() / $timetablesPerPage)
            ]
        ]);
    }

    public function edit($id)
    {
        $timetableModel = new TimetableModel();
        $timetable = $timetableModel->find($id);

        if ($timetable) {
            return $this->response->setJSON([
                'timetable' => $timetable
            ]);
        } else {
            return $this->response->setJSON([
                'error' => 'timetable not found'
            ], ResponseInterface::HTTP_NOT_FOUND);
        }
    }

    public function update()
    {
        $timetableModel = new TimetableModel();
        $data = $this->request->getPost();

        if ($timetableModel->save($data)) {
            return redirect()->to(base_url('timetables'))->with('success', 'timetable updated successfully');
        } else {
            return redirect()->to(base_url('timetables'))->with('error', 'Failed to update timetable');
        }
    }



    public function delete($id)
    {
        $timetableModel = new TimetableModel();
        
        if ($timetableModel->delete($id)) {
            return redirect()->to('/timetables')->with('success', 'timetable deleted successfully.');
        } else {
            return redirect()->back()->with('errors', 'Failed to delete timetable');
        }
    }

    
  

    public function assignTimetables()
    {
        // Get the selected course ID and Timetable IDs from the request
        $courseId = $this->request->getPost('course_id');
        $selectedtimetables = $this->request->getPost('timetables');
    
        // Validate the course ID and Timetable IDs
        if (empty($courseId) || empty($selectedtimetables)) {
            return redirect()->back()->withInput()->with('errors', 'Course ID or Timetables are missing')->with('message_type', 'error');
        }
    
        // Load models
        $courseTimetableModel = new CourseTimetableModel();
        $timetableModel = new TimetableModel();
    
        // Validate that the course ID exists
        $courseExists = (new CourseModel())->find($courseId);
        if (!$courseExists) {
            return redirect()->back()->withInput()->with('errors', 'Invalid course ID')->with('message_type', 'error');
        }
    
        // Validate each Timetable ID
        foreach ($selectedtimetables as $timetableId) {
            $timetableExists = $timetableModel->find($timetableId);
            if (!$timetableExists) {
                return redirect()->back()->withInput()->with('errors', 'Invalid Timetable ID: ' . $timetableId)->with('message_type', 'error');
            }
        }
    
        // Insert each Timetable-course relationship into the course _timetables table
        foreach ($selectedtimetables as $timetableId) {
            $courseTimetableModel->insert([
                'course_id' => $courseId,
                'timetable_id' => $timetableId
            ]);
        }
    
        $successMessage = "The Timetables have been assigned to the course successfully";
        return redirect()->to('/timetables')
            ->with('success', $successMessage)
            ->with('message_type', 'success')
            ->with('message', $successMessage);
    }
    



    public function getTimetablesForCourse($courseId)
{
    $timetableModel = new TimetableModel();
    $courseTimetableModel = new CourseTimetableModel();

    // Fetch assigned Timetables for the course
    $assignedtimetableIds = $courseTimetableModel->where('course_id', $courseId)->findAll();
    $assignedtimetables = [];
    foreach ($assignedtimetableIds as $entry) {
        $timetable = $timetableModel->find($entry['timetable_id']);
        if ($timetable) {
            $assignedtimetables[] = $timetable;
        }
    }

    // Fetch all Timetables
    $alltimetables = $timetableModel->findAll();

    return $this->response->setJSON([
        'assignedtimetables' => $assignedtimetables,
        'alltimetables' => $alltimetables
    ]);
}



    public function getTimetableDetails($id)
    {
        $timetableModel = new TimetableModel();
        $timetable = $timetableModel->find($id);

        if ($timetable) {
            return $this->response->setJSON(['timetable' => $timetable]);
        } else {
            return $this->response->setJSON(['error' => 'Timetable not found'], 404);
        }
    }

    

    public function addtimetables()
    {
        $courseId = $this->request->getPost('course_id');
        $selectedtimetables = $this->request->getPost('timetables');

        foreach ($selectedtimetables as $timetableId) {
            if (!$this->courseTimetableModel->where('course_id', $courseId)->where('timetable_id', $timetableId)->first()) {
                $this->courseTimetableModel->insert([
                    'course_id' => $courseId,
                    'timetable_id' => $timetableId
                ]);
            }
        }

        return redirect()->to(base_url('timetables/'.$courseId))->with('success', 'timetables added successfully.');
    }

    public function removeTimetable($courseId, $timetableId)
   {
        // $courseId = $this->request->getPost('course_id');
        // $timetableId = $this->request->getPost('timetable_id');
    
        log_message('debug', 'Received Course ID: ' . $courseId);
        log_message('debug', 'Received Timetable ID: ' . $timetableId);
    
        if (!is_numeric($courseId) || !is_numeric($timetableId)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid input.'
            ]);
        }
    
        $deleted = $this->courseTimetableModel->where('course_id', $courseId)
                                         ->where('timetable_id', $timetableId)
                                         ->delete();
    
        if ($deleted) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'timetable removed successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to remove timetable'
            ]);
        }
    
    }

    
    public function exportTimetables()
    {
        $timetableId = $this->request->getPost('timetable_id');
        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // Build the query with filters
        $query = $this->timetableModel->select('*');

        if (!empty($timetableId)) {
            $query = $query->where('timetable_id', $timetableId);
        }

        if (!empty($startDate) && !empty($endDate)) {
            $query = $query->where('created_at >=', $startDate)
                        ->where('created_at <=', $endDate);
        }

        $timetables = $query->findAll();

        if (empty($timetables)) {
            return $this->response->setJSON(['error' => 'No questions found for the specified criteria']);
        }

        // Load the CSV helper
        helper('csv');

        // Prepare data for CSV
        $csvData = [];
        $csvHeader = [
            'timetable ID',
            'timetable Name',
            'timetable Description',
            'Created At'
        ];

        // Add header row
        $csvData[] = $csvHeader;

        foreach ($timetables as $timetable) {
            $csvData[] = [
                $timetable['timetable_id'],
                $timetable['timetable_name'],
                $timetable['timetable_description'],
                $timetable['created_at'],
            ];
        }

        // Create CSV file and force download
        $filename = 'timetables_export_' . date('YmdHis') . '.csv'; // Add a timestamp to filename
        $csvContent = csv_from_array($csvData);

        return $this->response
                    ->setHeader('Content-Type', 'text/csv')
                    ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                    ->setBody($csvContent);
    }



    
}
