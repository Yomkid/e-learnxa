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



    // Method to fetch courses along with category and topic
    // public function getCoursesWithCategoryAndTopic()
    // {
    //     return $this->select('courses.*, topics.topic_name, categories.category_name, categories.category_description, categories.category_image')
    //         ->join('topics', 'topics.topic_id = courses.topic_id')
    //         ->join('categories', 'categories.category_id = topics.category_id')
    //         ->findAll();
    // }

    // public function getCoursesWithCategories()
    // {
    //     return $this->select('courses.*, topics.topic_name, categories.category_name, categories.category_description, categories.category_image')
    //         ->join('course_topics', 'course_topics.course_id = courses.course_id')
    //         ->join('topics', 'topics.topic_id = course_topics.topic_id')
    //         ->join('topic_categories', 'topic_categories.topic_id = topics.topic_id')
    //         ->join('categories', 'categories.category_id = topic_categories.category_id')
    //         ->findAll();
    // }


    // public function getCoursesWithCategories()
    // {
    //     return $this->select('courses.course_id, courses.course_title, courses.course_image, courses.price, courses.rating, courses.rating_count, courses.slug, instructors.first_name as instructor_name')
    //     ->distinct()
    //     ->join('course_topics', 'course_topics.course_id = courses.course_id')
    //     ->join('topic_categories', 'topic_categories.topic_id = course_topics.topic_id') // Join with topic_categories
    //     ->join('instructors', 'instructors.instructor_id = courses.instructor_id', 'left') // Assuming there's an instructors table
    //     ->where('topic_categories.category_id')
    //     ->findAll();
    // }

    // In CourseModel.php
public function getCoursesByCategory($categoryId)
{
    return $this->select('courses.course_id, courses.course_title, courses.course_image, courses.price, courses.rating, courses.rating_count, courses.slug, instructors.first_name as instructor_name')
        ->distinct()
        ->join('course_topics', 'course_topics.course_id = courses.course_id')
        ->join('topic_categories', 'topic_categories.topic_id = course_topics.topic_id') // Join with topic_categories
        ->join('instructors', 'instructors.instructor_id = courses.instructor_id', 'left') // Assuming there's an instructors table
        ->where('topic_categories.category_id', $categoryId)
        ->findAll();
}



    // public function getCoursesByCategory($categoryId)
    // {
    //     return $this->select('courses.*, instructors.first_name, topics.topic_name, categories.category_name, categories.category_description, categories.category_image') // Use the correct column name
    //         ->join('topics', 'topics.topic_id = course_topics.topic_id')
    //         ->join('categories', 'categories.category_id = topic_categories.category_id')
    //         ->join('course_topics', 'course_topics.course_id = courses.course_id')
    //         ->join('topic_categories', 'topic_categories.topic_id = course_topics.topic_id')
    //         ->join('instructors', 'instructors.instructor_id = courses.instructor_id') // Adjust if necessary
    //         ->where('topic_categories.category_id', $categoryId)
    //         ->findAll();
    // }
    

//     public function getCoursesWithCategories()
// {
//     // Fetch all courses with their associated topics and categories
//     $results = $this->select('courses.*, topics.topic_name, categories.category_id, categories.category_name, categories.category_description, categories.category_image')
//         ->join('course_topics', 'course_topics.course_id = courses.course_id')
//         ->join('topics', 'topics.topic_id = course_topics.topic_id')
//         ->join('topic_categories', 'topic_categories.topic_id = topics.topic_id')
//         ->join('categories', 'categories.category_id = topic_categories.category_id')
//         ->findAll();

//     // Initialize an array to hold the structured data
//     $coursesByCategory = [];

//     // Iterate through the results and group courses by category
//     foreach ($results as $course) {
//         // Get the category ID and name
//         $categoryId = $course['category_id'];
//         $categoryName = $course['category_name'];

//         // Create a category entry if it doesn't exist
//         if (!isset($coursesByCategory[$categoryId])) {
//             $coursesByCategory[$categoryId] = [
//                 'category_name' => $categoryName,
//                 'courses' => []
//             ];
//         }

//         // Append the course to the category's course list
//         $coursesByCategory[$categoryId]['courses'][] = [
//             'course_id' => $course['course_id'],
//             'course_title' => $course['course_title'],
//             'topic_name' => $course['topic_name'],
//             'category_description' => $course['category_description'],
//             'category_image' => $course['category_image'],
//             // Add other course fields as necessary
//         ];
//     }

//     return $coursesByCategory;
// }



// Method to fetch courses with their topics and categories
// public function getCoursesWithCategories()
// {
//     return $this->select('courses.*, topics.topic_name, categories.category_name, categories.category_description, categories.category_image')
//         ->join('course_topics', 'course_topics.course_id = courses.course_id')
//         ->join('topics', 'topics.topic_id = course_topics.topic_id')
//         ->join('topic_categories', 'topic_categories.topic_id = topics.topic_id')
//         ->join('categories', 'categories.category_id = topic_categories.category_id')
//         ->findAll();
// }



public function getCoursesByTopics()
{
    // Fetch courses along with their associated topics
    return $this->select('courses.*, topics.topic_name')
        ->join('course_topics', 'course_topics.course_id = courses.course_id')
        ->join('topics', 'topics.topic_id = course_topics.topic_id')
        ->findAll();
}


public function getCoursesByCategories()
{
    // Fetch courses along with their associated categories
    return $this->select('courses.*, categories.category_name')
        ->join('course_topics', 'course_topics.course_id = courses.course_id')
        ->join('topics', 'topics.topic_id = course_topics.topic_id')
        ->join('topic_categories', 'topic_categories.topic_id = topics.topic_id')
        ->join('categories', 'categories.category_id = topic_categories.category_id')
        ->findAll();
}


public function getCoursesByInstructors()
{
    // Fetch courses along with their associated instructors
    return $this->select('courses.*, instructors.name as instructor_name')
        ->join('course_topics', 'course_topics.course_id = courses.course_id')
        ->join('instructors', 'instructors.id = courses.instructor_id') // Adjust this join based on your instructor table
        ->findAll();
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
