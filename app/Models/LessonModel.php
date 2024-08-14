<?php

namespace App\Models;

use CodeIgniter\Model;

class LessonModel extends Model
{
    protected $table            = 'lessons';
    protected $primaryKey       = 'lesson_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'module_id', 
        'lesson_title', 
        'lesson_content', 
        'has_video', 
        'video_id', 
        'has_quiz', 
        'quiz_id', 
        'has_assignment', 
        'assignment_id', 
        'has_resource', 
        'resource_id', 
        'duration', 
        'created_at', 
        'updated_at'
    ];

    // public function getLessonsByModule($module_id)
    // {
    //     return $this->where('module_id', $module_id)->findAll();
    // }

    public function getLessonByModuleId($moduleId)
    {
        return $this->where('module_id', $moduleId)->first();
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