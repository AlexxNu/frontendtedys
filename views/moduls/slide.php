<!-- SLIDER -->

<?php 
$server = Route::ctrRouteServer();
?>

            <div class="slider-wrap">
                <div class="tp-banner-container">
                    <div class="tp-banner slider-5">
                        <ul>
                            <?php 
                                $slide = ControllerSlide::ctrMostrarSlide();

                                foreach ($slide as $key => $value) {
                                $estiloTextoSlide = json_decode($value["estiloTextoSlide"],true);
                                $titulo1 = json_decode($value["titulo1"],true);
                                $titulo2 = json_decode($value["titulo2"],true);
                                $titulo3 = json_decode($value["titulo3"],true);
                                $boton = $value["boton"];     
                        if($value["tipoSlide"] == "slideOpcion1"){
                                echo '<li data-transition="fade" data-slotamount="2" data-masterspeed="500" data-thumb="homeslider_thumb1.jpg"  data-saveperformance="on"  data-title="Intro Slide" class="'.$value["tipoSlide"].'">';

                                if($value["imgProducto"] != ""){

                                
                                echo '<img src="'.$server.$value["imgFondo"].'"  alt="slidebg1" data-lazyload="'.$server.$value["imgProducto"].'" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">';

                                }
                                echo '<div class="tp-caption lft skewtoleftshort rs-parallaxlevel-9"
                                     data-x="'.$estiloTextoSlide["data-x"].'"
                                     data-y="'.$estiloTextoSlide["data-y"].'"
                                     data-speed="1000"
                                     data-start="1400"
                                     data-easing="Power3.easeInOut"
                                     data-elementdelay="0.1"
                                     data-endelementdelay="0.1"
                                     data-end="7300"
                                     data-endspeed="1000"
                                     style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;font-family: Montserrat;
                                     font-size: 46px;
                                     font-weight: bold;
                                     line-height:44px;
                                     text-transform: uppercase;
                                     color: #fff;">'.$titulo1["texto"].'<span class="ss-color" style="color:#d6644a;">'.$titulo1["ss-color"].'</span>'.$titulo1["texto2"].'</div>
                                <div class="tp-caption lft skewtoleftshort rs-parallaxlevel-9"
                                     data-x="'.$estiloTextoSlide["data-x"].'"
                                     data-y="280"
                                     data-speed="1000"
                                     data-start="1600"
                                     data-easing="Power3.easeInOut"
                                     data-elementdelay="0.1"
                                     data-endelementdelay="0.1"
                                     data-end="7300"
                                     data-endspeed="1000"
                                     style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap; font-family: Raleway;
                                     font-size: 26px;
                                     font-weight: bold;
                                     text-transform: uppercase;
                                     color: #fff;
                                     ">'.$titulo2["texto1"].'</div>
                                <div class="tp-caption lft skewtoleftshort rs-parallaxlevel-9"
                                     data-x="'.$estiloTextoSlide["data-x"].'"
                                     data-y="330"
                                     data-speed="1000"
                                     data-start="1800"
                                     data-easing="Power3.easeInOut"
                                     data-elementdelay="0.1"
                                     data-endelementdelay="0.1"
                                     data-end="7300"
                                     data-endspeed="1000"
                                     style="z-index: 3; max-width: 80px; max-height: 4px; width:100%;height:100%;background:#fff;"></div>';

                                     if($value["boton"] == "SI"){
                                echo '<a href="'.$value["url"].'" class="tp-caption lft skewtoleftshort rs-parallaxlevel-9"
                                   data-x="'.$estiloTextoSlide["data-x"].'"
                                   data-y="360"
                                   data-speed="1000"
                                   data-start="2600"
                                   data-easing="Power3.easeInOut"
                                   data-elementdelay="0.1"
                                   data-endelementdelay="0.1"
                                   data-end="7300"
                                   data-endspeed="1000"
                                   style="z-index: 3; max-height:100%;line-height:43px;color:#fff;font-family: Montserrat;
                                   font-size: 12px;
                                   display:table;
                                   font-weight: bold;
                                   text-transform:uppercase;padding:0 40px;background:#000000;position:relative;z-index:77;">
                                    Obtener
                                </a>';
                                }
                                else{

                                }

                                
                            echo '</li>';
                            }
                            else{
                                echo '
                                <li data-transition="fade" data-slotamount="2" data-masterspeed="500" data-thumb="homeslider_thumb1.jpg"  data-saveperformance="on"  data-title="Intro Slide" class="'.$value["tipoSlide"].'">
                                <!-- MAIN IMAGE -->
                                <img src="'.$server.$value["imgFondo"].'"  alt="slidebg1" data-lazyload="'.$server.$value["imgProducto"].'" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                                <div class="tp-caption lft ss-color skewtoleftshort rs-parallaxlevel-9"
                                     data-x="'.$estiloTextoSlide["data-x"].'"
                                     data-y="'.$estiloTextoSlide["data-y"].'"
                                     data-speed="1000"
                                     data-start="1400"
                                     data-easing="Power3.easeInOut"
                                     data-elementdelay="0.1"
                                     data-endelementdelay="0.1"
                                     data-end="7300"
                                     data-endspeed="1000"
                                     style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap; font-family: Montserrat;
                                     font-size: 23px;
                                     font-weight: bold;
                                     text-transform: uppercase;
                                     color: #d6644a;
                                     ">'.$titulo1["texto"].'</div>
                                <div class="tp-caption lft skewtoleftshort rs-parallaxlevel-9"
                                     data-x="'.$estiloTextoSlide["data-x"].'"
                                     data-y="250"
                                     data-speed="1000"
                                     data-start="1400"
                                     data-easing="Power3.easeInOut"
                                     data-elementdelay="0.1"
                                     data-endelementdelay="0.1"
                                     data-end="7300"
                                     data-endspeed="1000"
                                     style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;font-family: Montserrat;
                                     font-size: 46px;
                                     font-weight: bold;
                                     line-height:44px;
                                     text-transform: uppercase;
                                     color: #fff;">'.$titulo2["texto1"].'<br>'.$titulo2["texto2"].'<br>'.$titulo2["texto3"].'</div>
                                <div class="tp-caption lft skewtoleftshort rs-parallaxlevel-9"
                                     data-x="'.$estiloTextoSlide["data-x"].'"
                                     data-y="395"
                                     data-speed="1000"
                                     data-start="1800"
                                     data-easing="Power3.easeInOut"
                                     data-elementdelay="0.1"
                                     data-endelementdelay="0.1"
                                     data-end="7300"
                                     data-endspeed="1000"
                                     style="z-index: 3; max-width: 80px; max-height: 4px; width:100%;height:100%;background:#fff;"></div>
                                <div class="tp-caption lft skewtoleftshort rs-parallaxlevel-9"
                                     data-x="'.$estiloTextoSlide["data-x"].'"
                                     data-y="410"
                                     data-speed="1000"
                                     data-start="2200"
                                     data-easing="Power3.easeInOut"
                                     data-elementdelay="0.1"
                                     data-endelementdelay="0.1"
                                     data-end="7300"
                                     data-endspeed="1000"
                                     style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;   font-family: Raleway;
                                     font-size: 18px;
                                     color: #fff;">
                                    '.$titulo3["texto1"].'<br>
                                    '.$titulo3["texto2"].'
                                </div>';
                               if($value["boton"]=="SI"){
                                echo '<a href="'.$value["url"].'" class="tp-caption lft skewtoleftshort rs-parallaxlevel-9"
                                   data-x="'.$estiloTextoSlide["data-x"].'"
                                   data-y="360"
                                   data-speed="1000"
                                   data-start="2600"
                                   data-easing="Power3.easeInOut"
                                   data-elementdelay="0.1"
                                   data-endelementdelay="0.1"
                                   data-end="7300"
                                   data-endspeed="1000"
                                   style="z-index: 3; max-height:100%;line-height:43px;color:#fff;font-family: Montserrat;
                                   font-size: 12px;
                                   display:table;
                                   font-weight: bold;
                                   text-transform:uppercase;padding:0 40px;background:#000000;position:relative;z-index:77;">
                                    Obtener
                                </a>';
                                }
                                else{

                                }
                                
                            echo '</li>';
                            }
                            }
                            ?> 
                        </ul>
                        <div class="tp-bannertimer"></div>
                    </div>
                </div>
            </div>