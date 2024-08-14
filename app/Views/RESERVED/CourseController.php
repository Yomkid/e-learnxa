<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\CourseTopicModel;

class CourseController extends BaseController
{
    public function index()
    {
        $courseModel = new CourseModel();
        $data['courses'] = $courseModel->getCourses();
        echo view('courses', $data);
    }



    public function description($courseId)
    {
        $courseModel = new CourseModel();
        $course = $courseModel->find($courseId);

        if (!$course) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Course with ID $courseId not found");
        }

        $data = [
            'title' => $course['course_title'],
            'description' => $course['course_descriptions'],
            // 'category' => $course['category'],
            // 'rating' => $course['rating'],
            // 'rating_count' => $course['rating_count'],
            // 'instructor' => $course['instructor'],
            // 'instructor_image' => $course['instructor_image'],
            // 'upload_date' => $course['upload_date'],
            // 'language' => $course['language'],
            // 'enrolled_students' => $course['enrolled_students'],
            // 'overview' => $course['overview'],
            // 'skills' => explode(',', $course['skills']),
            // // 'modules' => $this->getModules($courseId),
            // 'requirements' => explode(',', $course['requirements']),
            // 'full_description' => $course['full_description'],
            // 'instructor_bio' => $course['instructor_bio'],
            'price' => $course['price'],
            // 'duration' => $course['duration'],
            // 'level' => $course['level']
        ];

        return view('course_description', $data);
    }

    // private function getModules($courseId)
    // {
    //     $moduleModel = new ModuleModel();
    //     return $moduleModel->where('course_id', $courseId)->findAll();
    // }







    public function saveCourse()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'course_title' => [
                'label' => 'Course Title',
                'rules' => 'required|is_unique[courses.course_title]',
                'errors' => [
                    'required' => 'The {field} is required',
                    'is_unique' => 'The {field} already exists'
                ]
            ],
        ]);

        if (!$this->validate($validation->getRules())) {
            $errors = $validation->getErrors();
            return redirect()->back()->withInput()->with('errors', $errors)->with('message_type', 'error')->with('message', implode('<br>', $errors));
        }

        $courseName = $this->request->getPost('course_title');

        // Handle file upload
        $img = $this->request->getFile('course_image');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $sanitizedCourseName = preg_replace('/[^a-zA-Z0-9-_]/', '_', $courseName);
            $newName = $sanitizedCourseName . '_' . time() . '.' . $img->getExtension();
            $img->move(FCPATH . 'uploads', $newName);
            $imagePath = $newName;
        } else {
            return redirect()->back()->withInput()->with('errors', 'Image upload failed')->with('message_type', 'error');
        }

        // Save the course
        $courseData = [
            'course_title' => $this->request->getPost('course_title'),
            'course_tagline' => $this->request->getPost('course_tagline'),
            'course_overview' => $this->request->getPost('course_overview'),
            'course_aquiring_skills' => $this->request->getPost('skills_acquired'),
            'course_compact' => json_encode([
                'titles' => $this->request->getPost('section_titles'),
                'contents' => $this->request->getPost('sections'),
            ]),
            'course_requirements' => $this->request->getPost('requirements'),
            'course_descriptions' => $this->request->getPost('course_description'),
            'course_image' => $imagePath ?? null,
            'rating' => $this->request->getPost('rating'),
            'rating_count' => $this->request->getPost('rating_count'),
            'price' => $this->request->getPost('price'),
            'duration' => $this->request->getPost('duration'),
            'language' => $this->request->getPost('language'),
            'enrollment_count' => $this->request->getPost('enrollment_count'),
            'uploaded_date' => $this->request->getPost('uploaded_date'),
            'modules' => $this->request->getPost('course_module_count'),
            'features' => $this->request->getPost('is_featured'),
        ];

        $courseModel = new CourseModel();
        $courseId = $courseModel->insert($courseData);

        if ($courseId) {
            // Save selected topics
            $selectedTopics = $this->request->getPost('topic_ids');
            $courseTopicModel = new CourseTopicModel();
            foreach ($selectedTopics as $topicId) {
                $courseTopicModel->insert([
                    'course_id' => $courseId,
                    'topic_id' => $topicId
                ]);
            }

            $successMessage = "The Course $courseName saved successfully";
            return redirect()->to('/admin/course')
                ->with('success', $successMessage)
                ->with('message_type', 'success')
                ->with('message', $successMessage);
        } else {
            return redirect()->back()->withInput()->with('errors', 'Failed to save course')->with('message_type', 'error');
        }
    }
}
