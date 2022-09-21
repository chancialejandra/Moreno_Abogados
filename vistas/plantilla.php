
<?php
session_start();
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
    <title>morenoabogados.ml &mdash; Coming Soon</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="description" content="This is a default index page for a new domain."/>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/Styles.css">
    <link rel="stylesheet" href="CSS/sesion.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
<?php



if (isset($_GET['page'])) {
  if ($_GET['page']=='InicioSesion' ||
      $_GET['page']=='inicio' ||
      $_GET['page'] == 'AbogadoAdmin' ||
      $_GET['page'] == 'GestionAbogados' ||
      $_GET['page'] == 'Acciones_Abogados' ||
      $_GET['page'] == 'Salir' ||
      $_GET['page'] == 'Abogado' ||
      $_GET['page'] == 'CrearLitigio' ||
      $_GET['page'] == 'cliente' ||
      $_GET['page'] == 'Litigio'||
      $_GET['page'] == 'AbogadosInactivos' ||
      $_GET['page'] == 'ListaClientesAdmin' ||
      $_GET['page'] == 'LitigioCliente' ||
      $_GET['page'] == 'AccionesClientes' ||
      $_GET['page'] == 'CrearLitigioUsExistente' ||
      $_GET['page'] == 'CrearAbogado' ||
      $_GET['page'] == 'ModificarAbogado' ||
      $_GET['page'] == 'Calendario' ||
      $_GET['page'] == 'ModificarCliente' ||
      $_GET['page'] == 'RecuperarClave'){

        include $_GET['page'].'.php';
    }
}else{
  include "inicio.php";
}

 ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>


</body>



</html>
