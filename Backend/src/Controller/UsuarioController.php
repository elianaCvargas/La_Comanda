<?php
namespace Controller;
use Model\Cliente;
use Db\ClienteDb;
use Common\Dto\UsuarioDto;
use Common\Mappings\UsuarioDtoMapping;
use Logic\UsuarioLogic;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

include_once __DIR__ . '/../../src/Model/cliente.php';
include_once __DIR__ . '/../../src/Db/ClienteDb.php';
include_once __DIR__ . '/../../src/Common/Dto/UsuarioDto.php';
include_once __DIR__ . '/../../src/Logic/UsuarioLogic.php';
include_once __DIR__ . '/../../src/Common/Mappings/UsuarioDtoMapping.php';



class UsuarioController
{
    public function Crear($request, $response, $args) {
      $datosArray = $request->getParsedBody();
      if(isset($datosArray["nombre"]) && isset($datosArray["apellido"]) && isset($datosArray["usuario"]) 
      && isset($datosArray["rolUsuario"]) && isset($datosArray["rolEmpleado"]))
      {
        $user = json_encode($datosArray);
        $this->ValidarDatosEntrada($datosArray);
        $usuarioDto = UsuarioDtoMapping::ToUserDto($user);
        $usuarioLogic = new UsuarioLogic();
        $usuarioLogic->Crear($usuarioDto);
      } 
      else{

        echo "Faltan definir los campos";
      }  

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

    private function ValidarDatosEntrada($attributes)
    {
      $errores = "";
      $cont = 0;
      if($attributes["nombre"] == "" || $attributes["nombre"] == null)
      {
          $errores = $errores."Debe ingresar un nombre.\n";
          $cont++;
      }
      else
      {
          if(intval($attributes["apellido"]) > 1000 || intval($attributes["apellido"]) < 1)
          {
              $errores = $errores."Debe ingresar un apellido.\n";
              $cont++;
          }
      }

      if($attributes["usuario"] == "" || $attributes["usuario"] == null)
      {
          $errores = $errores."Debe ingresar un usuario.\n";
          $cont++;
      }

      if($attributes["rolUsuario"] == "" || $attributes["rolUsuario"] == null )
      {
          $errores = $errores."Debe ingresar un rol.\n";
          $cont++;
      }
      
      if($cont >= 1)
      {
         // ExceptionManager::MostrarExcepcion("\n".$errores);
          return false;
      }
      return true;
    }
}