<?php
	class conectaBD{
		private $conn = null ;
		private static $instancia;

		private function __construct($database='tienda'){
			$dsn ="mysql:host=localhost;dbname=$database" ;
			try {
				$this->conn = new PDO( $dsn, 'root', '' );

			} catch ( PDOException $e) {
				die( "¡Error!: " . $e->getMessage() . "<br/>");
			}
		}
		
		// Método singleton que crea instancia sí no está creada
		public static function singleton(){ 
			if (!isset(self::$instancia)) {
				$miclase = __CLASS__;
				self::$instancia = new $miclase;
			}
				return self::$instancia;
		}
		 // Cierra conexión asignándole valor null
		public function __destruct(){

			$this->conn = null;

		}
		public function __clone(){
			trigger_error("La clonación no esta permitida", E_USER_ERROR);
		}		
		public function imprimirProductos() { 
			try{ 
				$consulta = "SELECT * from productos WHERE stock > 0";
				$consulta = $this->conn->prepare($consulta);		
				$consulta->execute();

				$resultado = $consulta->fetchAll(PDO::FETCH_OBJ);
				return $resultado;
			} catch (PDOException $pe){
				die("Error al ejecutar orden select :" . $pe->getMessage());
			} 
		}
		
		public function registroDeUsuario($correo,$usuario,$ape,$contra,$dni,$tipo_u) { 
			try{ 
				//Dar de alta a un usuario
				$sql = "INSERT INTO usuarios (correo, nombre, surname_1, contrasenia, DNI) VALUES(:miCorreo,:miNom,:miApe,:miContra,:miDNI)";
				$resultado = $this->conn->prepare($sql);
				$resultado->execute(array( ":miCorreo"=>$correo,":miNom"=>$usuario, ":miApe"=>$ape, ":miContra"=>$contra,":miDNI"=>$dni));

				//Relacionarlo en la tabla usuarios_roles
				$sql = "INSERT INTO usuarios_roles (correo,idR) VALUES(:miCorreo,:miTipo)";
				$resultado = $this->conn->prepare($sql);
				$resultado->execute(array( ":miCorreo"=>$correo, ":miTipo"=>$tipo_u));

				return $this->inicioSesion2($correo);
			} catch (PDOException $pe){
				die("Error al ejecutar orden select :" . $pe->getMessage());
			} 
		}

		public function inicioSesion($correo) { 
			try{ 
				$consulta = "select contrasenia, count(*) from usuarios where correo=:miCorreo ";
				$consulta = $this->conn->prepare($consulta);
				$consulta->execute(array(':miCorreo' =>$correo));
			
				$resultado = $consulta->fetch(PDO::FETCH_NUM);
				return $resultado;
			} catch (PDOException $pe){
				die("Error al ejecutar orden select :" . $pe->getMessage());
			} 
		}

		public function registroProducto($nombre,$stock,$ruta,$descipcion,$precio) { 
			try{ 
				//Dar de alta a un producto
				$sql = "INSERT INTO productos (nombre, stock, ruta, descripcion, precio) VALUES(:miNombre,:miStock,:miRuta,:miDescipcion,:miPrecio)";
				$resultado = $this->conn->prepare($sql);
				$resultado->execute(array( ":miNombre"=>$nombre,":miStock"=>$stock, ":miRuta"=>$ruta, ":miDescipcion"=>$descipcion,":miPrecio"=>$precio));
				
			} catch (PDOException $pe){
				die("Error al ejecutar orden select :" . $pe->getMessage());
			} 
		}

		public function comprobarProducto($ruta) { 
			try{ 
				$consulta = "select count(*) from productos where ruta=:miRuta ";
				$consulta = $this->conn->prepare($consulta);
				$consulta->execute(array(':miRuta' =>$ruta));
				$resultado = $consulta->fetch(PDO::FETCH_NUM);
				return $resultado;
			} catch (PDOException $pe){
				die("Error al ejecutar orden select :" . $pe->getMessage());
			} 
		}

		public function inicioSesion2($correo) { 
			try{ 
				$consulta = "select u.* , rel.idR  
				FROM usuarios u 
				JOIN usuarios_roles rel
				ON u.correo = rel.correo 
				WHERE u.correo=:miCorreo";
				$consulta = $this->conn->prepare($consulta);
				$consulta->execute(array(':miCorreo' =>$correo));
			
				$resultado = $consulta->fetch(PDO::FETCH_OBJ);
				return $resultado;
			} catch (PDOException $pe){
				die("Error al ejecutar orden select :" . $pe->getMessage());
			} 
		}

		public function registroPedido($calle,$destalle_calle,$ciudad,$provincia,$cod_p,$precio_p) { 
			try{ 
				$sql = "INSERT INTO pedidos (calle, detalle_calle, ciudad, provincia, postal_code, precio_t) VALUES (:miCalle, :miDetalle_calle, :miCiudad, :miProvincia, :miPostal_code, :miPrecio_t)";
				$resultado = $this->conn->prepare($sql);
				$resultado->execute(array( ":miCalle"=>$calle,":miDetalle_calle"=>$destalle_calle, ":miCiudad"=>$ciudad, ":miProvincia"=>$provincia,":miPostal_code"=>$cod_p,":miPrecio_t"=>$precio_p));
				
				$consulta = "SELECT id_pedido from pedidos";
				$consulta = $this->conn->prepare($consulta);
				$consulta->execute();
				$resultado = $consulta->fetch(PDO::FETCH_NUM);
				return $resultado;
			} catch (PDOException $pe){
				die("Error al ejecutar orden select :" . $pe->getMessage());
			} 
		}

		public function borrarProducto($id){
			try{ 
				$sql = "DELETE FROM productos WHERE id_productos = :miId";
				$resultado = $this->conn->prepare($sql);
				$resultado->execute(array( ":miId"=>$id));

			} catch (PDOException $pe){
				die("Error al ejecutar orden select :" . $pe->getMessage());
			} 
		}

		public function comprobarStock($id){
			try{
				$sql = "SELECT stock FROM productos WHERE id_productos = :miId";
				$resultado = $this->conn->prepare($sql);
				$resultado->execute(array(":miId"=>$id));
				$resultado = $resultado->fetch(PDO::FETCH_NUM);
				return $resultado;
			}catch (PDOException $pe){
				die("Error al ejecutar orden select :" . $pe->getMessage());
			} 
		}

		public function insertarRelacion($idP, $correo, $idPro, $canti){
			try{
				$sql = "INSERT INTO rel_pedidos_clientes_productos (id_pedido, correo, id_producto, cantidad_products) VALUES (:miP, :miCorreo, :miProducto, :miCant)";
				$resultado = $this->conn->prepare($sql);
				$resultado->execute(array( ":miP"=>$idP,":miCorreo"=>$correo, ":miProducto"=>$idPro, ":miCant"=>$canti));
				
			}catch (PDOException $pe){
				die("Error al ejecutar orden select :" . $pe->getMessage());
			} 
		}
	}
?>