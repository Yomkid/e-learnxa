<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\NotifyModel;
use Config\Services;

class NotificationController extends Controller
{

    public function notifyMe()
    {

        $model = new NotifyModel();

    // Get email from POST request
    $email = $this->request->getPost('email');

    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if email already exists
        if (!$model->where('email', $email)->first()) {
            // Save the email to the database
            $model->save(['email' => $email]);

            // Send success response
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Thank you! You will be notified when we launch.'
            ]);
        } else {
            // Email already exists
            return $this->response->setJSON([
                'status' => 'info',
                'message' => 'You have already signed up for notifications.'
            ]);
        }
    } else {
        // Invalid email
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Invalid email address. Please enter a valid email.'
        ]);
    }
    }















    public function sendNotifications()
    {

    //     // Example check for a simple token
    // $token = $this->request->getGet('token');
    // if ($token !== 'your_secret_token') {
    //     throw new \CodeIgniter\Exceptions\PageNotFoundException('Unauthorized access');
    // }
        $model = new NotifyModel();

        // Fetch all email addresses from the database
        $emails = $model->findAll();

        // Email settings
        $subject = "We're Live! Welcome to the New KrossCheck Website";
        $message = "Hello,

We are excited to announce that the new KrossCheck website is now live! 
Visit us now at https://www.krosscheck.com to explore the new features and tools designed to simplify the admission process and more.

Thank you for being part of our community!

Best regards,
The KrossCheck Team";

        // Load email service
        $email = Services::email();
        $email->setFrom('no-reply@krosscheck.com', 'KrossCheck');
        $email->setReplyTo('support@krosscheck.com');

        foreach ($emails as $emailRecord) {
            $email->setTo($emailRecord['email']);
            $email->setSubject($subject);
            $email->setMessage($message);

            if ($email->send()) {
                echo "Email sent successfully to " . $emailRecord['email'] . "<br>";
            } else {
                $error = $email->printDebugger(['headers']);
                echo "Failed to send email to " . $emailRecord['email'] . ": " . $error . "<br>";
            }
        }
    }
}
