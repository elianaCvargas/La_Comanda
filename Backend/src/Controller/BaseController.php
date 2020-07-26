<?php

namespace Controller;

use Common\Mappings\UsuarioDtoMapping;
use PHPUnit\Framework\Exception;
use Common\ExceptionManager\ApplicationException;
use Logic\EmpleadoLogic;
use phpDocumentor\Reflection\Types\Boolean;

include_once __DIR__ . '/../Model/cliente.php';
include_once __DIR__ . '/../Common/Dto/UsuarioDto.php';
include_once __DIR__ . '/../Logic/UsuarioLogic.php';
include_once __DIR__ . '/../Logic/EmpleadoLogic.php';
include_once __DIR__ . '/../Common/Mappings/UsuarioDtoMapping.php';


class BaseController
{
  public function ValidateRequest(array $datosArray, array $properties)
  {
    $result = true;
    foreach ($properties as $property)
    {
      $result = $result && isset($datosArray[$property]);
    }

    return $result;
  }
}
