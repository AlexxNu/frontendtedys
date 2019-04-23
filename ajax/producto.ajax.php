<?php 
require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

class AjaxProductos{

    public $valor ;
    public $item;
    public $ruta;

    public function ajaxVistaProducto(){

        $datos = array("valor"=>$this->valor,
                        "item"=>$this->item,
                        "ruta"=>$this->ruta);
        $respuesta = ControllerProducts::ctrVistas($datos);

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

