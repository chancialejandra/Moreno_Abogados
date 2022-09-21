
<?php

  $abogadoA = CRUDAbogadosCtr::seleccionarAbogadosInactivosCtr(null, null);

  if (isset($_SESSION["Admin"])) {

    if ($_SESSION["Admin"] != 1) {
      echo '<script> window.location = "index.php?page=inicio"; </script>';
      return;
    }

  }else{
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
            <a class="navbar-brand" href="index.php?page=AbogadosInactivos&abogado=<?php echo $id_AbogadoSystem; ?>">
                <img src="IMG/Logo1.png" width="100" height="100" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="navbar-brand" href="index.php?page=GestionAbogados&abogado=<?php echo $id_AbogadoSystem; ?>">Abogados</a>
                    </li>
                </ul>
                <a class="navbar-brand" href="index.php?page=GestionAbogados&abogado=<?php echo $id_AbogadoSystem; ?>">Atras</a>
            </div>
        </nav>

        <!-- Cuerpo -->
        <div class="container-fluid">


            <!-- Barra de busqueda -->
            <form class="form-inline mt-4" method="post">
                <label class="sr-only" for="buscar">Name</label>
                <input type="text" class="form-control mb-2 mr-sm-2 col-lg-10 col-sm-9 col-md-10" name="Valor_Buscar" id="buscar" placeholder="Cedula ......">

                <button type="submit" name="btnBuscar" class="btn btn-dark mb-2 col-md-1">Submit</button>
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
                  $abogado = CRUDAbogadosCtr::seleccionarAbogadosInactivosCtr($item, $valor);

                }
              }
            ?>

            <div class="row mt-2">
                <div class="col-4">
                    <hr>
                </div>
                <div class="col-4 text-center">
                    <h2>Abogados Inactivos</h2>
                </div>
                <div class="col-4">
                    <hr>
                </div>
            </div>

            <!-- Cuadrilla de abogados -->

            <div class="row text-center mt-3 d-flex justify-content-around flex-wrap flex-row">


              <?php
              if (empty($abogado["ID_ABOGADO"])) {

              foreach ($abogadoA as $key => $value): ?>
                <a class=" col-2 nav-item rounded border border-dark ml-1 mr-1 mt-2" href="index.php?page=Acciones_Abogados&id=<?php echo $value["ID_ABOGADO"];?>&abogado=<?php echo $id_AbogadoSystem; ?> " style="text-transform: none; color: black">
                    <img class="mt-2" src="IMG/lawyerAvatr.png" width="90%">
                    <p class="mt-2">
                      <?php
                      echo $value["NOMBRE"]." ".$value["APELLIDO"];
                       ?>
                    </p>
                </a>
              <?php endforeach;
            }else{ ?>
              <a class=" col-2 nav-item rounded border border-dark ml-1 mr-1 mt-2" href="index.php?page=Acciones_Abogados&id=<?php echo $abogado["ID_ABOGADO"];?>&abogado=<?php echo $id_AbogadoSystem; ?> " style="text-transform: none; color: black">
                  <img class="mt-2" src="IMG/lawyerAvatr.png" width="90%">
                  <p class="mt-2">
                    <?php
                    echo $abogado["NOMBRE"]." ".$abogado["APELLIDO"]
                     ?>
                  </p>
              </a>
            <?php } ?>

            </div>


        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
</html>
