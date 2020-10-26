<?php
    include('conectaBDconPDO.php');
    include('Password.php');

    
    $correo = "carmenlopezcalvo.4c@gmail.com";
    $nombre = "chaar99";
    $ape1 = "lopez";
    $contra = "123";    
    $contra_hash = Password::hash($contra);
    $dni = "02298089K";

    $tipo_u = 1;
    $obj =  conectaBD::singleton();
    $obj->registroDeUsuario($correo,$nombre,$ape1,$contra_hash,$dni,$tipo_u);

?>