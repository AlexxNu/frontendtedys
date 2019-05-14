/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
VISUALIZAR LA CESTA DEL CARRITO DE COMPRAS
=============================================*/
if (localStorage.getItem("cantidadCesta") != null) {
    $(".cantidadCesta").html(localStorage.getItem("cantidadCesta"));
} else {
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
var rutaOcult = $("#rutaOculta").val();
if (localStorage.getItem("listaProductos") != null) {
    var listaCarrito = JSON.parse(localStorage.getItem("listaProductos"));

    listaCarrito.forEach(funcionForEach);

    function funcionForEach(item, index) {
        var datosProducto = new FormData();
        var precio = 0;

        datosProducto.append("id", item.idProducto);

        $.ajax({

            url: rutaOcult + "ajax/producto.ajax.php",
            method: "POST",
            data: datosProducto,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {
                if (respuesta["precioOferta"] == 0) {

                    precio = respuesta["precio"];

                } else {

                    precio = respuesta["precioOferta"];

                }
                $(".cuerpoCarrito").append(

                    '<div clas="row itemCarrito">' +

                    '<div class="col-sm-1 col-xs-12">' +

                    '<br>' +

                    '<center>' +

                    '<button class="btn btn-danger quitarItemCarrito" idProducto="' + item.idProducto + '" peso="' + item.peso + '">' +

                    '<i class="fa fa-times"></i>' +

                    '</button>' +

                    '</center>' +

                    '</div>' +
                    '<div class="col-sm-1 col-xs-12">' +

                    '<figure>' +

                    '<img src="' + item.imagen + '" class="img-thumbnail">' +

                    '</figure>' +

                    '</div>' +

                    '<div class="col-sm-4 col-xs-12">' +

                    '<br>' +

                    '<p class="tituloCarritoCompra text-left">' + item.titulo + '</p>' +

                    '</div>' +

                    '<div class="col-md-2 col-sm-1 col-xs-12">' +

                    '<br>' +

                    '<p class="precioCarritoCompra text-center">MXN $<span>' + precio + '</span></p>' +

                    '</div>' +

                    '<div class="col-md-2 col-sm-3 col-xs-8">' +

                    '<br>' +

                    '<div class="col-xs-8">' +

                    '<center>' +

                    '<input type="number" class="form-control cantidadItem" min="1" value="' + item.cantidad + '" precio="' + item.precio + '" idProducto="' + item.idProducto + '" item="' + index + '">' +

                    '</center>' +

                    '</div>' +

                    '</div>' +

                    '<div class="col-md-2 col-sm-1 col-xs-4 text-center">' +

                    '<br>' +

                    '<p class="subTotal' + index + ' subtotales">' +

                    '<strong>MXN $<span>' + (Number(item.cantidad) * Number(precio)) + '</span></strong>' +

                    '</p>' +

                    '</div>' +

                    '</div>' +

                    '<div class="clearfix"></div>' +

                    '<hr>');
                // /*=============================================
                // /*=============================================
                // /*=============================================
                // /*=============================================
                // /*=============================================
                // ACTUALIZAR SUBTOTAL
                // =============================================*/

                var precioCarritoCompra = $(".cuerpoCarrito .precioCarritoCompra span");

                sumaSubtotales();
                cestaCarrito(precioCarritoCompra.length);

            }

        })


    }

} else {
    $(".cuerpoCarrito").html('<div class="well">Aún no hay productos en el carrito de compras.</div>');
    $(".sumaCarrito").hide();
    $(".cabeceraCheckout").hide();
}
/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
AGREGAR AL CARRITO
=============================================*/
$(".agregarCarrito").click(function() {
        var idProducto = $(this).attr("idProducto");
        var imagen = $(this).attr("imagen");
        var titulo = $(this).attr("titulo");
        var precio = $(this).attr("precio");
        var peso = $(this).attr("peso");
        rutaOculta = $("#rutaOculta").val();
        
        var agregarAlCarrito = true;

        /*=============================================
	ALMACENAR EN EL LOCALSTARGE LOS PRODUCTOS AGREGADOS AL CARRITO
	=============================================*/

        if (agregarAlCarrito) {

            /*=============================================
            RECUPERAR ALMACENAMIENTO DEL LOCALSTORAGE
            =============================================*/

            if (localStorage.getItem("listaProductos") == null) {

                listaCarrito = [];

            } else {

                var listaProductos = JSON.parse(localStorage.getItem("listaProductos"));

                for (var i = 0; i < listaProductos.length; i++) {
                    if (listaProductos[i]["idProducto"] == idProducto) {
                        swal({
                            title: "El producto ya está agregado al carrito de compras",
                            text: "",
                            type: "warning",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "¡Volver!",
                            closeOnConfirm: false
                        })
                        return;
                    }
                }

                listaCarrito.concat(localStorage.getItem("listaProductos"));


            }

            listaCarrito.push({
                "idProducto": idProducto,
                "imagen": imagen,
                "titulo": titulo,
                "precio": precio,
                "peso": peso,
                "cantidad": "1"
            });

           

            localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));

            /*=============================================
            ACTUALIZAR CESTA
            =============================================*/
            var cantidadCesta = Number($(".cantidadCesta").html()) + 1;
            $(".cantidadCesta").html(cantidadCesta);


            localStorage.setItem("cantidadCesta", cantidadCesta);


            /*=============================================
            MOSTRAR ALERTA DE QUE EL PRODUCTO YA FUE AGREGADO
            =============================================*/

            Swal.fire({
                title: "",
                text: "¡Se ha agregado un nuevo producto al carrito de compras!",
                type: "success",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#37A82D',
                cancelButtonText: "¡Continuar comprando!",
                confirmButtonText: "¡Ir a mi carrito de compras!"
              }).then((result) => {
                if (result.value) {
                    window.location = rutaOculta + "carrito-de-compras";
                }
              })
        }


    })
    /*=============================================
    /*=============================================
    /*=============================================
    /*=============================================
    /*=============================================
    QUITAR PRODUCTOS DEL CARRITO
    =============================================*/
