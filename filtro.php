<?php
    include('conectaBDconPDO.php');

    $myObj = json_decode(file_get_contents('php://input'), true);
    
    print_r($myObj);
    $filtro = $myObj['filtro'];

    $obj =  conectaBD::singleton();
    $result = $obj->imprimirProductosFiltro($filtro);
    echo json_encode($result);
?>