<?php 
$url = Route::ctrRoute();
$server = Route::ctrRouteServer();
?>
<div class="testimonial parallax-bg2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                                <div>
                                    <img src="images/quote/3.png" class="img-responsive" alt=""/>
                                    <div class="quote-info">
                                        <h4>Smile Nguyen</h4>
                                        <cite>Themeforest</cite>	
                                        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris convallis odio in faucibus posuere. In eu scelerisque lorem. Mauris lusto in lacus accumsan interdum.Nam mattis sollicitudin vestibulum"</p>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

               <li><a href="#">Mas reciente</a></li>
               <li><a href="#">Mas antiguo</a></li>
            
            </ul>
        </div>

    </div>
        
        <div class="col-sm-6 col-xs-12 organizarProductos">

            <div class="btn-group pull-right">

                 <button type="button" class="btn btn-default btnGrid" id="btnGrid0">
                     
                    <i class="fa fa-th" aria-hidden="true"></i>  

                    <span class="col-xs-0 pull-right"> GRID</span>

                 </button>

                 <button type="button" class="btn btn-default btnList" id="btnList0">
                     
                    <i class="fa fa-list" aria-hidden="true"></i> 

                    <span class="col-xs-0 pull-right"> LIST</span>

                 </button>
                
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
            
            <ul class="breadcrumb fondoBreadcrumb lead">

               <li><a href="http://">INICIO</li></a>
               <li class="active"><a href="http://"><?php echo $routes[0]; ?></li></a>
            </ul>
			
			<!--=====================================
			BARRA TÍTULO
			======================================-->

<?php

$url = Route::ctrRoute();
$server = Route::ctrRouteServer();

   $item = "ruta";
   $value = $routes[0];

   $ordenar="id_product";
   $base=0;
   $tope=12;

   $categories= ControllerProducts::ctrMostrarProductos($ordenar, $item, $value,$base,$tope);


    if($routes[0] == "lo-mas-vendido"){

        $item1="id_category";
        $value1=$categories[0]["id_category"];
        $ordenar = "ventas";

    }elseif ($routes[0] == "lo-mas-visto") {
        
        $item1="id_category";
        $value1=$categories[0]["id_category"];
        $ordenar = "vistas";
        
    }else {
        
        
   


    if(!$categories){

        echo "No hay prodcutos con esta categoria";
    }else {
        # code...
        $item1="id_category";
        $value1=$categories[0]["id_category"];
    }
        
    }
 




$products=ControllerProducts::ctrMostrarProductos($ordenar,$item1,$value1,$base,$tope);


    if(!$products){

        echo" <div class='col-xs-12 notfound-404'>
              <h1> <small> Oops!</small></h1>
              <h2> Aun no hay productos en esta categoria</h2>
              </div>";
    }else {
 
        echo'<ul class="grid0">';
       
    
                        foreach($products as $key => $value){
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
                                    <a href="#" class="addcart fa fa-shopping-cart"></a>
                                    <a href="#" class="compare fa fa-signal"></a>
                                    <a href="#" id_product="'.$value["id_product"].'" class="likeitem fa fa-heart-o"></a>
                                </div>
                            </div>
                            <div class="product-info">
                                <h4 class="product-title"><a href="'.$value["ruta"].'">'.$value["titulo"].'</a></h4>';
                                if($value["oferta"] != 0){
                                    echo '<span class="product-price" style="font-weight:bold;"><small class="cutprice" style="font-weight:normal;">$'.$value["precio"].' MXN </small> $'.$value["precioOferta"].' MXN</span>';
                                
                            }
                            else{
                                echo '<span class="product-price" style="font-weight:bold;">$'.$value["precio"].' MXN</span>';
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

</div>
</div>
</div>