$(document).on("click", ".quitarItemCarrito", function() {
    $(this).parent().parent().parent().remove();

    var idProducto = $(".cuerpoCarrito button");
    var imagen = $(".cuerpoCarrito img");
    var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
    var precio = $(".cuerpoCarrito .precioCarritoCompra span");
    var cantidad = $(".cuerpoCarrito .cantidadItem");

    /*=============================================
    SI AÚN QUEDAN PRODUCTOS VOLVERLOS AGREGAR AL CARRITO (LOCALSTORAGE)
    =============================================*/

    listaCarrito = [];

    if (idProducto.length != 0) {

        for (var i = 0; i < idProducto.length; i++) {

            var idProductoArray = $(idProducto[i]).attr("idProducto");
            var imagenArray = $(imagen[i]).attr("src");
            var tituloArray = $(titulo[i]).html();
            var precioArray = $(precio[i]).html();
            var pesoArray = $(idProducto[i]).attr("peso");
            var cantidadArray = $(cantidad[i]).val();

            listaCarrito.push({
                "idProducto": idProductoArray,
                "imagen": imagenArray,
                "titulo": tituloArray,
                "precio": precioArray,
                "peso": pesoArray,
                "cantidad": cantidadArray
            });

        }

        localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));

        sumaSubtotales();
        cestaCarrito(listaCarrito.length);

    } else {

        /*=============================================
        SI YA NO QUEDAN PRODUCTOS HAY QUE REMOVER TODO
        =============================================*/

        localStorage.removeItem("listaProductos");
        localStorage.setItem("cantidadCesta", "0");
        $(".cantidadCesta").html("0");
        $(".cuerpoCarrito").html('<div class="well">Aún no hay productos en el carrito de compras.</div>');
        $(".sumaCarrito").hide();
        $(".cabeceraCheckout").hide();

    }
});
/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
GENERAR SUBTOTAL DESPUES DE CAMBIAR CANTIDAD
=============================================*/
$(document).on("change", ".cantidadItem", function() {
    var cantidad = $(this).val();
    var precio = $(this).attr("precio");
    var idProducto = $(this).attr("idProducto");
    var item = $(this).attr("item");

    $(".subTotal" + item).html('<strong>MXN $<span>' + (cantidad * precio) + '</span></strong>');
    /*=============================================
    ACTUALIZAR LA CANTIDAD EN EL LOCALSTORAGE
    =============================================*/

    var idProducto = $(".cuerpoCarrito button");
    var imagen = $(".cuerpoCarrito img");
    var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
    var precio = $(".cuerpoCarrito .precioCarritoCompra span");
    var cantidad = $(".cuerpoCarrito .cantidadItem");

    listaCarrito = [];

    for (var i = 0; i < idProducto.length; i++) {

        var idProductoArray = $(idProducto[i]).attr("idProducto");
        var imagenArray = $(imagen[i]).attr("src");
        var tituloArray = $(titulo[i]).html();
        var precioArray = $(precio[i]).html();
        var pesoArray = $(idProducto[i]).attr("peso");

        var cantidadArray = $(cantidad[i]).val();

        listaCarrito.push({
            "idProducto": idProductoArray,
            "imagen": imagenArray,
            "titulo": tituloArray,
            "precio": precioArray,
            "peso": pesoArray,
            "cantidad": cantidadArray
        });

    }

    localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));

    sumaSubtotales();
    cestaCarrito(listaCarrito.length);
})


