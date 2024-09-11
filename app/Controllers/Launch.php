<?php namespace App\Controllers;

class Launch extends BaseController
{
    public function index()
    {
        // $config = new \App\Config\LaunchConfig();
        
        // // Log or debug to check controller execution
        // log_message('debug', 'LaunchController - isLaunched: ' . ($config->isLaunched ? 'true' : 'false'));

        // // Render launch view or redirect based on the launch status
        // if (!$config->isLaunched) {
            return view('launch'); // Render launch view if not launched
        // }

        // return redirect()->to('/'); // Redirect to home if launched
    }
}
