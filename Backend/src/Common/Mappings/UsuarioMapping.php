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

class UsuarioMapping
{
	public static function ToEmpleado(EmpleadoDto $dto): Empleado
	{
		$usuario = new Empleado($dto->id, $dto->nombre, $dto->apellido, $dto->rolEmpleado, $dto->username, $dto->password);
		return $usuario;
	}



	public static function ToSocio(SocioDto $dto): Socio
	{
		$usuario = new Socio($dto->id, $dto->nombre, $dto->apellido, $dto->username, $dto->password);
		return $usuario;
	}

	public static function dbDataToUsuario($data): Empleado
	{

		$empleado = new Empleado(intval($data->Id), $data->Nombre, $data->Apellido, intval($data->RolEmpleadoID), $data->Username, $data->Password);
		return $empleado;
	}

	public static function usuarioToEmpleado(Usuario $usuario, $rolEmpleado): Empleado
	{
		$usuario = new Empleado(
			$usuario->getId(),
			$usuario->getNombre(),
			$usuario->getApellido(),
			$rolEmpleado,
			$usuario->getUsername(),
			$usuario->getPassword()
		);
		return $usuario;
	}
}
