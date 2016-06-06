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
					<?php
					$development_brochure = get_field('development_brochure'); 
					?>
					<ul>
						<li><a href="#reginterest">Register your interest</a></li>
						<li><a href="#" id="search" data-search="<?php echo str_replace(' ', '-', get_the_title()) ?>">Search for gomes at Cragg Close</a></li>
						<?php if($development_brochure): ?>
							<li><a target="_blank" href="<?php echo $development_brochure['url']; ?>">Download a brochure</a></li>
						<?php endif; ?>
						<li><a href="#siteplan">View site plan</a></li>
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

				<ul class="tabs">
				<?php 
				if( have_rows('add_your_site_plans') ): 
				while ( have_rows('add_your_site_plans') ) : the_row();
				$plan_title = get_sub_field('title');
				$plan_active = get_sub_field('active');
				$plan_plan = get_sub_field('plan');
				?>
				<li class="tab">
					<a href="#<?php echo str_replace(' ','-',strtolower($plan_title)); ?>" class="tab-link <?php if($plan_active): ?>is-active<?php endif; ?>"><?php echo $plan_title; ?></a>
				</li>
				<?php endwhile;
				endif; ?>
				<?php 
				$development_siteplan_pdf = get_field('development_siteplan_pdf');
				if ($development_siteplan_pdf): ?>
				<li class="plan-download">
					<a target="_blank" href="<?php echo $development_siteplan_pdf['url']; ?>">Download Siteplan &amp; Spcification</a>
				</li>
				<?php endif; ?>
				</ul>

				<ul class="tabs-body">
				<?php 
				if( have_rows('add_your_site_plans') ): 
				while ( have_rows('add_your_site_plans') ) : the_row();
				$plan_title = get_sub_field('title');
				$plan_active = get_sub_field('active');
				$plan_plan = get_sub_field('plan');
				?>
					<li id="<?php echo str_replace(' ','-',strtolower($plan_title)); ?>" class="tab-content <?php if($plan_active): ?>is-active<?php endif; ?>">
						<img src="<?php echo $plan_plan['url']; ?>" alt="<?php echo get_the_title() . ' ' . $plan_title; ?>">

						<!-- PLOTS -->
						<?php echo $post->ID; ?>
						<ul id="plots">
						<?php 
						$args = array( 
							'post_type' 		=> 'plots', 
							'posts_per_page' 	=> -1,
							'meta_key' 			=> 'choose_development',
							'meta_value' 		=> '146',
						);

						$plots = get_posts(array(
							'post_type' => 'plots',
							'posts_per_page' 	=> -1,
							'meta_query' => array(
								array(
									'key' => 'choose_development', // name of custom field
									'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
									'compare' => 'LIKE'
								)
							)
						));

						if ($plots) {
							foreach( $plots as $plot ): ?>
							<li>
								<h4><?php echo get_the_title( $plot->ID ); ?></h4>
								<p><?php the_field('choose_development', $plot->ID); ?></p>
							</li>
							<?php endforeach;
						}

						/*$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<li>
								<h4><?php the_title(); ?></h4>
								<p><?php the_field('choose_development'); ?></p>
							</li>
						<?php endwhile; wp_reset_query(); wp_reset_postdata();*/
						?>
						</ul>

					</li>
				<?php endwhile;
				endif; ?>
				</ul>

				<div class="ledgend">
					<ul>
						<li>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/available.svg"> <span>Available</span>
						</li>
						<li>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/sold.svg"> <span>Sold</span>
						</li>
						<li>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/reserved.svg"> <span>Reserved</span>
						</li>
						<li>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/coming-soon.svg"> <span>Coming Soon</span>
						</li>
						<li>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/not-released.svg"> <span>Not Released</span>
						</li>
						<li>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/show-home.svg"> <span>Show Home</span>
						</li>
					</ul>
				</div>

			</div>
		</div>
	</div>

<?php
get_footer();