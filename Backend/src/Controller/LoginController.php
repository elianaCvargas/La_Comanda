<?php

namespace Controller;

use Common\Dto\ResultDto;
use Common\Dto\UsuarioCredencialesDto;
use Common\ExceptionManager\ApplicationException;
use Common\Mappings\UsuarioCredencialMapping;
use Controller\BaseController;
use Exception;
use Logic\UsuarioLogic;
use Common\Util\AutentificadorJWT;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

include_once __DIR__ . '../../Common/Util/AutentificadorJWT.php';
include_once __DIR__ . '../../Common/Mappings/UsuarioCredencialMapping.php';
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
                    $token = AutentificadorJWT::CrearToken($usuarioCredDto);
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

    public function verifyToken($request, $response, $args)
    {        
        $token=null;
        $arrayConToken = $request->getHeader('token');
        
        if($arrayConToken)
        {
            $token=$arrayConToken[0];
        }
        //var_dump($token);
        if  ($token)
        {
             AutentificadorJWT::VerificarToken($token);
             $dataToken = AutentificadorJWT::ObtenerData($token);
            var_dump($dataToken);
            //  $ahora = new \DateTime;
            //  $ahora->format('Y-m-d H:i:s');
            //  $attributes = [
            //     "email" => $dataToken->email,
            //     "clave" => $dataToken->clave,
            //     "fechaIngreso" => $ahora,
            //     "fechaEgreso" => null,
            //     "legajo" => $dataToken->legajo
            //   ];

            // if($this->HayUsuarioLoggeado($attributes))
            // {
            //     return  ExceptionManager::MostrarExcepcion("El usuario se encuentra loggeado.");
            // }

            // Acceso::create($attributes);
            // return "Acceso generado";
        }
        else
        {
             $token=" no psasste el token";
      
        }
        
        return $token;
    }
}
