
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="CSS/bootstrap.min.css">
        <link rel="stylesheet" href="CSS/Styles.css">
        <link rel="stylesheet" href="CSS/sesion.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
        <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    </head>
    <body>
      <?php
      include 'parcials/navInicioSesion.php';
       ?>

        <div class="container-fluid">

          <div class="row text-center justify-content-center mt-5">
            <div class="col-6 text-center">
              <div class="col-12 mb-3">
                  <img class="img-fluid" src="IMG/client.png" alt="Avatar" style="height: 150px">
              </div>
              <div class="col-12 text-center mt-5">
                <form action=""method="POST">

                  <div class="form-label col-12">
                    <label>Ingrese su usuario para realizar el envio de su clave al correo previamente registrado</label>
                  </div>

                  <div class="form-group col-12" id="">
                      <input type="text" class="form-control" name="Usuario" placeholder="Usuario">
                  </div>
                    <button name="btn_recuperar" class="btn badge-dark"> <i class="mr-2 fas fa-sign-in-alt"></i>Ingresar</button>
                </form>
              </div>

              <?php

              if (isset($_POST["btn_recuperar"])) {
                $User = $_POST["Usuario"];
                $campos = array();


                if (empty($User)) {
                  array_push($campos, "Debe ingresar un usuario para realizar el envio de la clave");
                }

                $ValidarCliente = CRUDClientesCtr::SeleccionarClienteCtr(null, null);
                $contador = 0;

                foreach ($ValidarCliente as $key => $value) {
                  if ($value["NUMERO_DOCUMENTO"] == $User) {
                    $contador++;
                  }
                }

                if ($contador == 0) {
                  array_push($campos, "El usuaro que ingreso no se encuentra registardo, verifique que los datos sean correctos he intenta nuevamente");
                }

                if (count($campos) > 0) {
                  echo '<div class="alert alert-danger" role="alert">';
                  for ($i=0; $i < count($campos); $i++) {
                      echo '<li>'.$campos[$i].'</li>';
                  }
                    echo '</div>';
                }else{


                  $mail = CRUDClientesCtr::EnvioCorreo($User);

                  if ($mail) {
                    echo '<script>
                    if (window.history.replaceState) {
                      window.history.replaceState(null, null, window.location.href);
                    }
                    </script>';
                    echo '<div class="alert alert-success" role="alert">El correo fue enviado con exito</div>';
                  }else{
                    echo '<script>
                    if (window.history.replaceState) {
                      window.history.replaceState(null, null, window.location.href);
                    }
                    </script>';
                    echo '<div class="alert alert-danger" role="alert">Ha ocurrido un erro, intenta nuevamente, si el error persiste comunicate con nosotros</div>';
                  }
                }
              }

              ?>
            </div>
          </div>



        </div>



          <footer>
            <h1 class="font-weight-bold mt-5 text-center">Contactenos</h1>
            <hr>
            <div class="row contactenos text-center mt-5 d-flex d-flex justify-content-center">
                <div class="col-3">
                    <a class="nav-link" target="_blank" href="https://www.google.com/maps/place/Cl.+35+%23%2385c-38,+Medell%C3%ADn,+Antioquia/@6.2438178,-75.6103399,14z/data=!4m13!1m7!3m6!1s0x8e4429132997b935:0x6a9cfb1686941026!2sCl.+35+%23%2385c-38,+Medell%C3%ADn,+Antioquia!3b1!8m2!3d6.2441636!4d-75.6102588!3m4!1s0x8e4429132997b935:0x6a9cfb1686941026!8m2!3d6.2441636!4d-75.6102588">
                        <img src="IMG/location.png" width="45%">
                        <p class="mt-2">Cll 35 # 85c-38</p>
                    </a>
                </div>
                <div class="col-3">
                    <a class="nav-link" target="_blank" href="https://mail.google.com/mail/">
                        <img src="IMG/email.png" width="45%">
                        <p class="mt-2">MORENOABOGAD@GMAIL.COM</p>
                    </a>
                </div>
                <div class="col-3">
                    <img src="IMG/call.png" width="45%">
                    <p class="mt-2">584-30-83</p>
                </div>
                <div class="col-3">
                    <a class="nav-link" target="_blank" href="https://api.whatsapp.com/send?phone=0573164120107">
                    <img src="IMG/whatsapp.png" width="45%">
                    <p class="mt-2">(+57) 316 412 01 07</p>
                    </a>
                </div>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
</html>
