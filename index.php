<?php

require_once "controllers/template.controller.php";
require_once "controllers/products.controller.php";
require_once "controllers/slide.controller.php";
require_once "controllers/usuarios.controller.php";
require_once "controllers/carrito.controlador.php";
require_once "controllers/facturas.controller.php";


require_once "models/plantilla.modelo.php";
require_once "models/products.model.php";
require_once "models/slide.model.php";
require_once "models/usuarios.model.php";
require_once "models/carrito.modelo.php";
require_once "models/facturas.model.php";



require_once "models/routes.php";

require_once "extensiones/PHPMailer/PHPMailerAutoload.php";
require_once "extensiones/vendor/autoload.php";


$template= new controllerTemplate();
$template->template();

?>