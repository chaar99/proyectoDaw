<?php
    include('conectaBDconPDO.php');
    include("filtrado.php");

    $myObj = json_decode(file_get_contents('php://input'), true);

    $calle = Filtrado::filtrado($myObj['calle']);
    $destalle_calle = Filtrado::filtrado($myObj['detC']);
    $ciudad = Filtrado::filtrado($myObj['ciudad']);
    $provincia = Filtrado::filtrado($myObj['prov']);
    $cod_p = Filtrado::filtrado($myObj['codP']);
    $precio_p = Filtrado::filtrado($myObj['total']);
    $ids = $myObj['id'];
    $cantidad = $myObj["cantidad"];

    $obj =  conectaBD::singleton();

    $idU = explode(",", $ids);
    for($i=0; $i<count($idU); $i++){
        $idPro = int($idU[$i]);
        $stock = $obj->comprobarStock($idPro);
        if($stock[0][0] === '0'){
        }else {
            $id_p = $obj->registroPedido($calle,$destalle_calle,$ciudad,$provincia,$cod_p,$precio_p);
            $idPe = $id_p[0][0];           
            $obj->insertarRelacion($idPe, $correo, $idPro, $canti);
        }
    }
?>