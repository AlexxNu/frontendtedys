<?php
$url = Route::ctrRoute();
$server = Route::ctrRouteServer();
?> 


<!--=====================================
BREADCRUMB OFERTAS
======================================-->
<div class="container-fluid well well-sm">
	
	<div class="container">
		
		<div class="row">
			
			<ul class="breadcrumb fondoBreadcrumb text-uppercase">
				
				<li><a href="<?php echo $url;  ?>">INICIO</a></li>
				<li class="active pagActiva"><?php echo $routes[0] ?></li>

			</ul>

		</div>

	</div>

</div>

<div class="container-fluid">

	<div class="container">

		<div class="row" id="moduloOfertas">
			
			<?php

			$item = null;
			$valor = null;

			date_default_timezone_set('America/Bogota');

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			
			$fechaActual = $fecha.' '.$hora;
			
			/*=============================================
			TRAEMOS LAS OFERTAS DE CATEGORÍAS
			=============================================*/

			$respuesta = ControllerProducts::ctrMostrarCategorias($item, $valor);

			foreach ($respuesta as $key => $value) {

				if($value["oferta"] == 1){

					if($value["finOferta"] > $fecha){

						$datetime1 = new DateTime($value["finOferta"]);
						$datetime2 = new DateTime($fechaActual);

						$interval = date_diff($datetime1, $datetime2);

						$finOferta = $interval->format('%a');

						echo '<div class="col-md-4 col-sm-6 col-xs-12">

							<div class="ofertas">
								
								<h3 class="text-center text-uppercase">

									¡OFERTA ESPECIAL EN <br>'.$value["category"].'!
								
								</h3>

								<figure>

									<img class="img-responsive" src="'.$server.$value["imgOferta"].'" width="100%">

									<div class="sombraSuperior"></div>';

									if($value["descuentoOferta"] != 0){


										echo '<h1 class="text-center text-uppercase">%'.$value["descuentoOferta"].' OFF</h1>';
									
									}else{

										echo '<h1 class="text-center text-uppercase">$ '.$value["precioOferta"].'</h1>';

									}
			

								echo '</figure>';

								if($finOferta == 0){

									echo '<h4 class="text-center">La oferta termina hoy</h4>';

								}else if($finOferta == 1){

									echo '<h4 class="text-center">La oferta termina en '.$finOferta.' día</h4>';

								}else{

									echo '<h4 class="text-center">La oferta termina en '.$finOferta.' días</h4>';
								}

							echo '<center>
								
								<div class="countdown" finOferta="'.$value["finOferta"].'"></div>

								<a href="'.$url.$value["rute"].'" class="pixelOferta">

								<button class="btn backColor btn-lg text-uppercase">Ir a la Oferta</button>

								</a>

							</center>
								
							</div>

						</div>';

					}

				}
				
			}
			/*=============================================
			TRAEMOS LAS OFERTAS DE PRODUCTOS
			=============================================*/

			$ordenar = "id_product";

			$respuestaProductos = ControllerProducts::ctrListarProductos($ordenar, $item, $valor);

			foreach ($respuestaProductos as $key => $value) {

				if($value["oferta"] == 1 && $value["ofertadoPorCategoria"] == 0){

					if($value["finOferta"] > $fecha){

						$datetime1 = new DateTime($value["finOferta"]);
						$datetime2 = new DateTime($fechaActual);

						$interval = date_diff($datetime1, $datetime2);

						$finOferta = $interval->format('%a');

						echo '<div class="col-md-4 col-sm-6 col-xs-12">

							<div class="ofertas">
								
								<h3 class="text-center text-uppercase">

									¡OFERTA ESPECIAL EN <br>'.$value["titulo"].'!
								
								</h3>

								<figure>

									<img class="img-responsive" src="'.$server.$value["imgOferta"].'" width="100%">

									<div class="sombraSuperior"></div>';

									if($value["descuentoOferta"] != 0){


										echo '<h1 class="text-center text-uppercase">%'.$value["descuentoOferta"].' OFF</h1>';
									
									}else{

										echo '<h1 class="text-center text-uppercase">$ '.$value["precioOferta"].'</h1>';

									}
			

								echo '</figure>';

								if($finOferta == 0){

									echo '<h4 class="text-center">La oferta termina hoy</h4>';

								}else if($finOferta == 1){

									echo '<h4 class="text-center">La oferta termina en '.$finOferta.' día</h4>';

								}else{

									echo '<h4 class="text-center">La oferta termina en '.$finOferta.' días</h4>';
								}

							echo '<center>
								
								<div class="countdown" finOferta="'.$value["finOferta"].'"></div>

								<a href="'.$url.$value["ruta"].'" class="pixelOferta">

								<button class="btn backColor btn-lg text-uppercase">Ir a la Oferta</button>

								</a>

							</center>
								
							</div>

						</div>';

					}

				}
				
			}


			?>


		</div>

	</div>

</div>

