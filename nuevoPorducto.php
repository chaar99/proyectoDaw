<?php 
    include('conectaBDconPDO.php');
    
    $myObj = json_decode(file_get_contents('php://input'), true);
    print_r($myObj);
    $nombre = $myObj['nombre'];
    $descripcion = $myObj['descripcion'];
    $ruta = $myObj['ruta'];
    $stock = (int)($myObj['stock']);
    $precio = (int)($myObj['precio']);
    // $nombre = "obi";
    // $descripcion = "este es obi wan";
    // $ruta = "obi.jpg";
    // $stock = 4;
    // $precio = 12;
    $obj =  conectaBD::singleton();

    $result = $obj->registroProducto($nombre,$stock,$ruta,$descripcion,$precio);
          
       
?>