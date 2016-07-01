<?php
/**
 * Template Name: No Sidebar
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

	<div class="container">

		<div id="primary" class="content-area">

			<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

				endwhile; // End of the loop.
				?>

			</main>

		</div><!-- #primary -->

	</div>

<?php
get_footer();