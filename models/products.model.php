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
	 
	 static public function mdlMostrarProductos($table,$ordenar){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $table ORDER BY $ordenar DESC LIMIT 4");
		$stmt -> execute();

		return $stmt->fetchAll();

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
 }