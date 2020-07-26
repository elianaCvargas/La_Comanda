<?php

namespace Controller;

use Common\Mappings\UsuarioDtoMapping;
use PHPUnit\Framework\Exception;
use Common\ExceptionManager\ApplicationException;
use Logic\EmpleadoLogic;

include_once __DIR__ . '/../Model/cliente.php';
include_once __DIR__ . '/../Common/Dto/UsuarioDto.php';
include_once __DIR__ . '/../Logic/UsuarioLogic.php';
include_once __DIR__ . '/../Logic/EmpleadoLogic.php';
include_once __DIR__ . '/../Common/Mappings/UsuarioDtoMapping.php';


class SocioController extends BaseController
{
  public function Crear($request, $response, $args)
  {

    try {
      $datosArray = $request->getParsedBody();
      if (
        isset($datosArray["nombre"]) && isset($datosArray["apellido"]) && isset($datosArray["dni"])
        && isset($datosArray["telefono"]) && isset($datosArray["rolEmpleado"])
      ) {
        $user = json_encode($datosArray);
        $empladoDto = UsuarioDtoMapping::ToUserEmployeeDto($user);
        $empleadoLogic = new EmpleadoLogic();
        $empleadoLogic->Crear($empladoDto);
      } else {

        echo "Faltan definir los campos";
      }
    } catch (Exception $e) {
      $response->withJson("Algun problema no conocido");
    } catch (ApplicationException $ae) {
     echo $ae->Message();
    }
  }
}
