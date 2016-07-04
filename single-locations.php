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

					get_template_part( 'template-parts/content', 'location' );

				endwhile; // End of the loop.
				?>
			</main>

		</div><!-- #primary -->

		<?php get_sidebar('location'); ?>
	</div>

	<?php $image_ids = get_field('location_gallery', false, false); if ($image_ids): ?>
	<div class="gallery container">
		<?php $shortcode = '[gallery type="rectangular" link="file" size="large" ids="' . implode(',', $image_ids) . '"]';
		echo do_shortcode( $shortcode ); ?>
	</div>
	<?php endif; ?>

<?php
get_footer();