<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Models\VirtualClassModel;
use App\Models\CourseModel;
use App\Models\CourseVirtualClassModel;
use App\Models\TimetableVirtualClassModel;
use App\Models\TimetableModel;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

// use App\Models\CourseQuizModel;


class VirtualClassController extends BaseController
{


    protected $VirtualClassModel;
    protected $courseModel;
    protected $courseVirtualClassModel;
    protected $timetableVirtualClassModel;
    protected $timetableModel;
    // protected $courseQuizModel;

    public function __construct()
    {
        $this->VirtualClassModel = new VirtualClassModel();
        $this->courseModel = new CourseModel();
        $this->courseVirtualClassModel = new CourseVirtualClassModel();
        $this->timetableModel = new TimetableModel();
        $this->timetableVirtualClassModel = new TimetableVirtualClassModel();
        // $this->courseQuizModel = new CourseQuizModel();
        helper('csv'); // Load the CSV helper
    }


    // public function index()
    // {
    //     $VirtualClassModel = new VirtualClassModel();
    //     $courseModel = new CourseModel();
        
    //     $virtualClasses = $VirtualClassModel->findAll();
    //     $courses = $courseModel->findAll();
    
    //     // Corrected return statement with associative array
    //     return view('virtualClasses/index', [
    //         'virtualClasses' => $virtualClasses,
    //         'courses' => $courses
    //     ]);
    // }

    public function index()
    {
        $virtualClasses = $this->VirtualClassModel->findAll();
        $courses = $this->courseModel->findAll();
        $timetables = $this->timetableModel->findAll();

        // If you want to show the list of VirtualClasses for a specific course, you need to handle it accordingly
        // Here we're just returning the basic list for demonstration
        return view('admin/virtualclasses/index', [
            'virtualClasses' => $virtualClasses,
            'courses' => $courses,
            'timtables' => $timetables,
            // For simplicity, these are left out in this context, you would fetch them in the appropriate method
            'assignedVirtualClasses' => [],
            'assignedTimetablesForClass' => [],
            'allVirtualClasses' => $virtualClasses
        ]);
    }

    

    public function create()
    {
        return view('admin/virtualclasses/create');
    }

    public function store()
    {
        $VirtualClassModel = new VirtualClassModel();
        
        $data = [
            'virtualclass_name' => $this->request->getPost('virtualclass_name'),
            'virtualclass_description' => $this->request->getPost('virtualclass_description'),
            'virtualclass_start_date' => $this->request->getPost('virtualclass_start_date'),
            'virtualclass_end_date' => $this->request->getPost('virtualclass_end_date'),
        ];

        if ($VirtualClassModel->save($data)) {
            $successMessage = "The VirtualClass has been added successfully";
            return redirect()->to('/admin/virtualclasses')
                ->with('success', $successMessage)
                ->with('message_type', 'success')
                ->with('message', $successMessage);
            } else {
                return redirect()->back()->with('errors', $VirtualClassModel->errors());
        }
    }

    public function list()
    {
        $VirtualClassModel = new VirtualClassModel();
        $search = $this->request->getGet('search');
        $sort = $this->request->getGet('sort');
        $page = $this->request->getGet('page') ?? 1;

        $query = $VirtualClassModel;

        if ($search) {
            $query = $query->like('virtualclass_name', $search)
                           ->orLike('virtualclass_description', $search);
        }

        if ($sort) {
            if ($sort == 'name_asc') {
                $query = $query->orderBy('virtualclass_name', 'ASC');
            } elseif ($sort == 'name_desc') {
                $query = $query->orderBy('virtualclass_name', 'DESC');
            } elseif ($sort == 'id_asc') {
                $query = $query->orderBy('virtualclass_id', 'ASC');
            } elseif ($sort == 'id_desc') {
                $query = $query->orderBy('virtualclass_id', 'DESC');
            }
        }

        $virtualClassesPerPage = 10;
        $virtualClasses = $query->paginate($virtualClassesPerPage, 'default', $page);

        return $this->response->setJSON([
            'virtualClasses' => $virtualClasses,
            'pagination' => [
                'currentPage' => $page,
                'totalPages' => ceil($VirtualClassModel->countAllResults() / $virtualClassesPerPage)
            ]
        ]);
    }

