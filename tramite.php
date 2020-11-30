<?php
    include('conectaBDconPDO.php');
    include("filtrado.php");

    $myObj = json_decode(file_get_contents('php://input'), true);
    
    $calle = Filtrado::filtrado($myObj['calle']);
    $destalle_calle = Filtrado::filtrado($myObj['destalle_calle']);
    $ciudad = Filtrado::filtrado($myObj['ciudad']);
    $provincia = Filtrado::filtrado($myObj['provincia']);
    $cod_p = Filtrado::filtrado($myObj['cod_p']);
    $precio_p = Filtrado::filtrado($myObj['precio_p']);
    $correo = Filtrado::filtrado($myObj['correo']);


    // $calle = "calle manojo de rosas";
    // $destalle_calle = "18 2ºD";
    // $ciudad = "Madrid";
    // $provincia = "Madrid";
    // $cod_p = "28041";
    // $precio_p = 106;
    // $correo = "carmenLopezcalvo.4c@gmail.com";
    $obj =  conectaBD::singleton();
    $obj->registroPedido($calle,$destalle_calle,$ciudad,$provincia,$cod_p,$precio_p,$correo);

?>