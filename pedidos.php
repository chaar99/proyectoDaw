<?php
	include('conectaBDconPDO.php');

    //$myObj = json_decode(file_get_contents('php://input'), true);
    
    //$id = $myObj['id'];
    $id = 1;
    $obj =  conectaBD::singleton();
    $result = $obj->comprobarStock($id);
     if($result != ""){
        // como si hay productos aun en stock hay que insertarlo en la tabla de pedidos, rel pedidos y restar uno en stock
	}
?>