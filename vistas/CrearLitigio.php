<?php
$abogadoA = CRUDAbogadosCtr::seleccionarAbogadosCtr(null, null);
$tipo_litigio = CRUDLitigioCtr::seleccionarTipoLitigiodCtr(null,null);
$Select_Juzgado = CRUDJuzgadoCtr::seleccionarJuzgadoCtr(null, null);
$Select_Contraparte = CRUDContraparteCtr::seleccionarAbogadosCtr(null, null);
$Select_Ciudad = CRUDLitigioCtr::seleccionarCiudaddCtr(null, null);

if (!isset($_SESSION["Admin"])) {
  echo '<script> window.location = "index.php?page=inicio"; </script>';
  return;
}

$id_AbogadoSystem = $_GET["abogado"];

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
            <a class="navbar-brand" href="index.php?page=CrearLitigio&abogado=<?php echo $id_AbogadoSystem; ?>">
                <img src="IMG/Logo1.png" width="100" height="100" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="navbar-brand" href="#" data-toggle="modal" data-target="#CrearJuzgado">Agregar Juzgado</a>
                    </li>
                    <li class="nav-item active">
                        <a class="navbar-brand" href="#" data-toggle="modal" data-target="#CrarContraparte">Agregar Contraparte</a>
                    </li>
                </ul>
            </div>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                </ul>
                <a class="navbar-brand" href="index.php?page=<?php
                  if ($_SESSION["Admin"] != 1) {
                    echo 'Abogado';
                  }else{
                    echo 'AbogadoAdmin';
                  }
                ?>&abogado=<?php echo $id_AbogadoSystem; ?>">Atras</a>
            </div>
        </nav>

        <!-- Cuerpo -->
        <div class="row mt-3 mb-3">
            <div class="col-4">
                <hr>
            </div>
            <div class="col-4 text-center">
                <h2>Nuevo Litigio</h2>
            </div>
            <div class="col-4">
                <hr>
            </div>
        </div>

        <hr>

          <!-- Crear Juzgado -->

          <?php

          if (isset($_POST["CrarJuzgado"])) {

            $Nombre = $_POST["Nombre"];
            $Direccion = $_POST["Direccion"];

            $campos = array();


            if (empty($Nombre)) {
              array_push($campos, "Por favor ingrese el nombre del Juzgado");
            }

            if (empty($Direccion)) {
              array_push($campos, "Por favor ingrese la direccion del Juzgado");
            }


          if (count($campos) > 0) {
            echo '<div class="alert alert-danger" role="alert">';
            for ($i=0; $i < count($campos); $i++) {
                echo '<li>'.$campos[$i].'</li>';
            }
              echo '</div>';
          }else{

                $insertarJuzgado = CRUDJuzgadoCtr::crearJuzgadoCtr();
                if ($insertarJuzgado == "ok") {
                  echo '<script>
                  if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                  }
                  </script>';
                  echo '<div class="alert alert-success" role="alert">El Juzgado ha sido creado exitosamente</div>';
                  echo '<script> window.location = "index.php?page=CrearLitigio&abogado='.$id_AbogadoSystem.'"; </script>';
                }else{
                  if ($insertarJuzgado != "ok") {
                    echo '<script>
                    if (window.history.replaceState) {
                      window.history.replaceState(null, null, window.location.href);
                    }
                    </script>';
                    echo '<div class="alert alert-danger" role="alert">Verifique que los datos ingresados esten correctos, se ha presentado una falla en la creacion del Juzgado</div>';
                  }
                }
              }
            }

           ?>

           <!-- Crear Contraparte -->

           <?php

           if (isset($_POST["CrearContraparte"])) {

             $Nombre = $_POST["Nombre"];
             $Telefono = $_POST["Telefono"];;
             $Correo = $_POST["Correo"];;
             $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";

             $campos = array();

             if (empty($Nombre)) {
               array_push($campos, "Por favor ingrese el Nombre de la Contraparte");
             }else if (!preg_match($patron_texto,$Nombre)) {
               array_push($campos, "Por favor no ingrese caracteres numericos en el campo del Nombre");
             }

             if (!empty($Telefono)) {
               if (!is_numeric($Telefono)) {
                 array_push($campos, "El telefono dle cliente solo debe contener valores numeros");
               }
             }

             if (empty($Correo)) {
               array_push($campos, "Por favor ingrese el correo de la Contraparte");
             }else if (!filter_var($Correo, FILTER_VALIDATE_EMAIL)) {
               array_push($campos, "El correo ingresado para la Contraparte no es valido");
             }else if (is_numeric($Correo)) {
               array_push($campos, "El correo ingresado para la Contraparte no es valido");
             }

           if (count($campos) > 0) {
             echo '<div class="alert alert-danger" role="alert">';
             for ($i=0; $i < count($campos); $i++) {
                 echo '<li>'.$campos[$i].'</li>';
             }
               echo '</div>';
           }else{

                 $insertarContraparte = CRUDContraparteCtr::crearContraparteCtr();
                 if ($insertarContraparte == "ok") {
                   echo '<script>
                   if (window.history.replaceState) {
                     window.history.replaceState(null, null, window.location.href);
                   }
                   </script>';
                   echo '<div class="alert alert-success" role="alert">El Juzgado ha sido creado exitosamente</div>';
                   echo '<script> window.location = "index.php?page=CrearLitigio&abogado='.$id_AbogadoSystem.'"; </script>';
                 }else{
                   if ($insertarContraparte != "ok") {
                     echo '<script>
                     if (window.history.replaceState) {
                       window.history.replaceState(null, null, window.location.href);
                     }
                     </script>';
                     echo '<div class="alert alert-danger" role="alert">Verifique que los datos ingresados esten correctos, se ha presentado una falla en la creacion del Juzgado</div>';
                   }
                 }
               }
             }

            ?>

            <!-- Formulario -->
            <?php

            if (isset($_POST["crearLitigio"])) {
              $TipoLitigio = $_POST["TipoCaso"];
              $radicado = $_POST["Radicado"];
              $cAbogado = $_POST["NAbogado"];
              $ciudad = $_POST["Ciudad"];
              $juzgado = $_POST["Juzgado"];
              $NContraparte = $_POST["NAbogadoContraparte"];
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
              $FActual = new DateTime();

              $FNAuxiliar = new DateTime($FNacimiento);
              $Edad = $FNAuxiliar->diff($FActual);

              if ($Edad->y < 18) {
                array_push($campos, "El cliente no puede ser menor de edad");
              }

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
                  array_push($campos, "El telefono deL cliente solo debe contener valores numeros");
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

              if ($TipoLitigio == "Seleccione...") {
                array_push($campos, "Por favor seleccione una opción valida en Tipo de litigio");
              }

              if ($juzgado == "Seleccione...") {
                array_push($campos, "Por favor seleccione una opción valida en el Juzgado");
              }

              if ($ciudad == "Seleccione...") {
                array_push($campos, "Por favor seleccione una Ciudad");
              }

              if ($NContraparte == "Seleccione...") {
                array_push($campos, "Por favor seleccione una opción valida para la Contraparte");
              }

              if ($TDocumento == "Seleccione...") {
                array_push($campos, "Por favor seleccione una opción valida en Tipo de Documento del cliente");
              }

              if ($TPersona == "Seleccione...") {
                array_push($campos, "Por favor seleccione una opción valida en Tipo de Persona");
              }

              if (empty($radicado)) {
                array_push($campos, "Por favor ingrese el radicado");
              }

              if ($cAbogado == "Seleccione...") {
                array_push($campos, "Por favor seleccione un Abogado para el Litigio");
              }

              if (empty($NDocumento)) {
                array_push($campos, "Por favor ingrese el documento del Cliente");
              }else{
                if (preg_match($patron_texto, $cAbogado)) {
                  array_push($campos, "Por favor no ingrese caracteres no numericos en el documento del Cliente");
                }else{
                  $item = "NUMERO_DOCUMENTO";
                  $valor = $_POST["NDocumento"];
                  $id_cliente = CRUDClientesCtr::SeleccionarClienteCtr($item, $valor);
                  if (!empty($id_cliente)) {
                    array_push($campos, "El cliente ya se encuentra previamente registrado en el sistema");
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

              $ValidarCliente = CRUDClientesCtr::SeleccionarClienteCtr("NUMERO_DOCUMENTO", $_POST["NDocumento"]);
              $ValidarRadicado = CRUDLitigioCtr::seleccionarLitigiosCtr("RADICADO", $_POST["Radicado"]);

              if (empty($ValidarCliente["ID_CLIENTE"]) AND empty($ValidarRadicado["ID_LITIGIO"])) {
                $insertarCliente = CRUDClientesCtr::CrearClienteCtr();

                if ($insertarCliente == "ok") {
                    $insertarLitigio = CRUDLitigioCtr::crearLitigioCtr();
                    if ($insertarLitigio == "ok") {
                      echo '<script>
                      if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                      }
                      </script>';
                      echo '<div class="alert alert-success" role="alert">El litigio ha sido ingresado exitosamente</div>';
                      echo '<script> window.location = "index.php?page=AbogadoAdmin&abogado='.$id_AbogadoSystem.'"; </script>';
                    }else{
                      if ($insertarLitigio != "ok") {
                        echo '<script>
                        if (window.history.replaceState) {
                          window.history.replaceState(null, null, window.location.href);
                        }
                        </script>';
                        echo '<div class="alert alert-danger" role="alert">Verifique que los datos ingresados esten correctos, se ha presentado una falla en la creacion del litigio</div>';
                      }
                    }
                  }else{
                      if ($insertarCliente != "ok") {
                        echo '<script>
                          if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                          }
                          </script>';
                          echo '<div class="alert alert-danger" role="alert">Verifique que los datos ingresados esten correctos, se ha presentado una falla en la creacion del cliente</div>';
                    }
                  }

              }else{
                echo '<div class="alert alert-danger" role="alert">La cedula del cliente o el radicado ya se encuentran registrada, verifique nuevamente</div>';
              }




              }
            }

             ?>

