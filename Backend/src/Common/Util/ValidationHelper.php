<?php
namespace Common\Util;

use Common\Dto\UsuarioDto;
use Common\Dto\EmpleadoDto;
use PHPUnit\Framework\Constraint\IsEmpty;

include_once __DIR__ . '/../Dto/UsuarioDto.php'; 
include_once __DIR__ . '/../Dto/EmpleadoDto.php'; 

abstract class ValidationHelper
{
    public static function ValidarCreateEmpleadoRequest(EmpleadoDto $dto)
    {
        $errores = [];

        if($dto->rolEmpleado === "" || $dto->rolEmpleado === null)
        {
            array_push( $errores, "Debe ingresar un Rol.");
        }

      return $errores;
    }

    public static function ValidarCreateUsuarioRequest($nombre, $apellido, $username) 
    {
        $errores = [];
        if($nombre === "" || $nombre === null)
        {
           array_push( $errores, "Debe ingresar un nombre.");
        }

        if($apellido === "" || $apellido === null)
        {
            array_push($errores, "Debe ingresar un apellido.");
        }
              if($username === "" || $username === null)
        {
            array_push( $errores, "Debe ingresar un email.");
        }


      return $errores;
    }

    public static function ValidarModifyUsuarioRequest($id, $nombre, $apellido, $username) 
    {
        $errores = [];
        if($id === "") {
            array_push( $errores, "Debe ingresar un id.");
        }

        if($nombre === "" && $apellido === "" && $username === "")
        {
           array_push( $errores, "Debe modificar al menos un campo.");
        }

      return $errores;
    }

    public static function ValidarDeleteUsuarioRequest($id) 
    {
        $errores = [];
        if($id === "") {
            array_push( $errores, "Debe ingresar un id.");
        }

      return $errores;
    }
}