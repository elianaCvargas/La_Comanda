<?php
declare(strict_types=1);

namespace Common\Dto;

use JsonSerializable;
use Common\Enum\Enum_RolesUsuarios;

 include_once __DIR__ . '/../Dto/Result.php';

class UsuarioDto extends ResultDto
{
    public $numeroCliente;
    public $nombre;
    public $apellido;
    public $dni;
    public $rolUsuario;
    public $rolEmpleado;
}
