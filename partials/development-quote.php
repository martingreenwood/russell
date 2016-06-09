			<?php 
				$feat_quote = get_sub_field('quote');
				$feat_quote = current($feat_quote);
				$quote_bg_color = get_sub_field('quote_bg_color');
				$quote_text_colour = get_sub_field('quote_text_colour');
				$quote_name_colour = get_sub_field('quote_name_colour');
			?>
			<div class="quote">

				<?php //print_r($feat_quote); ?>

				<h3 style="color: <?php echo $quote_text_colour; ?>">
					<?php echo $feat_quote->post_content; ?>
				</h3>
				<p style="color: <?php echo $quote_name_colour; ?>">
					<?php echo $feat_quote->post_title; ?>
				</p>
			</div>
