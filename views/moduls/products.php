<!--=====================================
BANNER
======================================-->

<?php

$url = Route::ctrRoute();
$server = Route::ctrRouteServer();


$ruta = $routes[0];

$banner = ControllerProducts::ctrMostrarBanner($ruta);

date_default_timezone_set('America/Bogota');

$fecha = date('Y-m-d');
$hora = date('H:i:s');

$fechaActual = $fecha.' '.$hora;

if($banner != null){

	if($banner["estado"] != 0){

		echo '<figure class="banner">

				<img src="'.$server.$banner["img"].'" class="img-responsive" width="100%">';	

				if($banner["ruta"] != "sin-categoria"){

					/*=============================================
					BANNER PARA CATEGORÍAS
					=============================================*/

					if($banner["tipo"] == "categorias"){

						$item = "ruta";
						$valor = $banner["ruta"];

						$ofertas = ControllerProducts::ctrMostrarCategorias($item, $valor);

						if($ofertas["oferta"] == 1){

							echo '<div class="textoBanner textoIzq">

								<h1 style="color:#fff" class="text-uppercase">'.$ofertas["categoria"].'</h1>

							</div>

							<div class="textoBanner textoDer">
							
								<h1 style="color:#fff">OFERTAS ESPECIALES</h1>';

								if($ofertas["precioOferta"] != 0){
									
									echo '<h2 style="color:#fff"><strong>Todos los productos a $ '.$ofertas["precioOferta"].'</strong></h2>';

								}

								if($ofertas["descuentoOferta"] != 0){
								
									echo '<h2 style="color:#fff"><strong>Todos los productos con '.$ofertas["descuentoOferta"].'% OFF</strong></h2>';
								}

							echo '<h3 class="col-md-0 col-sm-0 col-xs-0" style="color:#fff">
								
								La oferta termina en<br>

								<div class="countdown2" finOferta="'.$ofertas["finOferta"].'">


							</h3>';

							$datetime1 = new DateTime($ofertas["finOferta"]);
							$datetime2 = new DateTime($fechaActual);

							$interval = date_diff($datetime1, $datetime2);

							$finOferta = $interval->format('%a');

							if($finOferta == 0){

								echo '<h3 class="col-lg-0" style="color:#fff">La oferta termina hoy</h3>';

							}else if($finOferta == 1){
		
								echo '<h3 class="col-lg-0" style="color:#fff">La oferta termina en '.$finOferta.' día</h3>';
		
							}else{
		
								echo '<h3 class="col-lg-0" style="color:#fff">La oferta termina en '.$finOferta.' días</h3>';
		
							}


							echo '</div>';

						}

					}

				



				}

		echo '</figure>';

	}

}

?>
--!>
<div class="container-fluid well well-sm barraProductos">

<div class="container">
    
    <div class="row">

    <div class="col-sm-6 col-xs-12">

        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            Ordenar Productos <span class="caret"></span> </button> 

            <ul class="dropdown-menu" role="menu">

            <?php

            echo'   <li><a href="'.$url.$routes[0].'/1/recientes">Mas reciente</a></li>
                    <li><a href="'.$url.$routes[0].'/1/antiguos">Mas antiguo</a></li>';
               ?>
            </ul>
        </div>

    </div>
        
        

    </div>

</div>

</div>

		<!--=====================================
		PRODUCT LIST
		======================================-->

<div class="container-fluid productos">
	
	<div class="container">
		
		<div class="row">
            
            <!--=====================================
			BREADCRUMP O MIGAS DE PAN
			======================================-->

            
			<div class="bcrumbs">
                <div class="container">
                    <ul>
                        <li><a href="<?php echo $url; ?>">INICIO</a></li>
                        <li class="active pagActiva" style="text-transform:uppercase; color:#FFCC01;"><?php echo $routes[0]; ?></li>
                    </ul>
                </div>
            </div>

			
<?php 
//LLAMADO DE PAGINACION

if(isset($routes[1])){

//$_SESSION["ordenar"] = "DESC";

    if(isset($routes[2])){
        if($routes[2]=="antiguos"){
            $modo = "ASC";

            $_SESSION["ordenar"] = $modo;
        }else{
            $modo = "DESC";
            $_SESSION["ordenar"] = $modo;
        }
    }else{
        if(isset($_SESSION["ordenar"])){
            $modo =$_SESSION["ordenar"];
        }else{
            $modo = "DESC";
        }
        
    }
    $base=($routes[1] - 1)*12;
    $tope=12;

}else{
    $routes[1] = 1;
    $base=0;
    $tope=12;
    $modo = "DESC";
}


