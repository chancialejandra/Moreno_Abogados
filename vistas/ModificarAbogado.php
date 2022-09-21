

<?php
if (isset($_SESSION["Admin"])) {

  if ($_SESSION["Admin"] != 1) {
    echo '<script> window.location = "index.php?page=inicio"; </script>';
    return;
  }

}else{
  echo '<script> window.location = "index.php?page=inicio"; </script>';
  return;
}

if (isset($_GET["id"])) {
  $item = "ID_ABOGADO";
  $valor = $_GET["id"];
  $DatosAbogado = CRUDAbogadosCtr::seleccionarAbogadosCtr($item, $valor);

  $item2 = "ID_T_DOCUMENTO";
  $valor2 = $DatosAbogado["FK_T_DOCUMENTO"];
  $valorTipoDocumento = CRUDAbogadosCtr::seleccionarTipoDocumentoCtr($item2, $valor2);

  $item3 = "ID_ESPECIALIDAD";
  $valor3 = $DatosAbogado["FK_ESPECIALIDAD"];
  $valorEspecialidad = CRUDAbogadosCtr::seleccionarEspecialidadCtr($item3, $valor3);

}

$id_AbogadoSystem = $_GET["abogado"];
$Especialidad = CRUDAbogadosCtr::seleccionarEspecialidadCtr(null, null);
$T_Documento = CRUDAbogadosCtr::seleccionarTipoDocumentoCtr(null, null);
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
            <a class="navbar-brand" href="index.php?page=Acciones_Abogados&id=<?php echo $DatosAbogado["ID_ABOGADO"];?>&abogado=<?php echo $id_AbogadoSystem; ?>">
                <img src="IMG/Logo1.png" width="100" height="100" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ml-3" id="navbarTogglerDemo02">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

              </ul>
                <a class="navbar-brand" href="index.php?page=Acciones_Abogados&id=<?php echo $DatosAbogado["ID_ABOGADO"];?>&abogado=<?php echo $id_AbogadoSystem; ?>">Atras</a>
            </div>
        </nav>

        <!-- Cuerpo -->
        <div class="container-fluid text-center">
          <div>
            <hr>
              <h5 class="" id="exampleModalLabel">Formulario de modificacion para: <strong><?php echo $DatosAbogado["NOMBRE"]; echo " "; echo $DatosAbogado["APELLIDO"] ?></strong></h5>
            <hr>
          </div>

          <br>

          <?php

          if (isset($_POST["ntualizar"])) {
            $nombre = $_POST["AcName"];
            $apellido = $_POST["AcApellidos"];
            $tipoDoc = $_POST["AcTipoDoc"];
            $numeroDoc = $_POST["AcDocumento"];
            $tarjeta = $_POST["AcTarjeta"];
            $especialidad = $_POST["AcEspecialidad"];
            $fecha = $_POST["AcFecha"];
            $telefono = $_POST["AcTelefono"];
            $correo = $_POST["AcCorreo"];
            $direccion = $_POST["AcDireccon"];
            $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
            $id_Abog = $_POST["id_Ab"];

            $campos = array();
            if (empty($nombre)) {
              array_push($campos, "Porfavor ingrese el nombre del abogado");
            }else{
              if (is_numeric($nombre)) {
                array_push($campos, "Porfavor ingrese no ingrese caracteres numericos en el nombre");
              }else{
                if(!preg_match($patron_texto, $nombre)){
                      array_push($campos, "El nombre no debe contener numeross");
                }
              }
            }


            if (empty($apellido)) {
              array_push($campos, "Porfavor ingrese los apellidos del abogado");
            }else{
              if (is_numeric($apellido)) {
                array_push($campos, "Porfavor ingrese no ingrese caracteres numericos en el apellido");
              }else{
                if(!preg_match($patron_texto, $apellido)){
                      array_push($campos, "El apellido no debe contener numeros");
                }
              }
            }

            if ($tipoDoc == "Seleccione...") {
              array_push($campos, "Porfavor seleccione una opción valida en Tipo de documento");
            }

            if (empty($numeroDoc)) {
              array_push($campos, "Porfavor ingrese el correspondiente número de identificacion del abogado");
            }else{
              if (strlen($numeroDoc) > 20) {
                array_push($campos, "El documento no puede ser mayor a 20 caracteres");
              }else{
                if (!is_numeric($numeroDoc)) {
                  array_push($campos, "El documento debe ser numerico");
                }
              }
            }

            if ($especialidad == "Seleccione...") {
              array_push($campos, "Porfavor seleccione una opción valida en la Especialidad del Abogado");
            }

            if (empty($fecha)) {
              array_push($campos, "Porfavor ingrese la fecha de nacimiento");
            }

            if (empty($telefono)) {
              array_push($campos, "Porfavor ingrese el número de contacto (Telefono)");
            }else{
              if (!is_numeric($telefono)) {
                array_push($campos, "Porfavor ingrese un número de contacto valido (Telefono)");
              }
            }

            if (empty($correo)) {
              array_push($campos, "Porfavor ingrese el correo");
            }else{
              if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                array_push($campos, "El correo no es valido");
              }else{
                if(is_numeric($correo)){
                  array_push($campos, "El correo no es valido");
                }
              }
            }

            if (empty($direccion)) {
              array_push($campos, "Por favor ingrese la direccion de residencia");
            }else{
              if (is_numeric($direccion)) {
                array_push($campos, "Por favor ingrese una dirección de residencia valida");
              }
            }

            if ($tarjeta != "") {
              if (!is_numeric($tarjeta)) {
                array_push($campos, "La tarjeta profesional debe ser numerica");
              }else{
                if (strlen($tarjeta) > 20) {
                  array_push($campos, "La tarjeta profesional no debe exceder los 20 caracteres");
                }
              }
            }

          if (count($campos) > 0) {
            echo '<div class="alert alert-danger" role="alert">';
            for ($i=0; $i < count($campos); $i++) {
                echo '<li>'.$campos[$i].'</li>';
            }
              echo '</div>';
          }else{

            $ValidarAbogado = CRUDAbogadosCtr::seleccionarAbogadosCtr(null, null);
            $contador = 0;

            foreach ($ValidarAbogado as $key => $value) {
              if ($value["NUMERO_DOCUMENTO"] == $_POST["AcDocumento"]) {
                if ($value["ID_ABOGADO"] != $DatosAbogado["ID_ABOGADO"]) {
                  $contador++;
                }
              }
            }

            echo $contador;

            if ($contador < 1) {
              $Atualizacion = new CRUDAbogadosCtr();
              $Atualizacion -> ctrAtualizarAbogado();
            }else{
              echo '<div class="alert alert-danger" role="alert">La cedula del abogado que ingreso ya se encuentra registrada</div>';
            }
          }
        }

           ?>

           <form class="needs-validation" action="" method="POST" novalidate>
               <div class="form-row">
                   <div class="col-md-6 mb-3">
                       <input type="hidden" name="id_Ab" value=" <?php echo $DatosAbogado["ID_ABOGADO"] ?> ">
                       <label for="AcName">Nombre</label>
                       <input type="text" class="form-control" id="Name" name="AcName" value="<?php echo $DatosAbogado["NOMBRE"] ?>" required>
                   </div>
                   <div class="col-md-6 mb-3">
                       <label for="Apellidos">Apellidos</label>
                       <input type="text" class="form-control" id="AcApellidos" name="AcApellidos" value="<?php echo $DatosAbogado["APELLIDO"] ?>" required>
                   </div>
               </div>
               <div class="form-row">
                   <div class="col-md-6">
                       <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Tipo de Documento</label>
                       <select class="custom-select " name="AcTipoDoc" id="inlineFormCustomSelectPref" >
                           <option value="<?php echo $DatosAbogado["FK_T_DOCUMENTO"] ?>"><?php echo $valorTipoDocumento["DESCRIPCION_TD"]; ?></option>
                           <?php foreach ($T_Documento as $key => $value): ?>
                             <option value="<?php echo $value["ID_T_DOCUMENTO"]; ?>"> <?php echo $value["DESCRIPCION_TD"]; ?> </option>
                           <?php endforeach; ?>
                       </select>
                   </div>
                   <div class="col-md-6">
                       <label for="Cedula">Documento</label>
                       <div class="input-group mb-2">
                           <div class="input-group-prepend">
                               <div class="input-group-text">#</div>
                           </div>
                           <input type="text" class="form-control" name="AcDocumento" id="Cedula" value="<?php echo $DatosAbogado["NUMERO_DOCUMENTO"] ?>">
                       </div>
                   </div>
               </div>
               <div class="form-row">
                   <div class="col-md-6">
                       <label for="Tarjeta">Tarjeta Profesional</label>
                       <div class="input-group mb-2">
                           <div class="input-group-prepend">
                               <div class="input-group-text">#</div>
                           </div>
                           <input type="text" class="form-control" name="AcTarjeta" id="Tarjeta" value="<?php echo $DatosAbogado["TARJETA_PROFESIONAL"] ?>">
                       </div>
                   </div>
                   <div class="col-md-6">
                       <label for="especialidad">Especialidad</label>
                       <select class="custom-select" id="especialidad" name="AcEspecialidad" id="inlineFormCustomSelectPref" >
                           <option value="<?php echo $DatosAbogado["FK_ESPECIALIDAD"] ?>"><?php echo $valorEspecialidad["DESCRIPCION_E"] ?></option>
                           <?php foreach ($Especialidad as $key => $value): ?>
                             <option value="<?php echo $value["ID_ESPECIALIDAD"]; ?>"> <?php echo $value["DESCRIPCION_E"]; ?> </option>
                           <?php endforeach; ?>
                       </select>
                   </div>
               </div>
               <div class="form-row">
                   <div class="col-md-6">
                       <label for="calendar">Fecha Nacimiento</label>
                       <input type="date" class="form-control" id="calendar" name="AcFecha" value="<?php echo $DatosAbogado["FECHA_NACIMIENTO"] ?>">
                   </div>
                   <div class="col-md-6">
                       <label for="Cell">Telefono</label>
                       <div class="input-group">
                           <div class="input-group-prepend">
                               <span class="input-group-text" id="celular">#</span>
                           </div>
                           <input type="tel" class="form-control" id="Cell" name="AcTelefono" value="<?php echo $DatosAbogado["TELEFONO"] ?>" aria-describedby="celular" required>
                       </div>
                   </div>
               </div>
               <div class="form-row">
                   <div class="col-md-6 mb-3">
                       <label for="correo">Correo Electronico</label>
                       <div class="input-group">
                           <div class="input-group-prepend">
                               <span class="input-group-text" id="email">@</span>
                           </div>
                           <input type="email" name="AcCorreo" class="form-control" id="correo" value="<?php echo $DatosAbogado["CORREO"] ?>" aria-describedby="email" required>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <label for="direccion">Dirección</label>
                       <input type="text" id="Direccion" name="AcDireccon" class="form-control" value="<?php echo $DatosAbogado["DIRECCION"] ?>" required>
                   </div>
               </div>
                   <button class="btn btn-dark mb-5 py-2 col-3 mt-2" value="" name="ntualizar" type="submit" >Actualizar</button>
           </form>

        </div>


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
</html>
