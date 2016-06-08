<?php
/**
 * The template for displaying all single developments.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package russell
 */

get_header(); ?>

	<div class="feature-image">
		<?php get_template_part( 'partials/development', 'slider' ); ?>
	</div>

	<div class="container">

		<div class="row">
			<div id="dev-title">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>

		<div class="row">
			<div id="secondary">
				<?php get_template_part( 'partials/development', 'sidebar' ); ?>
			</div>

			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content', 'page' );
					endwhile;
					?>
				</main>
			</div>
		</div>

	</div>

	<div class="container grid">

		<div class="row">
			<?php get_template_part( 'partials/development', 'feature-vid' ); ?>
			<?php get_template_part( 'partials/development', 'gallery' ); ?>
		</div>

		<div class="row">
			<?php get_template_part( 'partials/development', 'mini-map' ); ?>
			<?php get_template_part( 'partials/development', 'quote' ); ?>
		</div>

		<div class="row">
			<?php get_template_part( 'partials/development', 'advert' ); ?>
			<?php get_template_part( 'partials/development', '360' ); ?>
			<?php get_template_part( 'partials/development', 'random-img' ); ?>
		</div>

	</div>

	<div id="siteplan">
		<div class="container">
			<div class="row">
				<?php get_template_part( 'partials/development', 'plans' ); ?>
			</div>
		</div>
	</div>

	<div id="specifications">
		<div class="container">
			<div class="row">
				<?php get_template_part( 'partials/development', 'specs' ); ?>
			</div>
		</div>
	</div>

	<div id="locality">
		<?php get_template_part( 'partials/development', 'locality' ); ?>
	</div>

<?php
get_footer();