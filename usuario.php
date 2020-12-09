<?php
    include('conectaBDconPDO.php');
    include('Password.php');
    $myObj = json_decode(file_get_contents('php://input'), true);
    session_start();
    $correo = "carmenlopezcalvo.4c@gmail.com";
    $obj =  conectaBD::singleton();
    $result = $obj->inicioSesion2($correo);
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>