<?php 
$url = Route::ctrRoute();
$server = Route::ctrRouteServer();
?>

            <div class="f-categories">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-3 col-sm-3">
                                    <div class="block-content">
                                        <a href="#"><img src="<?php echo $server;?>views/images/blocks/12.jpg" class="img-responsive" alt=""/></a>
                                        <div class="text-style3">
                                            <h6>Coming soon</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="block-content">
                                        <a href="#"><img src="<?php echo $server;?>views/images/blocks/13.jpg" class="img-responsive" alt=""/></a>
                                        <div class="text-style4">
                                            <h4>Womenswear</h4>
                                            <p>New Women in the wideworld</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="block-content">
                                        <a href="#"><img src="<?php echo $server;?>views/images/blocks/14.jpg" class="img-responsive" alt=""/></a>
                                        <div class="text-style2">
                                            <h6>Leather Bag</h6>
                                            <p>Design by my passion</p>
                                            <a href="#">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<?php

$titulosModulos = array("PRODUCTOS DESTACADOS","LO MAS VISTO");
$descTitulosModulos = array("Los productos más vendidos los encontraras aqui, 
guiate de lo que nuestros usuarios dicen de nuestra calidad.",
"Podras ver lo que los usuarios han visto con mayor frecuencia, 
estamos seguros que encontraras lo que buscas.");

$rutaModulos = array("lo-mas-vendido","lo-mas-visto");

$base=0;
$tope=4;

if($titulosModulos[0] == "PRODUCTOS DESTACADOS"){

$ordenar = "ventas";
$item = null;
    $value= null;

$ventas = ControllerProducts::ctrMostrarProductos($ordenar,$item,$value,$base,$tope);
}

if($titulosModulos[1] == "LO MAS VISTO"){

    $ordenar = "vistas";
    $item = null;
    $value= null;
    
    $vistas = ControllerProducts::ctrMostrarProductos($ordenar,$item,$value,$base,$tope);
    }

 $modulos = array($ventas,$vistas);   

echo '<div class="featured-products featured-products2">
';
    for($i=0;$i<count($titulosModulos);$i++){
        echo '<div class="container">
        <div class="row">
        
            
                <div class="heading-sub heading-sub2 text-center">
                    <h5><span>'.$titulosModulos[$i].'</span></h5>
                    <p>'.$descTitulosModulos[$i].'</p>
                    
                </div>
                
                <a href="'.$rutaModulos[$i].'" class="tp-caption lft skewtoleftshort rs-parallaxlevel-9"
        
        style="z-index: 3; max-height:100%;line-height:43px;color:#fff;font-family: Montserrat;
        font-size: 12px;
        display:table;
        
        margin-left:15px;
        font-weight: bold;
        text-transform:uppercase;padding:0 40px;background:#000000;position:relative;z-index:77;">
         Ver Más >
     </a>  
     <br>';

                    foreach($modulos[$i] as $key => $value){
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

 <!-- PRODUCTOS DESTACADOS -->
            
                   
            <!-- POLICY -->
            <div id="policy3" class="policy-item">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <div class="pi-wrap text-center">
                                <i class="fa fa-plane"></i>
                                <h4>Free shipping<span>Free shipping on all UK order</span></h4>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="pi-wrap text-center">
                                <i class="fa fa-money"></i>
                                <h4>Money Guarantee<span>30 days money back guarantee !</span></h4>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="pi-wrap text-center">
                                <i class="fa fa-clock-o"></i>
                                <h4>Store Hours<span>Open: 9:00AM - Close: 21:00PM</span></h4>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="pi-wrap text-center">
                                <i class="fa fa-life-ring"></i>
                                <h4>Support 24/7<span>We support online 24 hours a day</span></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    

           <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                    <div class="row">
                        <div class="col-md-5 col-sm-6">
                            <div class="owl-carousel sync1">
                                <div class="item"> <img src="<?php echo $server;?>views/images/products/single/1-small.jpg" alt=""> </div>
                            </div>

                            <div class="owl-carousel sync2">
                                <div class="item"> <img src="<?php echo $server;?>views/images/products/single/1.jpg" alt=""> </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-6">
                            <div class="product-single">
                                <div class="ps-header">
                                    <span class="badge offer">-50%</span>
                                    <h3>Product fashion</h3>
                                    <div class="ratings-wrap">
                                        <div class="ratings">
                                            <span class="act fa fa-star"></span>
                                            <span class="act fa fa-star"></span>
                                            <span class="act fa fa-star"></span>
                                            <span class="act fa fa-star"></span>
                                            <span class="act fa fa-star"></span>
                                        </div>
                                        <em>(6 reviews)</em>
                                    </div>
                                    <div class="ps-price"><span>$ 200.00</span> $ 99.00</div>
                                </div>

                                <div class="ps-stock">
                                    Available: <a href="#">In Stock</a>
                                </div>
                                <div class="sep"></div>
                                <div class="ps-color">
                                    <p>Color<span>*</span></p>
                                    <a class="black" href="#" onclick="return false;"></a>
                                    <a class="red" href="#" onclick="return false;"></a>
                                    <a class="yellow" href="#" onclick="return false;"></a>
                                    <a class="darkgrey" href="#" onclick="return false;"></a>
                                    <a class="litebrown" href="#" onclick="return false;"></a>
                                </div>
                                <div class="space10"></div>
                                <div class="row select-wraps">
                                    <div class="col-md-7 col-sm-7">
                                        <p>Size<span>*</span></p>
                                        <select>
                                            <option>XL</option>
                                            <option>XXL</option>
                                            <option>XXXL</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5 col-sm-5">
                                        <p>Quantity<span>*</span></p>
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
                                        <a href="#" class="fa fa-heart-o" onclick="return false;"></a>
                                        <a href="#" class="fa fa-signal" onclick="return false;"></a>
                                        <a href="#" class="fa fa-envelope-o" onclick="return false;"></a>
                                    </span>
                                    <div class="addthis_native_toolbox"></div>
                                </div>
                                <div class="space20"></div>
                                <div class="sep"></div>
                                <a class="btn-color" href="#">Add to Bag</a>
                                <a class="btn-black" href="#">Go to Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="backtotop"><i class="fa fa-chevron-up"></i></div>