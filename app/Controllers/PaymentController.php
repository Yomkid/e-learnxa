<?php

namespace App\Controllers;

use App\Models\Users;
use App\Models\Role;
use App\Models\CourseEnrollmentModel;
use App\Models\ActivityModel;
use CodeIgniter\Controller;

class PaymentController extends Controller
{
    public function verifyPayment()
    {
        $reference = $this->request->getGet('reference');

        if (!$reference) {
            return redirect()->to('generate-invoice')->with('error', 'No payment reference found.');
        }

        // $paystackSecretKey = 'pk_test_18bd358872baeae63db2133cc291cd2e92df0015'; // Replace with your Paystack secret key
        $paystackSecretKey = 'sk_live_15989fc19c95dad4542259213c01d25b3f4c7ad4'; // Replace with your Paystack secret key

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/{$reference}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer {$paystackSecretKey}",
                "Content-Type: application/json",
                "cache-control: no-cache"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return redirect()->to('generate-invoice')->with('error', 'Error verifying payment.');
        }

        $result = json_decode($response);
        // Get the role_id for "Student"
        $roleModel = new Role();
        $studentRole = $roleModel->where('role_name', 'Student')->first();

        if (!$studentRole) {
            return redirect()->back()->withInput()->with('error', 'Default "Student" role not found.');
        }

        // Log the response from Paystack
        log_message('debug', 'Paystack Response: ' . json_encode($result));

