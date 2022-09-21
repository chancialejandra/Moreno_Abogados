<?php

class CRUDLitigioCtr{

  static public function seleccionarLitigiosCtr($item, $valor){

    $tabla = "LITIGIO";
    $respuesta = CRUDLitigioMd::SeleccionarLitigioMd($tabla, $item, $valor);
    return $respuesta;

  }

  static public function seleccionarLitigiosBuscadorCtr($item, $valor){

    $tabla = "LITIGIO";
    $respuesta = CRUDLitigioMd::SeleccionarLitigioBuscadorMd($tabla, $item, $valor);
    return $respuesta;

  }

  static public function contarLitigiosCtr($item, $valor){

    $tabla = "LITIGIO";
    $respuesta = CRUDLitigioMd::ContarLitigioActMD($tabla, $item, $valor);
    return $respuesta;

  }

  static public function seleccionarLitigiosIndCtr($item, $valor){

    $tabla = "LITIGIO";
    $respuesta = CRUDLitigioMd::SeleccionarLitigioIndMD($tabla, $item, $valor);
    return $respuesta;

  }

  static public function crearLitigioCtr(){

      $tabla = "LITIGIO";

      $item = "NUMERO_DOCUMENTO";
      $valor = $_POST["NAbogado"];
      $id_abogado = CRUDAbogadosCtr::seleccionarAbogadosCtr($item, $valor);

      $itemC = "NUMERO_DOCUMENTO";
      $valorC = $_POST["NDocumento"];
      $id_cliente = CRUDClientesCtr::SeleccionarClienteCtr($itemC, $valorC);

      $datos = array("FK_T_LITIGIO"=>$_POST["TipoCaso"], "RADICADO"=>$_POST["Radicado"], "FK_CIUDAD"=>$_POST["Ciudad"],
                    "FK_JUZGADO"=>$_POST["Juzgado"], "FK_CONTRAPARTE"=>$_POST["NAbogadoContraparte"],
                    "FK_CLIENTE" => $id_cliente["ID_CLIENTE"], "FK_E_LITIGIO" => 1, "FK_ABOGADO" =>$_POST["NAbogado"],
                    "FECHA_CREACION" => date("Y-m-d"));

      $respuesta = CRUDLitigioMd::CrearLitigioMd($tabla, $datos);
      return $respuesta;

  }

  public function ctrAtualizarLitigio(){

      $tabla = "LITIGIO";
      $datos =  array("ID_LITIGIO" => $_POST["id_Lit"], "FK_T_LITIGIO" => $_POST["TipoCaso"], "RADICADO" => $_POST["Radicado"],
                      "FK_CIUDAD" => $_POST["Ciudad"], "FK_JUZGADO" => $_POST["Juzgado"], "FK_ABOGADO" => $_POST["Abogado"],
                      "FK_CONTRAPARTE" => $_POST["NContraparte"]);


      $respuesta = CRUDLitigioMd::ActualizarLitigiosMd($tabla, $datos);

      if ($respuesta == "ok") {
        echo '<script>
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
        </script>';
        echo '<div class="alert alert-success" role="alert"> El Litigio ha sido atualizado exitosamente! </div>';
      }

    }

    public function ctrActualizarEstado(){
      $tabla = "LITIGIO";

        if ($_POST["EstadoLT"] == 2) {
          $Estado = 1;
        }else {
          $Estado = 2;
        }




      $datos = array("ID_LITIGIO" => $_POST["id_Lit"], "FK_E_LITIGIO" => $Estado);

      $respuesta = CRUDLitigioMd::AtualizarEstadoMd($tabla, $datos);
      if ($respuesta == "ok") {
        echo '<script>
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
        </script>';
        echo '<div class="alert alert-success" role="alert"> El Litigio ha sido atualizado exitosamente! </div>';
      }
    }

    static public function seleccionarTipoLitigiodCtr($item, $valor){

      $tabla = "TIPO_LITIGIO";
      $respuesta = CRUDLitigioMd::seleccionarTipoLitigioMd($tabla, $item, $valor);
      return $respuesta;

    }

    static public function seleccionarCiudaddCtr($item, $valor){

      $tabla = "CIUDAD";
      $respuesta = CRUDLitigioMd::seleccionarCiudadMd($tabla, $item, $valor);
      return $respuesta;

    }

  }

?>
