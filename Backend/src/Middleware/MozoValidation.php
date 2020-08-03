<?php

namespace App\Middleware;

use Common\Enum\Enum_RolesEmpleados;
use Common\Enum\Enum_RolesUsuarios;
use Common\Util\AutentificadorJWT;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Common\ExceptionManager\ApplicationException;
use Exception;
use Slim\Http\Response as Response;


class MozoValidation
{
    /**
     * Example middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
        try {
            $tokenHeader = $request->getHeader('token');

            if($tokenHeader == null)
            {
                throw new Exception("Requiere permisos para ingresar");
            }
            
            $resCode = 200;
            $valid = AutentificadorJWT::checkToken($tokenHeader[0]);
            $tokenData = "";

            if ($valid) {
                $tokenData = AutentificadorJWT::getData($tokenHeader[0]);
            } else {
                $response->getBody()->write(json_encode(array("message" => 'Token inválido')));
                return $response->withStatus($resCode);
            }

            if ($tokenData->rolUsuario == Enum_RolesUsuarios::Empleado && $tokenData->rolEmpleado == Enum_RolesEmpleados::Mozo) {
                $request->withAttribute('rolEmpleado', $tokenData->rolEmpleado);
                $response = $next($request, $response);
            } else {
                $response->getBody()->write(json_encode(array("message" => 'No tiene permisos')));
                $resCode = 401;
                return $response->withStatus($resCode);
            }
            return $response;
        } catch (Exception $ex) {
            $response->getBody()->write(json_encode(array("message" => $ex->getMessage())));
            $badrequest = 400;
            return $response->withStatus($badrequest);
        }
    }
}
