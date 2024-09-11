<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table = 'visitor_log';
    protected $primaryKey = 'visitor_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['ip_address', 'user_agent', 'session_id', 'visit_date'];

    /**
     * Check if a visitor exists based on IP address, session ID, and visit date.
     */
    public function visitorExists($ip_address, $session_id, $visit_date)
    {
        return $this->where('ip_address', $ip_address)
                    ->where('session_id', $session_id)
                    ->where('visit_date', $visit_date)
                    ->countAllResults() > 0;
    }

    /**
     * Insert a new visitor record.
     */
    public function insertVisitor($data)
    {
        return $this->insert($data);
    }

    /**
     * Get recent visitors.
     */
    public function getRecentVisitors($limit = 10)
    {
        return $this->orderBy('created_at', 'DESC')
                    ->findAll($limit);
    }
}
