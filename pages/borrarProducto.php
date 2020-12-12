<?php
	include('./../utils/conectaBDconPDO.php');

    $myObj = json_decode(file_get_contents('php://input'), true);
    
    $id = $myObj['id'];

    $obj =  conectaBD::singleton();
    $obj->borrarProducto($id);

?>