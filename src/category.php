<?php
// Utility function
function curPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}



// Force redirect if
$pageURL = curPageURL();
$needsRedirect = false;

if(strpos($pageURL, 'adec-dentista/') !== false){
	$needsRedirect = true;
}

if(strpos($pageURL, 'adec-salute/') 	!== false){
	$needsRedirect = true;
}

if(strpos($pageURL, 'adec-bambini/') 	!== false){
	$needsRedirect = true;
}

if($needsRedirect){
	$newURL = $pageURL;
	// Temporary fix to SEO category link issue
	$newURL = str_replace('adec-dentista/'	, ''	, $newURL);
	$newURL = str_replace('adec-salute/'		, ''	, $newURL);
	$newURL = str_replace('adec-bambini/'		, ''	, $newURL);

	// header("HTTP/1.1 301 Moved Permanently");
	// header("Location: $newURL");
}
?>


<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

if (is_category( )) {
	$cat = get_query_var('cat');
	$current_category = get_category($cat);

	if( true ){//(int)$current_category->parent == 0 ) {

		$args = array(
			'parent'                   => $current_category->cat_ID,
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'exclude'                  => '',
			'include'                  => '',
			'number'                   => '',
			'taxonomy'                 => 'category',
			'pad_counts'               => false
		);

		$child_categories = get_categories( $args );

	}
}

 get_header(); ?>

		<div class="page-header">
			<div class="container">
				<h1>
				<!-- WARNING: Custom PHP code at wp-content/themes/dentistamilano/category.php:87 -->
				<!-- MESSAGE: Hard coded title changing strategy for category with ID=12. Required from stuart. -->
				<!--        : Please remove or clean this code. -->
				<?php
					if ($current_category->cat_ID == 12) {
						echo "ORTODONZIA MILANO: Servizi ADEC per Adulti";
					}else {
						echo $current_category->cat_name;
					}
				?>
				</h1>
			</div>
		</div>

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- col-md-8 -->
					<div class="column-main-content">

						<?php echo $current_category->category_description; ?>

						<!-- row -->
						<div class="specialties-children">

						<!-- Has children categories -->
						<?php if( count($child_categories) > 0 ): ?>
							<?php foreach( $child_categories as $child_cat ) : ?>
								<div class="specialties-child">

									<div class="specialties-child-item">

										<?php if (function_exists('z_taxonomy_image_url')) : ?>
											<img width="300" height="169" class="panel-background-image" src="<?php echo z_taxonomy_image_url($child_cat->cat_ID); ?>" class="attachment-medium wp-post-image">
									  <?php endif; ?>

										<div class="panel-title">
											<a href="<?php echo get_category_link($child_cat->cat_ID); ?>" title="<?php echo $child_cat->cat_name; ?>">
												<?php echo $child_cat->cat_name; ?>
											</a>
										</div>

									</div>

								</div>

							<?php endforeach; ?>
						<?php endif; ?>

						</div>
						<!-- /row -->

					</div>
					<!-- /column-main-content -->

					<!-- column-side-content  -->
					<div class="column-side-content">
						<?php get_sidebar(); ?>
					</div>
					<!-- column-side-content -->

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
