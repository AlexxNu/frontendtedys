<!--=====================================
BREADCRUMB CARRITO DE COMPRAS
======================================-->

<div class="container-fluid well well-sm">
	
	<div class="container">
		
		<div class="row">
			
			<ul class="breadcrumb fondoBreadcrumb text-uppercase">
				
				<li><a href="<?php echo $url;  ?>">CARRITO DE COMPRAS</a></li>
				<li class="active pagActiva"><?php echo $routes[0] ?></li>

			</ul>

		</div>

	</div>

</div>

<!--=====================================
TABLA CARRITO DE COMPRAS
======================================-->
 <div class="shop-single shopping-cart">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <table class="cart-table cuerpoCarrito">
                                <tr>
                                    <th>Remover</th>
                                    <th>Producto</th>
                                    <th>Nombre del Producto</th>
                                    
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Subtotal</th>
                                </tr>
                                
                                                                </div>
                                
                            </table>
                            <div class="table-btn">
                                

                            </div>
                            <div class="clearfix space20"></div>
                            <div class="row shipping-info-wrap">
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="shipping">
                                        
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <form id="discount-coupon-form">
                                        <div class="discount">
                                            
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="totals cabeceraCheckout">
                                        <table id="shopping-cart-totals-table">
                                            <tfoot>
                                                <tr>
                                                    <td style="" class="a-right" colspan="1">
                                                        <strong>Grand Total</strong>
                                                    </td>
                                                    <td style="" class="a-right">
                                                        <strong><span class="price">$1000.00</span></strong>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td style="" class="a-right" colspan="1">
                                                        Subtotal    
                                                    </td>
                                                    <td style="" class="a-right">
                                                        <span class="price">$1000.00</span>    
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <ul class="checkout-types">
                                            <li class="space10"><button type="button" class="btn-color">Proceed to checkout</button></li>
                                            <li><a href="#">Checkout with Multiple Addresses</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="space40"></div>
                           