<?php

require_once "conexion.php";


class CRUDContraparteoMd{

  static public function selecionarContraparteMd($tabla, $item, $valor){
    if ($item == null && $valor == null) {
      $stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla");
      $stmt -> execute();
      return $stmt -> fetchAll();

    }else{

        $stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetch();

    }
    $stmt -> close();
    $stmt = null;
  }


  static public function CrearCrontraparteMd($tabla, $dato){

    $stmt = ConexionBD::conectar()->prepare("INSERT INTO $tabla (NOMBRE, DIRECCION, CORREO, TELEFONO)
                                                        VALUES (:NOMBRE, :DIRECCION, :CORREO, :TELEFONO)");

    $stmt -> bindParam(":NOMBRE", $dato["NOMBRE"], PDO::PARAM_STR);
    $stmt -> bindParam(":CORREO", $dato["CORREO"], PDO::PARAM_STR);
    $stmt -> bindParam(":DIRECCION", $dato["DIRECCION"], PDO::PARAM_STR);
    $stmt -> bindParam(":TELEFONO", $dato["TELEFONO"], PDO::PARAM_STR);

    if ($stmt -> execute()) {
        return "ok";
    }else{
      print_r(ConexionBD::conectar()->errorInfo());
    }

    $stmt -> close();
    $stmt = null;
  }

}


 ?>
