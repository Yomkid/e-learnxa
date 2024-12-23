<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\Role;
use App\Models\Users;
use App\Models\AnnouncementModel;
use App\Models\PendingEmails;
use CodeIgniter\Controller;

class AdminController extends BaseController
{
    protected $announcementModel;
    protected $pendingEmails;
    protected $users;
   

    public function __construct()
    {
        $this->announcementModel = new AnnouncementModel();
        $this->pendingEmails = new PendingEmails();
        $this->users = new Users();
        
    }
    
    public function register()
    {
        return view('/admin/register_admin');
    }

    public function saveAdmin()
    {
        $validation = \Config\Services::validation();
        // $validation = \App\Validation\CustomRules::is_unique_email();

        // Define validation rules
        $validation->setRules([
            // 'first_name' => 'required',
            // 'last_name' => 'required',
            // 'email' => 'required|valid_email|is_unique_email[email]',
            // 'username' => 'required|is_unique[admin.username]',
            // 'password' => 'required|min_length[4]',
            // 'phone' => 'required',
            // 'confirm_password' => 'required|matches[password]',

            'first_name' => [
                'label' => 'First Name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The {field} field is required.'
                ]
            ],
            'last_name' => [
                'label' => 'Last Name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The {field} field is required.'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique_email[email]',
                'errors' => [
                    'required' => 'The {field} field is required.',
                    'valid_email' => 'The {field} field must contain a valid email address.',
                    'is_unique_email' => 'The {field} address already exists in our system.'
                ]
            ],
            'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[admin.username]',
                'errors' => [
                    'required' => 'The {field} field is required.',
                    'is_unique' => 'The {field} already exists in our system.'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'required' => 'The {field} field is required.',
                    'min_length' => 'The {field} must be at least {param} characters long.'
                ]
            ],
            'confirm_password' => [
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'The {field} field is required.',
                    'matches' => 'The {field} field does not match the Password field.'
                ]
            ],
            'phone' => [
                'label' => 'Phone',
                'rules' => 'required',
                'errors' => [
                    'required' => 'The {field} field is required.'
                ]
            ]
        ]);

        // if (!$this->validate($validation->getRules())) {
        //     return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        // }
        // if (!$this->validate($validation->getRules())) {
        //     $errors = $validation->getErrors();
        //     return redirect()->back()->withInput()->with('errors', $errors);
        // }

        if (!$this->validate($validation->getRules())) {
            $errors = $validation->getErrors();
            return redirect()->back()->withInput()->with('errors', $errors)->with('message_type', 'error')->with('message', implode('<br>', $errors));
        }

        $roleModel = new Role();
        $AdminRole = $roleModel->where('role_name', 'Super Admin')->first();

        if (!$AdminRole) {
            return redirect()->back()->withInput()->with('error', 'Default "Super Admin" role not found.');
        }

        $registrationNumber = $this->generateRegistrationNumber();

        // Save admin data
        $adminModel = new AdminModel();
        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('phone'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role_id' => $AdminRole['role_id'],
            'registration_number' => $registrationNumber,
        ];

        if (!$adminModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', 'Failed to register admin.');
        }

        $data['role_name'] = $AdminRole['role_name'];

        $this->sendConfirmationEmail($data);

        return redirect()->to('/login')->with('success', 'Admin registered successfully');
    }

    private function sendConfirmationEmail($data)
    {
        $email = \Config\Services::email();

        $email->setFrom('elearnxa@gmail.com', 'LearnXa');
        $email->setTo($data['email']);
        $email->setSubject('LearnXa Registration Confirmation');

        // Load HTML email template
        $message = view('email_templates/admin_reg_confirmation', $data);

        $email->setMessage($message);

        if ($email->send()) {
            // Log success or perform additional actions upon successful email delivery
            log_message('info', 'Registration confirmation email sent to ' . $data['email']);
        } else {
            // Log failure or handle errors
            log_message('error', 'Failed to send registration confirmation email to ' . $data['email'] . '. Error: ' . $email->printDebugger(['headers']));
        }
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


    public function success()
{
    return view('include/success_message');
}

public function error()
{
    return view('include/error_message');
}


public function Announcements()
{
    // Load the UserModel to fetch user data
    $userModel = new Users();

    // Fetch all users from the database
    $users = $userModel->findAll(); // Ensure the 'users' table exists and contains data

    // Pass the users to the view
    return view('admin/announcements/index', ['users' => $users]);
}

public function sendAnnouncement()
    {
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');
        $recipients = $this->request->getPost('recipients');

        // Retrieve all user emails if "all" is selected
        if (in_array('all', $recipients)) {
            $recipients = array_column($this->users->findAll(), 'email');
        }

        // Handle file uploads
        $uploadedFiles = $this->request->getFiles();
        $attachments = [];

        if ($uploadedFiles && isset($uploadedFiles['attachments'])) {
            foreach ($uploadedFiles['attachments'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(WRITEPATH . 'uploads/attachments', $newName);
                    $attachments[] = WRITEPATH . 'uploads/attachments/' . $newName;
                }
            }
        }

        // Store the announcement in the database
        $announcementId = $this->announcementModel->insert([
            'title' => $title,
            'content' => $content,
            'recipients' => json_encode($recipients),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        if (!$announcementId) {
            return redirect()->back()->with('error', 'Failed to save announcement to the database.');
        }

        // Track email sending status
        $responseMessages = [];
        $allSuccess = true;

        foreach ($recipients as $email) {
            $emailResult = $this->send_email($email, $title, $content, $attachments);

            if ($emailResult['status']) {
                $responseMessages[] = "Successfully sent to {$email}";
            } else {
                $allSuccess = false;
                $responseMessages[] = "Failed to send to {$email}: " . $emailResult['error'];
            }

            // Optional: Insert into a "pending_emails" table for tracking
            $this->pendingEmails->insert([
                'announcement_id' => $announcementId,
                'email' => $email,
                'status' => $emailResult['status'] ? 'sent' : 'failed',
                'error_message' => $emailResult['error'] ?? null,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // Redirect with appropriate message
        if ($allSuccess) {
            return $this->response->setJSON(['message' => 'Announcement sent successfully.']);
        } else {
            return $this->response->setJSON(['error' => implode('<br>', $responseMessages)]);
        }
    }

    private function send_email($to, $subject, $message, $attachments = [])
    {
        $email = \Config\Services::email();

        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);

        // Attach files
        foreach ($attachments as $filePath) {
            $email->attach($filePath);
        }

        try {
            if ($email->send()) {
                return ['status' => true];
            } else {
                return [
                    'status' => false,
                    'error' => $email->printDebugger(['headers']),
                ];
            }
        } catch (\Exception $e) {
            return [
                'status' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
}