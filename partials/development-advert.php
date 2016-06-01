			<div class="help-to-buy third">
				<?php if(have_rows('feature_block_one')): 
				while(have_rows('feature_block_one')): the_row(); 
				$block_logo = get_sub_field('image'); ?>
				<a href="<?php the_sub_field('page'); ?>">
					<img src="<?php echo $block_logo['url']; ?>" alt="">
					<p><?php the_sub_field('content'); ?></p>
				</a>
				<?php endwhile; endif; ?>
			</div>
