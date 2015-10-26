<?php
add_action( 'init', 'skeleton_testimonial_registration');
function skeleton_testimonial_registration() { 
	register_post_type( 'skeleton_testimonial', 
		array( 'labels' => array(
        'name' => __( 'Testimonials', 'skeletontheme' ), 
        'singular_name' => __( 'Testimonial', 'skeletontheme' ), 
        'all_items' => __( 'All Testimonials', 'skeletontheme' ), 
        'add_new' => __( 'Add New', 'skeletontheme' ), 
        'add_new_item' => __( 'Add New Testimonial', 'skeletontheme' ), 
        'edit' => __( 'Edit', 'skeletontheme' ), 
        'edit_item' => __( 'Edit Testimonials', 'skeletontheme' ), 
        'new_item' => __( 'New Testimonial', 'skeletontheme' ), 
        'view_item' => __( 'View Testimonial', 'skeletontheme' ), 
        'search_items' => __( 'Search Testimonial', 'skeletontheme' ), 
        'not_found' =>  __( 'Nothing found in the Database.', 'skeletontheme' ), 
        'not_found_in_trash' => __( 'Nothing found in Trash', 'skeletontheme' ), 
        'parent_item_colon' => ''
			), 
			'description' => __( 'This is the testimonial post type.', 'skeletontheme' ), 
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, 
			'menu_icon' => 'dashicons-format-quote', 
			'rewrite'	=> array( 'slug' => 'skeleton_testimonial', 'with_front' => false ), 
			'has_archive' => 'skeleton_testimonial', 
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes')
		)
	); 
}

//shortcode support
add_shortcode('get_testimonials', 'get_testimonials_registration');
function get_testimonials_registration($atts) {
  $string = '';
  $args = array (
    'posts_per_page'      => -1,
    'post_type'           => 'skeleton_testimonial',
    'orderby'             => 'menu_order',
    'order'               => 'ASC'
  );
  $testimonials = get_posts($args);
  global $post;
  $string .= "<h3 class='shortcode-title'>Testimonials</h3>";
  $string .= "<div class='testimonials-container'>";
  foreach ($testimonials as $post) {
    setup_postdata($post);
    $string .= get_the_content();
  }
  $string .= "</div>"; //.testimonials-container
  wp_reset_query();
  return $string;
}
?>
