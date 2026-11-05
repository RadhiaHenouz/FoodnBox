<html>
<head>
<title>Private My Account</title>
<?php wp_head(); ?>

<link rel='stylesheet' id='woo-css'  href='<?php echo get_site_url(); ?>/wp-content/plugins/woocommerce/assets/css/woocommerce.css' type='text/css' media='all' />


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

	body, ul, li{ padding: 0; margin: 0; }

	<?php if($ps_background == 'colour') { ?>
		body { background-color: <?php echo $ps_background_colour; ?>; width: 100%; height: 100%; }
	<?php  } else if($ps_background == 'image') { ?>
		body {  background-image: url(<?php echo $ps_background_image; ?>); width: 100%; height: 100%; background-repeat: no-repeat; background-size: cover; background-position: center; background-attachment: fixed; }
	<?php } else { ?>
		body {}
	<?php } ?>

	.ps_my_acc_page #customer_login { width: 90%; float: none !important; margin: 0 auto; padding-top: 50px; margin-top: 150px; }

	.ps_my_acc_page .u-column1{ width:45% !important; float: left; padding: 10px 20px; min-height: 430px; background: linear-gradient(to bottom, rgba(28, 25, 36, 0.22) 0%, rgba(0, 0, 0, 0.6) 100%); opacity: <?php echo $ps_form_background_opacity; ?>; }
	.ps_my_acc_page .u-column2{ width:45% !important; float: left;  padding: 10px 20px;  min-height: 430px;  background: linear-gradient(to bottom, rgba(28, 25, 36, 0.22) 0%, rgba(0, 0, 0, 0.6) 100%);  opacity: <?php echo $ps_form_background_opacity; ?>; }

	.woocommerce-ResetPassword a{ width:50%; margin: 0 auto; padding: 30px 20px; min-height: 300px; background: #fff; opacity: <?php echo $ps_form_background_opacity; ?>; line-height: 1.214; color: #fff; font-family: "Source Sans Pro",HelveticaNeue-Light,"Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif; margin-top: 100px;}

	.lost_password a, .ps_my_acc_page a{ color: #fff !important; }

	.ps_my_acc_page h2{font-size: 30px; font-weight: 600; line-height: 1.214; color: #fff; font-family: "Source Sans Pro",HelveticaNeue-Light,"Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif; margin-top: 20px; text-align: left;}

	.ps_my_acc_page .form-row-wide { clear: both; width: 60%; }
	.ps_my_acc_page p { margin: 0 0 1.41575em; }

	.ps_my_acc_page .form-row label { display: block; font-weight: 600; font-family: "Source Sans Pro",HelveticaNeue-Light,"Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif; color: #fff;font-size: 14px; }

	.ps_my_acc_page .required { border-bottom: 0 !important; color: red; }

	.input-text {
    	background-color: #e6e5e5; color: #2b2c30; width: 100%; box-sizing: border-box; font-weight: 400; box-shadow: inset 0 1px 1px rgba(0,0,0,.125); padding:15px; font-family: "Source Sans Pro",HelveticaNeue-Light,"Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif; line-height: 1.618; text-rendering: optimizeLegibility; border: none; margin-top: 7px; font-size: 12px;
	}

	.form-row .button { width: auto; }
	.button { background-color: #eeeeee; border-color: #eeeeee; color: #333333; border: 0; cursor: pointer;
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

 label.inline {
    display: inline !important;
    margin-left: 1em;
}

<?php if($enable_signup == 'no') { ?> 

	.ps_my_acc_page{ padding-top: 100px; }
	.ps_my_acc_page .woocommerce{ width:50%; margin: 0 auto; padding: 10px 20px; min-height: 400px; background: linear-gradient(to bottom, rgba(28, 25, 36, 0.22) 0%, rgba(0, 0, 0, 0.6) 100%); opacity: <?php echo $ps_form_background_opacity; ?>; }

<?php } ?>

.woocommerce-error {
    background-color: #e2401c !important;
    list-style: none;
}



.woocommerce-error, .woocommerce-info, .woocommerce-message, .woocommerce-noreviews, p.no-comments {

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

.main{ width: auto; padding: 20px; }

.ps_warning { background-color: #ff9966; width: 97%; padding: 20px; color: #fff; text-align:  center; }

.logoimg{ text-align: center; width: 100%; position: absolute;padding-top : 50px; }

.logoimg img { display: inline; }

.woocommerce-error li, .woocommerce-info li, .woocommerce-message li { padding-left: 21px !important; }

.ps_my_acc_page p{ color: #fff; }

video, #yvid { 
    position: fixed;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    transform: translateX(-50%) translateY(-50%);
  background-size: cover;
  transition: 1s;
}

.erromsg{ margin-top: 170px; }

@media screen and (max-width: 992px) {

	.ps_my_acc_page .u-column1{ width: 100% !important; }
	.ps_my_acc_page .u-column2{ width: 100% !important; margin-top: 50px; }

}

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'no' ) { ?>

	.main{ width: 50%; padding: 20px; margin:0 auto; padding: 10px 20px; min-height: 400px; background: linear-gradient(to bottom, rgba(28, 25, 36, 0.22) 0%, rgba(0, 0, 0, 0.6) 100%); opacity: <?php echo $ps_form_background_opacity; ?>; }

<?php } ?>

<?php if($ps_background == 'video') { ?>

	.logoimg{ position:relative; }

<?php } ?>
	
</style>

</head>
<body>

<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>


<?php 
	if(get_option('ps_background') == 'custom_video') { ?>

		<video id="videp-id" frameborder="0" controls="" allowfullscreen="" autoplay="" loop="" muted="" width="100%" height="100%">
	        <source src="<?php echo get_option('ps_background_custom_video'); ?>" type="video/mp4">
	    </video>



	<?php } else if(get_option('ps_background') == 'youtube_video') { ?>

		<iframe id="yvid" width="100%" height="100%"src="https://www.youtube.com/embed/<?php echo get_option('ps_background_youtube_video') ?>?autoplay=1&loop=1"></iframe> 


	<?php } else {

		$video = "";

	}

?>

 
	


<div class="ps_my_acc_page">
	<div class="logoimg"><img src="<?php echo $logo; ?>" width="400"  /></div>

<div class="main">


<div class="erromsg"><?php wc_print_notices(); ?></div>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="u-columns col2-set" id="customer_login">

	<div class="u-column1 col-1">

<?php endif; ?>

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

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	</div>

	<div class="u-column2 col-2">

		<h2><?php esc_html_e( get_option('signup_title'), 'woocommerce' ); ?></h2>

		<form method="post" class="woocommerce-form woocommerce-form-register register">

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

			<?php endif; ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
				</p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<p class="woocommerce-FormRow form-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<button type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
</div>
</div>
</body>
