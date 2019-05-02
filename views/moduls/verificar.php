<!-- VERIFICAR -->
<?php 

$item = "emailEncriptado";
$valor = $routes[1];
$respuesta = ControladorUsuarios::ctrMostrarUsuario($item,$valor);

$id = $respuesta["id"];
$item2 = "verificacion";
$valor2 = 0;
$respuesta2 = ControladorUsuarios::ctrActualizarUsuario($id,$item2,$valor2);

var_dump($respuesta2);

$usuarioVerificado = false;

if($respuesta2 == "ok"){
    $usuarioVerificado = true;
}

?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 text-center verificar">

            <?php 
            
if($usuarioVerificado){
    echo '<h3>GRACIAS</h3>
    <h2>Hemos verificado su correo electronico, ya puede ingresar al sistema</h2>
    <br>
    <center><a href="#modalIngreso" class="tp-caption lft skewtoleftshort rs-parallaxlevel-9"
        
        style="z-index: 3; max-height:100%;line-height:43px;color:#fff;font-family: Montserrat;
        font-size: 12px;
        display:table;
        
        margin-left:15px;
        font-weight: bold;
        text-transform:uppercase;padding:0 40px;background:#000000;position:relative;z-index:77;">
         INGRESAR >
    <center>';
}
else{
    echo '<h3>ERROR!</h3>
    <h2><small>No se ha podido verificar el correo electronico, por favor vuelva a registrarse</small></h2>
    <br>
    <a href="#modalRegistro" class="tp-caption lft skewtoleftshort rs-parallaxlevel-9"
        
        style="z-index: 3; max-height:100%;line-height:43px;color:#fff;font-family: Montserrat;
        font-size: 12px;
        display:table;
        
        margin-left:15px;
        font-weight: bold;
        text-transform:uppercase;padding:0 40px;background:#000000;position:relative;z-index:77;">
         REGISTRAR >
    ';
}
            ?>
        </div>
    </div>
</div>