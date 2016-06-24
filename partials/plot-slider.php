		<?php 
		$house_typeID  = get_field('choose_house_type');
		$developmentID  = get_field('choose_development');
		
		if (has_post_thumbnail( $house_typeID[0])):
			echo get_the_post_thumbnail( $house_typeID[0], 'full');
		else: ?>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/default.jpg" alt="Russell Armer Homes">
		<?php endif; ?>

		<?php 
			$development_logo = get_field('development_logo', $developmentID[0]); 
			if ($development_logo): ?>
			<div id="dev_logo">
				<div class="container">
					<img src="<?php echo $development_logo['url']; ?>" width="195" height="195">
				</div>
			</div>
			<?php endif; 
		?>