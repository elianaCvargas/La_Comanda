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
<<<<<<< HEAD
    // public function Crear($request, $response, $args) {
    //   $datosArray = $request->getParsedBody();
    //   if($this->ValidateRequest($datosArray, ["nombre", "apellido", "username"]))
    //   {
    //     $user = json_encode($datosArray);
    //     $this->ValidarDatosEntrada($datosArray);
    //     $usuarioDto = UsuarioDtoMapping::ToClienteDto($user);
    //     $usuarioLogic = new UsuarioLogic();
    //     $usuarioLogic->Crear($usuarioDto);
    //   } 
    //   else{
    //     echo "Faltan definir los campos";
    //   }  
    // }
=======
    public function Crear($request, $response, $args) {
      $datosArray = $request->getParsedBody();
      if($this->ValidateCreateRequest($datosArray, ["nombre", "apellido", "username"]))
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
>>>>>>> 1988b88b213642c17af1245daca2d0a0beaa6e95
   
}