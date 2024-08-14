<?php namespace App\Models;

use CodeIgniter\Model;

class CourseEnrollmentModel extends Model
{
    protected $table      = 'course_enrollments';
    protected $primaryKey = 'enrollment_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'user_id',
        'course_id',
        'enrollment_date',
        'price',
        'status',
        'payment_reference',
        'payment_status',
        'progress',
        'completion_date',
        'refund_requested',
        'refund_processed',
        'coupon_code',
        'payment_method'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Optional: Define validation rules
    protected $validationRules = [
        // 'user_id'            => 'required|integer',
        // 'course_id'          => 'required|integer',
        // 'enrollment_date'    => 'required|valid_date',
        // 'price'              => 'required|decimal',
        // 'status'             => 'required|string',
        // 'payment_reference'  => 'permit_empty|string',
        // 'payment_status'     => 'required|string',
        // 'progress'           => 'permit_empty|integer',
        // 'completion_date'    => 'permit_empty|valid_date',
        // 'refund_requested'   => 'permit_empty|boolean',
        // 'refund_processed'   => 'permit_empty|boolean',
        // 'coupon_code'        => 'permit_empty|string',
        // 'payment_method'     => 'permit_empty|string'
    ];

    protected $validationMessages = [];
    protected $skipValidation     = false;

    // Optional: Define custom methods for specific queries
    public function getEnrollmentsByUser($user_id)
    {
        return $this->where('user_id', $user_id)->findAll();
    }

    public function getEnrollmentByCourse($course_id)
    {
        return $this->where('course_id', $course_id)->findAll();
    }

    public function updateEnrollmentStatus($enrollment_id, $status)
    {
        return $this->update($enrollment_id, ['status' => $status]);
    }
}
