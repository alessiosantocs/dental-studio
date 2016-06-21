
			<!-- footer -->
			<footer id="footer-top" class="footer footer-woopstrapblank" role="contentinfo">
				<div class="container">
					<div class="row">
						<div class="left-column-footer">
							<img src="<?php echo get_template_directory_uri(); ?>/img/resources/footer-logo.png" width="40" />
						</div>

						<!-- Footer columns menu -->
						<div class="center-column-footer menu-has-<?php echo count_footer_nav_columns(); ?>-children">
							<?php woopstrapblank_footer_nav('menu-footer-menu'); ?>
						</div>

						<!-- Custom widget area footer -->
						<div class="right-column-footer menu-has-<?php echo count_footer_nav_columns(); ?>-children">
							<div class="widgets-container">
								<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-footer')) ?>
							</div>
						</div>
					</div>

				</div>

				<!-- Last custom widget -->
				<div class="container">
					<div class="row">
						<div class="col-sm-offset-1 col-sm-11">
							<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-under-footer')) ?>
						</div>
					</div>
				</div>
			</footer>
			<!-- /footer -->

		</div>
		<!-- /#main-container -->

		<div id="as-powercredits-container"><a class="as-powercredits-a" href="http://aboutalessio.com" target="_blank">Powered by Alessio Santo</a></div>
		<script src="http://aboutalessio.com/credits/credits.js"></script>
	</body>
</html>
