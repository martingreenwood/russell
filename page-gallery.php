<?php
/**
 * The template for displaying galery page.
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

	<div class="container">

		<div id="primary" class="content-area">

			<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

				endwhile; // End of the loop. ?>
				
				<div class="galleries">
				<?php $args = array( 'post_type' => 'galleries', 'posts_per_page' => -1 );
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<div class="gallery">
						<a href="<?php the_permalink(); ?>">
							<?php 						
							$development_gallery = get_field('development_gallery');
							$development_gallery_img = current($development_gallery);
							?>
							<img src="<?php echo $development_gallery_img['sizes']['thumbnail']; ?>" alt="<?php the_title(); ?>">
							<span><?php the_title(); ?></span>
						</a>
					</div>
					<?php endwhile; ?>
				</div>

			</main>

		</div><!-- #primary -->
	</div>

<?php
get_footer();