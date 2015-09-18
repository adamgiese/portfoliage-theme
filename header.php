<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php wp_title(''); ?></title>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
    <meta name="theme-color" content="#121212">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<?php wp_head(); ?>
        <style>
          @media only screen and (min-width: 768px) {
            .header {
                background-image: url('<?php echo esc_url(get_theme_mod('skeleton_title_background')); ?>');
            }
          }
        </style>
	</head>
	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
		<div id="container">
			<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
				<div id="inner-header">
          <div id="site-info">
            <p id="logo" class="h1" itemscope itemtype="http://schema.org/Organization">
              <a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a>
            </p>
            <p id="site-tagline">
              <?php echo get_bloginfo ( 'description' ); ?>
            </p>
            <p id="site-description">
              <?php echo get_theme_mod('portfoliage_header_paragraph'); ?>
            </p>
            <?php
              $header_cta = get_theme_mod('portfoliage_header_cta');
              $header_cta_href = get_theme_mod('portfoliage_header_cta_href');
              if (! empty($header_cta) && !empty($header_cta_href)) {
                echo "<a class='cta' href='$header_cta_href'>$header_cta</a>";
              }
            ?>
            <button class="menu-toggle">
              Menu
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50"><path d="M10 12h30v4H10z"/><path d="M10 22h30v4H10z"/><path d="M10 32h30v4H10z"/></svg>
            </button>
          </div>
					<nav role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
						<?php wp_nav_menu(array(
             'container' => false,                         
             'container_class' => 'menu',                 
             'menu' => __( 'The Main Menu', 'skeletontheme' ),  
             'menu_class' => 'nav top-nav',               
             'theme_location' => 'main-nav',                 
             'before' => '',                                 
               'after' => '',                                  
               'link_before' => '',                            
               'link_after' => '',                             
               'depth' => 0,                                   
             'fallback_cb' => ''                             
						)); ?>
					</nav>
				</div>
			</header>
