<?php

/**
 *
 */
class ConexionBD
{

  static public function conectar()
  {
    $abogado = new PDO("mysql:host=localhost; dbname=bd_moreno_abogados", "root", "");
    $abogado -> exec("set names utf8");
    return $abogado;
  }
}


 ?>
