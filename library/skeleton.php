<?php

function skeleton_head_cleanup() {
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );
	add_filter( 'style_loader_src', 'skeleton_remove_wp_ver_css_js', 9999 );
	add_filter( 'script_loader_src', 'skeleton_remove_wp_ver_css_js', 9999 );
}

function rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;
  if ( is_feed() ) {
    return $title;
  }

  if ( 'right' == $seplocation ) {
    $title .= get_bloginfo( 'name' );
  } else {
    $title = get_bloginfo( 'name' ) . $title;
  }

  $site_description = get_bloginfo( 'description', 'display' );

  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " {$sep} {$site_description}";
  }

  if ( $paged >= 2 || $page >= 2 ) {
    $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
  }

  return $title;

} // end better title

function skeleton_rss_version() { 
  return ''; 
}

function skeleton_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

function skeleton_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

function skeleton_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

function skeleton_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}

/*********************
SCRIPTS & ENQUEUEING
*********************/

function skeleton_scripts_and_styles() {
  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

  if (!is_admin()) {
		wp_register_script( 'skeleton-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );
		wp_register_style( 'skeleton-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all' );
		wp_register_style( 'skeleton-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '' );
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
		  wp_enqueue_script( 'comment-reply' );
    }
		wp_register_script( 'skeleton-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'skeleton-modernizr' );
		wp_enqueue_style( 'skeleton-stylesheet' );
		wp_enqueue_style( 'skeleton-ie-only' );

		$wp_styles->add_data( 'skeleton-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'skeleton-js' );
	}
}

//admin javascript scripts

/*
add_action( 'admin_enqueue_scripts', 'skeleton_event_admin_scripts' );
function skeleton_event_admin_scripts() {
  global $post_type;
  if ('page' == $post_type ) {
    wp_enqueue_script('skeleton-admin-page-js', get_template_directory_uri() . '/library/js/admin-page.js', array('jquery-ui-autocomplete'));
    wp_register_style('skeleton-admin-page-css', get_template_directory_uri() . '/library/css/admin/page.css');

    wp_enqueue_style('skeleton-admin-page-css');
    wp_enqueue_style('wp-jquery-ui-autocomplete');
  }
}
*/
/*********************
THEME SUPPORT
*********************/

function skeleton_theme_support() {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(125, 125, true);
	add_theme_support('automatic-feed-links');
	// adding post format support
  /*
	add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	);
  */

	add_theme_support( 'menus' );
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'skeletontheme' ),   // main nav in header
			'footer-links' => __( 'Footer Links', 'skeletontheme' ) // secondary nav in footer
		)
	);

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form'
	) );

} /* end skeleton theme support */


/*********************
RELATED POSTS FUNCTION
*********************/

// Related Posts Function (call using skeleton_related_posts(); )
function skeleton_related_posts() {
	echo '<ul id="skeleton-related-posts">';
	global $post;
	$tags = wp_get_post_tags( $post->ID );
	if($tags) {
		foreach( $tags as $tag ) {
			$tag_arr .= $tag->slug . ',';
		}
		$args = array(
			'tag' => $tag_arr,
			'numberposts' => 5, /* you can change this to show more */
			'post__not_in' => array($post->ID)
		);
		$related_posts = get_posts( $args );
		if($related_posts) {
			foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
				<li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; }
		else { ?>
			<?php echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'skeletontheme' ) . '</li>'; ?>
		<?php }
	}
	wp_reset_postdata();
	echo '</ul>';
} /* end skeleton related posts function */

/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)
function skeleton_page_navi() {
  global $wp_query;
  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
    return;
  echo '<nav class="pagination">';
  echo paginate_links( array(
    'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
    'format'       => '',
    'current'      => max( 1, get_query_var('paged') ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => '&larr;',
    'next_text'    => '&rarr;',
    'type'         => 'list',
    'end_size'     => 3,
    'mid_size'     => 3
  ) );
  echo '</nav>';
} /* end page navi */

/*********************
ADDITIONAL CUSTOM FIELDS
*********************/
add_action( 'add_meta_boxes', 'aeg_add_page_fields' );
add_action( 'save_post', 'aeg_save_page_fields' );

function aeg_add_page_fields() {
  add_meta_box(
    'aeg_page_fields',
    'Additional Information',
    'aeg_page_field_callback',
    'page'
  );
}
function aeg_page_field_callback($post) {
  $id = $post->ID;
  wp_nonce_field( 'aeg_page_field_box', 'aeg_page_field_box_nonce' );
  $cb_string = '';
  $cb_string .= '<h3>Select Page Carousel</h3>';
  $cb_string .= '<div class="ui-widget">';
  $cb_string .= '<select name="aeg_page_carousel"> id="combobox"';
  $cb_string .= '<option value="none">No Carousel</option>';
  //query for carousels, no arguments needed by default
  $carousels = get_terms( 'carousel_cat', array(
  ));
  //add each carousel from previous query as <option>
  foreach ($carousels as $carousel) {
    $v_name = $carousel->name;
    $v_slug = $carousel->slug;
    if ( get_post_meta($id, 'aeg_page_carousel', true) === $v_slug ) {
      $v_selected = "selected";
    } else {
      $v_selected = "";
    }
    $cb_string .= '<option value="' . $v_slug . '" ' . $v_selected . '>' . $v_name . '</option>';
  }
  $cb_string .= '</select>';
  $cb_string .= '</div>';
  echo $cb_string;
}
function aeg_save_page_fields($post_id) {
  //if value is NOT from website, return
  if ( ! isset( $_POST['aeg_page_field_box_nonce'] ) ) {
    return;
  }
  if ( ! wp_verify_nonce( $_POST['aeg_page_field_box_nonce'], 'aeg_page_field_box' ) ) {
    return;
  }
  //don't save through auto save
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }
  //checks if user has correct permissions
  if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
    if ( ! current_user_can( 'edit_page', $post_id ) ) {
      return;
    }
  } else {
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
      return;
    }
  }
  //sanitize and update the custom fields
  update_post_meta( $post_id, 'aeg_page_carousel', $_POST['aeg_page_carousel'] );
}

/*********************
RANDOM CLEANUP ITEMS
*********************/

function skeleton_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

function skeleton_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a class="excerpt-read-more" href="'. get_permalink( $post->ID ) . '" title="'. __( 'Read ', 'skeletontheme' ) . esc_attr( get_the_title( $post->ID ) ).'">'. __( 'Read more &raquo;', 'skeletontheme' ) .'</a>';
}

?>
