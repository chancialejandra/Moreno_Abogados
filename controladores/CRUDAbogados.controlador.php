<?php

/**
 *
 */
class CRUDAbogadosCtr
{


  static public function seleccionarAbogadosCtr($item, $valor){

    $tabla = "ABOGADO";
    $respuesta = CRUDAbogadoMd::selecionarAbogadosMd($tabla, $item, $valor);
    return $respuesta;

  }


static public function crearAbogadosCtr(){

    if (isset($_POST["Name"])) {
      $tabla = "ABOGADO";
      $datos =  array("FK_T_DOCUMENTO" => $_POST["TipoDoc"], "FK_T_ABOGADO" => 2, "NOMBRE" => $_POST["Name"],
                      "APELLIDO" => $_POST["Apellidos"], "NUMERO_DOCUMENTO" => $_POST["Documento"],
                      "TARJETA_PROFESIONAL" => $_POST["Tarjeta"], "FK_ESPECIALIDAD" => $_POST["Especialidad"],
                      "FECHA_NACIMIENTO" => $_POST["Fecha"], "CORREO" => $_POST["Correo"],
                      "DIRECCION" => $_POST["Direccon"], "TELEFONO" => $_POST["Telefono"], "FK_E_ABOGADO" => 1);

       $respuesta = CRUDAbogadoMd::CrearAbogadosMd($tabla, $datos);
       return $respuesta;
    }
  }




  public function ctrIngresarAbogado(){

    if (isset($_POST["Usuario"])) {
      $tabla = "ABOGADO";
      $item = "CORREO";
      $valor = $_POST["Usuario"];

      $respuesta = CRUDAbogadoMd::selecionarAbogadosMd($tabla, $item, $valor);

      if ($respuesta["CORREO"] == $_POST["Usuario"] && $respuesta["NUMERO_DOCUMENTO"] ==  $_POST["Contrasena"] && $respuesta["FK_E_ABOGADO"] == '1') {

        if ($respuesta["FK_T_ABOGADO"] == 1) {

          $_SESSION["Admin"] = 1;

          echo '<script>
          if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
          }

          window.location = "index.php?page=AbogadoAdmin&abogado='.$respuesta["ID_ABOGADO"].'";

          </script>';
        }else{

          $_SESSION["Admin"] = 2;

          echo '<script>
          if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
          }

          window.location = "index.php?page=Abogado&abogado='.$respuesta["ID_ABOGADO"].'";

          </script>';
        }


      }else{
        if ($respuesta["FK_E_ABOGADO"]!="") {

          if ($respuesta["FK_E_ABOGADO"] == 2) {
            echo '<script>
            if (window.history.replaceState) {
              window.history.replaceState(null, null, window.location.href);
            }
            </script>';

          echo '<div class="alert alert-danger" role="alert"> El usuario no se enceuntra activo en el sistema </div>';

        }else{
          echo '<script>
          if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
          }
          </script>';

          echo '<div class="alert alert-danger" role="alert"> El usurio no se encuentra registrado o el usuario y clave son erradas </div>';

        }
      }
      }

    }

  }






  public function ctrAtualizarAbogado(){
    $estado = "";
    if (isset($_POST["id_Ab"])) {

      $tabla = "ABOGADO";
      $datos =  array("ID_ABOGADO" => $_POST["id_Ab"], "FK_T_DOCUMENTO" => $_POST["AcTipoDoc"], "NOMBRE" => $_POST["AcName"],
                      "APELLIDO" => $_POST["AcApellidos"], "NUMERO_DOCUMENTO" => $_POST["AcDocumento"],
                      "TARJETA_PROFESIONAL" => $_POST["AcTarjeta"], "FK_ESPECIALIDAD" => $_POST["AcEspecialidad"],
                      "FECHA_NACIMIENTO" => $_POST["AcFecha"], "CORREO" => $_POST["AcCorreo"],
                      "DIRECCION" => $_POST["AcDireccon"], "TELEFONO" => $_POST["AcTelefono"]);

      $respuesta = CRUDAbogadoMd::ActualizarAbogadosMd($tabla, $datos);

      if ($respuesta == "ok") {
        echo '<script>
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
        </script>';
        echo '<div class="alert alert-success" role="alert"> El usuario ha sido atualizado exitosamente! </div>';
      }

    }
  }

  static public function seleccionarAbogadosInactivosCtr($item, $valor){

    $tabla = "ABOGADO";
    $respuesta = CRUDAbogadoMd::selecionarAbogadosInactivosMd($tabla, $item, $valor);
    return $respuesta;

  }

  static public function seleccionarTipoDocumentoCtr($item, $valor){

    $tabla = "TIPO_DOCUMENTO";
    $respuesta = CRUDAbogadoMd::seleccionarTipoDocumentoMd($tabla, $item, $valor);
    return $respuesta;

  }

  static public function seleccionarEspecialidadCtr($item, $valor){

    $tabla = "ESPECIALIDAD";
    $respuesta = CRUDAbogadoMd::seleccionarEspecialidadMd($tabla, $item, $valor);
    return $respuesta;

  }

  public function ActualizarEstadoInactivoCtr(){
    $tabla = "ABOGADO";

    if ($_POST["Estado_Abg"] = 1) {
      $Estado = 2;
    }

    $datos = array("ID_ABOGADO" => $_POST["id_Abg"], "estado" => $Estado);

    $respuesta = CRUDAbogadoMd::AtualizarEstadoMd($tabla, $datos);
    if ($respuesta == "ok") {
      echo '<script>
      if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
      }
      </script>';
      echo '<div class="alert alert-success" role="alert"> El estado del abogado se ha actualizado con exito! </div>';
    }
  }

  public function ActualizarEstadoInactivo_CambioL(){
    $tabla = "ABOGADO";
    $tabla2 = "LITIGIO";

    if ($_POST["Estado_Abg"] = 1) {
      $Estado = 2;
    }

    $datos = array("ID_ABOGADO" => $_POST["id_Abg"], "estado" => $Estado, "Abogado_Cargo" => $_POST["Abogado_Cambio"]);

    $respuesta = CRUDAbogadoMd::AtualizarEstadoMd($tabla, $datos);
    $respuestaACtL = CRUDLitigioMd::ActualizarAbigadoLitigioMd($tabla2, $datos);

    if ($respuesta == "ok" && $respuestaACtL == "ok") {
      echo '<script>
      if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
      }
      </script>';
      echo '<div class="alert alert-success" role="alert"> El estado del abogado y los litigios se han actualizado con exito! </div>';
    }
  }

  public function ActualizarEstadoActivoCtr(){
    $tabla = "ABOGADO";

    if ($_POST["Estado_Abg"] = 2) {
      $Estado = 1;
    }

    $datos = array("ID_ABOGADO" => $_POST["id_Abg"], "estado" => $Estado);

    $respuesta = CRUDAbogadoMd::AtualizarEstadoMd($tabla, $datos);
    if ($respuesta == "ok") {
      echo '<script>
      if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
      }
      </script>';
      echo '<div class="alert alert-success" role="alert"> El estado del abogado se ha actualizado con exito! </div>';
    }
  }

}





 ?>
