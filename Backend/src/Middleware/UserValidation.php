<?php
namespace App\Middleware;

use Common\Enum\Enum_RolesUsuarios;
use Common\Util\AutentificadorJWT;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ServerRequestInterface;
use Common\ExceptionManager\ApplicationException;

use Slim\Http\Response as Response;

// require __DIR__ . '/../vendor/autoload.php';


class UserValidation 
{

    public function __invoke(Request $request, RequestHandlerInterface  $handler): Response
    {
        $tokenHeader = $request->getHeader('token');
        var_dump($tokenHeader);
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
        if($tokenData->rolUsuario == Enum_RolesUsuarios::Empleado) {
            // $data = [
            //     'id' => $tokenData->id,
            //     'user' => $tokenData->user,
            //     'type' => $tokenData->type,
            //     'pass' => $tokenData->pass
            // ];
            $request->withAttribute('rolUsuario', $tokenData->rolUsuario);
            $response = $handler->handle($request->withAttribute('rolUsuario', $tokenData->rolUsuario));
            $existingContent = (string) $response->getBody();
        } else {
            $response->getBody()->write(json_encode(array("message" => 'No es User')));
            $resCode = 401;
            return $response->withStatus($resCode);
        }
        
        //$response->getBody()->write('BEFORE ' . $existingContent);

        return $response;
    }
}
