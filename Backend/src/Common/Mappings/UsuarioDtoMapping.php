<?php
namespace Common\Mappings;

use Common\Dto;
use Common\Dto\UsuarioDto;
use Common\Dto\EmpleadoDto;
use Common\Dto\SocioDto;
use Model\Empleado;

include_once __DIR__ . '/../../Common/Dto/UsuarioDto.php';
include_once __DIR__ . '/../Dto/EmpleadoDto.php';

class UsuarioDtoMapping{

	// public static function ToUserDto($data){
        // $obj = json_decode($data);
        // $usuarioDto = new UsuarioDto();
        // $usuarioDto->nombre  = $obj->nombre;
        // $usuarioDto->apellido  = $obj->apellido;
        // $usuarioDto->usuario  = $obj->usuario;
        // $usuarioDto->rolUsuario  = $obj->rolUsuario;
        // $usuarioDto->rolEmpleado  = $obj->rolEmpleado;

        // return $usuarioDto;
        // }
        
        public static function ToUserEmployeeDto($data) : EmpleadoDto
        {
                $obj = json_decode($data);
                $empleadoDto = new EmpleadoDto();
                $empleadoDto->nombre  = $obj->nombre;
                $empleadoDto->apellido  = $obj->apellido;
                $empleadoDto->username  = $obj->username;
                $empleadoDto->rolEmpleado  = $obj->rolEmpleado;
                return $empleadoDto;
        }

	public static function ToSocioDto($data) : SocioDto
	{
		$obj = json_decode($data);
		$empleadoDto = new SocioDto();
		$empleadoDto->nombre  = $obj->nombre;
		$empleadoDto->apellido  = $obj->apellido;
		$empleadoDto->username  = $obj->username;
		return $empleadoDto;
	}
}
