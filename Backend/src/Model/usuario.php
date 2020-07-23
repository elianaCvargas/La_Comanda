<?php
declare(strict_types=1);

namespace Model;

use JsonSerializable;

abstract class Usuario implements JsonSerializable
{

    private $id;
    private $username;
    private $firstName;
    private $lastName;
    private $userRol;
    private $empleadoRol;

    public function __construct($username, $firstName, $lastName)
    {
        $this->id = 0;
        $this->username = strtolower($username);
        $this->firstName = ucfirst($firstName);
        $this->lastName = ucfirst($lastName);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserRol(): ?int
    {
        return $this->userRol;
    }

    public function getEmpleadoRol(): ?int
    {
        return $this->empleadoRol;
    }

    protected function setUserRol(int $rolId) 
    {
        $this->userRol = $rolId;
    }

    protected function setEmpleadoRol(int $rolId) 
    {
        $this->empleadoRol = $rolId;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

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
