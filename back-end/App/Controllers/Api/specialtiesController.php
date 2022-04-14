<?php

namespace App\Controllers\Api;

 
use App\Services\Feegow;

 
class specialtiesController 
{
 
    /**
     * @route   GET /specialties/
     * @desc    Get all specialties
     * @return  JSON
     */
 
    public function index()
    {
        $feegowApi = new Feegow();
        $result = $feegowApi->specialties();
        echo $result;
        exit();  
    }
 
}