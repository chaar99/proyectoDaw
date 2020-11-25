<?php 
    include('conectaBDconPDO.php');
    include("filtrado.php");
    $myObj = json_decode(file_get_contents('php://input'), true);
    
    $nombre = Filtrado::filtrado($myObj['nombre']);
    $descripcion = Filtrado::filtrado($myObj['descripcion']);
    $ruta = $myObj['ruta'];
    $stock = (int)(Filtrado::filtrado($myObj['stock']));
    $precio = (int)(Filtrado::filtrado($myObj['precio']));
    $categoria = Filtrado::filtrado($myObj['categoria']);

    $partes = explode("\\", $ruta);
    $img = $partes[2];
    
    $obj =  conectaBD::singleton();

    $result = $obj->registroProducto($nombre,$stock,$img,$descripcion,$precio,$categoria);
          
       
?>