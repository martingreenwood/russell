			<?php 
				$text_bg_colour = get_sub_field('text_bg_colour');
				$text_colour = get_sub_field('text_colour');
			?>
			<div class="text_box" style="background-color: <?php echo $text_bg_colour; ?>; color: <?php echo $text_colour; ?>;">
				<?php $block_logo = get_sub_field('icon'); ?>
				<a href="<?php the_sub_field('link'); ?>">
					<img src="<?php echo $block_logo['url']; ?>" alt="">
					<p><?php the_sub_field('text'); ?></p>
				</a>
			</div>
