<?php get_header(); ?>

	<div class="page-header">
		<div class="container">
			<h1><?php echo get_the_title( posts_index_page_id() ); ?></h1>
			<h2 class="subtitle"><?php _e( 'Latest Posts', 'woopstrapblank' ); ?></h2>
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

					<?php $page_description = get_field( 'page_description', posts_index_page_id() ); ?>
					<?php if (!empty($page_description)): ?>
						<p>
							<?php echo $page_description; ?>
						</p>
					<?php endif; ?>

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
