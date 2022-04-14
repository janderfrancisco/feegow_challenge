<?php
namespace Tests;

use PHPUnit\Framework\TestCase;

use App\Controllers\Api\professionalsController;

class professionalsTest extends TestCase
{

   
    public function testeListByIdSpecialty()
    {
        $specialty = 89;    
        $professionals= new professionalsController();
        define('API_BASE_URL', 'https://api.feegow.com/v1/api/' );
        define('ACCESS_TOKEN', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOjE2NDQyNDAzODQsImxpY2Vuc2VJRCI6IjEwNSJ9._v3HJr5GUYAc14WW6HDxM5BlxAl-1KJeaqq2OfG67sM' );
        $this->assertEquals(json_decode(file_get_contents(__DIR__.'/data/professionals.json')), $professionals->index($specialty));
    }
 
 
}

