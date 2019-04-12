<?php
require_once "conexion.php";

class ModelSlide{
	static public function mdlMostrarSlide($table){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $table");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt=null;
	}
}