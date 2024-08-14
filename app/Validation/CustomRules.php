<?php
namespace App\Validation;

use App\Models\AdminModel;
use App\Models\Users;
use App\Models\QuestionsModel;
use App\Models\InstructorModel;
use App\Models\StudentModel;

class CustomRules
{
    public function is_unique_email($email, string $fields, array $data): bool
    {
        $adminModel = new AdminModel();
        $userModel = new Users();
        // $instructorModel = new InstructorModel();
        // $studentModel = new StudentModel();

        $adminEmail = $adminModel->where('email', $email)->first();
        $userEmail = $userModel->where('email', $email)->first();
        // $instructorEmail = $instructorModel->where('email', $email)->first();
        // $studentEmail = $studentModel->where('email', $email)->first();

        // return !$adminEmail && !$userEmail;
        return empty($adminEmail) && empty($userEmail) && empty($instructorEmail) && empty($studentEmail);
        //  && !$instructorEmail && !$studentEmail;
    }


    public function unique_question($question_text, string $fields, array $data)
    {
        $quiz_id = $data['quiz_id'];

        $questionsModel = new QuestionsModel();

        // Check if the question already exists for the given quiz_id
        $existingQuestion = $questionsModel
            ->where('quiz_id', $quiz_id)
            ->where('question_text', $question_text)
            ->first();

        return $existingQuestion === null;
    }

    public function unique_multi_question(string $str, string $fields, array $data): bool
    {
        $questionsModel = new QuestionsModel();
        
        foreach ($data['questions'] as $question) {
            $exists = $questionsModel
                        ->where('quiz_id', $question['quiz_id'])
                        ->where('question_text', $question['question_text'])
                        ->first();

            if ($exists) {
                return false;
            }
        }

        return true;
    }


    //     public function unique_question($question_text, string $fields, array $data)
    // {
    //     // Extract quiz_id from the fields
    //     list($quiz_id_field) = explode(',', $fields);

    //     // Get quiz_id from the data array
    //     $quiz_id = $data[$quiz_id_field] ?? null;

    //     if (!$quiz_id) {
    //         return false;
    //     }

    //     $questionsModel = new QuestionsModel();

    //     // Check if the question already exists for the given quiz_id
    //     $existingQuestion = $questionsModel
    //         ->where('quiz_id', $quiz_id)
    //         ->where('question_text', $question_text)
    //         ->first();

    //     return $existingQuestion === null;
    // }

}
