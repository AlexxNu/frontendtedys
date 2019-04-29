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
                            <div role="tabpanel">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Descripcion del producto</a></li>
                                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Opiniones de los clientes</a></li>
                                </ul>
                                <!-- Tab panes -->

                               
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="home">
                                    <?php 
                                $detalles = json_decode($infoproducto["detalles"],true);

                                echo '<div class="space10"></div>
                                <p>'.$infoproducto["descripcion"].'</p>
                                <div class="space20"></div>
                                <ul class="dot">';
                                if($detalles["Tamano"] != null){
                                           echo'<li>Tamaño: '.$detalles["Tamano"].'</li>';
                                        }
                                if($detalles["Color"] != null){
                                            echo'<li>Color: '.$detalles["Color"].'</li>';
                                        }
                                       echo' </ul>
                                <div class="space20"></div>';
                                ?>
                                        
                                        
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="profile">
                                        <div class="reviews-tab">
                                            <p><b>Smile Nguyen</b>, 23 July 2014</p>
                                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                                            <div class="ratings">
                                                <span class="act fa fa-star"></span>
                                                <span class="act fa fa-star"></span>
                                                <span class="act fa fa-star"></span>
                                                <span class="act fa fa-star"></span>
                                                <span class="act fa fa-star"></span>
                                            </div>
                                            <div class="sep"></div>
                                            <p><b>Smile Nguyen</b>, 23 July 2014</p>
                                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                                            <div class="ratings">
                                                <span class="act fa fa-star"></span>
                                                <span class="act fa fa-star"></span>
                                                <span class="act fa fa-star"></span>
                                                <span class="act fa fa-star"></span>
                                                <span class="act fa fa-star"></span>
                                            </div>
                                            <div class="sep"></div>
                                            <form>
                                                <h5>Write a Review</h5>
                                                <label>Your Name *</label>
                                                <input type="text">
                                                <div class="space20"></div>
                                                <label>Your Review *</label>
                                                <textarea></textarea>
                                                <br>
                                                <div class="clearfix space20"></div>
                                                <span class="pull-left">Rating*&nbsp;&nbsp;</span>
                                                <div class="ratings">
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                </div>
                                                <div class="clearfix space20"></div>
                                                <button type="submit" class="btn-black">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                   
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
        echo '
            </div>
            </div>
            <div class="space10 clearfix"></div>
        </div>
';
     }

?>
                            <div class="clearfix space20"></div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="related-posts">
                                        <h5>Recently Viewed</h5>
                                        <ul>
                                            <li><a href="./single-product.html"><img src="<?php echo $server; ?>views/images/products/fashion/1.jpg" class="img-responsive" alt=""/></a></li>
                                            <li><a href="./single-product.html"><img src="<?php echo $server; ?>views/images/products/fashion/2.jpg" class="img-responsive" alt=""/></a></li>
                                            <li><a href="./single-product.html"><img src="<?php echo $server; ?>views/images/products/fashion/3.jpg" class="img-responsive" alt=""/></a></li>
                                            <li><a href="./single-product.html"><img src="<?php echo $server; ?>views/images/products/fashion/4.jpg" class="img-responsive" alt=""/></a></li>
                                            <li><a href="./single-product.html"><img src="<?php echo $server; ?>views/images/products/fashion/5.jpg" class="img-responsive" alt=""/></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    
   
</script>