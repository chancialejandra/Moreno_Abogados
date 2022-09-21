<?php

/**
 *
 */
class CRUDActuacionCtr
{

  static public function seleccionarActuacionCtr($item, $valor){

    $tabla = "ACTUACION";
    $respuesta = CRUDActuacionMd::selecionarActuacionMd($tabla, $item, $valor);
    return $respuesta;

  }

  static public function crearActuacionCtr(){
    date_default_timezone_set('America/Bogota');
    if (isset($_POST["Actuacion"])) {
      $tabla = "ACTUACION";
      $FECHA_CREACION = date('Y-m-d G:i:s');

      $datos =  array("DESCRIPCION_AC" => $_POST["Actuacion"], "FECHA_CREACION" => $FECHA_CREACION ,"LITIGIO_ID_LITIGIO" => $_POST["id_Lit"]);

       $respuesta = CRUDActuacionMd::CrearActuacionMd($tabla, $datos);
       return $respuesta;
    }
  }

  public function ctrAtualizarActuacion(){
      date_default_timezone_set('America/Bogota');
      $tabla = "ACTUACION";
      $FECHA_CREACION = date('Y-m-d G:i:s');

      $datos =  array("DESCRIPCION_AC" => $_POST["Actuacion"], "FECHA_CREACION" => $FECHA_CREACION ,"ID_ACTUACION" => $_POST["id_Act"]);


      $respuesta = CRUDActuacionMd::ActualizarActuacionMd($tabla, $datos);

      if ($respuesta == "ok") {
        echo '<script>
        if (window.history.replaceState) {
          //window.history.replaceState(null, null, window.location.href);
        }
        </script>';
        echo '<div class="alert alert-success" role="alert"> La Actuacion se ha actualizado con exito! </div>';

      }

    }

    public function ctrEliminarActuacion(){
        $tabla = "ACTUACION";

        $datos =  array("ID_ACTUACION" => $_POST["id_Act"]);

        $respuesta = CRUDActuacionMd::EliminarActuacionMd($tabla, $datos);

        if ($respuesta == "ok") {
          echo '<script>
          if (window.history.replaceState) {
            //window.history.replaceState(null, null, window.location.href);
          }
          </script>';
          echo '<div class="alert alert-success" role="alert"> La Actuacion se ha eliminado con exito! </div>';

        }

      }


}





 ?>
