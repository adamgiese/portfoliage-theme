				<div id="right-sidebar" class="sidebar" role="complementary">
					<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
						<?php dynamic_sidebar( 'right-sidebar' ); ?>
					<?php else : ?>
						<?php
						?>
						<div class="no-widgets">
							<p><?php _e( 'This is a widget ready area. Add some and they will appear here.', 'skeletontheme' );  ?></p>
						</div>
					<?php endif; ?>
				</div>
