<?php get_header(); ?>

	<div class="page-header">
		<div class="container">
			<h1><?php _e( 'Latest Posts', 'woopstrapblank' ); ?></h1>
		</div>
	</div>

	<main role="main" class="container">
		<!-- section -->
		<section>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
