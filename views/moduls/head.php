<?php 
$url = Route::ctrRoute();
$server = Route::ctrRouteServer();

/*=============================================
INICIO DE SESIÓN USUARIO
=============================================*/

if(isset($_SESSION["validarSesion"])){

	if($_SESSION["validarSesion"] == "ok"){

		echo '<script>
		
			localStorage.setItem("usuario","'.$_SESSION["id"].'");

		</script>';

	}

}

/*=============================================
API DE GOOGLE
=============================================*/

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
                   "tipo"=>"Minorista",
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

    <!--=====================================
TOP
======================================-->

<div class="container-fluid barraSuperior" id="top">
	
	<div class="container">
		
		<div class="row">
	
			<!--=====================================
			SOCIAL
			======================================-->

			<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 social">
				
				<ul>	
                <li><i class="fa fa-phone"></i> Telefono: <a href="#">(+800) 2307 2509 8988</a></li> |
                                <li><i class="fa fa-envelope-o"></i> <a href="#">contacto@tedystoys.com</a></li>

				</ul>

			</div>

			<!--=====================================
			REGISTRO
			======================================-->

			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 registro">
				
				<ul>

				<?php

				if(isset($_SESSION["validarSesion"])){

					if($_SESSION["validarSesion"] == "ok"){

						if($_SESSION["modo"] == "directo"){

							if($_SESSION["foto"] != ""){

								echo '<li>

										<img class="img-circle" src="'.$url.$_SESSION["foto"].'" width="10%">

									 </li>';

							}else{

								echo '<li>

									<img class="img-circle" src="'.$server.'views/images/usuarios/default/anonymous.png" width="10%">

								</li>';

							}

							echo '<li>|</li>
							 <li><a href="'.$url.'perfil">Ver Perfil</a></li>
							 <li>|</li>
							 <li><a href="'.$url.'salir">Salir</a></li>';


						}

						if($_SESSION["modo"] == "facebook"){

							echo '<li>

									<img class="img-circle" src="'.$_SESSION["foto"].'" width="10%">

								   </li>
								   <li>|</li>
						 		   <li><a href="'.$url.'perfil">Ver Perfil</a></li>
						 		   <li>|</li>
						 		   <li><a href="'.$url.'salir" class="salir">Salir</a></li>';

						}

						if($_SESSION["modo"] == "google"){

							echo '<li>

									<img class="img-circle" src="'.$_SESSION["foto"].'" width="10%">

								   </li>
								   <li>|</li>
						 		   <li><a href="'.$url.'perfil">Ver Perfil</a></li>
						 		   <li>|</li>
						 		   <li><a href="'.$url.'salir">Salir</a></li>';

						}

					}

				}else{

					echo '<li><a href="#modalIngreso" data-toggle="modal">Ingresar</a></li>
						  <li>|</li>
						  <li><a href="#modalRegistro" data-toggle="modal">Crear una cuenta</a></li>';

				}

				?>
	
				</ul>

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
                    <a class="navbar-brand" href="<?php echo $url;?>"><img src="<?php echo $url;?>views/images/basic/marca.png" class="img-responsive" alt=""/></a>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="topcart pull-right">
                        <a href="<?php echo $url;?>carrito-de-compras">
                        <i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Mi carrito - <span class="cantidadCesta"></span> item(s)
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="top-search2 pull-right" id="buscador">
                        
                            <input type="text" placeholder="Buscar...">
                            						<a class="enlacebuscador" href="<?php echo $url; ?>buscador/1/recientes">
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
                                    <a href="<?php echo $url;?>">Inicio</a>
                                                                        
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
                                <?php 
                                    echo ' <a href="'.$url.'blog">BLOG</a>';
                                    ?>
                                </li>
                                <li class="dropdown">
                                <?php 
                                    echo ' <a href="'.$url.'nosotros">NOSOTROS</a>';
                                    ?>
                                </li>
                                <li class="dropdown">
                                <?php 
                                    echo ' <a href="'.$url.'comprometidos">COMPROMETIDOS</a>';
                                    ?>
                                </li>
                                <li class="dropdown">
                                    <?php 
                                    echo ' <a href="'.$url.'contacto">CONTACTO</a>';
                                    ?>
                                   
                                   
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
                    <div class="form-group">
                    <label for="tipousuario">Tipo de cliente</label>
                    <select name="tipousuario" id="tipousuario" class="form-control">
                    <option value="Minorista">Minorista</option>
                    <option value="Mayorista">Mayorista</option>
                    </select>
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

