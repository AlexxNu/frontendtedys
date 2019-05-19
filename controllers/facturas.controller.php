<?php

class ControladorFacturas{

    static public function ctrMostrarFacturas($item,$valor){
        $tabla = "facturas";

		$respuesta = ModeloFacturas::mdlMostrarFacturas($tabla, $item, $valor);

		return $respuesta;
        
    }
}