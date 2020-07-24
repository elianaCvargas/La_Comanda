<?php
declare(strict_types=1);
namespace Common\Enum;

abstract class Enum_RolesEmpleados{
    const Cocinero = 1;
    const Bartender = 2;
    const Cervecero = 3;
    const Mozo = 4;

    public static function getEnumValue($dato)
    {
        switch($dato)
        {
            case "Cocinero":
                return 1;
            break;
            case "Bartender":
                return 2;
            break;
            case "Cervecero":
                return 3;
            break;
            case "Mozo":
                return 4;
            break;
        }
    }
}
?>