<?php
/**
 * WP Bootstrap Starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP_Bootstrap_Starter
 */

if ( ! function_exists( 'wp_bootstrap_starter_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wp_my_costum_scripts()
{
    //js
    wp_enqueue_script('my-jquery-script', get_template_directory_uri() .'/inc/assets/js/jquery.js', array('jquery'), null, true);
    wp_enqueue_script('my-jquery-ui-widget',get_template_directory_uri() .'/inc/assets/js/jquery-ui.js');
    wp_enqueue_script('my-confirm-script', get_template_directory_uri() .'/inc/assets/js/jquery-confirm.min.js');
    wp_enqueue_script('my-costum-script', get_template_directory_uri() .'/inc/assets/js/custom_script.js');
    wp_enqueue_script('my-weekcalendar-js', get_template_directory_uri() .'/inc/assets/js/jquery.weekcalendar.js');
    wp_enqueue_script('my-migrate-js', get_template_directory_uri() .'/inc/assets/js/jquery-migrate.js');
    wp_enqueue_script('my-popup-js', get_template_directory_uri() .'/inc/assets/js/jquery.window.popup.js');
    wp_enqueue_script('wp-bootstrapjs', get_template_directory_uri() . '/inc/assets/js/bootstrap.min.js', array(), '', true );
    wp_enqueue_script('chat_script', get_template_directory_uri().'/inc/assets/js/chat.js');
    wp_enqueue_script('constants', get_template_directory_uri().'/inc/assets/js/const.js');
    wp_enqueue_script('my-notification',get_template_directory_uri() .'/inc/assets/js/notification.js');
    wp_enqueue_script('accueil_script', get_template_directory_uri().'/inc/assets/js/accueil.js');


   
    //css
    wp_enqueue_style( 'my-jquery-ui-style', get_template_directory_uri() .'/inc/assets/css/jquery-ui.css' );
    wp_enqueue_style( 'my-reset-style', get_template_directory_uri() .'/inc/assets/css/reset.css' );
    wp_enqueue_style( 'my-weekcalendar-style', get_template_directory_uri() .'/inc/assets/css/jquery.weekcalendar.css' );
    wp_enqueue_style( 'my-demo-style', get_template_directory_uri() .'/inc/assets/css/demo.css' );
    wp_enqueue_style( 'my-confirm-style', get_template_directory_uri() .'/inc/assets/css/jquery-confirm.min.css' );
    wp_enqueue_style( 'my-costum-style', get_template_directory_uri() .'/inc/assets/css/my-costum-style.css' );
    wp_enqueue_style( 'my-chat-style', get_template_directory_uri() .'/inc/assets/css/chat.css' );
  
}
function wp_bootstrap_starter_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on WP Bootstrap Starter, use a find and replace
	 * to change 'wp-bootstrap-starter' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wp-bootstrap-starter', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'wp-bootstrap-starter' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wp_bootstrap_starter_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

    function wp_boostrap_starter_add_editor_styles() {
        add_editor_style( 'custom-editor-style.css' );
    }
    add_action( 'admin_init', 'wp_boostrap_starter_add_editor_styles' );

}
endif;
add_action( 'after_setup_theme', 'wp_bootstrap_starter_setup' );


/**
 * Add Welcome message to dashboard
 */
add_action('init', 'init_action', 1);
function init_action() 
{
if(!session_id()) {
session_start();
}
}

add_action('wp_logout','end_session');
function end_session() {
session_destroy ();
}
function wp_bootstrap_starter_reminder(){
        $theme_page_url = 'https://afterimagedesigns.com/wp-bootstrap-starter/?dashboard=1';

            if(!get_option( 'triggered_welcomet')){
                $message = sprintf(__( 'Welcome to WP Bootstrap Starter Theme! Before diving in to your new theme, please visit the <a style="color: #fff; font-weight: bold;" href="%1$s" target="_blank">theme\'s</a> page for access to dozens of tips and in-depth tutorials.', 'wp-bootstrap-starter' ),
                    esc_url( $theme_page_url )
                );

                printf(
                    '<div class="notice is-dismissible" style="background-color: #6C2EB9; color: #fff; border-left: none;">
                        <p>%1$s</p>
                    </div>',
                    $message
                );
                add_option( 'triggered_welcomet', '1', '', 'yes' );
            }

}
add_action( 'admin_notices', 'wp_bootstrap_starter_reminder' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_bootstrap_starter_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wp_bootstrap_starter_content_width', 1170 );
}
add_action( 'after_setup_theme', 'wp_bootstrap_starter_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_bootstrap_starter_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'wp-bootstrap-starter' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
	 register_sidebar( array(
        'name'          => esc_html__( 'Sidebar_2', 'wp-bootstrap-starter' ),
        'id'            => 'sidebar-2',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 1', 'wp-bootstrap-starter' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 2', 'wp-bootstrap-starter' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 3', 'wp-bootstrap-starter' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'wp_bootstrap_starter_widgets_init' );
add_action('wp_head','wp_my_costum_scripts');

/**
 * Enqueue scripts and styles.
 */
function wp_bootstrap_starter_scripts() {
	// load bootstrap css
     
   if ( get_theme_mod( 'cdn_assets_setting' ) === 'yes' ) {
        wp_enqueue_style( 'wp-bootstrap-starter-bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css' );
        wp_enqueue_style( 'wp-bootstrap-starter-fontawesome-cdn', 'https://use.fontawesome.com/releases/v5.10.2/css/all.css' );
    } else {
        wp_enqueue_style( 'wp-bootstrap-starter-bootstrap-css', get_template_directory_uri() . '/inc/assets/css/bootstrap.min.css' );
        wp_enqueue_style( 'wp-bootstrap-starter-fontawesome-cdn', get_template_directory_uri() . '/inc/assets/css/fontawesome.min.css' );
    }
	// load bootstrap css
	// load AItheme styles
	// load WP Bootstrap Starter styles
	wp_enqueue_style( 'wp-bootstrap-starter-style', get_stylesheet_uri() );
    if(get_theme_mod( 'theme_option_setting' ) && get_theme_mod( 'theme_option_setting' ) !== 'default') {
        wp_enqueue_style( 'wp-bootstrap-starter-'.get_theme_mod( 'theme_option_setting' ), get_template_directory_uri() . '/inc/assets/css/presets/theme-option/'.get_theme_mod( 'theme_option_setting' ).'.css', false, '' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'poppins-lora') {
        wp_enqueue_style( 'wp-bootstrap-starter-poppins-lora-font', 'https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i|Poppins:300,400,500,600,700' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'montserrat-merriweather') {
        wp_enqueue_style( 'wp-bootstrap-starter-montserrat-merriweather-font', 'https://fonts.googleapis.com/css?family=Merriweather:300,400,400i,700,900|Montserrat:300,400,400i,500,700,800' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'poppins-poppins') {
        wp_enqueue_style( 'wp-bootstrap-starter-poppins-font', 'https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'roboto-roboto') {
        wp_enqueue_style( 'wp-bootstrap-starter-roboto-font', 'https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'arbutusslab-opensans') {
        wp_enqueue_style( 'wp-bootstrap-starter-arbutusslab-opensans-font', 'https://fonts.googleapis.com/css?family=Arbutus+Slab|Open+Sans:300,300i,400,400i,600,600i,700,800' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'oswald-muli') {
        wp_enqueue_style( 'wp-bootstrap-starter-oswald-muli-font', 'https://fonts.googleapis.com/css?family=Muli:300,400,600,700,800|Oswald:300,400,500,600,700' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'montserrat-opensans') {
        wp_enqueue_style( 'wp-bootstrap-starter-montserrat-opensans-font', 'https://fonts.googleapis.com/css?family=Montserrat|Open+Sans:300,300i,400,400i,600,600i,700,800' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'robotoslab-roboto') {
        wp_enqueue_style( 'wp-bootstrap-starter-robotoslab-roboto', 'https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700|Roboto:300,300i,400,400i,500,700,700i' );
    }
    if(get_theme_mod( 'preset_style_setting' ) && get_theme_mod( 'preset_style_setting' ) !== 'default') {
        wp_enqueue_style( 'wp-bootstrap-starter-'.get_theme_mod( 'preset_style_setting' ), get_template_directory_uri() . '/inc/assets/css/presets/typography/'.get_theme_mod( 'preset_style_setting' ).'.css', false, '' );
    }
   
    
    //wp_enqueue_script('autocomplete', get_stylesheet_directory_uri().'/js/jquery.auto-complete.js', array('jquery'));
	
    //wp_enqueue_script('mysite-js', get_stylesheet_directory_uri().'/js/mysite.js', array('jquery', 'autocomplete'));

    //wp_enqueue_style('autocomplete.css', get_stylesheet_directory_uri().'/js/jquery.auto-complete.css');
    //Color Scheme
    /*if(get_theme_mod( 'preset_color_scheme_setting' ) && get_theme_mod( 'preset_color_scheme_setting' ) !== 'default') {
        wp_enqueue_style( 'wp-bootstrap-starter-'.get_theme_mod( 'preset_color_scheme_setting' ), get_template_directory_uri() . '/inc/assets/css/presets/color-scheme/'.get_theme_mod( 'preset_color_scheme_setting' ).'.css', false, '' );
    }else {
        wp_enqueue_style( 'wp-bootstrap-starter-default', get_template_directory_uri() . '/inc/assets/css/presets/color-scheme/blue.css', false, '' );
    }*/


    //wp_enqueue_script('jquery');
    //wp_enqueue_script('jquery-ui-widget');

    // Internet Explorer HTML5 support
    wp_enqueue_script( 'html5hiv',get_template_directory_uri().'/inc/assets/js/html5.js', array(), '3.7.0', false );
    wp_script_add_data( 'html5hiv', 'conditional', 'lt IE 9' );

	// load bootstrap js
    if ( get_theme_mod( 'cdn_assets_setting' ) === 'yes' ) {
        wp_enqueue_script('wp-bootstrap-starter-popper', 'https://cdn.jsdelivr.net/npm/popper.js@1/dist/umd/popper.min.js', array(), '', true );
    	wp_enqueue_script('wp-bootstrap-starter-bootstrapjs', 'https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js', array(), '', true );
    } else {
        wp_enqueue_script('wp-bootstrap-starter-popper', get_template_directory_uri() . '/inc/assets/js/popper.min.js', array(), '', true );
        wp_enqueue_script('wp-bootstrap-starter-bootstrapjs', get_template_directory_uri() . '/inc/assets/js/bootstrap.min.js', array(), '', true );
    }
    
    wp_enqueue_script('wp-bootstrap-starter-themejs', get_template_directory_uri() . '/inc/assets/js/theme-script.min.js', array(), '', true );
	wp_enqueue_script( 'wp-bootstrap-starter-skip-link-focus-fix', get_template_directory_uri() . '/inc/assets/js/skip-link-focus-fix.min.js', array(), '20151215', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_bootstrap_starter_scripts' );



/**
 * Add Preload for CDN scripts and stylesheet
 */
function wp_bootstrap_starter_preload( $hints, $relation_type ){
    if ( 'preconnect' === $relation_type && get_theme_mod( 'cdn_assets_setting' ) === 'yes' ) {
        $hints[] = [
            'href'        => 'https://cdn.jsdelivr.net/',
            'crossorigin' => 'anonymous',
        ];
        $hints[] = [
            'href'        => 'https://use.fontawesome.com/',
            'crossorigin' => 'anonymous',
        ];
    }
    return $hints;
} 

add_filter( 'wp_resource_hints', 'wp_bootstrap_starter_preload', 10, 2 );



function wp_bootstrap_starter_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <div class="d-block mb-3">' . __( "To view this protected post, enter the password below:", "wp-bootstrap-starter" ) . '</div>
    <div class="form-group form-inline"><label for="' . $label . '" class="mr-2">' . __( "Password:", "wp-bootstrap-starter" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" class="form-control mr-2" /> <input type="submit" name="Submit" value="' . esc_attr__( "Submit", "wp-bootstrap-starter" ) . '" class="btn btn-primary"/></div>
    </form>';
    return $o;
}
add_filter( 'the_password_form', 'wp_bootstrap_starter_password_form' );

//  add user id to session 
add_action( 'init', 'process_post' );
 
function process_post() {
    if( !session_id() )
    session_start();
    global $current_user;
    $_SESSION["user_id"]=$current_user->ID;
    
}
function mysite_woocommerce_order_status_completed( $order_id ) {
    //echo "Order complete for orderhhhhhhhhhhhhhhhhhhhhhhh $order_id";
    $order = wc_get_order( $order_id );
    $items = $order->get_items();
    foreach ( $items as $item ) {
    $product_name = $item->get_name();
    $product_id = $item->get_product_id();
    $product_variation_id = $item->get_variation_id();
    $quantity=$item->get_quantity();
    $price=$item->get_total();
    echo $price;
    $nbre_minutes=0;

    switch ($product_id) 
    {
        case 1610:
             $nbre_minutes=PACK_START*$quantity;
             $gain=GAIN_PACK_START;
            break;
        case 1609:
            $nbre_minutes=PACK_GOLD*$quantity;
            $gain=GAIN_PACK_GOLD;
            break;
        case 1633:
            $nbre_minutes=PACK_CONFORT*$quantity;
            $gain=GAIN_PACK_CONFORT;
            break;
        case 1634:
            $nbre_minutes=PACK_DIVIN*$quantity;;
            $gain=GAIN_PACK_DIVIN;
            break;
        case 1635:
            $nbre_minutes=PACK_LUXE*$quantity;
            $gain=GAIN_PACK_LUXE;
            break;
    }
    
    global $wpdb;
    //Ajout du forfait
    $table=$wpdb->prefix."forfait";
   // echo $order->get_payment_method();
    $data=array('client_id'=>$_SESSION['user_id'], 'nbre_minutes'=>$nbre_minutes, 'date_creation'=>date("Y-m-d H:i:s"));
    if(!$wpdb->insert($table,$data))
    {
    echo "forfait non rajouté ";
    wp_die();
    }

    $total_gain=database::gain()+$gain;
    //Ajout du paiement et les methode de paiements 
    $table=$wpdb->prefix."paiement";
    $data=array('paiement_prix'=>$price, 'nbre_minutes'=>$nbre_minutes,'pack_nom'=>$product_name,"pack_id"=>$product_id, 'paiement_date'=>date("Y-m-d H:i:s"),'type_paiement'=>$order->get_payment_method_title(),'client_id'=>$_SESSION['user_id'],"gain"=>$gain);
    $paiement_id=$wpdb->insert($table,$data);
    if(!$paiement_id)
    {
    echo "paiement non rajouté! ";
    wp_die();
    }
    //Ajouter le gain attribué
    $table=$wpdb->prefix."gains";
    $data=array('gain'=>$gain, 'client_id'=>$_SESSION["user_id"],"paiement_id"=>$paiement_id, 'date'=>date("Y-m-d H:i:s"),'type'=>1,'description'=>"Gain de ".$gain."% - ".$product_name);
    if(!$wpdb->insert($table,$data))
    {
    echo "gain non rajouté! ";
    wp_die();
    }
    if($total_gain>100)
    {
    //Ajout de 10 minutes gratuites
    $table=$wpdb->prefix."forfait";
    $data=array('client_id'=>$_SESSION['user_id'], 'nbre_minutes'=>600, 'date_creation'=>date("Y-m-d H:i:s"),"remarque"=>"Gain de 10 minutes gratuites");
    if(!$wpdb->insert($table,$data))
    {
    echo "Gain 100% non rajouté ";
    wp_die();
    }
    //soustraction de 100 de son gain
    $table=$wpdb->prefix."gains";
    $data=array('gain'=>-100, 'client_id'=>$_SESSION["user_id"],"paiement_id"=>$paiement_id, 'date'=>date("Y-m-d H:i:s"),'type'=>2,'description'=>"Gain 100% ,déblocage de 10 minutes gratuites");
    if(!$wpdb->insert($table,$data))
    {
    echo "soustraction de gains impossible ";
    wp_die();
    }
    }
    
}
}

add_action( 'woocommerce_order_status_completed', 'mysite_woocommerce_order_status_completed', 10, 1 );

add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
function custom_woocommerce_auto_complete_order( $order_id ) { 
    if ( ! $order_id ) {
        return;
    }

    $order = wc_get_order( $order_id );
    $order->update_status( 'completed' );
}
function RandomString()
    {
        $characters = '0123456789';
        $randstring = '';
        for ($i = 0; $i < 6; $i++) {
            $randstring .= $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }
    function RandomVoyant()
    {
        $characters = '0123456789';
        $randstring = '';
        for ($i = 0; $i < 4; $i++) {
            $randstring .= $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }
add_action( 'user_register', 'myplugin_registration_save', 10, 1 );
 
function myplugin_registration_save( $user_id ) 
{
 if(database::voyant($user_id))
 {
      $code_expert=RandomVoyant();
      update_user_meta($user_id, 'code_expert',$code_expert);
 }
 else if(database::client($user_id))
 {
     $code_perso=RandomString();
     update_user_meta($user_id, 'code_personnel',$code_perso);
 }
        
       

        
        


 
}
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
    

    <table class="form-table">
    <tr>
        <th><label for="mobile"><?php _e("Numéro mobile"); ?></label></th>
        <td>
            <input type="text" name="mobile" id="mobile" value="<?php echo esc_attr( get_the_author_meta( 'numero_de_tlphone', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Veuillez entrer le numéro de mobile."); ?></span>
        </td>
    </tr>
   
   
   
    </table>
<?php }
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    /*include get_template_directory()."/inc/manager/manager.php";
    if ( empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'update-user_' . $user_id ) ) {
        return;
    }
    
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    $extension=get_the_author_meta( 'extension', $user->ID ) ;
    if(!$extension)
    {
    $ext  =$_POST['extension'];
    $pass=$_POST['pass_asterisk'];
    $manager=new AstMan();
    $output=$manager-> UpdateConfig($ext,$pass);

    }
    else
    {
        
    }*/

    update_user_meta( $user_id, 'numero_de_tlphone', $_POST['mobile'] );
    //update_user_meta( $user_id, 'pass_asterisk', $_POST['pass_asterisk'] );
    //echo "updated";
    
}

function add_datatables_scripts() {
    wp_register_script('datatables', 'https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js', array('jquery'),null, true);
    //wp_enqueue_script('datatables');
  
    wp_register_script('datatables_bootstrap', get_template_directory_uri().'/inc/assets/js/bootstrap-table.js', array('jquery'),null, true);
    wp_enqueue_script('datatables_bootstrap');
  }
   
  function add_datatables_style() {
      
    wp_register_style('bootstrap_style', 'https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.css');
    wp_enqueue_style('bootstrap_style');

  
    wp_register_style('datatables_style', 'https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css');
    wp_enqueue_style('datatables_style');
  }
   
  add_action('wp_head', 'add_datatables_scripts');
  add_action('wp_head', 'add_datatables_style');
  
/**
 * Implement the shortcodes.
 */
require get_template_directory() . '/inc/shortCodes.php';
require get_template_directory() . '/inc/consultationEmail.php';
require get_template_directory() . '/inc/popups.php';
require get_template_directory() . '/inc/popups1.php';
require get_template_directory() . '/inc/controller/controller.php';
require get_template_directory() . '/inc/consultations.php';



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load plugin compatibility file.
 */
require get_template_directory() . '/inc/plugin-compatibility/plugin-compatibility.php';

/**
 * Load custom WordPress nav walker.
 */
if ( ! class_exists( 'wp_bootstrap_navwalker' )) {
    require_once(get_template_directory() . '/inc/wp_bootstrap_navwalker.php');
}
require get_template_directory().'/inc/controller/config_controller.php';


add_filter( 'woocommerce_checkout_fields' , 'bbloomer_simplify_checkout_virtual' );
 
function bbloomer_simplify_checkout_virtual( $fields ) {
    
   $only_virtual = true;
    
   foreach( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
      // Check if there are non-virtual products
      if ( ! $cart_item['data']->is_virtual() ) $only_virtual = false;   
   }
     
    if( $only_virtual ) {
       unset($fields['billing']['billing_company']);
       unset($fields['billing']['billing_address_1']);
       unset($fields['billing']['billing_address_2']);
       unset($fields['billing']['billing_city']);
       unset($fields['billing']['billing_postcode']);
       unset($fields['billing']['billing_country']);
       unset($fields['billing']['billing_state']);
       unset($fields['billing']['billing_phone']);
       add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );
     }
     
     return $fields;
}

add_filter( 'woocommerce_checkout_fields' , 'override_billing_checkout_fields', 20, 1 );

function override_billing_checkout_fields( $fields ) {
    $fields['billing']['billing_first_name']['placeholder'] = 'Votre prénom';
    $fields['billing']['billing_last_name']['placeholder'] = 'Votre nom';
    $fields['billing']['billing_email']['placeholder'] = 'Email';
    return $fields;
}


add_action('wp_ajax_nopriv_reponse_admin', 'reponse_admin'); 
add_action('wp_ajax_reponse_admin', 'reponse_admin'); 
// If the user in not logged in

function reponse_admin()
{
    global $wpdb;
      
$file=null;
    $url=null;
    $id=$_POST['id'];
    $reponse=$_POST["reponse"];
    $user_id=$_POST["user_id"];
    $user_info = get_userdata($user_id);
    $mail = $user_info->user_email;
    $info_client = $user_info->first_name.' '.$user_info->last_name;
   
   
    function my_custom_email_content_type( $content_type ) {
        return 'text/html';
    }

    
    $to        = $mail;
    $subject   = 'Réponse DIVINCIA';
    $reponse   = $reponse;
    $headers[] = 'From: ' . get_option( 'blogname' ) ;

    add_filter(
        'wp_mail_content_type',
        'my_custom_email_content_type'
    );
    $wp_mail_return = wp_mail(
        $to,
        $subject,
        $reponse,
        $headers
       
    );
    var_dump($wp_mail_return);
    if( $wp_mail_return ) {
    $table=$wpdb->prefix.'plaintes';
        $data_update = array('reponse'=>$reponse,"statut"=>1,'date'=>date('Y-m-d H:i:s'));
        $data_where = array('id' => $id);
        if($wpdb->update($table , $data_update, $data_where))
        wp_send_json_success ("true") ;
        else 
        wp_send_json_error ($wpdb->last_error) ; 
    }
    else 
    echo "je suıs envoyeeeeee";
    remove_filter(
        'wp_mail_content_type',
        'my_custom_email_content_type'
    );

    die(0);

}
function mysite_admin_menu(){
    add_datatables_scripts();
    add_datatables_style();
    wp_register_style('my-style', get_template_directory_uri().'/admin/assets/css/style.css');
    wp_enqueue_style('my-style');

    
    include_once( get_template_directory() . '/admin/controller/controller.php');
    include_once(get_template_directory()."/admin/controller/controller2.php");
    add_menu_page('Divincia', 'Divincia', 'manage_options', 'divincia-slug', 'members_function');
    add_submenu_page( 'divincia-slug', 'Mon tableau de bord', 'Mon tableau de bord', 'manage_options', 'tableau-bord-slug', 'tableau_bord_function');
    add_submenu_page( 'divincia-slug', 'Suivi d\'activité', 'Suivi d\'activité', 'manage_options', 'suivi-activite-slug', 'suivi_activite_function');
    
    add_menu_page('SERVICE CLIENTÈLE', 'SERVICE CLIENTÈLE', 'manage_options', 'service-client-slug', null);
    add_submenu_page( 'service-client-slug', 'Modération des avis', 'Modération des avis', 'manage_options', 'moderation_avis-slug', 'moderation_avis_function');
    add_submenu_page( 'service-client-slug', 'Message clients', 'Message clients', 'manage_options', 'message-client-slug', 'message_client_function');
    add_submenu_page( 'service-client-slug', 'Recherche client', 'Recherche client', 'manage_options', 'recherche-client-slug', 'recherche_client_function');
   

    add_submenu_page( 'null', 'Profil voyant', 'Profil voyant', 'manage_options', 'profil-voyant-slug', 'profil_voyant_function');
    add_submenu_page( 'null', 'Profil client', 'Profil client', 'manage_options', 'profil-client-slug', 'profil_client_function');
    add_submenu_page( 'null', 'Consultation tel', 'Consultation tel', 'manage_options', 'consultation-tel-slug', 'consultation_tel_function');
    add_submenu_page( 'null', 'Consultation mail', 'Consultation mail', 'manage_options', 'consultation-mail-slug', 'consultation_mail_function');
    add_submenu_page( 'null', 'Consultation tchat', 'Consultation tchat', 'manage_options', 'consultation-tchat-slug', 'consultation_tchat_function');

    
}
     
add_action('admin_menu', 'mysite_admin_menu');


