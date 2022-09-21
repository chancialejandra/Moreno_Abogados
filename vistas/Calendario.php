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
$item = "ID_ABOGADO";
$DatosAbogado = CRUDAbogadosCtr::seleccionarAbogadosCtr($item, $id_AbogadoSystem);

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
            <a class="navbar-brand" href="index.php?page=Calendario&abogado=<?php echo $id_AbogadoSystem; ?>">
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

        <!-- Listado de litigios -->
        <hr>

        <div class="row text-rigth align-items-center">
          <div class="col-12">
            <iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=2&bgcolor=%23616161&ctz=America%2FBogota&showTitle=0&showDate=1&showCalendars=0&mode=WEEK&src=bW9yZW5vYWJvZ2Fkb3M3OEBnbWFpbC5jb20&src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&color=%23039BE5&color=%2333B679" style="border:solid 1px #777" width="100%" height="400" frameborder="0" scrolling="no"></iframe>
          </div>
          <div class="col-12">
            <p>Calendario para: <?php echo $DatosAbogado["NOMBRE"]." ".$DatosAbogado["APELLIDO"] ?> </p>
          </div>
        </div>


<!-- Formulario Litigio -->
        </div>


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
</html>
