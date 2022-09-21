<?php

require_once "conexion.php";


class CRUDActuacionMd{

  static public function selecionarActuacionMd($tabla, $item, $valor){
    if ($item == null && $valor == null) {
      $stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla ORDER BY FECHA_CREACION ASC");
      $stmt -> execute();
      return $stmt -> fetchAll();

    }else{

        $stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY FECHA_CREACION DESC");
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetchAll();

    }
    $stmt -> close();
    $stmt = null;
  }


  static public function CrearActuacionMd($tabla, $dato){

    $stmt = ConexionBD::conectar()->prepare("INSERT INTO $tabla (DESCRIPCION_AC, FECHA_CREACION, LITIGIO_ID_LITIGIO)
                                                        VALUES (:DESCRIPCION_AC, :FECHA_CREACION, :LITIGIO_ID_LITIGIO)");


    $stmt -> bindParam(":DESCRIPCION_AC", $dato["DESCRIPCION_AC"], PDO::PARAM_STR);
    $stmt -> bindParam(":FECHA_CREACION", $dato["FECHA_CREACION"], PDO::PARAM_STR);
    $stmt -> bindParam(":LITIGIO_ID_LITIGIO", $dato["LITIGIO_ID_LITIGIO"], PDO::PARAM_INT);

    if (  $stmt -> execute()) {
        return "ok";
    }else{
      print_r(ConexionBD::conectar()->errorInfo());
    }

    $stmt -> close();
    $stmt = null;
  }

  static public function ActualizarActuacionMd($tabla, $dato){

        $stmt = ConexionBD::conectar()->prepare("UPDATE $tabla SET DESCRIPCION_AC = :DESCRIPCION_AC, FECHA_CREACION = :FECHA_CREACION
                                                                WHERE ID_ACTUACION = :ID_ACTUACION");

          $stmt -> bindParam(":DESCRIPCION_AC", $dato["DESCRIPCION_AC"], PDO::PARAM_STR);
          $stmt -> bindParam(":FECHA_CREACION", $dato["FECHA_CREACION"], PDO::PARAM_STR);
          $stmt -> bindParam(":ID_ACTUACION", $dato["ID_ACTUACION"], PDO::PARAM_INT);

          if (  $stmt -> execute()) {
                return "ok";
          }else{
              print_r(ConexionBD::conectar()->errorInfo());
          }
          $stmt -> close();
          $stmt = null;
  }

  static public function EliminarActuacionMd($tabla, $dato){

        $stmt = ConexionBD::conectar()->prepare("DELETE FROM $tabla WHERE ID_ACTUACION = :ID_ACTUACION");

          $stmt -> bindParam(":ID_ACTUACION", $dato["ID_ACTUACION"], PDO::PARAM_INT);

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
