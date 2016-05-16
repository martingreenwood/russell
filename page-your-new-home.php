<?php
/**
 * The template for displaying the your new home page.
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

	<div id="primary" class="content-area container">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>

			<div class="top-half clear">
				<?php 
					$top_left_image = get_field('top_left_image'); 
					$top_right_image = get_field('top_right_image'); 
					$top_page_link = get_field('top_page_link'); 
					$bottom_page_link = get_field('bottom_page_link'); 
				?>
				
				<div class="left-img column" style="background-image: url(<?php echo $top_left_image['url']; ?>)">
					<!--<img src="<?php echo $top_left_image['url']; ?>">-->
				</div>

				<div class="mid-links column">

					<div class="top-link link">
					<?php if( $top_page_link ): $post = $top_page_link; setup_postdata( $post ); ?>
						<h3><?php the_title(); ?></h3>
						<?php the_excerpt(); ?>
						<p><a href="<?php the_permalink(); ?>">Find fout more...</a></p>
					<?php wp_reset_postdata(); endif; ?>
					</div>

					<div class="bottom-link link">
					<?php if( $bottom_page_link ): $post = $bottom_page_link; setup_postdata( $post ); ?>
						<h3><?php the_title(); ?></h3>
						<?php the_excerpt(); ?>
						<p><a href="<?php the_permalink(); ?>">Find fout more...</a></p>
					<?php wp_reset_postdata(); endif; ?>
					</div>
					
				</div>
				
				<div class="right-img column" style="background-image: url(<?php echo $top_right_image['url']; ?>)">
					<!--<img src="<?php echo $top_right_image['url']; ?>">-->
				</div>

			</div>

			<div class="bottom-half clear">
				<?php 
					$bottom_left_image = get_field('bottom_left_image'); 
					$bottom_right_image = get_field('bottom_right_image'); 
					$bottom_left_page_link = get_field('bottom_left_page_link'); 
					$bottom_right_page_link = get_field('bottom_right_page_link'); 
				?>

				<div class="mid-top clear">
					<div class="left-img column" style="background-image: url(<?php echo $bottom_left_image['url']; ?>)">
					</div>
					<div class="right-link column">
					<?php if( $bottom_right_page_link ): $post = $bottom_right_page_link; setup_postdata( $post ); ?>
						<h3><?php the_title(); ?></h3>
						<?php the_excerpt(); ?>
						<p><a href="<?php the_permalink(); ?>">Find fout more...</a></p>
					<?php wp_reset_postdata(); endif; ?>
					</div>
				</div>

				<div class="mid-bottom clear">
					<div class="left-link column">
					<?php if( $bottom_left_page_link ): $post = $bottom_left_page_link; setup_postdata( $post ); ?>
						<h3><?php the_title(); ?></h3>
						<?php the_excerpt(); ?>
						<p><a href="<?php the_permalink(); ?>">Find fout more...</a></p>
					<?php wp_reset_postdata(); endif; ?>
					</div>					
					<div class="right-img column" style="background-image: url(<?php echo $bottom_right_image['url']; ?>)">
					</div>
				</div>

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();