<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;

class EmailTest extends Controller
{
    public function index()
    {
        // Load email library
        $email = Services::email();

        // Prepare email settings
        $email->setTo('odewayemayomi@gmail.com'); // Replace with recipient's email
        $email->setFrom('elearnxa@gmail.com', 'LearnXa'); // Replace with your email and name
        $email->setSubject('Test Email');
        $email->setMessage('<p>This is a test email sent from CodeIgniter 4.</p>');

        // Send email
        if ($email->send()) {
            echo 'Email sent successfully.';
        } else {
            // Display error message
            echo 'Email sending failed. ';
            echo $email->printDebugger(['headers']);
        }
    }
}
