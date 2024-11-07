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




// AssignmentSubmissionModel.php

    public function getSubmittedAssignments($searchTerm, $sortOption)
    {
        // Assuming you have a related 'users' table to join for user names
        $builder = $this->db->table($this->table)
                            ->join('users', 'users.user_id = assignment_submissions.user_id', 'left')
                            ->select('assignment_submissions.*, users.username, assignment_submissions.grade') // Include username and grade
                            ->join('assignments', 'assignments.assignment_id = assignment_submissions.assignment_id', 'left'); // Assuming this relationship exists

        // Filter by search term
        if (!empty($searchTerm)) {
            $builder->like('users.username', $searchTerm);
        }

        // Sorting options
        switch ($sortOption) {
            case 'date_asc':
                $builder->orderBy('submitted_at', 'ASC');
                break;
            case 'date_desc':
                $builder->orderBy('submitted_at', 'DESC');
                break;
            case 'grade_asc':
                $builder->orderBy('assignments.grade', 'ASC'); // Assuming grade is in the assignments table
                break;
            case 'grade_desc':
                $builder->orderBy('assignments.grade', 'DESC');
                break;
            default:
                $builder->orderBy('submitted_at', 'DESC'); // Default sorting
                break;
        }

        // Execute the query and return results
        return $builder->get()->getResultArray();
    }



}
