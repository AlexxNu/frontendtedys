<?php 
$url = Route::ctrRoute();
$server = Route::ctrRouteServer();


/*=============================================
CREAR EL OBJETO DE LA API GOOGLE
=============================================*/

$cliente = new Google_Client();
$cliente->setAuthConfig('models/client_secret.json');
$cliente->setAccessType("offline");
$cliente->setScopes(['profile','email']);

/*=============================================
RUTA PARA EL LOGIN DE GOOGLE
=============================================*/

$rutaGoogle = $cliente->createAuthUrl();

/*=============================================
RECIBIMOS LA VARIABLE GET DE GOOGLE LLAMADA CODE
=============================================*/

if(isset($_GET["code"])){

	$token = $cliente->authenticate($_GET["code"]);

	$_SESSION['id_token_google'] = $token;

	$cliente->setAccessToken($token);

}

/*=============================================
RECIBIMOS LOS DATOS CIFRADOS DE GOOGLE EN UN ARRAY
=============================================*/

if($cliente->getAccessToken()){

 	$item = $cliente->verifyIdToken();

  

    $datos = array("nombre"=>$item["name"],
				   "email"=>$item["email"],
				   "foto"=>$item["picture"],
				   "password"=>"null",
				   "modo"=>"google",
				   "verificacion"=>0,
				   "emailEncriptado"=>"null");

     $respuesta = ControladorUsuarios::ctrRegistroRedesSociales($datos);
     
     echo '<script>
		
     setTimeout(function(){
 
         window.location = localStorage.getItem("rutaActual");
 
     },1000);
 
      </script>';
}

?>


    <!-- PRELOADER -->
    <div id="loader"></div>

<div class="body">

    <!-- TOPBAR -->
    <div class="top_bar">
        <div class="container">
            <div class="row">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="tb_center pull-left">
                            <ul>
                                <li><i class="fa fa-phone"></i> Hotline: <a href="#">(+800) 2307 2509 8988</a></li>
                                <li><i class="fa fa-envelope-o"></i> <a href="#">online support@smile.com</a></li>
                            </ul>
                        </div>
                        <div class="tb_right pull-right">
                            <ul>
                                <li>
                                    <div class="tbr-info">

                                    <?php 
                                    if(isset($_SESSION["validarSesion"])){
                                        if($_SESSION["validarSesion"] == "ok"){
                                            if($_SESSION["modo"] == "directo"){
                                                if($_SESSION["foto"] != ""){
                                                    echo '<li>
										            <img class="img-circle" src="'.$url.$_SESSION["foto"].'" width="10%">
									                </li>';
                                                }else{
                                                    echo '
									                <img class="img-circle" src="'.$server.'views/images/usuarios/default/anonymous.png" width="10%">
								                    ';
                                                }
                                                echo '<a href="'.$url.'perfil">Ver Perfil</a> |
							                          <a href="'.$url.'salir">Salir</a>';
                                                
                                            }
                                            if($_SESSION["modo"] == "facebook"){
                                                echo '
									                <img class="img-circle" src="'.$_SESSION["foto"].'" width="10%">
                                                    <a href="'.$url.'perfil">Ver Perfil</a> |
							                          <a href="'.$url.'salir" class="salir">Salir</a>';
                                            }
                                            if($_SESSION["modo"] == "google"){
                                                echo '
									                <img class="img-circle" src="'.$_SESSION["foto"].'" width="10%">
                                                    <a href="'.$url.'perfil">Ver Perfil</a> |
							                          <a href="'.$url.'salir">Salir</a>';
                                            }
                                            
                                        }
                                    }else{

                                        echo '<a href="#modalIngreso" data-toggle="modal">Ingresar</a> |
                                        <a href="#modalRegistro" data-toggle="modal">Registrarse</a>';
                    
                                    }
                                    ?>
                                        
                                            
                                       
                                    </div>
                                </li>
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- HEADER -->
    <header id="header2">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <p class="no-margin top-welcome">Bienvenido a Tedys Toys</p>
                </div>
                <div class="col-md-4 col-sm-4">
                    <a class="navbar-brand" href="<?php echo $url;?>"><img src="<?php echo $server;?>views/images/basic/logo.png" class="img-responsive" alt=""/></a>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="topcart pull-right">
                        <span><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;My Bag - 0 item(s)</span>
                        <div class="cart-info">
                            <small>You have <em class="highlight">3 item(s)</em> in your shopping bag</small>
                            <div class="ci-item">
                                <img src="images/products/fashion/8.jpg" width="80" alt=""/>
                                <div class="ci-item-info">
                                    <h5><a href="./single-product.html">Product fashion</a></h5>
                                    <p>2 x $250.00</p>
                                    <div class="ci-edit">
                                        <a href="#" class="edit fa fa-edit"></a>
                                        <a href="#" class="edit fa fa-trash"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="ci-item">
                                <img src="images/products/fashion/15.jpg" width="80" alt=""/>
                                <div class="ci-item-info">
                                    <h5><a href="./single-product.html">Product fashion</a></h5>
                                    <p>2 x $250.00</p>
                                    <div class="ci-edit">
                                        <a href="#" class="edit fa fa-edit"></a>
                                        <a href="#" class="edit fa fa-trash"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="ci-total">Subtotal: $750.00</div>
                            <div class="cart-btn">
                                <a href="#">View Bag</a>
                                <a href="#">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="top-search2 pull-right" id="buscador">
                        
                            <input type="text" placeholder="Buscar...">
                            						<a href="<?php echo $url; ?>buscador/1/recientes">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        
                    </div>
                    <nav class="navbar navbar-default">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <!-- Logo -->
                        </div>
                        <!-- Navmenu -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="./index.html" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-expanded="false">Home</a>
                                    <ul class="dropdown-menu submenu" role="menu">
                                        <li><a href="./index.html">Home - Style 1</a>
                                        <li><a href="./index2.html">Home - Style 2</a>
                                        <li><a href="./index3.html">Home - Style 3</a>
                                        <li><a href="./index4.html">Home - Style 4</a>
                                        <li><a href="./index5.html">Home - Style 5</a>
                                    </ul>
                                </li>
                                <li class="dropdown mmenu">
                                    <a href="./categories-grid.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Categorias</a>
                                    <ul class="mega-menu dropdown-menu" role="menu">
                                    <?php 

