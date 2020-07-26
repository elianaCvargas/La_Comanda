<?php
namespace Common\Util;

use Common\Dto\UsuarioDto;
use Common\Dto\EmpleadoDto;
use PHPUnit\Framework\Constraint\IsEmpty;

include_once __DIR__ . '/../Dto/UsuarioDto.php'; 
include_once __DIR__ . '/../Dto/EmpleadoDto.php'; 

abstract class ValidationHelper
{
    public static function ValidarEmpleadoRequest(EmpleadoDto $dto)
    {
        $errores = [];
      
        if($dto->dni === "" || $dto->dni === null)
        {
            array_push( $errores, "Debe ingresar un DNI.");
        }

        if($dto->telefono === "" || $dto->telefono === "")
        {
            array_push( $errores, "Debe ingresar un telefono.");
        }

        if($dto->rolEmpleado === "" || $dto->rolEmpleado === "")
        {
            array_push( $errores, "Debe ingresar un telefono.");
        }

      return $errores;
    }

    public static function ValidarUsuarioRequest($nombre, $apellido) 
    {
        $errores = [];

        if($nombre === "" || $nombre === null)
        {
           array_push( $errores, "Debe ingresar un nombre.");
            return false;
        }

        if($apellido === "" || $apellido === null)
        {
            array_push($errores, "Debe ingresar un apellido.");
        }

      return $errores;
    }
}