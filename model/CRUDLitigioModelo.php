<?php
require_once "conexion.php";

class CRUDLitigioMd{

  static public function ContarLitigioActMD($tabla, $item, $valor){
    $stmt = ConexionBD::conectar()->prepare("SELECT COUNT(ID_LITIGIO)
                                              FROM $tabla
                                              WHERE FK_E_LITIGIO = 1 AND $item = :$item ");

    $stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
    $stmt -> execute();
    return $stmt -> fetch();

    $stmt -> close();
    $stmt = null;
  }


  static public function SeleccionarLitigioIndMD($tabla, $item, $valor){
    $stmt = ConexionBD::conectar()->prepare("SELECT *
                                              FROM $tabla
                                              WHERE $item = :$item ");

    $stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
    $stmt -> execute();
    return $stmt -> fetchAll();

    $stmt -> close();
    $stmt = null;
  }

  static public function SeleccionarLitigioBuscadorMd($tabla, $item, $valor){

        $stmt = ConexionBD::conectar()->prepare("SELECT *
                                                FROM $tabla lt INNER JOIN CLIENTE cl
                                                ON lt.FK_CLIENTE = cl.ID_CLIENTE
                                                INNER JOIN ABOGADO ab
                                                ON lt.FK_ABOGADO = ab.ID_ABOGADO
                                                INNER JOIN TIPO_LITIGIO tlt
                                                ON lt.FK_T_LITIGIO = tlt.ID_T_LITIGIO
                                                WHERE $item = :$item ");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetchAll();

        $stmt -> close();
        $stmt = null;
  }

  static public function SeleccionarLitigioMd($tabla, $item, $valor){
    if ($item == null && $valor == null) {
      $stmt = ConexionBD::conectar()->prepare("SELECT *
                                                FROM $tabla lt INNER JOIN CLIENTE cl
                                                ON lt.FK_CLIENTE = cl.ID_CLIENTE
                                                INNER JOIN ABOGADO ab
                                                ON lt.FK_ABOGADO = ab.ID_ABOGADO
                                                INNER JOIN TIPO_LITIGIO tlt
                                                ON lt.FK_T_LITIGIO = tlt.ID_T_LITIGIO");
      $stmt -> execute();
      return $stmt -> fetchAll();

    }else{

        $stmt = ConexionBD::conectar()->prepare("SELECT *
                                                FROM $tabla lt INNER JOIN CLIENTE cl
                                                ON lt.FK_CLIENTE = cl.ID_CLIENTE
                                                INNER JOIN ABOGADO ab
                                                ON lt.FK_ABOGADO = ab.ID_ABOGADO
                                                INNER JOIN TIPO_LITIGIO tlt
                                                ON lt.FK_T_LITIGIO = tlt.ID_T_LITIGIO
                                                WHERE $item = :$item ");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetch();

    }
    $stmt -> close();
    $stmt = null;
  }

  static public function CrearLitigioMd($tabla, $datos){




    if ($datos["FK_CONTRAPARTE"] != "null") {
      $consulta = "INSERT INTO $tabla(RADICADO, FECHA_CREACION, FK_JUZGADO, FK_CIUDAD,
                                      FK_ABOGADO, FK_CONTRAPARTE, FK_CLIENTE, FK_T_LITIGIO, FK_E_LITIGIO)
                              VALUES (:RADICADO, :FECHA_CREACION, :FK_JUZGADO, :FK_CIUDAD,
                                    :FK_ABOGADO, :FK_CONTRAPARTE, :FK_CLIENTE, :FK_T_LITIGIO, :FK_E_LITIGIO)";
    }else{
      $consulta = "INSERT INTO $tabla(RADICADO, FECHA_CREACION, FK_JUZGADO, FK_CIUDAD,
                                      FK_ABOGADO, FK_CLIENTE, FK_T_LITIGIO, FK_E_LITIGIO)
                                VALUES (:RADICADO, :FECHA_CREACION, :FK_JUZGADO, :FK_CIUDAD,
                                        :FK_ABOGADO, :FK_CLIENTE, :FK_T_LITIGIO, :FK_E_LITIGIO)";
    }
    $stmt = ConexionBD::conectar()->prepare($consulta);
    $stmt->bindParam(":RADICADO", $datos["RADICADO"], PDO::PARAM_STR);
    $stmt->bindParam(":FECHA_CREACION", $datos["FECHA_CREACION"], PDO::PARAM_STR);
    $stmt->bindParam(":FK_JUZGADO", $datos["FK_JUZGADO"], PDO::PARAM_INT);
    $stmt->bindParam(":FK_CIUDAD", $datos["FK_CIUDAD"], PDO::PARAM_INT);
    $stmt->bindParam(":FK_ABOGADO", $datos["FK_ABOGADO"], PDO::PARAM_INT);
    $stmt->bindParam(":FK_CONTRAPARTE", $datos["FK_CONTRAPARTE"], PDO::PARAM_STR);
    $stmt->bindParam(":FK_CLIENTE", $datos["FK_CLIENTE"], PDO::PARAM_INT);
    $stmt->bindParam(":FK_T_LITIGIO", $datos["FK_T_LITIGIO"], PDO::PARAM_INT);
    $stmt->bindParam(":FK_E_LITIGIO", $datos["FK_E_LITIGIO"], PDO::PARAM_INT);

    if($stmt->execute()) {
      return "ok";
    }else{
      return (ConexionBD::conectar()->errorInfo());
    }

    $stmt = null;
  }

  static public function ActualizarLitigiosMd($tabla, $dato){

        $stmt = ConexionBD::conectar()->prepare("UPDATE $tabla SET FK_T_LITIGIO = :FK_T_LITIGIO, RADICADO = :RADICADO,
                                                  FK_CIUDAD = :FK_CIUDAD, FK_JUZGADO = :FK_JUZGADO,
                                                  FK_CONTRAPARTE = :FK_CONTRAPARTE, FK_ABOGADO = :FK_ABOGADO
                                                  WHERE ID_LITIGIO = :ID_LITIGIO");

          $stmt -> bindParam(":FK_T_LITIGIO", $dato["FK_T_LITIGIO"], PDO::PARAM_INT);
          $stmt -> bindParam(":RADICADO", $dato["RADICADO"], PDO::PARAM_STR);
          $stmt -> bindParam(":FK_CIUDAD", $dato["FK_CIUDAD"], PDO::PARAM_INT);
          $stmt -> bindParam(":FK_JUZGADO", $dato["FK_JUZGADO"], PDO::PARAM_INT);
          $stmt -> bindParam(":FK_CONTRAPARTE", $dato["FK_CONTRAPARTE"], PDO::PARAM_INT);
          $stmt -> bindParam(":FK_ABOGADO", $dato["FK_ABOGADO"], PDO::PARAM_INT);
          $stmt -> bindParam(":ID_LITIGIO", $dato["ID_LITIGIO"], PDO::PARAM_INT);


          if (  $stmt -> execute()) {
                return "ok";
          }else{
              print_r(ConexionBD::conectar()->errorInfo());
          }

          $stmt -> close();
          $stmt = null;
  }

  static public function AtualizarEstadoMd($tabla, $dato){
    $stmt = ConexionBD::conectar()->prepare("UPDATE $tabla SET FK_E_LITIGIO = :FK_E_LITIGIO WHERE ID_LITIGIO = :ID_LITIGIO");

    $stmt -> bindParam(":ID_LITIGIO", $dato["ID_LITIGIO"], PDO::PARAM_INT);
    $stmt -> bindParam(":FK_E_LITIGIO", $dato["FK_E_LITIGIO"], PDO::PARAM_INT);

    if ($stmt -> execute()) {
      return "ok";
    }else{
      print_r(ConexionBD::conectar()->errorInfo());
    }

    $stmt -> close();
    $stmt = null;

  }

  static public function seleccionarTipoLitigioMd($tabla, $item, $valor){
    if ($item == null && $valor == null) {
      $stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla");
      $stmt -> execute();
      return $stmt -> fetchAll();

    }else{

        $stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetch();

    }
    $stmt -> close();
    $stmt = null;
  }

  static public function seleccionarCiudadMd($tabla, $item, $valor){
    if ($item == null && $valor == null) {
      $stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla");
      $stmt -> execute();
      return $stmt -> fetchAll();

    }else{

        $stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetch();

    }
    $stmt -> close();
    $stmt = null;
  }

  static public function ActualizarAbigadoLitigioMd($tabla, $dato){
    $stmt = ConexionBD::conectar()->prepare("UPDATE $tabla SET FK_ABOGADO = :FK_ABOGADO WHERE FK_ABOGADO = :ABOGADO_ANTIGUO AND FK_E_LITIGIO = 1");

    $stmt -> bindParam(":FK_ABOGADO", $dato["Abogado_Cargo"], PDO::PARAM_INT);
    $stmt -> bindParam(":ABOGADO_ANTIGUO", $dato["ID_ABOGADO"], PDO::PARAM_INT);

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
