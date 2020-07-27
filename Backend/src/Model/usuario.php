<?php

declare(strict_types=1);

namespace Model;

use JsonSerializable;

class Usuario implements JsonSerializable
{

    private $Id;
    private $Nombre;
    private $Apellido;
    private $RolUsuarioID;
    private $Username;

    public function __construct($Id, $Nombre, $Apellido, $Username)
    {
        $this->Id = $Id;
        $this->Nombre = $Nombre;
        $this->Apellido = $Apellido;
        $this->Username = $Username;
    }

    public function getId(): ?int
    {
        return $this->Id;
    }

    public function getRolUsuarioID(): ?int
    {
        return $this->RolUsuarioID;
    }

    public function setRolUsuarioID(int $rolId)
    {
        $this->RolUsuarioID = $rolId;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
    }

    public function getApellido(): ?string
    {
        return $this->Apellido;
    }

    public function setApellido(int $Apellido)
    {
        $this->Apellido = $Apellido;
    }

    public function getUsername(): ?string
    {
        return $this->Username;
    }

    // public function getDni(): ?int
    // {
    //     return $this->dni;
    // }

    // public function getTelefono(): ?int
    // {
    //     return $this->telefono;
    // }

    public function jsonSerialize()
    {
        return [
            'Id' => $this->Id,
            'Username' => $this->Username,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
        ];
    }
}
