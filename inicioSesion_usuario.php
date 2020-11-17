<?php 
    include('conectaBDconPDO.php');
    include('Password.php');
    $myObj = json_decode(file_get_contents('php://input'), true);
    $correo = $myObj['correo'];
    $contra = $myObj['password'];
    $obj =  conectaBD::singleton();

    $result = $obj->inicioSesion($correo);
   
    //compruebo si exixste el correo
    if( count($result) == 1){

        // si existe el correo compuebo la constraseña
        if(Password::verify($contra,$result)){
           
          // session_start();
          // $_SESSION["correo"] = $correo;

            $salida = 3;
            
        }else{

            $salida = 0;
        }

    }else{

        $salida = 1;

    }
    
    echo json_encode($salida);
       
       
?>