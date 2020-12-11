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
    $result1 = $obj->comprobarProducto($img);
    // si no esta registrado el producto, lo da de alta
    if ($result1[0][0] == 0) {
        $result = $obj->registroProducto($nombre,$stock,$img,$descripcion,$precio,$categoria);
    }else {
        http_response_code(409);
    }
?>