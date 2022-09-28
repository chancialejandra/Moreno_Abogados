<?php
$abogadoA = CRUDAbogadosCtr::seleccionarAbogadosCtr(null, null);
$tipo_litigio = CRUDLitigioCtr::seleccionarTipoLitigiodCtr(null, null);
$Select_Juzgado = CRUDJuzgadoCtr::seleccionarJuzgadoCtr(null, null);
$Select_Contraparte = CRUDContraparteCtr::seleccionarAbogadosCtr(null, null);
$Select_Ciudad = CRUDLitigioCtr::seleccionarCiudaddCtr(null, null);
$Select_Cliente = CRUDClientesCtr::SeleccionarClienteCtr(null, null);

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
                                                    } else {
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
      for ($i = 0; $i < count($campos); $i++) {
        echo '<li>' . $campos[$i] . '</li>';
      }
      echo '</div>';
    } else {

      $insertarJuzgado = CRUDJuzgadoCtr::crearJuzgadoCtr();
      if ($insertarJuzgado == "ok") {
        echo '<script>
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
        </script>';
        echo '<div class="alert alert-success" role="alert">El Juzgado ha sido creado exitosamente</div>';
        echo '<script> window.location = "index.php?page=CrearLitigio&abogado=' . $id_AbogadoSystem . '"; </script>';
      } else {
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
    } else if (!preg_match($patron_texto, $Nombre)) {
      array_push($campos, "Por favor no ingrese caracteres numericos en el campo del Nombre");
    }

    if (!empty($Telefono)) {
      if (!is_numeric($Telefono)) {
        array_push($campos, "El telefono dle cliente solo debe contener valores numeros");
      }
    }

    if (empty($Correo)) {
      array_push($campos, "Por favor ingrese el correo de la Contraparte");
    } else if (!filter_var($Correo, FILTER_VALIDATE_EMAIL)) {
      array_push($campos, "El correo ingresado para la Contraparte no es valido");
    } else if (is_numeric($Correo)) {
      array_push($campos, "El correo ingresado para la Contraparte no es valido");
    }

    if (count($campos) > 0) {
      echo '<div class="alert alert-danger" role="alert">';
      for ($i = 0; $i < count($campos); $i++) {
        echo '<li>' . $campos[$i] . '</li>';
      }
      echo '</div>';
    } else {

      $insertarContraparte = CRUDContraparteCtr::crearContraparteCtr();
      if ($insertarContraparte == "ok") {
        echo '<script>
         if (window.history.replaceState) {
           window.history.replaceState(null, null, window.location.href);
         }
         </script>';
        echo '<div class="alert alert-success" role="alert">El Juzgado ha sido creado exitosamente</div>';
        echo '<script> window.location = "index.php?page=CrearLitigio&abogado=' . $id_AbogadoSystem . '"; </script>';
      } else {
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

  <hr>

  <!-- Formulario -->
  <?php

  if (isset($_POST["crearLitigio"])) {
    $TipoLitigio = $_POST["TipoCaso"];
    $radicado = $_POST["Radicado"];
    $cAbogado = $_POST["NAbogado"];
    $ciudad = $_POST["Ciudad"];
    $juzgado = $_POST["Juzgado"];
    $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñÑ\s]+$/";
    $NDocumento = $_POST["NDocumento"];
    $AbogadoCont = $_POST["NAbogadoContraparte"];
    $campos = array();


    if ($TipoLitigio == "Seleccione...") {
      array_push($campos, "Por favor seleccione una opción valida en Tipo de litigio");
    }

    if (empty($radicado)) {
      array_push($campos, "Por favor ingrese el radicado");
    }

    if ($cAbogado == "Seleccione...") {
      array_push($campos, "Por favor seleccione un Abogado para el Litigio");
    }

    if ($ciudad == "Seleccione...") {
      array_push($campos, "Por favor seleccione la Ciudad");
    }

    if ($AbogadoCont == "Seleccione...") {
      array_push($campos, "Por favor seleccione una opción valida para la Contraparte");
    }

    if ($juzgado == "Seleccione...") {
      array_push($campos, "Por favor seleccione el Juzgado");
    }

    if ($NDocumento == "Seleccione...") {
      array_push($campos, "Por favor seleccione el Cliente");
    }


    if (count($campos) > 0) {
      echo '<div class="alert alert-danger" role="alert">';
      for ($i = 0; $i < count($campos); $i++) {
        echo '<li>' . $campos[$i] . '</li>';
      }
      echo '</div>';
    } else {

      $ValidarRadicado = CRUDLitigioCtr::seleccionarLitigiosCtr("RADICADO", $_POST["Radicado"]);

      if (empty($ValidarRadicado["ID_LITIGIO"])) {
        $insertarLitigio = CRUDLitigioCtr::crearLitigioCtr();

        if ($insertarLitigio == "ok") {
          echo '<script>
                  if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                  }
                  </script>';
          echo '<div class="alert alert-success" role="alert">El litigio ha sido ingresado exitosamente</div>';
          echo '<script> window.location = "index.php?page=AbogadoAdmin&abogado=' . $id_AbogadoSystem . '"; </script>';
        } else {
          echo '<script>
                  if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                  }
                  </script>';
          echo '<div class="alert alert-danger" role="alert">Verifique que los datos ingresados esten correctos, se ha presentado una falla en la creacion del litigio</div>';
        }
      } else {
        echo '<div class="alert alert-danger" role="alert">El radicado ingresado ya se encuentra registrado</div>';
      }
    }
  }


  ?>

  <div class="container text-center pt-3 pb-4">
    <form class="needs-validation" method="POST" novalidate>

      <p class="text-center"><strong>Cliente <a style="color:#FF0000;">*</a></strong></p>

      <div class="form-row text-center justify-content-center">
        <div class="col-md-10 mb-3">
          <label for="NDocumento"></label>
          <select class="custom-select" id="" name="NDocumento">
            <option selected>Seleccione un cliente existente...</option>
            <?php foreach ($Select_Cliente as $key => $value) : ?>
              <option value="<?php echo $value["NUMERO_DOCUMENTO"]; ?>"> <?php echo $value["NUMERO_DOCUMENTO"] . " - " . $value["NOMBRE"] . " " . $value["APELLIDO"]; ?> </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <hr>
      <p class="text-center"><strong>Información del litigio</strong></p>

      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="TipoCaso">Tipo de Caso<a style="color:#FF0000;">*</a></label>
          <select class="custom-select" name="TipoCaso">
            <option selected>Seleccione...</option>
            <?php foreach ($tipo_litigio as $key => $value) : ?>
              <option value="<?php echo $value["ID_T_LITIGIO"]; ?>"> <?php echo $value["DESCRIPCION_TL"] ?> </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-6 mb-3">
          <label for="Radicado">Radicado</label>
          <input type="text" class="form-control valid" id="Radicado" name="Radicado" placeholder="Radicado" value="<?php
                                                                                                                    if (isset($TipoLitigio)) {
                                                                                                                      echo $radicado;
                                                                                                                    }
                                                                                                                    ?>">
        </div>
      </div>

      <div class="form-row mt-2">
        <div class="col-md-6 mb-3">
          <label for="Ciudad">Ciudad<a style="color:#FF0000;">*</a></label>
          <select class="custom-select" name="Ciudad">
            <option selected>Seleccione...</option>
            <?php foreach ($Select_Ciudad as $key => $value) : ?>
              <option value="<?php echo $value["ID_CIUDAD"]; ?>"> <?php echo $value["DESCRIPCION_CD"] ?> </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-6 mb-3">
          <label for="Juzgado">Juzgado<a style="color:#FF0000;">*</a></label>
          <select class="custom-select" name="Juzgado">
            <option selected>Seleccione...</option>
            <?php foreach ($Select_Juzgado as $key => $value) : ?>
              <option value="<?php echo $value["ID_JUZGADO"]; ?>"> <?php echo $value["DESCRIPCION_JG"] ?> </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="form-row text-center justify-content-center mt-2">
        <div class="col-md-10 mb-3">
          <label for="NAbogado">Abogado<a style="color:#FF0000;">*</a></label>
          <select class="custom-select" id="NAbogado" name="NAbogado">
            <option selected>Seleccione...</option>
            <?php foreach ($abogadoA as $key => $value) : ?>
              <option value="<?php echo $value["ID_ABOGADO"]; ?>"> <?php echo $value["NOMBRE"] . " " . $value["APELLIDO"]; ?> </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <br>
      <hr>
      <p class="text-center"><strong>Abogado Contraparte<a style="color:#FF0000;">*</a></strong></p>
      <div class="form-row text-center justify-content-center">
        <div class="col-md-10 mb-3">
          <label for="NAbogadoContraparte"></label>
          <select class="custom-select" name="NAbogadoContraparte" id="NAbogadoContraparte" value="<?php if (isset($TipoLitigio)) {
                                                                                                      echo $AbogadoCont;
                                                                                                    } ?>">
            <option value="null" selected>Seleccione...</option>
            <?php foreach ($Select_Contraparte as $key => $value) : ?>
              <option value="<?php echo $value["ID_CONTRAPARTE"]; ?>"> <?php echo $value["NOMBRE"] ?> </option>
            <?php endforeach;
            ?>
          </select>
        </div>

      </div>


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
                <label for="Ciudad">Nombre<a style="color:#FF0000;">*</a></label>
                <input type="text" class="form-control valid" id="Nombre" name="Nombre" placeholder="Nombre">
              </div>
              <div class="col-md-6 mb-3">
                <label for="Juzgado">Direccion<a style="color:#FF0000;">*</a></label>
                <input type="text" class="form-control valid" id="Direccion" name="Direccion" placeholder="Direccion">
              </div>
            </div>

            <hr>

            <div class="row justify-content-around mt-3">
              <button class="btn btn-dark col-5" style="width: 40%" name="CrarJuzgado" type="submit">Guardar</button>
              <button type="button col-5" class="btn btn-dark" style="width: 40%" data-dismiss="modal">Cerrar</button>
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
                <label for="Ciudad">Nombre<a style="color:#FF0000;">*</a></label>
                <input type="text" class="form-control valid" id="Nombre" name="Nombre" placeholder="Nombre">
              </div>
              <div class="col-md-6 mb-3">
                <label for="Juzgado">Telefono<a style="color:#FF0000;">*</a></label>
                <input type="text" class="form-control valid" id="Telefono" name="Telefono" placeholder="Telefono">
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="Ciudad">Direccion<a style="color:#FF0000;">*</a></label>
                <input type="text" class="form-control valid" id="Direccion" name="Direccion" placeholder="Direccion">
              </div>
              <div class="col-md-6 mb-3">
                <label for="Juzgado">Correo<a style="color:#FF0000;">*</a></label>
                <input type="text" class="form-control valid" id="Correo" name="Correo" placeholder="Correo">
              </div>
            </div>

            <hr>

            <div class="row justify-content-around mt-3">
              <button class="btn btn-dark col-5" style="width: 40%" name="CrearContraparte" type="submit">Guardar</button>
              <button type="button col-5" class="btn btn-dark" style="width: 40%" data-dismiss="modal">Cerrar</button>
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