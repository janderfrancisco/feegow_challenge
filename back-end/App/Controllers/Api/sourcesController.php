<?php

namespace App\Controllers\Api;

use App\Services\Feegow;
 
class sourcesController 
{
 
    /**
     * @route   GET /sources
     * @desc    Get all sources
     * @return  JSON
     */
 
    public function index()
    {
        $feegowApi = new Feegow();
        $result = $feegowApi->sources();
        echo $result;
        exit();  
    
    }

}