//LLAMADO DE CATEGORIAS Y DESTACADOS
if($routes[0] == "lo-mas-vendido"){
    $ordenar = "ventas";
    $item2 = null;
    $value2 = null;
}else if($routes[0] == "lo-mas-visto"){
    $ordenar = "vistas";
    $item2 = null;
    $value2 = null;
}else{
    $ordenar = "id_product";
    $item1 = "rute";
    $value1 = $routes[0];
    
    $categoria = ControllerProducts::ctrMostrarCategorias($item1, $value1);
    
    
    if(!$categoria){
        $item2 = "id_category";
        $value2 = $categoria[0]["id_category"];
    
    }else{
    
        $item2 = "id_category";
        $value2 = $categoria["id_category"];
    
    }
}



$productos = ControllerProducts::ctrMostrarProductos($ordenar,$item2,$value2,$base,$tope,$modo);
$listaProductos = ControllerProducts::ctrListarProductos($ordenar,$item2,$value2);

if(!$productos){
    echo "<div class='col-xs-12 notfound-404'>
    <h1> <small> Oops!</small></h1>
    <h2> Aun no hay productos en esta categoria</h2>
    </div>";
}else{
    echo'<ul class="grid0">';
       
    
    foreach($productos as $key => $value){
echo '<div class="col-md-3 col-sm-4 clear-box">
    <div class="product-item">
        <div class="item-thumb">';
        
        if($value["nuevo"] != 0){
            echo' <span class="badge new" style="font-size: 11.5px">Nuevo</span>';
         }
         if($value["oferta"] != 0){
             echo '<span class="badge offer">-'.$value["descuentoOferta"].'%</span>';
         }
    
            echo '<a href="'.$url.$value["ruta"].'" class="pixelProducto">
            <img src="'.$server.$value["portada"].'" class="img-responsive" alt=""/>
            <div class="overlay-rmore fa fa-plus quickview"></div>
            <div class="overlay-rmore fa fa-plus quickview"></div>
            </a>
            <div class="product-overlay">
            <button type="button" class="addcart agregarCarrito"  idProducto="'.$value["id_product"].'" imagen="'.$server.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precioOferta"].'" peso="'.$value["peso"].'" data-toggle="tooltip"><i class="fa fa-shopping-cart" aria-hidden="true"></i>

            </button>
                <button type="button" class="btn btn-default btn-xs deseos"  idProducto="'.$value["id_product"].'" data-toggle="tooltip">

                      <i class="fa fa-heart" aria-hidden="true"></i></button>
            </div>
        </div>
        <div class="product-info">
            <h4 class="product-title"><a href="'.$url.$value["ruta"].'">'.$value["titulo"].'</a></h4>';
            if($value["oferta"] != 0){
                echo '<span class="product-price" style="font-weight:bold;"><small class="cutprice" style="font-weight:normal;">$'.$value["precio"].' MXN </small> $'.$value["precioOferta"].' MXN</span>';
            
        }
        else{
            echo '<span class="product-price" style="font-weight:bold;">$ '.$value["precio"].' MXN</span>';
        }
            echo '<div class="item-colors">  
            </div>
        </div>
    </div>
</div>';
}
echo '</ul>';
}

?>

