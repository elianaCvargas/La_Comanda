<?php

namespace Controller;

use Common\Mappings\UsuarioDtoMapping;
use PHPUnit\Framework\Exception;
use Common\ExceptionManager\ApplicationException;
use Logic\EmpleadoLogic;
use Logic\SocioLogic;

include_once __DIR__ . '/../Model/cliente.php';
include_once __DIR__ . '/../Common/Dto/UsuarioDto.php';
include_once __DIR__ . '/../Logic/UsuarioLogic.php';
include_once __DIR__ . '/../Logic/EmpleadoLogic.php';
include_once __DIR__ . '/../Logic/SocioLogic.php';
include_once __DIR__ . '/../Common/Mappings/UsuarioDtoMapping.php';
include_once __DIR__ . '/../Logic/SocioLogic.php';

class SocioController extends BaseController
{
  public function Crear($request, $response, $args)
  {
    try {
      $datosArray = $request->getParsedBody();
      if (
        $this->ValidateCreateRequest($datosArray, ["nombre", "apellido", "username"])
      ) {
        $user = json_encode($datosArray);
        $empleadoDto = UsuarioDtoMapping::ToSocioDto($user);
        $empleadoLogic = new SocioLogic();
        $empleadoLogic->Crear($empleadoDto);
      } else {
        echo "Faltan definir los campos";
      }
    } catch (Exception $e) {
      $response->withJson("Algun problema no conocido");
    } catch (ApplicationException $ae) {
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
        $empleadoDto = UsuarioDtoMapping::ToSocioDto($user);
        $empleadoLogic = new SocioLogic();
        $empleadoLogic->Modificar($empleadoDto);
      } else {
        echo "Debe definir al menos un campo para modificar y ingresar un id";
      }
    } catch (Exception $e) {
      $response->withJson("Algun problema no conocido");
    } catch (ApplicationException $ae) {
     echo $ae->Message();
    }
  }
}
