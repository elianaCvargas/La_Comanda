<?php
namespace Common\Mappings;

use Common\Dto;
use Model\Empleado;

include_once __DIR__ . '/../../Model/Empleado.php';

class UsuarioMapping{	
        public static function ToUser($dto): Empleado
        {
                $usuario = new Empleado($dto->nombre, $dto->apellido, $dto->username, $dto->rolEmpleado);
                return $usuario;
	}
}
