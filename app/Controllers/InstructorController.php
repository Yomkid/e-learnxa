<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CategoryModel;


class InstructorController extends BaseController
{

    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }
    public function index()
    {
        //
    }

    public function viewCoursesByInstructor($instructorId)
{
    $courses = $this->categoryModel->getCoursesByInstructor($instructorId);

    // Prepare data to pass to the view
    $data = [
        'courses' => $courses,
    ];

    // Load the view and pass the data
    return view('courses_by_instructor', $data);
}

}
