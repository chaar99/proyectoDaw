<?php 
    
    $ruta = "hola\ soy un incordio\ jejejej\ x2";
    echo $ruta;
    $partes = explode("\\", $ruta);
    print_r($partes);
    $img = $partes[3];
   
   echo $img;       
       
?>