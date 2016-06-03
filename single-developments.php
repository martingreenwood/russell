<?php
/**
 * The template for displaying all single developments.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package russell
 */

get_header(); ?>

	<div class="feature-image">
		<?php $slides = get_field('development_slider'); if( $slides ): ?>
			<div class="slick">
				<?php foreach( $slides as $image ): ?>
					<div>						
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
					</div>
				<?php endforeach; ?>
			</div>
		<?php elseif (has_post_thumbnail()) :
			the_post_thumbnail('cover1600');
		else: ?>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/default.jpg" alt="Russell Armer Homes">
		<?php endif; ?>
		<?php 
			$development_logo = get_field('development_logo'); 
			if ($development_logo): ?>
				<img id="dev_logo" src="<?php echo $development_logo['url']; ?>" width="195" height="195">
			<?php endif;
		?>
	</div>

	<div class="container">

		<div class="row">
			<div id="dev-title">
				<h1>Cragg Close</h1>
			</div>
		</div>

		<div class="row">
			<div id="secondary">

				<div class="intro">
					<h2>Kendal, Cumbria LA9 4HE</h2>
					<br>
					<h3>2 - 4 Bedroom properties
						<br>starting from £199,500</h3>
				</div>

				<div class="quicklinks">
					<ul>
						<li><a href="">Register your interest</a></li>
						<li><a href="">Search for gomes at Cragg Close</a></li>
						<li><a href="">Download a brochure</a></li>
						<li><a href="">View site plan</a></li>
					</ul>
				</div>

				<div class="showhome">
					<h3>Show home open every<br>
					Friday, Saturday &smp; Sunday<br>
					11am – 5.30pm.</h3>
				</div>

				<div class="shareme">
					<?php 
					if ( function_exists( 'sharing_display' ) ) {
						sharing_display( '', true );
					}
					?>
				</div>

			</div>

			<div id="primary" class="content-area">

				<main id="main" class="site-main" role="main">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page' );

					endwhile; // End of the loop.
					?>

				</main>

			</div>
		</div>

	</div>

	<div class="container grid">

		<div class="row">
			<?php get_template_part( 'partials/development', 'feature-vid' ); ?>
			<?php get_template_part( 'partials/development', 'gallery' ); ?>
		</div>

		<div class="row">
			<?php get_template_part( 'partials/development', 'mini-map' ); ?>
			<?php get_template_part( 'partials/development', 'quote' ); ?>
		</div>

		<div class="row">
			<?php get_template_part( 'partials/development', 'advert' ); ?>
			<?php get_template_part( 'partials/development', '360' ); ?>
			<?php get_template_part( 'partials/development', 'random-img' ); ?>
		</div>

	</div>

	<div id="siteplan">
		<div class="container">
			<div class="row">
				<?php if( have_rows('add_your_site_plans') ): while ( have_rows('add_your_site_plans') ) : the_row();
						the_sub_field('title');
						the_sub_field('active');
						the_sub_field('plan');
					endwhile;
				endif; ?>
			</div>
		</div>
	</div>

<?php
get_footer();