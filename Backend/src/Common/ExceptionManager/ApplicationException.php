<?php
declare(strict_types=1);
namespace Common\ExceptionManager;

use PHPUnit\Framework\Exception;

class ApplicationException extends Exception
{
    protected $code;
    protected $message;
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    // public function __toString() {
    //     return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    // }

    public function Message() {
        echo  ": [{$this->code}]: {$this->message}\n";
    }

    public function customFunction() {
        echo "A custom function for this type of exception\n";
    }

}
?>