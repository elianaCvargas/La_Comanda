<?php

namespace Logic;

use Common\Dto\EmpleadoDto;
use Common\Enum\Enum_RolesEmpleados;
use Common\Mappings\UsuarioMapping;
use Db\UsuarioDb;
use Common\Util\ValidationHelper;

include_once __DIR__ . '/../Common/Enum/RolesUsuariosEnum.php';
include_once __DIR__ . '/../Common/Enum/RolesEmpleadosEnum.php';
include_once __DIR__ . '/../Common/Mappings/UsuarioMapping.php';
include_once __DIR__ . '/../Common/Util/ValidationHelper.php';
include_once __DIR__ . '/../Common/ExceptionManager/ApplicationException.php';
include_once __DIR__ . '/../Db/UsuarioDb.php';

class EmpleadoLogic
{
  public function Crear(EmpleadoDto $dto)
  {
    $errores = [];
    $erroresEmpleado =  ValidationHelper::ValidarEmpleadoRequest($dto);
    $erroresUsuario = ValidationHelper::ValidarUsuarioRequest($dto->nombre, $dto->apellido, $dto->username);

    if (count($erroresUsuario) > 0 || $erroresEmpleado > 0) {
      $errores = array_merge($erroresUsuario, $erroresEmpleado);
      foreach($errores as $error)
      {
        echo $error."\n";
        return "";
      }
    }

    $usuarioNuevo = UsuarioMapping::ToEmpleado($dto);
    UsuarioDb::createEmpleado($usuarioNuevo);
  }
}
