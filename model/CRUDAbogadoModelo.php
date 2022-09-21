<?php

require_once "conexion.php";


class CRUDAbogadoMd{

  static public function selecionarAbogadosMd($tabla, $item, $valor){



    if ($item == null && $valor == null) {
      $stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla WHERE FK_E_ABOGADO = 1");
      $stmt -> execute();
      return $stmt -> fetchAll();

    }else{
        $stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ");
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetch();

    }
    $stmt -> close();
    $stmt = null;
  }


  static public function CrearAbogadosMd($tabla, $dato){

    $stmt = ConexionBD::conectar()->prepare("INSERT INTO $tabla (NOMBRE, APELLIDO, NUMERO_DOCUMENTO,
                                                                FECHA_NACIMIENTO, DIRECCION, CORREO, TELEFONO,
                                                                TARJETA_PROFESIONAL, FK_ESPECIALIDAD, FK_E_ABOGADO,
                                                                FK_T_ABOGADO, FK_T_DOCUMENTO)
                                                        VALUES (:NOMBRE, :APELLIDO, :NUMERO_DOCUMENTO, :FECHA_NACIMIENTO,
                                                                :DIRECCION, :CORREO, :TELEFONO, :TARJETA_PROFESIONAL,
                                                                :FK_ESPECIALIDAD, :FK_E_ABOGADO, :FK_T_ABOGADO, :FK_T_DOCUMENTO)");

    $stmt -> bindParam(":FK_T_DOCUMENTO", $dato["FK_T_DOCUMENTO"], PDO::PARAM_INT);
    $stmt -> bindParam(":FK_T_ABOGADO", $dato["FK_T_ABOGADO"], PDO::PARAM_INT);
    $stmt -> bindParam(":NOMBRE", $dato["NOMBRE"], PDO::PARAM_STR);
    $stmt -> bindParam(":APELLIDO", $dato["APELLIDO"], PDO::PARAM_STR);
    $stmt -> bindParam(":NUMERO_DOCUMENTO", $dato["NUMERO_DOCUMENTO"], PDO::PARAM_STR);
    $stmt -> bindParam(":TARJETA_PROFESIONAL", $dato["TARJETA_PROFESIONAL"], PDO::PARAM_STR);
    $stmt -> bindParam(":FK_ESPECIALIDAD", $dato["FK_ESPECIALIDAD"], PDO::PARAM_INT);
    $stmt -> bindParam(":FECHA_NACIMIENTO", $dato["FECHA_NACIMIENTO"], PDO::PARAM_STR);
    $stmt -> bindParam(":CORREO", $dato["CORREO"], PDO::PARAM_STR);
    $stmt -> bindParam(":DIRECCION", $dato["DIRECCION"], PDO::PARAM_STR);
    $stmt -> bindParam(":TELEFONO", $dato["TELEFONO"], PDO::PARAM_STR);
    $stmt -> bindParam(":FK_E_ABOGADO", $dato["FK_E_ABOGADO"], PDO::PARAM_INT);

    if ( $stmt -> execute()) {
        return "ok";
    }else{
      print_r(ConexionBD::conectar()->errorInfo());
    }

    $stmt -> close();
    $stmt = null;
  }

  static public function ActualizarAbogadosMd($tabla, $dato){

        $stmt = ConexionBD::conectar()->prepare("UPDATE $tabla SET FK_T_DOCUMENTO = :FK_T_DOCUMENTO,
                                                NOMBRE = :NOMBRE,
                                                APELLIDO = :APELLIDO,
                                                NUMERO_DOCUMENTO = :NUMERO_DOCUMENTO,
                                                TARJETA_PROFESIONAL = :TARJETA_PROFESIONAL,
                                                FK_ESPECIALIDAD = :FK_ESPECIALIDAD,
                                                FECHA_NACIMIENTO = :FECHA_NACIMIENTO,
                                                CORREO = :CORREO,
                                                DIRECCION = :DIRECCION,
                                                TELEFONO = :TELEFONO
                                                WHERE ID_ABOGADO = :ID_ABOGADO");

          $stmt -> bindParam(":FK_T_DOCUMENTO", $dato["FK_T_DOCUMENTO"], PDO::PARAM_INT);
          $stmt -> bindParam(":NOMBRE", $dato["NOMBRE"], PDO::PARAM_STR);
          $stmt -> bindParam(":APELLIDO", $dato["APELLIDO"], PDO::PARAM_STR);
          $stmt -> bindParam(":NUMERO_DOCUMENTO", $dato["NUMERO_DOCUMENTO"], PDO::PARAM_STR);
          $stmt -> bindParam(":TARJETA_PROFESIONAL", $dato["TARJETA_PROFESIONAL"], PDO::PARAM_STR);
          $stmt -> bindParam(":FK_ESPECIALIDAD", $dato["FK_ESPECIALIDAD"], PDO::PARAM_INT);
          $stmt -> bindParam(":FECHA_NACIMIENTO", $dato["FECHA_NACIMIENTO"], PDO::PARAM_STR);
          $stmt -> bindParam(":CORREO", $dato["CORREO"], PDO::PARAM_STR);
          $stmt -> bindParam(":DIRECCION", $dato["DIRECCION"], PDO::PARAM_STR);
          $stmt -> bindParam(":TELEFONO", $dato["TELEFONO"], PDO::PARAM_STR);
          $stmt -> bindParam(":ID_ABOGADO", $dato["ID_ABOGADO"], PDO::PARAM_INT);

          if (  $stmt -> execute()) {
                return "ok";
          }else{
              print_r(ConexionBD::conectar()->errorInfo());
          }

          $stmt -> close();
          $stmt = null;
  }

  static public function selecionarAbogadosInactivosMd($tabla, $item, $valor){

    if ($item == null && $valor == null) {
      $stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla WHERE FK_E_ABOGADO = 2");
      $stmt -> execute();
      return $stmt -> fetchAll();

    }else{
        $stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ");
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetch();

    }

      $stmt -> close();
      $stmt = null;
  }

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

  static public function seleccionarEspecialidadMd($tabla, $item, $valor){
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


  static public function AtualizarEstadoMd($tabla, $dato){
    $stmt = ConexionBD::conectar()->prepare("UPDATE $tabla SET FK_E_ABOGADO = :FK_E_ABOGADO WHERE ID_ABOGADO = :ID_ABOGADO");

    $stmt -> bindParam(":FK_E_ABOGADO", $dato["estado"], PDO::PARAM_INT);
    $stmt -> bindParam(":ID_ABOGADO", $dato["ID_ABOGADO"], PDO::PARAM_INT);

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
