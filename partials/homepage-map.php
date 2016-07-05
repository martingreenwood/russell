		<div id="mps-container">

			<div class="key">
				<p><span class="av">Available</span> <span class="rs">Release Soon</span></p>
			</div>
			
			<div class="home-map">

				<?php
				$available_developments = new WP_Query(array( 
					'post_type' => 'developments', 
					'posts_per_page' => -1,
					'meta_key'		=> 'development_stage',
					'meta_value'	=> 'complete',
					'meta_compare'	=> '!='
				));

				while ( $available_developments->have_posts() ) : $available_developments->the_post(); 
				$location = get_field('development_map'); $dev_id = $available_developments->post->ID; ?>
					<div class="marker" data-icon="<?php echo get_template_directory_uri(); ?>/assets/<?php the_field('development_stage');?>.png" data-target="<?php echo str_replace(' ', '-', strtolower( get_the_title() )); ?>" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
					</div>
				<?php endwhile; wp_reset_postdata(); ?>

			</div>

			<div id="map_popups">
				<div class="container">
					<?php
					$available_developments = new WP_Query(array( 
						'post_type' => 'developments', 
						'posts_per_page' => -1,
						'meta_key'		=> 'development_stage',
						'meta_value'	=> 'complete',
						'meta_compare'	=> '!='
					));

					while ( $available_developments->have_posts() ) : $available_developments->the_post(); 
					$location = get_field('development_map'); $dev_id = $available_developments->post->ID; 
					if (get_field('starting_price')) {
						$starting_price = number_format( get_field('starting_price'), 0 );
					} else {
						$starting_price = "TBC";
					}
					?>
					<div class="box">
						<div class="table">
							<div class="cell middle">
								<div class="map_popup clear <?php echo str_replace(' ', '-', strtolower( get_the_title() )); ?>">

									<div class="popup_content clear">
										
										<div class="popup_gallery">
											<?php the_post_thumbnail( 'thumbnail' ); ?>
										</div>
										<div class="popup_info">
											<div class="top_text">
												<h3><?php the_title(); ?></h3>
												<p class="develeopment_location"><?php the_field('Town'); ?>, <?php the_field('county'); ?>, <?php the_field('post_code'); ?></p>
											</div>
											<div class="development_text">
												<h3><?php the_field('bedroom_overview'); ?>
												<br>starting from £<?php echo $starting_price ?></h3>
												<?php //$theexcerpt = explode(".", get_the_excerpt()); echo current($theexcerpt)."..."; ?>
											</div>
											<div class="development_view"> <a href="<?php the_permalink(); ?>">View development</a></div>
										</div>
									</div>
									<a href="#" class="close_popup" rel="cambridge-drive">&nbsp;</a>
								</div>
							</div>
						</div>
					</div>
					<?php endwhile; wp_reset_postdata(); ?>

				</div>
			</div>
		</div>