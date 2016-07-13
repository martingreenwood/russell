<?php
/**
 * The template for displaying all single developments.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package russell
 */
get_header(); 
$dev_colour = get_field('development_colour');
?>

	<div class="feature-image" style="border-color: <?php echo $dev_colour; ?>">
		<?php get_template_part( 'partials/development', 'slider' ); ?>
	</div>

	<div class="container">

		<div class="row" style="margin: 0;">
			<div id="dev-title">
				<span style="color: <?php echo $dev_colour; ?>"><?php the_title(); ?></span>
			</div>
		</div>

		<div class="row">
			<div id="secondary">
				<?php get_template_part( 'partials/development', 'sidebar' ); ?>
			</div>

			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content', 'page' );
					endwhile;
					?>
				</main>
			</div>
		</div>

	</div>

	<?php
	if( have_rows('feature_grid') ): ?>
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
					<div class="column <?php echo $column_width; ?> <?php echo get_row_layout(); ?>">

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

	<?php if( have_rows('add_your_site_plans') ): ?>
	<div id="siteplan">
		<div class="container">
			<div class="row">
				<?php get_template_part( 'partials/development', 'plans' ); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php if(get_field('enabale_specification_section')): ?>
	<div id="specifications">
		<div class="container">
			<div class="row">
				<?php get_template_part( 'partials/development', 'specs' ); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div id="locality">
		<?php get_template_part( 'partials/development', 'locality' ); ?>
	</div>

	<div id="reginterest">
		<div class="container">
			<div class="table">
				<div class="cell middle">
					<a id="closeme" href="#"></a>
					<?php echo do_shortcode( '[gravityform id="1" title="false" description="false"]' ); ?>
				</div>
			</div>
		</div>
	</div>

<?php
get_footer();