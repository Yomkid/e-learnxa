<?php

namespace App\Models;

use CodeIgniter\Model;

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    protected $table = 'activities'; // The table name
    protected $allowedFields = ['user_id', 'activity_type', 'ip_address', 'user_agent', 'details', 'created_at'];

    public function getRecentActivities($limit)
    {
        return $this->select('user_id, activity_type, details, created_at')
                    ->orderBy('created_at', 'DESC') // Show latest activities first
                    ->findAll($limit);
    }

    public function addActivity($userId, $activityType, $details)
    {
        return $this->insert([
            'user_id' => $userId,
            'activity_type' => $activityType,
            'details' => $details,
            'created_at' => date('Y-m-d H:i:s')
        ]);
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
