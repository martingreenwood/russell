<?php
/**
 * The template for displayingthe lostpassword page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package russell
 */

get_header(); ?>

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