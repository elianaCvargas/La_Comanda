<?php

namespace Common\Mappings;

use Common\Dto;
use Common\Dto\UsuarioCredencialesDto;

include_once __DIR__ . '../../Dto/UsuarioCredencialesDto.php';


class UsuarioCredencialMapping
{
    public static function ToUsuarioCredencialDto($datosArray): UsuarioCredencialesDto
    {
        $data = json_encode($datosArray);
        $obj = json_decode($data);
        $usuario = new UsuarioCredencialesDto();
        $usuario->nombre = null;
        $usuario->username = $obj->username;
        $usuario->password = $obj->password;
        $usuario->rolUsuario = null;
        $usuario->rolEmpleado = null;
        return $usuario;
    }



}
