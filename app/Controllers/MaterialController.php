<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MaterialModel;
use App\Models\CourseModel;
use App\Models\CourseMaterialModel;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

// use App\Models\CourseQuizModel;


class MaterialController extends BaseController
{


    protected $materialModel;
    protected $courseModel;
    protected $courseMaterialModel;

    public function __construct()
    {
        $this->materialModel = new MaterialModel();
        $this->courseModel = new CourseModel();
        $this->courseMaterialModel = new CourseMaterialModel();
        helper('csv'); // Load the CSV helper
    }


   

    public function index()
{
    $materials = $this->materialModel->findAll();
    $courses = $this->courseModel->findAll();

    // If you want to show the list of materials for a specific course, you need to handle it accordingly
    // Here we're just returning the basic list for demonstration
    return view('materials/index', [
        'materials' => $materials,
        'courses' => $courses,
        // For simplicity, these are left out in this context, you would fetch them in the appropriate method
        'assignedmaterials' => [],
        'allmaterials' => $materials
    ]);
}

    

    public function create()
    {
        return view('materials/create');
    }

    public function store()
    {

        // $materialName = $this->request->getPost('material_name');

        // // Handle file upload
        // $materialFile = $this->request->getFile('material_file');
        // if ($materialFile && $materialFile->isValid() && !$materialFile->hasMoved()) {
        //     $sanitizedmaterialName = preg_replace('/[^a-zA-Z0-9-_]/', '_', $materialName);
        //     $newName = $sanitizedmaterialName . '_' . time() . '.' . $materialFile->getExtension();
        //     $materialFile->move(FCPATH . 'uploads', $newName);
        //     $materialFilePath = $newName;
        // } else {
        //     return redirect()->back()->withInput()->with('errors', 'Course Material upload failed')->with('message_type', 'error');
        // }



        
        $data = [
            'material_name' => $this->request->getPost('material_name'),
            'material_description' => $this->request->getPost('material_description'),
            'material_file' => $materialFilePath ?? null,
        ];

        $materialModel = new MaterialModel();


        if ($materialModel->save($data)) {
            return redirect()->to('/materials')->with('success', 'material uploaded successfully.');
        } else {
            return redirect()->back()->with('errors', $materialModel->errors());
        }
    }

    public function list()
    {
        $materialModel = new MaterialModel();
        $search = $this->request->getGet('search');
        $sort = $this->request->getGet('sort');
        $page = $this->request->getGet('page') ?? 1;

        $query = $materialModel;

        if ($search) {
            $query = $query->like('material_name', $search)
                           ->orLike('material_description', $search);
        }

        if ($sort) {
            if ($sort == 'name_asc') {
                $query = $query->orderBy('material_name', 'ASC');
            } elseif ($sort == 'name_desc') {
                $query = $query->orderBy('material_name', 'DESC');
            } elseif ($sort == 'id_asc') {
                $query = $query->orderBy('material_id', 'ASC');
            } elseif ($sort == 'id_desc') {
                $query = $query->orderBy('material_id', 'DESC');
            }
        }

        $materialsPerPage = 10;
        $materials = $query->paginate($materialsPerPage, 'default', $page);

        return $this->response->setJSON([
            'materials' => $materials,
            'pagination' => [
                'currentPage' => $page,
                'totalPages' => ceil($materialModel->countAllResults() / $materialsPerPage)
            ]
        ]);
    }

    public function edit($id)
    {
        $materialModel = new MaterialModel();
        $material = $materialModel->find($id);

        if ($material) {
            return $this->response->setJSON([
                'material' => $material
            ]);
        } else {
            return $this->response->setJSON([
                'error' => 'material not found'
            ], ResponseInterface::HTTP_NOT_FOUND);
        }
    }

    public function update()
    {
        $materialModel = new MaterialModel();
        $data = $this->request->getPost();

        if ($materialModel->save($data)) {
            return redirect()->to(base_url('materials'))->with('success', 'material updated successfully');
        } else {
            return redirect()->to(base_url('materials'))->with('error', 'Failed to update material');
        }
    }



    public function delete($id)
    {
        $materialModel = new MaterialModel();
        
        if ($materialModel->delete($id)) {
            return redirect()->to('/materials')->with('success', 'material deleted successfully.');
        } else {
            return redirect()->back()->with('errors', 'Failed to delete material.');
        }
    }

    
    // public function createQuestion()
    // {
    //     $materialModel = new MaterialModel();
        
    //     $data = [
    //         'material_id' => $this->request->getPost('material_id'),
    //         'question_text' => $this->request->getPost('question_text'),
    //         'option_a' => $this->request->getPost('option_a'),
    //         'option_b' => $this->request->getPost('option_b'),
    //         'option_c' => $this->request->getPost('option_c'),
    //         'option_d' => $this->request->getPost('option_d'),
    //         'correct_option' => $this->request->getPost('correct_option'),
    //         'explanation' => $this->request->getPost('explanation'),
    //     ];

