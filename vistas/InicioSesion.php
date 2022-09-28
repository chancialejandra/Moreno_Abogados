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
        <div class="row sesion d-flex justify-content-center text-center">
            <div class="col-6">
                <button class="btn btn-dark font-weight-bold" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Soy Cliente
                </button>
                <?php
                $ingresar = new CRUDClientesCtr();
                $ingresar->ctrIngresarCliente();
                ?>
                <div class="collapse formsesion" id="collapseExample">
                    <div class="card card-body">
                        <div class="modal-dialog text-center">
                            <div class="col-12 main-section">
                                <div class="modal-content">
                                    <div class="col-12 user-img">
                                        <img src="IMG/client.png" alt="Avatar">
                                    </div>
                                    <form action="" class="col-12" method="POST">
                                        <div class="form-group" id="user-group">
                                            <input type="text" class="form-control" name="UsuarioCliente" placeholder="Usuario">
                                        </div>
                                        <div class="form-group" id="pass-group">
                                            <input type="password" class="form-control" name="ContrasenaCliente" placeholder="Contraseña">
                                        </div>
                                        <button name="btn_iniciar" class="btn badge-dark"> <i class="mr-2 fas fa-sign-in-alt"></i>Ingresar</button>
                                    </form>
                                    <div class="col-10 mb-3 align-self-center forgot">
                                        <div class="row justify-content-center">
                                            <div class="col-3 mt-1">
                                                <img class="m-0" src="IMG/tools.png" alt="" width="50%">
                                            </div>
                                            <div class="col-7 p-0 mt-1">
                                                <a style="font-size: 15px;" href="index.php?page=RecuperarClave">Recordar Contraseña</a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-6">
                <button class="btn btn-dark font-weight-bold" type="button" data-toggle="collapse" data-target="#SesionAbogados" aria-expanded="false" aria-controls="SesionAbogados">
                    Soy Abogado
                </button>
                <?php
                $ingresar = new CRUDAbogadosCtr();
                $ingresar->ctrIngresarAbogado();
                ?>
                <div class="collapse formsesion" id="SesionAbogados">
                    <div class="card card-body">
                        <div class="modal-dialog text-center">
                            <div class="col-12 main-section">
                                <div class="modal-content">
                                    <div class="col-12 user-img">
                                        <img src="IMG/lawyer.png" alt="Avatar">
                                    </div>
                                    <form action="" class="col-12" method="POST">
                                        <div class="form-group" id="user-group">
                                            <input type="text" class="form-control" name="Usuario" placeholder="Usuario">
                                        </div>
                                        <div class="form-group" id="pass-group">
                                            <input type="password" class="form-control" name="Contrasena" placeholder="Contraseña">
                                        </div>

                                        <button name="btn_iniciar" class="btn badge-dark"> <i class="mr-2 fas fa-sign-in-alt"></i>Ingresar</button>
                                    </form>
                                    <div class="col-10 mb-3 align-self-center forgot">
                                        <div class="row justify-content-center">
                                            <div class="col-3 mt-1">
                                                <img class="m-0" src="IMG/tools.png" alt="" width="50%">
                                            </div>
                                            <div class="col-7 p-0 mt-1">
                                                <a style="font-size: 15px;" href="index.php?page=RecuperarClave">Recordar Contraseña</a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--
        <%
            HttpSession sesion = request.getSession();
            int nivel = 0;
            if (request.getAttribute("nivel") != null) {
                nivel = (Integer) request.getAttribute("nivel");

                if (nivel == 1) {
                    sesion.setAttribute("nombre", request.getAttribute("nombre"));
                    sesion.setAttribute("nivel", nivel);
                    response.sendRedirect("AbogadoAdmin.jsp");
                } else {
                    if (nivel == 2) {
                        sesion.setAttribute("nombre", request.getAttribute("nombre"));
                        sesion.setAttribute("nivel", nivel);
                        response.sendRedirect("google.com");
                    }
                }
            }

        %>
      -->

    <footer id="contactanos">
        <h1 class="font-weight-bold mt-5 text-center">Contactenos</h1>
        <hr>
        <div class="row contactenos text-center d-flex d-flex justify-content-center">
            <div class="col-2">
                <a class="nav-link" target="_blank" href="https://www.google.com/maps/place/Cl.+35+%23%2385c-38,+Medell%C3%ADn,+Antioquia/@6.2438178,-75.6103399,14z/data=!4m13!1m7!3m6!1s0x8e4429132997b935:0x6a9cfb1686941026!2sCl.+35+%23%2385c-38,+Medell%C3%ADn,+Antioquia!3b1!8m2!3d6.2441636!4d-75.6102588!3m4!1s0x8e4429132997b935:0x6a9cfb1686941026!8m2!3d6.2441636!4d-75.6102588">
                    <img src="IMG/location.png" width="35%">
                    <p class="mt-2">Cll 35 # 85c-38</p>
                </a>
            </div>
            <div class="col-2">
                <a class="nav-link" target="_blank" href="https://mail.google.com/mail/">
                    <img src="IMG/email.png" width="35%">
                    <p class="mt-2">MORENOABOGAD@GMAIL.COM</p>
                </a>
            </div>
            <div class="col-2">
            </div>
            <div class="col-2">
                <img src="IMG/call.png" width="35%">
                <p class="mt-2">581-30-83</p>
            </div>
            <div class="col-2">
                <a class="nav-link" target="_blank" href="https://api.whatsapp.com/send?phone=0573164120107">
                    <img src="IMG/whatsapp.png" width="35%">
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