        if ($result->status && $result->data->status === 'success') {
            // Prepare data to be inserted into the database
            $userData = [
                'first_name' => $result->data->metadata->firstname ?? '',
                'last_name' => $result->data->metadata->lastname ?? '',
                'username' => $this->generateUsername($result->data->metadata->firstname ?? '', $result->data->metadata->lastname ?? ''),
                'email' => $result->data->customer->email ?? '',
                'phone_number' => $result->data->metadata->phone ?? '',
                'password_hash' => password_hash($result->data->metadata->lastname, PASSWORD_BCRYPT),
                // 'role_id' => 'student', // Assuming the user role after registration is 'student'
                'role_id' => $studentRole['role_id'], // Assuming the user role after registration is 'student'
                'payment_status' => 'success',
                'amount_paid' => $result->data->amount / 100, // Amount in kobo, convert to naira or dollars as appropriate
                'payment_confirmation_code' => $result->data->reference ?? '',
                'state' => $result->data->metadata->state ?? '',
                'country' => $result->data->metadata->country ?? '',
                'address' => $result->data->metadata->address ?? '',
            ];

            // Log the data to be inserted
            log_message('debug', 'User Data: ' . json_encode($userData));

            

            // Insert data into the database
            $usersModel = new Users();
            $inserted = $usersModel->insert($userData);

            if (!$inserted) {
                return redirect()->to('generate-invoice')->with('error', 'Failed to insert user data.');
            }

            // Log the registration activity
            $this->logActivity($inserted, 'User registered successfully.');

            // Send confirmation and password emails
            $this->sendConfirmationEmail($userData);
            $this->sendDefaultPasswordEmail($userData['email'], $result->data->customer->last_name);

            // Pass data to the payment_success view
            return view('payment_success', $userData);
        } else {
            return redirect()->to('generate-invoice')->with('error', 'Payment verification failed.');
        }
    }

    private function generateUsername($firstName, $lastName)
    {
        $username = strtolower($firstName . '.' . $lastName);

        // Instantiate the Users model to check for existing usernames
        $usersModel = new Users();
        $existingUser = $usersModel->where('username', $username)->first();

        if ($existingUser) {
            // Append a unique identifier if username already exists
            $username .= '.' . uniqid();
        }

        return $username;
    }

    private function sendConfirmationEmail($userData)
    {
        $email = \Config\Services::email();

        $email->setFrom('elearnxa@gmail.com', 'LearnXa');
        $email->setTo($userData['email']);
        $email->setSubject('LearnXa Registration Confirmation');

        // Load HTML email template
        $message = view('email_templates/registration_confirmation', $userData);

        $email->setMessage($message);

        if ($email->send()) {
            // Log success or perform additional actions upon successful email delivery
            log_message('info', 'Registration confirmation email sent to ' . $userData['email']);
        } else {
            // Log failure or handle errors
            log_message('error', 'Failed to send registration confirmation email to ' . $userData['email'] . '. Error: ' . $email->printDebugger(['headers']));
        }
    }

    private function sendDefaultPasswordEmail($email, $defaultPassword)
    {
        $emailService = \Config\Services::email();

        $emailService->setFrom('elearnxa@gmail.com', 'LearnXa');
        $emailService->setTo($email);
        $emailService->setSubject('LearnXa Registration - Your Password');

        $message = "Dear user,\n\nYour default password is: {$defaultPassword}\n\nPlease change your password after logging in.";

        $emailService->setMessage($message);

        if ($emailService->send()) {
            log_message('info', 'Default password email sent to ' . $email);
        } else {
            log_message('error', 'Failed to send default password email to ' . $email . '. Error: ' . $emailService->printDebugger(['headers']));
        }
    }

    private function logActivity($userId, $activity)
    {
        $ActivityModel = new ActivityModel();

        $logData = [
            'user_id' => $userId,
            'activity_type' => $activity,
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString(),
        ];

        $ActivityModel->insert($logData);
    }


    // public function verifyEnrollmentPayment()
    // {
    //     $reference = $this->request->getGet('reference');
    
    //     if (!$reference) {
    //         return redirect()->to('/checkout')->with('error', 'No payment reference found.');
    //     }
    
    //     // $paystackSecretKey = getenv('PAYSTACK_SECRET_KEY'); // Replace with your Paystack secret key
    //     $paystackSecretKey = 'pk_test_18bd358872baeae63db2133cc291cd2e92df0015'; // Replace with your Paystack secret key
    
    //     $curl = curl_init();
    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => "https://api.paystack.co/transaction/verify/{$reference}",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_HTTPHEADER => [
    //             "Authorization: Bearer {$paystackSecretKey}",
    //             "Content-Type: application/json",
    //             "cache-control: no-cache"
    //         ],
    //     ]);
    
    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);
    
    //     curl_close($curl);
    
    //     if ($err) {
    //         return redirect()->to('/checkout')->with('error', 'Error verifying payment.');
    //     }
    
    //     $paymentDetails = json_decode($response);
    
    //     // Log the response from Paystack
    //     log_message('debug', 'Paystack Response: ' . json_encode($paymentDetails));
    
    //     // Check if course_data and course_id exist in the session
    //     $sessionCourseData = session()->get('course_data');
    //     log_message('debug', 'Session Data: ' . json_encode($sessionCourseData));
    
    //     if (!$sessionCourseData || !isset($sessionCourseData['course_id'])) {
    //         return redirect()->to('/checkout')->with('error', 'Course data is missing. Please select a course.');
    //     }
    
    //     $courseId = $sessionCourseData['course_id'];
    //     $userId = session()->get('user_id');
    
    //     if ($paymentDetails && $paymentDetails->status && $paymentDetails->data->status === 'success') {
    //         // Extract payment information
    //         $amountPaid = $paymentDetails->data->amount / 100; // Paystack returns amount in kobo
    //         $paymentReference = $paymentDetails->data->reference;
    
    //         // Prepare data to be inserted into the database
    //         $enrollmentData = [
    //             // 'user_id' => $userId,
    //             'user_id' => 26,
    //             'course_id' => $courseId,
    //             'enrollment_date' => date('Y-m-d H:i:s'),
    //             'price' => $amountPaid,
    //             'status' => 'Enrolled',
    //             'payment_reference' => $paymentReference,
    //             'payment_status' => 'Paid'
    //         ];
    
    //         // Log the data to be inserted
    //         log_message('debug', 'Enrollment Data: ' . json_encode($enrollmentData));
    
    //         // Insert data into the database
    //         $enrollmentModel = new CourseEnrollmentModel();
    //         $inserted = $enrollmentModel->insert($enrollmentData);
    
    //         if (!$inserted) {
    //             return redirect()->to('generate-invoice')->with('error', 'Failed to insert enrollment data.');
    //         }
    
    //         // Clear session data
    //         session()->remove('course_data');
    //         session()->remove('user_id');
    
    //         // Redirect to a confirmation page
    //         return view('/payment_status/course_enrollment_success');
    //     } else {
    //         return redirect()->to('/payment-failed')->with('error', 'Payment verification failed.');
    //     }
    // }

    // public function verifyEnrollmentPayment()
    // {
    //     $reference = $this->request->getGet('reference');

    //     if (!$reference) {
    //         return redirect()->to('/checkout')->with('error', 'No payment reference found.');
    //     }

    //     // $paystackSecretKey = getenv('PAYSTACK_SECRET_KEY'); // Store this securely
    //     $paystackSecretKey = 'pk_test_18bd358872baeae63db2133cc291cd2e92df0015';

    //     $curl = curl_init();
    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => "https://api.paystack.co/transaction/verify/{$reference}",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_HTTPHEADER => [
    //             "Authorization: Bearer {$paystackSecretKey}",
    //             "Content-Type: application/json",
    //             "cache-control: no-cache"
    //         ],
    //     ]);

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);

    //     curl_close($curl);

    //     if ($err) {
    //         return redirect()->to('/checkout')->with('error', 'Error verifying payment.');
    //     }

    //     $paymentDetails = json_decode($response);

    //     // Log the response from Paystack
    //     log_message('debug', 'Paystack Response: ' . json_encode($paymentDetails));

    //     // Check if course_data and course_id exist in the session
    //     $sessionCourseData = session()->get('course_data');
    //     log_message('debug', 'Session Data: ' . json_encode($sessionCourseData));

    //     if (!$sessionCourseData || !isset($sessionCourseData['course_id'])) {
    //         return redirect()->to('/checkout')->with('error', 'Course data is missing. Please select a course.');
    //     }

    //     $courseId = $sessionCourseData['course_id'];
    //     $userId = session()->get('user_id');

    //     if ($paymentDetails && $paymentDetails->status && $paymentDetails->data->status === 'success') {
    //         // Extract payment information
    //         $amountPaid = $paymentDetails->data->amount / 100; // Paystack returns amount in kobo
    //         $paymentReference = $paymentDetails->data->reference;

    //         // Validate ENUM values for status and payment_status
    //         $validStatuses = ['enrolled', 'active', 'completed', 'cancelled', 'refunded'];
    //         $validPaymentStatuses = ['paid', 'pending', 'failed'];

    //         if (!in_array(strtolower('enrolled'), $validStatuses) || !in_array(strtolower('paid'), $validPaymentStatuses)) {
    //             return redirect()->to('/checkout')->with('error', 'Invalid status or payment status.');
    //         }

    //         // Prepare data to be inserted into the database
    //         $enrollmentData = [
    //             // 'user_id' => 26,
    //             'user_id' => $userId,
    //             'course_id' => $courseId,
    //             'enrollment_date' => date('Y-m-d H:i:s'),
    //             'price' => $amountPaid,
    //             'status' => 'enrolled', // Ensure lowercase to match ENUM values
    //             'payment_reference' => $paymentReference,
    //             'payment_status' => 'paid' // Ensure lowercase to match ENUM values
    //         ];

    //         // Log the data to be inserted
    //         log_message('debug', 'Enrollment Data: ' . json_encode($enrollmentData));

    //         // Insert data into the database
    //         $enrollmentModel = new CourseEnrollmentModel();
    //         $inserted = $enrollmentModel->insert($enrollmentData);

    //         if (!$inserted) {
    //             log_message('error', 'Failed to insert enrollment data: ' . json_encode($enrollmentData));
    //             return redirect()->to('checkout')->with('error', 'Failed to process your enrollment. Please try again.');
    //         }

    //         // Clear session data
    //         session()->remove('course_data');
    //         session()->remove('user_id');

    //         // Redirect to a confirmation page
    //         // return view('/payment_status/course_enrollment_success');
    //         return view('/student/enrolled-courses');
    //     } else {
    //         return redirect()->to('/checkout')->with('error', 'Payment verification failed.');
    //     }
    // }

    public function verifyEnrollmentPayment()
    {
        $reference = $this->request->getGet('reference');

        if (!$reference) {
            return redirect()->to('/checkout')->with('error', 'No payment reference found.');
        }

        $paystackSecretKey = 'pk_test_18bd358872baeae63db2133cc291cd2e92df0015';

        // Initialize cURL for Paystack verification
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/{$reference}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer {$paystackSecretKey}",
                "Content-Type: application/json",
                "cache-control: no-cache"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return redirect()->to('/checkout')->with('error', 'Error verifying payment.');
        }

        $paymentDetails = json_decode($response);

        log_message('debug', 'Paystack Response: ' . json_encode($paymentDetails));

        // Check if course_data exists in session
        $sessionCourseData = session()->get('course_data');
        if (!$sessionCourseData || !isset($sessionCourseData['course_id'])) {
            return redirect()->to('/checkout')->with('error', 'Course data is missing. Please select a course.');
        }

        $courseId = $sessionCourseData['course_id'];
        $userId = session()->get('user_id');

        // Validate payment success
        if ($paymentDetails && $paymentDetails->status && $paymentDetails->data->status === 'success') {
            $amountPaid = $paymentDetails->data->amount / 100;
            $paymentReference = $paymentDetails->data->reference;

            // Prepare data for database insertion
            $enrollmentData = [
                'user_id' => $userId,
                'course_id' => $courseId,
                'enrollment_date' => date('Y-m-d H:i:s'),
                'price' => $amountPaid,
                'status' => 'enrolled',
                'payment_reference' => $paymentReference,
                'payment_status' => 'paid'
            ];

            log_message('debug', 'Enrollment Data: ' . json_encode($enrollmentData));

            // Insert enrollment data into the database
            $enrollmentModel = new CourseEnrollmentModel();
            if (!$enrollmentModel->insert($enrollmentData)) {
                log_message('error', 'Failed to insert enrollment data: ' . json_encode($enrollmentData));
                return redirect()->to('/checkout')->with('error', 'Failed to process your enrollment. Please try again.');
            }

            // Fetch all enrolled courses for the user
            $enrolledCourses = $enrollmentModel->getUserEnrollments($userId);

            // Clear session data
            session()->remove(['course_data']);


            // Redirect to enrolled courses page with the updated enrollment data
            return redirect()->to('/student/enrolled-courses')->with('success', 'Enrollment completed successfully!')->with('enrolledCourses', $enrolledCourses);
        }

        return redirect()->to('/checkout')->with('error', 'Payment verification failed.');
    }


    // public function verifyCourseEnrollmentPaymentWithFlutter()
    // {
    //     // Get the payment reference from the request
    //     $reference = $this->request->getVar('reference');

    //     if (!$reference) {
    //         return redirect()->to('/checkout')->with('error', 'No payment reference found.');
    //     }

    //     // Flutterwave secret key
    //     $secretKey = 'FLWSECK_TEST-76cf7cf9d4f70cefe5c3695f3b26d14f-X';
        
    //     // Endpoint for verifying the payment
    //     $url = 'https://api.flutterwave.com/v3/transactions/' . $reference . '/verify';

    //     // Set up the cURL request
    //     $curl = curl_init();
    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => $url,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_HTTPHEADER => [
    //             'Authorization: Bearer ' . $secretKey,
    //             'Content-Type: application/json',
    //         ],
    //     ]);

    //     // Execute the request and get the response
    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);
    //     curl_close($curl);

    //     if ($err) {
    //         return redirect()->to('/checkout')->with('error', 'Error verifying payment.');
    //     }

    //     // Decode the JSON response
    //     $paymentDetails = json_decode($response, true);

    //     // Log the response for debugging
    //     log_message('debug', 'Flutterwave Response: ' . json_encode($paymentDetails));

    //     if (!isset($paymentDetails['status']) || $paymentDetails['status'] !== 'success') {
    //         return redirect()->to('/checkout')->with('error', 'Payment verification failed.');
    //     }

    //     if (!isset($paymentDetails['data']['status']) || $paymentDetails['data']['status'] !== 'successful') {
    //         return redirect()->to('/checkout')->with('error', 'Payment verification failed.');
    //     }

    //     // Check if course_data and course_id exist in the session
    //     $sessionCourseData = session()->get('course_data');
    //     log_message('debug', 'Session Data: ' . json_encode($sessionCourseData));

    //     if (!$sessionCourseData || !isset($sessionCourseData['course_id'])) {
    //         return redirect()->to('/checkout')->with('error', 'Course data is missing. Please select a course.');
    //     }

    //     $courseId = $sessionCourseData['course_id'];
    //     $userId = session()->get('user_id');

    //     if ($paymentDetails && $paymentDetails['status'] === 'success' && $paymentDetails['data']['status'] === 'successful') {
    //         // Extract payment information
    //         $amountPaid = $paymentDetails['data']['amount'];
    //         $paymentReference = $paymentDetails['data']['tx_ref'];

    //         // Prepare data to be inserted into the database
    //         $enrollmentData = [
    //             'user_id' => 27,
    //             'course_id' => $courseId,
    //             'enrollment_date' => date('Y-m-d H:i:s'),
    //             'price' => $amountPaid,
    //             'status' => 'enrolled', // Ensure lowercase to match ENUM values
    //             'payment_reference' => $paymentReference,
    //             'payment_status' => 'paid' // Ensure lowercase to match ENUM values
    //         ];

    //         // Log the data to be inserted
    //         log_message('debug', 'Enrollment Data: ' . json_encode($enrollmentData));

    //         // Insert data into the database
    //         $enrollmentModel = new CourseEnrollmentModel();
    //         $inserted = $enrollmentModel->insert($enrollmentData);

    //         if (!$inserted) {
    //             log_message('error', 'Failed to insert enrollment data: ' . json_encode($enrollmentData));
    //             return redirect()->to('checkout')->with('error', 'Failed to process your enrollment. Please try again.');
    //         }

    //         // Clear session data
    //         session()->remove('course_data');
    //         session()->remove('user_id');

    //         // Redirect to a confirmation page
    //         return view('/payment_status/course_enrollment_success');
    //     } else {
    //         return redirect()->to('/checkout')->with('error', 'Payment verification failed.');
    //     }
    // }

    public function verifyCourseEnrollmentPaymentWithFlutter()
    {
        // Get the payment reference from the request
        $reference = $this->request->getVar('reference');

        if (!$reference) {
            return redirect()->to('/checkout')->with('error', 'No payment reference found.');
        }

        // Flutterwave secret key
        // $secretKey = 'FLWSECK_TEST-76cf7cf9d4f70cefe5c3695f3b26d14f-X';

        // Endpoint for verifying the payment
        $url = 'https://api.flutterwave.com/v3/transactions/' . $reference . '/verify';

        // Set up the cURL request
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer FLWSECK_TEST-76cf7cf9d4f70cefe5c3695f3b26d14f-X',
                // 'Authorization: Bearer ' . $secretKey,
                'Content-Type: application/json',
            ],
        ]);

        // Execute the request and get the response
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            log_message('error', 'cURL Error: ' . $err);
            return redirect()->to('/checkout')->with('error', 'Error verifying payment.');
        }

        // Decode the JSON response
        $paymentDetails = json_decode($response, true);

        // Log the response for debugging
        log_message('debug', 'Flutterwave Response: ' . json_encode($paymentDetails));

        // Check if the payment was successful
        if (
            isset($paymentDetails['status']) && 
            $paymentDetails['status'] === 'success' &&
            isset($paymentDetails['data']['status']) &&
            $paymentDetails['data']['status'] === 'successful'
        ) {
            // Extract payment information
            $amountPaid = $paymentDetails['data']['amount'];
            $currency = $paymentDetails['data']['currency'];
            $paymentReference = $paymentDetails['data']['tx_ref'];

            // Check session data for course details
            $sessionCourseData = session()->get('course_data');
            if (!$sessionCourseData || !isset($sessionCourseData['course_id'])) {
                return redirect()->to('/checkout')->with('error', 'Course data is missing. Please select a course.');
            }

            $courseId = $sessionCourseData['course_id'];
            $userId = session()->get('user_id');

            // Validate payment amount and currency
            if (
                $amountPaid === $sessionCourseData['price'] &&
                $currency === 'NGN'
            ) {
                // Prepare enrollment data
                $enrollmentData = [
                    'user_id' => $userId,
                    'course_id' => $courseId,
                    'enrollment_date' => date('Y-m-d H:i:s'),
                    'price' => $amountPaid,
                    'status' => 'enrolled',
                    'payment_reference' => $paymentReference,
                    'payment_status' => 'paid'
                ];

                // Insert data into the database
                $enrollmentModel = new CourseEnrollmentModel();
                $inserted = $enrollmentModel->insert($enrollmentData);

                if (!$inserted) {
                    log_message('error', 'Failed to insert enrollment data: ' . json_encode($enrollmentData));
                    return redirect()->to('/checkout')->with('error', 'Failed to process your enrollment. Please try again.');
                }

                // Clear session data
                session()->remove('course_data');
                session()->remove('user_id');

                // Redirect to success page
                return view('/payment_status/course_enrollment_success');
            } else {
                return redirect()->to('/checkout')->with('error', 'Payment amount or currency mismatch.');
            }
        } else {
            return redirect()->to('/checkout')->with('error', 'Payment verification failed.');
        }
    }
    

    


   

}
