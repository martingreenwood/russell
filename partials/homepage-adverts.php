			<div class="adverts clear">
				<div class="advert help-to-buy">
					<?php if(have_rows('feature_block_one')): 
					while(have_rows('feature_block_one')): the_row(); 
					$block_logo = get_sub_field('image'); ?>
					<a href="<?php the_sub_field('page'); ?>">
						<img src="<?php echo $block_logo['url']; ?>" alt="">
						<p><?php the_sub_field('content'); ?></p>
					</a>
					<?php endwhile; endif; ?>
				</div>
				<div class="advert wide feature-plot">
					<?php   
					$feature_plot_obj = get_field('feature_property'); 
					$feature_plot_id = $feature_plot_obj->ID;
					$feature_plot_title = $feature_plot_obj->post_title; // xx development name
					$feature_plot_title = explode(" ", $feature_plot_title); // explode on space
					$feature_plot_title = current($feature_plot_title); // get the first array value

					$feature_plot_heading = get_field('big_title', $feature_plot_id); // x bedroom house
					$feature_plot_price = get_field('plot_price', $feature_plot_id); // price

					$feature_plot_development_id = current(get_field('choose_development', $feature_plot_id)); // id
					$feature_plot_development_title = get_the_title($feature_plot_development_id); // development
					$feature_plot_development_town = get_field('Town', $feature_plot_development_id); // town

					$feature_plot_house_type = current(get_field('choose_house_type', $feature_plot_id)); // id
					$feature_plot_house_type_thumbnail = get_the_post_thumbnail( $feature_plot_house_type, 'full' ); //<img> 
					?>

					<div class="img">
						<?php echo $feature_plot_house_type_thumbnail; ?>
					</div>
					<div class="deets">
						<h2>Featured<br>Property</h2>
						<p><strong><?php echo $feature_plot_development_title; ?>, <?php echo $feature_plot_development_town; ?></strong></p>						
						<p><strong>Plot <?php echo $feature_plot_title; ?></strong><br>
						<?php echo $feature_plot_heading; ?></p>
						<h3>£<?php echo number_format($feature_plot_price); ?></h3>
					</div>
				</div>
			</div>