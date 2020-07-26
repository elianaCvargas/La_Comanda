<?php

namespace Logic;

use Common\Dto\EmpleadoDto;
use Common\Enum;
use Common\Enum\Enum_RolesUsuarios;
use Common\Enum\Enum_RolesEmpleados;
use Common\Mappings\UsuarioMapping;
use Db\UsuarioDb;
use Common\Util\ValidationHelper;
use Common\ExceptionManager\ApplicationException;

include_once __DIR__ . '/../Common/Enum/RolesUsuariosEnum.php';
include_once __DIR__ . '/../Common/Enum/RolesEmpleadosEnum.php';
include_once __DIR__ . '/../Common/Mappings/UsuarioMapping.php';
include_once __DIR__ . '/../Common/Util/ValidationHelper.php';
include_once __DIR__ . '/../Common/ExceptionManager/ApplicationException.php';

class EmpleadoLogic
{
  public function Crear(EmpleadoDto $dto)
  {
    $errores = [];
    $erroresEmpleado =  ValidationHelper::ValidarEmpleadoRequest($dto);
    $erroresUsuario = ValidationHelper::ValidarUsuarioRequest($dto->nombre, $dto->apellido);

    if (count($erroresUsuario) > 0 || $erroresEmpleado > 0) {
      $errores = array_merge($erroresUsuario, $erroresEmpleado);
      foreach($errores as $error)
      {
        echo $error."\n";
      }
    }

    $usuarioNuevo = null;
    if ($dto->rolEmpleado == Enum_RolesEmpleados::Cervecero) {
      $usuarioNuevo = UsuarioMapping::ToUser($dto);
      UsuarioDb::create($usuarioNuevo);
    }

  }
}
