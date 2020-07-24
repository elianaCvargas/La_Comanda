<?php
namespace Logic;

use Common\Enum;
use Common\Enum\Enum_RolesUsuarios;
use Common\Enum\Enum_RolesEmpleados;
use Common\Mappings\UsuarioMapping;
use Db\ClienteDb;
include_once __DIR__ . '/../../src/Common/Enum/RolesUsuariosEnum.php';
include_once __DIR__ . '/../../src/Common/Enum/RolesEmpleadosEnum.php';
include_once __DIR__ . '/../../src/Common/Mappings/UsuarioMapping.php';
include_once __DIR__ . '/../../src/Db/ClienteDb.php';

class UsuarioLogic
{

    public function Crear($dto) {
      $existeRolUsuario = Enum_RolesUsuarios::getEnumValue($dto->rolUsuario);
      $usuarioNuevo = null;
      if($existeRolUsuario > 0 && $existeRolUsuario == Enum_RolesUsuarios::Empleado)
      {
        $existeRolEmpleado = Enum_RolesEmpleados::getEnumValue($dto->rolEmpleado);
        if($existeRolEmpleado > 0 && $existeRolEmpleado == Enum_RolesEmpleados::Cervecero)
        {
          $usuarioNuevo = UsuarioMapping::ToUser($dto);
		var_dump($usuarioNuevo);

          ClienteDb::create($usuarioNuevo);
    //  	$newResponse = $response->withJson("sin completar", 200);  
    // 	return $newResponse;
          
        }
      }
    //   ClienteDb::create($user);
    //  	$newResponse = $response->withJson("sin completar", 200);  
    // 	return $newResponse;
    }
   
}