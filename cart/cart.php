<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;
wp_register_script( 'jQuery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', null, null, true );
wp_enqueue_script('jQuery');
wp_enqueue_script('CmdeG_script', get_template_directory_uri().'/inc/assets/js/script.js');
wp_enqueue_style('CmdeG_style',get_template_directory_uri().'/inc/assets/css/style.css');

do_action( 'woocommerce_before_cart' ); ?>
<style>
	.modal-dialog {

 max-width:100% !important;
 height:100% !important;
 
}
.modal{
	z-index:10000 !important;
}
.modal-content {

/* 80% of window height */

height: 100% !important;
max-width:100% !important;
background-color:#BBD6EC;

}       

.modal-header {

background-color: #337AB7;

padding:16px 16px;

color:#FFF;

border-bottom:2px dashed #337AB7;

}
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				<th class="product-remove">&nbsp;</th>
				<th class="product-thumbnail">&nbsp;</th>
				<th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
				<th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
				<th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>
		
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

						<td class="product-remove">
							<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_html__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
							?>
						</td>

						<td class="product-thumbnail">
						<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

						if ( ! $product_permalink ) {
							echo $thumbnail; // PHPCS: XSS ok.
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
						}
						?>
						</td>

						<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
						<?php
						if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
						} else {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
						}

						do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

						// Meta data.
						echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
						}
						?>
						</td>

						<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</td>

						<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
						<?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input(
								array(
									'input_name'   => "cart[{$cart_item_key}][qty]",
									'input_value'  => $cart_item['quantity'],
									'max_value'    => $_product->get_max_purchase_quantity(),
									'min_value'    => '0',
									'product_name' => $_product->get_name(),
								),
								$_product,
								false
							);
						}

						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
						?>
						</td>

						<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</td>
					</tr>
					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			<tr>
				<td colspan="6" class="actions">

					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon">
							<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php } ?>

					<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
                   
				
					<?php do_action( 'woocommerce_cart_actions' ); ?>
 
					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	
	<div class="modal" id="myModal">
   <div class="modal-dialog" style="width:100%;overflow-y:auto;">
	  <div class="modal-content"   style="overflow-y: auto;">
	  <span  class="close" id="close" data-dismiss="modal" aria-label="Close" style="font-size:4em ; margin:10px;">&times;</span>
   
	  <div id="Etape1" style="width:80%;margin-left:10%; ">
		<h4>
		Veuillez remplir les champs suivants afin de répartir le montant de votre commande avec vos proches.</br>Les champs avec un asterix sont obligatoires. </br>Cliquez bien sur les boutons REPARTIR et ENVOYER à chaque étape de la répartion. Evitez de presser la touche "Entréé". </br></br><u>ETAPE N°1</u>
		</h4>
        <div style="text-align:center">
						
		<div style="width:2px;float:left;"> <!-- 75% -->
				<button class="btn-coach" style="transform: rotate(-90deg);
					transform-origin: left bottom 0;width:170px;height:35px;margin-top:173px;padding-top:4px;">COMPTE COACH</button>
				</div>
				<div style="display:flex;flex-direction:column;float:left;width:90%;">
					<div>
					<input type="text" class='not-coach' id="DateFact" name="DateFact" value="Commande du <?php echo date('d/m/Y');?>" readonly><br>
					</div>
					<div class='input-wrapper'><input type='text' class='not-coach' id='Nom' name='Nom' value='<?php echo WC()->cart->get_customer()->get_billing_first_name();?>' readonly></div>
					<div class='input-wrapper'><input type='text' class='not-coach' id='Prenom' name='Prenom' value='<?php echo WC()->cart->get_customer()->get_billing_last_name();?>' readonly></div>
					<div class='input-wrapper'><input type='text' class='not-coach' id='Tel' name='Tel' value='<?php echo WC()->cart->get_customer()->get_billing_phone();?>' readonly></div>
					<div class='input-wrapper'><input type='text' class='not-coach' id='Email' name='Email' value='<?php echo WC()->cart->get_customer()->get_billing_email();?>' readonly></div>		
					
						
				    <input type="text" style="display:none" class='not-coach' id="MontantTotal" name="MontantTotal" value="<?php echo WC()->cart->total;?>" readonly>
					
					<div class='input-wrapper'>
					<input type="text" class='not-coach'  value="Montant TTC :<?php echo WC()->cart->total;?>" readonly>
					</div>
					<div class='input-wrapper' style="display:inline-block;">
					<input type="text" id="NbrePart" name="NbrePart"  class="inpt-coach" placeholder="Nombre de parts" ><button class="btn-coach">COACH INCLUS</button>
					</div>
					<div class='input-wrapper' style="display:inline-block;">
					
					<input type="text" id="NbrePays" name="NbrePays"  class="inpt-coach" placeholder="Nombre de payeurs"><button class="btn-coach">COACH INCLUS</button>
					</div>
					</div>

						
						
					
					
		
		</div>
	
	</div> 
			<div id="Etape2" style="display:none;;margin-left:5%;">

				<p> Veuillez saisir le nombre de parts par payeur</p>
				<u>ETAPE N°2</u>
				<table id="ListPays" class='CmdeTable' style="margin-bottom:20px;">
				<thead>

				<tr><th></th><th >Nom & Prénom </th><th>Nombre de parts </th><th> &nbsp</th></tr>
				</thead>
				<tbody>
				</tbody>
				</table >
				<div style="float:right;margin-right:10px;display:flex;">
				<label >Nombre de parts restants : </label>
				<input type="text" id="NbrePartsRest" name="NbrePartsRest" readonly><br>
				</div>
			</div> <!--Etape2-->
			<div id="Etape3" style="display:none;;margin-left:5%;">
			<u>ETAPE N°3</u>
			<table id="ListParts" class='CmdeTable' style="margin-bottom:20px;">
				<thead>

				<tr><th>Nom & Prénom </th><th>Email </th><th>Vérif Email </th><th>Tél</th><th>Montant </th><th>&nbsp</th><tr>
				</thead>
				<tbody>
				</tbody>
			</table >
			<div style="float:right;margin-right:10px;display:flex;">
				<label>Montant Restant: </label>
				<input type="text" id="MontantRest" name="MontantRest" style="color:red;margin-left:10px;width:140px;float:right" value="" readonly><br><br>
			 </div>
			 <br>
			<br>
			<div style="display:inline-block">
			<input type="checkbox" id="CheckConds" name="CheckConds" value="Conditions" style="margin-right:5px;"/>
				
			<a >  <b>Accepter les conditions</b></a>
			</div>
			<p id="Conditions" style="display:block">
			La commande sera préparée dès que l'ensemble des participants auront réglé leur participation.<br> 
			Chaque participant recevra une demande de règlement par mail correspondant à sa participation dans les 2 heures ouvrables.<br>
			Si tel ou tel participant n'a pas payé sous 72 heures, j'accepte de prendre en charge le montant de sa participation.<br>
			Une empreinte CB correspondant au total de la commande me sera demandée lors de la phase de paiement, <br>seul le montant correspondant à ma participation (et à celle(s) non réglée(s) par mes proches) sera débitée)
			<br> Le montant total peut être revu à la baisse (et uniquement à la baisse) dans le cas où des poids variables réduiraient le montant total de la commande.<br>Dans ce cas, la réduction totale sera appliquée sur le montant de ma participation.

			
			</p >
			</div><!--etape3-->
			<center>
				<div class='navigation'>
		
				<input type="button" id="Envoyer" value="Envoyer" class="button" style="display:none" data-toggle="modal" data-target="#exampleModalLong" url="" >
				<br>
				<br>
				<br>
				
				<a id="prev" style=""><< &nbsp Précédent</a>
				&nbsp
					<a id="next" style="
				">&nbspSuivant &nbsp >>&nbsp&nbsp</a>
				</div>
			</center>	
      </div><!--modal-content-->
     </div>
 </div>
 <div class="modal" id="ConfirmBox"style="text-align:center ;display:none;width:50%;height:30%; margin-top:10%;margin-left:30%;margin-right:30%;" >
 <div class="modal-content">
      
      <div class="modal-body">
	
	    <p> Vous souhaitez: </p >
	  
		<input type="submit" id="ConfirmBtn"  class="button" style="margin-top:5%;" value="Valider et envoyer cette répartition" >
		<input type="button" id="CancelBtn"  class="button" style="margin-top:5%;" value="Annuler">

      </div>
      
    </div>
 
</div>	
	

	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>


<?php do_action( 'woocommerce_after_cart' ); ?>
