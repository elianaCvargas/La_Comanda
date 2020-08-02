<?php

namespace Logic;

use Common\Dto\FileDto;
use Common\ExceptionManager\ApplicationException;
use Common\Mappings\FileMapping;
use Common\Util\ValidationHelper;
use Db\FileDb;

include_once __DIR__ . '/../Common/Util/ValidationHelper.php';
include_once __DIR__ . '/../Common/ExceptionManager/ApplicationException.php';
// include_once __DIR__ . '/../Db/FileDb.php';

class FileLogic
{
    public function SubirFoto($fileName, $file)
    {
        $upload_path = __DIR__ . "/../Images";
        $extension = pathInfo($fileName, PATHINFO_EXTENSION);
        $name = pathInfo($fileName, PATHINFO_FILENAME);
        $ficheros  = scandir($upload_path);
        $actualName = $fileName;
        $contador = 1;
        while (in_array($actualName, $ficheros)) {
            $actualName = $name . "(" . $contador . ")" . "." . $extension;
            $contador++;
        }

        $file->moveTo($upload_path . "/" . $actualName);
    }

}
