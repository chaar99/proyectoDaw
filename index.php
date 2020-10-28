<?php
  include('conectaBDconPDO.php');

  $obj =  conectaBD::singleton();
  $result = $obj->imprimir_productos();

  echo json_encode($result);
?>