<?php

namespace App\Models;

use CodeIgniter\Model;

class InstructorModel extends Model
{
    protected $table            = 'instructors';
    protected $primaryKey       = 'instructor_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];


    public function getCoursesByInstructor($instructorId)
{
    return $this->db->table('courses')
        ->distinct() // Ensure unique results
        ->select('courses.course_id, courses.course_title, courses.course_image, courses.price, courses.rating, courses.rating_count, instructors.first_name as instructor_name')
        ->join('instructors', 'instructors.instructor_id = courses.instructor_id') // Join with instructors
        ->where('courses.instructor_id', $instructorId) // Filter on instructor
        ->get()->getResult();
}


    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
