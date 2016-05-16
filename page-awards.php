<?php
/**
 * The template for displaying awards page.
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

		<div id="primary" class="content-area">

			<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

				endwhile; // End of the loop.
				?>

			</main>

			<section class="ra-awards">
				
			<?php
			if( have_rows('awards') ):
				$ai = 0;
			    while ( have_rows('awards') ) : the_row(); $ai++;
			    if ($ai % 2 == 0): ?>

			    	<div class="table award">
						<div class="limage">
							<img src="<?php the_sub_field('image'); ?>">
						</div>
						<div class="info">
							<h3><?php the_sub_field('name'); ?></h3>
							<?php the_sub_field('description'); ?>
						</div>
					</div>

			    <?php else: ?>

			    	<div class="table award">
						<div class="info">
							<h3><?php the_sub_field('name'); ?></h3>
							<?php the_sub_field('description'); ?>
						</div>
						<div class="limage">
							<img src="<?php the_sub_field('image'); ?>">
						</div>
					</div>

			    <?php endif;

			    endwhile;

			endif;
			?>

			</section>

		</div><!-- #primary -->

		<?php get_sidebar(); ?>
	</div>

<?php
get_footer();