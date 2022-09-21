
<?php
$item = "FK_CLIENTE";
$valor = $_GET["id_Cl"];
$Litigios = CRUDLitigioCtr::seleccionarLitigiosIndCtr($item, $valor);


if (isset($_SESSION["Cliente"])) {

  if ($_SESSION["Cliente"] != 2) {
    echo '<script> window.location = "index.php?page=inicio"; </script>';
    return;
  }

}else{
  echo '<script> window.location = "index.php?page=inicio"; </script>';
  return;
}

 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="CSS/bootstrap.min.css">
    </head>
    <body>

        <!-- Barra de navegacion -->
        <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php?page=cliente">
                <img src="IMG/Logo1.png" width="100" height="100" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse ml-3" id="navbarTogglerDemo02">
                <a class="navbar-brand" href="index.php?page=Salir">Salir</a>
            </div>
        </nav>

        <!-- Contenido -->
        <div class="container-fluid">
            <hr>
            <div class="row mt-4 text-center py-3 rounded" style="background-color: rgba(33, 37, 41, .85); color: white">

                <div class="col-2">
                    <h3> Radicado</h3>
                </div>
                <div class="col-2">
                    <h3>Abogado</h3>
                </div>
                <div class="col-2">
                    <h3>Ciudad</h3>
                </div>
                <div class="col-2">
                    <h3>Notaria</h3>
                </div>
                <div class="col-2">
                    <h3>Fecha</h3>
                </div>
                <div class="col-2">
                    <h3>Actuaciones</h3>
                </div>

            </div>

            <hr>



            <?php foreach ($Litigios as $key => $value):


              $item1 = "ID_ABOGADO";
              $Select_Abogado = CRUDAbogadosCtr::seleccionarAbogadosCtr($item1, $value["FK_ABOGADO"]);

              $item2 = "ID_CIUDAD";
              $Select_Ciudad = CRUDLitigioCtr::seleccionarCiudaddCtr($item2, $value["FK_CIUDAD"]);

              $item3 = "ID_JUZGADO";
              $Select_Juzgado = CRUDJuzgadoCtr::seleccionarJuzgadoCtr($item3, $value["FK_JUZGADO"]);

              ?>


              <div class="row text-center border border-dark align-items-center fs-6" >
                  <div class="col-2">
                      <p>
                        <?php
                          echo $value["RADICADO"];
                        ?>
                      </p>
                  </div>
                  <div class="col-2">
                      <p>
                        <?php
                          echo $Select_Abogado["NOMBRE"]." ".$Select_Abogado["APELLIDO"];
                        ?>
                      </p>
                  </div>
                  <div class="col-2">
                      <p>
                        <?php
                          echo $Select_Ciudad["DESCRIPCION_CD"];
                        ?>
                      </p>
                  </div>
                  <div class="col-2">
                      <p>
                        <?php
                          echo $Select_Juzgado["DESCRIPCION_JG"];
                        ?>
                      </p>
                  </div>
                  <div class="col-2">
                      <p>
                        <?php
                          echo $value["FECHA_CREACION"];
                        ?>
                      </p>
                  </div>
                  <div class="col-2">
                    <div class="row">
                      <div class="col">
                        <a href="index.php?page=LitigioCliente&id_L=<?php echo $value["ID_LITIGIO"] ?>">
                          <img src="IMG/open-folder-with-document.png" class="img-fluid" width="35%">
                        </a>
                      </div>
                    </div>
                  </div>
                </div>

              <?php endforeach; ?>


        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
</html>
