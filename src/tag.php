<?php get_header(); ?>

	<div class="page-header">
		<div class="container">
			<h1><?php _e( 'Tag Archive: ', 'woopstrapblank' ); echo single_tag_title('', false); ?></h1>
		</div>
	</div>


	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- column-main-content -->
				<div class="column-main-content">

					<?php get_template_part('loop'); ?>

					<?php get_template_part('pagination'); ?>

				</div>
				<!-- /column-main-content -->

				<!-- column-side-content -->
				<!-- <div class="column-side-content">
					<?php //get_sidebar(); ?>
				</div> -->
				<!-- /column-side-content -->

			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

<?php get_footer(); ?>
