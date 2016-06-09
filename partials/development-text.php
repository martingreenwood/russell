			<?php 
				$text_bg_colour = get_sub_field('text_bg_colour');
				$text_colour = get_sub_field('text_colour');
			?>
			<div class="text_box" style="background-color: <?php echo $text_bg_colour; ?>; color: <?php echo $text_colour; ?>;">
				<?php if(have_rows('feature_block_one')): 
				while(have_rows('feature_block_one')): the_row(); 
				$block_logo = get_sub_field('image'); ?>
				<a href="<?php the_sub_field('page'); ?>">
					<img src="<?php echo $block_logo['url']; ?>" alt="">
					<p><?php the_sub_field('content'); ?></p>
				</a>
				<?php endwhile; endif; ?>
			</div>
