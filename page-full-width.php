<?php
/*
 Template Name: Full Width Page
*/
?>
<?php get_header(); ?>
			<div id="content">
				<div id="inner-content">
          <?php
            if (!is_front_page()) { ?>
            <header class="article-header">
              <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
            </header>
            <?php } ?>
            <?php
              $page_carousel = get_post_meta(get_the_id(), 'aeg_page_carousel', true);
              if ( !empty($page_carousel) && $page_carousel !== "none" ) {
                echo '<div class="carousel-container">';
                echo do_shortcode('[print_carousel carousel="' . $page_carousel . '"]');
                echo '</div>';
              }
            ?>
						<main id="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								<section class="entry-content" itemprop="articleBody">
									<?php
										the_content();
										wp_link_pages( array(
											'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'skeletontheme' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span>',
											'link_after'  => '</span>',
										) );
									?>
								</section> <?php // end article section ?>
                <!--
								<footer class="article-footer">
								</footer>
                -->
								<?php comments_template(); ?>
							</article>
							<?php endwhile; endif; ?>
						</main>
						<?php get_sidebar(); ?>
				</div>
			</div>
<?php get_footer(); ?>
