<?php
namespace Common\Util;

use Common\Dto\EmpleadoDto;
use PHPUnit\Framework\Constraint\IsEmpty;

include_once __DIR__ . '/../Dto/UsuarioDto.php'; 
include_once __DIR__ . '/../Dto/EmpleadoDto.php'; 

abstract class DbQueryBuilder
{
    public static function BuildUpdateFields(array $fields, array $values)
    {
      $queryArray = [];
      for ($i = 0; $i < count($fields); $i++) {
        $value = $values[$i];

        $value ? array_push($queryArray, $fields[$i]."='".$value."'") : null;
      }

      return join(', ', $queryArray);
    }
}