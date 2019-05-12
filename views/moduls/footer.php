<?php 
$url = Route::ctrRoute();
$server = Route::ctrRouteServer();
?>
 <footer>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-3 widget-footer">
                            <h5>Acerca de</h5>
                            <img src="images/basic/logo-lite.png" class="img-responsive space10" alt=""/>
                            <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus</p>
                            <div class="clearfix"></div>
                            <ul class="f-social">
                                <li><a href="https://www.facebook.com" class="fa fa-facebook"></a></li>
                                <li><a href="https://www.twitter.com" class="fa fa-twitter"></a></li>
                                <li><a href="https://feedburner.google.com" class="fa fa-rss"></a></li>
                                <li><a href="mailto:email@website.com" class="fa fa-envelope"></a></li>
                                <li><a href="https://www.pinterest.com" class="fa fa-pinterest"></a></li>
                                <li><a href="https://www.instagram.com" class="fa fa-instagram"></a></li>
                            </ul>
                        </div>
                        
                        <div class="col-md-4 col-sm-3 widget-footer">
                            <h5>Categorias de Productos</h5>
                            <ul class="widget-tags">
                            <?php 

$item = null;
$value = null;
$categorias = ControllerProducts::ctrMostrarCategorias($item, $value);

foreach ($categorias as $key => $value) {
    echo '<li><a href="'.$url.$value["rute"].'">'.$value["category"].'</a></li>';
} 
?>
                                
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-3 widget-footer">
                            <h5>Ubicación</h5>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3763.0121434447556!2d-99.51831578567644!3d19.411881286896016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d20b623ecaac91%3A0x7a707e6d6e54718d!2sS.+Jacinto%2C+Xonacatlan+de+Vicencio%2C+52060+Xonacatl%C3%A1n%2C+M%C3%A9x.!5e0!3m2!1ses!2smx!4v1557699605305!5m2!1ses!2smx" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </footer>

            <!-- FOOTER COPYRIGHT -->
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-sm-7">
                            <p>Copyright 2019 &middot;  Desarrollado por <a href="http://www.nextpageti.com" target="_blank">Next Page.</a> Todos los derechos reservados</p>
                        </div>
                        
                    </div>
                </div>
            </div>	

        </div>