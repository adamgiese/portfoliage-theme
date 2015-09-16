<?php
/*
 * CUSTOM POST TYPE ARCHIVE TEMPLATE
*/
?>
<?php get_header(); ?>
			<div id="content">
				<div id="inner-content">
          <header class="article-header">
            <h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
            <p class="byline vcard"><?php
              printf( __( 'Posted <time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time> by <span class="author">%3$s</span>', 'skeletontheme' ), get_the_time( 'Y-m-j' ), get_the_time( __( 'F jS, Y', 'skeletontheme' ) ), get_author_posts_url( get_the_author_meta( 'ID' ) ));
            ?></p>
          </header>
          <h1 class="archive-title h2"><?php post_type_archive_title(); ?></h1>
					<main id="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?> role="article">
								<section class="entry-content">
									<?php the_excerpt(); ?>
								</section>
								<footer class="article-footer">
								</footer>
							</article>
							<?php endwhile; ?>
									<?php skeleton_page_navi(); ?>
							<?php else : ?>
									<article id="post-not-found" class="hentry">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'skeletontheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'skeletontheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the custom posty type archive template.', 'skeletontheme' ); ?></p>
										</footer>
									</article>
							<?php endif; ?>
						</main>
					<?php get_sidebar(); ?>
				</div>
			</div>
<?php get_footer(); ?>