/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
SUMA DE TODOS LOS SUBTOTALES
=============================================*/

function sumaSubtotales() {

    var subtotales = $(".subtotales span");
    var arraySumaSubtotales = [];

    for (var i = 0; i < subtotales.length; i++) {

        var subtotalesArray = $(subtotales[i]).html();
        arraySumaSubtotales.push(Number(subtotalesArray));

    }

    function sumaArraySubtotales(total, numero) {

        return total + numero;

    }

    var sumaTotal = arraySumaSubtotales.reduce(sumaArraySubtotales);

    $(".sumaSubTotal").html('<strong>MXN $<span>' + (sumaTotal).toFixed(2) + '</span></strong>');
}

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
ACTUALIZAR CESTA AL CAMBIAR CANTIDAD
=============================================*/
function cestaCarrito(cantidadProductos) {

    /*=============================================
    SI HAY PRODUCTOS EN EL CARRITO
    =============================================*/

    if (cantidadProductos != 0) {

        var cantidadItem = $(".cuerpoCarrito .cantidadItem");

        var arraySumaCantidades = [];

        for (var i = 0; i < cantidadItem.length; i++) {

            var cantidadItemArray = $(cantidadItem[i]).val();
            arraySumaCantidades.push(Number(cantidadItemArray));

        }

        function sumaArrayCantidades(total, numero) {

            return total + numero;

        }

        var sumaTotalCantidades = arraySumaCantidades.reduce(sumaArrayCantidades);

        $(".cantidadCesta").html(sumaTotalCantidades);
        localStorage.setItem("cantidadCesta", sumaTotalCantidades);

    }

}
/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
CHECKOUT
=============================================*/

