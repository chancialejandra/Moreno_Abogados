<?php

require_once "conexion.php";

class CRUDClienteMd{

  static public function seleccionarTipoDocumentoMd($tabla, $item, $valor){
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


  static public function selecionarClientesMd($tabla, $item, $valor){
    if ($item == null && $valor == null) {
      $stmt = ConexionBD::conectar()->prepare("SELECT cl.ID_CLIENTE,
				                                              cl.NUMERO_DOCUMENTO,
                                                      cl.NOMBRE,
                                                      cl.APELLIDO,
                                                      cl.FECHA_NACIMIENTO,
                                                      cl.TELEFONO,
                                                      cl.CELULAR,
                                                      cl.CORREO,
                                                      cl.DIRECCION,
                                                      cl.CLAVE,
                                                      tpd.DESCRIPCION_TD,
                                                      tpp.DESCRIPCION_TP
                                                      FROM $tabla cl
                                              INNER JOIN TIPO_DOCUMENTO tpd
                                              ON cl.FK_T_DOCUEMNTO = tpd.ID_T_DOCUMENTO
                                              INNER JOIN TIPO_PERSONA tpp
                                              ON cl.FK_T_PERSONA = tpp.ID_T_PERSONA");
      $stmt -> execute();
      return $stmt -> fetchAll();

    }else{

        $stmt = ConexionBD::conectar()->prepare("SELECT cl.ID_CLIENTE,
				                                                cl.NUMERO_DOCUMENTO,
                                                        cl.NOMBRE,
                                                        cl.APELLIDO,
                                                        cl.FECHA_NACIMIENTO,
                                                        cl.TELEFONO,
                                                        cl.CELULAR,
                                                        cl.CORREO,
                                                        cl.DIRECCION,
                                                        cl.CLAVE,
                                                        cl.FK_T_DOCUEMNTO,
                                                        cl.FK_T_PERSONA,
                                                        tpd.DESCRIPCION_TD,
                                                        tpp.DESCRIPCION_TP
                                                        FROM $tabla cl
                                                INNER JOIN TIPO_DOCUMENTO tpd
                                                ON cl.FK_T_DOCUEMNTO = tpd.ID_T_DOCUMENTO
                                                INNER JOIN TIPO_PERSONA tpp
                                                ON cl.FK_T_PERSONA = tpp.ID_T_PERSONA
                                                WHERE $item = :$item ");
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetch();

    }
    $stmt -> close();
    $stmt = null;
  }

  static public function CrearClientesMd($tabla, $dato){

    $stmt = ConexionBD::conectar()->prepare("INSERT INTO $tabla (FK_T_DOCUEMNTO, FK_T_PERSONA, NUMERO_DOCUMENTO, NOMBRE,
                                                                APELLIDO, FECHA_NACIMIENTO, TELEFONO, CELULAR, CORREO,
                                                                DIRECCION, CLAVE)
                                                                VALUES (:FK_T_DOCUEMNTO, :FK_T_PERSONA, :NUMERO_DOCUMENTO, :NOMBRE, :APELLIDO,
                                                                :FECHA_NACIMIENTO, :TELEFONO, :CELULAR, :CORREO, :DIRECCION, :CLAVE)");

    $stmt -> bindParam(":FK_T_DOCUEMNTO", $dato["FK_T_DOCUEMNTO"], PDO::PARAM_INT);
    $stmt -> bindParam(":FK_T_PERSONA", $dato["FK_T_PERSONA"], PDO::PARAM_INT);
    $stmt -> bindParam(":NUMERO_DOCUMENTO", $dato["NUMERO_DOCUMENTO"], PDO::PARAM_STR);
    $stmt -> bindParam(":NOMBRE", $dato["NOMBRE"], PDO::PARAM_STR);
    $stmt -> bindParam(":APELLIDO", $dato["APELLIDO"], PDO::PARAM_STR);
    $stmt -> bindParam(":FECHA_NACIMIENTO", $dato["FECHA_NACIMIENTO"], PDO::PARAM_STR);
    $stmt -> bindParam(":TELEFONO", $dato["TELEFONO"], PDO::PARAM_STR);
    $stmt -> bindParam(":CELULAR", $dato["CELULAR"], PDO::PARAM_STR);
    $stmt -> bindParam(":DIRECCION", $dato["DIRECCION"], PDO::PARAM_STR);
    $stmt -> bindParam(":CLAVE", $dato["CLAVE"], PDO::PARAM_STR);
    $stmt -> bindParam(":CORREO", $dato["CORREO"], PDO::PARAM_STR);

    if ($stmt -> execute()) {
        return "ok";
    }else{
      print_r(ConexionBD::conectar()->errorInfo());
    }
    $stmt = null;
  }

  static public function ActualizarClientesMd($tabla, $dato){

        $stmt = ConexionBD::conectar()->prepare("UPDATE $tabla SET NUMERO_DOCUMENTO = :NUMERO_DOCUMENTO, NOMBRE = :NOMBRE,
                                                APELLIDO = :APELLIDO, FECHA_NACIMIENTO = :FECHA_NACIMIENTO, TELEFONO = :TELEFONO,
                                                CELULAR = :CELULAR, CORREO = :CORREO, DIRECCION = :DIRECCION,
                                                FK_T_DOCUEMNTO = :FK_T_DOCUEMNTO, FK_T_PERSONA = :FK_T_PERSONA
                                                WHERE ID_CLIENTE = :ID_CLIENTE");

          $stmt -> bindParam(":NUMERO_DOCUMENTO", $dato["NUMERO_DOCUMENTO"], PDO::PARAM_STR);
          $stmt -> bindParam(":NOMBRE", $dato["NOMBRE"], PDO::PARAM_STR);
          $stmt -> bindParam(":APELLIDO", $dato["APELLIDO"], PDO::PARAM_STR);
          $stmt -> bindParam(":FECHA_NACIMIENTO", $dato["FECHA_NACIMIENTO"], PDO::PARAM_STR);
          $stmt -> bindParam(":TELEFONO", $dato["TELEFONO"], PDO::PARAM_STR);
          $stmt -> bindParam(":CELULAR", $dato["CELULAR"], PDO::PARAM_STR);
          $stmt -> bindParam(":CORREO", $dato["CORREO"], PDO::PARAM_STR);
          $stmt -> bindParam(":DIRECCION", $dato["DIRECCION"], PDO::PARAM_STR);
          $stmt -> bindParam(":FK_T_DOCUEMNTO", $dato["FK_T_DOCUEMNTO"], PDO::PARAM_INT);
          $stmt -> bindParam(":FK_T_PERSONA", $dato["FK_T_PERSONA"], PDO::PARAM_INT);
          $stmt -> bindParam(":ID_CLIENTE", $dato["ID_CLIENTE"], PDO::PARAM_INT);

          if (  $stmt -> execute()) {
                return "ok";
          }else{
              print_r(ConexionBD::conectar()->errorInfo());
              echo "<br>";
              echo $dato["ID_CLIENTE"];
              echo "<br>";
              echo $dato["NOMBRE"];
              echo "<br>";
              echo $dato["APELLIDO"];
              echo "<br>";
              echo $dato["FK_T_DOCUEMNTO"];
              echo "<br>";
              echo $dato["NUMERO_DOCUMENTO"];
              echo "<br>";
              echo $dato["FK_T_PERSONA"];
              echo "<br>";
              echo $dato["TELEFONO"];
              echo "<br>";
              echo $dato["CELULAR"];
              echo "<br>";
              echo $dato["CORREO"];
              echo "<br>";
              echo $dato["DIRECCION"];
              echo "<br>";
              echo $dato["FECHA_NACIMIENTO"];
          }

          $stmt = null;
  }

  static public function seleccionarTipoPersonaMd($tabla, $item, $valor){
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

}
?>
