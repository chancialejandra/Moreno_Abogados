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

$id_AbogadoSystem = $_GET["abogado"];
$Clientes = CRUDClientesCtr::SeleccionarClienteCtr(null, null);

 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="CSS/bootstrap.min.css">
        <link rel="stylesheet" href="CSS/Styles.css">
        <link rel="stylesheet" href="CSS/sesion.css">
    </head>
    <body>
        <!-- Barra navegacion -->
        <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php?page=ListaClientesAdmin&abogado=<?php echo $id_AbogadoSystem; ?>">
                <img src="IMG/Logo1.png" width="100" height="100" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

                </ul>
                <a class="navbar-brand" href="index.php?page=<?php
                if ($_SESSION["Admin"] != 1) {
                  echo 'Abogado';
                }else{
                  echo 'AbogadoAdmin';
                }
                ?>&abogado=<?php echo $id_AbogadoSystem; ?>"> Atras </a>
            </div>
        </nav>
        <!-- Cuerpo -->
        <div class="container-fluid">


            <!-- Barra de busqueda -->
            <form class="form-inline mt-4" method="post">
                <label class="sr-only" for="buscar">Name</label>
                <input type="text" class="form-control mb-2 mr-sm-2 col-lg-10 col-sm-9 col-md-10" id="buscar" name="Valor_Buscar" placeholder="Radicado, Cliente ......">

                <button type="submit" class="btn btn-dark mb-2 col-1" name="btnBuscar">Buscar</button>
            </form>

            <?php
              if (isset($_POST["btnBuscar"])) {
                $valos_buscar = $_POST["Valor_Buscar"];
                $campos = array();

                if (empty($valos_buscar)) {
                  array_push($campos, "Debe ingresar algo en el campo de busqueda para proceder");
                }

                if (count($campos) > 0) {
                  echo '<div class="alert alert-danger" role="alert">';
                  for ($i=0; $i < count($campos); $i++) {
                      echo '<li>'.$campos[$i].'</li>';
                  }
                    echo '</div>';
                }else{

                  $item = "NUMERO_DOCUMENTO";
                  $valor = $_POST["Valor_Buscar"];
                  $cliente = CRUDClientesCtr::SeleccionarClienteCtr($item, $valor);

                }
              }
            ?>

        <!-- Listado de litigios -->

        <div class="row mt-3">
            <div class="col-5">
                <hr>
            </div>
            <div class="col-2 text-center">
                <h2>Clientes</h2>
            </div>
            <div class="col-5">
                <hr>
            </div>
        </div>

      <div class="row text-center d-flex justify-content-around text-wrap flex-wrap flex-row">


        <?php if (empty($cliente["ID_CLIENTE"])) {
          foreach ($Clientes as $key => $value):
        ?>
            <div class="card col-2 justify-content-center mx-2 mt-3">
              <img src="IMG/behavior.png" class="pl-4 mt-3 pr-0" alt="..." width="80%">
              <div class="card-body">
                <h5 class="card-title"><?php echo  $value["NOMBRE"]." ".$value["APELLIDO"];?></h5>
                <label class=" fs-6" >N. Documento</label>
                <p class="fw-bold"><?php echo $value["NUMERO_DOCUMENTO"]; ?></p>
                <label class=" fs-6" >Celular</label>
                <p class="fw-bold"><?php echo $value["CELULAR"]; ?></p>

                <a href="index.php?page=AccionesClientes&id_Cl=<?php echo $value["ID_CLIENTE"]; ?>&abogado=<?php echo $id_AbogadoSystem; ?>" class="btn btn-dark pt-1">Abrir</a>
              </div>
            </div>
      <?php
        endforeach;

        }else{ ?>

          <div class="card col-2 justify-content-center mx-2 mt-3">
            <img src="IMG/behavior.png" class="pl-4 mt-3 pr-0" alt="..." width="80%">
            <div class="card-body">
              <h5 class="card-title"><?php echo  $cliente["NOMBRE"]." ".$cliente["APELLIDO"];?></h5>
              <label class=" fs-6" >N. Documento</label>
              <p class="fw-bold"><?php echo $cliente["NUMERO_DOCUMENTO"]; ?></p>
              <label class=" fs-6" >Celular</label>
              <p class="fw-bold"><?php echo $cliente["CELULAR"]; ?></p>

              <a href="index.php?page=AccionesClientes&id_Cl=<?php echo $cliente["ID_CLIENTE"]; ?>&abogado=<?php echo $id_AbogadoSystem; ?>" class="btn btn-dark pt-1">Abrir</a>
            </div>
          </div>

        <?php } ?>



      </div>


        </div>


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
</html>
