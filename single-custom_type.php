<?php
/*
 * CUSTOM POST TYPE TEMPLATE
*/
?>
<?php get_header(); ?>
			<div id="content">
				<div id="inner-content">
            <header class="article-header">
              <h1 class="single-title custom-post-type-title"><?php the_title(); ?></h1>
              <p class="byline vcard"><?php
                printf( __( 'Posted <time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time> by <span class="author">%3$s</span> <span class="amp">&</span> filed under %4$s.', 'skeletontheme' ), get_the_time( 'Y-m-j' ), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) ), get_the_term_list( $post->ID, 'custom_cat', ' ', ', ', '' ) );
              ?></p>
            </header>
						<main id="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">
								<section class="entry-content">
									<?php
										the_content();
										wp_link_pages( array(
											'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'skeletontheme' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span>',
											'link_after'  => '</span>',
										) );
									?>
								</section> <!-- end article section -->
								<footer class="article-footer">
									<p class="tags"><?php echo get_the_term_list( get_the_ID(), 'custom_tag', '<span class="tags-title">' . __( 'Custom Tags:', 'skeletontheme' ) . '</span> ', ', ' ) ?></p>
								</footer>
								<?php comments_template(); ?>
							</article>
							<?php endwhile; ?>
							<?php else : ?>
									<article id="post-not-found" class="hentry">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'skeletontheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'skeletontheme' ); ?></p>
										</section>
										<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single-custom_type.php template.', 'skeletontheme' ); ?></p>
										</footer>
									</article>
							<?php endif; ?>
						</main>
						<?php get_sidebar(); ?>
				</div>
			</div>
<?php get_footer(); ?>
