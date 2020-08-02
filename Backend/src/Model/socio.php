<?php
declare(strict_types=1);

namespace App\Model;

use Common\Enum\Enum_RolesUsuarios;
use Model\Usuario;

include_once __DIR__ . '/../../src/Model/usuario.php';

class Socio extends Usuario
{
  public function __construct($id, $nombre, $apellido, $username, $password)
  {
      parent::__construct($id ? $id : 0, $nombre, $apellido, $username, $password);
      parent::setRolUsuarioID(Enum_RolesUsuarios::Socio);
  }
}
