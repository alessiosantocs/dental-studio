<?php get_header(); ?>

	<div class="page-header">
		<div class="container">
			<!-- post title -->
			<h1>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h1>
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
				<div class="col-md-9">

					<?php if (have_posts()): while (have_posts()) : the_post(); ?>

						<!-- article -->
						<div id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>

							<!-- post thumbnail -->
							<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail(); // Fullsize image for the single post ?>
								</a>
							<?php endif; ?>
							<!-- /post thumbnail -->



							<!-- post details -->
							<span class="date">
								<time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
									<?php the_date(); ?> <?php the_time(); ?>
								</time>
							</span>
							<span class="author"><?php _e( 'Published by', 'woopstrapblank' ); ?> <?php the_author_posts_link(); ?></span>
							<span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'woopstrapblank' ), __( '1 Comment', 'woopstrapblank' ), __( '% Comments', 'woopstrapblank' )); ?></span>
							<!-- /post details -->

							<?php the_content(); // Dynamic Content ?>

							<?php the_tags( __( 'Tags: ', 'woopstrapblank' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>

							<p><?php _e( 'Categorised in: ', 'woopstrapblank' ); the_category(', '); // Separated by commas ?></p>

							<p><?php _e( 'This post was written by ', 'woopstrapblank' ); the_author(); ?></p>

							<?php edit_post_link(); // Always handy to have Edit Post Links available ?>

							<?php comments_template(); ?>

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
				<!-- /col-md-9 -->

				<!-- /col-md-3 -->
				<div class="col-md-3">
					<?php get_sidebar(); ?>
				</div>
				<!-- /col-md-3 -->

			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

<?php get_footer(); ?>
