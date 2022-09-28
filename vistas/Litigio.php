<?php

if (!isset($_SESSION["Admin"])) {
  echo '<script> window.location = "index.php?page=inicio"; </script>';
  return;
}

if (isset($_GET["id_L"])) {
  $item = "ID_LITIGIO";
  $valor = $_GET["id_L"];
  $DatosLitigio = CRUDLitigioCtr::seleccionarLitigiosCtr($item, $valor);

  $item2 = "ID_CLIENTE";
  $valor2 = $DatosLitigio["FK_CLIENTE"];
  $DatosCliente = CRUDClientesCtr::SeleccionarClienteCtr($item2, $valor2);

  $item3 = "ID_ABOGADO";
  $valor3 = $DatosLitigio["FK_ABOGADO"];
  $DatosAbogado = CRUDAbogadosCtr::seleccionarAbogadosCtr($item3, $valor3);

  $item4 = "ID_T_LITIGIO";
  $valor4 = $DatosLitigio["FK_T_LITIGIO"];
  $tipo_litigio = CRUDLitigioCtr::seleccionarTipoLitigiodCtr($item4, $valor4);

  $item5 = "ID_JUZGADO";
  $valor5 = $DatosLitigio["FK_JUZGADO"];
  $Select_Juzgado = CRUDJuzgadoCtr::seleccionarJuzgadoCtr($item5, $valor5);

  $item6 = "ID_CONTRAPARTE";
  $valor6 = $DatosLitigio["FK_CONTRAPARTE"];
  $Select_Contraparte = CRUDContraparteCtr::seleccionarAbogadosCtr($item6, $valor6);

  $item7 = "ID_CIUDAD";
  $valor7 = $DatosLitigio["FK_CIUDAD"];
  $Select_Ciudad = CRUDLitigioCtr::seleccionarCiudaddCtr($item7, $valor7);

  $item8 = "ID_T_DOCUMENTO";
  $valer8 = $DatosCliente["FK_T_DOCUEMNTO"];
  $Select_t_Documento = CRUDAbogadosCtr::seleccionarTipoDocumentoCtr($item8, $valer8);

  $item9 = "ID_ESPECIALIDAD";
  $valor9 = $DatosAbogado["FK_ESPECIALIDAD"];
  $Select_Especialidad = CRUDAbogadosCtr::seleccionarEspecialidadCtr($item9, $valor9);

  $item10 = "ID_T_PERSONA";
  $valor10 = $DatosCliente["FK_T_PERSONA"];
  $Select_t_Prsona = CRUDClientesCtr::seleccionarTipoPersonaCtr($item10, $valor10);

  $item11 = "LITIGIO_ID_LITIGIO";
  $valor11 = $DatosLitigio["ID_LITIGIO"];
  $Select_Actuacion = CRUDActuacionCtr::seleccionarActuacionCtr($item11, $valor11);
}

