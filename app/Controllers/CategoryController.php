<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function getAllCategories()
    {
        $categories = $this->categoryModel->getAllCategories();
        return $this->response->setJSON($categories);
    }

    // public function viewCategory($slug)
    // {
    //     // Fetch the category based on the slug
    //     $category = $this->categoryModel->where('slug', $slug)->first();
        
    //     if (!$category) {
    //         return $this->response->setStatusCode(404, 'Category not found');
    //     }

    //     // Return the category data as JSON
    //     return $this->response->setJSON($category);
    // }


    // public function viewCategory($slug)
    // {
    //     // Fetch the category based on the slug
    //     $category = $this->categoryModel->where('slug', $slug)->first();
        
    //     if (!$category) {
    //         return $this->response->setStatusCode(404, 'Category not found');
    //     }
    
    //     // Fetch courses associated with the category
    //     // $courses = $this->categoryModel->getCoursesByCategory($category->category_id); // Ensure this returns objects
    
    //     // Prepare data to pass to the view
    //     $data = [
    //         'category' => $category, // Should be an object
    //         // 'courses' => $courses, // Should be an array of objects
    //     ];
    
    //     // Load the view and pass the data
    //     return view('category', $data); // Pass data as an associative array
    // }
    
    public function viewCategory($slug)
    {
        // Fetch the category based on the slug
        $category = $this->categoryModel->where('slug', $slug)->first();
    
        if (!$category) {
            return $this->response->setStatusCode(404, 'Category not found');
        }
    
        // Debugging - Print category information
        // print_r($category); // Ensure you are getting the correct category
    
        // Fetch courses associated with the category
        $courses = $this->categoryModel->getCoursesByCategory($category['category_id']);
    
        // Prepare data to pass to the view
        $data = [
            'category' => $category,
            'courses' => $courses,
        ];
    
        // Load the view and pass the data
        return view('category', $data);
    }
    


}
