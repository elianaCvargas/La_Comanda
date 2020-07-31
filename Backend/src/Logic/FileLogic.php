<?php

namespace Logic;

use Common\Dto\FileDto;
use Common\ExceptionManager\ApplicationException;
use Common\Mappings\FileMapping;
use Common\Util\ValidationHelper;
use Db\FileDb;

include_once __DIR__ . '/../Common/Util/ValidationHelper.php';
include_once __DIR__ . '/../Common/ExceptionManager/ApplicationException.php';
include_once __DIR__ . '/../Db/FileDb.php';

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

    //   public function Modificar(MesaDto $dto)
    //   {
    //     $erroresMesa = ValidationHelper::ValidarModifyMesaRequest($dto->id);
    //     if (count($erroresMesa) > 0) {
    //       foreach ($erroresMesa as $error) {
    //         echo $error . "\n";
    //       }

    //       return;
    //     }

    //     $mesaById = MesaDb::getMesaById($dto->id);
    //     if ($mesaById != null) {
    //       $mesa = MesaMapping::ToMesa($dto, $dto->id);
    //       MesaDb::modify($mesa);
    //     } else {
    //       throw new ApplicationException("No se encontro el Mesa.");
    //     }
    //   }

    //   public function Eliminar(string $id)
    //   {
    //     $errores = [];
    //     $erroresUsuario = ValidationHelper::ValidarDeleteUsuarioRequest($id);

    //     if (count($erroresUsuario) > 0) {
    //       foreach ($errores as $error) {
    //         echo $error . "\n";
    //       }

    //       return;
    //     }

    //     $mesa = MesaDb::getMesaById(intval($id));
    //     if ($mesa != null) {
    //       MesaDb::delete($mesa->getId());
    //     } else {
    //       throw new ApplicationException("No se encontro el empleado.");
    //     }
    //   }

    //   public function alterarEstadoMesa(int $mesaId, int $estado)
    //   {
    //       MesaDb::alterarEstadoMesa($mesaId, $estado);
    //   }

    //   private function GenerateAlphanumericCode(): string
    //   {
    //     $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //     return substr(str_shuffle($permitted_chars), 0, 5);
    //   }
}
