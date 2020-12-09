<?php
    include('conectaBDconPDO.php');
    include('Password.php');
    $myObj = json_decode(file_get_contents('php://input'), true);
    // //$password = json_decode($_POST["password"], false);
    //print_r($myObj);
    $correo = $myObj['correo'];
    $nombre = $myObj['nombre'];
    $ape1 = $myObj['apell'];
    $contra_hash = Password::hash($myObj['password']);
    $dni = $myObj['dni'];

    $tipo_u = 1;
    
    $obj =  conectaBD::singleton();
    $result = $obj->inicioSesion($correo);
    if ($result[0][0] == 0) {
        $obj->registroDeUsuario($correo,$nombre,$ape1,$contra_hash,$dni,$tipo_u);
    }else {
       http_response_code(409);
    }
?>