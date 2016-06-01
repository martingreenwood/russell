			<div class="small-map">
				<?php $development_map = get_field('development_map');
				if( !empty($development_map) ):
				?>
				<div class="map">
					<div class="marker" data-icon="<?php echo get_template_directory_uri(); ?>/assets/available.svg" data-lat="<?php echo $development_map['lat']; ?>" data-lng="<?php echo $development_map['lng']; ?>"></div>
				</div>
				<?php endif; ?>
			</div>
