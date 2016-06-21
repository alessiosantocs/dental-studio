<?php get_header(); ?>

<?php
$show_page_header = true;
$show_featured_image = true;
$show_page_excerpt = true;
$show_page_content = true;

$hidden_objects = get_field_object('hide_objects');

if(!empty($hidden_objects)){
  $hidden_objects_value = $hidden_objects['value'];

  if(empty($hidden_objects_value)){
    $hidden_objects_value = Array();
  }


  $show_page_header = array_search('hide_page_header', $hidden_objects_value) === false;
  $show_featured_image = array_search('hide_featured_image', $hidden_objects_value) === false;
  $show_page_excerpt = array_search('hide_page_excerpt', $hidden_objects_value) === false;
  $show_page_content = array_search('hide_content', $hidden_objects_value) === false;
  $show_page_sidebar = array_search('hide_sidebar', $hidden_objects_value) === false;
}

 ?>

	<!-- Page header -->
  <?php if ($show_page_header): ?>

  	<div class="page-header">
  		<div class="container">
  			<h1>
  				<?php
  				$featured_title = get_field('featured_title');
  				if ( !empty($featured_title) ): ?>
  					<?php echo $featured_title;?>
  				<?php else:?>
  					<?php the_title(); ?>
  				<?php endif;?>
  			</h1>
  			<?php
  			$featured_subtitle = get_field('featured_subtitle');
  			if ( !empty($featured_subtitle) ): ?>
  				<h2 class="subtitle">
  					<?php echo $featured_subtitle;?>
  				</h2>
  			<?php endif;?>
  		</div>
  	</div>

  <?php endif; ?>

	<?php if ($show_featured_image): ?>

		<!-- The featured image -->
		<?php if (get_the_post_thumbnail()): ?>
			<?php
			$post_thumbnail_id = get_post_thumbnail_id();
			$thumbnail_attributes = wp_get_attachment_image_src( $post_thumbnail_id , 'extralarge');
      $featured_image_display_mode = get_field('featured_image_display_mode');
			 ?>
     <?php if ($featured_image_display_mode == 'nocrop'): ?>
       <section class="section" style="padding: 0; margin-bottom: 20px;">
         <div class="section-background display-nocrop">
           <img src="<?php echo $thumbnail_attributes[0]; ?>" />
         </div>
       </section>
     <?php else: ?>
			  <section class="section section-inverted section-large-padding">
          <div class="section-background enhance-img" style="background-image: url('<?php echo $thumbnail_attributes[0]; ?>');">
          </div>

          <div class="container on-top-relative">
  				</div>
        </section>
      <?php endif; ?>
		<?php endif; ?>

	<?php endif; ?>


	<?php if ($show_page_content): ?>
		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- col-md-8 -->
					<div class="column-main-content">

						<?php if ($show_page_excerpt): ?>

							<!-- The excerpt -->
							<?php
							$the_excerpt = get_field('page_excerpt');
							if (!empty($the_excerpt) && $the_excerpt != 'This is a featured section excerpt'): ?>
								<p class="lead">
									<?php echo $the_excerpt; ?>
								</p>
							<?php endif; ?>

						<?php endif; ?>

						<!-- The content -->
						<?php if (have_posts()): while (have_posts()) : the_post(); ?>
								<?php the_content(); ?>
						<?php endwhile; ?>

						<?php else: ?>

							<!-- article -->
							<div class="article">

								<h3><?php _e( 'Sorry, nothing to display.', 'woopstrapblank' ); ?></h3>

							</div>
							<!-- /article -->

						<?php endif; ?>

					</div>
					<!-- /column-main-content -->

					<!-- column-side-content  -->
					<div class="column-side-content">
            <?php if ($show_page_sidebar): ?>
              <?php get_sidebar(); ?>
            <?php endif; ?>
					</div>
					<!-- column-side-content -->

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->
	<?php endif; ?>

	<?php get_template_part('flex-layout-page'); ?>

	<div class="container">
		<?php edit_post_link(); ?>
		<br><br>
	</div>

<?php get_footer(); ?>
