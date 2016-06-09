						<?php
						$dev_colour = get_field('development_colour');
						$asoc_gallery = get_sub_field('asoc_gallery'); 
						$asoc_gal_ID = $asoc_gallery[0]->ID;
						$development_gallery = get_field('development_gallery', $asoc_gal_ID, false);
						$coverImg = current($development_gallery);
						$coverImgSrc = wp_get_attachment_image_src( $coverImg, 'large' );
						?>
						<div class="feature-gallery" style="background-image:url(<?php echo $coverImgSrc[0] ?>)">
							<div class="clickme" style="background-color: <?php echo $dev_colour; ?>">
								<h2>Photo Gallery</h2><p>View all photographs of the development</p>
								<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 143 97.85"><defs><style>.house-icon-svg{fill:<?php echo $dev_colour; ?>;stroke:<?php echo $dev_colour; ?>;stroke-linecap:square;stroke-width:15px;}</style></defs><title>house_tab</title><polygon class="house-icon-svg" points="7.5 90.36 7.5 62.02 71.64 9.69 135.5 62.02 135.5 90.36 7.5 90.36"/></svg>
							</div>
							<?php
								$shortcode = '[gallery link="file" columns="1" size="devfeat" ids="' . implode(',', $development_gallery) . '"]';
								echo do_shortcode( $shortcode );
							?>
						</div>
