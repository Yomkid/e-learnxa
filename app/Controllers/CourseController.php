<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\CourseTopicModel;
use App\Models\CategoryModel;
use App\Models\TopicsModel;
use App\Models\CourseEnrollmentModel;
use CodeIgniter\API\ResponseTrait;
use DateTime;

class CourseController extends BaseController
{

    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $courseModel = new CourseModel();
        $data['courses'] = $courseModel->getCourses();
        echo view('courses', $data);
    }

    // public function description($slug)
    // {
    //     $courseModel = new CourseModel();
    //     $course = $courseModel->where('slug', $slug)->first();

    //     if (!$course) {
    //         throw new \CodeIgniter\Exceptions\PageNotFoundException("Course with slug $slug not found");
    //     }


    //     // For Course Compact
    //     $courseCompactjsonData = $course['course_compact'];
    //     $compactData = json_decode($courseCompactjsonData, true);
    //     $compactTitles = $compactData['titles'];
    //     $compactContents = $compactData['contents'];


    //     $uploaded_date = $course['created_at'];

    //     // Convert the date string to a DateTime object
    //     $date = new DateTime($uploaded_date);

    //     // Format the date to "June 3, 2024"
    //     $formatted_date = $date->format('F j, Y');

    //     $data = [
    //         'course_id' => $course['course_id'],
    //         'title' => $course['course_title'],
    //         'slug' => $course['slug'],
    //         'tagline' => $course['course_tagline'],
    //         'overview' => $course['course_overview'],
    //         'acquiring_skills' => $course['course_aquiring_skills'],
    //         // 'compact' => $course['course_compact'],
    //         'compactTitles' => $compactTitles,
    //         'compactContents' => $compactContents,
    //         'requirements' => $course['course_requirements'],
    //         'descriptions' => $course['course_descriptions'],
    //         'image' => $course['course_image'],
    //         'rating' => $course['rating'],
    //         'rating_count' => $course['rating_count'],
    //         'instructor_id' => $course['instructor_id'],
    //         'price' => $course['price'],
    //         'duration' => $course['duration'],
    //         'language' => $course['language'],
    //         'enrollment_count' => $course['enrollment_count'],
    //         // 'uploaded_date' => $course['uploaded_date'],
    //         'modules' => $course['modules'],
    //         'features' => $course['features'],
    //         // 'created_at' => $course['created_at'],
    //         'created_at' => $formatted_date,
    //         'updated_at' => $course['updated_at'],
    //         'topic_id' => $course['topic_id'],
    //     ];
        

    //     return view('course_description', $data);
    // }

    public function description($slug)
    {
        $courseModel = new CourseModel();
        $course = $courseModel->where('slug', $slug)->first();

        if (!$course) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Course with slug $slug not found");
        }

        // Check if the user is enrolled in this course
        $userId = session()->get('user_id');
        $enrollmentModel = new CourseEnrollmentModel();
        $isEnrolled = $enrollmentModel->where('user_id', $userId)
                                    ->where('course_id', $course['course_id'])
                                    ->countAllResults() > 0;

        // For Course Compact
        $courseCompactjsonData = $course['course_compact'];
        $compactData = json_decode($courseCompactjsonData, true);
        $compactTitles = $compactData['titles'];
        $compactContents = $compactData['contents'];

        $uploaded_date = $course['created_at'];
        $date = new DateTime($uploaded_date);
        $formatted_date = $date->format('F j, Y');

        $data = [
            'course_id' => $course['course_id'],
            'title' => $course['course_title'],
            'slug' => $course['slug'],
            'tagline' => $course['course_tagline'],
            'overview' => $course['course_overview'],
            'acquiring_skills' => $course['course_aquiring_skills'],
            'compactTitles' => $compactTitles,
            'compactContents' => $compactContents,
            'requirements' => $course['course_requirements'],
            'descriptions' => $course['course_descriptions'],
            'image' => $course['course_image'],
            'rating' => $course['rating'],
            'rating_count' => $course['rating_count'],
            'instructor_id' => $course['instructor_id'],
            'price' => $course['price'],
            'duration' => $course['duration'],
            'language' => $course['language'],
            'enrollment_count' => $course['enrollment_count'],
            'modules' => $course['modules'],
            'features' => $course['features'],
            'created_at' => $formatted_date,
            'updated_at' => $course['updated_at'],
            'topic_id' => $course['topic_id'],
            'isEnrolled' => $isEnrolled  // Add enrollment status to data
        ];

        return view('course_description', $data);
    }


    public function enroll($courseId)
    {
        $courseModel = new CourseModel();
        // Fetch the course details from the database using the course ID
        $course = $courseModel->find($courseId);

        // Store necessary course data in session
        session()->set('course_data', [
            // 'course_id' => $courseId,
            'course_id' => $course['course_id'],
            'title' => $course['course_title'],
            'price' => $course['price'],
            'image' => $course['course_image'],
            // Add other necessary details
        ]);

        // Redirect to checkout page
        return redirect()->to('/checkout');
    }



    // Create and Edit Course
   public function createCourse()
   {
       $courseModel = new courseModel();
       $courses = $courseModel->findAll();

       $topicModel = new TopicsModel();
       $topics = $topicModel->findAll();

       $data = [
           'topics' => $topics,
           'courses' => $courses,
       ];

       return view('admin/courses/index', $data);
   }


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

        // Generate slug
        $slug = generateSlug($courseName);

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
            'course_title' => $courseName,
            'slug' => $slug,
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


    public function courseUpdate()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'course_title' => [
                'label' => 'Course Title',
                'rules' => 'required', // Removed is_unique for the update process
                'errors' => [
                    'required' => 'The {field} is required'
                ]
            ],
        ]);

        if (!$this->validate($validation->getRules())) {
            $errors = $validation->getErrors();
            return redirect()->back()->withInput()->with('errors', $errors)->with('message_type', 'error')->with('message', implode('<br>', $errors));
        }

        $courseId = $this->request->getPost('course_id'); // Assuming course_id is passed in the form
        $courseName = $this->request->getPost('course_title');

        // Generate slug
        $slug = generateSlug($courseName);

        // Create the model to fetch the existing course details
        $courseModel = new CourseModel();
        $currentCourse = $courseModel->find($courseId);

        // Initialize the image path to the existing image by default
        $imagePath = $currentCourse['course_image'];

        // Handle file upload
        $img = $this->request->getFile('course_image');

        // If a new image is uploaded
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $sanitizedCourseName = preg_replace('/[^a-zA-Z0-9-_]/', '_', $courseName);
            $newName = $sanitizedCourseName . '_' . time() . '.' . $img->getExtension();
            $img->move(FCPATH . 'uploads', $newName);
            $imagePath = $newName; // Update image path with new file
        }

        // Prepare course data for update
        $courseData = [
            'course_title' => $courseName,
            'slug' => $slug,
            'course_tagline' => $this->request->getPost('course_tagline'),
            'course_overview' => $this->request->getPost('course_overview'),
            'course_aquiring_skills' => $this->request->getPost('skills_acquired'),
            'course_compact' => json_encode([
                'titles' => $this->request->getPost('section_titles'),
                'contents' => $this->request->getPost('sections'),
            ]),
            'course_requirements' => $this->request->getPost('requirements'),
            'course_descriptions' => $this->request->getPost('course_description'),
            'course_image' => $imagePath, // Use the existing or new image path
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

        // Update the course in the database
        $updated = $courseModel->update($courseId, $courseData);

        if ($updated) {
            // Save selected topics
            $selectedTopics = $this->request->getPost('topic_ids');
            $courseTopicModel = new CourseTopicModel();

            // First, clear existing topics for this course
            $courseTopicModel->where('course_id', $courseId)->delete();

            // Insert the new topics
            foreach ($selectedTopics as $topicId) {
                $courseTopicModel->insert([
                    'course_id' => $courseId,
                    'topic_id' => $topicId
                ]);
            }

            $successMessage = "The Course $courseName updated successfully";
            return redirect()->to('/admin/course')
                ->with('success', $successMessage)
                ->with('message_type', 'success')
                ->with('message', $successMessage);
        } else {
            return redirect()->back()->withInput()->with('errors', 'Failed to update course')->with('message_type', 'error');
        }
    }

    // Add update course function
    public function updateCourse($id)
    {
        $courseModel = new CourseModel();
        $course = $courseModel->find($id);

        if (!$course) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Course with ID $id not found");
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'course_title' => [
                'label' => 'Course Title',
                'rules' => 'required|is_unique[courses.course_title,course_id,' . $id . ']',
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
        $slug = generateSlug($courseName);

        // Handle file upload
        $img = $this->request->getFile('course_image');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $sanitizedCourseName = preg_replace('/[^a-zA-Z0-9-_]/', '_', $courseName);
            $newName = $sanitizedCourseName . '_' . time() . '.' . $img->getExtension();
            $img->move(FCPATH . 'uploads', $newName);
            $imagePath = $newName;
        } else {
            $imagePath = $course['course_image'];
        }

        // Update the course
        $courseData = [
            'course_title' => $courseName,
            'slug' => $slug,
            'course_tagline' => $this->request->getPost('course_tagline'),
            'course_overview' => $this->request->getPost('course_overview'),
            'course_aquiring_skills' => $this->request->getPost('skills_acquired'),
            'course_compact' => json_encode([
                'titles' => $this->request->getPost('section_titles'),
                'contents' => $this->request->getPost('sections'),
            ]),
            'course_requirements' => $this->request->getPost('requirements'),
            'course_descriptions' => $this->request->getPost('course_description'),
            'course_image' => $imagePath,
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

        if ($courseModel->update($id, $courseData)) {
            $successMessage = "The Course $courseName updated successfully";
            return redirect()->to('/admin/course')
                ->with('success', $successMessage)
                ->with('message_type', 'success')
                ->with('message', $successMessage);
        } else {
            return redirect()->back()->withInput()->with('errors', 'Failed to update course')->with('message_type', 'error');
        }
    }


    public function deleteCourse($id)
    {
        $courseModel = new CourseModel();
        $courseModel->delete($id);

        $successMessage = "Selected course was deleted successfully";
        return redirect()->to('/admin/course')
        ->with('success', $successMessage)
        ->with('message_type', 'success')
        ->with('message', $successMessage);
    }

    public function getCourseDetails($courseId)
    {
        $courseModel = new CourseModel();
        $courseTopicModel = new CourseTopicModel();

        // Fetch course details
        $course = $courseModel->find($courseId);
        
        // Fetch associated topics
        $topics = $courseTopicModel->where('course_id', $courseId)->findAll();
        $topicIds = array_column($topics, 'topic_id'); // Get only the topic IDs

        if ($course) {
            return $this->response->setJSON([
                'course' => $course,
                'topic_ids' => $topicIds // Include the selected topic IDs in the response
            ]);
        } else {
            return $this->response->setJSON(['error' => 'Course not found'], 404);
        }
    }


    use ResponseTrait; // To use the JSON response helper

    public function getCoursesWithCategories()
    {
        $categories = $this->categoryModel->getAllCategories();
        return $this->response->setJSON($categories);
    }


    // In CourseController.php
    public function getCoursesByCategory($categoryId)
    {
        $courseModel = new CourseModel();
        $courses = $courseModel->getCoursesByCategory($categoryId);

        if (!empty($courses)) {
            return $this->respond($courses); // Return the courses as JSON
        } else {
            return $this->failNotFound('No courses found for this category');
        }
    }

    public function getCoursesByTopics()
    {
        $courseModel = new CourseModel();
        $courses = $courseModel->getCoursesByTopics();
        return $this->response->setJSON($courses);
    }

    public function getCoursesByCategories()
    {
        $courseModel = new CourseModel();
        $courses = $courseModel->getCoursesByCategories();
        return $this->response->setJSON($courses);
    }

    public function getCoursesByInstructors()
    {
        $courseModel = new CourseModel();
        $courses = $courseModel->getCoursesByInstructors();
        return $this->response->setJSON($courses);
    }



}