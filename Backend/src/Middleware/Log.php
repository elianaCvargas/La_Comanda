<?php

namespace App\Middleware;

use Common\Util\AutentificadorJWT;
use Exception;
use View\LogView;
include_once __DIR__ . '/../View/logView.php';


class Log
{
    public function __invoke($request, $response, $next)
	{
        $datosArray = $request->getParsedBody();

		$ruta = $request->getRequestTarget();
		$metodo = $request->getMethod();
		$ip = $request->getServerParam('REMOTE_ADDR');
		$fecha = date('Y-m-d H:i:s', $request->getServerParam('REQUEST_TIME'));

		$info=array();
		$metodo=$request->getMethod();
		$uri=$request->getUri()->getBaseUrl();
		$ruta=$request->getUri()->getPath();
        $hora=$fecha;
        
        $log = new LogView();
        $log->metodoHttp = $metodo;
        $log->uri = $uri;
        $log->ruta = $ruta;
        $log->hora = $hora;
        $log->username = $datosArray["username"];

        $info = $log;
		$file = fopen( __DIR__. '/../Log/logs.txt', "a");
		fwrite($file, json_encode($info));
		fclose($file);

	   return $next($request, $response);
	}
}
