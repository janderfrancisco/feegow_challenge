<?php
namespace Tests;

use PHPUnit\Framework\TestCase;

use App\Controllers\Api\schedulesController;

class schedulesTest extends TestCase
{

     
    public function testeList()
    {
        $schedules = new schedulesController();
        $this->assertEquals(json_decode(file_get_contents(__DIR__.'/data/schedules.json')), $schedules->index());
    }
 

    public function testStore()
    {
        $schedules = new schedulesController();
        $data = array(
            'professional_id' => 1,
            'specialty_id' => 1,
            'source_id' => 1, 
            'cpf' => 12345678901, 
            'birthdate' => '2022/04/14', 
            'name' => 'Test Test', 
        );

        define('DB_HOST', 'mysql' );
        define('DB_DATABASE_NAME', 'api' );
        define('DB_USERNAME', 'root' );
        define('DB_PASSWORD', 'root' );

        $this->assertGreaterThan(0, $schedules->store($data));
            
    }


}

