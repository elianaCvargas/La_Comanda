<?php
namespace Common\Mappings;

use Common\Dto;
use Common\Dto\UsuarioDto;

include_once __DIR__ . '/../../Common/Dto/UsuarioDto.php';

class UsuarioDtoMapping{	
	public static function ToUserDto($data){
        $obj = json_decode($data);
        $usuarioDto = new UsuarioDto();
        $usuarioDto->nombre  = $obj->nombre;
        $usuarioDto->apellido  = $obj->apellido;
        $usuarioDto->usuario  = $obj->usuario;
        $usuarioDto->rolUsuario  = $obj->rolUsuario;
        $usuarioDto->rolEmpleado  = $obj->rolEmpleado;

        return $usuarioDto;
	}
}
?>