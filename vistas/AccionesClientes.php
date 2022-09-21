

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

  $item8 = "ID_T_DOCUMENTO";
  $valer8 = $DatosCliente["FK_T_DOCUEMNTO"];
  $Select_t_Documento = CRUDAbogadosCtr::seleccionarTipoDocumentoCtr($item8, $valer8);

  $item10 = "ID_T_PERSONA";
  $valor10 = $DatosCliente["FK_T_PERSONA"];
  $Select_t_Prsona = CRUDClientesCtr::seleccionarTipoPersonaCtr($item10, $valor10);
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
            <a class="navbar-brand" href="index.php?page=AccionesClientes&id_Cl=<?php echo $DatosCliente["ID_CLIENTE"];?>&abogado=<?php echo $id_AbogadoSystem; ?>">
                <img src="IMG/Logo1.png" width="100" height="100" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ml-3" id="navbarTogglerDemo02">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

              </ul>
                <a class="navbar-brand" href="index.php?page=ListaClientesAdmin&abogado=<?php echo $id_AbogadoSystem; ?>">Atras</a>
            </div>
        </nav>

        <!-- Cuerpo -->
        <div class="container-fluid text-center">

          <div>
            <hr>
              <h5 class="" id="exampleModalLabel">Información de: <strong><?php echo $DatosCliente["NOMBRE"]; echo " "; echo $DatosCliente["APELLIDO"] ?></strong></h5>
            <hr>
          </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="Name">Nombre</label>
                <p class="form-control" id="Name"> <?php echo $DatosCliente["NOMBRE"] ?> </p>
            </div>
            <div class="col-md-6 mb-3">
                <label for="Apellidos">Apellidos</label>
                <p class="form-control" id="Apellidos"> <?php echo $DatosCliente["APELLIDO"] ?> </p>
            </div>
        </div>

        <div class="row">

            <div class="col-md-6">
                <label for="Tarjeta">Tipo de Documento</label>
                <p class="form-control" id="Tarjeta"> <?php echo $Select_t_Documento["DESCRIPCION_TD"] ?> </p>
            </div>

            <div class="col-md-6">
                <label for="Cedula">Numero de Documento</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">#</div>
                    </div>
                    <p class="form-control" id="Cedula"> <?php echo $DatosCliente["NUMERO_DOCUMENTO"] ?> </p>
                </div>
            </div>
          </div>

        <div class="form-row">
          <div class="col-md-6">
              <label for="Tarjeta">Tipo Persona</label>
              <p class="form-control" id="Tarjeta"> <?php echo $Select_t_Prsona["DESCRIPCION_TP"] ?> </p>
          </div>
          <div class="col-md-6">
              <label for="Especialidad">Numero Fijo</label>
              <p class="form-control" id="Tarjeta"> <?php echo $DatosCliente["TELEFONO"] ?> </p>
          </div>

        </div>


        <div class="form-row">
          <div class="col-md-6">
              <label for="calendar">Celular</label>
              <p class="form-control"> <?php echo $DatosCliente["CELULAR"] ?> </p>
          </div>

          <div class="col-md-6">
              <label for="Cell">Correo</label>
              <p class="form-control" id="Cell"> <?php echo $DatosCliente["CORREO"] ?> </p>
          </div>

        </div>
        <div class="form-row">

            <div class="col-md-6">
                <label for="direccion">Dirección</label>
                <p id="Direccion" class="form-control"> <?php echo $DatosCliente["DIRECCION"] ?> </p>
            </div>
            <div class="col-md-6">
                <label for="Tarjeta">Fecha de Nacimiento</label>
                <p class="form-control" id="Tarjeta"> <?php echo $DatosCliente["FECHA_NACIMIENTO"] ?> </p>
            </div>
        </div>

        <div class="">
          <a class="btn btn-dark py-2 col-3 mb-5 mt-2" style="width: 50%" href="index.php?page=ModificarCliente&id_Cl=<?php echo $DatosCliente["ID_CLIENTE"];?>&abogado=<?php echo $id_AbogadoSystem; ?>" role="button">Modificar</a>
        </div>

        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
</html>
