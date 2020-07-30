<?php

namespace Logic;

use Common\Dto\SocioDto;
use Common\Enum\Enum_RolesUsuarios;
use Common\ExceptionManager\ApplicationException;
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

    $erroresUsuario = ValidationHelper::ValidarCreateUsuarioRequest($dto->nombre, $dto->apellido, $dto->username);

    if (count($erroresUsuario) > 0) {
      foreach($erroresUsuario as $error)
      {
        echo $error."\n";
      }

      return;
    }

    $usuarioNuevo = UsuarioMapping::ToSocio($dto);
    UsuarioDb::createSocio($usuarioNuevo);
  }

  public function Modificar(SocioDto $dto)
  {
    $errores = [];
    $erroresUsuario = ValidationHelper::ValidarModifyUsuarioRequest($dto->id, $dto->nombre, $dto->apellido, $dto->username);

    if (count($erroresUsuario) > 0) {
      foreach($errores as $error)
      {
        echo $error."\n";
      }

      return;
    }

    $usuarioNuevo = UsuarioMapping::ToSocio($dto);
    UsuarioDb::modifySocio($usuarioNuevo);
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
    if($usuario != null && $usuario->getRolUsuarioID() == Enum_RolesUsuarios::Socio)
    {
      UsuarioDb::deleteSocio($usuario->getId());
      
    }
    else 
    {
      throw new ApplicationException("No se pudo eliminar el socio.");
    }
  }
}
