<?php namespace App\Controllers;

use App\Models\CourseEnrollmentModel;

class EnrollmentController extends BaseController
{
    public function indexT()
    {
        
        return view('admin/payment_status/course_enrollment_success');
    }
    public function index()
    {
        $model = new CourseEnrollmentModel();
        $data['enrollments'] = $model->findAll();
        return view('enrollments_view', $data);
    }

    public function create()
    {
        $model = new CourseEnrollmentModel();
        $data = [
            'user_id'            => $this->request->getPost('user_id'),
            'course_id'          => $this->request->getPost('course_id'),
            'enrollment_date'    => date('Y-m-d H:i:s'),
            'price'              => $this->request->getPost('price'),
            'status'             => 'pending',
            'payment_status'     => 'pending',
        ];

        $model->save($data);
        return redirect()->to('admin/payment-gateway');
    }
}
