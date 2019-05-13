<?php

$url = Route::ctrRoute();

if(!isset($_SESSION["validarSesion"])){

	echo '<script>window.location = "'.$url.'";</script>';

	exit();

}
#requerimos las credenciales de paypal
require 'extensiones/bootstrap.php';
require_once "models/carrito.modelo.php";

#importamos librería del SDK
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

/*=============================================
PAGO PAYPAL
=============================================*/

#evaluamos si la compra está aprobada
if(isset( $_GET['paypal']) && $_GET['paypal'] === 'true'){

   #recibo los productos comprados
   $productos = explode("-", $_GET['productos']);
   $cantidad = explode("-", $_GET['cantidad']);
   $pago = explode("-", $_GET['pago']);

   #capturamos el Id del pago que arroja Paypal
   $paymentId = $_GET['paymentId'];

   #Creamos un objeto de Payment para confirmar que las credenciales si tengan el Id de pago resuelto
   $payment = Payment::get($paymentId, $apiContext);

   #creamos la ejecución de pago, invocando la clase PaymentExecution() y extraemos el id del pagador
   $execution = new PaymentExecution();
   $execution->setPayerId($_GET['PayerID']);

   #validamos con las credenciales que el id del pagador si coincida
   $payment->execute($execution, $apiContext);
   $datosTransaccion = $payment->toJSON();

   $datosUsuario = json_decode($datosTransaccion);

   $emailComprador = $datosUsuario->payer->payer_info->email;
   $dir = $datosUsuario->payer->payer_info->shipping_address->line1;
   $ciudad = $datosUsuario->payer->payer_info->shipping_address->city;
   $estado = $datosUsuario->payer->payer_info->shipping_address->state;
   $codigoPostal = $datosUsuario->payer->payer_info->shipping_address->postal_code;
   $pais = $datosUsuario->payer->payer_info->shipping_address->country_code;

   $direccion = $dir.", ".$ciudad.", ".$estado.", ".$codigoPostal;
           
   #Actualizamos la base de datos
   for($i = 0; $i < count($productos); $i++){

           $datos = array("idUsuario"=>$_SESSION["id"],
                           "idProducto"=>$productos[$i],
                           "metodo"=>"paypal",
                           "email"=>$emailComprador,
                           "direccion"=>$direccion,
                           "pais"=>$pais,
                           "pago"=>$pago[$i]);

           $respuesta = ControladorCarrito::ctrNuevasCompras($datos);

           $ordenar = "id_product";
           $item = "id_product";
           $valor = $productos[$i];

           $productosCompra = ControllerProducts::ctrListarProductos($ordenar, $item, $valor);

           foreach ($productosCompra as $key => $value) {

               $item1 = "ventas";
               $valor1 = $value["ventas"] + $cantidad[$i];
               $item2 = "id_product";
               $valor2 =$value["id_product"];

               $actualizarCompra = ControllerProducts::ctrActualizarProducto($item1, $valor1, $item2, $valor2);
            
        }

        if($respuesta == "ok" && $actualizarCompra == "ok"){

            echo '<script>

             localStorage.removeItem("listaProductos");
             localStorage.removeItem("cantidadCesta");
             localStorage.removeItem("sumaCesta");
             window.location = "'.$url.'perfil";

            </script>';

        }

}
}
