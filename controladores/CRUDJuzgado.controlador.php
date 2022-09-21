<?php

/**
 *
 */
class CRUDJuzgadoCtr
{

  static public function seleccionarJuzgadoCtr($item, $valor){

    $tabla = "JUZGADO";
    $respuesta = CRUDJuzgadoMd::selecionarJuzgadoMd($tabla, $item, $valor);
    return $respuesta;

  }

  static public function crearJuzgadoCtr(){

    if (isset($_POST["Nombre"])) {
      $tabla = "JUZGADO";
      $datos =  array("DESCRIPCION_JG" => $_POST["Nombre"], "DIRECCION" => $_POST["Direccion"]);

       $respuesta = CRUDJuzgadoMd::CrearJuzgadoMd($tabla, $datos);
       return $respuesta;
    }
  }


}





 ?>
