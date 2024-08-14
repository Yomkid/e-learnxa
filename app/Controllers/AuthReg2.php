<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Users;
use App\Libraries\Queue;


class AuthReg extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function activateAccount()
    {
        return view('activate_account');
    }

    public function generateInvoice()
    {
        return view('generate_invoice'); // Loads the generate_invoice.php view
    }

    public function processInvoice()
    {
        // Retrieve form data from POST request
        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('phone_number'),
            'state' => $this->request->getPost('state'),
            'country' => $this->request->getPost('country'),
            'address' => $this->request->getPost('address'),
        ];

        // Generate unique registration number
        $registrationNumber = $this->generateRegistrationNumber();

        // Pass registration number and other data to the invoice view
        $data['registration_number'] = $registrationNumber;
        return view('invoice', $data);
    }

    public function verifyPayment()
    {
        $reference = $this->request->getGet('reference');
        
        if (!$reference) {
            return redirect()->to('generate-invoice')->with('error', 'No payment reference found.');
        }

        $paystackSecretKey = 'pk_test_18bd358872baeae63db2133cc291cd2e92df0015'; // Replace with your Paystack secret key

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/{$reference}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer {$paystackSecretKey}",
                "Content-Type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return redirect()->to('generate-invoice')->with('error', 'Error verifying payment.');
        }

        $result = json_decode($response);

        if ($result->status && $result->data->status === 'success') {
            // Payment verified successfully
            // Store payment details in the database
            // Send confirmation email to the user

            // Instantiate the Users model
            $usersModel = new Users();

            // Prepare data to be inserted into the database
            $userData = [
                'first_name' => $result->data->customer->first_name,
                'last_name' => $result->data->customer->last_name,
                'email' => $result->data->customer->email,
                'phone_number' => $result->data->customer->phone,
                'username' => $this->generateUsername($result->data->customer->first_name, $result->data->customer->last_name),
                'registration_number' => $result->data->reference,
                'role' => 'student', // Assuming the user role after registration is 'student'
                'payment_status' => 'success',
                'amount_paid' => $result->data->amount / 100, // Amount in kobo, convert to naira or dollars as appropriate
                'payment_confirmation_code' => $result->data->reference,
            ];

            // Insert data into the database
            $usersModel->insert($userData);

            // Send confirmation email to the user
            $this->sendConfirmationEmail($userData);

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

    private function generateRegistrationNumber()
    {
        // Get current timestamp
        $timestamp = time();

        // Format timestamp into YEAR, MONTH, DAY, HOUR, MINUTE, SECOND
        $year = date('Y', $timestamp);
        $month = date('m', $timestamp);
        $day = date('d', $timestamp);
        $invoiceNumber = $this->generateInvoiceNumber();

        // Construct registration number
        $registrationNumber = "LXA{$year}{$month}{$day}{$invoiceNumber}";

        return $registrationNumber;
    }

    private function generateInvoiceNumber()
    {
        // Logic to generate a unique invoice number, you can use timestamp or any other method you prefer
        // Example: Generate a random number for simplicity
        $invoiceNumber = mt_rand(1000, 9999); // Generate a 4-digit random number

        return $invoiceNumber;
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
    
}
