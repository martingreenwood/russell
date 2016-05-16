<?php
/**
 * The template for displaying all single locations.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package russell
 */

get_header(); ?>

	<div class="feature-image">
		<?php if (has_post_thumbnail()) :
			the_post_thumbnail('cover1600');
		else: ?>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/default.jpg" alt="Russell Armer Homes">
		<?php endif; ?>
	</div>

	<div class="container">
		<div class="page-title">
			<?php the_title("<h1>","</h1>"); ?>
		</div>
	</div>

	<div class="container default-page">

		<div id="primary" class="content-area">

			<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', get_post_format() );

				endwhile; // End of the loop.
				?>
			</main>

		</div><!-- #primary -->

		<?php get_sidebar('location'); ?>
	</div>

	<div class="gallery container">
		<?php $location_gallery = get_field('location_gallery'); if( $location_gallery ): ?>
		<div class="pics">
		<?php foreach( $location_gallery as $image ): ?>
			<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
		<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>

<?php
get_footer();