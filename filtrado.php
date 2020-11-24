<?php
	class Filtrado{	

		 function __construct(){}

		public static function filtrado($datos){
		    $datos = trim($datos);
		    $datos = stripslashes($datos);
		    $datos = htmlspecialchars($datos);
		    return $datos;
		}
	}

?>