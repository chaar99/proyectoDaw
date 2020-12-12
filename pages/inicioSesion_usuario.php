<?php 
    include('./../utils/conectaBDconPDO.php');
    include('./../utils/Password.php');
    include('./../utils/filtrado.php');
    
    $myObj = json_decode(file_get_contents('php://input'), true);
    $correo =  Filtrado::filtrado($myObj['correo']);
    $contra =  Filtrado::filtrado($myObj['password']);

    $obj =  conectaBD::singleton();
    $result = $obj->inicioSesion($correo);

    //compruebo si exixste el correo
    if($result[0] == ""){
       http_response_code(205);
    }else{
        // si existe el correo compuebo la constraseña
        if(Password::verify($contra,$result[0])){
            session_start();
            $_SESSION["correo"] = $correo;
            $salida =$obj->inicioSesion2($correo);
            echo json_encode($salida, JSON_UNESCAPED_UNICODE);
        }else{
            http_response_code(205);
        }
    }
?>