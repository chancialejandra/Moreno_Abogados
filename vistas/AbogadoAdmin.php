<?php


$Litigios = CRUDLitigioCtr::seleccionarLitigiosCtr(null, null);
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
        <link rel="stylesheet" href="CSS/Styles.css">
        <link rel="stylesheet" href="CSS/sesion.css">
    </head>
    <body>
        <!-- Barra navegacion -->
        <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php?page=AbogadoAdmin&abogado=<?php echo $id_AbogadoSystem; ?>">
                <img src="IMG/Logo1.png" width="100" height="100" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="navbar-brand" href="index.php?page=GestionAbogados&abogado=<?php echo $id_AbogadoSystem; ?>">Gestión Abogados</a>
                    </li>
                    <li class="nav-item active">
                        <a class="navbar-brand" href="index.php?page=ListaClientesAdmin&abogado=<?php echo $id_AbogadoSystem; ?>">Gestión Clientes</a>
                    </li>
                    <li class="nav-item active">
                      <a class="navbar-brand" href="#" data-toggle="modal" data-target="#FormularioLitigio">Crear Litigio</a>
                    </li>
                    <li class="nav-item active">
                      <a class="navbar-brand" href="index.php?page=Calendario&abogado=<?php echo $id_AbogadoSystem; ?>">Calendario</a>
                    </li>
                </ul>
                <a class="navbar-brand" href="index.php?page=Salir"> Salir </a>
            </div>
        </nav>
        <!-- Cuerpo -->
        <div class="container-fluid">


            <!-- Barra de busqueda -->
            <form class="form-inline mt-4 pl-5 ml-3" method="post">
                <label class="sr-only" for="buscar">Name</label>
                <input type="text" name="Valor_Buscar" class="form-control mb-2 mr-sm-2 col-lg-10 col-sm-9 col-md-10" id="buscar" placeholder="Radicado, Cliente ......">

                <button type="submit" name="btnBuscar" class="btn btn-dark mb-2 col-1 ">Buscar</button>
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

                  $item = "RADICADO";
                  $valor = $_POST["Valor_Buscar"];
                  $Litigio = CRUDLitigioCtr::seleccionarLitigiosBuscadorCtr($item, $valor);

                  $iteAb = "NUMERO_DOCUMENTO";
                  $Abogado = CRUDAbogadosCtr::seleccionarAbogadosCtr($iteAb, $valor);


                  if (count($Litigio) == 0) {
                    $item = "DESCRIPCION_TL";
                    $Litigio = CRUDLitigioCtr::seleccionarLitigiosBuscadorCtr($item, $valor);
                  }

                  if ((count($Litigio) == 0) && (!empty($Abogado["ID_ABOGADO"]))) {
                    $item = "FK_ABOGADO";
                    $Litigio = CRUDLitigioCtr::seleccionarLitigiosBuscadorCtr($item, $Abogado["ID_ABOGADO"]);
                  }
                }
              }

            ?>


        <!-- Listado de litigios -->
        <hr>
            <div class="row mb-2 py-2 text-center navbar-dark bg-dark text-uppercase align-items-center fs-5" style=" color: white ">
                <div class="col-2">
                  Radicado
                </div>
                <div class="col-2 ">
                  Fecha de Creacion
                </div>
                <div class="col-2 ">
                  Tipo de Litigio
                </div>
                <div class="col-2 ">
                  Abogado Responsable
                </div>
                <div class="col-2">
                  Estado
                </div>
                <div class="col-2">
                  Accion
                </div>
            </div>
            <?php
            if (empty($Litigio)) {
              foreach ($Litigios as $key => $value):
                $item = "ID_ABOGADO";
                $valor = $value["FK_ABOGADO"];
                $Abogado = CRUDAbogadosCtr::seleccionarAbogadosCtr($item, $valor);

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
                          echo $value["FECHA_CREACION"];
                        ?>
                      </p>
                  </div>
                  <div class="col-2">
                      <p>
                        <?php
                          echo $value["DESCRIPCION_TL"];
                        ?>
                      </p>
                  </div>
                  <div class="col-2">
                      <p>
                        <?php
                          echo $Abogado["NOMBRE"]." ".$Abogado["APELLIDO"];
                        ?>
                      </p>
                  </div>
                  <div class="col-2">
                      <p>
                        <?php
                          if ($value["FK_E_LITIGIO"] == 1) {
                            echo "Activo";
                          }else{
                            echo "Terminado";
                          }
                        ?>
                      </p>
                  </div>
                  <div class="col-2">
                    <div class="row">
                      <div class="col">
                        <a href="index.php?page=Litigio&id_L=<?php echo $value["ID_LITIGIO"]; ?>&abogado=<?php echo $id_AbogadoSystem; ?>">
                          <img src="IMG/open-folder-with-document.png" class="img-fluid" width="35%">
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                  <?php
                endforeach;
            }else{
              foreach ($Litigio as $key => $value):
                $item = "ID_ABOGADO";
                $valor = $value["FK_ABOGADO"];
                $Abogado = CRUDAbogadosCtr::seleccionarAbogadosCtr($item, $valor);
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
                          echo $value["FECHA_CREACION"];
                        ?>
                      </p>
                  </div>
                  <div class="col-2">
                      <p>
                        <?php
                          echo $value["DESCRIPCION_TL"];
                        ?>
                      </p>
                  </div>
                  <div class="col-2">
                      <p>
                        <?php
                          echo $value["NOMBRE"]." ".$value["APELLIDO"];
                        ?>
                      </p>
                  </div>
                  <div class="col-2">
                      <p>
                        <?php
                          if ($value["FK_E_LITIGIO"] == 1) {
                            echo "Activo";
                          }else{
                            echo "Terminado";
                          }
                        ?>
                      </p>
                  </div>
                  <div class="col-2">
                    <div class="row">
                      <div class="col">
                        <a href="index.php?page=Litigio&id_L=<?php echo $value["ID_LITIGIO"]; ?>&abogado=<?php echo $id_AbogadoSystem; ?>">
                          <img src="IMG/open-folder-with-document.png" class="img-fluid" width="35%">
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              endforeach;
            }
            ?>

<!-- Formulario Litigio -->

              <div class="modal fade text-center" id="FormularioLitigio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-tittle">Registro de Litigio</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span arial-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">

                      <div class="row">
                        <div>
                          <a class="btn btn-dark py-2" href="index.php?page=CrearLitigioUsExistente&abogado=<?php echo $id_AbogadoSystem; ?>" role="button">Cliente Existente</a>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div>
                          <a class="btn btn-dark py-2 px-4" href="index.php?page=CrearLitigio&abogado=<?php echo $id_AbogadoSystem; ?>" role="button">Cliente Nuevo</a>
                        </div>
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