$("#btnCheckout").click(function() {

        $(".listaProductos table.tablaProductos tbody").html("");

        $("#checkPaypal").prop("checked", true);
        $("#checkPayu").prop("checked", false);

        var idUsuario = $(this).attr("idUsuario");
        var peso = $(".cuerpoCarrito button, .comprarAhora button");
        var titulo = $(".cuerpoCarrito .tituloCarritoCompra, .comprarAhora .tituloCarritoCompra");
        var cantidad = $(".cuerpoCarrito .cantidadItem, .comprarAhora .cantidadItem");
        var subtotal = $(".cuerpoCarrito .subtotales span, .comprarAhora .subtotales span");
        var tipoArray = [];
        var cantidadPeso = [];


        /*=============================================
        SUMA SUBTOTAL
        =============================================*/

        var sumaSubTotal = $(".sumaSubTotal span")

        $(".valorSubtotal").html($(sumaSubTotal).html());
        $(".valorSubtotal").attr("valor", $(sumaSubTotal).html());

        /*=============================================
				TASAS DE IMPUESTO
				=============================================*/

        var impuestoTotal = ($(".valorSubtotal").html() * $("#tasaImpuesto").val()) / 100;

        $(".valorTotalImpuesto").html((impuestoTotal).toFixed(2));
        $(".valorTotalImpuesto").attr("valor", (impuestoTotal).toFixed(2));

        sumaTotalCompra()

        /*=============================================
				VARIABLES ARRAY
				=============================================*/

        for (var i = 0; i < titulo.length; i++) {

            var pesoArray = $(peso[i]).attr("peso");
            
            var tituloArray = $(titulo[i]).html();
            var cantidadArray = $(cantidad[i]).val();
            var subtotalArray = $(subtotal[i]).html();

            /*=============================================
            EVALUAR PESO DE ACUERDO A LA CANTIDAD DE PRODUCTOS
            =============================================*/
            cantidadPeso[i] = pesoArray * cantidadArray;

            function sumaArrayPeso(total, numero) {
                return total + numero;
            }
            var sumaTotalPeso = cantidadPeso.reduce(sumaArrayPeso);

            /*=============================================
            MOSTRAR PRODUCTOS DEFINITIVOS A COMPRAR
            =============================================*/

            $(".listaProductos table.tablaProductos tbody").append('<tr>' +
                '<td class="valorTitulo">' + tituloArray + '</td>' +
                '<td class="valorCantidad">' + cantidadArray + '</td>' +
                '<td>$<span class="valorItem" valor="' + subtotalArray + '">' + subtotalArray + '</span></td>' +
                '<tr>');

            /*=============================================
            SELECCIONAR PAÍS DE ENVÍO SI HAY PRODUCTOS FÍSICOS
					=============================================*/
        }
        $(".seleccionePais").html('<select class="form-control" id="seleccionarPais" required>' +

            '<option value="">Seleccione el país</option>' +

            '</select>');

        $.ajax({
            url: rutaOculta + "views/js/plugins/countries.json",
            type: "GET",
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {

                respuesta.forEach(seleccionarPais);

                function seleccionarPais(item, index) {

                    var pais = item.name;
                    var codPais = item.code;

                    $("#seleccionarPais").append('<option value="' + codPais + '">' + pais + '</option>');

                }

            }
        })

        /*=============================================
        EVALUAR TASAS DE ENVÍO SI EL PRODUCTO ES FÍSICO
        =============================================*/
        $("#seleccionarPais").change(function() {

            $(".alert").remove();



            var pais = $(this).val();
            var tasaPais = $("#tasaPais").val();

            if (pais == tasaPais) {

                var resultadoPeso = sumaTotalPeso * $("#envioNacional").val();

                if (resultadoPeso < $("#tasaMinimaNal").val()) {

                    $(".valorTotalEnvio").html($("#tasaMinimaNal").val());
                    $(".valorTotalEnvio").attr("valor", $("#tasaMinimaNal").val());

                } else {

                    $(".valorTotalEnvio").html(resultadoPeso);
                    $(".valorTotalEnvio").attr("valor", resultadoPeso);
                }

            } else {

                var resultadoPeso = sumaTotalPeso * $("#envioInternacional").val();

                if (resultadoPeso < $("#tasaMinimaInt").val()) {

                    $(".valorTotalEnvio").html($("#tasaMinimaInt").val());
                    $(".valorTotalEnvio").attr("valor", $("#tasaMinimaInt").val());

                } else {

                    $(".valorTotalEnvio").html(resultadoPeso);
                    $(".valorTotalEnvio").attr("valor", resultadoPeso);
                }

            }
            /*=============================================
            		RETORNAR EL CAMBIO DE DIVISA A DOLAR
            		=============================================*/
            $("#cambiarDivisa").val("MXN");

            $(".cambioDivisa").html("MXN");

            $(".valorSubtotal").html((1 * Number($(".valorSubtotal").attr("valor"))).toFixed(2))
            $(".valorTotalEnvio").html((1 * Number($(".valorTotalEnvio").attr("valor"))).toFixed(2))
            $(".valorTotalImpuesto").html((1 * Number($(".valorTotalImpuesto").attr("valor"))).toFixed(2))
            $(".valorTotalCompra").html((1 * Number($(".valorTotalCompra").attr("valor"))).toFixed(2))

            var valorItem = $(".valorItem");

            for (var i = 0; i < valorItem.length; i++) {
                $(valorItem[i]).html((1 * Number($(valorItem[i]).attr("valor"))).toFixed(2))
            }

            sumaTotalCompra()

        })
    })
    /*=============================================
    /*=============================================
    /*=============================================
    /*=============================================
    /*=============================================
    SUMA TOTAL DE LA COMPRA
    =============================================*/
function sumaTotalCompra() {

    var sumaTotalTasas = Number($(".valorSubtotal").html()) +
        Number($(".valorTotalEnvio").html()) +
        Number($(".valorTotalImpuesto").html());


    $(".valorTotalCompra").html((sumaTotalTasas).toFixed(2));
    $(".valorTotalCompra").attr("valor", (sumaTotalTasas).toFixed(2));

    localStorage.setItem("total", hex_md5($(".valorTotalCompra").html()));

}
/*=============================================
/*=============================================
/*=============================================
/*=============================================
MÉTODO DE PAGO PARA CAMBIO DE DIVISA
=============================================*/

var metodoPago = "paypal";
divisas(metodoPago);


$("input[name='pago']").change(function() {

    var metodoPago = $(this).val();

    divisas(metodoPago);

})

/*=============================================
/*=============================================
/*=============================================
/*=============================================
FUNCIÓN PARA EL CAMBIO DE DIVISA
=============================================*/