    public function edit($id)
    {
        $VirtualClassModel = new VirtualClassModel();
        $virtualClass = $VirtualClassModel->find($id);

        if ($virtualClass) {
            return $this->response->setJSON([
                'virtualClass' => $virtualClass
            ]);
        } else {
            return $this->response->setJSON([
                'error' => 'VirtualClass not found'
            ], ResponseInterface::HTTP_NOT_FOUND);
        }
    }

    public function update()
    {
        $VirtualClassModel = new VirtualClassModel();
        $data = $this->request->getPost();

        if ($VirtualClassModel->save($data)) {
            return redirect()->to(base_url('virtualClasses'))->with('success', 'VirtualClass updated successfully');
        } else {
            return redirect()->to(base_url('virtualClasses'))->with('error', 'Failed to update VirtualClass');
        }
    }



    public function delete($id)
    {
        $VirtualClassModel = new VirtualClassModel();
        
        if ($VirtualClassModel->delete($id)) {
            return redirect()->to('/admin/virtualclasses')->with('success', 'VirtualClass deleted successfully.');
        } else {
            return redirect()->back()->with('errors', 'Failed to delete VirtualClass');
        }
    }

    
  
    // Assign Courses for Virtual Classes
    public function assignCoursesForVirtualClass()
    {
        // Get the selected course ID and Timetable IDs from the request
        $virtualclassId = $this->request->getPost('virtualclass_id');
        $selectedCourses = $this->request->getPost('courses');

        // Validate the Class ID and Course IDs
        if (empty($virtualclassId) || empty($selectedCourses)) {
            return redirect()->back()->withInput()->with('errors', 'Virtual Class ID or Courses are missing')->with('message_type', 'error');
        }

        // Load models
        $courseVirtualClassModel = new CourseVirtualClassModel();
        $virtualClassModel = new VirtualClassModel();
        $courseModel = new CourseModel();

        // Validate that the virtual class ID exists
        $virtualclassExists = $virtualClassModel->find($virtualclassId);
        if (!$virtualclassExists) {
            return redirect()->back()->withInput()->with('errors', 'Invalid virtual class ID')->with('message_type', 'error');
        }

        // Validate each Timetable ID
        foreach ($selectedCourses as $courseId) {
            $courseExists = $courseModel->find($courseId);
            if (!$courseExists) {
                return redirect()->back()->withInput()->with('errors', 'Invalid Course ID: ' . $courseId)->with('message_type', 'error');
            }
        }

        // Insert each Course-class relationship into the class_timetables table
        foreach ($selectedCourses as $courseId) {
            $courseVirtualClassModel->insert([
                'virtualclass_id' => $virtualclassId,
                'course_id' => $courseId
            ]);
        }

        $successMessage = "The Courses have been assigned to the Class successfully";
        return redirect()->to('/admin/virtualclasses')
            ->with('success', $successMessage)
            ->with('message_type', 'success')
            ->with('message', $successMessage);
    }
    
    // Get Courses for Virtual Classes
    public function getCoursesForVirtualClass($virtualclassId)
    {
        $courseModel = new CourseModel();
        $courseVirtualClassModel = new CourseVirtualClassModel();

        // Fetch assigned Courses for the Class
        $assignedCoursesIds = $courseVirtualClassModel->where('virtualclass_id', $virtualclassId)->findAll();
        $assignedCourses = [];
        foreach ($assignedCoursesIds as $entry) {
            $course = $courseModel->find($entry['course_id']);
            if ($course) {
                $assignedCourses[] = $course;
            }
        }

        // Fetch all Courses
        $allCourses = $courseModel->findAll();

        return $this->response->setJSON([
            'assignedCourses' => $assignedCourses,
            'allCourses' => $allCourses
        ]);
    }

