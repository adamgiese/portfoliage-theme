<?php

//Register scripts when shortcode is used
function register_aeg_carousel_items_scripts() {
  wp_register_script('flexslider-script', get_stylesheet_directory_uri() . '/library/post-types/carousel/flexslider/jquery.flexslider-min.js', array('jquery'), '1.0', true);
  wp_register_script('aeg-carousel-script', get_stylesheet_directory_uri() . '/library/post-types/carousel/carousel.js', array('flexslider-script'), '1.0', true);
  wp_register_style('flexslider-style', get_stylesheet_directory_uri() . '/library/post-types/carousel/flexslider/flexslider.css' );
}
add_action( 'init', 'register_aeg_carousel_items_scripts' );

function print_aeg_carousel_scripts() {
  global $aeg_carousel_flag;
  if ( ! $aeg_carousel_flag ) {
    return;
  }
  wp_print_scripts('aeg-carousel-script');
  wp_print_styles('flexslider-style');
}
add_action( 'wp_footer', 'print_aeg_carousel_scripts' );

function aeg_carousel_post_type() { 
	register_post_type( 'aeg_carousel', 
		array( 
      'labels' => array(
        'name' => __( 'Carousel Items', 'skeletontheme' ), 
        'singular_name' => __( 'Carousel Item', 'skeletontheme' ), 
        'all_items' => __( 'All Carousel Items', 'skeletontheme' ), 
        'add_new' => __( 'Add New', 'skeletontheme' ), 
        'add_new_item' => __( 'Add New Carousel Item', 'skeletontheme' ), 
        'edit' => __( 'Edit', 'skeletontheme' ), 
        'edit_item' => __( 'Edit Carousel Items', 'skeletontheme' ), 
        'new_item' => __( 'New Carousel Item', 'skeletontheme' ), 
        'view_item' => __( 'View Carousel Item', 'skeletontheme' ), 
        'search_items' => __( 'Search Carousel Item', 'skeletontheme' ), 
        'not_found' =>  __( 'Nothing found in the Database.', 'skeletontheme' ), 
        'not_found_in_trash' => __( 'Nothing found in Trash', 'skeletontheme' ), 
        'parent_item_colon' => ''
      ), 
      'description' => __( 'Carousel Items are used to create carousels in your WordPress theme with the Flexslider jQuery plugin.', 'skeletontheme' ), 
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'query_var' => true,
      'menu_position' => 8, 
      'menu_icon' => 'dashicons-images-alt', 
      'rewrite'	=> array( 'slug' => 'carousel_item', 'with_front' => true ), 
      'has_archive' => 'aeg_carousel', 
      'capability_type' => 'post',
      'hierarchical' => false,
      'supports' => array( 'title', 'editor', 'thumbnail')
		) 
	);
}
add_action( 'init', 'aeg_carousel_post_type');
	
register_taxonomy( 
  'carousel_cat', 
  array('aeg_carousel'), 
  array('hierarchical' => true,     
    'labels' => array(
      'name' => __( 'Carousels', 'skeletontheme' ), 
      'singular_name' => __( 'Carousel', 'skeletontheme' ), 
      'search_items' =>  __( 'Search Carousels', 'skeletontheme' ), 
      'all_items' => __( 'All Carousels', 'skeletontheme' ), 
      'parent_item' => __( 'Parent Carousel', 'skeletontheme' ), 
      'parent_item_colon' => __( 'Parent Carousel:', 'skeletontheme' ), 
      'edit_item' => __( 'Edit Carousel', 'skeletontheme' ), 
      'update_item' => __( 'Update Carousel', 'skeletontheme' ), 
      'add_new_item' => __( 'Add New Carousel', 'skeletontheme' ), 
      'new_item_name' => __( 'New Carousel Name', 'skeletontheme' ) 
    ),
    'show_admin_column' => true, 
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'custom-slug' ),
  )
);

//add carousel
add_shortcode('print_carousel', 'aeg_print_carousel');
function aeg_print_carousel( $atts ) {
  global $aeg_carousel_flag;
  $aeg_carousel_flag = true; //sets flag for scripts/styles
  $attributes = shortcode_atts( 
    array(
      'carousel' => '',
    ), $atts
  );
  $posts = get_posts( array(
    'posts_per_page' => -1,
    'post_type' => 'aeg_carousel',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'carousel_cat' => $attributes['carousel']
  ));
  global $post;
  $sc_string .= '<div class="aeg-carousel flexslider">';
  $sc_string .= '<ul class="slides">';
  $i = 0;
  foreach ( $posts as $post ) {
    $i++;
    setup_postdata( $post );
    $sc_string .= '<li class="slide" id="slide-' . $i . '">';
    $sc_string .= get_the_post_thumbnail(get_the_id(), 'full');
    $sc_string .='</li>'; //close .slide <li>
  }
  $sc_string .= '</ul>'; //close .slides <ul>
  $sc_string .='</div>'; //close .mod-carousel <div>
  $sc_string .= '<div class="navigation">';
  $sc_string .= '<div class="prev"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50"><path d="M27.3 34.7L17.6 25l9.7-9.7 1.4 1.4-8.3 8.3 8.3 8.3z"/></svg></div>'; //svgs from evil-icons, by outpunk. https://github.com/outpunk/evil-icons
  $sc_string .= '<div class="next"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50"><path d="M22.7 34.7l-1.4-1.4 8.3-8.3-8.3-8.3 1.4-1.4 9.7 9.7z"/></svg></div>';
  $sc_string .= '</div>'; //close .navigation
  $sc_string .='<div class="clearfix"></div>'; //close .mod-carousel <div>
  wp_reset_query();
  return $sc_string;
}
	
?>
