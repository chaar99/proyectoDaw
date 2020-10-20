<?php
	class conectaBD{
		private $conn = null ;
		private static $instancia;

		private function __construct($database='proyecto'){
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
		public function ruta() { 
			try{ 
				$consulta = "select * from productos";
				$consulta = $this->conn->prepare($consulta);		
				$consulta->execute();

				$resultado = $consulta->fetchAll(PDO::FETCH_NUM);
				return $resultado;
			} catch (PDOException $pe){
				die("Error al ejecutar orden select :" . $pe->getMessage());
			} 
		}
	}
?>