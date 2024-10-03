<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModuleModel;
use App\Models\LessonModel;
use App\Models\CourseModel;
use App\Models\Users;
use App\Models\VisitorModel;


class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }



public function webStats()
    {
        $visitorModel = new VisitorModel();
        $userModel = new Users();

        // Count total visitors
        $totalVisitors = $visitorModel->countAllResults();

        // Get recent visitors
        $recentVisitors = $visitorModel->getRecentVisitors();

        // Count total members
        $memberCount = $userModel->countAllResults();

        // Prepare data for the view
        $data = [
            'totalVisitors' => $totalVisitors,
            'member_count' => $memberCount,
            'recent_visitors' => $recentVisitors
        ];

        // Load the view with data
        return view('web_stats', $data);
    }

    /**
     * Track visitor information and store it in the database.
     */
    private function trackVisitor()
    {
        $visitorModel = new VisitorModel();

        // Get visitor information
        $ip_address = $this->request->getIPAddress();
        $session_id = session_id();
        $visit_date = date('Y-m-d');
        $user_agent = $this->request->getUserAgent();

        // Check if the visitor is new for the current session and date
        if (!$visitorModel->visitorExists($ip_address, $session_id, $visit_date)) {
            // Insert new visitor data
            $visitorData = [
                'ip_address' => $ip_address,
                'user_agent' => $user_agent,
                'session_id' => $session_id,
                'visit_date' => $visit_date,
            ];
            $visitorModel->insertVisitor($visitorData);
        }
    }

}