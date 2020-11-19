<?php 
    include('conectaBDconPDO.php');
    
    $myObj = json_decode(file_get_contents('php://input'), true);
    print_r($myObj);
    $nombre = $myObj['nombre'];
    $descripcion = $myObj['descripcion'];
    $ruta = $myObj['ruta'];
    $stock = (int)($myObj['stock']);
    $precio = (int)($myObj['precio']);
    $partes = explode("\\", $ruta);
    $img = $partes[2];
    $obj =  conectaBD::singleton();

    $result = $obj->registroProducto($nombre,$stock,$img,$descripcion,$precio);
          
       
?>