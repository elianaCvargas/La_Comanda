<?php
declare(strict_types=1);

namespace Common\Dto;

use JsonSerializable;
use Common\Enum\Enum_RolesUsuarios;

// include_once __DIR__ . '/../../src/Common/Enum/RolesUsuariosEnum.php';

class UsuarioDto
{
    public $numeroCliente;
    public $nombre;
    public $apellido;
    public $dni;
    public $rolUsuario;
    public $rolEmpleado;
}
