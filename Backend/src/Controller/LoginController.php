<?php

namespace Controller;

use Common\Dto\ResultDto;
use Common\Dto\UsuarioCredencialesDto;
use Common\Enum\Enum_RolesEmpleados;
use Common\Enum\Enum_RolesUsuarios;
use Common\ExceptionManager\ApplicationException;
use Common\Mappings\UsuarioCredencialMapping;
use Controller\BaseController;
use Exception;
use Logic\UsuarioLogic;
use Common\Util\AutentificadorJWT;
use Logic\AccesoLogic;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

include_once __DIR__ . '../../Common/Util/AutentificadorJWT.php';
include_once __DIR__ . '../../Common/Mappings/UsuarioCredencialMapping.php';
include_once __DIR__ . '../../Logic/AccesoLogic.php';
class LoginController extends BaseController
{
    public function login($request, $response, $args)
    {
        try {
            $datosArray = $request->getParsedBody();
            if ($this->ValidateCreateRequest($datosArray, ["username", "password"])) {
                $usuarioCredDto = UsuarioCredencialMapping::ToUsuarioCredencialDto($datosArray);
                $usuarioLogic = new UsuarioLogic();
                $usuarioConCredencial = $usuarioLogic->validateUserCredential($usuarioCredDto->username, $usuarioCredDto->password);
                if ($usuarioConCredencial != null ) {
                    $usuarioCredDto->nombre =  $usuarioConCredencial->getNombre();
                    $usuarioCredDto->rolUsuario =  $usuarioConCredencial->getRolUsuarioID();
                    $usuarioCredDto->rolEmpleado =  $usuarioConCredencial->getUserRolEmpleado();
                    $usuarioCredDto->usuarioId =  $usuarioConCredencial->getId();
                    //  var_dump($usuarioCredDto->rolUsuario);
                    $token = AutentificadorJWT::CrearToken($usuarioCredDto, $usuarioCredDto->rolEmpleado);
                    if($usuarioConCredencial->getRolUsuarioID() == Enum_RolesUsuarios::Empleado)
                    {
                        $acceso = new AccesoLogic();
                        $acceso->RegistrarAcceso($usuarioConCredencial->getId(), $usuarioConCredencial->getRolUsuarioID());
                    }
                    $newResponse = $response->withJson($token, 200);
                    return $newResponse;
                }
                else
                {
                    $result = new ResultDto(["Usuario/Contraseña invalida"], false, "Login");
                    return  $response->withJson($result, 401);
                     
                }
            }
        } catch (ApplicationException $ex) {
            return  $response->withJson($ex, 400);
        }
    }

}
