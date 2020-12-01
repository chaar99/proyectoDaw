<?php 
    include('conectaBDconPDO.php');
    include('Password.php');
    
    $myObj = json_decode(file_get_contents('php://input'), true);
    $correo = $myObj['correo'];
    $contra = $myObj['password'];
    // $correo = "carmenlopezcalvo.4c@gmail.com";
    // $contra = 1223;
    $obj =  conectaBD::singleton();
    $result = $obj->inicioSesion($correo);

    //compruebo si exixste el correo
    if($result == ""){

        $salida = "El correo no existe";

    }else{
        // si existe el correo compuebo la constraseña
        if(Password::verify($contra,$result[0])){
            
            // session_start();
            // $_SESSION["correo"] = $correo;
            $salida =$obj->inicioSesion2($correo);
        }else{
           $salida = "la contraseña es incorrecta";
        }
    }

    echo json_encode($salida, JSON_UNESCAPED_UNICODE);
?>