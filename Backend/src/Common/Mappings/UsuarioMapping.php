<?php
namespace Common\Mappings;

use Common\Dto;
use Model\Cliente;

include_once __DIR__ . '/../../Model/cliente.php';

class UsuarioMapping{	
	public static function ToUser($dto){
        
        $usuario = new Cliente($dto->usuario, $dto->nombre,$dto->apellido, 0);
        $usuario->rolUsuario  = $dto->rolUsuario;
        $usuario->rolEmpleado  = $dto->rolEmpleado;

        return $usuario;
	}
}
?>