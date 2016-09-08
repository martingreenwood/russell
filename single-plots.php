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
$plot_availability = get_field('plot_availability');

?>

	<div class="feature-image" style="border-color: <?php echo $dev_colour; ?>">
		<?php get_template_part( 'partials/plot', 'slider' ); ?>
	</div>

	<div class="container">

		<div>
			<div id="dev-title">
				<span style="color: <?php echo $dev_colour; ?>"><?php echo get_the_title($developmentID[0]); ?></span>
			</div>
		</div>

		<div class="row" data-avail="<?php echo $plot_availability; ?>">
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
								$plot_price = number_format($plot_price, 0);
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
							<h1><?php the_field('big_title'); ?></h1>
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

	<?php if ($plot_availability != "affordable"): ?>
	<div id="htb-banner">
		<div class="container">
			<div class="row">
				<div class="icon eq-height">
					<div class="table">
						<div class="cell middle">
							<img width="100" height="100" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/htb_logo.svg" alt="" scale="0">
						</div>
					</div>
				</div>
				<div class="text eq-height">
					<div class="table">
						<div class="cell middle">
							<h3>Help to Buy</h3>
							<p>We can help you move with a 5% deposit and a 20% government-backed equity loan.</p>
						</div>
					</div>
				</div>
				<div class="btn eq-height">
					<div class="table">
						<div class="cell middle">
							<a href="<?php echo home_url( 'your-new-home/help-to-buy/' ); ?>">Find out More</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php if (get_field('special_offers')): if(get_field('special_offers') != 'help-to-buy'): ?>
	<div id="special_offers" style="background-color: <?php echo $dev_colour; ?>">
		<div class="container">
			<div class="row">
				<div class="icon eq-height">
					<div class="table">
						<div class="cell middle">
							<h3><?php echo str_replace("-"," ", get_field('special_offers')); ?><?php if (get_field('special_offers') == 'carpets-included' || get_field('special_offers') == 'stamp-duty-paid'): ?>*<?php endif; ?></h3>
						</div>
					</div>
				</div>

				<div class="text eq-height">
					<div class="table">
						<div class="cell middle">
							<?php if (get_field('special_offers') == 'part-exchange'): ?>
							<p><strong>Do you have a property to sell?</strong> Ask about our Park Exchange Scheme.<br>
							Make your move a simple and stress-free experience.</p>

							<?php elseif (get_field('special_offers') == 'carpets-included'): ?>
							<p>Free flooring from our supplier. Details available from our sales advisor.<br>
							<small><a href="https://www.russell-armer.co.uk/help/terms-conditions/">* Terms &amp; Conditions apply</small></a></p>

							<?php elseif (get_field('special_offers') == 'stamp-duty-paid'): ?>
							<p>To give you a helping hand we’ll pay the Stamp Duty, on the basis that it is your sole home.<br>
							<small><a href="https://www.russell-armer.co.uk/help/terms-conditions/">* Terms &amp; Conditions apply</small></a></p>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<div class="btn eq-height">
					<div class="table">
						<div class="cell middle">
							<?php if (get_field('special_offers') == 'part-exchange'): ?>
							<a style="color: <?php echo $dev_colour; ?>" href="https://www.russell-armer.co.uk/part-exchange-scheme/">Find out More</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; endif; ?>

	<?php if( have_rows('floor_plan', $house_typeID[0]) ): ?>
	<div id="plans">
		<div class="container">
			<div class="row">
				<?php get_template_part( 'partials/plot', 'plans' ); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

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