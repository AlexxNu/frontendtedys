<!-- BREADCRUMBS OPCIONALMENTE SE PUEDE QUITAR!!! -->
<div class="bcrumbs">
                <div class="container">
                    <ul>
                        <li><a href="<?php echo $url; ?>">INICIO</a></li>
                        <li class="active pagActiva" style="text-transform:uppercase; color:#FFCC01;"><?php echo $routes[0]; ?></li>
                    </ul>
                </div>
            </div>

            <div class="space10"></div>

            <?php 
            $item= "ruta";
            $value= $routes[0];
            $infoproducto = ControllerProducts::ctrMostrarInfoProduct($item,$value);

            $multimedia = json_decode($infoproducto["multimedia"],true);

            
            ?>

            <!-- MAIN CONTENT -->
            <div class="shop-single">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-5 col-sm-6">                                    
                                    <div class="owl-carousel prod-slider sync1">
                                        

                                        <?php 
                                        if($multimedia != null){
                                        for($i=0; $i< count($multimedia);$i++){
                                            echo '<div class="item">
                                            <img src="'.$server.$multimedia[$i]["foto"].'">
                                            <a href="'.$server.$multimedia[$i]["foto"].'" rel="prettyPhoto[gallery2]" title="Product" class="caption-link"><i class="fa fa-arrows-alt"></i></a>
                                        </div>';
                                        }
                                     
                                   echo' </div>

                                    <div  class="owl-carousel sync2">';
                              
                                        for($i=0; $i< count($multimedia);$i++){
                                            echo '<div class="item"> <img src="'.$server.$multimedia[$i]["foto"].'" alt=""></div>';
                                        }
                                    }
                                        ?> 
                                        
                                       
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-6">
                                    <div class="product-single">
                                        <div class="ps-header">
                                        <?php 
                                        //TITULO DEL PRODUCTO
                                        if($infoproducto["oferta"]==0){
                                            if($infoproducto["nuevo"]==0){
                                            echo '<h3>'.$infoproducto["titulo"].'</h3>';
                                        }else{
                                            //PRECIO DEL PRODUCTO
                                            echo '<h3>'.$infoproducto["titulo"].'</h3>
                                            <span class="label label-warning">NUEVO</span>"
                                            <div class="ps-price"> $'.$infoproducto["precioOferta"].'</div>';
                                        }
                                        }else{
                                            if($infoproducto["nuevo"]==0){
                                            echo '<span class="badge offer">-'.$infoproducto["descuentoOferta"].'%</span>
                                            <h3>'.$infoproducto["titulo"].'</h3><br>
                                            <div class="ps-price"><span>$'.$infoproducto["precio"].'</span> $'.$infoproducto["precioOferta"].'</div>';
                                        }else{
                                            echo '<span class="badge offer">-'.$infoproducto["descuentoOferta"].'%</span>
                                            <h3>'.$infoproducto["titulo"].'</h3>
                                            <span class="label label-warning">NUEVO</span>"
                                            <div class="ps-price"><span>$'.$infoproducto["precio"].'</span> $'.$infoproducto["precioOferta"].'</div>';
                                              
                                        }
                                    }
                                            
                                     

                                        //DESCRIPCION DEL PRODUCTO  
                                          
                                        echo ' </div>
                                        <p>'.$infoproducto["descripcion"].'</p>
                                        <div class="ratings-wrap">
                                        <div class="ratings">
                                            <span class="act fa fa-star"></span>
                                            <span class="act fa fa-star"></span>
                                            <span class="act fa fa-star"></span>
                                            <span class="act fa fa-star"></span>
                                            <span class="act fa fa-star"></span>
                                        </div>
                                        <em>Promedio de calificacion</em>
                                    </div>
                                        <div class="sep"></div>
                                <div class="ps-color">
                                   
                            <div class="contact-info space50">
                                
                                    <div class="media">
                                        <i class="pull-left fa fa-home"></i>
                                        <div class="media-body">
                                            <strong>Dias habiles:</strong><br><b>'.$infoproducto["entrega"].'</b> dias habiles para su entrega.</div>
                                    </div>
                                    <div class="media">
                                        <i class="pull-left fa fa-shopping-cart"></i>
                                        <div class="media-body">
                                            <strong>Ventas:</strong><br><b>'.$infoproducto["ventas"].'</b> Ventas.</div>
                                    </div>
                                    <div class="media">
                                        <i class="pull-left fa fa-eye"></i>
                                        <div class="media-body">
                                            <strong>Vistas:</strong><br>Visto por <b><span class="vistas">'.$infoproducto["vistas"].'</span></b> personas.</div>
                                    </div>
                                </div>
                                </div>
                                        ';

                                            ?>
                                            <div class="sep"></div>
                                        
                                        <div class="space10"></div>
                                       
                                        <div class="row select-wraps">
                                            
                                            <div class="col-md-5 col-sm-5">
                                                <p>Cantidad<span>*</span></p>
                                                <select>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="space20"></div>
                                        <div class="share">
                                            <span>
                                                <a href="#" class="fa fa-heart-o"></a>
                                                <a href="#" class="fa fa-signal"></a>
                                                <a href="#" class="fa fa-envelope-o"></a>
                                            </span>
                                            <div class="addthis_native_toolbox"></div>
                                        </div>
                                        <div class="space20"></div>
                                        <div class="sep"></div>
                                        <a class="addtobag" href="#">Agregar al Carrito</a>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix space40"></div>
                            <!--=====================================
		COMENTARIOS
		======================================-->

		<br>