<div class="container text-center pt-3 pb-4">
  <form class="needs-validation" method="POST" novalidate>

    <div class="form-row">
      <div class="col-md-6 mb-3">
        <label for="TipoCaso">Tipo de Caso</label>
        <select class="custom-select" name="TipoCaso">
          <option selected >Seleccione...</option>
          <?php foreach ($tipo_litigio as $key => $value): ?>
            <option value="<?php echo $value["ID_T_LITIGIO"]; ?>"> <?php echo $value["DESCRIPCION_TL"] ?> </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-6 mb-3">
        <label for="Radicado">Radicado</label>
        <input type="text" class="form-control valid" id="Radicado" name="Radicado" placeholder="Radicado" value= "<?php
        if (isset($TipoLitigio)) {
        echo $radicado;
        }
        ?>">
      </div>
    </div>

    <div class="form-row mt-2">
      <div class="col-md-6 mb-3">
        <label for="NAbogado">Abogado</label>
        <select class="custom-select" id="NAbogado" name="NAbogado">
          <option selected>Seleccione...</option>
          <?php foreach ($abogadoA as $key => $value): ?>
            <option value="<?php echo $value["ID_ABOGADO"]; ?>"> <?php echo $value["NOMBRE"]." ".$value["APELLIDO"]; ?> </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-6 mb-3">
        <label for="Ciudad">Ciudad</label>
        <select class="custom-select" name="Ciudad">
          <option selected >Seleccione...</option>
          <?php foreach ($Select_Ciudad as $key => $value): ?>
            <option value="<?php echo $value["ID_CIUDAD"]; ?>"> <?php echo $value["DESCRIPCION_CD"] ?> </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="form-row text-center justify-content-center mt-2">
      <div class="col-md-12 mb-3">
        <label for="Juzgado">Juzgado</label>
        <select class="custom-select" name="Juzgado">
          <option selected >Seleccione...</option>
          <?php foreach ($Select_Juzgado as $key => $value): ?>
            <option value="<?php echo $value["ID_JUZGADO"]; ?>"> <?php echo $value["DESCRIPCION_JG"] ?> </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <br>
    <hr>
    <p class="text-center"><strong>Abogado Contraparte</strong></p>
    <hr>
    <br>

    <div class="form-row">
      <div class="col-md-12 mb-3">
        <label for="NAbogadoContraparte">Nombre</label>
        <select class="custom-select" name="NAbogadoContraparte">
        <option selected >Seleccione...</option>
        <?php foreach ($Select_Contraparte as $key => $value): ?>
          <option value="<?php echo $value["ID_CONTRAPARTE"]; ?>"> <?php echo $value["NOMBRE"] ?> </option>
        <?php endforeach; ?>
      </select>
      </div>

    </div>

    <br>
    <hr>
    <p class="text-center"><strong>Datos Persona</strong></p>
    <hr>
    <br>

    <div class="form-row">
      <div class="col-md-6 mb-3">
        <label for="TPersona">Tipo de Persona</label>
        <select class="custom-select" id="TPersona" name="TPersona" value="<?php if (isset($TipoLitigio)) {echo $TPersona;} ?>">
          <option selected>Seleccione...</option>
          <option value="1">Natural</option>
          <option value="2">Juridica</option>
        </select>
      </div>
      <div class="col-md-6 mb-3">
        <label for="TDocumento">Tipo de Documento</label>
        <select class="custom-select" id="TDocumento" name="TDocumento" value="<?php if (isset($TipoLitigio)) {echo   $TDocumento;} ?>">
          <option selected>Seleccione...</option>
          <option value="1">Cedula de Ciudadania</option>
          <option value="4">Cedula de Extranjeria</option>
          <option value="3">Pasaporte</option>
        </select>
      </div>
    </div>

    <div class="form-row">
      <div class="col-md-6 mb-3">
        <label for="NDocumento">Número Documento</label>
        <input type="text" class="form-control valid" id="NDocumento" name="NDocumento" placeholder="Número de Documento" value="<?php if (isset($TipoLitigio)) {echo $NDocumento;} ?>">
      </div>
      <div class="col-md-6 mb-3">
        <label for="NombreC">Nombre</label>
        <input type="text" class="form-control valid" id="NombreC" name="NombreC" placeholder="Nombre" value="<?php if (isset($TipoLitigio)) {echo $Nombre;} ?>">
      </div>
    </div>

    <div class="form-row">
      <div class="col-md-6 mb-3">
        <label for="ApellidoC">Apellido</label>
        <input type="text" class="form-control valid" id="ApellidoC" name="ApellidoC" placeholder="Apellidos" value="<?php if (isset($TipoLitigio)) {echo $Apellido;} ?>">
      </div>
      <div class="col-md-6 mb-3">
        <label for="TelefonoC">Telefono</label>
        <input type="tel" class="form-control" id="TelefonoC" name="TelefonoC" placeholder="Telefono" value="<?php if (isset($TipoLitigio)) {echo $Telefono;} ?>">
      </div>
    </div>

    <div class="form-row">
      <div class="col-md-6 mb-3">
        <label for="CelularC">Celular</label>
        <input type="tel" class="form-control valid" id="CelularC" name="CelularC" placeholder="Celular" value="<?php if (isset($TipoLitigio)) {echo $Celular;} ?>">
      </div>
      <div class="col-md-6 mb-3">
        <label for="CorreoC">Correo</label>
        <input type="email" class="form-control valid" id="CorreoC" name="CorreoC" placeholder="Correo" value="<?php if (isset($TipoLitigio)) {echo $Correo;} ?>">
      </div>
    </div>

    <div class="form-row">
      <div class="col-md-6  mb-3">
        <label for="DireccionC">Dirección</label>
        <input type="text" class="form-control valid" id="DireccionC" name="DireccionC" placeholder="Dirección Residencia" value="<?php if (isset($TipoLitigio)) {echo $Direccion;} ?>">
      </div>
      <div class="col-md-6 mb-3">
        <label for="FNacimiento">Fecha de Nacimiento</label>
        <input type="date" class="form-control valid" id="FNacimiento" name="FNacimiento" placeholder="Fecha de Nacimiento" value="<?php if (isset($TipoLitigio)) {echo $FNacimiento;} ?>">
      </div>
    </div>

    <hr>

    <div class="row justify-content-around mt-3">
        <button class="btn btn-dark col-5 py-3" style="width: 40%" name="crearLitigio" type="submit">Guardar</button>
    </form>
    </div>


     <div class="modal fade" id="CrearJuzgado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-tittle">Formlario de Creacion de Juzgado</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span arial-hidden="true">&times;</span>
             </button>
           </div>

           <div class="modal-body">
             <form class="needs-validation" method="POST" novalidate>

               <div class="form-row">
                 <div class="col-md-6 mb-3">
                   <label for="Ciudad">Nombre</label>
                   <input type="text" class="form-control valid" id="Nombre" name="Nombre" placeholder="Nombre">
                 </div>
                 <div class="col-md-6 mb-3">
                   <label for="Juzgado">Direccion</label>
                   <input type="text" class="form-control valid" id="Direccion" name="Direccion" placeholder="Direccion">
                 </div>
               </div>

               <hr>

               <div class="row justify-content-around mt-3">
                 <button class="btn btn-dark col-5" style="width: 40%" name="CrarJuzgado" type="submit">Guardar</button>
                 <button type="button col-5" class="btn btn-dark" style="width: 40%"  data-dismiss="modal">Cerrar</button>
               </div>
             </form>
           </div>
         </div>
       </div>
     </div>

     <div class="modal fade" id="CrarContraparte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-tittle">Formlario de Registro de Contraparte</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span arial-hidden="true">&times;</span>
             </button>
           </div>

           <div class="modal-body">
             <form class="needs-validation" method="POST" novalidate>

               <div class="form-row">
                 <div class="col-md-6 mb-3">
                   <label for="Ciudad">Nombre</label>
                   <input type="text" class="form-control valid" id="Nombre" name="Nombre" placeholder="Nombre">
                 </div>
                 <div class="col-md-6 mb-3">
                   <label for="Juzgado">Telefono</label>
                   <input type="text" class="form-control valid" id="Telefono" name="Telefono" placeholder="Telefono">
                 </div>
               </div>

               <div class="form-row">
                 <div class="col-md-6 mb-3">
                   <label for="Ciudad">Direccion</label>
                   <input type="text" class="form-control valid" id="Direccion" name="Direccion" placeholder="Direccion">
                 </div>
                 <div class="col-md-6 mb-3">
                   <label for="Juzgado">Correo</label>
                   <input type="text" class="form-control valid" id="Correo" name="Correo" placeholder="Correo">
                 </div>
               </div>

               <hr>

               <div class="row justify-content-around mt-3">
                 <button class="btn btn-dark col-5" style="width: 40%" name="CrearContraparte" type="submit">Guardar</button>
                 <button type="button col-5" class="btn btn-dark" style="width: 40%"  data-dismiss="modal">Cerrar</button>
               </div>
             </form>
           </div>
         </div>
       </div>
     </div>



        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
</html>
