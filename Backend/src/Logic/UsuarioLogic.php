<?php

namespace Logic;

use Common\Dto\EmpleadoDto;
use Common\Enum;
use Common\Enum\Enum_RolesUsuarios;
use Common\Enum\Enum_RolesEmpleados;
use Common\Mappings\UsuarioMapping;
use Db\ClienteDb;
use Common\Util\ValidationHelper;
use Common\Dto\UsuarioDto;

include_once __DIR__ . '/../Common/Enum/RolesUsuariosEnum.php';
include_once __DIR__ . '/../Common/Enum/RolesEmpleadosEnum.php';
include_once __DIR__ . '/../Common/Mappings/UsuarioMapping.php';
include_once __DIR__ . '/../Common/Util/ValidationHelper.php';

class UsuarioLogic
{
//   public function Crear(EmpleadoDto $dto)
//   {
//     $erroresEmpleado =  ValidationHelper::ValidarCreateEmpleadoRequest($dto->rolEmpleado);
//     $erroresUsuario = ValidationHelper::ValidarCreateUsuarioRequest($dto);

//     if (count($erroresUsuario) > 0 || $erroresEmpleado > 0) {
//       $errores = array_merge($erroresUsuario, $erroresEmpleado);
//     }
// echo "todo ok";

//   }
}
