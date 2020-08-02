<?php

namespace Logic;

use Common\Dto\AccesoDto;
use Common\ExceptionManager\ApplicationException;
use Common\Mappings\AccesoMapping;
use Common\Util\ValidationHelper;
use DateTime;
use Db\AccesoDb;

include_once __DIR__ . '/../Common/Util/ValidationHelper.php';
include_once __DIR__ . '/../Common/ExceptionManager/ApplicationException.php';
include_once __DIR__ . '/../Common/Mappings/AccesoMapping.php';
include_once __DIR__ . '/../Db/AccesoDb.php';

class AccesoLogic
{
    public function RegistrarAcceso($id, $empleadoId)
    {
        $acceso = AccesoMapping::ToAcceso($id, new DateTime());
        AccesoDb::create($acceso);
    }

}
