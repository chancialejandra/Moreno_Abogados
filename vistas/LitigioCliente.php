<?php

if (isset($_SESSION["Cliente"])) {

  if ($_SESSION["Cliente"] != 2) {
    echo '<script> window.location = "index.php?page=inicio"; </script>';
    return;
  }

}else{
  echo '<script> window.location = "index.php?page=inicio"; </script>';
  return;
}

if (isset($_GET["id_L"])) {
  $item = "ID_LITIGIO";
  $valor = $_GET["id_L"];
  $DatosLitigio = CRUDLitigioCtr::seleccionarLitigiosCtr($item, $valor);

  $item1 = "ID_ABOGADO";
  $Select_Abogado = CRUDAbogadosCtr::seleccionarAbogadosCtr($item1, $DatosLitigio["FK_ABOGADO"]);

  $item2 = "ID_CIUDAD";
  $Select_Ciudad = CRUDLitigioCtr::seleccionarCiudaddCtr($item2, $DatosLitigio["FK_CIUDAD"]);

  $item3 = "ID_JUZGADO";
  $Select_Juzgado = CRUDJuzgadoCtr::seleccionarJuzgadoCtr($item3, $DatosLitigio["FK_JUZGADO"]);

  $item4 = "ID_T_LITIGIO";
  $Select_T_Litigio = CRUDLitigioCtr::seleccionarTipoLitigiodCtr($item4, $DatosLitigio["FK_T_LITIGIO"]);

  $item11 = "LITIGIO_ID_LITIGIO";
  $valor11 = $DatosLitigio["ID_LITIGIO"];
  $Select_Actuacion = CRUDActuacionCtr::seleccionarActuacionCtr($item11, $valor11);

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
            <a class="navbar-brand" href="index.php?page=LitigioCliente&id_L=<?php echo $DatosLitigio["ID_LITIGIO"]?>">
                <img src="IMG/Logo1.png" width="100" height="100" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

                </ul>
                <a class="navbar-brand" href="index.php?page=cliente&id_Cl=<?php echo $DatosLitigio["FK_CLIENTE"] ?>">
                Atras</a>
            </div>
        </nav>

        <!-- Cuerpo -->
        <div class="container-fluid">
            <hr>

            <div class="row mt-3 mb-3">
                <div class="col">
                    <hr>
                </div>
                <div class="col-2 text-center">
                    <h5>Litigio</h5>
                </div>
                <div class="col">
                    <hr>
                </div>
            </div>

            <hr>

            <div class="row text-center mt-3 mb-2">
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
                  <p class="form-control" id="T_Litigio"><?php echo $Select_T_Litigio["DESCRIPCION_TL"]; ?></p>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <label for="Fecha">Fecha de apertura</label>
                  <p class="form-control" id="Fecha"><?php echo $DatosLitigio["FECHA_CREACION"]; ?></p>
                </div>
              </div>

            </div>

            <hr>

            <div class="row mt-3 mb-3">
                <div class="col">
                    <hr>
                </div>
                <div class="col-2 text-center">
                    <h5>Actuaciones</h5>
                </div>
                <div class="col">
                    <hr>
                </div>
            </div>
            <hr>
            <br>
            <div class="row text-center mb-5">
              <div class="col" style="word-wrap : break-word; overflow-y: scroll; height: 300px">
                <?php foreach ($Select_Actuacion as $key => $value):?>
                  <p><?php echo $value["DESCRIPCION_AC"]; ?></p>
                  <p>creacion/modificacion: <br>( <?php echo $value["FECHA_CREACION"]; ?> )</p>
                  <div class="col-12 mb-2" style="opacity: 0.4"><hr></div>
                <?php endforeach; ?>
              </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
</html>
