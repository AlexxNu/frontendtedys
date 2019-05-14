<!--=====================================
PRODUCT BAR
======================================-->
<div class="container-fluid well well-sm barraProductos">

<div class="container">
    
    <div class="row">

    <div class="col-sm-6 col-xs-12">

        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            Ordenar Productos <span class="caret"></span> </button> 

            <ul class="dropdown-menu" role="menu">

            <?php

            echo'   <li><a href="'.$url.$routes[0].'/1/recientes/'.$routes[3].'">Mas reciente</a></li>
                    <li><a href="'.$url.$routes[0].'/1/antiguos/'.$routes[3].'">Mas antiguo</a></li>';
               ?>
            </ul>
        </div>

    </div>
        
        

    </div>

</div>

</div>

<!--=====================================
BREADCRUMB BUSCADOR
======================================-->

<div class="container-fluid productos">
	
	<div class="container">
		
		<div class="row">
            
            <!--=====================================
			BREADCRUMP O MIGAS DE PAN
			======================================-->

            <br>
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
        $modo =$_SESSION["ordenar"];
        
    }
    $base=($routes[1] - 1)*12;
    $tope=12;

}else{
    $routes[1] = 1;
    $base=0;
    $tope=12;
    $modo = "DESC";
}
//LLAMADO DE PRODUCTOS POR BUSQUEDA
$productos = null;
$listaProductos = null;

$ordenar = "id_product";
if(isset($routes[3])){
    $busqueda = $routes[3];

    $productos = ControllerProducts::ctrBuscarProductos($busqueda,$base,$tope,$ordenar,$modo);
    $listaProductos = ControllerProducts::ctrListarProductosBusqueda($busqueda);
}

if(!$productos){
    echo "<div class='col-xs-12 notfound-404'>
    <h1> <small> Oops!</small></h1>
    <h2> Aun no hay productos en esta sección</h2>
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
    
            echo '<img src="'.$server.$value["portada"].'" class="img-responsive" alt=""/>
            <div class="overlay-rmore fa fa-search quickview" data-toggle="modal" data-target="#myModal"></div>
            <div class="overlay-rmore fa fa-search quickview" data-toggle="modal" data-target="#myModal"></div>
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
                echo '<span class="product-price" style="font-weight:bold;"><small class="cutprice" style="font-weight:normal;">$ '.$value["precio"].' MXN </small> $ '.$value["precioOferta"].' MXN</span>';
            
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
                    echo '<li><a id="item'.$i.'" href="'.$url.$routes[0].'/'.$i.'/'.$routes[2].'/'.$routes[3].'">'.$i.'</a></li>';
                }
                    echo '<li class="disabled"><a>...</a></li>
                    <li><a id="item'.$pageProductos.' href="'.$url.$routes[0].'/'.$pageProductos.'/'.$routes[2].'/'.$routes[3].'">'.$pageProductos.'</a></li>
                    <li><a href="'.$url.$routes[0].'/2/'.$routes[2].'/'.$routes[3].'"><i class="fa fa-angle-right" aria-hidden="true">
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
                    <li><a href="'.$url.$routes[0].'/'.($numPagActual-1).'/'.$routes[2].'/'.$routes[3].'"><i class="fa fa-angle-left " 
                    aria-hidden="true"></i></a></li>';
                    for($i =$numPagActual; $i<=($numPagActual+3); $i++){
                    echo '<li><a id="item'.$i.'" href="'.$url.$routes[0].'/'.$i.'/'.$routes[2].'/'.$routes[3].'">'.$i.'</a></li>';
                }
                    echo '<li class="disabled"><a>...</a></li>
                    <li><a id="item'.$pageProductos.' "href="'.$url.$routes[0].'/'.$pageProductos.'/'.$routes[2].'/'.$routes[3].'">'.$pageProductos.'</a></li>
                    <li><a href="'.$url.$routes[0].'/'.($numPagActual+1).'/'.$routes[2].'/'.$routes[3].'"><i class="fa fa-angle-right" aria-hidden="true">
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
                    <li><a href="'.$url.$routes[0].'/'.($numPagActual-1).'/'.$routes[2].'/'.$routes[3].'"><i class="fa fa-angle-left " 
                    aria-hidden="true"></i></a></li>
                    <li><a id="item1" href="'.$url.$routes[0].'/1/'.$routes[2].'/'.$routes[3].'">1</a></li>
                    <li class="disabled"><a>...</a></li>'
                    ;
                    for($i =$numPagActual; $i<=($numPagActual+3); $i++){
                        echo '<li><a id="item'.$i.'" href="'.$url.$routes[0].'/'.$i.'/'.$routes[2].'/'.$routes[3].'">'.$i.'</a></li>';
                    }
                    echo '
                    <li><a href="'.$url.$routes[0].'/'.($numPagActual+1).'/'.$routes[2].'/'.$routes[3].'"><i class="fa fa-angle-right" aria-hidden="true">
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
                    <li><a href="'.$url.$routes[0].'/'.($numPagActual-1).'/'.$routes[2].'/'.$routes[3].'"><i class="fa fa-angle-left " 
                    aria-hidden="true"></i></a></li>
                    <li><a id="item1" href="'.$url.$routes[0].'/1/'.$routes[2].'/'.$routes[3].'">1</a></li>
                    <li class="disabled"><a>...</a></li>'
                    ;
                    for($i =$pageProductos-3; $i<=$pageProductos; $i++){
                    echo '<li><a id="item'.$i.'" href="'.$url.$routes[0].'/'.$i.'/'.$routes[2].'/'.$routes[3].'">'.$i.'</a></li>';
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
                    echo '<li ><a id="item'.$i.'" href="'.$url.$routes[0].'/'.$i.'/'.$routes[2].'/'.$routes[3].'">'.$i.'</a></li>';
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
        $("#item"+pagActual).addClass("active");
    
    
</script>