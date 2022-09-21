

<?php
if (isset($_SESSION["Admin"])) {

  if (!isset($_SESSION["Admin"])) {
    echo '<script> window.location = "index.php?page=inicio"; </script>';
    return;
  }

}else{
  echo '<script> window.location = "index.php?page=inicio"; </script>';
  return;
}

if (isset($_GET["id_Cl"])) {
  $item = "ID_CLIENTE";
  $valor = $_GET["id_Cl"];
  $DatosCliente = CRUDClientesCtr::SeleccionarClienteCtr($item, $valor);
}

$id_AbogadoSystem = $_GET["abogado"];


$valorTipoDocumento = CRUDClientesCtr::seleccionarTipoDocumentoCtr(null, null);

 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="CSS/bootstrap.min.css">
    </head>
    <body>
        <!-- Barra navegacion -->
        <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php?page=AccionesClientes&id_Cl=<?php echo $DatosCliente["ID_CLIENTE"];?>&abogado=<?php echo $id_AbogadoSystem; ?>&abogado=<?php echo $id_AbogadoSystem; ?>">
                <img src="IMG/Logo1.png" width="100" height="100" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ml-3" id="navbarTogglerDemo02">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

              </ul>
                <a class="navbar-brand" href="index.php?page=AccionesClientes&id_Cl=<?php echo $DatosCliente["ID_CLIENTE"]; ?>&abogado=<?php echo $id_AbogadoSystem; ?>">Atras</a>
            </div>
        </nav>

        <!-- Cuerpo -->
        <div class="container-fluid text-center">

          <div>
            <hr>
              <h5 class="" id="exampleModalLabel">Formulario de modificacion para: <strong><?php echo $DatosCliente["NOMBRE"]; echo " "; echo $DatosCliente["APELLIDO"] ?></strong></h5>
            <hr>
          </div>

          <?php

          if (isset($_POST["F_EditarCliente"])) {

            $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
            $TPersona = $_POST["TPersona"];
            $TDocumento = $_POST["TDocumento"];
            $NDocumento = $_POST["NDocumento"];
            $Nombre = $_POST["NombreC"];
            $Apellido = $_POST["ApellidoC"];
            $Telefono = $_POST["TelefonoC"];
            $Celular = $_POST["CelularC"];
            $Correo = $_POST["CorreoC"];
            $Direccion = $_POST["DireccionC"];
            $campos = array();
            $clave = $NDocumento.$Nombre."Cc";
            $FNacimiento = $_POST["FNacimiento"];
            $FActual = date("Y-m-d");

            if (empty($FNacimiento)) {
              array_push($campos, "Por favor ingrese la fecha de nacimeinto del cliente");
            }


            if (empty($Nombre) or empty($Apellido)) {
              array_push($campos, "Por favor ingrese el nombre y apellido del cliente");
            }else if (!preg_match($patron_texto,$Nombre) or !preg_match($patron_texto,$Apellido)) {
              array_push($campos, "Por favor no ingrese caracteres numericos en los campos del Nombre y Apellido del cliente");
            }

            if (!empty($Telefono)) {
              if (!is_numeric($Telefono)) {
                array_push($campos, "El telefono dle cliente solo debe contener valores numeros");
              }
            }

            if (empty($Celular)) {
              array_push($campos, "Por favor ingrese el numero celular del cliente");
            }else if (!is_numeric($Celular)) {
              array_push($campos, "El celular del cliente solo debe contener valores numericos");
            }

            if (empty($Correo)) {
              array_push($campos, "Por favor ingrese el correo del cliente");
            }else if (!filter_var($Correo, FILTER_VALIDATE_EMAIL)) {
              array_push($campos, "El correo del cliente no es valido");
            }else if (is_numeric($Correo)) {
              array_push($campos, "El correo del cliente no es valido");
            }

            if (empty($Direccion)) {
              array_push($campos, "Por favor ingrese la direccion del cliente");
            }


            if ($TDocumento == "Seleccione...") {
              array_push($campos, "Por favor seleccione una opción valida en Tipo de Documento del cliente");
            }

            if ($TPersona == "Seleccione...") {
              array_push($campos, "Por favor seleccione una opción valida en Tipo de Persona");
            }


            if (empty($NDocumento)) {
              array_push($campos, "Por favor ingrese el documento del cliente");
            }else{
              if (!is_numeric($NDocumento)) {
                array_push($campos, "Por favor no ingrese caracteres no numericos en el documento del cliente");
              }
            }


          if (count($campos) > 0) {
            echo '<div class="alert alert-danger" role="alert">';
            for ($i=0; $i < count($campos); $i++) {
                echo '<li>'.$campos[$i].'</li>';
            }
              echo '</div>';
          }else{

            $ValidarCliente = CRUDClientesCtr::SeleccionarClienteCtr(null, null);
            $contador = 0;

            foreach ($ValidarCliente as $key => $value) {
              if ($value["NUMERO_DOCUMENTO"] == $_POST["NDocumento"]) {
                if ($value["ID_CLIENTE"] != $DatosCliente["ID_CLIENTE"]) {
                  $contador++;
                }
              }
            }

            if ($contador < 1) {
              $ActualizarCliente = new CRUDClientesCtr();
              $ActualizarCliente -> ctrAtualizarCliente();
            }else{
              echo '<div class="alert alert-danger" role="alert">La cedula del cliente que ingreso ya se encuentra registrada</div>';
            }

          }
        }

        ?>

        <form class="needs-validation" action="" method="POST" novalidate>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                  <input type="hidden" name="id_Cl" value=" <?php echo $DatosCliente["ID_CLIENTE"] ?> ">
                  <label for="NombreC">Nombre</label>
                  <input type="text" class="form-control valid" id="NombreC" name="NombreC" value="<?php
                    echo $DatosCliente["NOMBRE"]
                  ?>">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="ApellidoC">Apellidos</label>
                  <input type="text" class="form-control valid" id="ApellidoC" name="ApellidoC" value="<?php
                    echo $DatosCliente["APELLIDO"]
                  ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                  <label for="TDocumento">Tipo de Documento</label>
                  <select class="custom-select" id="TDocumento" name="TDocumento">
                    <option value="<?php echo $DatosCliente["FK_T_DOCUEMNTO"] ?>" selected><?php echo $DatosCliente["DESCRIPCION_TD"] ?></option>
                    <?php foreach ($valorTipoDocumento as $key => $value): ?>
                      <option value="<?php echo $value["ID_T_DOCUMENTO"] ?>"> <?php echo $value["DESCRIPCION_TD"] ?> </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="NDocumento">Número de Documento</label>
                  <input type="text" class="form-control valid" id="NDocumento" name="NDocumento" value="<?php
                    echo $DatosCliente["NUMERO_DOCUMENTO"]
                  ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                  <label for="TPersona">Tipo Persona</label>
                  <select class="custom-select" id="TPersona" name="TPersona">
                    <option value="<?php echo $DatosCliente["FK_T_PERSONA"] ?>" selected><?php echo $DatosCliente["DESCRIPCION_TP"] ?></option>
                    <option value="1">Natural</option>
                    <option value="2">Juridica</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="TelefonoC">Numero Fijo</label>
                  <input type="tel" class="form-control" id="TelefonoC" name="TelefonoC" value="<?php
                    echo $DatosCliente["TELEFONO"]
                   ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                  <label for="CelularC">Celular</label>
                  <input type="tel" class="form-control valid" id="CelularC" name="CelularC" value="<?php
                    echo $DatosCliente["CELULAR"]
                  ?>">
                </div>
                <div class="col-md-6">
                  <label for="CorreoC">Correo</label>
                  <input type="email" class="form-control valid" id="CorreoC" name="CorreoC" value="<?php
                    echo $DatosCliente["CORREO"]
                  ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="DireccionC">Dirección</label>
                  <input type="text" class="form-control valid" id="DireccionC" name="DireccionC" value="<?php
                    echo $DatosCliente["DIRECCION"]
                  ?>">
                </div>
                <div class="col-md-6">
                  <label for="FNacimiento">Fecha de Nacimiento</label>
                  <input type="date" class="form-control valid" id="FNacimiento" name="FNacimiento" value="<?php
                    echo $DatosCliente["FECHA_NACIMIENTO"]
                  ?>">
                </div>
            </div>
              <button class="btn btn-dark col-3 mb-5 mt-2 py-2" style="width: 40%" name="F_EditarCliente" type="submit">Actualizar</button>
        </form>

        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
</html>
