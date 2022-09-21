

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

  $item3 = "FK_ABOGADO";
  $valor3 = $_GET["id"];
  $CLitigio = CRUDLitigioCtr::contarLitigiosCtr($item3, $valor3);

  $item4 = "ID_ESPECIALIDAD";
  $valor4 = $DatosAbogado["FK_ESPECIALIDAD"];
  $select_especialidad = CRUDAbogadosCtr::seleccionarEspecialidadCtr($item4, $valor4);
}

$id_AbogadoSystem = $_GET["abogado"];
$Abogados = CRUDAbogadosCtr::seleccionarAbogadosCtr(null, null);


if ($CLitigio["COUNT(ID_LITIGIO)"] != 0) {
  $formulario = '#Inactivar_CambiL';
}else{
  $formulario = '#Inactivar';
}

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
                <a class="navbar-brand" href="index.php?page=GestionAbogados&abogado=<?php echo $id_AbogadoSystem; ?>">Atras</a>
            </div>
        </nav>

        <?php
          if ( isset($_POST["InactivarAb"]) ) {
            if ($formulario == '#Inactivar_CambiL') {
              $ActualizarEstado = new CRUDAbogadosCtr();
              $ActualizarEstado -> ActualizarEstadoInactivo_CambioL();
                //Desactiva al abogado y debe actualizar el litigio
            }else{
              $ActualizarEstado = new CRUDAbogadosCtr();
              $ActualizarEstado -> ActualizarEstadoInactivoCtr();
            }
          }elseif ( isset($_POST["ActivarAb"] ) ) {
            $ActualizarEstado = new CRUDAbogadosCtr();
            $ActualizarEstado -> ActualizarEstadoActivoCtr();
          }
        ?>

        <!-- Cuerpo -->
        <div class="container-fluid text-center">

          <div>
            <hr>
              <h5 class="" id="exampleModalLabel">Información de: <strong><?php echo $DatosAbogado["NOMBRE"]; echo " "; echo $DatosAbogado["APELLIDO"]?></strong></h5>
            <hr>
          </div>

          <div class="row">
              <div class="col-md-6 mb-3">
                  <label for="Name">Nombre</label>
                  <p class="form-control" id="Name"> <?php echo $DatosAbogado["NOMBRE"] ?> </p>
              </div>
              <div class="col-md-6 mb-3">
                  <label for="Apellidos">Apellidos</label>
                  <p class="form-control" id="Apellidos"> <?php echo $DatosAbogado["APELLIDO"] ?> </p>
              </div>
          </div>

          <div class="row">

              <div class="col-md-6">
                  <label for="Tarjeta">Tipo de Documento</label>
                  <p class="form-control" id="Tarjeta"> <?php echo $valorTipoDocumento["DESCRIPCION_TD"] ?> </p>
              </div>

              <div class="col-md-6">
                  <label for="Cedula">Número de Documento</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <div class="input-group-text">#</div>
                      </div>
                      <p class="form-control" id="Cedula"> <?php echo $DatosAbogado["NUMERO_DOCUMENTO"] ?> </p>
                  </div>
              </div>
            </div>

          <div class="form-row">

              <div class="col-md-6">
                  <label for="Tarjeta">Tarjeta Profesional</label>
                  <p class="form-control" id="Tarjeta"> <?php echo $DatosAbogado["TARJETA_PROFESIONAL"] ?> </p>
              </div>
              <div class="col-md-6">
                  <label for="Especialidad">Especialidad</label>
                  <p class="form-control" id="Tarjeta"> <?php echo $select_especialidad["DESCRIPCION_E"] ?> </p>
              </div>

          </div>


          <div class="form-row">
              <div class="col-md-6">
                  <label for="calendar">Fecha de Nacimiento</label>
                  <p class="form-control"> <?php echo $DatosAbogado["FECHA_NACIMIENTO"] ?> </p>
              </div>
              <div class="col-md-6">
                  <label for="Cell">Telefono</label>
                  <p class="form-control" id="Cell"> <?php echo $DatosAbogado["TELEFONO"] ?> </p>
              </div>
          </div>
          <div class="form-row">
              <div class="col-md-6 mb-3">
                  <label for="correo">Correo Electronico</label>
                  <p class="form-control" id="correo"> <?php echo $DatosAbogado["CORREO"] ?> </p>
              </div>
              <div class="col-md-6">
                  <label for="direccion">Dirección de Residencia</label>
                  <p id="Direccion" class="form-control"> <?php echo $DatosAbogado["DIRECCION"] ?> </p>
              </div>
          </div>

        <div class="row mb-5">
          <div class="col-6">
            <a class="btn btn-dark py-2" style="width: 50%" href="index.php?page=ModificarAbogado&id=<?php echo $DatosAbogado["ID_ABOGADO"];?>&abogado=<?php echo $id_AbogadoSystem; ?>" role="button">Modificar</a>
          </div>

          <div class="col-6">
              <a class="btn btn-dark py-2 px-5" role="button" style="color: white; width: 50%;" href="#" data-toggle="modal" data-target="<?php
              if ($DatosAbogado["FK_E_ABOGADO"] == 2) {
                echo '#Activar';
              }elseif ($DatosAbogado["FK_E_ABOGADO"] == 1) {
                echo $formulario;
              }  ?>">
                <?php
                  if ($DatosAbogado["FK_E_ABOGADO"] == 2) {
                    echo 'Activar Abogado';
                  }else{
                    echo 'Inactivar Abogado';
                  }
                ?>
              </a>
          </div>
        </div>



        <div class="modal fade text-center" id="Activar" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button class="close " type="button" data-dismiss="modal" aria-label="Close" >
                  <span arial-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">

                <form method="POST">
                  <input type="hidden" name="id_Abg" value="<?php echo $DatosAbogado["ID_ABOGADO"] ?>">

                  <p>Esta seguro que desea activar nuevamente a <strong><?php echo $DatosAbogado["NOMBRE"].' '.$DatosAbogado["APELLIDO"]?></strong></p>

                  <div class="row justify-content-around mt-4">
                    <div class="col-5">
                      <button class="btn btn-dark" name="ActivarAb" type="submit">Activar</button>
                    </div>
                    <div class="col-5">
                      <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                    </div>

                    </div>
                </form>

              </div>
            </div>
          </div>
        </div>

        <div class="modal fade text-center" id="Inactivar_CambiL" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button class="close " type="button" data-dismiss="modal" aria-label="Close" >
                  <span arial-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">

                <form method="POST">
                  <input type="hidden" name="id_Abg" value="<?php echo $DatosAbogado["ID_ABOGADO"] ?>">
                  <input type="hidden" name="Estado_Abg" value="<?php echo $DatosAbogado["FK_E_ABOGADO"] ?>">

                  <hr>
                  <p><?php
                  echo '<p>Dado que el abogado que desea desactivar cuenta con <strong>'.$CLitigio["COUNT(ID_LITIGIO)"].'</strong> litigios Activos,
                    debera seleccionar un nuevo abogado, el cual estara a cargo de estos.</p>
                    <hr>
                  ';
                  ?></p>

                  <label for="Abogado_Cambio">Abogado</label>
                  <select class="custom-select" id="Abogado_Cambio" name="Abogado_Cambio">
                    <option selected>Seleccione...</option>
                    <?php foreach ($Abogados as $key => $value): ?>
                      <option value="<?php echo $value["ID_ABOGADO"]; ?>"> <?php echo $value["NOMBRE"]." ".$value["APELLIDO"]; ?> </option>
                    <?php endforeach; ?>
                  </select>


                  <div class="row justify-content-around mt-4">
                    <div class="col-5">
                      <button class="btn btn-dark" name="InactivarAb" type="submit">Inactivar</button>
                    </div>
                    <div class="col-5">
                      <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                    </div>

                    </div>
                </form>

              </div>
            </div>
          </div>
        </div>

        <div class="modal fade text-center" id="Inactivar" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button class="close " type="button" data-dismiss="modal" aria-label="Close" >
                  <span arial-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">

                <form method="POST">
                  <input type="hidden" name="id_Abg" value="<?php echo $DatosAbogado["ID_ABOGADO"] ?>">
                  <input type="hidden" name="Estado_Abg" value="<?php echo $DatosAbogado["FK_E_ABOGADO"] ?>">

                  <hr>
                  <p><?php
                  echo '
                  <p>Esta seguro que desea desactivar al abogado <strong>'.$DatosAbogado["NOMBRE"].' '.$DatosAbogado["APELLIDO"].'</strong>.</p>
                  <hr>
                  ';
                  ?></p>

                  <div class="row justify-content-around mt-4">
                    <div class="col-5">
                      <button class="btn btn-dark" name="InactivarAb" type="submit">Inactivar</button>
                    </div>
                    <div class="col-5">
                      <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                    </div>

                    </div>
                </form>

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
