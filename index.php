<?php
  include('conectaBDconPDO.php');

  $obj =  conectaBD::singleton();
  $result = $obj->ruta();

  //print_r($result);
  for ($i=0; $i < (count($result)) ; $i++) { 

    $ruta = $result[$i][0];
    echo "<img src=\"$ruta\" border=\"1\" alt=\"Este es el ejemplo de un texto alternativo\" width=\"400\" height=\"300\">";

    $nombre = $result[$i][1];
    echo "<p>$nombre</p>";
  }

//   $ruta1 = $result[0][0];
//   $ruta2 = $result[1][0];

//   $nombre1 = $result[0][1];
//   $nombre2 = $result[1][1];
//   echo "<br>";
//   echo "<img src=\"$ruta1\" border=\"1\" alt=\"Este es el ejemplo de un texto alternativo\">";
//   echo "<p>$nombre1</p>";

//   echo "<img src=\"$ruta2\" border=\"1\" alt=\"Este es el ejemplo de un texto alternativo\">";
//   echo "<p>$nombre2</p>";
?>