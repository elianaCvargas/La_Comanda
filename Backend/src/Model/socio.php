<?php
declare(strict_types=1);

namespace App\Model;

use JsonSerializable;
use Model\Usuario;

include_once __DIR__ . '/../../src/Model/usuario.php';

class Socio extends Usuario
{
  public function __construct($nombre, $apellido, $username)
  {
      parent::__construct($nombre, $apellido, $username);
  }
}
