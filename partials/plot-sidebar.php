				<?php 
				$developmentID  = get_field('choose_development');
				$dev_colour = get_field('development_colour', $developmentID[0]); 
				?>
				
				<div class="intro">
					<h2 style="color: <?php echo $dev_colour; ?>"><?php the_field('Town', $developmentID[0]); ?>, <?php the_field('county', $developmentID[0]); ?> <?php the_field('post_code', $developmentID[0]); ?></h2>
					<br>
				</div>

				<div class="quicklinks">
					<?php
					$plot_brochure = get_field('brochure_link'); 
					$plot_epc = get_field('epc_link'); 
					$plot_pdf = get_field('plot_plan_pdf'); 
					?>
					<ul>
						<li><a style="background-color: <?php echo $dev_colour; ?>" href="<?php echo get_permalink( $developmentID[0] ); ?>">Development Overview</a></li>
						<?php if($plot_brochure): ?>
							<li><a style="background-color: <?php echo $dev_colour; ?>" target="_blank" href="<?php echo $plot_brochure; ?>">Download Brochure</a></li>
						<?php endif; ?>
						<?php if($plot_epc): ?>
							<li><a style="background-color: <?php echo $dev_colour; ?>" target="_blank" href="<?php echo $plot_epc; ?>">Download EPC</a></li>
						<?php endif; ?>
						<?php if($plot_pdf): ?>
							<li><a style="background-color: <?php echo $dev_colour; ?>" target="_blank" href="<?php echo $plot_pdf; ?>">Download Plan</a></li>
						<?php endif; ?>
						<li><a style="background-color: <?php echo $dev_colour; ?>" href="#reginterest">Register your interest</a></li>
					</ul>
				</div>

				<div class="shareme" style="color: <?php echo $dev_colour; ?>" >
					<?php 
					if ( function_exists( 'sharing_display' ) ) {
						sharing_display( '', true );
					}
					?>
				</div>