$item = null;
$value = null;
$categorias = ControllerProducts::ctrMostrarCategorias($item, $value);

foreach ($categorias as $key => $value) {

echo '<li>
<div>
<a href="'.$url.$value["rute"].'">
<h5>
'.$value["category"].'
</h5>
</a>
</div>
</li>';
}
?>


                                </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="./categories-grid.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Shop</a>
                                    <ul class="dropdown-menu submenu" role="menu">
                                        <li><a href="./categories-grid.html">Shop - Grid 1</a>
                                        <li><a href="./categories-list.html">Shop - Grid 2</a>
                                        <li><a href="./single-product.html">Shop - Single</a></li>
                                        <li><a href="./shoppingcart.html">Shopping Cart</a></li>
                                        <li><a href="./checkout.html">Checkout 1</a></li>
                                        <li><a href="./checkout-2.html">Checkout 2</a></li>
                                        <li><a href="./checkout-2-leftside.html">Checkout Left Sidebar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Blog</a>
                                    <ul class="dropdown-menu submenu" role="menu">
                                        <li><a href="./blog.html">Blog Posts</a>
                                        <li><a href="./blog-single.html">Blog Single</a>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Get inspired</a>
                                    <ul class="dropdown-menu submenu" role="menu">
                                        <li><a href="#">Nam ipsum est</a>
                                        <li><a href="#">Volutpat</a>
                                        <li><a href="#">In efficitur in</a></li>
                                        <li><a href="#">Accumsan eget</a></li>
                                        <li><a href="#">Odio</a></li>
                                        <li><a href="#">Curabitur</a></li>
                                        <li><a href="#">Phasellus</a></li>
                                        <li><a href="#">Dapibus elit</a></li>
                                        <li><a href="#">Nurna ullamcorper</a></li>
                                        <li><a href="#">Lobortis</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Technology</a>
                                    <ul class="dropdown-menu submenu" role="menu">
                                        <li><a href="#">Nam ipsum est</a>
                                        <li><a href="#">Volutpat</a>
                                        <li><a href="#">In efficitur in</a></li>
                                        <li><a href="#">Accumsan eget</a></li>
                                        <li><a href="#">Odio</a></li>
                                        <li><a href="#">Curabitur</a></li>
                                        <li><a href="#">Phasellus</a></li>
                                        <li><a href="#">Dapibus elit</a></li>
                                        <li><a href="#">Nurna ullamcorper</a></li>
                                        <li><a href="#">Lobortis</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Pages</a>
                                    <ul class="dropdown-menu submenu" role="menu">                                         
                                        <li><a href="contact-1.html">Contact Style 1</a></li>
                                        <li><a href="contact-2.html">Contact Style 2</a></li>
                                        <li><a href="account-information.html"> Account Information </a></li>
                                        <li><a href="my-account.html">My Account</a></li>                                        
                                        <li><a href="cng-pw.html">Change Password</a></li>
                                        <li><a href="address-book.html">Address Books</a></li>
                                        <li><a href="order-history.html">Order History</a></li>
                                        <li><a href="review-rating.html">Reviews and Ratings</a></li>
                                        <li><a href="return.html">Returns Requests</a></li>
                                        <li><a href="newsletter.html">Newsletter</a></li>
                                        <li><a href="myaccount-leftsidebar.html">Left Sidebar</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

