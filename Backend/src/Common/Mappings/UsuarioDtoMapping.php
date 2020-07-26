<?php
namespace Common\Mappings;

use Common\Dto;
use Common\Dto\UsuarioDto;
use Common\Dto\EmpleadoDto;
use Common\Dto\SocioDto;
use Model\Empleado;

include_once __DIR__ . '/../../Common/Dto/UsuarioDto.php';
include_once __DIR__ . '/../Dto/EmpleadoDto.php';
include_once __DIR__ . '/../Dto/SocioDto.php';

class UsuarioDtoMapping{

	public static function ToClienteDto($data){
        $obj = json_decode($data);
        $usuarioDto = new UsuarioDto();
        $usuarioDto->nombre  = $obj->nombre;
        $usuarioDto->apellido  = $obj->apellido;
        $usuarioDto->username  = $obj->username;
        return $usuarioDto;
        }
        
        public static function ToUserEmployeeDto($data) : EmpleadoDto
        {
                $obj = json_decode($data);
                $empleadoDto = new EmpleadoDto();
                $empleadoDto->id  = $obj->id;
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
                $empleadoDto->id  = $obj->id;
		$empleadoDto->nombre  = $obj->nombre;
		$empleadoDto->apellido  = $obj->apellido;
		$empleadoDto->username  = $obj->username;
		return $empleadoDto;
	}
}
