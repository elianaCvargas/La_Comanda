<?php
namespace Common\Mappings;

use App\Model\Socio;
use Common\Dto;
use Model\Empleado;

include_once __DIR__ . '/../../Model/Empleado.php';
include_once __DIR__ . '/../../Model/Socio.php';

class UsuarioMapping{	
	public static function ToEmpleado($dto): Empleado
	{
		$usuario = new Empleado($dto->nombre, $dto->apellido, $dto->rolEmpleado, $dto->username);
		return $usuario;
	}

	public static function ToSocio($dto): Socio
	{
		$usuario = new Socio($dto->nombre, $dto->apellido, $dto->username);
		return $usuario;
	}
}
