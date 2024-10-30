<?php namespace App\Models;

use CodeIgniter\Model;

class CourseEnrollmentModel extends Model
{
    protected $table      = 'course_enrollments';
    protected $primaryKey = 'enrollment_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'user_id',
        'course_id',
        'enrollment_date',
        'price',
        'status',
        'payment_reference',
        'payment_status',
        'progress',
        'completion_date',
        'refund_requested',
        'refund_processed',
        'coupon_code',
        'payment_method'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Optional: Define validation rules
    protected $validationRules = [
        // 'user_id'            => 'required|integer',
        // 'course_id'          => 'required|integer',
        // 'enrollment_date'    => 'required|valid_date',
        // 'price'              => 'required|decimal',
        // 'status'             => 'required|string',
        // 'payment_reference'  => 'permit_empty|string',
        // 'payment_status'     => 'required|string',
        // 'progress'           => 'permit_empty|integer',
        // 'completion_date'    => 'permit_empty|valid_date',
        // 'refund_requested'   => 'permit_empty|boolean',
        // 'refund_processed'   => 'permit_empty|boolean',
        // 'coupon_code'        => 'permit_empty|string',
        // 'payment_method'     => 'permit_empty|string'
    ];

    protected $validationMessages = [];
    protected $skipValidation     = false;

    // Optional: Define custom methods for specific queries
    public function getEnrollmentsByUser($user_id)
    {
        return $this->where('user_id', $user_id)->findAll();
    }

