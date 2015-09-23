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
			'supports' => array( 'title', 'editor', 'thumbnail')
		)
	); 
}
?>
