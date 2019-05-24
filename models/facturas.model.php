<?php
 require_once "conexion.php";

class ModeloFacturas{
    static public function mdlMostrarFacturas($tabla,$item,$valor){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;
    }
}