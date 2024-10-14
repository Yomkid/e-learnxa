<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'category_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'category_name',
        'category_description',
        'category_image',
        'slug'
    ];

    public function getAllCategories()
    {
        return $this->findAll(); // This will return all categories
    }


public function getCoursesByCategory($categoryId)
{
    return $this->db->table('courses')
        ->distinct() // Ensure unique results
        ->select('courses.course_id, courses.course_title, courses.course_image, courses.price, courses.rating, courses.rating_count, courses.slug, instructors.first_name as instructor_name')
        ->join('course_topics', 'course_topics.course_id = courses.course_id')
        ->join('topic_categories', 'topic_categories.topic_id = course_topics.topic_id') // Join with topic_categories
        ->join('instructors', 'instructors.instructor_id = courses.instructor_id', 'left') // Assuming there's an instructors table
        ->where('topic_categories.category_id', $categoryId) // Filter on topic_categories
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
