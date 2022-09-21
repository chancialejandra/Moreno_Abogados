<?php
require_once "controladores/plantilla.controladores.php";
require_once "model/CRUDAbogadoModelo.php";
require_once "controladores/CRUDAbogados.controlador.php";
require_once "model/CRUDClienteModelo.php";
require_once "controladores/CRUDClientes.controlador.php";
require_once "model/CRUDLitigioModelo.php";
require_once "controladores/CRUDLitigio.controlador.php";
require_once "model/CRUDJuzgadoModelo.php";
require_once "controladores/CRUDJuzgado.controlador.php";
require_once "model/CRUDContraparteModelo.php";
require_once "controladores/CRUDContraparte.controlador.php";
require_once "model/CRUDActuacionModelo.php";
require_once "controladores/CRUDActuacion.controlador.php";

$plantilla = new Plantilla();
$plantilla -> mostrarPlantilla();


 ?>
