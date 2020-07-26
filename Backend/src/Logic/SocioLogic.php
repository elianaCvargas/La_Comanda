<?php

namespace Logic;

use Common\Dto\SocioDto;
use Common\Mappings\UsuarioMapping;
use Common\Util\ValidationHelper;
use Db\UsuarioDb;

include_once __DIR__ . '/../Common/Enum/RolesUsuariosEnum.php';
include_once __DIR__ . '/../Common/Enum/RolesEmpleadosEnum.php';
include_once __DIR__ . '/../Common/Mappings/UsuarioMapping.php';
include_once __DIR__ . '/../Common/Util/ValidationHelper.php';
include_once __DIR__ . '/../Common/ExceptionManager/ApplicationException.php';

class SocioLogic
{
  public function Crear(SocioDto $dto)
  {
    $errores = [];
    $erroresUsuario = ValidationHelper::ValidarUsuarioRequest($dto->nombre, $dto->apellido);

    if (count($erroresUsuario) > 0) {
      foreach($errores as $error)
      {
        echo $error."\n";
      }

      return;
    }

    $usuarioNuevo = UsuarioMapping::ToSocio($dto);
    UsuarioDb::createSocio($usuarioNuevo);
  }
}
