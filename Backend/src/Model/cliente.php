<?php
declare(strict_types=1);

namespace Model;

use JsonSerializable;
use Common\Enum\Enum_RolesUsuarios;
include_once __DIR__ . '/../../src/Model/usuario.php';
include_once __DIR__ . '/../../src/Common/Enum/RolesUsuariosEnum.php';

class Cliente extends Usuario
{
    // private $numeroCliente;
    
    // public function __construct($username, $firstName, $lastName, $numeroCliente)
    // {
    //     parent::__construct($username, $firstName, $lastName);
    //     parent::setUserRol(Enum_RolesUsuarios::Cliente);
    //     $this->numeroCliente = $numeroCliente;
    // }

    // public function getId(): ?int
    // {
    //     return $this->numeroCliente;
    // }

    // public function jsonSerialize()
    // {
    //     return  parent::jsonSerialize().array_merge([
    //         'numeroCliente' => $this->numeroCliente
    //     ]);
    // }
}
