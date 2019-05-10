
<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
    <head>

        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="keywords" content="HTML5 Template" />
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Tedys Toys| Peluches</title>
    
    <!-- MANTENER LA RUTA FIJA DEL PROYECTO-->
        <?php 
            session_start();
            $server = Route::ctrRouteServer();
            $url = Route::ctrRoute();
            
        ?>
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Favicon -->
        <link rel="shortcut icon" href="/favicon.ico">

        <!-- Google Webfont -->
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,200,100,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,100,300,300italic,700,900' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

        <!-- CSS -->
        <link rel="stylesheet" href="<?php echo $url;?>views/css/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo $url;?>views/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $url;?>views/js/vendors/isotope/isotope.css">
        <link rel="stylesheet" href="<?php echo $url;?>views/js/vendors/slick/slick.css">
        <link rel="stylesheet" href="<?php echo $url;?>views/js/vendors/rs-plugin/css/settings.css">
        
        <link rel="stylesheet" href="<?php echo $url;?>views/css/subscribe-better.css">
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/ui-lightness/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo $url;?>views/plugin/owl-carousel/owl.carousel.css">
        <link rel="stylesheet" href="<?php echo $url;?>views/plugin/owl-carousel/owl.theme.css">
        <link rel="stylesheet" href="<?php echo $url;?>views/css/style.css">
        <link rel="stylesheet" href="<?php echo $url;?>views/css/plugins/sweetalert2.min.css">
        <link rel="stylesheet" href="<?php echo $url;?>views/css/plugins/perfil.css">
        <link rel="stylesheet" href="<?php echo $url;?>views/css/plugins/carrito-de-compras.css">
        <link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:900" rel="stylesheet">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="<?php echo $url;?>views/css/error404.css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                <![endif]-->
                <script src="<?php echo $url;?>views/js/jquery.js"></script>

        <!-- ADDTHIS -->
        <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-557a95e76b3e51d9" async="async"></script>
        <script type="text/javascript">
                                            // Call this function once the rest of the document is loaded
                                            function loadAddThis() {
                                                addthis.init()
                                            }
        </script>

        <script src="<?php echo $url;?>views/js/bootstrap.min.js"></script>
        <script src="<?php echo $url;?>views/plugin/owl-carousel/owl.carousel.min.js"></script>
        <script src="<?php echo $url;?>views/js/bs-navbar.js"></script>
        <script src="<?php echo $url;?>views/js/vendors/isotope/isotope.pkgd.js"></script>
        <script src="<?php echo $url;?>views/js/vendors/slick/slick.min.js"></script>
        <script src="<?php echo $url;?>views/js/vendors/tweets/tweecool.min.js"></script>
        <script src="<?php echo $url;?>views/js/vendors/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
        <script src="<?php echo $url;?>views/js/vendors/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
        <script src="<?php echo $url;?>views/js/jquery.sticky.js"></script>
        <script src="<?php echo $url;?>views/js/jquery.subscribe-better.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        
        <script src="<?php echo $url;?>views/js/main.js"></script>
        <script src="<?php echo $url;?>views/js/buscador.js"></script>
        <script src="<?php echo $url;?>views/js/plugins/sweetalert2.min.js"></script>
        
        
    </head>
    <body id="home4">

    <input type="hidden" value="<?php echo $url;?>" id="rutaOculta">

        <?php 
            include "moduls/head.php";
            $routes = array();
            $ruta = null;
            $infoProduct = null;
            if(isset($_GET["ruta"])){
                $routes = explode("/",$_GET["ruta"]);

                $item = "rute";
                $item2 = "ruta";

                $value = $routes[0];

                //URL'S AMIGABLES DE CATEGORIAS

                $routeCat = ControllerProducts::ctrMostrarCategorias($item, $value);

                if($value == $routeCat["rute"]){

                    $ruta = $value;
                }

                //URL'S AMIGABLES DE PRODUCTOS
                $rutaProductos = ControllerProducts::ctrMostrarInfoProduct($item2,$value);

                if($routes[0] == $rutaProductos["ruta"]){
                    $infoProduct = $routes[0];
                }

                //LISTA BLANCA DE URL'S AMIGABLES
                if($ruta != null || $routes[0] == "lo-mas-vendido" || $routes[0] == "lo-mas-visto"){
                    include "moduls/products.php";
                }
                else if($infoProduct != null){
                    include "moduls/infoproduct.php";
                }
                else if($routes[0] == "buscador" || $routes[0] == "verificar" || $routes[0] == "salir" || $routes[0] == "perfil" || $routes[0] == "carrito-de-compras"){
                    include "moduls/".$routes[0].".php";
                }
                else{
                    include "moduls/error404.php";
                }
            }else{
                include "moduls/slide.php";
                include "moduls/featuredProducts.php";
            }
        ?>
        <script src="<?php echo $url;?>views/js/ajax/usuarios.js"></script>
        <script src="<?php echo $url;?>views/js/ajax/registroFacebook.js"></script>
        <script src="<?php echo $url;?>views/js/ajax/carrito-de-compras.js"></script>
        <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '650275259131900',
      cookie     : true,
      xfbml      : true,
      version    : 'v3.3'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

    </body>
</html>

