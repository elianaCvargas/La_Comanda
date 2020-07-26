<?php
namespace Controller;
use Common\Mappings\UsuarioDtoMapping;
use Logic\UsuarioLogic;
use Controller\BaseController;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

include_once __DIR__ . '/../Model/cliente.php';
include_once __DIR__ . '/../Db/ClienteDb.php';
include_once __DIR__ . '/../Common/Dto/UsuarioDto.php';
include_once __DIR__ . '/../Logic/UsuarioLogic.php';
include_once __DIR__ . '/../Common/Mappings/UsuarioDtoMapping.php';
include_once __DIR__ . '/../Controller/BaseController.php';



class ClienteController extends BaseController
{
    public function Crear($request, $response, $args) {
      $datosArray = $request->getParsedBody();
      if($this->ValidateRequest($datosArray, ["nombre", "apellido", "username"]))
      {
        $user = json_encode($datosArray);
        $this->ValidarDatosEntrada($datosArray);
        $usuarioDto = UsuarioDtoMapping::($user);
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