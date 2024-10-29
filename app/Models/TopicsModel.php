<?php

namespace App\Models;

use CodeIgniter\Model;

class TopicsModel extends Model
{
    protected $table            = 'topics';
    protected $primaryKey       = 'topic_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'topic_name',
        'category_id'
    ];



    public function getCoursesByTopic($topicId)
    {
        return $this->db->table('courses')
            ->distinct() // Ensure unique results
            ->select('courses.course_id, courses.course_title, courses.course_image, courses.price, courses.rating, courses.rating_count, instructors.first_name as instructor_name')
            ->join('course_topics', 'course_topics.course_id = courses.course_id')
            ->join('topics', 'topics.topic_id = course_topics.topic_id') // Join with topics
            ->join('instructors', 'instructors.instructor_id = courses.instructor_id', 'left') // Join with instructors
            ->where('topics.topic_id', $topicId) // Filter on topic
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
