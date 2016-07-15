				<?php 
				$developmentID  = get_field('choose_development');
				$house_typeID  = get_field('choose_house_type');
				$dev_colour = get_field('development_colour', $developmentID[0]); 
				$plot_epc = get_field('epc_link'); 
				if(get_field('plot_plan_pdf')) {
					$plot_pdf = get_field('plot_plan_pdf');
				}
				else {
					$plot_pdf = get_field('house_type_plan_pdf', $house_typeID[0]);
				}
				?>

				<div class="row titlea">
					<h2 style="color: <?php echo $dev_colour; ?>">Floor Plan</h2>
					
					<ul class="links">
						<?php if($plot_epc): ?>
							<li><a style="background-color: <?php echo $dev_colour; ?>" target="_blank" href="<?php echo $plot_epc; ?>">Download EPC</a></li>
						<?php endif; ?>
						<?php if($plot_pdf): ?>
							<li><a style="background-color: <?php echo $dev_colour; ?>" target="_blank" href="<?php echo $plot_pdf; ?>">Download Plan</a></li>
						<?php endif; ?>
					</ul>
				</div>

				<div class="row">
				<?php while ( have_rows('floor_plan',$house_typeID[0])) : the_row(); ?>
					<?php 
						$plan_image = get_sub_field('plan_image');
						$plan_width = get_sub_field('width');
						if (!$plan_width || is_array($plan_width)) {
							$plan_width = 'span4';
						}
					?>
					<div class="room <?php echo $plan_width; ?>">
						<img src="<?php echo $plan_image['url']; ?>" alt="floor plan for this plot">
						<div class="desc" style="color: <?php echo $dev_colour; ?>">
							<?php the_sub_field('plan_desc'); ?>
						</div>
					</div>
				<?php endwhile; ?>
				</div>

				<div class="row">
					<div class="caveat">
						<?php the_field('fp_caveat', $house_typeID[0]); ?>
					</div>
				</div>
