<?php

// In app/Controllers/ModuleController.php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModuleModel;
use App\Models\CourseModel;

class ModuleController extends BaseController
{
    public function index()
    {
        $moduleModel = new ModuleModel();
        $modules = $moduleModel->findAll();

        return view('admin/modules/index', ['modules' => $modules]);
    }

    public function create()
    {
        $courseModel = new CourseModel();
        $courses = $courseModel->findAll();

        return view('admin/modules/create', ['courses' => $courses]);
    }

    public function store()
    {
        $moduleModel = new ModuleModel();
        $data = [
            'course_id' => $this->request->getPost('course_id'),
            'module_name' => $this->request->getPost('module_name'),
            'module_description' => $this->request->getPost('module_description')
        ];
        $moduleModel->save($data);

        return redirect()->to('admin/modules')->with('success', 'Module created successfully');
    }

    public function edit($id)
    {
        $moduleModel = new ModuleModel();
        $courseModel = new CourseModel();
        $module = $moduleModel->find($id);
        $courses = $courseModel->findAll();

        return view('admin/modules/edit', ['module' => $module, 'courses' => $courses]);
    }

    public function update($id)
    {
        $moduleModel = new ModuleModel();
        $data = [
            'course_id' => $this->request->getPost('course_id'),
            'module_name' => $this->request->getPost('module_name'),
            'module_description' => $this->request->getPost('module_description')
        ];
        $moduleModel->update($id, $data);

        return redirect()->to('admin/modules')->with('success', 'Module updated successfully');
    }

    public function delete($id)
    {
        $moduleModel = new ModuleModel();
        $moduleModel->delete($id);

        return redirect()->to('admin/modules')->with('success', 'Module deleted successfully');
    }
}
