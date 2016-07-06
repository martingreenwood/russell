							<div class="prop">
								<?php 
								$feature_property_image = get_sub_field('feature_property_image');
								$feature_property_link = get_sub_field('feature_property_link');

								if($feature_property_link): ?> 
								<a href="<?php the_permalink($feature_property_link->ID); ?>">
								<?php endif; ?>

									<div class="prop-img" style="background-image: url(<?php echo $feature_property_image['url']; ?>);"></div>

									<div class="prop-deets">
										<pre><?php print_r($feature_property_link); ?></pre>
									</div>
								
								<?php if($feature_property_link): ?> 
								</a>
								<?php endif; ?>
							</div>
