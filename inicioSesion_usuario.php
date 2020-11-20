<?php 
    include('conectaBDconPDO.php');
    include('Password.php');
    $myObj = json_decode(file_get_contents('php://input'), true);
    $correo = $myObj['correo'];
    $contra = $myObj['password'];
    // $correo = "carmenlopezcalvo.4c@gmail.com";
    // $contra = 123;
    $obj =  conectaBD::singleton();

    $result = $obj->inicioSesion($correo);
        
    //compruebo si exixste el correo
    if( count($result) == 1){

        // si existe el correo compuebo la constraseña
        if(Password::verify($contra,$result[0])){
           
            // session_start();
            // $_SESSION["correo"] = $correo;
            $result2 = $obj->inicioSesion2($correo);
            
            //$salida -> $correo;
            
        }else{

            $result = 0;
        }

    }else{

        $result = 1;

    }
    
    echo json_encode($result2);
       
       
?>