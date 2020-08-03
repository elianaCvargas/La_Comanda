<?php

namespace Controller;

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
      if ($this->ValidateCreateRequest($datosArray, ["nombre", "apellido", "username", "rolEmpleado", "password"])) {
        $user = json_encode($datosArray);
        $empladoDto = UsuarioDtoMapping::ToUserEmployeeDto($user, false);
        $empleadoLogic = new EmpleadoLogic();
        $empleadoLogic->Crear($empladoDto);

        $response->getBody()->write("Usuario creado con exito");
        $ok = 201;
        return $response->withStatus($ok);
      } else {
        $response->getBody()->write("Faltan definir los campos");
        $badrequest = 400;
        return $response->withStatus($badrequest);
      }
    } catch (ApplicationException $ae) {
      $response->getBody()->write($ae->Message());
      $badrequest = 400;
      return $response->withStatus($badrequest);
    } catch (Exception $e) {
      var_dump($e);
      $response->withJson("Algun problema no conocido");
    }
  }

  public function Modificar($request, $response, $args)
  {
    try {
      $datosArray = $request->getParsedBody();
      if (
        $this->ValidateModifyRequest($datosArray, "id", ["nombre", "apellido", "username", "password"])
      ) {
        $user = json_encode($datosArray);
        $empleadoDto = UsuarioDtoMapping::ToUserEmployeeDto($user, true);
        $empleadoLogic = new EmpleadoLogic();
        $empleadoLogic->Modificar($empleadoDto);

        $response->getBody()->write("Usuario modificado con exito");
        $ok = 201;
        return $response->withStatus($ok);
      } else {
        $response->getBody()->write("Faltan definir los campos");
        $badrequest = 400;
        return $response->withStatus($badrequest);
      }
    } catch (ApplicationException $ae) {
      $response->getBody()->write($ae->Message());
      $badrequest = 400;
      return $response->withStatus($badrequest);
    } catch (Exception $e) {
      $response->withJson("Algun problema no conocido");
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

        $response->getBody()->write("Usuario eliminado con exito");
        $ok = 201;
        return $response->withStatus($ok);
      } else {
        $response->getBody()->write("Faltan definir los campos");
        $badrequest = 400;
        return $response->withStatus($badrequest);
      }
    } catch (ApplicationException $ae) {
      $response->getBody()->write($ae->Message());
      $badrequest = 400;
      return $response->withStatus($badrequest);
    } catch (Exception $e) {
      echo "Algun problema no conocido";
    }
  }
}
