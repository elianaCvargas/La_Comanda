<?php

use Slim\App;
use Controller\EmpleadoController;
use Controller\SocioController;
use Controller\ProductoController;
use Controller\MesaController;

include_once __DIR__ . '/../Controller/EmpleadoController.php';
include_once __DIR__ . '/../Controller/SocioController.php';
include_once __DIR__ . '/../Controller/ProductoController.php';
include_once __DIR__ . '/../Controller/MesaController.php';

return function (App $app) {
    $container = $app->getContainer();  
    $app->group('/empleado', function ($app) {   
        $this->put('', EmpleadoController::class . ':Modificar');   
        $this->delete('', EmpleadoController::class . ':Eliminar');   
        $this->post('', EmpleadoController::class . ':Crear');   
    });

    $app->group('/socio', function ($app) {   
        $this->post('', SocioController::class . ':Crear');   
        $this->put('', SocioController::class . ':Modificar'); 
        $this->delete('', SocioController::class . ':Eliminar');   

    });

    $app->group('/producto', function ($app) {   
        $this->post('', ProductoController::class . ':Crear');   
        $this->put('', ProductoController::class . ':Modificar');   
        $this->delete('', ProductoController::class . ':Eliminar');   
    });

    $app->group('/mesa', function ($app) {   
        $this->post('', MesaController::class . ':Crear');   
        $this->put('', MesaController::class . ':Modificar');   
        $this->delete('', MesaController::class . ':Eliminar');   
    });
};
