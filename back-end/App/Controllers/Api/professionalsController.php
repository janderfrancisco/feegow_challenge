<?php

namespace App\Controllers\Api;

use App\Services\Feegow;
 
class professionalsController 
{
 
    /**
     * @route   GET /professionals/{id_specialty}
     * Param    id_specialty int 
     * @desc    Get all professionals
     * @return  JSON
     */
 
    public function index($id_specialty)
    {
        $feegowApi = new Feegow();
        $result = $feegowApi->professionals();
 
        if ($id_specialty) {
            $result = json_decode($result);

            $result = $result->content;
            

            // percorre todos os profissionais
            $result = array_filter($result, function($item) use ($id_specialty) {

                $addItem = false;
                // percorre o array de especialidades do profissional, se encontrar a especialidade desejada, vamos retornar o profissional
                foreach ($item->especialidades as $value) {
                    if ($value->especialidade_id == $id_specialty) 
                        $addItem = true;
                }

                if ($addItem) 
                    return $item;
            });
            // retorna o array com os profissionais filtrados
            $result = array_values($result);
        }else{
            $result = array(
                'error' => 'id_specialty is required'
            );
        }


        echo json_encode($result);
        exit();  

      
    }

 

}