<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package russell
 */

get_header(); ?>

	<div class="container">
		<div class="page-title">
			<h1>Sorry, nothing to see here...</h1>
		</div>
	</div>

	<div class="container">

		<div id="primary" class="content-area">

			<main id="main" class="site-main" role="main">

				<h3>Looks like the page you are trying to access no longer exists</h3>
				<p>This page may have moved, try searching for it or using the manu to look for it.</p> 
				<?php get_search_form(); ?>

			</main>

		</div><!-- #primary -->

	</div>

<?php
get_footer();
