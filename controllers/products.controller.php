<?php
class ControllerProducts{
	static public function ctrMostrarCategorias($item, $value){
		$table = "categories";
		$response = ModelProducts::mdlMostrarCategorias($table,$item,$value);

		return $response;
	}
}