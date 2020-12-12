<?php
    include('conectaBDconPDO.php');
    include('Password.php');
    $myObj = json_decode(file_get_contents('php://input'), true);

    $correo = $myObj['correo'];
    $nombre = $myObj['nombre'];
    $ape1 = $myObj['apell'];
    $contra_hash = Password::hash($myObj['password']);
    $dni = $myObj['dni'];

    $tipo_u = 2;

    $obj =  conectaBD::singleton();
    $result = $obj->inicioSesion($correo);
    if ($result[1] == 0) {
        //echo "no existe el usuario entonces lo doy de alta";
        $salida = $obj->registroDeUsuario($correo,$nombre,$ape1,$contra_hash,$dni,$tipo_u);
        session_start();
        $_SESSION["correo"] = $correo;
        echo json_encode($salida, JSON_UNESCAPED_UNICODE);
    }else {
       http_response_code(409);
    }
    
?>