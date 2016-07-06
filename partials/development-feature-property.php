							<div class="prop">
								<?php 
								$feature_property_image = get_sub_field('feature_property_image');
								$feature_property_link = get_sub_field('feature_property_link');

								$choose_development = get_field('choose_development', $feature_property_link->ID);
								$developmentID = $choose_development[0];

								$plotTitle = get_the_title( $feature_property_link->ID );
								$plotTitle = explode(" ", $plotTitle);
								$plotTitle = current($plotTitle);

								if($feature_property_link): ?> 
								<a href="<?php the_permalink($feature_property_link->ID); ?>">
								<?php endif; ?>

									<div class="prop-img" style="background-image: url(<?php echo $feature_property_image['url']; ?>);"></div>

									<div class="prop-deets">
										<h2>Feature Property</h2>
										<p class="location"><?php echo get_the_title( $developmentID ); ?>, <?php echo get_field('Town', $developmentID); ?></p>
										<p class="plot_number">Plot <?php echo $plotTitle; ?>: <?php echo get_field('big_title', $feature_property_link->ID); ?></p>

										<h3>£<?php echo number_format(get_field('plot_price', $feature_property_link->ID)); ?></h3>

										<span>View Property</span>

									</div>
								
								<?php if($feature_property_link): ?> 
								</a>
								<?php endif; ?>
							</div>
 