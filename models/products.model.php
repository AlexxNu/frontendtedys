 <?php
 require_once "conexion.php";

 class ModelProducts{
 	static public function mdlMostrarCategorias($table,$item,$value){

 		if($item!=null){

 			$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE $item = :$item");

 			$stmt -> bindParam(":".$item,$value,PDO::PARAM_STR);

 			$stmt -> execute();

 			return $stmt->fetch();

 		}else{
 			$stmt = Conexion::conectar()->prepare("SELECT * FROM $table");

 		$stmt -> execute();

 		return $stmt->fetchAll();

 		

 		}
$stmt -> close();
$stmt = null;
 		
	 }

	 //MOSTRAR PRODUCTOS
	 
	 static public function mdlMostrarProductos($table,$ordenar,$item,$value,$base,$tope,$modo){
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT *FROM $table WHERE $item = :$item 
			ORDER BY $ordenar $modo LIMIT $base, $tope");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT *FROM $table 
			ORDER BY $ordenar $modo LIMIT $base, $tope");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	 }

	 //MOSTRAR INFO PRODUCTO

	 static public function mdlMostrarInfoProducto($table,$item2,$value){
		 $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE $item2 = :$item2");
		 $stmt -> bindParam(":".$item2,$value,PDO::PARAM_STR);
 			$stmt -> execute();
		 return $stmt->fetch();

		$stmt -> close();
		$stmt = null;

	 }

	 //LISTAR PRODUCTOS

		static public function mldListarProductos($table,$ordenar,$item,$value){
			if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE $item= :$item 
			ORDER BY $ordenar DESC");
			$stmt -> bindParam(":".$item,$value,PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt->fetchAll();
			}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $table ORDER BY $ordenar DESC");
		
			$stmt -> execute();
			return $stmt->fetchAll();
			}
			$stmt -> close();
			$stmt = null;
		}

		//BUSCADOR

		static public function mdlBuscarProductos($table,$busqueda,$base,$tope,$ordenar,$modo){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE ruta LIKE '%$busqueda%' 
			OR titulo LIKE '%$busqueda%' OR titular LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%'
			ORDER BY $ordenar $modo LIMIT $base, $tope");
			$stmt -> execute();
			return $stmt->fetchAll();
			$stmt -> close();
			$stmt = null;
		}
		//LISTAR PRODUCTOS BUSCADOR

		static public function mdlListarProductosBusqueda($table,$busqueda){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE ruta LIKE '%$busqueda%' 
			OR titulo LIKE '%$busqueda%' OR titular LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%'");
			$stmt -> execute();
			return $stmt->fetchAll();
			$stmt -> close();
			$stmt = null;
		}
		/*=============================================
	ACTUALIZAR VISTA PRODUCTO
	=============================================*/

	static public function mdlActualizarProducto($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
 }