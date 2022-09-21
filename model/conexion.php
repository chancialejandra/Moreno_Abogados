<?php

/**
 *
 */
class ConexionBD
{

  static public function conectar()
  {
    $abogado = new PDO("mysql:host=ble5mmo2o5v9oouq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306; dbname=g1f0bqgri51p1rbg", "nnmhmwoli5741v3f", "h46cy7dzz9ff2yk9");
    $abogado -> exec("set names utf8");
    return $abogado;
  }
}


 ?>