    // Remove Courses from Class
public function removeCourseFromVirtualClass($virtualClassId, $courseId)
{
    // Initialize the model
    $courseVirtualClassModel = new \App\Models\CourseVirtualClassModel();

    log_message('debug', 'Received Course ID: ' . $courseId);
    log_message('debug', 'Received VirtualClass ID: ' . $virtualClassId);

    if (!is_numeric($courseId) || !is_numeric($virtualClassId)) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Invalid input.'
        ]);
    }

    // Check if the entry exists before attempting to delete
    $entryExists = $courseVirtualClassModel->where('virtualclass_id', $virtualClassId)
                                            ->where('course_id', $courseId)
                                            ->first();
    log_message('debug', 'Entry exists: ' . json_encode($entryExists));

    if (!$entryExists) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Entry does not exist.'
        ]);
    }

    // Attempt to delete the entry
    $deleted = $courseVirtualClassModel->where('virtualclass_id', $virtualClassId)
                                        ->where('course_id', $courseId)
                                        ->delete();
    log_message('debug', 'Deletion result: ' . $deleted);

    if ($deleted) {
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Course removed successfully.'
        ]);
    } else {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to remove course.'
        ]);
    }
}



    
    // Assign Timetable to Class
    public function assignVirtualClassesTimetable()
    {
        // Get the selected course ID and Timetable IDs from the request
        $virtualclassId = $this->request->getPost('virtualclass_id');
        $selectedTimetables = $this->request->getPost('timeTables');

        // Validate the class ID and Timetable IDs
        if (empty($virtualclassId) || empty($selectedTimetables)) {
            return redirect()->back()->withInput()->with('errors', 'Virtual Class ID or Timetables are missing')->with('message_type', 'error');
        }

        // Load models
        $timetableVirtualClassModel = new TimetableVirtualClassModel();
        $virtualClassModel = new VirtualClassModel();
        $timetableModel = new TimetableModel();

        // Validate that the virtual class ID exists
        $virtualclassExists = $virtualClassModel->find($virtualclassId);
        if (!$virtualclassExists) {
            return redirect()->back()->withInput()->with('errors', 'Invalid virtual class ID')->with('message_type', 'error');
        }

        // Validate each Timetable ID
        foreach ($selectedTimetables as $timetableId) {
            $timetableExists = $timetableModel->find($timetableId);
            if (!$timetableExists) {
                return redirect()->back()->withInput()->with('errors', 'Invalid Timetable ID: ' . $timetableId)->with('message_type', 'error');
            }
        }

        // Insert each Timetable-class relationship into the class_timetables table
        foreach ($selectedTimetables as $timetableId) {
            $timetableVirtualClassModel->insert([
                'virtualclass_id' => $virtualclassId,
                'timetable_id' => $timetableId
            ]);
        }

        $successMessage = "The Timetables have been assigned to the Class successfully";
        return redirect()->to('/admin/virtualclasses')
            ->with('success', $successMessage)
            ->with('message_type', 'success')
            ->with('message', $successMessage);
    }

    // Get Timetables for Class
    public function getTimetablesForClass($virtualclassId)
    {
        $timetableModel = new TimetableModel();
        $timetableVirtualClassModel = new TimetableVirtualClassModel();

        // Fetch assigned Timetables for the class
        $assignedTimetableIds = $timetableVirtualClassModel->where('virtualclass_id', $virtualclassId)->findAll();
        $assignedTimetables = [];
        foreach ($assignedTimetableIds as $entry) {
            $timeTable = $timetableModel->find($entry['timetable_id']);
            if ($timeTable) {
                $assignedTimetables[] = $timeTable;
            }
        }

        // Fetch all Timetables
        $allTimetables = $timetableModel->findAll();

        return $this->response->setJSON([
            'assignedTimetables' => $assignedTimetables,
            'allTimetables' => $allTimetables
        ]);
    }


    // Remove Virtual Class
    public function removeVirtualClassTimetable($virtualClassId, $timetableId)
    {
         // $courseId = $this->request->getPost('course_id');
         // $virtualClassId = $this->request->getPost('virtualclass_name');
     
         log_message('debug', 'Received Course ID: ' . $timetableId);
         log_message('debug', 'Received VirtualClass ID: ' . $virtualClassId);
     
         if (!is_numeric($timetableId) || !is_numeric($virtualClassId)) {
             return $this->response->setJSON([
                 'status' => 'error',
                 'message' => 'Invalid input.'
             ]);
         }
     
         $deleted = $this->timetableVirtualClassModel->where('timetable_id', $timetableId)
                                          ->where('virtualclass_id', $virtualClassId)
                                          ->delete();
     
         if ($deleted) {
             return $this->response->setJSON([
                 'status' => 'success',
                 'message' => 'Timetable removed successfully.'
             ]);
         } else {
             return $this->response->setJSON([
                 'status' => 'error',
                 'message' => 'Failed to remove Timetable'
             ]);
         }
     
    }








    

    public function getVirtualClassDetails($id)
    {
        $VirtualClassModel = new VirtualClassModel();
        $virtualClass = $VirtualClassModel->find($id);

        if ($virtualClass) {
            return $this->response->setJSON(['virtualclass' => $virtualClass]);
        } else {
            return $this->response->setJSON(['error' => 'VirtualClass not found'], 404);
        }
    }

    




    public function addVirtualClasses()
    {
        $courseId = $this->request->getPost('course_id');
        $selectedVirtualClasses = $this->request->getPost('virtualClasses');

        foreach ($selectedVirtualClasses as $virtualClassId) {
            if (!$this->courseVirtualClassModel->where('course_id', $courseId)->where('virtualclass_name', $virtualClassId)->first()) {
                $this->courseVirtualClassModel->insert([
                    'course_id' => $courseId,
                    'virtualclass_name' => $virtualClassId
                ]);
            }
        }

        return redirect()->to(base_url('virtualClasses/'.$courseId))->with('success', 'virtualClasses added successfully.');
    }

   

    public function exportVirtualClasses()
    {
        $virtualClassId = $this->request->getPost('virtualclass_name');
        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // Build the query with filters
        $query = $this->VirtualClassModel->select('*');

        if (!empty($virtualClassId)) {
            $query = $query->where('virtualclass_name', $virtualClassId);
        }

        if (!empty($startDate) && !empty($endDate)) {
            $query = $query->where('created_at >=', $startDate)
                        ->where('created_at <=', $endDate);
        }

        $virtualClasses = $query->findAll();

        if (empty($virtualClasses)) {
            return $this->response->setJSON(['error' => 'No questions found for the specified criteria']);
        }

        // Load the CSV helper
        helper('csv');

        // Prepare data for CSV
        $csvData = [];
        $csvHeader = [
            'VirtualClass ID',
            'VirtualClass Name',
            'VirtualClass Description',
            'Created At'
        ];

        // Add header row
        $csvData[] = $csvHeader;

        foreach ($virtualClasses as $virtualClass) {
            $csvData[] = [
                $virtualClass['virtualclass_name'],
                $virtualClass['virtualclass_name'],
                $virtualClass['virtualClass_description'],
                $virtualClass['created_at'],
            ];
        }

        // Create CSV file and force download
        $filename = 'virtualClasses_export_' . date('YmdHis') . '.csv'; // Add a timestamp to filename
        $csvContent = csv_from_array($csvData);

        return $this->response
                    ->setHeader('Content-Type', 'text/csv')
                    ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                    ->setBody($csvContent);
    }



    
}
