<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Controller\UsuarioController;
use Controller\EmpleadoController;

// $routes = require __DIR__ . '/../src/routes/routesPDO.php';
include_once __DIR__ . '/../Controller/EmpleadoController.php';
// include_once __DIR__ . '/../../src/app/modelPDO/cd.php';

// require_once "../app/modelPDO/UsuarioController.php";

return function (App $app) {
    $container = $app->getContainer();  
    $app->group('/mozo', function ($app) {   
        $this->post('', EmpleadoController::class . ':Crear');   
    });

    // $app->group('/mozo', function ($app) {   

    //     $this->post('',UsuarioController::class . ':Crear');   
    // });
};
