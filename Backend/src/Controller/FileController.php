<?php

namespace Controller;

use Common\ExceptionManager\ApplicationException;
use Logic\FileLogic;
use Controller\BaseController;
use Psr\Http\Message;
use Exception;
use Logic\MesaLogic;

include_once __DIR__ . '/../Controller/BaseController.php';
include_once __DIR__ . '/../../vendor/psr/http-message/src/UploadedFileInterface.php';
 include_once __DIR__ . '/../Logic/FileLogic.php';

class FileController extends BaseController
{

    public function subirFoto($request, $response, $args)
    {
        try {
            $datosArray = $request->getUploadedFiles();
            if ($this->ValidateCreateRequest($datosArray, ["foto"])) {
                $file = $datosArray['foto'];
                $fullName = $file->getClientFilename();
                $fileLogic = new FileLogic();
                $fileLogic->subirFoto($fullName,$file);
                
            } else {
                echo "Faltan definir los campos";
            }
        } catch (ApplicationException $e) {
            echo $e->Message();
        } catch (Exception $ae) {
            echo "Algun problema no conocido";
        }
    }

    // public function Modificar($request, $response, $args)
    // {
    //   try {
    //     $datosArray = $request->getParsedBody();
    //     if (
    //       $this->ValidateModifyRequest($datosArray, "id", ["codigo", "estado"])
    //     ) {
    //       $mesa = json_encode($datosArray);
    //       $mesaDto = MesaMapping::ToDto($mesa, true);
    //       $mesaLogic = new MesaLogic();
    //       $mesaLogic->Modificar($mesaDto);
    //       echo "Modificado con exito";
    //     } else {
    //       echo "Debe definir al menos un campo para modificar e ingresar un id";
    //     }
    //   } catch (ApplicationException $ae) {
    //     echo $ae->Message();
    //    }catch (Exception $e) {
    //     echo "Algun problema no conocido";
    //   } 
    // }

    // public function Eliminar($request, $response, $args)
    // {
    //   try {
    //     $datosArray = $request->getParsedBody();
    //     if (
    //       $this->ValidateDeleteRequest($datosArray, "id")
    //     ) {
    //       $obj = json_encode($datosArray);
    //       $mesa = json_decode($obj);

    //      $mesaLogic = new MesaLogic();
    //      $mesaLogic->Eliminar($mesa->id);
    //       echo "Eliminado con exito";
    //     } else {
    //       echo "Debe definir al menos un campo para modificar y ingresar un id";
    //     }
    //   } catch (ApplicationException $ae) {
    //     echo $ae->Message();
    //    }catch (Exception $e) {
    //     echo "Algun problema no conocido";
    //   } 
    // }
    public static function  GuargarImagen($fileName, $file)
    {
       
    }
}
