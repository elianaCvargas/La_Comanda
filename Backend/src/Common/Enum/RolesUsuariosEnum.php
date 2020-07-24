<?php
declare(strict_types=1);
namespace Common\Enum;


abstract class Enum_RolesUsuarios{
    const Empleado = 4;
    const Socio = 3;
    const Cliente = 1;

    public static function getEnumValue($dato)
    {
        switch($dato)
        {
            case "Empleado":
                return 4;
            break;
            case "Socio":
                return 3;
            break;
            case "Cliente":
                return 1;
            break;
            default:
            0;
        break;
        }
    }

}
?>

