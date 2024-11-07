<?php

namespace App\Models;

use CodeIgniter\Model;

class AssignmentSubmissionModel extends Model
{
    protected $table            = 'assignment_submissions';
    protected $primaryKey       = 'submission_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'assignment_id',
        'course_id',
        'user_id',
        'file_path',
        'comments',
        'submitted_at',
        'created_at',
        'updated_at'
    ];

    // Method to fetch submissions based on assignment and user
    public function getSubmissionsByAssignment($assignmentId, $userId)
    {
        return $this->where('assignment_id', $assignmentId)
                    ->where('user_id', $userId)
                    ->get()
                    ->getResultArray();
    }

    // Method to fetch all submissions for an assignment (useful for instructors)
    public function getAllSubmissionsForAssignment($assignmentId)
    {
        return $this->where('assignment_id', $assignmentId)
                    ->get()
                    ->getResultArray();
    }

    // In AssignmentSubmissionModel.php

public function getGrade($assignmentId, $userId)
{
    return $this->where('assignment_id', $assignmentId)
                ->where('user_id', $userId)
                ->select('grade')
                ->first();
}

}
