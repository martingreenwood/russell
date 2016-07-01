<?php
/**
 * The template for displaying careers page.
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

	<div class="jobs">
	
		<div class="container">
		<?php if( have_rows('job_oppurtunities') ): while ( have_rows('job_oppurtunities') ) : the_row(); ?>

			<div class="job">
				<h3><?php the_sub_field('job_title'); ?></h3>
				<?php the_sub_field('job_details'); ?>
			</div>
			<?php endwhile;
		else : ?>
		    <h3>Sorry, we do not currently have any job oppurtunities available. Keep checking back as we update this page often.</h3>

		<?php endif; ?>
		</div>
		
	</div>


<?php
get_footer();