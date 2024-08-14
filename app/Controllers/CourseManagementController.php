<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\TopicsModel;
use App\Models\TopicCategoryModel;
use CodeIgniter\HTTP\ResponseInterface;

class CourseManagementController extends BaseController
{
    // public function createAndEditTopic()
    // {
    //     $categoryModel = new CategoryModel();
    //     $categories = $categoryModel->findAll();

    //     return view('admin/topic', ['categories' => $categories]);
    // }

    

    public function saveCategory()
    {
        $validation = \Config\Services::validation();
        // Define validation rules
        $validation->setRules([

            'category-name' => [
                'label' => 'Topic Name',
                'rules' => 'required|is_unique[categories.category_name]',
                'errors' => [
                    // 'required' => 'The {field} field is required.',
                    'is_unique' => 'The {field} already exists'
                ]
            ],
            
        ]);

        if (!$this->validate($validation->getRules())) {
            $errors = $validation->getErrors();
            return redirect()->back()->withInput()->with('errors', $errors)->with('message_type', 'error')->with('message', implode('<br>', $errors));
        }

        $data = [
            'category_name' => $this->request->getPost('category-name'),
            'category_description' => $this->request->getPost('category-description'),
            'category_image' => $this->request->getPost('category-image'),
        ];

        $categoryModel = new CategoryModel();
        $inserted = $categoryModel->insert($data);
        $successMessage = 'Saved successfully';


        if (!$inserted) {
            return redirect()->to('/admin/category')->with('error', 'Failed to insert category data.');
        }else{
             // return redirect()->to('/admin/category')->with('success', 'Category saved successfully');
        return redirect()->back()->withInput()
        ->with('success', $successMessage)
        ->with('message_type', 'success')
        ->with('message', $successMessage);
        }        
    }

    public function saveTopic()
    {
        $validation = \Config\Services::validation();
        // Define validation rules
        $validation->setRules([

            'topic-name' => [
                'label' => 'Topic Name',
                'rules' => 'required|is_unique[topics.topic_name]',
                'errors' => [
                    // 'required' => 'The {field} field is required.',
                    'is_unique' => 'The {field} already exists'
                ]
            ],
            
        ]);

        if (!$this->validate($validation->getRules())) {
            $errors = $validation->getErrors();
            return redirect()->back()->withInput()->with('errors', $errors)->with('message_type', 'error')->with('message', implode('<br>', $errors));
        }


        $topicModel = new TopicsModel();
        $topicCategoryModel = new TopicCategoryModel();
        $successMessage = 'Topic saved successfully';

        $data = [
            'topic_name' => $this->request->getPost('topic-name')
        ];

        $topicId = $topicModel->insert($data);

        if ($topicId) {
            $selectedCategories = $this->request->getPost('categories');
            if (!empty($selectedCategories)) {
                foreach ($selectedCategories as $categoryId) {
                    $topicCategoryModel->insert([
                        'topic_id' => $topicId,
                        'category_id' => $categoryId
                    ]);
                }
            }

            return redirect()->back()->withInput()
                ->with('success', $successMessage)
                ->with('message_type', 'success')
                ->with('message', $successMessage);
        // } else {
        //     $errors = $topicModel->errors();
        //     return redirect()->back()->withInput()
        //         ->with('errors', $errors)
        //         ->with('message_type', 'error')
        //         ->with('message', implode('<br>', $errors));
        } else {
            return redirect()->back()->with('error', 'Failed to add Topic.');
        }
    }
}
