<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package russell
 */

get_header(); ?>
	<div id="search_results"></div>

	<section id="slider">
	<?php get_template_part( 'partials/homepage', 'slides' ); ?>
	</section>

	<section id="homesearch">
	<?php get_template_part( 'partials/homepage', 'search-bar' ); ?>
	</section>

	<section id="primary" class="content-area">
		<main id="main" class="site-main container" role="main">

			<div class="page_title">
				<h1><?php the_field('big_title'); ?></h1>
			</div>

			<?php while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; 

			get_template_part( 'partials/homepage', 'adverts' );

			?>

		</main>
	</section>

	<section id="locations">
		
		<div class="container">
			<div class="title">
				<h2><?php the_field('additional_title'); ?></h2>
			</div>
		</div>

		<div class="container">
		<?php get_template_part( 'partials/homepage', 'places' ); ?>
		</div>

		<?php get_template_part( 'partials/homepage', 'map' ); ?>

	</section>

	<section id="community">

		<div class="container">
			<div class="title">
				<h2>Our Community</h2>
			</div>
		</div>

		<?php get_template_part( 'partials/homepage', 'community' ); ?>

	</section>

<?php
get_footer();
