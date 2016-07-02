							<div class="image">
								<?php 
								$image_link = get_sub_field('image_link');

								if($image_link == 'page'): ?> 
								<a href="<?php the_sub_field('image_url') ?>">
								<?php endif; ?>

								<?php if($image_link == 'file'): ?> 
								<a href="<?php the_sub_field('image_file') ?>">
								<?php endif; ?>

									<?php 
									$image = get_sub_field('image');
									$imageSize = get_sub_field('image_size');
									
									//thumbnail : Thumbnail (300x300 CROPPED)
									//large : Large (1024 x 1024)
									//full : Full Res

									if($imageSize == 'thumbnail'):
										$the_image = '<img src="'.$image['sizes']['grid-square'].'" alt="">';
									elseif($imageSize == 'large'):
										$the_image = '<img src="'.$image['sizes']['large'].'" alt="">';
									elseif($imageSize == 'thumbnail'):
										$the_image = '<img src="'.$image['url'].'" alt="">';
									else:
										$the_image = '<img src="'.$image['sizes']['thumbnail'].'" alt="">';
									endif;
									
									echo $the_image; ?>
								
								<?php if($image_link != 'none'): ?> 
								</a>
								<?php endif; ?>
							</div>
