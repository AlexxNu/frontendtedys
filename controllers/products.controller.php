<?php
class ControllerProducts{
	static public function ctrMostrarCategorias($item, $value){
		$table = "categories";
		$response = ModelProducts::mdlMostrarCategorias($table,$item,$value);

		return $response;
	}

	//MOSTRAR PRODUCTOS

	static public function ctrMostrarProductos($ordenar,$item,$value,$base,$tope){
		$table = "products";

		$response = ModelProducts::mdlMostrarProductos($table,$ordenar,$item,$value,$base,$tope);

		return $response;
	}

	//MOSTRAR INFO PRODUCTOS
	static public function ctrMostrarInfoProduct($item2,$value){
		$table = "products";
		$response = ModelProducts::mdlMostrarInfoProducto($table,$item2,$value);


		return $response;
	}
}