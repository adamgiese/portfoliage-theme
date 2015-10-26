<?php
add_action( 'init', 'skeleton_project_registration');
function skeleton_project_registration() { 
	register_post_type( 'skeleton_project', 
		array( 'labels' => array(
        'name' => __( 'Projects', 'skeletontheme' ), 
        'singular_name' => __( 'Project', 'skeletontheme' ), 
        'all_items' => __( 'All Projects', 'skeletontheme' ), 
        'add_new' => __( 'Add New', 'skeletontheme' ), 
        'add_new_item' => __( 'Add New Project', 'skeletontheme' ), 
        'edit' => __( 'Edit', 'skeletontheme' ), 
        'edit_item' => __( 'Edit Projects', 'skeletontheme' ), 
        'new_item' => __( 'New Project', 'skeletontheme' ), 
        'view_item' => __( 'View Project', 'skeletontheme' ), 
        'search_items' => __( 'Search Project', 'skeletontheme' ), 
        'not_found' =>  __( 'Nothing found in the Database.', 'skeletontheme' ), 
        'not_found_in_trash' => __( 'Nothing found in Trash', 'skeletontheme' ), 
        'parent_item_colon' => ''
			), 
			'description' => __( 'This is the project post type.', 'skeletontheme' ), 
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, 
			'menu_icon' => 'dashicons-admin-customizer', 
			'rewrite'	=> array( 'slug' => 'skeleton_project', 'with_front' => false ), 
			'has_archive' => 'skeleton_project', 
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes')
		)
	); 
}
?>
