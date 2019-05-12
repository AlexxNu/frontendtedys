<?php

class controllerTemplate{
    
    public function template(){
        include "views/home_e.php";
    }
    /*=============================================
	TRAEMOS LAS CABECERAS
	=============================================*/

	static public function ctrTraerCabeceras($ruta){

		$tabla = "cabeceras";

		$respuesta = ModeloPlantilla::mdlTraerCabeceras($tabla, $ruta);

		return $respuesta;	

	}
}
