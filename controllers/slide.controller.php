<?php

class ControllerSlide{
	public function ctrMostrarSlide(){
		$table = "slide";

		$response = ModelSlide::mdlMostrarSlide($table);

		return $response;
	}
}