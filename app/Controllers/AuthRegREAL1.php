<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use App\Models\Users;

class AuthReg extends Controller
{
    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password'); // Changed from 'activation_key' to 'password'

        $usersModel = new Users();
        $user = $usersModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session = session();
            $session->set([
                'user_id' => $user['id'],
                'email' => $user['email'],
                'isLoggedIn' => true,
            ]);

            return redirect()->to(base_url('dashboard'));
        } else {
            session()->setFlashdata('error', 'Invalid Email or Password.');
            return redirect()->back();
        }
    }

    public function activationPage()
    {
        return view('activate_account');
    }

    public function activateAccount()
    {
        $pcc = $this->request->getPost('pcc');

        // Validate the PCC
        $usersModel = new Users();
        $user = $usersModel->where('payment_confirmation_code', $pcc)->first();

        if ($user) {
            // Update user's status to activated
            $usersModel->update($user['id'], ['activation_key' => 'active']);

            // Set session data to indicate the user is logged in
            $session = session();
            $session->set([
                'user_id' => $user['id'],
                'email' => $user['email'],
                'first_name' => $user['first_name'],
                'isLoggedIn' => true,
            ]);

            // Set success message
            $session->setFlashdata('success', 'Account activated successfully!');

            // Redirect to dashboard
            return redirect()->to(base_url('dashboard'));
        } else {
            // Set error message
            session()->setFlashdata('error', 'Invalid Payment Confirmation Code.');
            return redirect()->back();
        }
    }

    public function dashboard()
    {
        // Assuming you have a session to check if the user is logged in
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('login')->with('error', 'Please log in first.');
        }

        // Load the dashboard view
        return view('student/profile');
    }

    public function acknowledgementSlip()
    {
        return view('slip/acknowledgement_slip');
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

    
}
