/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
VISUALIZAR LA CESTA DEL CARRITO DE COMPRAS
=============================================*/
if(localStorage.getItem("cantidadCesta") != null){
    $(".cantidadCesta").html(localStorage.getItem("cantidadCesta"));
}else{
$(".cantidadCesta").html("0");
}
/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
VISUALIZAR LOS PRODUCTOS EN LA PAGINA CARRITO DE COMPRAS
=============================================*/
var rutaOculta = "";
if(localStorage.getItem("listaProductos") != null){
    var listaCarrito = JSON.parse(localStorage.getItem("listaProductos"));

    listaCarrito.forEach(funcionForEach);

    function funcionForEach(item,index){
        $(".cuerpoCarrito").append('<tr>'+
        '<td><button class="btn btn-danger quitarItemCarrito" idProducto="'+item.idProducto+'" peso="'+item.peso+'">'+
        '<i class="fa fa-times"></i>'+
        '</button></td>'+
        '<td><img src="'+item.imagen+'" class="img-responsive" alt=""/></td>'+
        '<td>'+
            '<h4 class="tituloCarritoCompra"><a href="./single-product.html">'+item.titulo+'</a></h4>'+
        '</td>'+
        '<td class="col-xs-1">'+
        '<input type="number" class="form-control cantidadItem" min="1" value="'+item.cantidad+'" tipo="'+item.tipo+'" precio="'+item.precio+'" idProducto="'+item.idProducto+'" item="'+index+'">'+
        '</td>'+
        '<td>'+
            '<div class="item-price precioCarritoCompra">$ <span>'+item.precio+'</span></div>'+
        '</td>'+
        '<td>'+
            '<div class="item-price subTotal'+item.idProducto+'"><strong>$ <span>'+item.precio+'</span></strong></div>'+
        '</td>'+
    '</tr>')
    }
}else{
    $(".cuerpoCarrito").html('<div class="well">Aún no hay productos en el carrito de compras.</div>');
    $(".cabeceraCheckout").hide();

}
/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
AGREGAR AL CARRITO
=============================================*/
$(".agregarCarrito").click(function(){
	var idProducto = $(this).attr("idProducto");
	var imagen = $(this).attr("imagen");
	var titulo = $(this).attr("titulo");
	var precio = $(this).attr("precio");
    var peso = $(this).attr("peso");
    rutaOculta = $("#rutaOculta").val();
    console.log(rutaOculta);
    
    
    var agregarAlCarrito = true;

   /*=============================================
	ALMACENAR EN EL LOCALSTARGE LOS PRODUCTOS AGREGADOS AL CARRITO
	=============================================*/

	if(agregarAlCarrito){

		/*=============================================
		RECUPERAR ALMACENAMIENTO DEL LOCALSTORAGE
		=============================================*/

		if(localStorage.getItem("listaProductos") == null){

			listaCarrito = [];

		}else{

            listaCarrito.concat(localStorage.getItem("listaProductos"));
            console.log("listaCarrito",listaCarrito);

		}

		listaCarrito.push({"idProducto":idProducto,
						   "imagen":imagen,
						   "titulo":titulo,
						   "precio":precio,
				           "peso":peso,
                           "cantidad":"1"});
                           
                           console.log("listaCarrito",listaCarrito);

        localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));
        /*=============================================
		ACTUALIZAR LA CESTA
		=============================================*/

		var cantidadCesta = Number($(".cantidadCesta").html()) + 1;
		$(".cantidadCesta").html(cantidadCesta);
		localStorage.setItem("cantidadCesta", cantidadCesta);
		

        /*=============================================
		MOSTRAR ALERTA DE QUE EL PRODUCTO YA FUE AGREGADO
		=============================================*/
        
		swal({
            title: "",
            text: "¡Se ha agregado un nuevo producto al carrito de compras!",
            type: "success",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: '¡Continuar comprando!',
            confirmButtonText: '¡Ir a mi carrito de compras!',
            closeOnConfirm: false
          },
          function(isConfirm){
              if (isConfirm) {	   
                   window.location = rutaOculta+'carrito-de-compras';
              } 
      });
    }
        
})
/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
QUITAR PRODUCTOS DEL CARRITO
=============================================*/

