<?php
class ControllerProducts{
	static public function ctrMostrarCategorias($item, $value){
		$table = "categories";
		$response = ModelProducts::mdlMostrarCategorias($table,$item,$value);

		return $response;
	}

	//MOSTRAR PRODUCTOS

	static public function ctrMostrarProductos($ordenar,$item,$value,$base,$tope,$modo){
		$table = "products";

		$response = ModelProducts::mdlMostrarProductos($table,$ordenar,$item,$value,$base,$tope,$modo);

		return $response;
	}

	//MOSTRAR INFO PRODUCTOS
	static public function ctrMostrarInfoProduct($item2,$value){
		$table = "products";
		$response = ModelProducts::mdlMostrarInfoProducto($table,$item2,$value);


		return $response;
	}
	
	//LISTAR PRODUCTOS
	static public function ctrListarProductos($ordenar,$item,$value){
		$table = "products";

		$response = ModelProducts::mldListarProductos($table,$ordenar,$item,$value);

		return $response;
	}
	//BUSCADOR
	static public function ctrBuscarProductos($busqueda,$base,$tope,$ordenar,$modo){
		$table = "products";

		$response = ModelProducts::mdlBuscarProductos($table,$busqueda,$base,$tope,$ordenar,$modo);

		return $response;
	}
	//LISTAR PRODUCTOS BUSCADOR
	static public function ctrListarProductosBusqueda($busqueda){
		$table = "products";

		$response = ModelProducts::mdlListarProductosBusqueda($table,$busqueda);

		return $response;
	}	
}