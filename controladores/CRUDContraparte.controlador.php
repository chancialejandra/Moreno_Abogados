<?php

/**
 *
 */
class CRUDContraparteCtr
{

  static public function seleccionarAbogadosCtr($item, $valor){

    $tabla = "CONTRAPARTE";
    $respuesta = CRUDContraparteoMd::selecionarContraparteMd($tabla, $item, $valor);
    return $respuesta;

  }

  static public function crearContraparteCtr(){

    if (isset($_POST["Nombre"])) {
      $tabla = "CONTRAPARTE";
      $datos =  array("NOMBRE" => $_POST["Nombre"], "CORREO" => $_POST["Correo"],
                      "DIRECCION" => $_POST["Direccion"], "TELEFONO" => $_POST["Telefono"]);

       $respuesta = CRUDContraparteoMd::CrearCrontraparteMd($tabla, $datos);
       return $respuesta;
    }
  }


}





 ?>