$(document).on("click", ".quitarItemCarrito", function(){

	$(this).parent().parent().remove();

	var idProducto = $(".cuerpoCarrito button");
	var imagen = $(".cuerpoCarrito img");
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
	var precio = $(".cuerpoCarrito .precioCarritoCompra span");
    var cantidad = $(".cuerpoCarrito .cantidadItem");
    console.log(precio);

	/*=============================================
	SI AÚN QUEDAN PRODUCTOS VOLVERLOS AGREGAR AL CARRITO (LOCALSTORAGE)
	=============================================*/

	listaCarrito = [];

	if(idProducto.length != 0){

		for(var i = 0; i < idProducto.length; i++){

			var idProductoArray = $(idProducto[i]).attr("idProducto");
			var imagenArray = $(imagen[i]).attr("src");
			var tituloArray = $(titulo[i]).html();
            var precioArray = $(precio[i]).html();
			var pesoArray = $(idProducto[i]).attr("peso");
			var cantidadArray = $(cantidad[i]).val();

			listaCarrito.push({"idProducto":idProductoArray,
						   "imagen":imagenArray,
						   "titulo":tituloArray,
						   "precio":precioArray,
					       
				           "peso":pesoArray,
				           "cantidad":cantidadArray});

		}

		localStorage.setItem("listaProductos",JSON.stringify(listaCarrito));

		


	}else{

		/*=============================================
		SI YA NO QUEDAN PRODUCTOS HAY QUE REMOVER TODO
		=============================================*/	

		localStorage.removeItem("listaProductos");

		localStorage.setItem("cantidadCesta","0");
		
		

		$(".cantidadCesta").html("0");
		

		$(".cuerpoCarrito").html('<div class="well">Aún no hay productos en el carrito de compras.</div>');
		$(".cabeceraCheckout").hide();

}

})

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
GENERAR SUBTOTAL DESPUES DE CAMBIAR CANTIDAD
=============================================*/
$(document).on("change", ".cantidadItem", function(){

	var cantidad = $(this).val();
	var precio = $(this).attr("precio");
	var idProducto = $(this).attr("idProducto");
	var item = $(this).attr("item");

	$(".subTotal"+idProducto).html('<strong>$ <span>'+(cantidad*precio)+'</span></strong>');

	/*=============================================
	ACTUALIZAR LA CANTIDAD EN EL LOCALSTORAGE
	=============================================*/

	var idProducto = $(".cuerpoCarrito button");
	var imagen = $(".cuerpoCarrito img");
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
	var precio = $(".cuerpoCarrito .precioCarritoCompra span");
	var cantidad = $(".cuerpoCarrito .cantidadItem");

	listaCarrito = [];

	for(var i = 0; i < idProducto.length; i++){

			var idProductoArray = $(idProducto[i]).attr("idProducto");
			var imagenArray = $(imagen[i]).attr("src");
			var tituloArray = $(titulo[i]).html();
			var precioArray = $(precio[i]).html();
			var pesoArray = $(idProducto[i]).attr("peso");
		
			var cantidadArray = $(cantidad[i]).val();

			listaCarrito.push({"idProducto":idProductoArray,
						   "imagen":imagenArray,
						   "titulo":tituloArray,
						   "precio":precioArray,
				           "peso":pesoArray,
				           "cantidad":cantidadArray});

		}

		localStorage.setItem("listaProductos",JSON.stringify(listaCarrito));

})  

// /*=============================================
// /*=============================================
// /*=============================================
// /*=============================================
// /*=============================================
// ACTUALIZAR SUBTOTAL
// =============================================*/
var precioCarritoCompra = $(".cuerpoCarrito .precioCarritoCompra span");
var cantidadItem = $(".cuerpoCarrito .cantidadItem");

for(var i=0; i<precioCarritoCompra.length; i++){
    var precioCarritoCompraArray = $(precioCarritoCompra[i]).html();
    var cantidadItemArray = $(cantidadItem[i]).html();
    var idProductoArray = $(cantidadItem[i].attr("idProducto"));

    $(".subTotal"+idProductoArray).html('<strong>$ <span>'+(precioCarritoCompraArray*cantidadItemArray)+'</span></strong>');
}