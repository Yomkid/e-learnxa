<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\VisitorModel;

class VisitorTracker extends Controller
{
    protected $visitorModel;

    public function __construct()
    {
        $this->visitorModel = new VisitorModel();
        $this->logVisit();
    }

    private function logVisit()
    {
        $data = [
            'ip_address' => $this->request->getServer('REMOTE_ADDR'),
            'user_agent' => $this->request->getUserAgent()->getAgentString(),
        ];
        $this->visitorModel->insert($data);
    }
}
