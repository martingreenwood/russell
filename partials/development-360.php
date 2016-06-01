			<div class="view360 third">
				<?php if (get_field('enable_360_popup')): ?>
					<a href="<?php the_field('360_url'); ?>">
						<div class="icon360"></div>
						<?php $view360 = get_field('360_image'); ?>
						<img src="<?php echo $view360['sizes']['thumbnail']; ?>" alt="">
					</a>
				<?php else: ?>
					<?php $view360 = get_field('360_fallback_image'); ?>
					<img src="<?php echo $view360['sizes']['thumbnail']; ?>" alt="">
				<?php endif; ?>
			</div>
