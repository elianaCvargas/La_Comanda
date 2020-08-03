<?php

namespace Controller;

use Common\Dto\ResultDto;
use Common\Mappings\UsuarioDtoMapping;
use PHPUnit\Framework\Exception;
use Common\ExceptionManager\ApplicationException;
use Logic\EmpleadoLogic;
use Logic\SocioLogic;
use PDOException;

include_once __DIR__ . '/../Common/Dto/UsuarioDto.php';
include_once __DIR__ . '/../Logic/UsuarioLogic.php';
include_once __DIR__ . '/../Logic/EmpleadoLogic.php';
include_once __DIR__ . '/../Logic/SocioLogic.php';
include_once __DIR__ . '/../Common/Mappings/UsuarioDtoMapping.php';
include_once __DIR__ . '/../Logic/SocioLogic.php';

class SocioController extends BaseController
{
  public function Crear($request, $response, $next)
  {
    try {
      $datosArray = $request->getParsedBody();
      if (
        $this->ValidateCreateRequest($datosArray, ["nombre", "apellido", "username", "password"])
      ) {
        $user = json_encode($datosArray);
        $socioDto = UsuarioDtoMapping::ToSocioDto($user, false);
        $socioLogic = new SocioLogic();
        $socioLogic->Crear($socioDto);

        $response->getBody()->write("Usuario creado con exito");
        $ok = 201;
        return $response->withStatus($ok);
      } else {
        echo "Faltan definir los campos";
      }
    } catch (ApplicationException $ae) {

      $response->getBody()->write(json_encode(array("message" => $ae->getMessage())));
      $badrequest = 400;
      return $response->withStatus($badrequest);
    } catch (Exception $e) {
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
        $socioDto = UsuarioDtoMapping::ToSocioDto($user, true);
        $socioLogic = new SocioLogic();
        $socioLogic->Modificar($socioDto);

        $response->getBody()->write("Usuario modificado con exito");
        $ok = 201;
        return $response->withStatus($ok);
      } else {
        $response->getBody()->write("Debe definir al menos un campo para modificar e ingresar un id");
        $badrequest = 400;
        return $response->withStatus($badrequest);
      }
    } catch (ApplicationException $ae) {

      $response->getBody()->write(json_encode(array("message" => $ae->getMessage())));
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

        $socioLogic = new SocioLogic();
        $socioLogic->Eliminar($user->id);
        
        $response->getBody()->write("Usuario eliminado con exito");
        $ok = 201;
        return $response->withStatus($ok);
      } else {
        $response->getBody()->write("Debe definir al menos un campo para modificar e ingresar un id");
        $badrequest = 400;
        return $response->withStatus($badrequest);
      }
    } catch (ApplicationException $ae) {
      echo $ae->Message();
    } catch (Exception $e) {
      echo "Algun problema no conocido";
    }
  }
}
