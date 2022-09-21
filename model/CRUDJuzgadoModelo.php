<?php

require_once "conexion.php";


class CRUDJuzgadoMd{

  static public function selecionarJuzgadoMd($tabla, $item, $valor){
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


  static public function CrearJuzgadoMd($tabla, $dato){

    $stmt = ConexionBD::conectar()->prepare("INSERT INTO $tabla (DESCRIPCION_JG, DIRECCION)
                                                        VALUES (:DESCRIPCION_JG, :DIRECCION)");

    $stmt -> bindParam(":DESCRIPCION_JG", $dato["DESCRIPCION_JG"], PDO::PARAM_STR);
    $stmt -> bindParam(":DIRECCION", $dato["DIRECCION"], PDO::PARAM_STR);

    if (  $stmt -> execute()) {
        return "ok";
    }else{
      print_r(ConexionBD::conectar()->errorInfo());
    }

    $stmt -> close();
    $stmt = null;
  }

}


 ?>