    //     if ($materialModel->save($data)) {
    //         return redirect()->to('/questions')->with('success', 'Question created successfully.');
    //     } else {
    //         return redirect()->back()->with('errors', $materialModel->errors());
    //     }
    // }


    public function assignmaterials()
    {
        // Get the selected course ID and material IDs from the request
        $courseId = $this->request->getPost('course_id');
        $selectedmaterials = $this->request->getPost('materials');
    
        // Validate the course ID and material IDs
        if (empty($courseId) || empty($selectedmaterials)) {
            return redirect()->back()->withInput()->with('errors', 'Course ID or materials are missing')->with('message_type', 'error');
        }
    
        // Load models
        $courseMaterialModel = new CourseMaterialModel();
        $materialModel = new MaterialModel();
    
        // Validate that the course ID exists
        $courseExists = (new CourseModel())->find($courseId);
        if (!$courseExists) {
            return redirect()->back()->withInput()->with('errors', 'Invalid course ID')->with('message_type', 'error');
        }
    
        // Validate each material ID
        foreach ($selectedmaterials as $materialId) {
            $materialExists = $materialModel->find($materialId);
            if (!$materialExists) {
                return redirect()->back()->withInput()->with('errors', 'Invalid material ID: ' . $materialId)->with('message_type', 'error');
            }
        }
    
        // Insert each material-course relationship into the course_materials table
        foreach ($selectedmaterials as $materialId) {
            $courseMaterialModel->insert([
                'course_id' => $courseId,
                'material_id' => $materialId
            ]);
        }
    
        $successMessage = "The materials have been assigned to the course successfully";
        return redirect()->to('/materials')
            ->with('success', $successMessage)
            ->with('message_type', 'success')
            ->with('message', $successMessage);
    }
    



    public function getmaterialsForCourse($courseId)
{
    $materialModel = new MaterialModel();
    $courseMaterialModel = new CourseMaterialModel();

    // Fetch assigned materials for the course
    $assignedmaterialIds = $courseMaterialModel->where('course_id', $courseId)->findAll();
    $assignedmaterials = [];
    foreach ($assignedmaterialIds as $entry) {
        $material = $materialModel->find($entry['material_id']);
        if ($material) {
            $assignedmaterials[] = $material;
        }
    }

    // Fetch all materials
    $allmaterials = $materialModel->findAll();

    return $this->response->setJSON([
        'assignedmaterials' => $assignedmaterials,
        'allmaterials' => $allmaterials
    ]);
}

    

    public function addmaterials()
    {
        $courseId = $this->request->getPost('course_id');
        $selectedmaterials = $this->request->getPost('materials');

        foreach ($selectedmaterials as $materialId) {
            if (!$this->courseMaterialModel->where('course_id', $courseId)->where('material_id', $materialId)->first()) {
                $this->courseMaterialModel->insert([
                    'course_id' => $courseId,
                    'material_id' => $materialId
                ]);
            }
        }

        return redirect()->to(base_url('materials/'.$courseId))->with('success', 'materials added successfully.');
    }

    public function removematerial($courseId, $materialId)
   {
        // $courseId = $this->request->getPost('course_id');
        // $materialId = $this->request->getPost('material_id');
    
        log_message('debug', 'Received Course ID: ' . $courseId);
        log_message('debug', 'Received material ID: ' . $materialId);
    
        if (!is_numeric($courseId) || !is_numeric($materialId)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid input.'
            ]);
        }
    
        $deleted = $this->courseMaterialModel->where('course_id', $courseId)
                                         ->where('material_id', $materialId)
                                         ->delete();
    
        if ($deleted) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'material removed successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to remove material.'
            ]);
        }
    
    }

    
    public function exportmaterials()
    {
        $materialId = $this->request->getPost('material_id');
        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // Build the query with filters
        $query = $this->materialModel->select('*');

        if (!empty($materialId)) {
            $query = $query->where('material_id', $materialId);
        }

        if (!empty($startDate) && !empty($endDate)) {
            $query = $query->where('created_at >=', $startDate)
                        ->where('created_at <=', $endDate);
        }

        $materials = $query->findAll();

        if (empty($materials)) {
            return $this->response->setJSON(['error' => 'No questions found for the specified criteria']);
        }

        // Load the CSV helper
        helper('csv');

        // Prepare data for CSV
        $csvData = [];
        $csvHeader = [
            'material ID',
            'material Name',
            'material Description',
            'material Filename',
            'Created At'
        ];

        // Add header row
        $csvData[] = $csvHeader;

        foreach ($materials as $material) {
            $csvData[] = [
                $material['material_id'],
                $material['material_name'],
                $material['material_description'],
                $material['material_file'],
                $material['created_at'],
            ];
        }

        // Create CSV file and force download
        $filename = 'materials_export_' . date('YmdHis') . '.csv'; // Add a timestamp to filename
        $csvContent = csv_from_array($csvData);

        return $this->response
                    ->setHeader('Content-Type', 'text/csv')
                    ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                    ->setBody($csvContent);
    }



    
}
