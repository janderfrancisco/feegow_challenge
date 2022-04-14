<?php 

    require_once "config/setup.php";
    require_once "vendor/autoload.php";
    use App\Controllers\Api\specialtiesController;
    use App\Controllers\Api\professionalsController;
    use App\Controllers\Api\sourcesController;
    use App\Controllers\Api\schedulesController;

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode( '/', $uri );
     
   // valida url requisita está na lista de rotas que está no arquivo config/setup.php
    if ((isset($uri[1]) && !in_array($uri[1], VALID_ROUTES))) {
        header("HTTP/1.1 404 Route not Found");
        exit();
    }
 
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
    header('Content-Type: application/json; charset=utf-8');


    // chama o controller e a action de acordo com a rota passada
    switch ($uri[1]) {
        case 'specialties':
            $controller = new specialtiesController();
            break;
        case 'professionals':
            $controller = new professionalsController();
            break;     
        case 'sources':
            $controller = new sourcesController();
            break; 
        case 'schedules':
            $controller = new schedulesController();
            break;     
        default:
            # code...
            break;
    }

 
 
    $method = $uri[2];

    if (isset($uri[3])) {
        $id = $uri[3];
        $controller->{$method}($id);
    }else{
        $controller->{$method}();
    }

   



?>