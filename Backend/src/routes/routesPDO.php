<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\PDO\UsuarioController;

// $routes = require __DIR__ . '/../src/routes/routesPDO.php';
include_once __DIR__ . '/../../src/App/modelPDO/UsuarioController.php';
// include_once __DIR__ . '/../../src/app/modelPDO/cd.php';

// require_once "../app/modelPDO/UsuarioController.php";

return function (App $app) {
    $container = $app->getContainer();  

    
    $app->group('/user', function ($app) {   

        $this->post('',UsuarioController::class . ':TraerUno');   
            
        // $todosLosCds=cd::TraerTodoLosCds();
        // $newResponse = $response->withJson($todosLosCds, 200);  
        // return $newResponse;
    });
};
