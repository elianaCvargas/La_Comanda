<?php

namespace Logic;

use Common\Dto\EmpleadoDto;
use Common\Dto\ResultDto;
use Common\Enum\Enum_RolesEmpleados;
use Common\Enum\Enum_RolesUsuarios;
use Common\ExceptionManager\ApplicationException;
use Common\Mappings\UsuarioMapping;
use Db\UsuarioDb;
use Common\Util\ValidationHelper;
use Model\Empleado;


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
    $erroresEmpleado =  ValidationHelper::ValidarCreateEmpleadoRequest($dto);
    $erroresUsuario = ValidationHelper::ValidarCreateUsuarioRequest($dto->nombre, $dto->apellido, $dto->username);

    if (count($erroresUsuario) > 0 || $erroresEmpleado > 0) {
      $errores = array_merge($erroresUsuario, $erroresEmpleado);
      return new ResultDto($errores, false, "Crear empleado");
    }

    $usuarioNuevo = UsuarioMapping::ToEmpleado($dto);
    UsuarioDb::createEmpleado($usuarioNuevo);
  }

  public function Modificar(EmpleadoDto $dto)
  {
    $erroresUsuario = ValidationHelper::ValidarModifyUsuarioRequest($dto->id, $dto->nombre, $dto->apellido, $dto->username);

    if (count($erroresUsuario) > 0) {
      foreach($erroresUsuario as $error)
      {
        echo $error."\n";
      }

      return;
    }

    $usuario = UsuarioDb::getUsuarioById($dto->id);
    $empleado = UsuarioMapping::usuarioToEmpleado($usuario, $dto->rolEmpleado);
    if($empleado != null && $empleado->getRolUsuarioID() == Enum_RolesUsuarios::Empleado)
    {
      UsuarioDb::modifyEmpleado($empleado);
      
    }
    else 
    {
      throw new ApplicationException("No se encontro el empleado.");
    }
  }

  public function Eliminar(string $id)
  {
    $errores = [];
    $erroresUsuario = ValidationHelper::ValidarDeleteUsuarioRequest($id);

    if (count($erroresUsuario) > 0) {
      foreach($errores as $error)
      {
        echo $error."\n";
      }

      return;
    }

    $usuario = UsuarioDb::getUsuarioById(intval($id));
    if($usuario != null && $usuario->getRolUsuarioID() == Enum_RolesUsuarios::Empleado)
    {
      UsuarioDb::deleteEmpleado($usuario->getId());
      
    }
    else 
    {
      throw new ApplicationException("No se encontro el empleado.");
    }
  }
}
