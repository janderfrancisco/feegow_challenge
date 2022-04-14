<?php

namespace App\Controllers\Api;

use App\Models\Schedule;
use App\Services\Feegow;

 
class schedulesController 
{
 
    /**
     * @route   GET /schedules/
     * @desc    Get all schedules
     * @return  JSON
     */
 
    public function index()
    {
        $schedule = new Schedule();
        $result = $schedule->getAll();
        echo json_encode($result);
        exit();  
    }


    /**
     * @route   POST /schedule/
     * @desc    Save schedule
     * @return  JSON
     */
    public function store()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data);
        // convert stdClass to array
        $data = json_decode(json_encode($data), true);

        $schedule = new Schedule();
        $result = $schedule->save($data);
        echo json_encode($result);
    }

}