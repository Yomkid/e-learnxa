<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\CategoryModel;
use App\Models\VirtualClassModel;

class Home extends BaseController
{
    protected $categoryModel;
    protected $VirtualClassModel;
    protected $sharedData;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->VirtualClassModel = new VirtualClassModel();
        
    }


    public function index(): string
    {

        // Load the Course model
        $courseModel = new CourseModel();

        // Fetch all courses from the database
        // $courses = $courseModel->findAll(); // or use a more specific query if necessary
        $courses = $courseModel // or use a more specific query if necessary
        ->orderBy('course_id', 'DESC') // Order by start date in descending order
        ->limit(10) // Limit to 5 records
        ->findAll();

        // $virtualClasses = $this->VirtualClassModel->findAll();
        $virtualClasses = $this->VirtualClassModel
        ->orderBy('virtualclass_start_date', 'DESC') // Order by start date in descending order
        ->limit(10) // Limit to 5 records
        ->findAll();

        $categories = $this->categoryModel
        ->orderBy('category_id', 'DESC')
        ->limit(8)
        ->findAll();



        // Pass the fetched courses and virtual classes to the view as a single array
        return view('welcome_message', [
            'courses' => $courses,
            'virtualClasses' => $virtualClasses,
            'categories' => $categories
        ]);
    }

    // protected $categoryModel;
    // protected $virtualClassModel;
    // protected $courseModel;
    // protected $sharedData;

    // public function __construct()
    // {
    //     $this->courseModel = new CourseModel();
    //     $this->virtualClassModel = new VirtualClassModel();
    
    //     // Fetch and store the data once
    //     $this->sharedData = [
    //         'courses' => $this->courseModel->findAll(),
    //         'virtualClasses' => $this->virtualClassModel->findAll()
    //     ];
    // }
    
    // public function index(): string
    // {
    //     // Use the shared data in multiple views
    //     $view1 = view('view1', $this->sharedData);
    //     $view2 = view('view2', $this->sharedData);
    
    //     // Return the views combined or separately
    //     return $view1 . $view2;
    // }
    

    public function getCoursesWithCategories()
    {
        $courseModel = new CourseModel();
        $courses = $courseModel->getCoursesWithCategoryAndTopic(); // Call the model method
        
        if ($courses) {
            return $this->response->setJSON($courses);
        } else {
            return $this->response->setJSON(['error' => 'No courses found'], 404);
        }
    }

   

    public function getAllCategories()
    {
        $categories = $this->categoryModel->getAllCategories();
        return $this->response->setJSON($categories);
    }


    
    
}