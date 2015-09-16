<?php
/*
Author: Adam Giese
URL: http://adamgiese.com/
*/
require_once( 'library/skeleton.php' );
require_once( 'library/admin.php' );

function launch_skeleton() {
  require_once( 'library/post-types/carousel/carousel.php' );
  require_once( 'library/customizer.php' );
  require_once( 'library/sidebars.php' );
  require_once( 'library/comments-layout.php' );

  add_action( 'init', 'skeleton_head_cleanup' );
  add_action( 'wp_enqueue_scripts', 'skeleton_scripts_and_styles', 999 );
  add_action( 'wp_head', 'skeleton_remove_recent_comments_style', 1 );

  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  add_filter( 'excerpt_more', 'skeleton_excerpt_more' );
  add_filter( 'gallery_style', 'skeleton_gallery_style' );
  add_filter( 'the_content', 'skeleton_filter_ptags_on_images' );
  add_filter( 'the_generator', 'skeleton_rss_version' );
  add_filter( 'wp_head', 'skeleton_remove_wp_widget_recent_comments_style', 1 );
  add_filter( 'wp_title', 'rw_title', 10, 3 );

  load_theme_textdomain( 'skeletontheme', get_template_directory() . '/library/translation' );

  skeleton_theme_support();
} 

add_action( 'after_setup_theme', 'launch_skeleton' );

if ( ! isset( $content_width ) ) {
	$content_width = 680;
}

function skeleton_fonts() {
  wp_enqueue_style('googleFonts', 'http://fonts.googleapis.com/css?family=PT+Sans:300,400,700,400italic,700italic|PT+Serif:300,400,700');
}

add_action('wp_enqueue_scripts', 'skeleton_fonts');

?>
