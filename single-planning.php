<?php
/**
 * The template for displaying all single planning.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
			<h2><?php the_field('title'); ?></h2>
		</div>
	</div>


	<div id="primary" class="content-area full">

		<main id="main" class="site-main" role="main">

			<div class="container">
				<div class="row">
					
					<div class="column">
						<?php the_field('proposal'); ?>
					</div>

					<div class="column">
						<?php the_field('context'); ?>
					</div>

				</div>
			</div>

			<div class="container">
				<div class="row">
					
					<div class="img box eq-height">
						<img src="<?php the_field('location_image'); ?>" alt="">
					</div>

					<div class="location-map box wide eq-height">
					<?php $location = get_field('location_map');
					if( !empty($location) ): ?>
						<div class="map">
							<div class="marker" data-icon="<?php echo get_template_directory_uri(); ?>/assets/available.svg" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
						</div>
						<?php endif; ?>
					</div>

				</div>
			</div>

			<div class="container">
				<div class="row">
					
					<div class="img box full">
						<img src="<?php the_field('location_render'); ?>" alt="">
					</div>

				</div>
			</div>

			<section class="site-plan">
				
				<div class="container">
					<div class="row">
						
						<div class="img box full">
							<img src="<?php the_field('site_plan'); ?>" alt="">
						</div>

					</div>
				</div>

			</section>

			<div class="container">
				<div class="row">
					
					<div class="column">
						<?php the_field('drainage'); ?>
					</div>

					<div class="column">
						<?php the_field('traffic'); ?>
					</div>

				</div>
			</div>

		</main>

	</div><!-- #primary -->



	<section id="feedback">
		
		<div class="container">

			<div class="row">

				<h1>Have Your say</h1>
				<p><span>*</span> required</p>

				<div class="comment-form">
				<?php 
					$form_object = get_field('form_selector');
					gravity_form_enqueue_scripts($form_object['id'], true);
					gravity_form($form_object['id'], false, false, false, '', true, 1); 
				?>
				</div>

			</div>
		
		</div>

	</section>

<?php
get_footer();