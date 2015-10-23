              <article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
                <header class="article-header entry-header">
                  <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
                </header> <?php // end article header ?>
                <section class="entry-content" itemprop="articleBody">
                  <?php the_content(); ?>
                </section> <?php // end article section ?>
                <?php //comments_template(); ?>
              </article> <?php // end article ?>
