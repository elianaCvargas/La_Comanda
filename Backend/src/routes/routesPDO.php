<?php

use App\Middleware\Log;
use App\Middleware\MozoValidation;
use App\Middleware\SocioValidation;
use App\Middleware\ResponsableValidation;
use App\Middleware\UserValidation;
use Slim\App;
use Controller\EmpleadoController;
use Controller\SocioController;
use Controller\ProductoController;
use Controller\MesaController;
use Controller\PedidoController;
use Controller\FileController;
use Controller\LoginController;

include_once __DIR__ . '/../Controller/EmpleadoController.php';
include_once __DIR__ . '/../Controller/SocioController.php';
include_once __DIR__ . '/../Controller/ProductoController.php';
include_once __DIR__ . '/../Controller/MesaController.php';
include_once __DIR__ . '/../Controller/PedidoController.php';
include_once __DIR__ . '/../Controller/FileController.php';
include_once __DIR__ . '/../Controller/LoginController.php';
include_once __DIR__ . '/../Middleware/SocioValidation.php';
include_once __DIR__ . '/../Middleware/MozoValidation.php';
include_once __DIR__ . '/../Middleware/ResponsableValidation.php';
include_once __DIR__ . '/../Middleware/UserValidation.php';
include_once __DIR__ . '/../Middleware/Log.php';

return function (App $app) {
    $container = $app->getContainer();  
    $app->group('/empleado', function ($app) {   
        $this->put('', EmpleadoController::class . ':Modificar')->add(new SocioValidation());   
        $this->delete('', EmpleadoController::class . ':Eliminar')->add(new SocioValidation());   
        $this->post('', EmpleadoController::class . ':Crear')->add(new SocioValidation());   
        $this->get('/pendientes', EmpleadoController::class . ':GetPedidosByRol')->add(new UserValidation());   
        
    });

    $app->group('/socio', function ($app) {   
        $this->post('', SocioController::class . ':Crear')->add(new SocioValidation());   
        $this->put('', SocioController::class . ':Modificar')->add(new SocioValidation()); 
        $this->delete('', SocioController::class . ':Eliminar')->add(new SocioValidation());   

    });

    $app->group('/producto', function ($app) {   
        $this->post('', ProductoController::class . ':Crear');   
        $this->put('', ProductoController::class . ':Modificar');   
        $this->delete('', ProductoController::class . ':Eliminar');   
    });

    $app->group('/mesa', function ($app) {   
        $this->post('', MesaController::class . ':Crear');   
        $this->put('/modificarEstado', MesaController::class . ':ModificarEstado');   
        $this->put('/modificarPuntaje', MesaController::class . ':ModificarPuntaje');   
        $this->delete('', MesaController::class . ':Eliminar');   
    });

    $app->group('/pedido', function ($app) {   
        $this->post('', PedidoController::class . ':Crear')->add(new MozoValidation());   
        $this->put('/modificarEstado', PedidoController::class . ':ModificarEstado')->add(new MozoValidation());   
        $this->delete('', PedidoController::class . ':Eliminar');    

        $this->put('/modificarEstadoDetalle', PedidoController::class . ':ModificarEstadoDetalle')->add(new ResponsableValidation());
        $this->put('/modificarPuntajeDetalle', PedidoController::class . ':ModificarPuntajeDetalle');
        $this->put('/modificarPuntajes', PedidoController::class . ':ModificarPuntajes');   

    });

    $app->group('/file', function ($app) {   
        $this->post('', FileController::class . ':subirFoto');   
    });

    $app->group('/login', function ($app) {   
        $this->post('', LoginController::class . ':login')->add(new Log());   
        $this->post('/verifyToken', LoginController::class . ':verifyToken'); 
    });
};
