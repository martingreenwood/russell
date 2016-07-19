<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package russell
 */

get_header(); ?>

	<div class="container">
		<div class="page-title">
			<h1>Sorry, nothing to see here...</h1>
		</div>
	</div>

	<div class="container">

		<div id="primary" class="content-area">

			<main id="main" class="site-main" role="main">
				<h3>Looks like the page you're trying to access no longer exists.</h3>
				<p>This page may have been removed or relocated. Why not check out some of our lastest available properties below?</p>
			</main>

		</div>

	</div>

	<div class="latest-properties">
		<div class="container">
			<h2>Latest Available Properties <a href="<?php echo home_url( '/properties'  ); ?>">View All Properties</a></h2>
			<div class="plots">
			<?php 
			$plots = get_posts(array(
				'post_type' 		=> 'plots',
				'posts_per_page' 	=> 6,
				'meta_query' 		=> array(
					array(
						'key'	  	=> 'plot_availability',
						'value'	  	=> 'available',
						'compare' 	=> '=',
					)
				)
			));

			if ($plots) {
				foreach( $plots as $plot ): ?>
				<?php 		
					$plot_num = explode(" ", get_the_title( $plot->ID )); 
					$plot_num = current($plot_num);

					$development_stage = get_field('development_stage', $plot->ID);

					$plot_availability = get_field('plot_availability', $plot->ID);

					$house_type_id = get_field('choose_house_type', $plot->ID); //array
					$house_type_name = get_the_title( $house_type_id[0] );
					$house_type_name = str_replace("'", "", $house_type_name);
					$house_type_name = str_replace('"', "", $house_type_name);
					$house_type_img = get_the_post_thumbnail( $house_type_id[0], 'full' );

					$plot_price = get_field('plot_price', $plot->ID);
					if (!$plot_price): 
						$plot_price = "TBC";

					elseif ($plot_price == 'TBC' || $plot_price == 'TBA'): 
						$plot_price = "TBC";
					else: 
						$plot_price = number_format(get_field('plot_price', $plot->ID), 0);
					endif;
					
					$plot_title = get_field('big_title', $plot->ID);
					if(!$plot_title) $plot_title = "Newly Built Family Home";
				?>
				<div class="plot"> 
					<a href="<?php echo get_permalink( $plot->ID ); ?>">
					
						<?php echo $house_type_img; ?>
						<p>Plot <?php echo $plot_num; ?>: <?php echo $house_type_name; ?></p>
						<h3><?php echo $plot_title; ?></h3>
						<p class="btn">View Property Details</p>

					</a>
				</div>
				<?php endforeach;
			}
			?>
			</div>
		</div>
	</div>

<?php
get_footer();
