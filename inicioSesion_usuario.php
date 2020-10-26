<?php 
    include('conectaBDconPDO.php');
    include('Password.php');

    $correo = "carmenlopezcalvo.4c@gmail.com";
    $contra = "123";

    $obj =  conectaBD::singleton();

    $result = $obj->inicioSesion($correo);
    print_r($result);
  
    // if( count($result) == 1){

    //      if(Password::verify($contra,$result)){

    //         echo "usuario registrado";
        
    //     }
    // }   
       
?>