<?php
namespace App\Middleware;

use Common\Enum\Enum_RolesUsuarios;
use Common\Util\AutentificadorJWT;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Common\ExceptionManager\ApplicationException;

use Slim\Http\Response as Response;


class UserValidation 
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
        $tokenHeader = $request->getHeader('token');
        $resCode = 200;
        $valid = AutentificadorJWT::checkToken($tokenHeader[0]);
        $tokenData = "";

        if ($valid) {
            $tokenData = AutentificadorJWT::getData($tokenHeader[0]);
        }
        else {
            $response->getBody()->write(json_encode(array("message" => 'Token inválido')));
            return $response->withStatus($resCode);
        }

        if($tokenData->rolUsuario == Enum_RolesUsuarios::Socio) {
            $request->withAttribute('rolUsuario', $tokenData->rolUsuario);
            $response = $next($request, $response);
        } else {
            $response->getBody()->write(json_encode(array("message" => 'No tiene permisos')));
            $resCode = 401;
            return $response->withStatus($resCode);
        }
        return $response;
    }
}
