				<div class="intro">
					<h2><?php the_field('Town'); ?>, <?php the_field('county'); ?> <?php the_field('post_code'); ?></h2>
					<br>
					<h3><?php the_field('bedroom_overview'); ?>
					<br>starting from £<span class="price"><?php the_field('starting_price'); ?></span></h3>
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
					<h3><?php the_field('visitor_opening_times'); ?></h3>
				</div>

				<div class="shareme">
					<?php 
					if ( function_exists( 'sharing_display' ) ) {
						sharing_display( '', true );
					}
					?>
				</div>