<?php
  include('utils/conectaBDconPDO.php');

  $obj =  conectaBD::singleton();
  $result = $obj->imprimirProductos();

  echo json_encode($result);
?>