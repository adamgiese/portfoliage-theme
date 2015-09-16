<?php
function skeleton_register_sidebars() {
	register_sidebar(array(
		'id' => 'right-sidebar',
		'name' => __( 'Right Sidebar', 'skeletontheme' ),
		'description' => __( 'Sidebar on the right-hand side', 'skeletontheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
}
add_action( 'widgets_init', 'skeleton_register_sidebars' );
?>