<!--PAGINACION-->
<?php 
if(count($listaProductos) !=0){
    $pageProductos = ceil(count($listaProductos)/12);

    if($pageProductos >4){
        //LOS BOTONES DE LAS PRIMERAS 4 PAGINAS Y LA ULTIMA PAGINA
        if($routes[1] == 1){
        echo '<div class="pagenav-wrap" style="font-size:18px;">
        <div class="row">
            <div class="col-md-12 col-sm-12">
               
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="pull-right">
                    <em>Página:</em>
                    <ul class="page_nav">';
                    for($i =1; $i<=4; $i++){
                    echo '<li><a id="item'.$i.'" href="'.$url.$routes[0].'/'.$i.'">'.$i.'</a></li>';
                }
                    echo '<li class="disabled"><a>...</a></li>
                    <li><a id="item'.$pageProductos.' href="'.$url.$routes[0].'/'.$pageProductos.'">'.$pageProductos.'</a></li>
                    <li><a href="'.$url.$routes[0].'/2"><i class="fa fa-angle-right" aria-hidden="true">
                    </i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>';
}
//BOTONES DE LA MITAD DE PAGINAS HACIA ABAJO
else if($routes[1] != $pageProductos && $routes[1] != 1 && $routes[1] <($pageProductos/2) && $routes[1] < ($pageProductos-3)){
$numPagActual = $routes[1];

echo '<div class="pagenav-wrap" style="font-size:18px;">
        <div class="row">
            <div class="col-md-12 col-sm-12">
               
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="pull-right">
                    <em>Página:</em>
                    <ul class="page_nav">
                    <li><a href="'.$url.$routes[0].'/'.($numPagActual-1).'"><i class="fa fa-angle-left " 
                    aria-hidden="true"></i></a></li>';
                    for($i =$numPagActual; $i<=($numPagActual+3); $i++){
                    echo '<li><a id="item'.$i.'" href="'.$url.$routes[0].'/'.$i.'">'.$i.'</a></li>';
                }
                    echo '<li class="disabled"><a>...</a></li>
                    <li><a id="item'.$pageProductos.' "href="'.$url.$routes[0].'/'.$pageProductos.'">'.$pageProductos.'</a></li>
                    <li><a href="'.$url.$routes[0].'/'.($numPagActual+1).'"><i class="fa fa-angle-right" aria-hidden="true">
                    </i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>';

}
//BOTONES DE LA MITAD DE PAGINAS HACIA ARRIBA
else if($routes[1] != $pageProductos && $routes[1] != 1 && $routes[1] >= ($pageProductos/2) && $routes[1] < ($pageProductos-3)){
    $numPagActual = $routes[1];
    echo '<div class="pagenav-wrap" style="font-size:18px;">
        <div class="row">
            <div class="col-md-12 col-sm-12">
               
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="pull-right">
                    <em>Página:</em>
                    <ul class="page_nav">
                    <li><a href="'.$url.$routes[0].'/'.($numPagActual-1).'"><i class="fa fa-angle-left " 
                    aria-hidden="true"></i></a></li>
                    <li><a id="item1" href="'.$url.$routes[0].'/1">1</a></li>
                    <li class="disabled"><a>...</a></li>'
                    ;
                    for($i =$numPagActual; $i<=($numPagActual+3); $i++){
                        echo '<li><a id="item'.$i.'" href="'.$url.$routes[0].'/'.$i.'">'.$i.'</a></li>';
                    }
                    echo '
                    <li><a href="'.$url.$routes[0].'/'.($numPagActual+1).'"><i class="fa fa-angle-right" aria-hidden="true">
                    </i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>';

}
else{
    $numPagActual = $routes[1];
    echo '<div class="pagenav-wrap" style="font-size:18px;">
        <div class="row">
            <div class="col-md-12 col-sm-12">
               
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="pull-right">
                    <em>Página:</em>
                    <ul class="page_nav">
                    <li><a href="'.$url.$routes[0].'/'.($numPagActual-1).'"><i class="fa fa-angle-left " 
                    aria-hidden="true"></i></a></li>
                    <li><a id="item1" href="'.$url.$routes[0].'/1">1</a></li>
                    <li class="disabled"><a>...</a></li>'
                    ;
                    for($i =$pageProductos-3; $i<=$pageProductos; $i++){
                    echo '<li><a id="item'.$i.'" href="'.$url.$routes[0].'/'.$i.'">'.$i.'</a></li>';
                }
                    echo '
                     </ul>
                </div>
            </div>
        </div>
    </div>';
}

    }else{
        echo '<div class="pagenav-wrap" style="font-size:18px;">
        <div class="row">
            <div class="col-md-12 col-sm-12">
               
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="pull-right">
                    <em>Página:</em>
                    <ul class="page_nav">';
                    for($i =1; $i<=$pageProductos; $i++){
                    echo '<li ><a id="item'.$i.'" href="'.$url.$routes[0].'/'.$i.'">'.$i.'</a></li>';
                }
                    echo '</ul>
                </div>
            </div>
        </div>
    </div>';
    }
}
?>
</div>
</div>
</div>
<script>
var pagActiva = $(".pagActiva").html();
    if (pagActiva != null) {
        var regPagActiva = pagActiva.replace(/-/g, " ");
        $(".pagActiva").html(regPagActiva);
    }

    //ENLACE PAGINACION

    var url = window.location.href;

var indice = url.split("/");

var pagActual = indice[5];
if(isNaN(pagActual)){
    $("#item1").addClass("active");
}else{
    $("#item"+pagActual).addClass("active");
}


    
    
</script>
