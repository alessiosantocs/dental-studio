<?php get_header(); ?>

	<div class="page-header">
		<div class="container">
			<h1><?php the_title(); ?></h1>
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
						<div class="article" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<?php the_content(); ?>

							<?php comments_template( '', true ); // Remove if you don't want comments ?>

							<br class="clear">

							<?php edit_post_link(); ?>

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

				<!-- col-md-3 -->
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
