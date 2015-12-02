<?php get_header(); ?>

	<div class="page-header">
		<div class="container">
			<h1><?php echo sprintf( __( '%s Search Results for ', 'woopstrapblank' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>
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

					<?php get_template_part('loop'); ?>

					<?php get_template_part('pagination'); ?>

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
