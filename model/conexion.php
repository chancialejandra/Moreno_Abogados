<?php

/**
 *
 */
class ConexionBD
{

  static public function conectar()
  {
    $abogado = new PDO("");
    $abogado -> exec("set names utf8");
    return $abogado;
  }
}


 ?>
