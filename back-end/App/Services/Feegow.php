<?php 

namespace App\Services;

class Feegow 
{
      
    /**
     * get all specialties From Api
     *
     */
    public function specialties()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => API_BASE_URL.'specialties/list' ,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'x-access-token: '.ACCESS_TOKEN,
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return $response;
 
    }



    /**
     * get all professionals From Api
     *
     */
    public function professionals()
    {
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => API_BASE_URL.'professional/list' , 
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'x-access-token: '.ACCESS_TOKEN,
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }
    /**
     * get all sources From Api
     *
     */
    public function sources()
    {
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => API_BASE_URL.'patient/list-sources' , 
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'x-access-token: '.ACCESS_TOKEN,
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }


 
}