<div class="row">

    <?php

    $datos = array("idUsuario"=>"",
                   "idProducto"=>$infoproducto["id_product"]);

    $comentarios = ControladorUsuarios::ctrMostrarComentariosPerfil($datos);
    $cantidad = 0;

    foreach ($comentarios as $key => $value){
        
        if($value["comentario"] != ""){

            $cantidad ++;

        }
    }

    ?>
    
    <ul class="nav nav-tabs">

    <?php

        $cantidadCalificacion = 0;

        if($cantidad == 0){

            echo '<li class="active"><a>ESTE PRODUCTO NO TIENE COMENTARIOS</a></li>
                  <li></li>';

        }else{

            echo '<li class="active"><a>COMENTARIOS '.$cantidad.'</a></li>
                  <li><a id="verMas" href="">Ver más</a></li>';


            $sumaCalificacion = 0;

            foreach ($comentarios as $key => $value) {
                
                if($value["calificacion"] != 0){

                    $cantidadCalificacion ++;

                    $sumaCalificacion += $value["calificacion"];
                }
            }

            $promedio = round($sumaCalificacion/$cantidadCalificacion,1);

            echo '<li class="pull-right"><a class="text-muted">PROMEDIO DE CALIFICACIÓN: '.$promedio.' | ';

            if($promedio >= 0 && $promedio < 0.5){

                echo '<i class="fa fa-star-half-o text-success"></i>
                      <i class="fa fa-star-o text-success"></i>
                      <i class="fa fa-star-o text-success"></i>
                      <i class="fa fa-star-o text-success"></i>
                      <i class="fa fa-star-o text-success"></i>';

            }

            else if($promedio >= 0.5 && $promedio < 1){

                echo '<i class="fa fa-star text-success"></i>
                      <i class="fa fa-star-o text-success"></i>
                      <i class="fa fa-star-o text-success"></i>
                      <i class="fa fa-star-o text-success"></i>
                      <i class="fa fa-star-o text-success"></i>';

            }

            else if($promedio >= 1 && $promedio < 1.5){

                echo '<i class="fa fa-star text-success"></i>
                      <i class="fa fa-star-half-o text-success"></i>
                      <i class="fa fa-star-o text-success"></i>
                      <i class="fa fa-star-o text-success"></i>
                      <i class="fa fa-star-o text-success"></i>';

            }

            else if($promedio >= 1.5 && $promedio < 2){

                echo '<i class="fa fa-star text-success"></i>
                      <i class="fa fa-star text-success"></i>
                      <i class="fa fa-star-o text-success"></i>
                      <i class="fa fa-star-o text-success"></i>
                      <i class="fa fa-star-o text-success"></i>';

            }

            else if($promedio >= 2 && $promedio < 2.5){

                echo '<i class="fa fa-star text-success"></i>
                      <i class="fa fa-star text-success"></i>
                      <i class="fa fa-star-half-o text-success"></i>
                      <i class="fa fa-star-o text-success"></i>
                      <i class="fa fa-star-o text-success"></i>';

            }

            else if($promedio >= 2.5 && $promedio < 3){

                echo '<i class="fa fa-star text-success"></i>
                      <i class="fa fa-star text-success"></i>
                      <i class="fa fa-star text-success"></i>
                      <i class="fa fa-star-o text-success"></i>
                      <i class="fa fa-star-o text-success"></i>';

            }

            else if($promedio >= 3 && $promedio < 3.5){

                echo '<i class="fa fa-star text-success"></i>
                      <i class="fa fa-star text-success"></i>
                      <i class="fa fa-star text-success"></i>
                      <i class="fa fa-star-half-o text-success"></i>
                      <i class="fa fa-star-o text-success"></i>';

            }

            else if($promedio >= 3.5 && $promedio < 4){

                echo '<i class="fa fa-star text-success"></i>
                      <i class="fa fa-star text-success"></i>
                      <i class="fa fa-star text-success"></i>
                      <i class="fa fa-star text-success"></i>
                      <i class="fa fa-star-o text-success"></i>';

            }

            else if($promedio >= 4 && $promedio < 4.5){

                echo '<i class="fa fa-star text-success"></i>
                      <i class="fa fa-star text-success"></i>
                      <i class="fa fa-star text-success"></i>
                      <i class="fa fa-star text-success"></i>
                      <i class="fa fa-star-half-o text-success"></i>';

            }else{

                echo '<i class="fa fa-star text-success"></i>
                      <i class="fa fa-star text-success"></i>
                      <i class="fa fa-star text-success"></i>
                      <i class="fa fa-star text-success"></i>
                      <i class="fa fa-star text-success"></i>';

            }


        }


    ?>

            
        </a></li>

    </ul>

    <br>

