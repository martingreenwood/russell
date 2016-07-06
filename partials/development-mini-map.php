			<div class="small-map">
				<?php $development_map = get_field('development_map', $post->ID);
				if( !empty($development_map) ):
				?>
				<div class="mini-map">
					<div class="marker" data-icon="<?php echo get_template_directory_uri(); ?>/assets/available.png" data-lat="<?php echo $development_map['lat']; ?>" data-lng="<?php echo $development_map['lng']; ?>"></div>
				</div>
				<?php endif; ?>
			</div>
