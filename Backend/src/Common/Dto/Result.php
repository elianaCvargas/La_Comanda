<?php
declare(strict_types=1);

namespace Common\Dto;

class ResultDto
{
    public $errors = [];
    public $success = true; 
    public $lugar;

  public function __construct($errors, $success, $lugar)
  {
      $this->errors = $errors;
      $this->success = $success;
      $this->lugar = $lugar;
  }
}
