<?php



if (!isset($_SESSION["Admin"])) {
  echo '<script> window.location = "index.php?page=inicio"; </script>';
  return;
}

$id_AbogadoSystem = $_GET["abogado"];
$DEspecialidad = CRUDAbogadosCtr::seleccionarEspecialidadCtr(null, null);
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
    <a class="navbar-brand" href="index.php?page=CrearAbogado&abogado=<?php echo $id_AbogadoSystem; ?>">
      <img src="IMG/Logo1.png" width="100" height="100" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      </ul>
      <a class="navbar-brand" href="index.php?page=GestionAbogados&abogado=<?php echo $id_AbogadoSystem; ?>">Atras</a>
    </div>
  </nav>

  <!-- Cuerpo -->
  <div class="row mt-3 mb-3">
    <div class="col-4">
      <hr>
    </div>
    <div class="col-4 text-center">
      <h2>Nuevo Abogado</h2>
    </div>
    <div class="col-4">
      <hr>
    </div>
  </div>

  <hr>


  <?php

  if (isset($_POST["Guardar"])) {
    $nombre = $_POST["Name"];
    $apellido = $_POST["Apellidos"];
    $tipoDoc = $_POST["TipoDoc"];
    $numeroDoc = $_POST["Documento"];
    $tarjeta = $_POST["Tarjeta"];
    $especialidad = $_POST["Especialidad"];
    $fecha = $_POST["Fecha"];
    $telefono = $_POST["Telefono"];
    $correo = $_POST["Correo"];
    $direccion = $_POST["Direccon"];
    $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
    $campos = array();

    $fechaAc = new DateTime();
    $fechaAx = new DateTime($fecha);
    $edad = $fechaAx->diff($fechaAc);

    if ($edad->y < 18) {
      array_push($campos, "El abogado no puede ser menor a 18 años");
    }

    if (empty($numeroDoc)) {
      array_push($campos, "Por favor ingrese el documento del Cliente");
    } else {
      if (preg_match($patron_texto, $numeroDoc)) {
        array_push($campos, "Por favor no ingrese caracteres no numericos en el documento del Cliente");
      } else {
        $item = "NUMERO_DOCUMENTO";
        $valor = $_POST["Documento"];
        $abogadoA = CRUDAbogadosCtr::seleccionarAbogadosCtr($item, $valor);
        if (!empty($abogadoA)) {
          array_push($campos, "El Abogado ya se encuentra previamente registrado en el sistema");
        }
      }
    }


    if (empty($nombre)) {
      array_push($campos, "Porfavor ingrese el nombre del abogado");
    } else {
      if (is_numeric($nombre)) {
        array_push($campos, "Porfavor no ingrese caracteres numericos en el nombre");
      } else {
        if (!preg_match($patron_texto, $nombre)) {
          array_push($campos, "El nombre no debe contener numeros ni carácteres especiales");
        }
      }
    }


    if (empty($apellido)) {
      array_push($campos, "Porfavor ingrese los apellidos del abogado");
    } else {
      if (is_numeric($apellido)) {
        array_push($campos, "Porfavor no ingrese caracteres numericos en el apellido");
      } else {
        if (!preg_match($patron_texto, $apellido)) {
          array_push($campos, "El apellido no debe contener numeros ni carácteres especiales");
        }
      }
    }

    if ($tipoDoc == "Seleccione...") {
      array_push($campos, "Porfavor seleccione una opción valida en Tipo de documento");
    }

    if ($especialidad == "Seleccione...") {
      array_push($campos, "Porfavor seleccione una opción valida en la Especialidad del abogado");
    }

    if (empty($fecha)) {
      array_push($campos, "Porfavor ingrese la fecha de nacimiento");
    }

    if (empty($telefono)) {
      array_push($campos, "Porfavor ingrese el número de contacto (Telefono)");
    } else {
      if (!is_numeric($telefono)) {
        array_push($campos, "Porfavor ingrese un número de contacto valido (Telefono)");
      }
    }

    if (empty($correo)) {
      array_push($campos, "Porfavor ingrese el correo");
    } else {
      if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        array_push($campos, "El correo no es valido");
      } else {
        if (is_numeric($correo)) {
          array_push($campos, "El correo no es valido");
        }
      }
    }

    if (empty($direccion)) {
      array_push($campos, "Porfavor ingrese la direccion de residencia");
    } else {
      if (is_numeric($direccion)) {
        array_push($campos, "Porfavor ingrese una dirección de residencia valida");
      }
    }

    if ($tarjeta != "") {
      if (!is_numeric($tarjeta)) {
        array_push($campos, "La tarjeta profesional debe ser numerica");
      } else {
        if (strlen($tarjeta) > 20) {
          array_push($campos, "La tarjeta profesional no debe exceder los 20 caracteres");
        }
      }
    }

    if (!empty($_POST["Documento"])) {
      $ValidarDoc = CRUDAbogadosCtr::seleccionarAbogadosCtr("NUMERO_DOCUMENTO", $_POST["Documento"]);

      if (!empty($ValidarDoc["ID_ABOGADO"])) {
        array_push($campos, "El documento que intenta ingresar ya esta registrado");
      }
    }


    if (!empty($_POST["Tarjeta"])) {
      $ValidarTarjeta = CRUDAbogadosCtr::seleccionarAbogadosCtr("TARJETA_PROFESIONAL", $_POST["Tarjeta"]);

      if (!empty($ValidarTarjeta["ID_ABOGADO"])) {
        array_push($campos, "El numeor de Trajeta Profesiona que intenta ingresar ya esta registrado");
      }
    }

    if (count($campos) > 0) {
      echo '<div class="alert alert-danger" role="alert">';
      for ($i = 0; $i < count($campos); $i++) {
        echo '<li>' . $campos[$i] . '</li>';
      }
      echo '</div>';
    } else {

      $inserA = CRUDAbogadosCtr::crearAbogadosCtr();
      if ($inserA == "ok") {
        echo '<script>
                        if (window.history.replaceState) {
                          window.history.replaceState(null, null, window.location.href);
                        }
                        </script>';
        echo '<script> window.location = "index.php?page=GestionAbogados&abogado=' . $id_AbogadoSystem . '"; </script>';
        echo '<div class="alert alert-success" role="alert">El abogado ha sido ingresado exitosamente</div>';
      }
    }
  }

  ?>

  <!-- Formulario Abogados -->

  <div class="container text-center pt-3 pb-4">

    <form class="needs-validation " method="POST" novalidate>



      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="Name">Nombre<a style="color:#FF0000;">*</a></label>
          <input type="text" name="Name" class="form-control valid" id="Name" placeholder="Nombres" value="<?php if (isset($nombre)) {
                                                                                                              echo $nombre;
                                                                                                            } ?>" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="Apellidos">Apellidos<a style="color:#FF0000;">*</a></label>
          <input type="text" class="form-control" name="Apellidos" id="Apellidos" placeholder="Apellidos" value="<?php if (isset($nombre)) {
                                                                                                                    echo $apellido;
                                                                                                                  } ?>" required>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-6">
          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Tipo de Documento<a style="color:#FF0000;">*</a></label>
          <select class="custom-select " name="TipoDoc">
            <option selected>Seleccione...</option>
            <?php foreach ($T_Documento as $key => $value) : ?>
              <option value="<?php echo $value["ID_T_DOCUMENTO"]; ?>"> <?php echo $value["DESCRIPCION_TD"]; ?> </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-6">
          <label for="Cedula">Documento<a style="color:#FF0000;">*</a></label>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text">#</div>
            </div>
            <input type="text" name="Documento" class="form-control" id="Cedula" placeholder="Documento identificación" value="<?php if (isset($nombre)) {
                                                                                                                                  echo $numeroDoc;
                                                                                                                                } ?>" required>
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
            <input type="text" name="Tarjeta" class="form-control" id="Tarjeta" placeholder="Tarjeta Profesional" value="<?php if (isset($nombre)) {
                                                                                                                            echo $tarjeta;
                                                                                                                          } ?>">
          </div>
        </div>
        <div class="col-md-6">
          <label for="especialidad">Especialidad</label>
          <select class="custom-select" id="especialidad" name="Especialidad">
            <option selected>Seleccione...</option>
            <?php foreach ($DEspecialidad as $key => $value) : ?>
              <option value="<?php echo $value["ID_ESPECIALIDAD"]; ?>"> <?php echo $value["DESCRIPCION_E"]; ?> </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-6">
          <label for="calendar">Fecha Nacimiento<a style="color:#FF0000;">*</a></label>
          <input type="date" name="Fecha" class="form-control" id="calendar" value="<?php if (isset($nombre)) {
                                                                                      echo $fecha;
                                                                                    } ?>" required>
        </div>
        <div class="col-md-6">
          <label for="Cell">Telefono<a style="color:#FF0000;">*</a></label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="celular">#</span>
            </div>
            <input type="tel" name="Telefono" class="form-control" id="Cell" placeholder="Telefono de contacto" aria-describedby="celular" value="<?php if (isset($nombre)) {
                                                                                                                                                    echo $telefono;
                                                                                                                                                  } ?>" required>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="correo">Correo Electronico<a style="color:#FF0000;">*</a></label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="email">@</span>
            </div>

            <input type="email" name="Correo" class="form-control" id="correo" placeholder="Correo electronico" aria-describedby="email" value="<?php if (isset($nombre)) {
                                                                                                                                                  echo $correo;
                                                                                                                                                } ?>" required>
          </div>
        </div>
        <div class="col-md-6">
          <label for="direccion">Dirección<a style="color:#FF0000;">*</a></label>
          <input type="text" name="Direccon" id="Direccion" class="form-control" placeholder="Direccion de residencia" value="<?php if (isset($nombre)) {
                                                                                                                                echo $direccion;
                                                                                                                              } ?>" required>
        </div>
      </div>
      <div class="row justify-content-around">
        <button class="btn btn-dark col-5 py-3" style="width: 40%" name="Guardar" type="submit">Guardar</button>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>