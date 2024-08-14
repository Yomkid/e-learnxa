<?php namespace App\Controllers;

use App\Models\CourseEnrollmentModel;
use CodeIgniter\Controller;

class PaystackController extends Controller
{
    private $paystackSecretKey = 'pk_test_18bd358872baeae63db2133cc291cd2e92df0015';

    public function checkout()
    {
        $user_id = $this->request->getPost('user_id');
        $course_id = $this->request->getPost('course_id');
        $price = $this->request->getPost('price');

        $model = new CourseEnrollmentModel();

        // Insert the enrollment record
        $data = [
            'user_id' => $user_id,
            'course_id' => $course_id,
            'enrollment_date' => date('Y-m-d H:i:s'),
            'price' => $price,
            'status' => 'pending',
            'payment_status' => 'pending'
        ];

        $enrollment_id = $model->insert($data);

        if ($enrollment_id) {
            $reference = uniqid(); // Generate a unique reference for the transaction

            $postData = [
                'email' => 'odewayemayomi@gmail.com', // Replace with the user's email
                'amount' => $price * 100, // Amount in kobo
                'reference' => $reference, // Unique payment reference
                'callback_url' => base_url('paystack/callback?enrollment_id=' . $enrollment_id)
            ];

            $response = $this->initializePayment($postData);

            if ($response->status) {
                return $this->response->setJSON([
                    'success' => true,
                    'redirect_url' => $response->data->authorization_url
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Payment initialization failed'
                ]);
            }
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Enrollment failed'
            ]);
        }
    }

    private function initializePayment($postData)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->request('POST', 'https://api.paystack.co/transaction/initialize', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->paystackSecretKey,
                'Content-Type' => 'application/json'
            ],
            'json' => $postData
        ]);

        return json_decode($response->getBody());
    }

    public function callback()
    {
        $enrollment_id = $this->request->getGet('enrollment_id');
        $reference = $this->request->getGet('reference');
        
        // Verify the payment
        $verificationResponse = $this->verifyPayment($reference);

        if ($verificationResponse->status) {
            $status = $verificationResponse->data->status;

            if ($status === 'success') {
                $model = new CourseEnrollmentModel();
                $model->update($enrollment_id, [
                    'payment_status' => 'completed',
                    'status' => 'active'
                ]);
                session()->remove('course_data'); // Clear session data
                return redirect()->to('/course/thank-you');
            }
        }
        
        return redirect()->to('/payment-failed');
    }

    private function verifyPayment($reference)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', 'https://api.paystack.co/transaction/verify/' . $reference, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->paystackSecretKey
            ]
        ]);

        return json_decode($response->getBody());
    }
}
