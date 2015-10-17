<?php
add_action( 'init', 'skeleton_tool_registration');
function skeleton_tool_registration() { 
	register_post_type( 'skeleton_tool', 
		array( 'labels' => array(
        'name' => __( 'Tools', 'skeletontheme' ), 
        'singular_name' => __( 'Tool', 'skeletontheme' ), 
        'all_items' => __( 'All Tools', 'skeletontheme' ), 
        'add_new' => __( 'Add New', 'skeletontheme' ), 
        'add_new_item' => __( 'Add New Tool', 'skeletontheme' ), 
        'edit' => __( 'Edit', 'skeletontheme' ), 
        'edit_item' => __( 'Edit Tools', 'skeletontheme' ), 
        'new_item' => __( 'New Tool', 'skeletontheme' ), 
        'view_item' => __( 'View Tool', 'skeletontheme' ), 
        'search_items' => __( 'Search Tool', 'skeletontheme' ), 
        'not_found' =>  __( 'Nothing found in the Database.', 'skeletontheme' ), 
        'not_found_in_trash' => __( 'Nothing found in Trash', 'skeletontheme' ), 
        'parent_item_colon' => ''
			), 
			'description' => __( 'This is the tool post type.', 'skeletontheme' ), 
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, 
			'menu_icon' => 'dashicons-admin-tools', 
			'rewrite'	=> array( 'slug' => 'skeleton_tool', 'with_front' => false ), 
			'has_archive' => 'skeleton_tool', 
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes')
		)
	); 
}
?>
