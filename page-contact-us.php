<?php
/**
 * The template for displaying the contact page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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

		<div id="primary" class="content-area full">

			<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page-contact' );

				endwhile; // End of the loop.
				?>

			</main>

		</div><!-- #primary -->
	</div>

	<div class="contact-form">
		<div class="container">
		<h2>Send us a message</h2>
		<?php 
			$form_object = get_field('form_selector');
			gravity_form_enqueue_scripts($form_object['id'], true);
			gravity_form($form_object['id'], false, false, false, '', true, 1); 
		?>
		</div>
	</div>

<?php
get_footer();