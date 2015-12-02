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
				<div class="col-md-9">

					<!-- article -->
					<div id="post-404" class="article">

						<h2>
							<a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'woopstrapblank' ); ?></a>
						</h2>

					</div>
					<!-- /article -->

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
