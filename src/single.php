<?php get_header(); ?>

	<div class="page-header">
		<div class="container">
			<!-- post title -->
			<h1>
				<?php the_title(); ?>
			</h1>
			<h2 class="subtitle">
				<a href="<?php echo get_permalink( posts_index_page_id() ) ?>">Adec Blog</a>
			</h2>
			<!-- /post title -->
		</div>
	</div>


	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- col-md-9 -->
				<div class="column-main-content">

					<?php if (have_posts()): while (have_posts()) : the_post(); ?>

						<!-- article -->
						<div id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>

							<!-- post thumbnail -->
							<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
								<a href="<?php the_permalink(); ?>" class="thumbnail" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail(); // Fullsize image for the single post ?>
								</a>
							<?php endif; ?>
							<!-- /post thumbnail -->



							<!-- post details -->
							<div class="details">
								<span class="date">
									<time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
										<?php the_date(); ?> <?php the_time(); ?>
									</time>
								</span>
								<span class="author"><?php _e( 'Published by', 'woopstrapblank' ); ?> <?php the_author_posts_link(); ?></span>
								<span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'woopstrapblank' ), __( '1 Comment', 'woopstrapblank' ), __( '% Comments', 'woopstrapblank' )); ?></span>
							</div>
							<!-- /post details -->

							<?php the_content(); // Dynamic Content ?>

							<?php the_tags( __( 'Tags: ', 'woopstrapblank' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>

							<p class="small"><?php _e( 'Categorised in: ', 'woopstrapblank' ); the_category(', '); // Separated by commas ?></p>

							<p class="small"><?php _e( 'This post was written by ', 'woopstrapblank' ); the_author(); ?></p>

							<?php edit_post_link(); // Always handy to have Edit Post Links available ?>

							<?php // comments_template(); ?>

						</div>
						<!-- /article -->

					<?php endwhile; ?>

					<?php else: ?>

						<!-- article -->
						<div class="article">

							<h3><?php _e( 'Sorry, nothing to display.', 'woopstrapblank' ); ?></h3>

						</div>
						<!-- /article -->

					<?php endif; ?>

				</div>
				<!-- /column-main-content -->

				<!-- /column-side-content -->
				<div class="column-side-content" style="display: block;">
					<div class="sidebar-widget">
						<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>
					</div>
					<div class="sidebar-widget">
						<?php the_widget( 'WP_Widget_Recent_Posts', array(), array('before_title' => '<h3>', 'after_title' => '</h3>')); ?>
					</div>
					<div class="sidebar-widget">
						<article class="widget">
							<?php
								echo get_the_post_navigation( array(
									'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'woopstrapblank' ) . '</span> ' .
										'<span class="screen-reader-text">' . __( 'Next post:', 'woopstrapblank' ) . '</span> ' .
										'<span class="post-title">%title</span>',
									'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'woopstrapblank' ) . '</span> ' .
										'<span class="screen-reader-text">' . __( 'Previous post:', 'woopstrapblank' ) . '</span> ' .
										'<span class="post-title">%title</span>',
									'screen_reader_text' => __('Post navigation', 'woopstrapblank')
								) );
							 ?>
						</article>
					</div>
				</div>
				<!-- /column-side-content -->

			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

<?php get_footer(); ?>
