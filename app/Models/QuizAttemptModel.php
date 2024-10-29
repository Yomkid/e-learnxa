<?php

namespace App\Models;

use CodeIgniter\Model;

class QuizAttemptModel extends Model
{
    protected $table = 'quiz_attempts';
    protected $primaryKey = 'attempt_id';

    protected $allowedFields = [
        'user_id', 
        'course_id', 
        'quiz_id', 
        'attempt_date', 
        'score', 
        'status', 
        'time_taken', 
        'is_passed', 
        'number_of_attempts', 
        'answers', 
        'created_at', 
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $dateFormat = 'datetime';

    public function saveQuizAttempt($data)
    {
        return $this->save($data);
    }


    public function getQuizAttemptsByUser($userId, $quizId)
    {
        return $this->where('user_id', $userId)
                    ->where('quiz_id', $quizId)
                    ->findAll();
    }

    


    // Add additional methods or logic as needed for querying and updating quiz attempts
}