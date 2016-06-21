<?php get_header(); ?>

	<div class="page-header">
		<div class="container">
			<h1><?php _e( 'Page not found', 'woopstrapblank' ); ?></h1>
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

					<!-- article -->
					<div id="post-404" class="article">

						<h2>
							<a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'woopstrapblank' ); ?></a>
						</h2>

					</div>
					<!-- /article -->

				</div>
				<!-- /column-main-content -->

				<!-- column-side-content -->
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
