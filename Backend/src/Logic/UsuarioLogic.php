<?php

namespace Logic;

use App\Models\AutentificadorJWT;
use Common\Dto\EmpleadoDto;
use Common\Dto\ResultDto;
use Common\Enum;
use Common\Enum\Enum_RolesUsuarios;
use Common\Enum\Enum_RolesEmpleados;
use Common\Mappings\UsuarioMapping;
use Db\ClienteDb;
use Common\Util\ValidationHelper;
use Common\Dto\UsuarioDto;
use Common\ExceptionManager\ApplicationException;
use Db\UsuarioDb;
use Model\Usuario;
use phpDocumentor\Reflection\Types\Boolean;

include_once __DIR__ . '/../Common/Enum/RolesUsuariosEnum.php';
include_once __DIR__ . '/../Common/Enum/RolesEmpleadosEnum.php';
include_once __DIR__ . '/../Common/Mappings/UsuarioMapping.php';
include_once __DIR__ . '/../Common/Util/ValidationHelper.php';

class UsuarioLogic
{

    public function validateUserCredential($username, $password): Usuario
    {

            $user = UsuarioDb::getUsuarioByUsername($username);
            if ($user->getPassword() == $password) {
                return $user;
            }

            return null;

    }
}
