<?php
namespace Common\Mappings;

use App\Model\Socio;
use Common\Dto;
use Common\Dto\EmpleadoDto;
use Common\Dto\SocioDto;
use Model\Empleado;
use Model\Usuario;

include_once __DIR__ . '/../../Model/Empleado.php';
include_once __DIR__ . '/../../Model/Socio.php';

class UsuarioMapping{	
	public static function ToEmpleado(EmpleadoDto $dto): Empleado
	{
		$usuario = new Empleado($dto->id, $dto->nombre, $dto->apellido, $dto->rolEmpleado, $dto->username);
		return $usuario;
	}

	public static function dbDataToUsuario($data) : Usuario
	{
		$usuario = new Usuario(intval($data->Id), $data->Nombre, $data->Apellido, $data->Username);
		$usuario->setRolUsuarioID($data->RolUsuarioID);

		return $usuario;
	}

	public static function ToSocio(SocioDto $dto): Socio
	{
		$usuario = new Socio($dto->id, $dto->nombre, $dto->apellido, $dto->username);
		return $usuario;
	}

	public static function usuarioToEmpleado(Usuario $usuario, $rolEmpleado): Empleado
	{
		$usuario = new Empleado($usuario->getId(), $usuario->getNombre(), $usuario->getApellido(), $rolEmpleado, $usuario->getUsername());
		return $usuario;
	}
}
