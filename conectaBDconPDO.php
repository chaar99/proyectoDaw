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
		
		//método singleton que crea instancia sí no está creada
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
		public function imprimir_productos() { 
			try{ 
				$consulta = "select * from productos";
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
			} catch (PDOException $pe){
				die("Error al ejecutar orden select :" . $pe->getMessage());
			} 
		}

		public function inicioSesion($correo) { 
			try{ 
				$consulta = "select contrasenia from usuarios where correo=:miCorreo ";
				$consulta = $this->conn->prepare($consulta);
				$consulta->execute(array(':miCorreo' =>$correo));
			
				$resultado = $consulta->fetch();
				return $resultado['contrasenia'];
			} catch (PDOException $pe){
				die("Error al ejecutar orden select :" . $pe->getMessage());
			} 
		}
	}
?>