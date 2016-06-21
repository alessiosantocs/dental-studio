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
				<div class="column-main-content">

					<?php get_template_part('loop'); ?>

					<?php get_template_part('pagination'); ?>

				</div>
				<!-- /column-main-content -->

				<!-- /column-side-content -->
				<div class="column-side-content">
					<?php get_sidebar(); ?>
				</div>
				<!-- /column-side-content -->

			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

<?php get_footer(); ?>
