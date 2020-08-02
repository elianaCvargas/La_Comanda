<?php
namespace Common\Util;
use Firebase\JWT\JWT;
use Exception;


class AutentificadorJWT
{
    private static $claveSecreta = 'ClaveSuperSecreta@';
    private static $tipoEncriptacion = ['HS256'];
    private static $aud = null;
    
    public static function CrearToken($datos)
    {
        $ahora = time();
        /*
         parametros del payload
         https://tools.ietf.org/html/rfc7519#section-4.1
         + los que quieras ej="'app'=> "API REST CD 2019" 
        */
        $payload = array(
        	'iat'=>$ahora,
            'exp' => $ahora + (60 * 30),
            'aud' => self::Aud(),
            'data' => $datos,
            'app'=> "API REST CD UTN FRA"
        );
        return JWT::encode($payload, self::$claveSecreta);
    }
    
    //usar este para validar  una vez que obtengo el token

    public static function VerificarToken($token)
    {
        if(empty($token))
        {
            throw new Exception("El token esta vacio.");
        } 
        // las siguientes lineas lanzan una excepcion, de no ser correcto o de haberse terminado el tiempo       
      
      try {
            $decodificado = JWT::decode(
            $token,
            self::$claveSecreta,
            self::$tipoEncriptacion
        );
        } catch (Exception $e) {
            throw $e;
        } 
        
        // si no da error,  verifico los datos de AUD que uso para saber de que lugar viene  
        if($decodificado->aud !== self::Aud())
        {
            throw new Exception("No es el usuario valido");
        }
    }

    public static function checkToken(string $tokenHeader)
    {
        $token = "";

        if(strpos($tokenHeader, "Bearer ") == 0 || strpos($tokenHeader, "Bearer: ") == 0) {
            $token = explode(" ", $tokenHeader)[1];
        }

        if(empty($token) || $token == "")
        {
            throw new Exception("El token esta vacio.");
        } 
        // las siguientes lineas lanzan una excepcion, de no ser correcto o de haberse terminado el tiempo       
        try
        {
            $decode = JWT::decode(
            $token,
            self::$claveSecreta,
            self::$tipoEncriptacion
            );
        } 
        catch (Exception $e)
        {
            //echo "Clave fuera de tiempo";
           throw new Exception("Clave fuera de tiempo");
        }
        
        // si no da error,  verifico los datos de AUD que uso para saber de que lugar viene  
        if($decode->aud !== self::Aud())
        {
            //echo "No es el usuario valido";
            throw new Exception("No es el usuario valido");
        }
        return true;
    }

    public static function getData($tokenHeader)
    {
        $token = "";

        if(strpos($tokenHeader, "Bearer ") == 0 || strpos($tokenHeader, "Bearer: ") == 0) {
            $token = explode(" ", $tokenHeader)[1];
        }

        return JWT::decode(
            $token,
            self::$claveSecreta,
            self::$tipoEncriptacion
        )->data;
    }
    
   
     public static function ObtenerPayLoad($token)
    {
        return JWT::decode(
            $token,
            self::$claveSecreta,
            self::$tipoEncriptacion
        );
    }
    public static function ObtenerData($token)
    {
        return JWT::decode(
            $token,
            self::$claveSecreta,
            self::$tipoEncriptacion
        )->data;
    }
    private static function Aud()
    {
        $aud = '';
        
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }
        
        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();
        
        return sha1($aud);
    }
}