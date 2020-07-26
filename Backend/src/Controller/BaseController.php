<?php

namespace Controller;

class BaseController
{
  public function ValidateRequest(array $datosArray, array $properties)
  {
    $result = true;
    foreach ($properties as $property)
    {
      $result = $result && isset($datosArray[$property]);
    }

    return $result;
  }
}
