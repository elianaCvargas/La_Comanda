<?php

namespace Logic;

use Common\Dto\ClienteDto;
use Common\Mappings\UsuarioMapping;
use Common\Util\ValidationHelper;
use Db\UsuarioDb;

include_once __DIR__ . '/../Common/Enum/RolesUsuariosEnum.php';
include_once __DIR__ . '/../Common/Enum/RolesEmpleadosEnum.php';
include_once __DIR__ . '/../Common/Mappings/UsuarioMapping.php';
include_once __DIR__ . '/../Common/Util/ValidationHelper.php';
include_once __DIR__ . '/../Common/ExceptionManager/ApplicationException.php';
include_once __DIR__ . '/../Common/Dto/ClienteDto.php';

class SocioLogic
{
  public function Crear(ClienteDto $dto)
 {
  //   $errores = [];
  //   $erroresUsuario = ValidationHelper::ValidarUsuarioRequest($dto->nombre, $dto->apellido, $dto->username);

  //   if (count($erroresUsuario) > 0) {
  //     foreach($errores as $error)
  //     {
  //       echo $error."\n";
  //     }

  //     return;
  //   }

    // $usuarioNuevo = UsuarioMapping:($dto);
    // UsuarioDb::createSocio($usuarioNuevo);
  }
}