</div>

<div class="row comentarios">

<?php

foreach ($comentarios as $key => $value) {
    
    if($value["comentario"] != ""){

        $item = "id";
        $valor = $value["id_usuario"];

        $usuario = ControladorUsuarios::ctrMostrarUsuario($item, $valor);

        echo '<div class="panel-group col-md-3 col-sm-6 col-xs-12 alturaComentarios">
        
            <div class="panel panel-default">
              
              <div class="panel-heading text-uppercase">

                  '.$usuario["nombre"].'
                  <span class="text-right">';

                  if($usuario["modo"] == "directo"){

                      if($usuario["foto"] == ""){

                          echo '<img class="img-circle pull-right" src="'.$server.'views/images/usuarios/default/anonymous.png" width="20%">';	

                      }else{

                          echo '<img class="img-circle pull-right" src="'.$url.$usuario["foto"].'" width="20%">';	

                      }
                  
                  }else{

                      echo '<img class="img-circle pull-right" src="'.$usuario["foto"].'" width="20%">';	

                  }

                  echo '</span>

              </div>
             
              <div class="panel-body"><small>'.$value["comentario"].'</small></div>

              <div class="panel-footer">';
                  
                  switch($value["calificacion"]){

                    case 0.5:
                    echo '<i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                    break;

                    case 1.0:
                    echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                    break;

                    case 1.5:
                    echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                    break;

                    case 2.0:
                    echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                    break;

                    case 2.5:
                    echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                    break;

                    case 3.0:
                    echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                    break;

                    case 3.5:
                    echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                    break;

                    case 4.0:
                    echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                    break;

                    case 4.5:
                    echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>';
                    break;

                    case 5.0:
                    echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                          <i class="fa fa-star text-success" aria-hidden="true"></i>';
                    break;

                }

              echo '</div>
            
            </div>

        </div>';

    }
}

?>

</div>

<hr>

</div>

</div>
                            <div class="clearfix space40"></div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                <?php 
                                $item = "id_category";
                                $value = $infoproducto["id_category"];
                                $rutaArticulosDestacados = ControllerProducts::ctrMostrarCategorias($item,$value); 

                            
                                    echo '<h5 class="heading space40"><span>Articulos relacionados</span></h5>
                                    
                                
                <a href="'.$url.$rutaArticulosDestacados["rute"].'" class="tp-caption lft skewtoleftshort rs-parallaxlevel-9"
        
        style="z-index: 3; max-height:100%;line-height:43px;color:#fff;font-family: Montserrat;
        font-size: 12px;
        display:table;
        
        margin-left:15px;
        font-weight: bold;
        text-transform:uppercase;padding:0 40px;background:#000000;position:relative;z-index:77;">
         Ver Más >
     </a>  
     <br>';
    
     $ordenar = "";
     $item = "id_category";
     $value =$infoproducto["id_category"];
     $base = 0;
     $tope = 4;
     $modo = "Rand()";

     $relacionados = ControllerProducts::ctrMostrarProductos($ordenar,$item,$value,$base,$tope,$modo);

     if(!$relacionados){
         echo "<div class='col-xs-12 notfound-404'>
         <h1> <small> Oops!</small></h1>
         <h4>No hay productos relacionados para este producto</h4>
         </div>";
     }else{
        foreach($relacionados as $key => $value){
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
                            <a href="#" idProducto="'.$value["id_product"].'" class="likeitem fa fa-heart-o deseos"></a>
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
        echo '
            </div>
            </div>
            <div class="space10 clearfix"></div>
        </div>
';
     }

?>
                           
                    </div>
                </div>
            </div>

            <div class="clearfix space20"></div>


<!-- SI SE QUITAN LAS MIGAS DE PAN, QUITAR ESTO-->
<script>
var pagActiva = $(".pagActiva").html();
    if (pagActiva != null) {
        var regPagActiva = pagActiva.replace(/-/g, " ");
        $(".pagActiva").html(regPagActiva);
    }
    /*=============================================
ALTURA COMENTARIOS
=============================================*/

$(".comentarios").css({"height":$(".comentarios .alturaComentarios").height()+"px",
						"overflow":"hidden",
						"margin-bottom":"20px"})

$("#verMas").click(function(e){

	e.preventDefault();

	if($("#verMas").html() == "Ver más"){

		$(".comentarios").css({"overflow":"inherit"});

		$("#verMas").html("Ver menos"); 
	
	}else{

		$(".comentarios").css({"height":$(".comentarios .alturaComentarios").height()+"px",
								"overflow":"hidden",
								"margin-bottom":"20px"})

		$("#verMas").html("Ver más"); 
	}

})

   
</script>