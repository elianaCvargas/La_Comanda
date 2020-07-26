<?php

declare(strict_types=1);

namespace Model;

use JsonSerializable;

abstract class Usuario implements JsonSerializable
{

    private $id;
    private $nombre;
    private $apellido;
    private $userRol;
    private $username;

    public function __construct($id, $nombre, $apellido, $username)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->username = $username;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserRol(): ?int
    {
        return $this->userRol;
    }

    protected function setUserRol(int $rolId)
    {
        $this->userRol = $rolId;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(int $apellido)
    {
        $this->apellido = $apellido;
    }

    public function getUsername(): ?string
    {
        return $this->username;
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
            'id' => $this->id,
            'username' => $this->username,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
        ];
    }
}
