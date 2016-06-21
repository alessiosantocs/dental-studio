<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' : '; } ?><?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
		<link href="//connect.facebook.net" rel="dns-prefetch">
		<?php if (! HTML5_DEBUG) : ?>
			<?php get_template_part("modules/tracking"); ?>
		<?php endif; ?>
		<link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.png" rel="shortcut icon">
		<link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>

	</head>
	<?php
		// Move this out of here and put it in the functions file
		$is_index_or_post = false;
		$additional_body_classes = '';
		if (is_home()) {
			$is_index_or_post = true;
			$additional_body_classes = 'posts posts-index';
		}elseif (is_single()) {
			$p = get_post();
			if (!empty($p)) {
				$p_type = $p->post_type;
				if ($p_type == 'post') {
					$is_index_or_post = true;
					$additional_body_classes = 'posts posts-single';
				}
			}
		}
	?>
	<body <?php body_class($additional_body_classes); ?>>

		<!-- #main-container -->
		<div id="main-container">

			<?php $blog_menu = wp_nav_menu(array(
				"fallback_cb" => false,
				"echo" => false,
				"theme_location" => "blog-header-menu"
			));
			$blog_menu_present = ($blog_menu !== false);
			?>
			<header class="navbar navbar-dental-studio-site-areas <?php if($is_index_or_post && $blog_menu_present) {echo 'hidden';} ?>">
				<div class="container">
					<nav>
						<ul class="nav navbar-nav navbar-left">
							<?php dental_studio_site_areas_nav(); ?>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href="<?php echo get_post_type_archive_link('specialist'); ?>" class="">
									<?php _e('Specialists', 'woopstrapblank'); ?>
								</a>
							</li>
							<li>
								<a href="<?php echo get_the_permalink(30); ?>" class="">
									<?php _e('Where are we', 'woopstrapblank'); ?>
								</a>
							</li>
							<li>
								<a href="<?php echo get_the_permalink(70); ?>" class="dental-studio-check-open-now">
									<?php _e('Open every day from 8am to 11pm', 'woopstrapblank'); ?>
								</a>
							</li>
						</ul>
					</nav>
				</div>
			</header>

			<!-- header -->
			<header class="navbar navbar-dental-studio" id="top" role="banner">

				<div class="container">
					<!-- navbar-header -->
					<div class="navbar-header">
						<!-- The logo -->
						<a href="<?php multi_area_home_url(); ?>" class="navbar-brand" rel="nofollow">
							<img src="<?php multi_area_logo() ?>" height="50" style="margin-top: -15px;" alt="<?php multi_area_logo_alt(); ?>" />
						</a>

						<a href="tel://800102020" class="navbar-btn btn btn-success btn-outlined pull-right visible-xs" style="margin-right: 15px;">
							<?php _e('Call us', 'woopstrapblank'); ?>
							<!-- <i class="glyphicon glyphicon-earphone"></i> -->
						</a>
						<button type="button" class="navbar-toggle collapsed" onclick="$('#woopstrapblank-nav-menu').toggleClass('in');$('body').toggleClass('overflow-hidden');">
							<!-- <span class="text-to-open">MENU</span>
							<span class="text-to-close">CLOSE</span> -->
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<!-- /navbar-header -->

					<!-- nav -->
					<nav id="woopstrapblank-nav-menu" class="collapse navbar-collapse" role="navigation">
						<div class="navbar-header visible-xs" style="margin-left: -15px;margin-right: -15px;">
							<a href="<?php multi_area_home_url(); ?>" class="navbar-brand" rel="nofollow">
								<img src="<?php echo get_template_directory_uri() ?>/img/resources/logo-adec-default-white.png" height="50" style="margin-top: -15px;" alt="<?php multi_area_logo_alt(); ?>" />
							</a>

							<a href="tel://800102020" class="navbar-btn btn btn-success pull-right visible-xs" style="margin-right: 15px;">
								<?php _e('Call us', 'woopstrapblank'); ?>
								<!-- <i class="glyphicon glyphicon-earphone"></i> -->
							</a>

							<button type="button" class="navbar-toggle collapsed" onclick="$('#woopstrapblank-nav-menu').toggleClass('in');$('body').toggleClass('overflow-hidden');" style="border-color:white;">
								<!-- <span class="text-to-open">MENU</span>
								<span class="text-to-close">CLOSE</span> -->
								<span class="icon-bar" style="transform: rotate(45deg) translate(4px, 4px);background-color: white;border-color: white;"></span>
								<span class="icon-bar" style="opacity: 0;"></span>
								<span class="icon-bar" style="transform: rotate(-45deg) translate(4px, -4px);background-color: white;border-color: white;"></span>
							</button>
						</div>
						<ul class="nav navbar-nav navbar-parent">
							<?php if ($is_index_or_post): ?>
								<?php dental_studio_blog_main_menu_nav(); ?>
							<?php else: ?>
								<?php dental_studio_main_menu_nav(); ?>
							<?php endif; ?>

							<li class="adec visible-xs menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-extra-item">
								<a href="<?php echo site_url(); ?>" class="">
									ADEC
								</a>

								<ul class="nav navbar-nav">
									<li>
										<a href="<?php echo get_post_type_archive_link('specialist'); ?>" class="">
											<?php _e('Specialists', 'woopstrapblank'); ?>
										</a>
									</li>
									<li>
										<a href="<?php echo get_the_permalink(30); ?>" class="">
											<?php _e('Where are we', 'woopstrapblank'); ?>
										</a>
									</li>
									<li>
										<a href="<?php echo get_the_permalink(70); ?>">
											<?php _e('Open every day from 8am to 12am', 'woopstrapblank'); ?>
										</a>
									</li>
								</ul>
							</li>

						</ul>

						<ul class="nav navbar-nav navbar-right hidden-xs hidden-sm">
							<div class="navbar-btn btn-phone">
								<img src="<?php echo get_template_directory_uri(); ?>/img/resources/phone-icon.png" height="50" class="phone-icon" draggable=false>
								<span class="number"><?php _e('800 10 20 20', 'woopstrapblank'); ?></span>
								<span class="text"><?php _e('Call us now', 'woopstrapblank'); ?></span>
							</div>
						</ul>
					</nav>
					<!-- /nav -->
				</div>

			</header>
			<!-- /header -->

			<script>
				var site_area = "<?php global $detected_site_area; echo $detected_site_area; ?>";
				if(site_area == "")
					site_area = "dentista";
			</script>
