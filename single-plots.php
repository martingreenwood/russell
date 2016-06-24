<?php
/**
 * The template for displaying all single plots.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package russell
 */
get_header(); 

$developmentID  = get_field('choose_development');
$house_typeID  = get_field('choose_house_type');
$dev_colour = get_field('development_colour', $developmentID[0]);
?>

	<div class="feature-image" style="border-color: <?php echo $dev_colour; ?>">
		<?php get_template_part( 'partials/plot', 'slider' ); ?>
	</div>

	<div class="container">

		<div>
			<div id="dev-title">
				<h1 style="color: <?php echo $dev_colour; ?>"><?php echo get_the_title($developmentID[0]); ?></h1>
			</div>
		</div>

		<div class="row">
			<div id="secondary">
				<?php get_template_part( 'partials/plot', 'sidebar' ); ?>
			</div>

			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<?php
					while ( have_posts() ) : the_post();?>
						<header>
							<?php
							$plotNum = get_the_title();
							$plotNum = explode(" ", $plotNum);

							if (get_field('enable_opposite_hand')){
								$enable_opposite_hand = true;
							} else {
								$enable_opposite_hand = false;
							}

							$house_typeName = get_the_title($house_typeID[0]);

							$plot_price = get_field('plot_price');
							if (is_numeric($plot_price)):
								$plot_price = '<span class="price">' . $plot_price .'</span>';
							else:
								$plot_price =  "TBC";
							endif;
							?>
							<h2>
								<span class="left"><?php echo $house_typeName; ?>: Plot <?php echo current($plotNum); ?> <?php if($enable_opposite_hand): ?> (opposite hand plot).<?php endif; ?></span>
								<span style="color: <?php echo $dev_colour; ?>" class="right">£<?php echo $plot_price; ?></span>
							</h2>
						</header>
						<header class="sub">
							<?php echo '<h3>' . get_field('big_title'). '</h3>'; ?>
						</header>
						<?php get_template_part( 'template-parts/content', 'page' ); ?>
						<?php if($enable_opposite_hand): ?>
						<div class="opp">
							<?php the_field('opposite_hand_text'); ?>
						</div>
						<?php endif; ?>
					<?php endwhile; ?>
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
				?>

				<div class="column <?php echo $column_width; ?>">

				<?php
				if( have_rows('content') ):
				    while ( have_rows('content') ) : the_row();

				        if( get_row_layout() == 'image' ):
				        	get_template_part( 'partials/development', 'image' );

				        elseif( get_row_layout() == 'gallery' ): 
				        	get_template_part( 'partials/development', 'gallery' );

				        elseif( get_row_layout() == 'video' ): 
				        	get_template_part( 'partials/development', 'feature-vid' );

				        elseif( get_row_layout() == 'virtual_360' ): 
				        	get_template_part( 'partials/development', '360' );

				        elseif( get_row_layout() == 'text_box' ): 
				        	get_template_part( 'partials/development', 'text' );

				        elseif( get_row_layout() == 'quote' ): 
				        	get_template_part( 'partials/development', 'quote' );

				        elseif( get_row_layout() == 'map' ): 
							get_template_part( 'partials/development', 'mini-map' );

				        endif;

				    endwhile;
				endif;
				?>
					
				</div>

			    <?php endwhile;
			endif;
			?>

		</div>

	    <?php endwhile; ?>
	
	</div>
	<?php endif; ?>


	<?php if( have_rows('floor_plan', $house_typeID[0]) ): ?>
	<div id="plans">
		<div class="container">
			<div class="row">
				<?php get_template_part( 'partials/plot', 'plans' ); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

<?php
get_footer();