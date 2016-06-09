							<div class="image">
								<?php if(get_sub_field('image_url')): ?> 
								<a href="<?php the_sub_field('image_url') ?>">
								<?php endif; ?>

									<?php 
									$image = get_sub_field('image');
									$imageSize = get_sub_field('image_size');
									
									//thumbnail : Thumbnail (300x300 CROPPED)
									//large : Large (1024 x 1024)
									//full : Full Res

									if($imageSize == 'thumbnail'):
										$the_image = '<img src="'.$image['sizes']['thumbnail'].'" alt="">';
									elseif($imageSize == 'large'):
										$the_image = '<img src="'.$image['sizes']['large'].'" alt="">';
									elseif($imageSize == 'thumbnail'):
										$the_image = '<img src="'.$image['url'].'" alt="">';
									else:
										$the_image = '<img src="'.$image['sizes']['thumbnail'].'" alt="">';
									endif;
									
									echo $the_image; ?>
								
								<?php if(get_sub_field('image_url')): ?> 
								</a>
								<?php endif; ?>
							</div>