$id_AbogadoSystem = $_GET["abogado"];
$Select_t_Prsona_2 = CRUDClientesCtr::seleccionarTipoPersonaCtr(null, null);
$Select_t_Documento_2 = CRUDAbogadosCtr::seleccionarTipoDocumentoCtr(null, null);
$Select_Ciudad_2 = CRUDLitigioCtr::seleccionarCiudaddCtr(null, null);
$Select_Contraparte_2 = CRUDContraparteCtr::seleccionarAbogadosCtr(null, null);
$Select_Juzgado_2 = CRUDJuzgadoCtr::seleccionarJuzgadoCtr(null, null);
$tipo_litigio_2 = CRUDLitigioCtr::seleccionarTipoLitigiodCtr(null, null);
$DatosAbogado_2 = CRUDAbogadosCtr::seleccionarAbogadosCtr(null, null);

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
    <a class="navbar-brand" href="index.php?page=Litigio&id_L=<?php echo $DatosLitigio["ID_LITIGIO"]; ?>&abogado=<?php echo $id_AbogadoSystem; ?>">
      <img src="IMG/Logo1.png" width="100" height="100" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="navbar-brand" href="#" data-toggle="modal" data-target="#EditarLitigio">Editar Litigio</a>
        </li>
        <li class="nav-item active">
          <a class="navbar-brand" href="#" data-toggle="modal" data-target="#EditarCliente">Editar Cliente</a>
        </li>
        <li class="nav-item active">
          <a class="navbar-brand" href="#" data-toggle="modal" data-target="#Acciones">Actuaciones</a>
        </li>
      </ul>
      <a class="navbar-brand" href="index.php?page=<?php
                                                    if ($_SESSION["Admin"] == 1) {
                                                      echo "AbogadoAdmin";
                                                    } else {
                                                      if ($_SESSION["Admin"] == 2) {
                                                        echo "Abogado";
                                                      } else {
                                                        echo "inicio";
                                                      }
                                                    }

                                                    ?>&abogado=<?php echo $id_AbogadoSystem; ?>">
        Atras</a>
    </div>
  </nav>

  <!-- Cuerpo -->
  <div class="container-fluid">

    <!-- Formulario Editar Litigio -->
    <?php

    if (isset($_POST["EditarLitigio"])) {
      $TipoLitigio = $_POST["TipoCaso"];
      $radicado = $_POST["Radicado"];

      $juzgado = $_POST["Juzgado"];

      $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
      $campos = array();



      if ($TipoLitigio == "Seleccione...") {
        array_push($campos, "Por favor seleccione una opción valida en Tipo de litigio");
      }


      if (empty($radicado)) {
        array_push($campos, "Por favor ingrese el radicado");
      }


      if (empty($juzgado)) {
        array_push($campos, "Porfavor ingrese el Juzgado");
      }


      if (count($campos) > 0) {
        echo '<div class="alert alert-danger" role="alert">';
        for ($i = 0; $i < count($campos); $i++) {
          echo '<li>' . $campos[$i] . '</li>';
        }
        echo '</div>';
      } else {

        $ValidarRadicado = CRUDLitigioCtr::seleccionarLitigiosCtr(null, null);
        $contador = 0;

        foreach ($ValidarRadicado as $key => $value) {
          if ($value["RADICADO"] == $_POST["Radicado"]) {
            if ($DatosLitigio["ID_LITIGIO"] != $value["ID_LITIGIO"]) {
              $contador++;
            }
          }
        }

        if ($contador < 1) {
          $Actualizar = new CRUDLitigioCtr();
          $Actualizar->ctrAtualizarLitigio();
        } else {
          echo '<div class="alert alert-danger" role="alert">El radicado ingresado ya se encuentra registrada</div>';
        }
      }
    }

    ?>

    <?php if ($DatosLitigio["FK_E_LITIGIO"] != 2) { ?>
      <div class="modal fade" id="EditarLitigio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-tittle">Formlario de Edicion de Litigio</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span arial-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <form class="needs-validation" method="POST" novalidate>

                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <input type="hidden" name="id_Lit" value=" <?php echo $DatosLitigio["ID_LITIGIO"] ?> ">
                    <label for="TipoCaso">Tipo de Caso</label>
                    <select class="custom-select" name="TipoCaso">
                      <option value="<?php echo $tipo_litigio["ID_T_LITIGIO"] ?>" selected><?php
                                                                                          echo $tipo_litigio["DESCRIPCION_TL"];
                                                                                          ?></option>
                      <?php foreach ($tipo_litigio_2 as $key => $value) : ?>
                        <option value="<?php echo $value["ID_T_LITIGIO"]; ?>"> <?php echo $value["DESCRIPCION_TL"] ?> </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="Radicado">Radicado</label>
                    <input type="text" class="form-control valid" id="Radicado" name="Radicado" placeholder="Radicado" value="<?php
                                                                                                                              echo $DatosLitigio["RADICADO"];
                                                                                                                              ?>">
                  </div>
                </div>

                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <label for="Ciudad">Ciudad</label>
                    <select class="custom-select" name="Ciudad">
                      <option value="<?php echo $Select_Ciudad["ID_CIUDAD"] ?>" selected><?php
                                                                                        echo $Select_Ciudad["DESCRIPCION_CD"];
                                                                                        ?></option>
                      <?php foreach ($Select_Ciudad_2 as $key => $value) : ?>
                        <option value="<?php echo $value["ID_CIUDAD"]; ?>"> <?php echo $value["DESCRIPCION_CD"] ?> </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="Juzgado">Juzgado</label>
                    <select class="custom-select" name="Juzgado">
                      <option value="<?php echo $Select_Juzgado["ID_JUZGADO"] ?>" selected><?php
                                                                                          echo $Select_Juzgado["DESCRIPCION_JG"];
                                                                                          ?></option>
                      <?php foreach ($Select_Juzgado_2 as $key => $value) : ?>
                        <option value="<?php echo $value["ID_JUZGADO"]; ?>"> <?php echo $value["DESCRIPCION_JG"] ?> </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="form-row">
                  <div class="col-md-12 mb-3">
                    <label for="Ciudad">Abogado</label>
                    <select class="custom-select" name="Abogado">
                      <option value="<?php echo $DatosAbogado["ID_ABOGADO"] ?>" selected><?php
                                                                                        echo $DatosAbogado["NOMBRE"] . " " . $DatosAbogado["APELLIDO"];
                                                                                        ?></option>
                      <?php foreach ($DatosAbogado_2 as $key => $value) : ?>
                        <option value="<?php echo $value["ID_ABOGADO"]; ?>"> <?php echo $value["NOMBRE"] . " " . $value["APELLIDO"]; ?> </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <br>
                <hr><br>

                <div class="form-row">
                  <div class="col-md-12 mb-3">
                    <label for="NContraparte">Abogado Contraparte</label>
                    <select class="custom-select" name="NContraparte">
                      <option value="<?php echo $Select_Contraparte["ID_CONTRAPARTE"] ?>" selected><?php
                                                                                                  echo $Select_Contraparte["NOMBRE"];
                                                                                                  ?></option>
                      <?php foreach ($Select_Contraparte_2 as $key => $value) : ?>
                        <option value="<?php echo $value["ID_CONTRAPARTE"]; ?>"> <?php echo $value["NOMBRE"] ?> </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <hr>

                <div class="row justify-content-around mt-3">
                  <button class="btn btn-dark col-5" style="width: 40%" name="EditarLitigio" type="submit">Guardar</button>
                  <button type="button col-5" class="btn btn-dark" style="width: 40%" data-dismiss="modal">Cerrar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>

    <!-- Formulario Edicion Cliente -->
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
      $clave = $NDocumento . $Nombre . "Cc";
      $FNacimiento = $_POST["FNacimiento"];
      $FActual = date("Y-m-d");

      if (empty($FNacimiento)) {
        array_push($campos, "Por favor ingrese la fecha de nacimeinto del cliente");
      }


      if (empty($Nombre) or empty($Apellido)) {
        array_push($campos, "Por favor ingrese el nombre y apellido del cliente");
      } else if (!preg_match($patron_texto, $Nombre) or !preg_match($patron_texto, $Apellido)) {
        array_push($campos, "Por favor no ingrese caracteres numericos en los campos del Nombre y Apellido del cliente");
      }

      if (!empty($Telefono)) {
        if (!is_numeric($Telefono)) {
          array_push($campos, "El telefono dle cliente solo debe contener valores numeros");
        }
      }

      if (empty($Celular)) {
        array_push($campos, "Por favor ingrese el numero celular del cliente");
      } else if (!is_numeric($Celular)) {
        array_push($campos, "El celular del cliente solo debe contener valores numericos");
      }

      if (empty($Correo)) {
        array_push($campos, "Por favor ingrese el correo del cliente");
      } else if (!filter_var($Correo, FILTER_VALIDATE_EMAIL)) {
        array_push($campos, "El correo del cliente no es valido");
      } else if (is_numeric($Correo)) {
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
      } else {
        if (!is_numeric($NDocumento)) {
          array_push($campos, "Por favor no ingrese caracteres no numericos en el documento del cliente");
        }
      }


      if (count($campos) > 0) {
        echo '<div class="alert alert-danger" role="alert">';
        for ($i = 0; $i < count($campos); $i++) {
          echo '<li>' . $campos[$i] . '</li>';
        }
        echo '</div>';
      } else {

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
          $ActualizarCliente->ctrAtualizarCliente();
        } else {
          echo '<div class="alert alert-danger" role="alert">La cedula del cliente que ingreso ya se encuentra registrada</div>';
        }
      }
    }

    ?>

    <?php if ($DatosLitigio["FK_E_LITIGIO"] != 2) { ?>
      <div class="modal fade text-left" id="EditarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-tittle">Formulario Edicion de Cliente</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span arial-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <form class="needs-validation" method="POST" novalidate>

                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <input type="hidden" name="id_Cl" value=" <?php echo $DatosCliente["ID_CLIENTE"] ?> ">
                    <label for="TPersona">Tipo de Persona</label>
                    <select class="custom-select" id="TPersona" name="TPersona" value="">
                      <option value="<?php echo $Select_t_Prsona["ID_T_PERSONA"]; ?>" selected><?php echo $DatosCliente["DESCRIPCION_TP"]; ?></option>
                      <?php foreach ($Select_t_Prsona_2 as $key => $value) : ?>
                        <option value="<?php echo $value["ID_T_PERSONA"]; ?>"> <?php echo $value["DESCRIPCION_TP"] ?> </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="TDocumento">Tipo de Documento</label>
                    <select class="custom-select" id="TDocumento" name="TDocumento" value="">
                      <option value="<?php echo $Select_t_Documento["ID_T_DOCUMENTO"]; ?>" selected><?php echo $Select_t_Documento["DESCRIPCION_TD"]; ?></option>
                      <?php foreach ($Select_t_Documento_2 as $key => $value) : ?>
                        <option value="<?php echo $value["ID_T_DOCUMENTO"]; ?>"> <?php echo $value["DESCRIPCION_TD"] ?> </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <label for="NDocumento">Número Documento</label>
                    <input type="text" class="form-control valid" id="NDocumento" name="NDocumento" placeholder="Número de Documento" value="<?php
                                                                                                                                              echo $DatosCliente["NUMERO_DOCUMENTO"];
                                                                                                                                              ?>">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="NombreC">Nombre</label>
                    <input type="text" class="form-control valid" id="NombreC" name="NombreC" placeholder="Nombre" value="<?php
                                                                                                                          echo $DatosCliente["NOMBRE"];
                                                                                                                          ?>">
                  </div>
                </div>

                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <label for="ApellidoC">Apellido</label>
                    <input type="text" class="form-control valid" id="ApellidoC" name="ApellidoC" placeholder="Apellidos" value="<?php
                                                                                                                                  echo $DatosCliente["APELLIDO"];
                                                                                                                                  ?>">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="TelefonoC">Telefono</label>
                    <input type="tel" class="form-control" id="TelefonoC" name="TelefonoC" placeholder="Telefono" value="<?php
                                                                                                                          echo $DatosCliente["TELEFONO"];
                                                                                                                          ?>">
                  </div>
                </div>

                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <label for="CelularC">Celular</label>
                    <input type="tel" class="form-control valid" id="CelularC" name="CelularC" placeholder="Celular" value="<?php
                                                                                                                            echo $DatosCliente["CELULAR"];
                                                                                                                            ?>">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="CorreoC">Correo</label>
                    <input type="email" class="form-control valid" id="CorreoC" name="CorreoC" placeholder="Correo" value="<?php
                                                                                                                            echo $DatosCliente["CORREO"];
                                                                                                                            ?>">
                  </div>
                </div>

                <div class="form-row">
                  <div class="col-md-6  mb-3">
                    <label for="DireccionC">Dirección</label>
                    <input type="text" class="form-control valid" id="DireccionC" name="DireccionC" placeholder="Dirección Residencia" value="<?php
                                                                                                                                              echo $DatosCliente["DIRECCION"];
                                                                                                                                              ?>">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="FNacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control valid" id="FNacimiento" name="FNacimiento" placeholder="Fecha de Nacimiento" value="<?php
                                                                                                                                                echo $DatosCliente["FECHA_NACIMIENTO"];
                                                                                                                                                ?>">
                  </div>
                </div>

                <hr>

                <div class="row justify-content-around mt-3">
                  <button class="btn btn-dark col-5" style="width: 40%" name="F_EditarCliente" type="submit">Guardar</button>
                  <button type="button col-5" class="btn btn-dark" style="width: 40%" data-dismiss="modal">Cerrar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    <?php } ?>

    <hr>

    <?php
    if (isset($_POST["CabEstado"])) {

      if ($DatosLitigio["FK_E_LITIGIO"] == 2) {
        if ($_SESSION["Admin"] != 1) {
          echo '<div class="alert alert-danger" role="alert">
                            <li>No cuentas con autorizacion para Activar nuevamente el litigio</li>
                            </div>';
        } else {
          $ActualizarEstado = new CRUDLitigioCtr();
          $ActualizarEstado->ctrActualizarEstado();
        }
      } else {
        $ActualizarEstado = new CRUDLitigioCtr();
        $ActualizarEstado->ctrActualizarEstado();
      }
    } elseif (isset($_POST["AgrActuacion"]) || isset($_POST["EditActuacion"])) {
      $Actuacion = $_POST["Actuacion"];
      $campos = array();

      if (empty($Actuacion)) {
        array_push($campos, "Debera ingresar algun texto para poder registrar la actuacion");
      } elseif (strlen($Actuacion) > 250) {
        array_push($campos, "La actuacion no debe superar los 250 caracteres");
      }

      if (count($campos) > 0) {
        echo '<div class="alert alert-danger" role="alert">';
        for ($i = 0; $i < count($campos); $i++) {
          echo '<li>' . $campos[$i] . '</li>';
        }
        echo '</div>';
      } else {

        if (isset($_POST["AgrActuacion"])) {
          $insertarActuacion = CRUDActuacionCtr::crearActuacionCtr();

          if ($insertarActuacion == "ok") {
            echo '<script>
                        if (window.history.replaceState) {
                          window.history.replaceState(null, null, window.location.href);
                        }
                        </script>';
            echo '<div class="alert alert-success" role="alert">L actuacion se ha registrado con exito</div>';
            echo '<script> window.location = "index.php?page=Litigio&id_L=' . $DatosLitigio["ID_LITIGIO"] . '&abogado=' . $id_AbogadoSystem . '"; </script>';
          } else {
            echo '<script>
                        if (window.history.replaceState) {
                          window.history.replaceState(null, null, window.location.href);
                        }
                        </script>';
            echo '<div class="alert alert-danger" role="alert">Se ha presentado un error en el registro de la Actuacion, intenta nuevamente</div>';
          }
        } elseif (isset($_POST["EditActuacion"])) {

          $ActualizarActuacion = new CRUDActuacionCtr();
          $ActualizarActuacion->ctrAtualizarActuacion();
        }
      }
    } elseif (isset($_POST["EliminarActuacion"])) {

      $ActualizarActuacion = new CRUDActuacionCtr();
      $ActualizarActuacion->ctrEliminarActuacion();
    }
    ?>

    <div class="row text-center mt-3 mb-5">
      <div class="col-7 border rounded">

        <div class="row mt-3 mb-3">
          <div class="col">
            <hr>
          </div>
          <div class="col text-center">
            <h5>Litigio</h5>
          </div>
          <div class="col">
            <hr>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <label for="Radicadi">Radicado</label>
            <p class="form-control" id="Radicadi"><?php echo $DatosLitigio["RADICADO"]; ?></p>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <label for="Juzgado">Juzgado</label>
            <p class="form-control" id="Juzgado"><?php echo $Select_Juzgado["DESCRIPCION_JG"]; ?></p>
          </div>
          <div class="col-6">
            <label for="T_Litigio">Tipo de Litigio</label>
            <p class="form-control" id="T_Litigio"><?php echo $tipo_litigio["DESCRIPCION_TL"]; ?></p>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <label for="Fecha">Fecha de apertura</label>
            <p class="form-control" id="Fecha"><?php echo $DatosLitigio["FECHA_CREACION"]; ?></p>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col">
            <hr>
          </div>
          <div class="col text-center">
            <h5>Contraparte</h5>
          </div>
          <div class="col">
            <hr>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <label for="Nombre_C">Nombre</label>
            <p class="form-control" id="Nombre_C"><?php echo $Select_Contraparte["NOMBRE"]; ?></p>
          </div>
          <div class="col-6">
            <label for="Telefono_C">Telefono</label>
            <p class="form-control" id="Telefono_C"><?php echo $Select_Contraparte["TELEFONO"]; ?></p>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <label for="Correo_C">Correo</label>
            <p class="form-control" id="Correo_C"><?php echo $Select_Contraparte["CORREO"]; ?></p>
          </div>
          <div class="col-6">
            <label for="Direccion_C">Direccion de residencia</label>
            <p class="form-control" id="Direccion_C"><?php echo $Select_Contraparte["DIRECCION"]; ?></p>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col">
            <hr>
          </div>
          <div class="col text-center">
            <h5>Cliente</h5>
          </div>
          <div class="col">
            <hr>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <label for="Nombre_Cl">Nombre</label>
            <p class="form-control" id="Nombre_Cl"><?php echo $DatosCliente["NOMBRE"] . " " . $DatosCliente["APELLIDO"]; ?></p>
          </div>
          <div class="col-6">
            <label for="Documento_Cl">Documento</label>
            <p class="form-control" id="Documento_Cl"><?php echo $DatosCliente["NUMERO_DOCUMENTO"]; ?></p>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <label for="T_DOC_Cl">Tipo de docuemnto</label>
            <p class="form-control" id="T_DOC_Cl"><?php echo $Select_t_Documento["DESCRIPCION_TD"]; ?></p>
          </div>
          <div class="col-6">
            <label for="Fecha_N">Fecha de nacimiento</label>
            <p class="form-control" id="Fecha_N"><?php echo $DatosCliente["FECHA_NACIMIENTO"]; ?></p>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <label for="NC_Cl">Numero celular</label>
            <p class="form-control" id="NC_Cl"><?php echo $DatosCliente["CELULAR"]; ?></p>
          </div>
          <div class="col-6">
            <label for="Correo_Cl">Correo</label>
            <p class="form-control" id="Correo_Cl"><?php echo $DatosCliente["CORREO"]; ?></p>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <label for="Dir_Cl">Direccion de residencia</label>
            <p class="form-control" id="Dir_Cl"><?php echo $DatosCliente["DIRECCION"]; ?></p>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col">
            <hr>
          </div>
          <div class="col text-center">
            <h5>Abogado Responsable</h5>
          </div>
          <div class="col">
            <hr>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <label for="Nombre_Ab">Nombre</label>
            <p class="form-control" id="Nombre_Ab"><?php echo $DatosAbogado["NOMBRE"] . " " . $DatosAbogado["APELLIDO"]; ?></p>
          </div>
          <div class="col-6">
            <label for="Documento_Cl">Documento</label>
            <p class="form-control" id="Documento_Cl"><?php echo $DatosAbogado["NUMERO_DOCUMENTO"]; ?></p>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <label for="TP_Ab">Tarjeta profesional</label>
            <p class="form-control" id="TP_Ab"><?php echo $DatosAbogado["TARJETA_PROFESIONAL"]; ?></p>
          </div>
          <div class="col-6">
            <label for="Especialidad_Ab">Especialidad</label>
            <p class="form-control" id="Especialidad_Ab"><?php echo $Select_Especialidad["DESCRIPCION_E"]; ?></p>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <label for="Correo_Ab">Correo</label>
            <p class="form-control" id="TP_Ab"><?php echo $DatosAbogado["CORREO"]; ?></p>
          </div>
          <div class="col-6">
            <label for="Telefono_Ab">Telefono</label>
            <p class="form-control" id="Especialidad_Ab"><?php echo $DatosAbogado["TELEFONO"]; ?></p>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <label for="Dir_Ab">Direccion de residencia</label>
            <p class="form-control" id="Dir_Ab"><?php echo $DatosAbogado["DIRECCION"]; ?></p>
          </div>
        </div>

      </div>

      <!-- Seccion Actuaciones -->

      <div class="col-5 border rounded">
        <div class="row mt-3 mb-3">
          <div class="col">
            <hr>
          </div>
          <div class="col text-center">
            <h5>Actuaciones</h5>
          </div>
          <div class="col">
            <hr>
          </div>
        </div>

        <div class="row mt-3 text-center">
          <div class="col" style="word-wrap : break-word; overflow-y: scroll; height: 450px">



            <?php if ($DatosLitigio["FK_E_LITIGIO"] == 1) {
              echo '
                          <div class="row mb-3">
                            <div class="col-6">
                              <a class="" href="#" data-toggle="modal" data-target="#EliminarAc"><img src="IMG/delete.png" class="img-fluid" width="30px"></a>
                            </div>
                            <div class="col-6">
                              <a class="" href="#" data-toggle="modal" data-target="#Actuacion"><img src="IMG/edit.png" class="img-fluid" width="30px"></a>
                            </div>
                          </div>';
            } ?>

            <?php foreach ($Select_Actuacion as $key => $value) : ?>
              <div class="row d-flex justify-content-around">

                <div class="col-9">
                  <p><?php echo $value["DESCRIPCION_AC"]; ?></p>
                  <p>creacion/modificacion: <br>( <?php echo $value["FECHA_CREACION"]; ?> )</p>
                  <div class="col-12 mb-2" style="opacity: 0.4">
                    <hr>
                  </div>
                </div>

                <div class="modal fade text-center" id="Actuacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-tittle">Formulario Edicion de Actuaciones </h5>
                        <button class="close " type="button" data-dismiss="modal" aria-label="Close">
                          <span arial-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                        <div class="row justify-content-evenly">
                          <div class="col pt-2 border border-3 border-button-0 bg-dark" style="color: white;">
                            <p class="">Modificar Actuacion</p>
                          </div>
                        </div>

                        <div class="row justify-content-evenly">
                          <div class="col border border-3 border-top-0 m-auto mt-1">
                            <form class="needs-validation" method="POST">
                              <input type="hidden" name="id_Act" value="<?php echo $value["ID_ACTUACION"] ?>">
                              <textarea class="form-control" id="" name="Actuacion" placeholder="" rows="6"><?php echo $value["DESCRIPCION_AC"] ?></textarea>
                          </div>
                        </div>
                        <div class="row justify-content-around mt-3">
                          <button class="btn btn-dark mt-3 col-4 py-2" style="width: 40%" name="EditActuacion" type="submit">Guardar</button>
                          </form>
                          <button type="button" class="btn btn-dark mt-3 col-4 py-2" style="width: 40%" data-dismiss="modal">Cerrar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal fade text-center" id="EliminarAc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button class="close " type="button" data-dismiss="modal" aria-label="Close">
                          <span arial-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                        <div class="row justify-content-evenly">
                          <div class="col border border-3 border-top-0 m-auto mt-1">
                            <form class="needs-validation" method="POST">
                              <input type="hidden" name="id_Act" value="<?php echo $value["ID_ACTUACION"] ?>">
                              <label class="col-12"> Esta seguro que desea proceder con la Eliminacion de la Actuacion: <?php echo $value["DESCRIPCION_AC"]; ?> </label>
                          </div>
                        </div>
                        <div class="row justify-content-around mt-3">
                          <button class="btn btn-dark mt-3 col-4 py-2" style="width: 40%" name=EliminarActuacion type="submit">Guardar</button>
                          </form>
                          <button type="button" class="btn btn-dark mt-3 col-4 py-2" style="width: 40%" data-dismiss="modal">Cerrar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


              </div>

            <?php endforeach ?>




            <hr>
          </div>

        </div>
      </div>

    </div>

    <!-- Card de Actuaciones -->


    <div class="modal fade text-center" id="Acciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-tittle">Actuaciones</h5>
            <button class="close " type="button" data-dismiss="modal" aria-label="Close">
              <span arial-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="row justify-content-evenly">
              <div class="col pt-2 border border-3 border-button-0 bg-dark" style="color: white;">
                <p class="">Agregar Actuacion</p>
              </div>
            </div>

            <div class="row justify-content-evenly">
              <div class="col border border-3 border-top-0 m-auto mt-1">
                <form class="needs-validation" method="POST">
                  <input type="hidden" name="id_Lit" value="<?php echo $DatosLitigio["ID_LITIGIO"] ?>">
                  <input type="hidden" name="EstadoLT" value="<?php echo $DatosLitigio["FK_E_LITIGIO"] ?>">
                  <textarea class="form-control" id="" name="Actuacion" placeholder="Texto Corto..." rows="6"></textarea>

              </div>
            </div>
            <div class="row justify-content-around mt-3">
              <button type="" class="btn btn-dark mt-3 col-3 py-2" style="width: 40%" name="CabEstado">
                <?php
                if ($DatosLitigio["FK_E_LITIGIO"] == 2) {
                  echo "Activar Litigio";
                } else {
                  echo "Terminar Litigio";
                }
                ?>
              </button>
              <?php if ($DatosLitigio["FK_E_LITIGIO"] != 2) { ?>
                <button class="btn btn-dark mt-3 col-3 py-2" style="width: 40%" name="AgrActuacion" type="submit">Guardar</button>
              <?php } ?>
              </form>
              <button type="button" class="btn btn-dark mt-3 col-3 py-2" style="width: 40%" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </div>






  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>