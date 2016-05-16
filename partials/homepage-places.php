			<div class="text">
				<?php the_field('additional_content'); ?>
			</div>
			<div class="dev-list">
				<?php
				$all_developments = new WP_Query(array( 
					'post_type' => 'developments', 
					'posts_per_page' => -1,
					'meta_key'		=> 'development_stage',
					'meta_value'	=> 'available'
				));

				$development_locations = array();
				while ( $all_developments->have_posts() ) : $all_developments->the_post();
					$development_location = get_field('county');
					$development_locations[] = $development_location;

				endwhile; wp_reset_postdata();

				$unique_development_locations = array_unique($development_locations);
				
				foreach ($unique_development_locations as $development_location) { ?>
					<div class="devs">
					<h3><?php echo $development_location; ?></h3>
					
					<?php $avilable_developments = new WP_Query(array( 
						'post_type' => 'developments', 
						'posts_per_page' => -1,
						'meta_key'		=> 'county',
						'meta_value'	=> strtolower($development_location),
					));

					while ( $avilable_developments->have_posts() ) : $avilable_developments->the_post(); 
					if ( get_field('development_stage') === 'available' ): ?>
					<p><a tite="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?>, <?php the_field('Town'); ?></a></p>
					<?php endif; endwhile; wp_reset_postdata(); ?>
				</div>
				<?php
				}
				?>
				<div class="devs">
				<h3>Coming Soon</h3>
				<?php
					$release_soon_developments = new WP_Query(array( 
						'post_type' => 'developments', 
						'posts_per_page' => -1,
						'meta_key'		=> 'development_stage',
						'meta_value'	=> 'release-soon'
					));

					while ( $release_soon_developments->have_posts() ) : $release_soon_developments->the_post(); ?>
						<p><a tite="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?>, <?php the_field('Town'); ?></a></p>
					<?php endwhile; wp_reset_postdata();

				?>
				</div>
			</div>