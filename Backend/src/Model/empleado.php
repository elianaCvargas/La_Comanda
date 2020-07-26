<?php
declare(strict_types=1);

namespace Model;

use Common\Enum\Enum_RolesEmpleados;
use JsonSerializable;
use Common\Enum\Enum_RolesUsuarios;
include_once __DIR__ . '/../../src/Model/usuario.php';
include_once __DIR__ . '/../../src/Common/Enum/RolesUsuariosEnum.php';

class Empleado extends Usuario
{
    private $rolEmpleado;
    // private $dni;
    // private $telefono;
    public function __construct($nombre, $apellido, $rolEmpleado)
    {
        parent::__construct($nombre, $apellido);
        parent::setUserRol(Enum_RolesUsuarios::Empleado);
        // $this->dni = $dni;
        // $this->telefono = $telefono;
        $this->rolEmpleado = $rolEmpleado;
    }

    public function getId(): ?int
    {
        return $this->numeroCliente;
    }

    public function jsonSerialize()
    {
        return  parent::jsonSerialize().array_merge([
            'numeroCliente' => $this->numeroCliente
        ]);
    }

    public function setUserRolEmpleado(int $rolEmpleadoId) 
    {
        $this->rolEmpleado = $rolEmpleadoId;
    }

    public function getUserRolEmpleado()
    {
        return $this->rolEmpleado;
    }

    // public function setDni(int $dni) 
    // {
    //     $this->dni = $dni;
    // }

    // public function getDni()
    // {
    //     return $this->dni;
    // }

    // public function setTelefono(int $telefono) 
    // {
    //     $this->telefono = $telefono;
    // }

    // public function getTelefono()
    // {
    //     return $this->telefono;
    // }
}
