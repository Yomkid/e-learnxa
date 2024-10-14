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
        'category_image'
    ];

    public function getAllCategories()
    {
        return $this->findAll(); // This will return all categories
    }
//     public function getAllCategories()
// {
//     return $this->select('category_id, category_name, slug') // Ensure 'slug' is included
//         ->findAll();
// }

// public function getCoursesByCategory($categoryId)
// {
//     // Use the query builder to fetch related courses
//     return $this->db->table('courses')
//         ->join('course_topics', 'course_topics.course_id = courses.course_id')
//         ->join('topic_categories', 'topic_categories.topic_id = course_topics.topic_id')
//         ->where('topic_categories.category_id', $categoryId)
//         ->get()->getResult(); // Fetch the results
// }

// public function getCoursesByCategory($categoryId)
// {
//     // Use the query builder to fetch related courses
//     return $this->db->table('courses')
//         ->select('courses.*, instructors.first_name as instructor_name') // Assuming you have instructors table
//         ->join('course_topics', 'course_topics.course_id = courses.course_id')
//         ->join('topic_categories', 'topic_categories.topic_id = course_topics.topic_id')
//         ->join('instructors', 'instructors.instructor_id = courses.instructor_id') // Optional if you need instructor data
//         ->where('topic_categories.category_id', $categoryId)
//         ->get()->getResult(); // This returns an array of objects
// }

// public function getCoursesByCategory($categoryId)
// {
//     // Use the query builder to fetch related courses
//     $query = $this->db->table('courses')
//         ->join('course_topics', 'course_topics.course_id = courses.course_id')
//         ->join('topic_categories', 'topic_categories.topic_id = course_topics.topic_id')
//         ->where('topic_categories.category_id', $categoryId)
//         ->get();

//     // Debugging - Print the query and results
//     echo $this->db->getLastQuery(); // To print the generated SQL query
//     $result = $query->getResult(); // Fetch the results
//     print_r($result); // Print the result set for debugging

//     return $result;
// }


// public function getCoursesByCategory($categoryId)
// {
//     // Explicitly select the relevant columns you need
//     return $this->db->table('courses')
//         ->select('courses.course_id, courses.course_title, courses.course_image, courses.price, courses.rating, courses.rating_count, instructors.first_name as instructor_name')
//         ->join('course_topics', 'course_topics.course_id = courses.course_id')
//         ->join('topic_categories', 'topic_categories.topic_id = course_topics.topic_id')
//         ->join('instructors', 'instructors.instructor_id = courses.instructor_id', 'left') // Assuming there's an instructors table
//         ->where('topic_categories.category_id', $categoryId)
//         ->get()->getResult();
// }

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
