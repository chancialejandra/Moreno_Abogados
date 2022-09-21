<?php

/**
 *
 */
class ValidacionForm
{

  function validar_Creacion()
  {
    if (isset($_POST["check"])) {
      if (empty($_POST["Name"])) {
        echo "<p>Correcto</p>";
        return 1;
      }else{
        echo "<p>F</p>";
        return null;
      }
    }
  }
}




 ?>
