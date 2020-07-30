<?php

namespace Controller;

use Model\Cliente;
use Db\ClienteDb;
use Common\Dto\UsuarioDto;
use Common\Mappings\UsuarioDtoMapping;
use PHPUnit\Framework\Exception;
use Common\ExceptionManager\ApplicationException;
use Controller\BaseController;
use Logic\UsuarioLogic;
use Logic\EmpleadoLogic;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

include_once __DIR__ . '/../Common/Dto/UsuarioDto.php';
include_once __DIR__ . '/../Logic/UsuarioLogic.php';
include_once __DIR__ . '/../Logic/EmpleadoLogic.php';
include_once __DIR__ . '/../Controller/BaseController.php';
include_once __DIR__ . '/../Common/Mappings/UsuarioDtoMapping.php';


class EmpleadoController extends BaseController
{
  public function Crear($request, $response, $args)
  {

    try {
      $datosArray = $request->getParsedBody();
      if ($this->ValidateCreateRequest($datosArray, ["nombre", "apellido", "username", "rolEmpleado"])) 
      {
        $user = json_encode($datosArray);
        $empladoDto = UsuarioDtoMapping::ToUserEmployeeDto($user);
        $empleadoLogic = new EmpleadoLogic();
        $empleadoLogic->Crear($empladoDto);
      } 
      else
      {
        echo "Faltan definir los campos";
      }
    } catch (Exception $e) {
      var_dump($e);
      $response->withJson("Algun problema no conocido");
    } catch (ApplicationException $ae) {
      var_dump($ae);
     echo $ae->Message();
    }
  }

  public function Modificar($request, $response, $args)
  {
    try {
      $datosArray = $request->getParsedBody();
      if (
        $this->ValidateModifyRequest($datosArray, "id", ["nombre", "apellido", "username"])
      ) {
        $user = json_encode($datosArray);
        $empleadoDto = UsuarioDtoMapping::ToUserEmployeeDto($user);
        $empleadoLogic = new EmpleadoLogic();
        $empleadoLogic->Modificar($empleadoDto);
        echo "Modificado con exito";
      } else {
        echo "Debe definir al menos un campo para modificar e ingresar un id";
      }
    } catch (ApplicationException $ae) {
      echo $ae->Message();
     }catch (Exception $e) {
      echo "Algun problema no conocido";
    } 
  }

  public function Eliminar($request, $response, $args)
  {
    try {
      $datosArray = $request->getParsedBody();
      if (
        $this->ValidateDeleteRequest($datosArray, "id")
      ) {
        $obj = json_encode($datosArray);
        $user = json_decode($obj);

        $empleadoLogic = new EmpleadoLogic();
        $empleadoLogic->Eliminar($user->id);
        echo "Eliminado con exito";
      } else {
        echo "Debe definir al menos un campo para modificar y ingresar un id";
      }
    } catch (ApplicationException $ae) {
      echo $ae->Message();
     }catch (Exception $e) {
      echo "Algun problema no conocido";
    } 
  }
}
