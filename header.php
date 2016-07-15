<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package russell
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-236786-2', 'auto');
  ga('send', 'pageview');

</script>
</head>

<body <?php body_class(); ?>>

<div id="loading-page">
	<div class="table">
		<div class="cell middle">
			<img id="loading-image" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/Preloader_1.gif" width="90" alt="Loading..." />
			<h3>loading page...</h3>
		</div>
	</div>
</div>

<div class="turnme">
	<div class="table">
		<div class="cell middle">
			<i class="fa fa-mobile" aria-hidden="true"></i>
			<h3>Please use portrait mode</h3>
		</div>
	</div>
</div>

<div id="page" class="site <?php echo str_replace(" ", "-", strtolower(get_the_title())); ?>">

	<header id="masthead" class="site-header" role="banner">
		<div class="container">

			<div class="site-branding">
			<?php if ( function_exists( 'the_custom_logo' ) ) : ?>
			    <div class='site-logo'>
				  <?php the_custom_logo(); ?>
			    </div>
			<?php else : ?>
			    <hgroup>
			        <h1 class='site-title'><a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><?php bloginfo( 'name' ); ?></a></h1>
			        <h2 class='site-description'><?php bloginfo( 'description' ); ?></h2>
			    </hgroup>
			<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button id="nav-icon" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</button>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->

			<div class="clear"></div>

		</div>
	</header><!-- #masthead -->


	<div id="content" class="site-content">
