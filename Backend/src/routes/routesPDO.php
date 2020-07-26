<?php

use Slim\App;
use Controller\EmpleadoController;
use Controller\SocioController;

include_once __DIR__ . '/../Controller/EmpleadoController.php';
include_once __DIR__ . '/../Controller/SocioController.php';

return function (App $app) {
    $container = $app->getContainer();  
    $app->group('/mozo', function ($app) {   
        $this->post('', EmpleadoController::class . ':Crear');   
    });

    $app->group('/socio', function ($app) {   
        $this->post('', SocioController::class . ':Crear');   
    });
};
