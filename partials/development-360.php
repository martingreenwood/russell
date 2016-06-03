			<div class="view360 third">
				<?php if (get_field('enable_360_popup')): ?>
					<a href="#open360">
						<div class="icon360"></div>
						<?php $view360 = get_field('360_image'); ?>
						<img src="<?php echo $view360['sizes']['thumbnail']; ?>" alt="">
					</a>
					<div id="open360">
						<a class="close_popup" href="#open360"></a>
						<div class="table">
							<div class="cell middle">
								<iframe 
									name="Development 360" 
									src="<?php the_field('360_url'); ?>" 
									align="middle" 
									frameborder="0"
									height="480"
									width="640"
									></iframe>
							</div>
						</div>
					</div>
				<?php else: ?>
					<?php $view360 = get_field('360_fallback_image'); ?>
					<img src="<?php echo $view360['sizes']['thumbnail']; ?>" alt="">
				<?php endif; ?>
			</div>
