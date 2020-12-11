<?php
include('conectaBDconPDO.php');
$correo = "carmenlopezcalvo.4c@gmail.com";
$obj =  conectaBD::singleton();
$salida =$obj->inicioSesion2($correo);
echo json_encode($salida, JSON_UNESCAPED_UNICODE);
?>