<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package russell
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">

			<div class="container">

				<div class="contact-info column">

					<div class='site-logo'>
						<img src='<?php echo get_template_directory_uri(); ?>/assets/logo-white.svg'>
					</div>

					<p class="bold">&copy; <?php echo date("Y");?> Russell Armer Ltd,<br>
					Mintsfeet Place,<br>
					Mintsfeet Industrial Estate,<br>
					Kendal LA9 6LL</p>
					
					<p>Join our mailing list for news &amp; offers:<br>
					<a href="<?php home_url( '/sign-up' ); ?>">Sign Up Here</a></p>

				</div>

				<div class="contact column">
					<h3>Get in touch</h3>
					<ul class="deets">
						<li>Sales: 01539 724282</li>
						<li>Head Office: 01539 722635</li>
						<li><a href="mailto:<?php echo antispambot( sanitize_email( 'homes@russell-armer.co.uk' ), true ); ?>"><?php echo antispambot( sanitize_email( 'homes@russell-armer.co.uk' ), false ); ?></a></li>
					</ul>
					<ul class="social">
						<li><a href="https://twitter.com/russellarmer" target="_blank">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a></li>	
						<li><a href="https://www.youtube.com/user/russellarmerla96ll" target="_blank">
							<i class="fa fa-youtube" aria-hidden="true"></i>
						</a></li>	
						<li><a href="https://plus.google.com/115283757929642128482/about" target="_blank">
							<i class="fa fa-google-plus" aria-hidden="true"></i>
						</a></li>	
					</ul>
				</div>

				<div class="contact column">
					<h3>Help</h3>
					<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu' ) ); ?>
				</div>

			</div>

		</div>
	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>