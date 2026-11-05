<?php 

if (! defined('ABSPATH') ) { 
    exit; // restict for direct access
}


if (!class_exists('Admin_Class_Addify_Private_Shop') ) {

    class Admin_Class_Addify_Private_Shop extends Addify_Private_Shop
    {

        function __construct()
        {

            add_action('admin_menu', array( $this, 'custom_menu_admin' ));
            add_action('admin_init', array($this, 'addify_private_shop_options'));
            add_action('admin_enqueue_scripts', array( $this, 'admin_assets' ));

            add_filter('manage_users_columns', array( $this, 'ps_add_status_column' ));
            add_filter('manage_users_custom_column', array( $this, 'ps_status_column' ), 10, 3);
            add_filter('user_row_actions', array( $this, 'ps_user_row_actions' ), 10, 2);
            add_action('load-users.php', array( $this, 'ps_update_action' ));
        }

        public function custom_menu_admin()
        {    
            
            add_menu_page(
                __('Private Shop', 'addify_ps'), // page title 
                __('Private Shop', 'addify_ps'), // menu title
                'manage_options', // capability
                'addify-private-shop',  // menu-slug
                array($this, 'private_shop_settings'),   // function that will render its output
                plugins_url('assets/img/small_logo_white.png',  __FILE__),   // link to the icon that will be displayed in the sidebar
                '7'    // position of the menu option
            );
        }

        public function ps_add_status_column( $columns )
        {
            $the_columns['ps_new_user_status'] = __('Status', 'addify_ps');

            $newcol = array_slice($columns, 0, -1);
            $newcol = array_merge($newcol, $the_columns);
            $columns = array_merge($newcol, array_slice($columns, 1));

            return $columns;
        }


        public function ps_status_column( $data, $column_name, $user_id )
        {
            
            $status = get_user_meta($user_id, 'ps_new_user_status', true);
            if($status == 'approved') {
                $ustatus = __('Approved', 'addify_ps');
            } else if($status == 'pending') {

                $ustatus = __('Pending', 'addify_ps');
            } else {
                $ustatus = __('', 'addify_ps');
            }

            return $ustatus;
                    
        }


        public function ps_user_row_actions($actions, $user)
        {

            if ($user->ID == get_current_user_id() ) {
                return $actions;
            }

            if (is_super_admin($user->ID) ) {
                return $actions;
            }

            $user_status = $status = get_user_meta($user->ID, 'ps_new_user_status', true);

            $approve_link = add_query_arg(array( 'action' => 'approved', 'user' => $user->ID ));
            $approve_link = remove_query_arg(array( 'new_role' ), $approve_link);
            $approve_link = wp_nonce_url($approve_link, 'addify-private-shop');


            $approve_action = '<a href="' . esc_url($approve_link) . '">' . __('Approve', 'addify_anu') . '</a>';
            

            if ($user_status == 'pending' ) {
                $actions[] = $approve_action;
                
            } 

            return $actions;

        }


        function ps_update_action()
        {
            if (isset($_GET['action']) && in_array($_GET['action'], array( 'approved', 'denied' )) && !isset($_GET['new_role']) ) {
                check_admin_referer('addify-private-shop');

                $sendback = remove_query_arg(array( 'approved', 'deleted', 'ids', 'ps-status-query-submit', 'new_role' ), wp_get_referer());
                if (!$sendback ) {
                    $sendback = admin_url('users.php');
                }

                $wp_list_table = _get_list_table('WP_Users_List_Table');
                $pagenum = $wp_list_table->get_pagenum();
                $sendback = add_query_arg('paged', $pagenum, $sendback);

                $status = sanitize_key($_GET['action']);
                $user = absint($_GET['user']);

                update_user_meta($user, 'ps_new_user_status', $status);

                if ($_GET['action'] == 'approved' ) {
                    $sendback = add_query_arg(array( 'approved' => 1, 'ids' => $user ), $sendback);

                    $userr = new WP_User($user);

                    $user_login = stripslashes($userr->data->user_login);
                    $user_email = stripslashes($userr->data->user_email);

                    // Always set content-type when sending HTML email
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                    $admin_email = get_option('admin_email');
                    if (empty($admin_email) ) {
                        $admin_email = 'support@' . $_SERVER['SERVER_NAME'];
                    }

                    $fromname = get_option('blogname');

                    // More headers
                    $headers .= 'From: '.$fromname.'<'.$admin_email.'>' . "\r\n";

                    $to = $userr->data->user_email;
                    $subject = get_option('ps_approved_email_message_subject');

                    

                    $message = "
						<html>
							<head>
								
							</head>
							<body>
								<p>".get_option('ps_approved_email_message_text')."</p>
								
							</body>
						</html>
						";


                    wp_mail($to, $subject, $message, $headers);
                } 

                wp_redirect($sendback);
                exit;
            }
        }

        public function admin_assets()
        {


            $screen = get_current_screen();

            if($screen->id == 'toplevel_page_addify-private-shop') {

                wp_enqueue_style('addify_ps_admin_css', plugins_url('/assets/css/addify_ps_admin_css.css', __FILE__), false);
                wp_enqueue_script('color_spectrum_js', plugins_url('/assets/js/color_spectrum.js', __FILE__), array('jquery'), false);
                wp_enqueue_script('addify_ps_admin_js', plugins_url('/assets/js/addify_ps_admin_js.js', __FILE__), array('jquery'), false);
                wp_enqueue_style('color_spectrum_css', plugins_url('/assets/css/color_spectrum.css', __FILE__), false);

                wp_enqueue_style('thickbox');
                wp_enqueue_script('thickbox');
                wp_enqueue_script('media-upload'); 
                wp_enqueue_media();

                //select2 css and js
                wp_enqueue_script('jquery');
                wp_enqueue_style('addify_ps-select2-css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css', false);
                wp_enqueue_style('addify_ps-select2-bscss', 'https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2-bootstrap.css', false);
                wp_enqueue_script('addify_ps-select2-js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js', false);
            }
        }


        public function private_shop_settings()
        { 

            if(isset($_GET[ 'tab' ]) ) {  
                   $active_tab = $_GET[ 'tab' ];  
            } else {
                $active_tab = 'tab_one';
            }
            ?>

            <div class="wrap">
                <h2><?php _e('Private Shop Settings', 'addify_ps'); ?></h2>

                <div class="description"><?php _e('Manage your private shop settings from here!', 'addify_ps'); ?></div>
                <?php settings_errors(); ?> 

                <h2 class="nav-tab-wrapper">  
                    <a href="?page=addify-private-shop&tab=tab_one" class="nav-tab <?php echo $active_tab == 'tab_one' ? 'nav-tab-active' : ''; ?>"><?php _e('General Settings', 'addify_ps'); ?></a>  
                    <a href="?page=addify-private-shop&tab=tab_two" class="nav-tab <?php echo $active_tab == 'tab_two' ? 'nav-tab-active' : ''; ?>"><?php _e('Access Control Settings', 'addify_ps'); ?></a> 

                    <a href="?page=addify-private-shop&tab=tab_three" class="nav-tab <?php echo $active_tab == 'tab_three' ? 'nav-tab-active' : ''; ?>"><?php _e('Manually Approve New Customers', 'addify_ps'); ?></a>  
                </h2>

                <form method="post" action="options.php"> 
                    <?php
                    if($active_tab == 'tab_one' ) {  

                        settings_fields('setting-group-1');
                        do_settings_sections('addify-private-shop-1');

                    } else if($active_tab == 'tab_two' ) {

                        settings_fields('setting-group-2');
                        do_settings_sections('addify-private-shop-2');

                    } else if($active_tab == 'tab_three' ) {

                        settings_fields('setting-group-3');
                        do_settings_sections('addify-private-shop-3');

                    }
                    ?>
                    <?php submit_button(); ?> 
                </form> 



                <p><b>Thank You for Using Our Private Store Plugin, For Support Enquiries Please Contact at “info@addifypro.com”. If you like our product, please give us a 5-star ratings. <a href="https://codecanyon.net/item/woocommerce-private-store-plugin-shop-for-registered-user-only/reviews/21967197" target="_self">Rate Now</a></b>
                </p>


            </div>

               <?php

        }      

        public function addify_private_shop_options()
        {

            add_settings_section(  
                'page_1_section',         // ID used to identify this section and with which to register options  
                __('Display & Background Settings', 'addify_ps'),                  // Title to be displayed on the administration page  
                array($this, 'page_1_section_callback'), // Callback used to render the description of the section  
                'addify-private-shop-1'                           // Page on which to add this section of options  
            );

            add_settings_section(  
                'page_2_section',         // ID used to identify this section and with which to register options  
                __('Access Control Settings', 'addify_ps'),                  // Title to be displayed on the administration page  
                array($this, 'page_2_section_callback'), // Callback used to render the description of the section  
                'addify-private-shop-2'                           // Page on which to add this section of options  
            );


            add_settings_section(  
                'page_3_section',         // ID used to identify this section and with which to register options  
                __('Manually Approve New Customers', 'addify_ps'),                  // Title to be displayed on the administration page  
                array($this, 'page_3_section_callback'), // Callback used to render the description of the section  
                'addify-private-shop-3'                           // Page on which to add this section of options  
            );

            add_settings_field(   
                'ps_default_login',                      // ID used to identify the field throughout the theme  
                __('Login/Registration Page', 'addify_ps'),                           // The label to the left of the option interface element  
                array($this, 'ps_default_login_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-1',                          // The page on which this option will be displayed  
                'page_1_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('Choose which page you want to use for Login/Registration.', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-1',  
                'ps_default_login'  
            );


            add_settings_field(   
                'ps_custom_url_login',                      // ID used to identify the field throughout the theme  
                '<div class="cus_url_login">'.__('Custom URL', 'addify_ps').'</div>',                          // The label to the left of the option interface element  
                array($this, 'ps_custom_url_login_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-1',                          // The page on which this option will be displayed  
                'page_1_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('Provide a custom URL where you want to redirect user, this can be from your website or any other external link (e.g http://wwww.example.com).', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-1',  
                'ps_custom_url_login'  
            );

            add_settings_field(   
                'login_title',                      // ID used to identify the field throughout the theme  
                '<div class="def_login">'.__('Login Title', 'addify_ps').'</div>',                           // The label to the left of the option interface element  
                array($this, 'login_title_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-1',                          // The page on which this option will be displayed  
                'page_1_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('This login title will be shown on the login form on frontend.', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-1',  
                'login_title'  
            );



            add_settings_field(   
                'signup_title',                      // ID used to identify the field throughout the theme  
                '<div class="def_login">'.__('Signup Title', 'addify_ps').'</div>',                           // The label to the left of the option interface element  
                array($this, 'signup_title_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-1',                          // The page on which this option will be displayed  
                'page_1_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('This signup title will be shown on the registration form on frontend.', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-1',  
                'signup_title'  
            );


            add_settings_field(   
                'ps_background',                      // ID used to identify the field throughout the theme  
                '<div class="def_login">'.__('Background', 'addify_ps').'</div>',                           // The label to the left of the option interface element  
                array($this, 'ps_background_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-1',                          // The page on which this option will be displayed  
                'page_1_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('This is the page background of login/signup form page.', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-1',  
                'ps_background'  
            );

            add_settings_field(   
                'ps_background_colour',                      // ID used to identify the field throughout the theme  
                '<div class="back_colour def_login">'.__('Background Colour', 'addify_ps').'</div>',                           // The label to the left of the option interface element  
                array($this, 'ps_background_colour_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-1',                          // The page on which this option will be displayed  
                'page_1_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('This is the background colour of login/signup form page.', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-1',  
                'ps_background_colour'  
            );

            add_settings_field(   
                'ps_background_image',                      // ID used to identify the field throughout the theme  
                '<div class="back_image def_login">'.__('Background Image', 'addify_ps').'</div>',                           // The label to the left of the option interface element  
                array($this, 'ps_background_image_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-1',                          // The page on which this option will be displayed  
                'page_1_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('This is the background image of login/signup form page.', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-1',  
                'ps_background_image'  
            );


            add_settings_field(   
                'ps_background_custom_video',                      // ID used to identify the field throughout the theme  
                '<div class="back_video def_login customvideo">'.__('Custom Video', 'addify_ps').'</div>',                           // The label to the left of the option interface element  
                array($this, 'ps_background_custom_video_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-1',                          // The page on which this option will be displayed  
                'page_1_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('Upload your custom video for login/signup page.', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-1',  
                'ps_background_custom_video'  
            );

            add_settings_field(   
                'ps_background_youtube_video',                      // ID used to identify the field throughout the theme  
                '<div class="back_video def_login youtubevideo">'.__('YouTube Video', 'addify_ps').'</div>',                           // The label to the left of the option interface element  
                array($this, 'ps_background_youtube_video_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-1',                          // The page on which this option will be displayed  
                'page_1_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('Add your YouTube video ID like (6lt2JfJdGSY) for login/signup page. Do not put complete video URL only enter video ID that come after this URL (https://www.youtube.com/watch?v=)', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-1',  
                'ps_background_youtube_video'  
            );


            add_settings_field(   
                'ps_form_background_opacity',                      // ID used to identify the field throughout the theme  
                '<div class="def_login">'.__('Form Background Opacity', 'addify_ps').'</div>',                           // The label to the left of the option interface element  
                array($this, 'ps_form_background_opacity_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-1',                          // The page on which this option will be displayed  
                'page_1_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('Please use values between 0 and 1 for example 0.4 or 0.18 etc.', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-1',  
                'ps_form_background_opacity'  
            );


            add_settings_field(   
                'woocommerce_enable_myaccount_registration',                      // ID used to identify the field throughout the theme  
                '<div class="def_login">'.__('Enable Signup', 'addify_ps').'</div>',                           // The label to the left of the option interface element  
                array($this, 'ps_enable_signup_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-1',                          // The page on which this option will be displayed  
                'page_1_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('Enable or Disable registration for private users.', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-1',  
                'woocommerce_enable_myaccount_registration'  
            );

            add_settings_field(   
                'ps_upload_logo',                      // ID used to identify the field throughout the theme  
                '<div class="def_login">'.__('Upload Logo', 'addify_ps').'</div>',                           // The label to the left of the option interface element  
                array($this, 'ps_upload_logo_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-1',                          // The page on which this option will be displayed  
                'page_1_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('This logo will be shown on the addify registation/login page.', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-1',  
                'ps_upload_logo'  
            );

            //add_settings_field (   
              //  'ps_restrict_new_users',                      // ID used to identify the field throughout the theme  
             //__('Restrict New Users', 'addify_ps'),                           // The label to the left of the option interface element  
             //array($this, 'ps_restrict_new_users_callback'),   // The name of the function responsible for rendering the option interface  
             //'addify-private-shop-1',                          // The page on which this option will be displayed  
             //'page_1_section',         // The name of the section to which this field belongs  
             //array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                  //  __('Do you want to validate new users OR all new users have access to webstore.', 'addify_ps'),
             //)  
            //);  
            //register_setting(  
              //  'setting-group-1',  
             //'ps_restrict_new_users'  
            //);

            //add_settings_field (   
              //  'ps_new_account_message',                      // ID used to identify the field throughout the theme  
             //__('New Account Message', 'addify_ps'),                           // The label to the left of the option interface element  
             //array($this, 'ps_new_account_message_callback'),   // The name of the function responsible for rendering the option interface  
             //'addify-private-shop-1',                          // The page on which this option will be displayed  
             //'page_1_section',         // The name of the section to which this field belongs  
             //array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                  //  __('This message will be displayed after registration of restricted users. You can use HTML tags, images, links etc. If you set Restrict New Users to No then this message will not be displayed and user is redirected to My Account Page.', 'addify_ps'),
             //)  
            //);  
            //register_setting(  
              //  'setting-group-1',  
             //'ps_new_account_message'  
            //);


            //Access Control Setting Tab

            add_settings_field(   
                'ps_privatize',                      // ID used to identify the field throughout the theme  
                __('Privatize', 'addify_ps'),                           // The label to the left of the option interface element  
                array($this, 'ps_privatize_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-2',                          // The page on which this option will be displayed  
                'page_2_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('Restrict users to whole website or selected Products, Categories or Pages.', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-2',  
                'ps_privatize'  
            );

            add_settings_field(   
                'ps_privatize_products',                      // ID used to identify the field throughout the theme  
                '<div class="ps_privatize_products">'.__('Private Products', 'addify_ps').'</div>',                           // The label to the left of the option interface element  
                array($this, 'ps_privatize_products_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-2',                          // The page on which this option will be displayed  
                'page_2_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('Start by typing the first letters of the product name, then select the product from the drop-down list.', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-2',  
                'ps_privatize_products'  
            );


            add_settings_field(   
                'ps_privatize_categories',                      // ID used to identify the field throughout the theme  
                '<div class="ps_privatize_products">'.__('Private Categories', 'addify_ps').'</div>',                           // The label to the left of the option interface element  
                array($this, 'ps_privatize_categories_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-2',                          // The page on which this option will be displayed  
                'page_2_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('Select Categories that you want to make private.', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-2',  
                'ps_privatize_categories'  
            );



            add_settings_field(   
                'ps_privatize_pages',                      // ID used to identify the field throughout the theme  
                '<div class="ps_privatize_products">'.__('Private Pages', 'addify_ps').'</div>',                           // The label to the left of the option interface element  
                array($this, 'ps_privatize_pages_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-2',                          // The page on which this option will be displayed  
                'page_2_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('Select Pages that you want to make private.', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-2',  
                'ps_privatize_pages'  
            );

            add_settings_field(   
                'ps_redirect_login',                      // ID used to identify the field throughout the theme  
                __('Redirect After Login', 'addify_ps'),                           // The label to the left of the option interface element  
                array($this, 'ps_redirect_login_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-2',                          // The page on which this option will be displayed  
                'page_2_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('Select where you want to redirect users after login.', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-2',  
                'ps_redirect_login'  
            );

            add_settings_field(   
                'ps_redirect_custom_url',                      // ID used to identify the field throughout the theme  
                '<div class="ps_customURL">'.__('Custom URL', 'addify_ps').'</div>',                            // The label to the left of the option interface element  
                array($this, 'ps_redirect_custom_url_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-2',                          // The page on which this option will be displayed  
                'page_2_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('Provide URL where you want to redirect user after login, this can be any URL form your website or outside of your website.', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-2',  
                'ps_redirect_custom_url'  
            );

            add_settings_field(   
                'ps_allowed_ips',                      // ID used to identify the field throughout the theme  
                __('Allowed IPs', 'addify_ps'),                           // The label to the left of the option interface element  
                array($this, 'ps_allowed_ips_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-2',                          // The page on which this option will be displayed  
                'page_2_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('Add comma(,) separated ips that you want to allowed.', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-2',  
                'ps_allowed_ips'  
            );

            add_settings_field(   
                'ps_goolge',                      // ID used to identify the field throughout the theme  
                __('Allow Google to crawl', 'addify_ps'),                           // The label to the left of the option interface element  
                array($this, 'ps_goolge_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-2',                          // The page on which this option will be displayed  
                'page_2_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('Do you want Google searchbot to access the webstore for SEO?.', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-2',  
                'ps_goolge'  
            );






            add_settings_field(   
                'ps_manual_approve_customer',                      // ID used to identify the field throughout the theme  
                __('Enable Manually Approve New Customers?', 'addify_ps'),                           // The label to the left of the option interface element  
                array($this, 'ps_manual_approve_customer_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-3',                          // The page on which this option will be displayed  
                'page_3_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __('If you enable this then new customers must be approved by admin manually.', 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-3',  
                'ps_manual_approve_customer'  
            );



            add_settings_field(   
                'ps_message_for_pending',                   
                __("Message for Users when Account is pending for approval", 'addify_ps'),                           // The label to the left of the option interface element  
                array($this, 'ps_message_for_pending_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-3',                          // The page on which this option will be displayed  
                'page_3_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __("This will be displayed when user account is pending for admin approval.", 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-3',  
                'ps_message_for_pending'  
            );


            add_settings_field(   
                'ps_approval_email_message_subject',                   
                __("Approval Email Subject", 'addify_ps'),                           // The label to the left of the option interface element  
                array($this, 'ps_approval_email_message_subject_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-3',                          // The page on which this option will be displayed  
                'page_3_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __("This is the email subject; this subject is used when email is sent to user on account creation to inform that account is created but needs to be approved by administrator.", 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-3',  
                'ps_approval_email_message_subject'  
            );


            add_settings_field(   
                'ps_approval_email_message_text',                   
                __("Approval Email Message", 'addify_ps'),                           // The label to the left of the option interface element  
                array($this, 'ps_approval_email_message_text_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-3',                          // The page on which this option will be displayed  
                'page_3_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __("This is the email text, this text will be used when email sent to user on account creation to inform that acccount is created but need to approved by administrator.", 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-3',  
                'ps_approval_email_message_text'  
            );



            add_settings_field(   
                'ps_approved_email_message_subject',                   
                __("Approved Email Subject", 'addify_ps'),                           // The label to the left of the option interface element  
                array($this, 'ps_approved_email_message_subject_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-3',                          // The page on which this option will be displayed  
                'page_3_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __("This is the approved email subject, this subject is when used when account is approved by administrator.", 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-3',  
                'ps_approved_email_message_subject'  
            );


            add_settings_field(   
                'ps_approved_email_message_text',                   
                __("Approved Email Message", 'addify_ps'),                           // The label to the left of the option interface element  
                array($this, 'ps_approved_email_message_text_callback'),   // The name of the function responsible for rendering the option interface  
                'addify-private-shop-3',                          // The page on which this option will be displayed  
                'page_3_section',         // The name of the section to which this field belongs  
                array(                              // The array of arguments to pass to the callback. In this case, just a description.  
                    __("This is the approved email message, this message is used when account is approved by administrator.", 'addify_ps'),
                )  
            );  
            register_setting(  
                'setting-group-3',  
                'ps_approved_email_message_text'  
            );



            
            



        }

        function page_1_section_callback()
        {  
            echo '<p>'._e('Enter private shop form display and background settings here.', 'addify_ps').'</p>';  
        } // function page_1_section_callback

        function page_2_section_callback()
        {  
            echo '<p>'._e('From here you can choose Privatize whole webstore or selected Categories, Products or Pages.', 'addify_ps').'</p>';  
        } // function page_2_section_callback


        function page_3_section_callback()
        {  
            
        } // function page_3_section_callback


        function ps_default_login_callback($args)
        {  
            ?>
            
            <input onchange="getDefLogin(this.value)" type="radio" name="ps_default_login" id="ps_default_login" value="default" <?php echo checked('default', get_option('ps_default_login')); ?> /> <?php _e("WooCommerce Default", "addify_ps"); ?>
            <input onchange="getDefLogin(this.value)" type="radio" name="ps_default_login" id="ps_default_login" value="custom"  <?php echo checked('custom', get_option('ps_default_login')); ?> <?php if(get_option('ps_default_login') == '') { echo "checked";} ?> /> <?php _e("Addify Designed Page", "addify_ps"); ?>
            
            <input onchange="getDefLogin(this.value)" type="radio" name="ps_default_login" id="ps_default_login" value="custom_url"  <?php echo checked('custom_url', get_option('ps_default_login')); ?>/> <?php _e("Custom URL", "addify_ps"); ?>
            <input onchange="getDefLogin(this.value)" type="radio" name="ps_default_login" id="ps_default_login" value="addify_popup"  <?php echo checked('addify_popup', get_option('ps_default_login')); ?>/> <?php _e("Addify Popup(Only for Selected Items and only works on shop page 'Login' button.)", "addify_ps"); ?>

            <p class="description ps_default_login"> <?php echo $args[0] ?> </p>
            <?php      
        } // end ps_default_login_callback 



        function ps_custom_url_login_callback($args)
        {  
            ?>
            <div class="cus_url_login">
                <input type="text" id="login_title" class="login_title" name="ps_custom_url_login" value="<?php echo get_option('ps_custom_url_login') ?>">
                <p class="description ps_custom_url_login"> <?php echo $args[0] ?> </p>
            </div>
            <?php      
        } // end ps_custom_url_login_callback 



        function login_title_callback($args)
        {  
            ?>
            <div class="def_login">
                <input type="text" id="login_title" class="login_title" name="login_title" value="<?php echo get_option('login_title') ?>">
                <p class="description login_title"> <?php echo $args[0] ?> </p>
            </div>
            <?php      
        } // end login_title_callback 


        function signup_title_callback($args)
        {  
            ?>
            <div class="def_login">
                <input type="text" id="signup_title" class="login_title" name="signup_title" value="<?php echo get_option('signup_title') ?>">
                <p class="description signup_title"> <?php echo $args[0] ?> </p>
            </div>
            <?php      
        } // end signup_title_callback 


        function ps_background_callback($args)
        {  
            ?>
            <div class="def_login">
                <select id="ps_background" class="login_title" name="ps_background" onchange="showCoImg(this.value)">
                    <option value="none" <?php echo selected('none', get_option('ps_background')); ?>><?php _e('None', 'addify_ps'); ?></option>
                    <option value="colour" <?php echo selected('colour', get_option('ps_background')); ?>><?php _e('Colour', 'addify_ps'); ?></option>
                    <option value="image" <?php echo selected('image', get_option('ps_background')); ?>><?php _e('Image', 'addify_ps'); ?></option>
                    <option value="youtube_video" <?php echo selected('youtube_video', get_option('ps_background')); ?>><?php _e('YouTube Video', 'addify_ps'); ?></option>
                    <option value="custom_video" <?php echo selected('custom_video', get_option('ps_background')); ?>><?php _e('Custom Video', 'addify_ps'); ?></option>
                    
                </select>
                <p class="description ps_background"> <?php echo $args[0] ?> </p>
            </div>
            <?php      
        } // end ps_background_callback 


        function ps_background_colour_callback($args)
        {  
            ?>
            <div class="back_colour def_login">
                <input type="text" class="login_title color_sepctrum" name="ps_background_colour" id="ps_background_colour" value="<?php echo get_option('ps_background_colour') ?>" />
                <p class="description ps_background_colour"> <?php echo $args[0] ?> </p>
            </div>
            <script>
                jQuery(".color_sepctrum").spectrum({
                    color: "<?php echo get_option('ps_background_colour') ?>",
                    preferredFormat: "hex",
                });
            </script>
           
            <?php      
        } // end ps_background_colour_callback 


        function ps_background_image_callback($args)
        {  
            ?>

            <div class="back_image def_login">
                <div class="imgdis" id="imgdisplay">
                
                    <img src="<?php echo get_option('ps_background_image') ?>" width="200" />
                
                </div>

                <input type="hidden" value="<?php echo get_option('ps_background_image') ?>" name="ps_background_image" id="ps_image_url" class="login_title">
                <input onClick="ps_image()"   type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload">
                <p class="description ps_background_colour"> <?php echo $args[0] ?> </p>
            </div>

            
            <?php      
        } // end ps_background_image_callback 


        


        function ps_background_custom_video_callback($args)
        {  
            ?>

            <div class="back_video def_login customvideo">
               
               <p class="notee"><?php echo esc_html__("Note: Video only works in Addify Designed Page, it will not work on Addify Popup.", "addify_ps"); ?></p>
                <div class="imgdis">
                    <video id="videp-id" frameborder="0" controls width="500">
                        <source src="<?php echo get_option('ps_background_custom_video') ?>" type="video/mp4">
                    </video>
                </div>
                
                

                <input type="hidden" value="<?php echo get_option('ps_background_custom_video') ?>" name="ps_background_custom_video" id="ps_video_url" class="login_title">
                <input onClick="ps_video()"   type="button" name="upload-btn" id="upload-video-btn" class="button-secondary" value="Upload Video">
                <p class="description ps_background_custom_video"> <?php echo $args[0] ?> </p>
            </div>

            
            <?php      
        } // end ps_background_custom_video_callback 



        function ps_background_youtube_video_callback($args)
        {  
            ?>

            <div class="back_video def_login youtubevideo">
                <p class="notee"><?php echo esc_html__("Note: Video only works in Addify Designed Page, it will not work on Addify Popup.", "addify_ps"); ?></p>
                <div class="imgdis">
                    <iframe id="yvid" width="500" height="300" src="https://www.youtube.com/embed/<?php echo get_option('ps_background_youtube_video') ?>"></iframe> 
                </div>
               
                 <input type="text" class="login_title" name="ps_background_youtube_video" id="ps_background_youtube_video" value="<?php echo get_option('ps_background_youtube_video') ?>" />
                <p class="description ps_background_youtube_video"> <?php echo $args[0] ?> </p>
            </div>

            
            <?php      
        } // end ps_background_youtube_video_callback 



        function ps_form_background_opacity_callback($args)
        {  
            ?>
            <div class="def_login">
                <input type="text" class="login_title" name="ps_form_background_opacity" id="ps_form_background_opacity" value="<?php echo get_option('ps_form_background_opacity') ?>" />
                <p class="description ps_form_background_opacity"> <?php echo $args[0] ?> </p>
            </div>
           
            <?php      
        } // end ps_form_background_opacity_callback


        function ps_enable_signup_callback($args)
        {  
            ?>
            <div class="def_login">
                <select id="woocommerce_enable_myaccount_registration" class="login_title" name="woocommerce_enable_myaccount_registration">
                    <option value="yes" <?php echo selected('yes', get_option('woocommerce_enable_myaccount_registration')); ?>><?php _e('Yes', 'addify_ps'); ?></option>
                    <option value="no" <?php echo selected('no', get_option('woocommerce_enable_myaccount_registration')); ?>><?php _e('No', 'addify_ps'); ?></option>
                </select>
                <p class="description woocommerce_enable_myaccount_registration"> <?php echo $args[0] ?> </p>
            </div>
            <?php      
        } // end ps_enable_signup_callback 


        function ps_upload_logo_callback($args)
        {  
            ?>

            <div class="def_login">
                <div class="imgdis" id="logodisplay">
                
                    <img src="<?php echo get_option('ps_upload_logo') ?>" width="200" />
                
                </div>

                <input type="hidden" value="<?php echo get_option('ps_upload_logo') ?>" name="ps_upload_logo" id="ps_logo_url" class="login_title">
                <input onClick="ps_logo()"   type="button" name="upload-btn" id="logo-upload-btn" class="button-secondary" value="Upload">
                
                
                <p class="description ps_upload_logo"> <?php echo $args[0] ?> </p>
            </div>
            <?php      
        } // end ps_enable_signup_callback 


        function ps_restrict_new_users_callback($args)
        {  
            ?>
            <select id="ps_restrict_new_users" class="login_title" name="ps_restrict_new_users">
                <option value="yes" <?php echo selected('yes', get_option('ps_restrict_new_users')); ?>><?php _e('Yes', 'addify_ps'); ?></option>
                <option value="no" <?php echo selected('no', get_option('ps_restrict_new_users')); ?>><?php _e('No', 'addify_ps'); ?></option>
            </select>
            <p class="description ps_restrict_new_users"> <?php echo $args[0] ?> </p>
            <?php      
        } // end ps_restrict_new_users_callback 


        function ps_new_account_message_callback($args)
        {  
            $content = get_option('ps_new_account_message');
            $editor_id = 'ps_new_account_message';
            $settings = array( 'textarea_name' => 'ps_new_account_message' );

            wp_editor($content, $editor_id, $settings); 

            ?>
            <p class="description ps_new_account_message"> <?php echo $args[0] ?> </p>

            <?php  
        } // end ps_new_account_message_callback


        //Access Control Tab

        function ps_privatize_callback($args)
        {  
            ?>
            <input onchange="getMode(this.value)" type="radio" name="ps_privatize" id="ps_privatize" value="whole_webstore" <?php echo checked('whole_webstore', get_option('ps_privatize')); ?> /> <?php _e("Whole Website", "addify_ps"); ?>
            <input onchange="getMode(this.value)" type="radio" name="ps_privatize" id="ps_privatize" value="selected_items"  <?php echo checked('selected_items', get_option('ps_privatize')); ?> /> <?php _e("Selected Items", "addify_ps"); ?>
            <p class="description ps_privatize"> <?php echo $args[0] ?> </p>
            <?php      
        } // end ps_privatize_callback


        function ps_privatize_products_callback($args)
        {  
            ?>
            <div class="ps_privatize_products">
                

                <select class="js-example-basic-multiple-product login_title2" name="ps_privatize_products[]" multiple="multiple" id="ps_privatize_products">
            <?php
                        
                $args = array(
                'post_type' => 'product',
                'post_status' => 'publish'
                );
                $pros = get_posts($args);

                foreach($pros as $pro) {

            ?>
             <option value="<?php echo $pro->ID; ?>"><?php echo $pro->post_title;; ?></option>
            <?php } ?>
                </select>

                <?php if(!empty($args[0] )) { ?>
                <p class="description ps_privatize_products"> <?php echo $args[0] ?> </p>
            <?php } ?>
            </div>
            <?php 
                
            $se_options = get_option('ps_privatize_products');
            if(!empty($se_options)) {
                $op_ar = implode(',', $se_options);
            } else {
                $op_ar = '';
            }

                
            ?>
            <script>
                
                jQuery('.js-example-basic-multiple-product').val([<?php echo $op_ar; ?>]);
                jQuery('.js-example-basic-multiple-product').select2();
            </script>
            <?php      
        } // end ps_privatize_products_callback 


        function ps_privatize_categories_callback($argss)
        {  
            $pre_vals = get_option('ps_privatize_categories');

            ?>
            <div class="ps_privatize_products">
                <div class="all_cats">
                    <ul>
            <?php
             $args = array(
                              'taxonomy' => 'product_cat',
                              'hide_empty' => false,
                              'parent'   => 0
                              );

                              $product_cat = get_terms($args);
            foreach ($product_cat as $parent_product_cat) { ?>
                                  <li class="par_cat">
                                      <input type="checkbox" class="parent" name="ps_privatize_categories[]" id="ps_privatize_categories" value="<?php echo $parent_product_cat->term_id; ?>" <?php if(!empty($pre_vals) &&in_array($parent_product_cat->term_id, $pre_vals)) { echo "checked"; 
} ?> />
                <?php echo $parent_product_cat->name; ?>

                <?php
                                 $child_args = array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => false,
                        'parent'   => $parent_product_cat->term_id
                        );
                        $child_product_cats = get_terms($child_args);
                if(!empty($child_product_cats)) { ?>
                                              <ul>
                                                  <?php foreach ($child_product_cats as $child_product_cat) { ?>
                                                      <li class="child_cat">
                                                          <input type="checkbox" class="child" name="ps_privatize_categories[]" id="ps_privatize_categories" value="<?php echo $child_product_cat->term_id; ?>" <?php if(!empty($pre_vals) &&in_array($child_product_cat->term_id, $pre_vals)) { echo "checked"; 
} ?> />
                                                        <?php echo $child_product_cat->name; ?>
                                                      </li>
<?php } ?>
                                              </ul>
                <?php } ?>
                                  
                                  </li>
            <?php }
            ?>
                    </ul>
                </div>
                <p class="description ps_privatize_categories"> <?php echo $argss[0] ?> </p>
            </div>
            <?php      
        } // end ps_privatize_categories_callback



        function ps_privatize_pages_callback($argss)
        {  
            $pre_vals = get_option('ps_privatize_pages');

            ?>
            <div class="ps_privatize_products">
                <div class="all_cats">
                    <ul>

            <?php 


            $query = new WP_Query(
                array(
                'post_type' => 'page',
                'posts_per_page' => '-1',
                'post_status' => 'publish'
                )
            );

            if($query->have_posts()) {

                while($query->have_posts()):$query->the_post(); ?>

                                    <li class="par_cat">
                                        <input type="checkbox" class="parent" name="ps_privatize_pages[]" id="ps_privatize_pages" value="<?php echo get_the_ID(); ?>" <?php if(!empty($pre_vals) && in_array(get_the_ID(), $pre_vals)) { echo "checked"; 
} ?>  />
                        <?php echo get_the_title(); ?>
                                    </li>    

                <?php endwhile;
            }


            ?>
                        
                    </ul>
                </div>
                <p class="description ps_privatize_pages"> <?php echo $argss[0] ?> </p>
            </div>
            <?php      
        } // end ps_privatize_pages_callback





        function ps_redirect_login_callback($args)
        {  
            ?>
            <select id="ps_redirect_login" class="login_title" name="ps_redirect_login" onchange="getRedirectPage(this.value)">
                <option value="myaccount" <?php echo selected('myaccount', get_option('ps_redirect_login')); ?>><?php _e('My Account', 'addify_ps'); ?></option>
                <option value="sameurl" <?php echo selected('sameurl', get_option('ps_redirect_login')); ?>><?php _e('Back to Same Page', 'addify_ps'); ?></option>
                <option value="customurl" <?php echo selected('customurl', get_option('ps_redirect_login')); ?>><?php _e('Custom URL', 'addify_ps'); ?></option>
            </select>
            <p class="description ps_redirect_login"> <?php echo $args[0] ?> </p>
            <?php      
        } // end ps_redirect_login_callback 


        function ps_redirect_custom_url_callback($args)
        {  
            ?>
            <div class="ps_customURL">
                <input type="text" id="ps_redirect_custom_url" class="login_title2" name="ps_redirect_custom_url" value="<?php echo get_option('ps_redirect_custom_url') ?>">
                <p class="description ps_allowed_ips"> <?php echo $args[0] ?> </p>
            </div>
            <?php      
        } // end ps_redirect_custom_url_callback 


        function ps_allowed_ips_callback($args)
        {  
            ?>
            <input type="text" id="ps_allowed_ips" class="login_title2" name="ps_allowed_ips" value="<?php echo get_option('ps_allowed_ips') ?>">
            <p class="description ps_allowed_ips"> <?php echo $args[0] ?> </p>
            <?php      
        } // end ps_allowed_ips_callback 


        function ps_goolge_callback($args)
        {  
            ?>
            <select id="ps_goolge" class="login_title" name="ps_goolge">
                <option value="yes" <?php echo selected('yes', get_option('ps_goolge')); ?>><?php _e('Yes', 'addify_ps'); ?></option>
                <option value="no" <?php echo selected('no', get_option('ps_goolge')); ?>><?php _e('No', 'addify_ps'); ?></option>
            </select>
            <p class="description ps_goolge"> <?php echo $args[0] ?> </p>
            <?php      
        } // end ps_goolge_callback 



        function ps_manual_approve_customer_callback($args)
        {  
            ?>
            <input type="checkbox" name="ps_manual_approve_customer" id="ps_manual_approve_customer" value="yes" <?php echo checked('yes', get_option('ps_manual_approve_customer')); ?> />
            <p class="description ps_manual_approve_customer"> <?php echo $args[0] ?> </p>
            <?php      
        } // end ps_manual_approve_customer_callback 



        //Approve New User Callbacks


        function ps_message_for_pending_callback($args)
        {
            ?>

            <textarea name="ps_message_for_pending" id="ps_message_for_pending" rows="5" cols="70"><?php echo get_option('ps_message_for_pending'); ?></textarea>
            <p class="description ps_message_for_pending"> <?php echo $args[0] ?> </p>
        <?php }



        function ps_approval_email_message_subject_callback($args)
        {
            ?>

            <input type="text" id="ps_approval_email_message_subject" class="text_title" name="ps_approval_email_message_subject" value="<?php echo get_option('ps_approval_email_message_subject') ?>">
            <p class="description ps_approval_email_message_subject"> <?php echo $args[0] ?> </p>
        <?php }


        function ps_approval_email_message_text_callback($args)
        { 

            $content = get_option('ps_approval_email_message_text');
            $editor_id = 'ps_approval_email_message_text';
            $settings = array(
             'tinymce' => true,
             'textarea_rows' => 7,
             'quicktags' => array('buttons' => 'em,strong,link',),
             'quicktags' => true,
             'tinymce' => true,
            );

            wp_editor($content, $editor_id, $settings);

            ?>

        <p class="description ps_approval_email_message_text"> <?php echo $args[0] ?> </p>
        <?php }




        function ps_approved_email_message_subject_callback($args)
        {
            ?>

            <input type="text" id="ps_approved_email_message_subject" class="text_title" name="ps_approved_email_message_subject" value="<?php echo get_option('ps_approved_email_message_subject') ?>">
            <p class="description ps_approved_email_message_subject"> <?php echo $args[0] ?> </p>
        <?php }


        function ps_approved_email_message_text_callback($args)
        { 

            $content = get_option('ps_approved_email_message_text');
            $editor_id = 'ps_approved_email_message_text';
            $settings = array(
             'tinymce' => true,
             'textarea_rows' => 10,
             'quicktags' => array('buttons' => 'em,strong,link',),
             'quicktags' => true,
             'tinymce' => true,
            );

            wp_editor($content, $editor_id, $settings);

            ?>

            
            <p class="description ps_approved_email_message_text"> <?php echo $args[0] ?> </p>
        <?php }





        
         

        


    }

    new Admin_Class_Addify_Private_Shop();
}