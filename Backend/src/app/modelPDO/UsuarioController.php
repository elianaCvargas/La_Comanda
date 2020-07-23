<?php
namespace App\Models\PDO;
use Model\Cliente;
use Persistence\ClienteRepository;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

include_once __DIR__ . '/../../Model/cliente.php';
include_once __DIR__ . '/../../Persistence/ClienteRepository.php';


class UsuarioController
{
 	public function Bienvenida($request, $response, $args) {
      $response->getBody()->write("GET => Bienvenido!!! ,a SlimFramework");
    
    return $response;
    }

    public static function TraerUno($request, $response, $args) {
       //complete el codigo
      $user = new Cliente("Javier@jave", "Manco", "Arabe", 1);
      ClienteRepository::create($user);
     	$newResponse = $response->withJson("sin completar", 200);  
    	return $newResponse;
    }
   
      public function CargarUno($request, $response, $args) {
     	 //complete el codigo
     	$newResponse = $response->withJson("sin completar", 200);  
        return $response;
    }
      public function BorrarUno($request, $response, $args) {
  		//complete el codigo
     	$newResponse = $response->withJson("sin completar", 200);  
      	return $newResponse;
    }
     
     public function ModificarUno($request, $response, $args) {
     	//complete el codigo
     	$newResponse = $response->withJson("sin completar", 200);  
		return 	$newResponse;
    }
}