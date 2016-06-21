<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- article -->
	<div id="post-<?php the_ID(); ?>" <?php post_class('article post'); ?>>

		<!-- post thumbnail -->
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
			<div class="thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
				</a>
			</div>
		<?php endif; ?>
		<!-- /post thumbnail -->

		<div class="content">
			<!-- post title -->
			<h3>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h3>
			<!-- /post title -->

			<?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>

			<?php edit_post_link(); ?>


			<!-- post details -->
			<div class="details">
				<span class="date">
					<time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
						<?php the_date(); ?> <?php the_time(); ?>
					</time>
				</span>
				<span class="author"><?php _e( 'Published by', 'woopstrapblank' ); ?> <?php the_author_posts_link(); ?></span>
				<span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'woopstrapblank' ), __( '1 Comment', 'woopstrapblank' ), __( '% Comments', 'woopstrapblank' )); ?></span>
			</div>
			<!-- /post details -->
		</div>



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
