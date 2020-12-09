<?php
    include('conectaBDconPDO.php');
    include("filtrado.php");

    $myObj = json_decode(file_get_contents('php://input'), true);

    session_start();
    $correo = $_SESSION["correo"];
    $calle = Filtrado::filtrado($myObj['calle']);
    $destalle_calle = Filtrado::filtrado($myObj['detC']);
    $ciudad = Filtrado::filtrado($myObj['ciudad']);
    $provincia = Filtrado::filtrado($myObj['prov']);
    $cod_p = Filtrado::filtrado($myObj['codP']);
    $precio_p = Filtrado::filtrado($myObj['total']);

    $obj =  conectaBD::singleton();
    $obj->registroPedido($calle,$destalle_calle,$ciudad,$provincia,$cod_p,$precio_p,$correo);
    
    // $calle = "calle manojo de rosas";
    // $destalle_calle = "18 2ºD";
    // $ciudad = "Madrid";
    // $provincia = "Madrid";
    // $cod_p = "28041";
    // $precio_p = 106;
    // $correo = "carmenLopezcalvo.4c@gmail.com";
    // $obj =  conectaBD::singleton();
    // $obj->registroPedido($calle,$destalle_calle,$ciudad,$provincia,$cod_p,$precio_p,$correo);
?>