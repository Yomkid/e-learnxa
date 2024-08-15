<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModuleModel;
use App\Models\LessonModel;

class LessonController extends BaseController
{

    public function index()
    {
        return view('admin/lessons/index');
    }

    public function getAllLessons()
    {
        $lessonModel = new LessonModel();
        $lessons = $lessonModel->findAll();
        
        return $this->response->setJSON(['lessons' => $lessons]);
    }


    public function getModules() {
        $course_id = $this->request->getGet('course_id');
        $moduleModel = new ModuleModel();
        $modules = $moduleModel->where('course_id', $course_id)->findAll();
        
        return $this->response->setJSON(['modules' => $modules]);
    }

    public function getModuleDetails()
{
    $module_id = $this->request->getGet('module_id');

    $lessonModel = new LessonModel();
    $lesson = $lessonModel->getLessonByModuleId($module_id);

    // Return an empty array if no lesson is found
    if (!$lesson) {
        return $this->response->setJSON([]);
    }

    $details = [
        'lesson_title' => $lesson['lesson_title'],
        'lesson_content' => $lesson['lesson_content'],
        'has_video' => $lesson['has_video'],
        'video_id' => $lesson['video_id'],
        'has_quiz' => $lesson['has_quiz'],
        'quiz_id' => $lesson['quiz_id'],
        'has_assignment' => $lesson['has_assignment'],
        'assignment_id' => $lesson['assignment_id'],
        'has_resource' => $lesson['has_resource'],
        'resource_id' => $lesson['resource_id'],
        'duration' => $lesson['duration']
    ];

    return $this->response->setJSON($details);
}



    public function saveLesson()
    {
        $moduleId = $this->request->getPost('module_id');
        $lessonTitle = $this->request->getPost('lesson_title');
        $lessonContent = $this->request->getPost('lesson_content');
        $hasVideo = $this->request->getPost('has_video');
        $videoId = $this->request->getPost('video_id');
        $hasQuiz = $this->request->getPost('has_quiz');
        $quizId = $this->request->getPost('quiz_id');
        $hasAssignment = $this->request->getPost('has_assignment');
        $assignmentId = $this->request->getPost('assignment_id');
        $hasResource = $this->request->getPost('has_resource');
        $resourceId = $this->request->getPost('resource_id');
        $duration = $this->request->getPost('duration');
    
        if (empty($moduleId)) {
            return $this->response->setJSON([
                'message_type' => 'error',
                'message' => 'Module ID is required.'
            ], ResponseInterface::HTTP_BAD_REQUEST);
        }
    
        $moduleModel = new ModuleModel();
        if (!$moduleModel->find($moduleId)) {
            return $this->response->setJSON([
                'message_type' => 'error',
                'message' => 'Invalid Module ID.'
            ], ResponseInterface::HTTP_BAD_REQUEST);
        }
    
        $lessonModel = new LessonModel();
        $existingLesson = $lessonModel->getLessonByModuleId($moduleId);
    
        $lessonData = [
            'module_id' => $moduleId,
            'lesson_title' => $lessonTitle,
            'lesson_content' => $lessonContent,
            'has_video' => $hasVideo,
            'video_id' => $videoId,
            'has_quiz' => $hasQuiz,
            'quiz_id' => $quizId,
            'has_assignment' => $hasAssignment,
            'assignment_id' => $assignmentId,
            'has_resource' => $hasResource,
            'resource_id' => $resourceId,
            'duration' => $duration,
        ];
    
        if ($existingLesson) {
            // Update existing lesson
            $lessonData['lesson_id'] = $existingLesson['lesson_id']; // Include lesson ID for updating
            if ($lessonModel->save($lessonData)) {
                return $this->response->setJSON([
                    'message_type' => 'success',
                    'message' => 'Lesson updated successfully'
                ]);
            } else {
                return $this->response->setJSON([
                    'message_type' => 'error',
                    'message' => 'Failed to update the lesson.'
                ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            // Insert new lesson
            if ($lessonModel->insert($lessonData)) {
                return $this->response->setJSON([
                    'message_type' => 'success',
                    'message' => 'Lesson saved successfully'
                ]);
            } else {
                return $this->response->setJSON([
                    'message_type' => 'error',
                    'message' => 'Failed to save the lesson.'
                ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }


}
