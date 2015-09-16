<?php get_header(); ?>
			<div id="content">
				<div id="inner-content">
          <header class="article-header">
            <h1><?php _e( '404 - Article Not Found', 'skeletontheme' ); ?></h1>
          </header>
					<main id="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						<article id="post-not-found" class="hentry">
							<section class="entry-content">
								<p><?php _e( 'The article you were looking for was not found, but maybe try looking again!', 'skeletontheme' ); ?></p>
							</section>
							<section class="search">
									<p><?php get_search_form(); ?></p>
							</section>
							<footer class="article-footer">
									<p><?php _e( 'This is the 404.php template.', 'skeletontheme' ); ?></p>
							</footer>
						</article>
					</main>
				</div>
			</div>
<?php get_footer(); ?>