function divisas(metodoPago) {

    $("#cambiarDivisa").html("");

    if (metodoPago == "paypal") {

        $("#cambiarDivisa").append('<option value="MXN">MXN</option>' +
            '<option value="USD">USD</option>' +
            '<option value="EUR">EUR</option>' +
            '<option value="GBP">GBP</option>' +
            '<option value="JPY">JPY</option>' +
            '<option value="CAD">CAD</option>' +
            '<option value="BRL">BRL</option>')

    } else {

        $("#cambiarDivisa").append('<option value="MXN">MXN</option>' +
            '<option value="USD">USD</option>' +
            '<option value="PEN">PEN</option>' +
            '<option value="COP">COP</option>' +
            '<option value="CLP">CLP</option>' +
            '<option value="ARS">ARS</option>' +
            '<option value="BRL">BRL</option>')

    }

}

/*=============================================
/*=============================================
/*=============================================
/*=============================================
CAMBIO DE DIVISA
=============================================*/

var divisaBase = "MXN";

$("#cambiarDivisa").change(function() {

    $(".alert").remove();

    if ($("#seleccionarPais").val() == "") {

        $("#cambiarDivisa").after('<div class="alert alert-warning">No ha seleccionado el país de envío</div>');

        return;

    }

    var divisa = $(this).val();

    $.ajax({

        url: "http://free.currencyconverterapi.com/api/v6/convert?q=" + divisaBase + "_" + divisa + "&compact=y&apiKey=a01ebaf9a1c69eb4ff79",
        type: "GET",
        cache: false,
        contentType: false,
        processData: false,
        dataType: "jsonp",
        success: function(respuesta) {

            var divisaString = JSON.stringify(respuesta);
            var conversion = divisaString.substr(18, 4);
            if (divisa == "MXN") {
                conversion = 1;
            }
            $(".cambioDivisa").html(divisa);

            $(".valorSubtotal").html((Number(conversion) * Number($(".valorSubtotal").attr("valor"))).toFixed(2))
            $(".valorTotalEnvio").html((Number(conversion) * Number($(".valorTotalEnvio").attr("valor"))).toFixed(2))
            $(".valorTotalImpuesto").html((Number(conversion) * Number($(".valorTotalImpuesto").attr("valor"))).toFixed(2))
            $(".valorTotalCompra").html((Number(conversion) * Number($(".valorTotalCompra").attr("valor"))).toFixed(2))

            var valorItem = $(".valorItem");
            localStorage.setItem("total", hex_md5($(".valorTotalCompra").html()));

            for (var i = 0; i < valorItem.length; i++) {
                $(valorItem[i]).html((Number(conversion) * Number($(valorItem[i]).attr("valor"))).toFixed(2))
            }

        }

    })

})




/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
BOTÓN PAGAR PAYPAL
=============================================*/

$(".btnPagar").click(function() {

    if ($("#seleccionarPais").val() == "") {

        $(".btnPagar").before('<div class="alert alert-warning">No ha seleccionado el país de envío</div>');

        return;

    }

    var divisa = $("#cambiarDivisa").val();
    var total = $(".valorTotalCompra").html();
    var totalEncriptado = localStorage.getItem("total");
    var impuesto = $(".valorTotalImpuesto").html();
    var envio = $(".valorTotalEnvio").html();
    var subtotal = $(".valorSubtotal").html();
    var titulo = $(".valorTitulo");
    var cantidad = $(".valorCantidad");
    var valorItem = $(".valorItem");
    var idProducto = $('.cuerpoCarrito button, .comprarAhora button');

    var tituloArray = [];
    var cantidadArray = [];
    var valorItemArray = [];
    var idProductoArray = [];

    for (var i = 0; i < titulo.length; i++) {

        tituloArray[i] = $(titulo[i]).html();
        cantidadArray[i] = $(cantidad[i]).html();
        valorItemArray[i] = $(valorItem[i]).html();
        idProductoArray[i] = $(idProducto[i]).attr("idProducto");

    }

    var datos = new FormData();

    datos.append("divisa", divisa);
    datos.append("total", total);
    datos.append("totalEncriptado", totalEncriptado);
    datos.append("impuesto", impuesto);
    datos.append("envio", envio);
    datos.append("subtotal", subtotal);
    datos.append("tituloArray", tituloArray);
    datos.append("cantidadArray", cantidadArray);
    datos.append("valorItemArray", valorItemArray);
    datos.append("idProductoArray", idProductoArray);

    $.ajax({
        url: rutaOculta + "ajax/carrito.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {
            window.location = respuesta;

        }

    })

})