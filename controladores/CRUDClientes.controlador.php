<?php

class CRUDClientesCtr
{

/*

Metodo encargado del envio de correo a Gmail a travez del servidor SMTP, la cuenta aca asociada debe estar autorizada
para el envio y uso de aplicaciones de terceros, si esto no esta activo, el metodo se ejecutara pero nunca enviara correos,
tener cuidado a la hora de montarlo al servidor ya que la rutina de SMTP se puede ver afectada
  static public function EnvioCorreo($valor){

    $item = "NUMERO_DOCUMENTO";
    $Cliente = CRUDClientesCtr::SeleccionarClienteCtr($item, $valor);
    $destinatario = $Cliente["CORREO"];
    $asunto = "RECUPERACION DE CLAVE SOFTWARE MORENO ABOGADOS";
    $mensaje = "Hola, Sr/Sra. ".$Cliente["NOMBRE"]." nos complace informarle que desde Moreno Abogados es muy grato tenerte como cliente,
              por tal motivo, en este correo pordras ver la clave de tu usuario para que puedas realizar
              un seguimiento a los procesos que tengas con nosotros <br><br><br>CLAVE: ".$Cliente["CLAVE"]."<br><br><br>Esperamos tenga feliz dia";


    require "PHPMailer/PHPMailerAutoload.php";
try{
    $mail = new PHPMailer;
    $mail-> isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail ->Port = 587;
    $mail ->SMTPAuth = true;
    $mail ->SMTPSecure = "tls";
    $mail ->Username = "";
    $mail ->Password = "";

    $mail ->setFrom("", "Moreno Abogados");
    $mail ->addAddress($destinatario);
    $mail ->addReplyTo("", "Moreno Abogados");

    $mail->isHTML(true);
    $mail->Subject = $asunto;
    $mail->Body = $mensaje;

    $mail->send();
  //  $mail = mail($destinatario, $asunto, $mensaje);
}catch(Exception $e){
  echo $e;
}

    return $mail;
  }

*/
  static public function seleccionarTipoDocumentoCtr($item, $valor){

    $tabla = "TIPO_DOCUMENTO";
    $respuesta = CRUDClienteMd::seleccionarTipoDocumentoMd($tabla, $item, $valor);
    return $respuesta;

  }


  static public function SeleccionarClienteCtr($item, $valor){

      $tabla = "CLIENTE";
      $respuesta = CRUDClienteMd::selecionarClientesMd($tabla, $item, $valor);
      return $respuesta;

  }
static public function CrearClienteCtr(){
        if (isset($_POST["TipoCaso"])) {
          $tabla = "CLIENTE";
          $datos =  array("FK_T_DOCUEMNTO" => $_POST["TDocumento"], "FK_T_PERSONA" => $_POST["TPersona"],
          "NUMERO_DOCUMENTO" => $_POST["NDocumento"], "NOMBRE" => $_POST["NombreC"],
          "APELLIDO" => $_POST["ApellidoC"], "FECHA_NACIMIENTO" => $_POST["FNacimiento"],
          "TELEFONO" => $_POST["TelefonoC"], "CELULAR" => $_POST["CelularC"],
          "CORREO" => $_POST["CorreoC"], "DIRECCION" => $_POST["DireccionC"],
          "CLAVE" => $_POST["NDocumento"]."MoAb");

           $respuesta = CRUDClienteMd::CrearClientesMd($tabla, $datos);
           return $respuesta;
         }
  }

  public function ctrIngresarCliente(){

    if (isset($_POST["UsuarioCliente"])) {
      $tabla = "CLIENTE";
      $item = "NUMERO_DOCUMENTO";
      $valor = $_POST["UsuarioCliente"];

      $respuesta = CRUDAbogadoMd::selecionarAbogadosMd($tabla, $item, $valor);

      if ($respuesta["NUMERO_DOCUMENTO"] == $_POST["UsuarioCliente"] && $respuesta["CLAVE"] ==  $_POST["ContrasenaCliente"]) {


          $_SESSION["Cliente"] = 2;
          $id = $respuesta["ID_CLIENTE"];

       echo '<script>
         if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
          }

            window.location = "index.php?page=cliente&id_Cl='.$id.'";

          </script>';

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

  public function ctrAtualizarCliente(){

      $tabla = "CLIENTE";
      $datos =  array("ID_CLIENTE" => $_POST["id_Cl"], "FK_T_PERSONA" => $_POST["TPersona"], "FK_T_DOCUEMNTO" => $_POST["TDocumento"],
                      "NUMERO_DOCUMENTO" => $_POST["NDocumento"], "NOMBRE" => $_POST["NombreC"],
                      "APELLIDO" => $_POST["ApellidoC"], "FECHA_NACIMIENTO" => $_POST["FNacimiento"],
                      "TELEFONO" => $_POST["TelefonoC"], "CELULAR" => $_POST["CelularC"],
                      "CORREO" => $_POST["CorreoC"], "DIRECCION" => $_POST["DireccionC"]);


      $respuesta = CRUDClienteMd::ActualizarClientesMd($tabla, $datos);

      if ($respuesta == "ok") {
        echo '<script>
        if (window.history.replaceState) {
          //window.history.replaceState(null, null, window.location.href);
        }
        </script>';
        echo '<div class="alert alert-success" role="alert"> El Cliente ha sido atualizado exitosamente! </div>';

      }

    }

    static public function seleccionarTipoPersonaCtr($item, $valor){

      $tabla = "TIPO_PERSONA";
      $respuesta = CRUDClienteMd::seleccionarTipoPersonaMd($tabla, $item, $valor);
      return $respuesta;

    }

}

 ?>
