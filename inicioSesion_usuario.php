<?php 
    include('conectaBDconPDO.php');
    include('Password.php');
    
    $myObj = json_decode(file_get_contents('php://input'), true);
    $correo = $myObj['correo'];
    $contra = $myObj['password'];
    // $correo = "carmenlopezcalvo.4c@gmail.com";
    // $contra = 1231231231;
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