<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table            = 'courses';
    protected $primaryKey       = 'course_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'course_title',
        'slug',
        'course_tagline',	
        'course_overview',	
        'course_aquiring_skills',	
        'course_compact',	
        'course_requirements',	
        'course_descriptions',	
        'course_image',	
        'rating',	
        'rating_count',	
        'instructor_id',	
        'price',	
        'duration',	
        'language',	
        'enrollment_count',	
        'uploaded_date',	
        'modules',	
        'features',	
        'created_at',	
        'updated_at',	
        'topic_id'
    ];

    public function getCourses()
    {
        return $this->findAll();
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
    protected $validationRules      = [
        // 'title' => 'required',
        // 'description' => 'required',
        // 'rating' => 'required|decimal',
        // 'rating_count' => 'required|integer',
        // 'instructor_id' => 'required|integer',
        // 'price' => 'required|decimal',
        // 'duration' => 'required',
        // 'language' => 'required',
        // 'enrollment_count' => 'required|integer',
        // 'uploaded_date' => 'required|valid_date',
        // 'requirements' => 'required',
        // 'skills_acquired' => 'required',
        // 'course_image' => 'uploaded[course_image]|max_size[course_image,1024]|is_image[course_image]',
        // 'modules' => 'required',
        // 'features' => 'required',
        // 'compact_content' => 'required',
        // 'detailed_content' => 'required',
        // 'topic_id' => 'required|integer',
    ];
    protected $validationMessages   = [
        // 'title' => [
        //     'required' => 'Course title is required',
        // ],
        // 'description' => [
        //     'required' => 'Course description is required',
        // ],
        // Add more custom validation messages as needed
    ];
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
