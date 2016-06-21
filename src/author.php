<?php
get_header();
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>

	<div class="page-header">
		<div class="container">
			<h1>
				<?php echo $curauth->display_name; ?>
			</h1>
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

					<div class="pull_left" style="margin-right:1em">
						<?php echo get_avatar( $curauth->ID, '220' ); ?>
					</div>
					<p>
						<?php echo $curauth->user_description; ?>
					</p>
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
