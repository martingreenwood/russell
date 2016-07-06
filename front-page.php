<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package russell
 */

get_header(); ?>
	<div id="search_results"></div>

	<div class="home-top">
	
		<section id="slider">
		<?php get_template_part( 'partials/homepage', 'slides' ); ?>
		</section>

		<?php get_template_part( 'partials/homepage', 'search-bar' ); ?>
	</div>

	<section id="primary" class="content-area">
		<main id="main" class="site-main container" role="main">

			<div class="page_title">
				<h1><?php the_field('big_title'); ?></h1>
			</div>

			<?php while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile;
			?>

		</main>
	</section>

	<?php if( have_rows('feature_grid') ): ?>
	<div class="container grid">

	    <?php while ( have_rows('feature_grid') ) : the_row(); ?>

		<div class="row">
		
			<?php
			if( have_rows('columns') ):

			    while ( have_rows('columns') ) : the_row(); 
				$column_width = get_sub_field('width');
				$column_content = get_sub_field('content');

				if( have_rows('content') ):
				    while ( have_rows('content') ) : the_row(); ?>
						<div class="column eq-height <?php echo $column_width; ?> <?php echo get_row_layout(); ?>">

				        <?php 
				        if( get_row_layout() == 'image' ):
				        	get_template_part( 'partials/development', 'image' );

				        elseif( get_row_layout() == 'gallery' ): 
				        	get_template_part( 'partials/development', 'gallery' );

				        elseif( get_row_layout() == 'video' ): 
				        	get_template_part( 'partials/development', 'feature-vid' );

				        elseif( get_row_layout() == 'feature_property' ): 
				        	get_template_part( 'partials/development', 'feature-property' );

				        elseif( get_row_layout() == 'virtual_360' ): 
				        	get_template_part( 'partials/development', '360' );

				        elseif( get_row_layout() == 'text_box' ): 
				        	get_template_part( 'partials/development', 'text' );

				        elseif( get_row_layout() == 'quote' ): 
				        	get_template_part( 'partials/development', 'quote' );

				        elseif( get_row_layout() == 'map' ): 
							get_template_part( 'partials/development', 'mini-map' );

				        endif;
				      	?>
					</div>
				    
				    <?php
				    endwhile;
				endif;
				

			    endwhile;
			endif;
			?>

		</div>

	    <?php endwhile; ?>
	</div>
	<?php endif; ?>

	<section id="locations">
		
		<div class="container">
			<div class="title">
				<h2><?php the_field('additional_title'); ?></h2>
			</div>
		</div>

		<div class="container">
		<?php get_template_part( 'partials/homepage', 'places' ); ?>
		</div>

		<?php get_template_part( 'partials/homepage', 'map' ); ?>

	</section>

	<section id="community">

		<div class="container">
			<div class="title">
				<h2>Our Community</h2>
			</div>
		</div>

		<?php get_template_part( 'partials/homepage', 'community' ); ?>

	</section>

<?php
get_footer();
