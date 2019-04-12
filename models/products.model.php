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
 }