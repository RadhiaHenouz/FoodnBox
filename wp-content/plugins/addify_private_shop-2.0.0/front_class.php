<?php 

if ( ! defined( 'ABSPATH' ) ) { 
	exit; // restict for direct access
}


if ( !class_exists( 'Front_Class_Addify_Private_Shop' ) ) {

	class Front_Class_Addify_Private_Shop extends Addify_Private_Shop {

		function __construct() {

			$g_boots = get_option('ps_goolge');
			$ps_privatize = get_option('ps_privatize');
			$redirect_on = get_option('ps_default_login');
			$redirect_on_custom = get_option('ps_custom_url_login');


			if($_SERVER['HTTP_USER_AGENT'] == 'googlebot' && $g_boots == 'yes') {

			} else {


				if(get_option("ps_manual_approve_customer") == 'yes') {

					//If manually approved customers is enabled.

					add_action( 'woocommerce_created_customer', array($this, 'ps_set_status_user_woocommerce' ));
					add_action('woocommerce_registration_redirect', array($this, 'ps_user_autologout'), 2);
					add_action('woocommerce_before_customer_login_form', array($this, 'ps_registration_message'), 2);

					add_filter('wp_authenticate_user', array($this, 'ps_auth_login'));

				}

				add_filter('woocommerce_login_redirect', array($this, 'af_login_redirect'), 1100, 2);
				add_action('init', array($this, 'af_start_session'), 1);
				add_action( 'template_redirect', array($this, 'af_redirect_url' ));

				if($ps_privatize == 'whole_webstore') {

					add_action( 'wp', array($this, 'redirect_wholesite' ));
					add_filter( 'page_template', array($this, 'af_ps_account_page_template' ));
					

				} else if($ps_privatize == 'selected_items')  {
					add_action('init',array($this, 'remove_add_to_cart_button'));
					add_action('woocommerce_after_shop_loop_item',array($this, 'replace_add_to_cart_button'));

					add_action( 'plugins_loaded',array($this, 'af_ps_remove_link' ));
					add_action( 'woocommerce_before_shop_loop_item', array($this, 'af_ps_template_loop_product_link_open'), 20 );
					add_action( 'wp_loaded', array( $this, 'front_scripts' ) );
					if(!empty($redirect_on) && $redirect_on != 'addify_popup') {
						add_filter( 'page_template', array($this, 'af_ps_account_page_template' ));
					}


					add_action( 'wp', array($this, 'redirect_single_product_page' ));
				} else {

				}

				add_action('wp_logout',array($this, 'af_auto_redirect_after_logout'));
				add_action('wp_footer', array($this, 'af_popup')); 
			}

			
		}


		// start global session for saving the referer url
		function af_start_session() {
		    if(!session_id()) {
		        session_start();
		    }
		}

		// get the referer url and save it to the session
		function af_redirect_url() {
		    if (! is_user_logged_in()) {
		        $_SESSION['referer_url'] = wp_get_referer();
		    } else {
		        session_destroy();
		    }
		}

		function af_login_redirect() {

		    $redirect = get_option('ps_redirect_login');
		    $customurl = get_option('ps_redirect_custom_url');

		    if($redirect == 'myaccount') {

		    	wp_redirect(get_permalink( get_option('woocommerce_myaccount_page_id') ));
		    	exit();
		    } else if($redirect == 'customurl') {

		    	wp_redirect($customurl);
		    	exit();

		    } elseif ($redirect == 'sameurl') {
		    	
		    	if (isset($_SESSION['referer_url'])) {
			        wp_redirect($_SESSION['referer_url']);
			        exit();
			    } else {
			        wp_redirect(get_permalink( get_option('woocommerce_myaccount_page_id') ));
			        exit();
			    }

		    }
		}


		function af_auto_redirect_after_logout(){

			$redirect_on = get_option('ps_default_login');
			$redirect_on_custom = get_option('ps_custom_url_login');

			if(!empty($redirect_on) && $redirect_on == 'custom_url') {

				

				wp_redirect( $redirect_on_custom );
				exit();

			} else {

				wp_redirect(get_permalink( get_option('woocommerce_myaccount_page_id') ));
				exit();
			}


		 
		  
		}


		public function front_scripts() {	
            
        	wp_enqueue_style( 'addify_ps_front_css', plugins_url( '/assets/css/addify_ps_front_css.css', __FILE__ ), false );
        	wp_enqueue_style( 'fancy-box-css', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css', false );
        	wp_enqueue_script('jquery');
        	wp_enqueue_script( 'fancy-box-js', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', false );
        	
        }

	    function remove_add_to_cart_button() {
	    	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	    }
		
		function replace_add_to_cart_button() {

			global $product;

			if(!empty(get_option('ps_privatize_products'))) {
				$pri_pros = get_option('ps_privatize_products');
			} else {
				$pri_pros = array();
			}
			
			if(!empty(get_option('ps_privatize_categories'))) {
				$pri_cats = get_option('ps_privatize_categories');
			} else {
				$pri_cats = array();
			}

			
			$product_type = $product->get_type();
			$ip_list = get_option('ps_allowed_ips');
			$ip_array = explode(',', $ip_list);
			$my_ip = $_SERVER['REMOTE_ADDR'];

			//Category Products
			$productids = array();
			$args = array(
				'posts_per_page' => -1,
			    'post_type' => 'product',
			    'post_stats' => 'publish',
			    'tax_query'     => array(
			        array(
			            'taxonomy'  => 'product_cat',
			            'field'     => 'id', 
			            'terms'     => $pri_cats
			        )
			    )
			);
		    $products_ids = get_posts($args);

			foreach($products_ids as $proid) {
				$productids[] = $proid->ID;
			}
			

			$redirect_on = get_option('ps_default_login');
			$redirect_on_custom = get_option('ps_custom_url_login');
				
			if((in_array($product->get_id(), $pri_pros) || in_array($product->get_id(), $productids)) && (!is_user_logged_in() && !in_array($my_ip, $ip_array))) {

				if(!empty($redirect_on) && $redirect_on == 'custom_url') {

					$red = $redirect_on_custom;

				} else {

					$red = get_permalink( get_option('woocommerce_myaccount_page_id') );
				}

				if(!empty($redirect_on) && $redirect_on == 'addify_popup') {

					echo apply_filters( 'woocommerce_loop_add_to_cart_link',
				    sprintf( '<a href="javascript:;" data-fancybox data-src="#trueModal" data-modal="true" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">'.esc_html__( 'Login', 'addify_ps' ).'</a>',
				        esc_url( ''),
				        esc_attr( '' ),
				        esc_attr( '' ),
				        $product->is_purchasable() ? 'add_to_cart_button' : '',
				        esc_attr( $product_type )
				        
				    ),
					$product );

				} else {

					echo apply_filters( 'woocommerce_loop_add_to_cart_link',
				    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
				        esc_url( $red),
				        esc_attr( '' ),
				        esc_attr( '' ),
				        $product->is_purchasable() ? 'add_to_cart_button' : '',
				        esc_attr( $product_type ),
				        esc_html( 'Login' )
				    ),
					$product );
				}
				
			} else {

				
				
				switch ( $product_type ) {
					case 'external':
						echo apply_filters( 'woocommerce_loop_add_to_cart_link',
					    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
					        esc_url( $product->add_to_cart_url() ),
					        esc_attr( $product->get_id() ),
					        esc_attr( $product->get_sku() ),
					        $product->is_purchasable() ? 'add_to_cart_button' : '',
					        esc_attr( $product_type ),
					        esc_html( $product->add_to_cart_text() )
					    ),
						$product );
					break;
					case 'grouped':
						echo apply_filters( 'woocommerce_loop_add_to_cart_link',
					    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
					        esc_url( $product->add_to_cart_url() ),
					        esc_attr( $product->get_id() ),
					        esc_attr( $product->get_sku() ),
					        $product->is_purchasable() ? 'add_to_cart_button' : '',
					        esc_attr( $product_type ),
					        esc_html( $product->add_to_cart_text() )
					    ),
						$product );
					break;
					case 'simple':
						echo apply_filters( 'woocommerce_loop_add_to_cart_link',
					    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
					        esc_url( $product->add_to_cart_url() ),
					        esc_attr( $product->get_id() ),
					        esc_attr( $product->get_sku() ),
					        $product->is_purchasable() ? 'add_to_cart_button' : '',
					        esc_attr( $product_type ),
					        esc_html( $product->add_to_cart_text() )
					    ),
						$product );
					break;
					case 'variable':
						echo apply_filters( 'woocommerce_loop_add_to_cart_link',
					    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
					        esc_url( $product->add_to_cart_url() ),
					        esc_attr( $product->get_id() ),
					        esc_attr( $product->get_sku() ),
					        $product->is_purchasable() ? 'add_to_cart_button' : '',
					        esc_attr( $product_type ),
					        esc_html( $product->add_to_cart_text() )
					    ),
						$product );
					break;
					default:
						echo apply_filters( 'woocommerce_loop_add_to_cart_link',
					    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
					        esc_url( $product->add_to_cart_url() ),
					        esc_attr( $product->get_id() ),
					        esc_attr( $product->get_sku() ),
					        $product->is_purchasable() ? 'add_to_cart_button' : '',
					        esc_attr( $product_type ),
					        esc_html( $product->add_to_cart_text() )
					    ),
						$product );
				}
			}



			

			





		}


		function af_ps_remove_link() {


			remove_action( 'woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open' );
    		remove_action( 'woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_close' );
		}

		function af_ps_template_loop_product_link_open() {
			global $product;

			$redirect_on = get_option('ps_default_login');
			$redirect_on_custom = get_option('ps_custom_url_login');

			if(!empty(get_option('ps_privatize_products'))) {
				$pri_pros = get_option('ps_privatize_products');
			} else {
				$pri_pros = array();
			}
			
			if(!empty(get_option('ps_privatize_categories'))) {
				$pri_cats = get_option('ps_privatize_categories');
			} else {
				$pri_cats = array();
			}
			$product_type = $product->get_type();

			$ip_list = get_option('ps_allowed_ips');
			$ip_array = explode(',', $ip_list);
			$my_ip = $_SERVER['REMOTE_ADDR'];

			$url = get_permalink( $product->get_id() ) ;

			//Category Products
			$productids = array();
			$args = array(
			   	
			   	'posts_per_page' => -1,
			    'post_type' => 'product',
			    'post_stats' => 'publish',
			    'tax_query'     => array(
			        array(
			            'taxonomy'  => 'product_cat',
			            'field'     => 'id', 
			            'terms'     => $pri_cats
			        )
			    )
			);
		    $products_ids = get_posts($args);

			foreach($products_ids as $proid) {
				$productids[] = $proid->ID;
			}

			if((in_array($product->get_id(), $pri_pros) || in_array($product->get_id(), $productids)) && (!is_user_logged_in() && !in_array($my_ip, $ip_array))) {
				

				if(!empty($redirect_on) && $redirect_on == 'custom_url') {

					echo '<a href="'.$redirect_on_custom.'" rel="nofollow" class="woocommerce-LoopProduct-link">';

				} else {
					echo '<a href="'.get_permalink( get_option('woocommerce_myaccount_page_id') ).'" rel="nofollow" class="woocommerce-LoopProduct-link">';
				}

			} else {
				echo '<a href="'.$url.'" rel="nofollow" class="woocommerce-LoopProduct-link">';
			}
		}


		function af_ps_account_page_template($page_template) { 

			

			global $wp;

			$current_url = home_url(add_query_arg(array(),$wp->request));

			$new_url = explode('account',$current_url);

			$defult_login_page = get_option('ps_default_login');


			if($new_url[1] != '/lost-password') {

			
			if($defult_login_page == 'default') {

				$page_template = $page_template;
			} else {

				$m_account =  get_option('woocommerce_myaccount_page_id');
					if ( is_page( $m_account ) &&  !is_user_logged_in()) {
			        $page_template = addify_ps_plugindir . 'templates/myaccount.php';
			        
			    }
				}
			}

		    return $page_template;
		    
		}


		function redirect_single_product_page() {
			//error_reporting(0);
			global $post, $wp_query, $wp;
			$cat_obj = $wp_query->get_queried_object_id();

			if(is_shop()){
			    $page_id = wc_get_page_id('shop');
			 }

			 $pagee_id = $wp_query->post->ID;

			if($cat_obj)    {
			    $category_ID  = $cat_obj;
			} else {
				$category_ID = 0;
			}

			$redirect_on = get_option('ps_default_login');
			$redirect_on_custom = get_option('ps_custom_url_login');

			$current_url = home_url(add_query_arg(array(),$wp->request));

			$new_url = explode('account',$current_url);


			if($new_url[1] != '/lost-password') {

			

				if(!empty(get_option('ps_privatize_products'))) {
					$pri_pros = get_option('ps_privatize_products');
				} else {
					$pri_pros = array();
				}
				
				if(!empty(get_option('ps_privatize_categories'))) {
					$pri_cats = get_option('ps_privatize_categories');
				} else {
					$pri_cats = array();
				}
				

				if(!empty(get_option('ps_privatize_pages'))) {
					$pri_pages = get_option('ps_privatize_pages');
				} else {
					$pri_pages = array();
				}
				

				$ip_list = get_option('ps_allowed_ips');
				$ip_array = explode(',', $ip_list);
				$my_ip = $_SERVER['REMOTE_ADDR'];

				//Category Products
				$productids = array();
				$args = array(
				   'posts_per_page' => -1,
				    'post_type' => 'product',
				    'post_stats' => 'publish',
				    'tax_query'     => array(
				        array(
				            'taxonomy'  => 'product_cat',
				            'field'     => 'id', 
				            'terms'     => $pri_cats
				        )
				    )
				);
			    $products_ids = get_posts($args);

				foreach($products_ids as $proid) {
					$productids[] = $proid->ID;
				}


				if(is_product() && (in_array($post->ID, $pri_pros) || in_array($post->ID, $productids)) && (!is_user_logged_in() && !in_array($my_ip, $ip_array))) {
			        
			            //       if(!empty($redirect_on) && $redirect_on == 'addify_popup') {

			    		// 	echo '<a href="javascript:;" data-fancybox data-src="#trueModal" data-modal="true" id="ttt"  /></a>';

			    		// } else {
			        
				           if(!empty($redirect_on) && $redirect_on == 'custom_url') {

								wp_redirect( $redirect_on_custom );
								exit();

							} else {

								wp_redirect( get_permalink( get_option('woocommerce_myaccount_page_id') ) );
								exit();
							}
						//}
			        
			    }

			    if((in_array($category_ID, $pri_cats)) && (!is_user_logged_in() && !in_array($my_ip, $ip_array))) {
			        
			            //       if(!empty($redirect_on) && $redirect_on == 'addify_popup') {

			    		// 	echo '<a href="javascript:;" data-fancybox data-src="#trueModal" data-modal="true" id="ttt"  /></a>';

			    		// } else {
			        
				           if(!empty($redirect_on) && $redirect_on == 'custom_url') {

								wp_redirect( $redirect_on_custom );
								exit();

							} else {

								wp_redirect( get_permalink( get_option('woocommerce_myaccount_page_id') ) );
								exit();
							}
						//}
			        
			    }


			    if(is_shop()){

			    	if((in_array($page_id, $pri_pages)) && (!is_user_logged_in() && !in_array($my_ip, $ip_array))) {

			    		//       if(!empty($redirect_on) && $redirect_on == 'addify_popup') {

			    		// 	echo '<a href="javascript:;" data-fancybox data-src="#trueModal" data-modal="true" id="ttt"  /></a>';

			    		// } else {
			        
				           if(!empty($redirect_on) && $redirect_on == 'custom_url') {

								wp_redirect( $redirect_on_custom );
								exit();

							} else {

								wp_redirect( get_permalink( get_option('woocommerce_myaccount_page_id') ) );
								exit();
							}
						//}
					       
				        
				    }
			    }


			    if((in_array($pagee_id, $pri_pages)) && (!is_user_logged_in() && !in_array($my_ip, $ip_array))) {
			        
			      //       if(!empty($redirect_on) && $redirect_on == 'addify_popup') {

			    		// 	echo '<a href="javascript:;" data-fancybox data-src="#trueModal" data-modal="true" id="ttt"  /></a>';

			    		// } else {
			        
				           if(!empty($redirect_on) && $redirect_on == 'custom_url') {

								wp_redirect( $redirect_on_custom );
								exit();

							} else {

								wp_redirect( get_permalink( get_option('woocommerce_myaccount_page_id') ) );
								exit();
							}
						//}
			        
			    }
			}

		}


		function redirect_wholesite() { 
			//error_reporting(0);
			global $wp_query;
     		$post_obj = $wp_query->get_queried_object();
     		$Page_ID = $post_obj->ID;
    		


			$ip_list = get_option('ps_allowed_ips');
			$ip_array = explode(',', $ip_list);
			$my_ip = $_SERVER['REMOTE_ADDR'];
			$redirect_on = get_option('ps_default_login');
			$redirect_on_custom = get_option('ps_custom_url_login');
			

			if($Page_ID!=get_option('woocommerce_myaccount_page_id') && !is_user_logged_in() && !in_array($my_ip, $ip_array)) {
				
				wp_redirect( get_permalink( get_option('woocommerce_myaccount_page_id') ) );
				exit();
					
				
			}
			
		}



		function ps_set_status_user_woocommerce($customer_id) { 


			update_user_meta( $customer_id, 'ps_new_user_status', 'pending');

			//Send Message to user that their account is pending.  

			$user = new WP_User( $customer_id );
            $user_login = stripslashes( $user->data->user_login );
			$user_email = stripslashes( $user->data->user_email );

			$to = $user->data->user_email;
			$subject = get_option('ps_approval_email_message_subject');

			$message = "
			<html>
				<head>
					
				</head>
				<body>
					<p>".get_option('ps_approval_email_message_text')."</p>
					
				</body>
			</html>
			";

			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			$admin_email = get_option( 'admin_email' );
			if ( empty( $admin_email ) ) {
				$admin_email = 'support@' . $_SERVER['SERVER_NAME'];
			}

			$fromname = get_option( 'blogname' );

			// More headers
			$headers .= 'From: '.$fromname.' <'.$admin_email.'>' . "\r\n";

			wp_mail( $to, $subject, $message, $headers );



			//Send Message to admin that their account is pending.  


			$to1 = get_option('admin_email');
			$subject1 = 'A new user has registred and waiting for your approval';

			


			$message1 = "
			<html>
				<head>
					<title>HTML email</title>
				</head>
				<body>
					<p>Please login to backoffice and navigate to users section in order to approve this user.</p>
					<table>
						<tr>
							<td><b>Username is:</b></td>
							<td>".$user_login."</td>
						</tr>
						<tr>
							<td><b>Email is:</b></td>
							<td>".$user_email."</td>
						</tr>
						
					</table>
				</body>
			</html>
			";


			wp_mail( $to1, $subject1, $message1, $headers );




			
		}


		function ps_user_autologout(){

		       if ( is_user_logged_in() ) {
	                $current_user = wp_get_current_user();
	                $user_id = $current_user->ID;
	              
	                $approved_status = get_user_meta($user_id, 'ps_new_user_status', true);
	                //if the user hasn't been approved yet by WP Approve User plugin, destroy the cookie to kill the session and log them out
			        if ( $approved_status == 'approved' ){
			            return wp_safe_redirect(get_permalink(wc_get_page_id('myaccount')));

			        } else if($approved_status == 'pending'){
	            		wp_logout();
	                    return wp_safe_redirect(get_permalink(wc_get_page_id('myaccount'))) . "?approved=pending";
	                }  else {
	                	return wp_safe_redirect(get_permalink(wc_get_page_id('myaccount')));
	                }
	            	
		        }
		}


		function ps_registration_message(){
		        

		        if( isset($_REQUEST['approved']) ){

		        	$approved = $_REQUEST['approved'];
		        	if($approved == 'pending') {

		        		echo "<p class='ps_warning'>".get_option("ps_message_for_pending")."</p>";
		        	} 
		        } else {

		        	
		        }


		}


		function ps_auth_login ($user) {

			$status = get_user_meta($user->ID, 'ps_new_user_status', true);

		    if ( empty( $status ) ) {
				// the user does not have a status so let's assume the user is good to go
				return $user;
			}

			$message = false;
			switch ( $status ) {
				case 'pending':
					$pending_message = get_option("ps_message_for_pending");
					$message = new WP_Error( 'pending_approval', $pending_message );
					break;
				case 'approved':
					$message = $user;
					break;
			}

			return $message;
		}


		function af_popup() { ?>

			<?php if ( !is_user_logged_in() ) { ?>
				<script>
				jQuery(function(){ 

				   jQuery('#ttt').click();

				});
				</script>
			<?php } ?>

			

			<div class="row mb-4">
			  <div class="card-deck col-9">

			    <div class="card">
			      <div class="card-body">
			        <div style="display: none; max-width:700px;" id="trueModal">
			          
			          <?php 

							$ps_background = get_option('ps_background'); 
							$ps_background_colour = get_option('ps_background_colour'); 
							$ps_background_image = get_option('ps_background_image'); 

							$ps_form_background_opacity= get_option('ps_form_background_opacity'); 

							$enable_signup = get_option('woocommerce_enable_myaccount_registration'); 

							$logo = get_option('ps_upload_logo'); 

							$ps_video = get_option('ps_background_video');

						?>

						<style>
							<?php if($ps_background == 'colour') { ?>
								.fancybox-content { background-color: <?php echo $ps_background_colour; ?>; width: 100%; height: 100%; }
							<?php  } else if($ps_background == 'image') { ?>
								.fancybox-content {  background-image: url(<?php echo $ps_background_image; ?>); width: 100%; height: 100%; background-repeat: no-repeat; background-size: cover; background-position: center; background-attachment: fixed; }
							<?php } else { ?>
								.fancybox-content {}
							<?php } ?>

							.fancybox-content .ps_my_acc_page #customer_login { width: 100%; float: none !important; margin: 0 auto; padding-top: 10px;}

							.fancybox-content .ps_my_acc_page .u-column1{ width:100% !important; float: left; padding: 10px 20px; min-height: 400px; background: linear-gradient(to bottom, rgba(28, 25, 36, 0.22) 0%, rgba(0, 0, 0, 0.6) 100%); opacity: <?php echo $ps_form_background_opacity; ?>; }
							

							.fancybox-content .woocommerce-ResetPassword a{ width:50%; margin: 0 auto; padding: 30px 20px; min-height: 300px; background: #fff; opacity: <?php echo $ps_form_background_opacity; ?>; line-height: 1.214; color: #fff; font-family: "Source Sans Pro",HelveticaNeue-Light,"Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif; margin-top: 100px;}

							.fancybox-content .lost_password a, .fancybox-content .ps_my_acc_page a{ color: #fff !important; }

							.fancybox-content .ps_my_acc_page h2{font-size: 30px; font-weight: 600; line-height: 1.214; color: #fff; font-family: "Source Sans Pro",HelveticaNeue-Light,"Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif; margin-top: 20px; text-align: center;}

							.fancybox-content .ps_my_acc_page .form-row-wide { clear: both; width: 100%; }
							.fancybox-content .ps_my_acc_page p { margin: 0 0 1.41575em; }

							.fancybox-content .ps_my_acc_page .form-row label { display: block; font-weight: 400; font-family: "Source Sans Pro",HelveticaNeue-Light,"Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif; color: #fff; }

							.fancybox-content .ps_my_acc_page .required { border-bottom: 0 !important; color: red; }

							.fancybox-content .input-text {
						    	background-color: #e6e5e5; color: #2b2c30; width: 100%; box-sizing: border-box; font-weight: 400; box-shadow: inset 0 1px 1px rgba(0,0,0,.125); padding:15px; font-family: "Source Sans Pro",HelveticaNeue-Light,"Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif; line-height: 1.618; text-rendering: optimizeLegibility; border: none; margin-top: 7px; font-size: 14px;
							}

							.fancybox-content .form-row .button { width: auto; }
							.fancybox-content .button { background-color: #eeeeee; border-color: #eeeeee; color: #333333; border: 0; cursor: pointer;
						padding: .6180469716em 1.41575em;
						text-decoration: none;
						font-weight: 600;
						text-shadow: none;
						display: inline-block;
						outline: 0;
						-webkit-appearance: none;
						border-radius: 0;
						font-family: "Source Sans Pro",HelveticaNeue-Light,"Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif;
						line-height: 1.618;
						text-rendering: optimizeLegibility;
						font-size: 14px;
						 }

						 .fancybox-content label.inline {
						    display: inline !important;
						    margin-left: 1em;
						}

						<?php if($enable_signup == 'no') { ?> 

							
							.fancybox-content .ps_my_acc_page .woocommerce{ width:80%; margin: 0 auto; padding: 10px 20px; min-height: 400px; background: linear-gradient(to bottom, rgba(28, 25, 36, 0.22) 0%, rgba(0, 0, 0, 0.6) 100%); opacity: <?php echo $ps_form_background_opacity; ?>; }

						<?php } ?>

						.fancybox-content .woocommerce-error {
						    background-color: #e2401c !important;
						    list-style: none;
						}



						.fancybox-content .woocommerce-error, .fancybox-content .woocommerce-info, .fancybox-content .woocommerce-message, .fancybox-content .woocommerce-noreviews, p.no-comments {

						    padding: 1em 1.618em;
						    border-radius: 2px;
						    color: #fff;
						    background-color: #0f834d;
						    clear: both;
						    border-left: .6180469716em solid rgba(0,0,0,.15);
						    font-family: "Source Sans Pro",HelveticaNeue-Light,"Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif;
						line-height: 1.618;
						width: 50%;
						margin: 0 auto;

						}

						.fancybox-content .main{ width: auto; padding: 20px; margin-bottom: 50px !important; }

						.fancybox-content .ps_warning { background-color: #ff9966; width: 97%; padding: 20px; color: #fff; text-align:  center; }

						.fancybox-content .logoimg{ text-align: center; width: 100%; height: 150px}

						.fancybox-content .logoimg img { display: inline; }

						.fancybox-content .woocommerce-error li, .woocommerce-info li, .woocommerce-message li { padding-left: 21px !important; }

						.fancybox-content .ps_my_acc_page p{ color: #fff; }

						#trueModal{ min-width: 750px; top: 4%; height: 750px; }

						.btn-close{ position: absolute; right: 20px; }


						@media screen and (max-width: 992px) {

							.fancybox-content .ps_my_acc_page .u-column1{ width: 100% !important; }
							.fancybox-content .ps_my_acc_page .u-column2{ width: 100% !important; margin-top: 50px; }

							#trueModal{ min-width: auto; }

							#trueModal{ width: 90%; }

							.fancybox-content .main{ width: 80% !important; }

						}

						<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'no' ) { ?>

							.fancybox-content .main{ width: 80%; padding: 20px; margin:0 auto; padding: 10px 20px; min-height: 400px; background: linear-gradient(to bottom, rgba(28, 25, 36, 0.22) 0%, rgba(0, 0, 0, 0.6) 100%); opacity: <?php echo $ps_form_background_opacity; ?>; }

						<?php } ?>

						<?php if($ps_background == 'video') { ?>

							.fancybox-content .logoimg{ position:relative; }

						<?php } ?>

						</style>

						

						<div class="ps_my_acc_page">

							<!-- <button data-fancybox-close class="btn btn-close"><?php echo esc_html__("Close", "addify_ps"); ?></button> -->
							
							<div class="logoimg"><img src="<?php echo $logo; ?>" width="200"  /></div>

							<div class="main">
								
									<div class="erromsg"><?php wc_print_notices(); ?></div>
									<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

									<div class="u-columns col2-set" id="customer_login">
										
										<div class="u-column1 col-1">
												
											<h2><?php esc_html_e( get_option('login_title'), 'woocommerce' ); ?></h2>

											<form class="woocommerce-form woocommerce-form-login login" method="post">

												<?php do_action( 'woocommerce_login_form_start' ); ?>

												<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
													<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
													<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
												</p>
												<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
													<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
													<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
												</p>

												<?php do_action( 'woocommerce_login_form' ); ?>

												<p class="form-row">
													<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
													<button type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>

													<label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
														<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
													</label>
												</p>
												<p class="woocommerce-LostPassword lost_password">
													<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
												</p>

												<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
												<p class="regg">
													<a href="<?php echo esc_url( get_permalink(wc_get_page_id('myaccount')) ); ?>"><?php esc_html_e( 'Click here to Register', 'woocommerce' ); ?></a>
												</p>
												<?php endif; ?>

												<?php do_action( 'woocommerce_login_form_end' ); ?>

											</form>

											

										</div>

									</div>

									<?php do_action( 'woocommerce_after_customer_login_form' ); ?>

							</div>

						</div>


		<?php }


		
		

	}

	new Front_Class_Addify_Private_Shop();
}