		<?php $dev_colour = get_field('development_colour'); ?>
		<div class="container">
			<div class="row">
				<h2 style="color: <?php echo $dev_colour; ?>">Local Area</h2>

				<div class="intro">
					<?php $local_link = get_field('local_area_link'); ?>
					<?php the_field('intro_content'); ?>
					<p><a style="background-color: <?php echo $dev_colour; ?>" href="<?php echo $local_link; ?>">Read More about the local area</a>
				</div>
				
				<div class="legend">
					<ul>
						<li>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/school.svg" alt="">
							Schools &amp; Education</li>
						<li>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/sports.svg" alt="">
							Sports &amp; Leisure</li>
						<li>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/shopping.svg" alt="">
							Shopping</li>
						<li>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/transport.svg" alt="">
							Public Transport</li>
					</ul>
				</div>
			</div>
		</div>

		<?php $development_map = get_field('development_map');
		if( !empty($development_map) ):
		?>
		<div class="local-map">
			<div class="marker" data-icon="<?php echo get_template_directory_uri(); ?>/assets/available.png" data-lat="<?php echo $development_map['lat']; ?>" data-lng="<?php echo $development_map['lng']; ?>">
				<h4 style="color: <?php echo $dev_colour; ?>; margin: 0;"><?php the_title(); ?></h4>
			</div>
			<?php
			if( have_rows('amenities') ): while ( have_rows('amenities') ) : the_row();
			$amenity_location = get_sub_field('location'); 
			$amenity_type = get_sub_field('type'); 
			$amenity_name = get_sub_field('name'); 
			?>
			<div class="marker" data-icon="<?php echo get_template_directory_uri(); ?>/assets/<?php echo $amenity_type; ?>.png" data-lat="<?php echo $amenity_location['lat']; ?>" data-lng="<?php echo $amenity_location['lng']; ?>">
				<h4 style="color: <?php echo $dev_colour; ?>; margin: 0;"><?php echo $amenity_name ?></h4>
			</div>
			<?php endwhile;
			endif;
			?>
		</div>
		<?php endif; ?>

		<div class="container">
			<div class="row">

				<div class="schools type">
					<h3 style="color: <?php echo $dev_colour; ?>">Schools &amp; Education</h3>
					<?php
					if( have_rows('amenities') ): 
						while ( have_rows('amenities') ) : the_row();
							$amenity_location = get_sub_field('location'); 
							$amenity_type = get_sub_field('type'); 
							$amenity_name = get_sub_field('name'); 
							if ($amenity_type == 'school'):
							?>
							<p>
								<a class="map_link" href="#" rel="<?php echo $amenity_location['lat']; ?>, <?php echo $amenity_location['lng']; ?>">
									<?php echo $amenity_name ?>
								</a>
							</p>
					<?php endif; 
						endwhile;
					endif;
					?>
				</div>

				<div class="sports type">
					<h3 style="color: <?php echo $dev_colour; ?>">Sports &amp; Leisure</h3>
					<?php
					if( have_rows('amenities') ): 
						while ( have_rows('amenities') ) : the_row();
							$amenity_location = get_sub_field('location'); 
							$amenity_type = get_sub_field('type'); 
							$amenity_name = get_sub_field('name'); 
							if ($amenity_type == 'sports'):
							?>
							<p>
								<a class="map_link" href="#" rel="<?php echo $amenity_location['lat']; ?>, <?php echo $amenity_location['lng']; ?>">
									<?php echo $amenity_name ?>
								</a>
							</p>
					<?php endif; 
						endwhile;
					endif;
					?>
				</div>

				<div class="shopipng type">
					<h3 style="color: <?php echo $dev_colour; ?>">Shopping</h3>
					<?php
					if( have_rows('amenities') ): 
						while ( have_rows('amenities') ) : the_row();
							$amenity_location = get_sub_field('location'); 
							$amenity_type = get_sub_field('type'); 
							$amenity_name = get_sub_field('name'); 
							if ($amenity_type == 'shopping'):
							?>
							<p>
								<a class="map_link" href="#" rel="<?php echo $amenity_location['lat']; ?>, <?php echo $amenity_location['lng']; ?>">
									<?php echo $amenity_name ?>
								</a>
							</p>
					<?php endif; 
						endwhile;
					endif;
					?>
				</div>

				<div class="transport type">
					<h3 style="color: <?php echo $dev_colour; ?>">Public Transport</h3>
					<?php
					if( have_rows('amenities') ): 
						while ( have_rows('amenities') ) : the_row();
							$amenity_location = get_sub_field('location'); 
							$amenity_type = get_sub_field('type'); 
							$amenity_name = get_sub_field('name'); 
							if ($amenity_type == 'transport'):
							?>
							<p>
								<a class="map_link" href="#" rel="<?php echo $amenity_location['lat']; ?>, <?php echo $amenity_location['lng']; ?>">
									<?php echo $amenity_name ?>
								</a>
							</p>
					<?php endif; 
						endwhile;
					endif;
					?>
				</div>

			</div>
		</div>