<!-- MODAL PARA INGRESO Y REGISTRO-->
<div id="modalRegistro" class="modal fade modalFormulario" role="dialog">
  <div class="modal-content modal-dialog">

    <!-- Modal content-->
   
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">REGISTRARSE</h3>
      </div>
      <div class="modal-body ">
        <!-- REGISTRO FACEBOOK-->
        <div class="col-sm-6 col-xs-12 facebook">
        <p>
				  <i class="fa fa-facebook"></i>
					Registro con Facebook
				</p>
        </div>
        <!-- REGISTRO GOOGLE-->
        <a href="<?php echo $rutaGoogle;?>">
        <div class="col-sm-6 col-xs-12 google " id="btnGoogleRegistro">
        <p>
					  <i class="fa fa-google"></i>
						Registro con Google
					</p>
        </div>
        </a>
        <!--=====================================
			REGISTRO DIRECTO
			======================================-->

			<form method="post" onsubmit="return registroUsuario()">
				
                <hr>
    
                    <div class="form-group">
                        
                        <div class="input-group">
                            
                            <span class="input-group-addon">
                                
                                <i class="glyphicon glyphicon-user"></i>
                            
                            </span>
    
                            <input type="text" class="form-control text-uppercase" id="regUsuario" name="regUsuario" placeholder="Nombre Completo" required>
    
                        </div>
    
                    </div>
    
                    <div class="form-group">
                        
                        <div class="input-group">
                            
                            <span class="input-group-addon">
                                
                                <i class="glyphicon glyphicon-envelope"></i>
                            
                            </span>
    
                            <input type="email" class="form-control" id="regEmail" name="regEmail" placeholder="Correo Electrónico" required>
    
                        </div>
    
                    </div>
    
                    <div class="form-group">
                        
                        <div class="input-group">
                            
                            <span class="input-group-addon">
                                
                                <i class="glyphicon glyphicon-lock"></i>
                            
                            </span>
    
                            <input type="password" class="form-control" id="regPassword" name="regPassword" placeholder="Contraseña" required>
    
                        </div>
    
                    </div>
                    <div class="checkBox">
                        <label>
                            <input id="regPoliticas" type="checkbox">
                            <small>
                                Al registrarse, usted acepta nuestras condiciones de uso y politicas de privacidad. <br>
                               
                                <a href="https://www.iubenda.com/privacy-policy/78573943" class="iubenda-white iubenda-embed" title="Privacy Policy">Leer Mas</a>
                                <script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>

                         
                            </small>
                        </label>
                    </div>
                    <?php 
                        $registro = new ControladorUsuarios();
                        $registro->ctrRegistroUsuario();
                    ?>
                    <input type="submit" class="btn btn-default modal-header btn-block button-enviar" value="ENVIAR">
                    </form>
      </div>
      <div class="modal-footer">
        Ya tienes una cuenta registrada? | <strong><a href="#modalIngreso" data-dismiss="modal" data-toggle="modal"> Ingresar</a></strong>
      </div>
    

  </div> 
</div>