    public function getUserEnrollments($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    public function getEnrollmentByCourse($course_id)
    {
        return $this->where('course_id', $course_id)->findAll();
    }

    public function updateEnrollmentStatus($enrollment_id, $status)
    {
        return $this->update($enrollment_id, ['status' => $status]);
    }


    public function getEnrollmentsWithCourseDetails($user_id)
    {
        return $this->select('course_enrollments.*, courses.course_title, courses.course_image')
                    ->join('courses', 'courses.course_id = course_enrollments.course_id')
                    ->where('course_enrollments.user_id', $user_id)
                    ->findAll();
    }


    public function getEnrollmentWithCourseDetails($user_id, $course_id)
{
    return $this->select('course_enrollments.*, courses.*, assignments.assignment_name, assignments.assignment_description, materials.material_name, materials.material_description, quizzes.quiz_name, quizzes.quiz_description')
                ->join('courses', 'courses.course_id = course_enrollments.course_id')
                ->join('course_assignments', 'course_assignments.course_id = courses.course_id', 'left') // Left join for assignments
                ->join('assignments', 'assignments.assignment_id = course_assignments.assignment_id', 'left') // Left join for assignment details
                ->join('course_materials', 'course_materials.course_id = courses.course_id', 'left') // Left join for course materials
                ->join('materials', 'materials.material_id = course_materials.material_id', 'left') // Left join to get material details
                ->join('course_quizzes', 'course_quizzes.course_id = courses.course_id', 'left') // Left join for quizzes
                ->join('quizzes', 'quizzes.quiz_id = course_quizzes.quiz_id', 'left') // Left join for quiz details
                ->where('course_enrollments.user_id', $user_id)
                ->where('course_enrollments.course_id', $course_id)
                ->findAll(); // Find all records as there may be multiple assignments, materials, and quizzes
}

    
    

    // Method to count assignments for a specific course
    public function countAssignmentsByCourse($courseId)
    {
        return $this->db->table('course_assignments')
                        ->where('course_id', $courseId)
                        ->countAllResults();
    }

    // Method to count materials for a specific course
    public function countMaterialsByCourse($courseId)
    {
        return $this->db->table('course_materials')
                        ->where('course_id', $courseId)
                        ->countAllResults();
    }

    // Method to count quizzes for a specific course
    public function countQuizzesByCourse($courseId)
    {
        return $this->db->table('course_quizzes')
                        ->where('course_id', $courseId)
                        ->countAllResults();
    }
    // Method to count modules for a specific course
    public function countModulesByCourse($courseId)
    {
        return $this->db->table('modules')
                        ->where('course_id', $courseId)
                        ->countAllResults();
    }

 

    // Model method in CourseEnrollmentModel
public function getQuestionsByQuizId($quizId)
{
    return $this->db->table('questions')
                    ->select('questions.*, questions.correct_option') // Ensure correct_answer is selected
                    ->where('questions.quiz_id', $quizId)
                    ->get()
                    ->getResultArray();
}



   

    public function getAssignmentsByCourses($courseIds)
    {
        if (empty($courseIds)) {
            return [];
        }

        return $this->db->table('assignments')
                        ->select('assignments.*, course_assignments.course_id')
                        ->join('course_assignments', 'course_assignments.assignment_id = assignments.assignment_id')
                        ->whereIn('course_assignments.course_id', $courseIds)
                        ->get()
                        ->getResultArray();
    }


    public function getAssignmentDetails($assignmentId, $userId)
    {
        return $this->db->table('assignments')
                        ->select('assignments.*, courses.course_title, courses.course_id')
                        ->join('course_assignments', 'course_assignments.assignment_id = assignments.assignment_id')
                        ->join('courses', 'courses.course_id = course_assignments.course_id')
                        ->join('course_enrollments', 'course_enrollments.course_id = courses.course_id')
                        ->where('assignments.assignment_id', $assignmentId)
                        ->where('course_enrollments.user_id', $userId)
                        ->get()
                        ->getRowArray();
    }



    public function getQuizzesByCourses($courseIds, $userId)
{
    if (empty($courseIds)) {
        return [];
    }

    return $this->db->table('quizzes')
                    ->select('quizzes.*, course_quizzes.course_id, courses.course_title, courses.course_descriptions')
                    ->selectMax('quiz_attempts.score', 'highest_score') // Retrieve the highest score for the quiz attempts
                    ->select('quiz_attempts.attempt_date as last_attempt_date')
                    ->selectCount('quiz_attempts.attempt_id', 'attempt_count') // Count the attempts for each quiz
                    ->join('course_quizzes', 'course_quizzes.quiz_id = quizzes.quiz_id')
                    ->join('courses', 'courses.course_id = course_quizzes.course_id')
                    ->join('quiz_attempts', 'quiz_attempts.quiz_id = quizzes.quiz_id AND quiz_attempts.user_id = ' . $userId, 'left')
                    ->whereIn('course_quizzes.course_id', $courseIds)
                    ->where('quizzes.published', 1) // Only fetch published quizzes
                    ->where('quizzes.is_active', 1) // Only fetch active quizzes
                    ->groupBy('quizzes.quiz_id') // Group by quiz ID to avoid duplicate entries
                    ->get()
                    ->getResultArray();
}




    public function getQuizDetails($quizId, $userId)
    {
        return $this->db->table('quizzes')
                        ->select('quizzes.*, courses.course_title, courses.course_id')
                        ->join('course_quizzes', 'course_quizzes.quiz_id = quizzes.quiz_id')
                        ->join('courses', 'courses.course_id = course_quizzes.course_id')
                        ->join('course_enrollments', 'course_enrollments.course_id = courses.course_id')
                        ->where('quizzes.quiz_id', $quizId)
                        ->where('course_enrollments.user_id', $userId)
                        ->get()
                        ->getRowArray();
    }


    // Method to mark the course as completed
    public function markCourseAsCompleted($userId, $courseId)
    {
        $data = [
            'status' => 'completed',
            'completion_date' => date('Y-m-d H:i:s'),
            'progress' => 100
        ];

        $this->where('user_id', $userId)
            ->where('course_id', $courseId)
            ->set($data)
            ->update();
    }



    public function getQuizAttemptDetails($quizId, $userId)
    {
        return $this->db->table('quiz_attempts')
            ->where('quiz_id', $quizId)
            ->where('user_id', $userId)
            ->get()->getRowArray(); // Fetch single record
    }




}