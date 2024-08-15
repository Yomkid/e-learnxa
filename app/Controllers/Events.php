<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Event;

class Events extends BaseController
{
    public function index()
    {
        $data['metaDescription'] = 'Integrate FullCalendar in Codeigniter';
        $data['metaKeywords'] = 'Integrate FullCalendar in Codeigniter';
        $data['title'] = "Integrate FullCalendar in Codeigniter | TechArise";
        $data['breadcrumbs'] = array('Integrate FullCalendar in Codeigniter' => '#');
        return view('admin/calendar/calendar', $data);
    }

    // load event data
    public function loadEventData() {
        $json = array();
        $dataInfo = $this->event->eventList();       
        foreach($dataInfo as $element) {
            $json[] = array(
                'title' =>$element['title'],
                'start' => date('Y-m-d G:i:s', $element['start_date']),
                'type' => 'gc_event',
                'color' => '#1D8FA3',
                'textColor' => '#FFFFFF',
                'class' => 'gcal-day-grid',
            );
        }
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json, true);
    }
}
