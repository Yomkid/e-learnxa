<?php

namespace App\Models;

use CodeIgniter\Model;



class StudentModuleProgressModel extends Model
{
    protected $table            = 'student_module_progress';
    protected $primaryKey       = 'student_module_progress_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 
        'module_id', 
        'course_id', 
        'completed', 
        'completion_date', 
        'progress_percentage'
    ];



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



    // Method to update progress for a module
    public function updateProgress($userId, $moduleId)
    {
        $data = [
            'completed' => 1,
            'completion_date' => date('Y-m-d H:i:s'),
            'progress_percentage' => 100 // Assuming completion means 100%
        ];

        $this->where('user_id', $userId)
             ->where('module_id', $moduleId)
             ->set($data)
             ->update();
    }

    // Method to check if all modules for a course are completed
    public function areAllModulesCompleted($userId, $courseId)
    {
        // Fetch all modules for this course
        $db = \Config\Database::connect();
        $builder = $db->table('modules');
        $builder->select('module_id');
        $builder->where('course_id', $courseId);
        $modules = $builder->get()->getResultArray();

        // Fetch completed modules for this user and course
        $completedModules = $this->where('user_id', $userId)
                                  ->whereIn('module_id', array_column($modules, 'module_id'))
                                  ->where('completed', 1)
                                  ->countAllResults();

        // If the number of completed modules matches the total number of modules, all modules are completed
        return $completedModules === count($modules);
    }
}
