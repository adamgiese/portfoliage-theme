<?php

/************* DASHBOARD WIDGETS *****************/

// disable default dashboard widgets
function disable_default_dashboard_widgets() {
	global $wp_meta_boxes;
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);    
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);        
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); 
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);  
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);         
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);    
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);     
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);           
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);         
	//unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);           
	//unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);        
	//unset($wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now']);   
}

add_action( 'wp_dashboard_setup', 'disable_default_dashboard_widgets' );

/************* CUSTOM LOGIN PAGE *****************/

function skeleton_login_css() {
	wp_enqueue_style( 'skeleton_login_css', get_template_directory_uri() . '/library/css/login.css', false );
}
add_action( 'login_enqueue_scripts', 'skeleton_login_css', 10 );

function skeleton_login_url() {  
  return home_url(); 
}
add_filter( 'login_headerurl', 'skeleton_login_url' );

function skeleton_login_title() {
  return get_option( 'blogname' ); 
}
add_filter( 'login_headertitle', 'skeleton_login_title' );


/************* CUSTOMIZE ADMIN *******************/

// Custom Backend Footer
function skeleton_custom_admin_footer() {
	_e( '<span id="footer-thankyou">Developed by <a href="http://www.adamgiese.com" target="_blank">Adam Giese</a></span>.' , 'skeletontheme' );
}
add_filter( 'admin_footer_text', 'skeleton_custom_admin_footer' );

?>
