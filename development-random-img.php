			<div class="randomimage third">
				<?php
				$asoc_gallery = get_field('associated_development'); 
				$asoc_gal_ID = $asoc_gallery->ID;
				$development_gallery = get_field('development_gallery', $asoc_gal_ID, false);
				$coverImg = end($development_gallery);
				$coverImgSrc = wp_get_attachment_image( $coverImg );
				?>
				<?php echo $coverImgSrc; ?>">
			</div>
