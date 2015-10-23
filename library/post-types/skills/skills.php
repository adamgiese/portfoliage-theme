<?php
add_action( 'init', 'skeleton_skill_registration');
function skeleton_skill_registration() { 
	register_post_type( 'skeleton_skill', 
		array( 'labels' => array(
        'name' => __( 'Skills', 'skeletontheme' ), 
        'singular_name' => __( 'Skill', 'skeletontheme' ), 
        'all_items' => __( 'All Skills', 'skeletontheme' ), 
        'add_new' => __( 'Add New', 'skeletontheme' ), 
        'add_new_item' => __( 'Add New Skill', 'skeletontheme' ), 
        'edit' => __( 'Edit', 'skeletontheme' ), 
        'edit_item' => __( 'Edit Skills', 'skeletontheme' ), 
        'new_item' => __( 'New Skill', 'skeletontheme' ), 
        'view_item' => __( 'View Skill', 'skeletontheme' ), 
        'search_items' => __( 'Search Skill', 'skeletontheme' ), 
        'not_found' =>  __( 'Nothing found in the Database.', 'skeletontheme' ), 
        'not_found_in_trash' => __( 'Nothing found in Trash', 'skeletontheme' ), 
        'parent_item_colon' => ''
			), 
			'description' => __( 'This is the skill post type.', 'skeletontheme' ), 
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, 
			'menu_icon' => 'dashicons-media-text', 
			'rewrite'	=> array( 'slug' => 'skeleton_skill', 'with_front' => false ), 
			'has_archive' => 'skeleton_skill', 
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes')
		)
	); 
}
if (class_exists('MultiPostThumbnails')) {
  new MultiPostThumbnails(
    array(
      'label' => 'Mobile Featured Image',
      'id' => 'featured-image-mobile',
      'post_type' => 'skeleton_skill'
    )
  );
}


//shortcode support
add_shortcode('get_skills', 'get_skills_registration');
function get_skills_registration($atts) {
  $string = '';
  //$attributes = shortcode_atts( array(), $atts ); //get attributes
  $args = array (
    'posts_per_page'      => -1,
    'post_type'           => 'skeleton_skill',
    'orderby'             => 'menu_order',
    'order'               => 'ASC'
  );
  $skills = get_posts($args);
  global $post;
  $string .= "<h3 class='shortcode-title'>Skills</h3>";
  $i = 0;
  foreach ($skills as $post) {
    $i++;
    if ($i % 2 == 0) {
      $class = 'right';
    } else {
      $class = 'left';
    }
    setup_postdata($post);
    $bg_image_url = '"' . wp_get_attachment_url( get_post_thumbnail_id($post->ID),'full') . '"';
    $content = get_the_excerpt();
    $title = get_the_title();
    $string .= "<div class='skill-container' style='background-image: url($bg_image_url)'>";
    $string .= "<div class='skill-content $class'>";
    $string .= "<h4>$title</h4>";
    $string .= "<div class='description'>$content</div>";
    $string .= "</div>"; //skill-content
    $string .= "</div>"; //skill-container
  }
  
  wp_reset_query();
  return $string;
}
?>
