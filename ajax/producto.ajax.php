<?php 
require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

class AjaxProductos{

    public $valor ;
    public $item;
    public $ruta;

    public function ajaxVistaProducto(){

        $item1 = $this->item;
		$valor1 = $this->valor;
		
		$item2 = "ruta";
		$valor2 = $this->ruta;
        $respuesta = ControllerProducts::ctrActualizarProducto($item1, $valor1, $item2, $valor2);

        echo json_encode($respuesta);
    }
    /*=============================================
	TRAER EL PRODUCTO DE ACUERDO AL ID
	=============================================*/

	public $id;

	public function ajaxTraerProducto(){

		$item = "id_product";
		$valor = $this->id;

		$respuesta = ControllerProducts::ctrMostrarInfoProduct($item, $valor);

		echo json_encode($respuesta);
	}


} 


if(isset($_POST["valor"])){
    $vista = new AjaxProductos();
    $vista ->valor =$_POST["valor"];
    $vista ->item =$_POST["item"];
    $vista ->ruta =$_POST["ruta"];

    $vista ->ajaxVistaProducto();
}

if(isset($_POST["id"])){

	$producto = new AjaxProductos();
	$producto ->id = $_POST["id"];
	$producto -> ajaxTraerProducto();

}