<!-- MODAL PARA INGRESO -->
<div id="modalIngreso" class="modal fade modalFormulario" role="dialog">
  <div class="modal-content modal-dialog">

    <!-- Modal content-->
   
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">INGRESAR</h3>
      </div>
      <div class="modal-body ">
        <!-- REGISTRO FACEBOOK-->
        <div class="col-sm-6 col-xs-12 facebook ">
        <p>
				  <i class="fa fa-facebook"></i>
					Ingreso con Facebook
				</p>
        </div>
        <!-- REGISTRO GOOGLE-->
        <a href="<?php echo $rutaGoogle;?>">
        <div class="col-sm-6 col-xs-12 google " id="btnGoogleRegistro">
        <p>
					  <i class="fa fa-google"></i>
						Ingreso con Google
					</p>
        </div>
        </a>
        <!--=====================================
			INGRESO DIRECTO
			======================================-->

			<form method="post">
				
                <hr>
    
    
                    <div class="form-group">
                        
                        <div class="input-group">
                            
                            <span class="input-group-addon">
                                
                                <i class="glyphicon glyphicon-envelope"></i>
                            
                            </span>
    
                            <input type="email" class="form-control" id="ingEmail" name="ingEmail" placeholder="Correo Electrónico" required>
    
                        </div>
    
                    </div>
    
                    <div class="form-group">
                        
                        <div class="input-group">
                            
                            <span class="input-group-addon">
                                
                                <i class="glyphicon glyphicon-lock"></i>
                            
                            </span>
    
                            <input type="password" class="form-control" id="ingPassword" name="ingPassword" placeholder="Contraseña" required>
    
                        </div>
    
                    </div>
                   
                    <?php 
                        $ingreso = new ControladorUsuarios();
                        $ingreso->ctrIngresoUsuario();
                    ?>
                    <input type="submit" class="btn btn-default modal-header btn-block button-enviar btnIngreso" value="ENVIAR">
                    <br>
                    
                    <a href="#modalPassword" data-dismiss="modal" data-toggle="modal">Olvidaste tu contraseña?</a>
                    

                    </form>
      </div>
      <div class="modal-footer">
        No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal"> Registrarse</a></strong>
      </div>
    

  </div> 
</div>

<!-- VENTANA MODAL PARA OLVIDO DE CONTRASEÑA -->

<div id="modalPassword" class="modal fade modalFormulario" role="dialog">
  <div class="modal-content modal-dialog">

    <!-- Modal content-->
   
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">SOLICITUD  DE NUEVA CONTRASEÑA</h3>

      </div>
              <!-- OLVIDO CONTRASEÑA-->
      <div class="modal-body ">

        <!--=====================================
			INGRESO DIRECTO
			======================================-->

			<form method="post">
				
                    <div class="form-group">
                        
                        <div class="input-group">
                            
                            <span class="input-group-addon">
                                
                                <i class="glyphicon glyphicon-envelope"></i>
                            
                            </span>
                            
                            <input type="email" class="form-control" id="passEmail" name="passEmail" placeholder="Correo Electrónico" required>
    
                        </div>
    
                    </div>
    
                    
                    <?php 
                        $passowrd = new ControladorUsuarios();
                        $passowrd->ctrOlvidoPassword();
                    ?>
                    <input type="submit" class="btn btn-default modal-header btn-block button-enviar " value="ENVIAR">
                    
                    </form>
      </div>
      <div class="modal-footer">
        No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal"> Registrarse</a></strong>
      </div>
    

  </div> 
</div>
<!-- SCRIPT PARA EL BUSCADOR-->
<script>
$("#buscador a").click(function(){
    if($("#buscador input").val() == ""){
        $("#buscador a").attr("href","");
    }
});

    $("#buscador input").change(function() {
    var busqueda = $("#buscador input").val();
    var expresion = /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/
    if(!expresion.test(busqueda)){
        $("#buscador input").val("");
    }else{
        var evaluarBusqueda = busqueda.replace(/[áéíóúÁÉÍÓÚ ]/g, "-");
        var rutaBuscador = $("#buscador a").attr("href");

        if($("#buscador input").val() != ""){
            $("#buscador a").attr("href",rutaBuscador+"/"+evaluarBusqueda);
        }
    }
});

//BUSCADOR CON ENTER
$("#buscador input").focus(function() {
    $(document).keyup(function(event){
        event.preventDefault();

        if(event.keyCode == 13 && $("#buscador input").val() != ""){
            var rutaBuscador = $("#buscador a").attr("href");
            window.location.href = rutaBuscador;
        } 
    });

});

</script>

