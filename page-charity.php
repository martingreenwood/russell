<?php
/**
 * The template for displaying all charity page.
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

			<div class="charity-logos">
			<?php $charity_logos = get_field('charity_logos'); if( $charity_logos ): ?>
		        <?php foreach( $charity_logos as $charity_logo ): $charity_link = get_field('external_url', $charity_link['ID']); ?>
		            <div class="charity-logo">
		            	<?php if ($charity_link): ?><a target="_blank" href="<?php echo $charity_link; ?>"><?php endif; ?>
		                <img src="<?php echo $charity_logo['url']; ?>" alt="<?php echo $charity_logo['alt']; ?>" />
		                <?php if ($charity_link): ?></a><?php endif; ?>
		            </div>
		        <?php endforeach; ?>
			<?php endif; ?>
			</div>

		</div><!-- #primary -->

	</div>

<?php
get_footer();