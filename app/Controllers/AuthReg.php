<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use CodeIgniter\Session\Session;
use App\Models\CountryModel;
use App\Models\StateModel;
use App\Models\Users;
use App\Models\AdminModel;
use App\Models\Role;
use App\Models\InstructorModel;
use App\Models\SuperAdminModel;
use App\Models\ModeratorModel;
use App\Models\StudentModel;

class AuthReg extends Controller
{

    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }


    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
    
        $usersModel = new Users();
        $user = $usersModel->where('email', $email)->first();
    
        if ($user && password_verify($password, $user['password_hash'])) {
            // Get the current date in 'Y-m-d' format
            $currentDate = date('Y-m-d');
    
            // Check if the user has logged in today
            $lastLoginDate = $user['last_login_date'] ?? null; // Assume you store this in the users table
    
            // Determine if it's the user's first login of the day
            $isFirstLoginToday = !$lastLoginDate || $lastLoginDate !== $currentDate;
    
            // Update the last login date in the database if it's the first login of the day
            if ($isFirstLoginToday) {
                $usersModel->update($user['user_id'], ['last_login_date' => $currentDate]);
            }
    
            // Set session data
            $this->session->set([
                'user_id' => $user['user_id'],
                'email' => $user['email'],
                'phone_number' => $user['phone_number'],
                'first_name' => $user['first_name'],
                'status' => $user['status'],
                'last_name' => $user['last_name'],
                'role_id' => $user['role_id'],
                'payment_confirmation_code' => $user['payment_confirmation_code'],
                'isLoggedIn' => true,
                'isFirstLoginToday' => $isFirstLoginToday, // Store this for greeting logic
            ]);
    
            $redirectURL = $this->request->getPost('redirect');
    
            // Validate the redirect URL
            if ($redirectURL && filter_var($redirectURL, FILTER_VALIDATE_URL) && strpos($redirectURL, base_url()) === 0) {
                return redirect()->to($redirectURL);
            }
    
            // Redirect based on role_id
            switch ($user['role_id']) {
                case 1:
                    return redirect()->to(base_url('admin/dashboard'));
                case 2:
                    return redirect()->to(base_url('super_admin/dashboard'));
                case 3:
                    return redirect()->to(base_url('instructor/dashboard'));
                case 4:
                    return redirect()->to(base_url('moderator/dashboard'));
                case 5:
                    return redirect()->to(base_url('student'));
                default:
                    return redirect()->to(base_url('student'));
            }
        } else {
            $this->session->setFlashdata('error', 'Invalid Email or Password.');
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
        return view('student/index');
    }



    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('login'));
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
            $usersModel->update($user['user_id'], ['activation_key' => 'active']);

            // Set session data to indicate the user is logged in
            $session = session();
            $session->set([
                'user_id' => $user['user_id'],
                'email' => $user['email'],
                'first_name' => $user['first_name'],
                'isLoggedIn' => true,
            ]);

            // Set success message
            $session->setFlashdata('success', 'Account activated successfully!');

            // Redirect to dashboard
            return redirect()->to(base_url('student'));
        } else {
            // Set error message
            session()->setFlashdata('error', 'Invalid Payment Confirmation Code.');
            return redirect()->back();
        }
    }

   
    public function acknowledgementSlip()
    {
        return view('slip/acknowledgement_slip');
    }

    public function generateInvoice()
    {
        return view('generate_invoice'); // Loads the generate_invoice.php view
    }



   

    public function create()
    {
        $countryModel = new CountryModel();
        $countries = $countryModel->findAll();

        return view('create_user', ['countries' => $countries]);
    }

    public function getStates()
    {
        $stateModel = new StateModel();
        $country_id = $this->request->getPost('country_id');
        $states = $stateModel->where('country_id', $country_id)->findAll();

        return $this->response->setJSON($states);
    }

   public function processInvoice()
    {
        // Check if the user is already logged in
        $session = session();
        if ($session->get('isLoggedIn')) {
        // if ($session->get('email')) {
            // Redirect or show a message indicating that the user cannot generate another invoice
            return redirect()->to(base_url('dashboard'))->with('error', 'You are already logged in.');
        }


        $validation = \Config\Services::validation();

        $validation->setRules([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|valid_email',
            'phone_number' => 'required',
            'state' => 'required',
            'country' => 'required',
            'address' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }



        

        // Retrieve form data from POST request
        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('phone_number'),
            'state' => $this->request->getPost('state'),
            'country' => $this->request->getPost('country'),
            'address' => $this->request->getPost('address'),
            // 'countries' => $countries,
        ];

        // Check if the user's email already has an invoice generated
        $userModel = new Users(); // Create an instance of the User model

        $user = $userModel->where('email', $data['email'])->first(); // Ensure correct usage of the model

        if ($user && $user['email']) {
            // Redirect or show a message indicating that the user cannot generate another invoice
            return redirect()->to(base_url('generate-invoice'))->with('error', 'The Email has already been used.');
            // return redirect()->to(base_url('generate-invoice'))->with('error', 'You have already generated an invoice.');
        }

       
        // Generate unique registration number
        $registrationNumber = $this->generateRegistrationNumber();

        // Store the invoice generation status in session
        // $session->set('invoice_generated', true);
        // $session->set('email', $data['email']); // Store email in session for future checks

        // Pass registration number and other data to the invoice view
        $data['payment_confirmation_code'] = $registrationNumber;

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