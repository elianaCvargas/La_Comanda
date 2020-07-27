<?php

namespace Controller;

class BaseController
{
  public function ValidateCreateRequest(array $datosArray, array $properties)
  {
    $result = true;
    foreach ($properties as $property)
    {
      $result = $result && isset($datosArray[$property]);
    }

    return $result;
  }

  public function ValidateModifyRequest(array $datosArray, string $idField, array $properties)
  {
    if(!isset($datosArray[$idField])) {
      return false;
    }

    $result = false;
    foreach ($properties as $property)
    {
      $result = $result || isset($datosArray[$property]);
    }

    return $result;
  }

  public function ValidateDeleteRequest(array $datosArray, string $idField)
  {
    if(!isset($datosArray[$idField])) {
      return false;
    }

    return true;
  }
}
