<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CheckoutController extends BaseController
{
    // CheckoutController.php

public function index()
{
    // Retrieve the course data from session
    $courseData = session()->get('course_data');

    // Pass the data to the view
    return view('checkout', [
        'courseId' => $courseData['course_id'],
        'courseTitle' => $courseData['title'],
        'coursePrice' => $courseData['price'],
        'courseImage' => $courseData['image'],
        // Add other necessary details
    ]);
}

}
