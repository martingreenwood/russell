	<?php $slides = get_field('homepage_slider'); if( $slides ): ?>
	    <div class="slick">
	        <?php foreach( $slides as $image ): $sliderlink = get_field('slider_url', $image['ID']); ?>
	            <div>
	                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
	                <div class="caption-wrap">
	                	<div class="container">
	                		<h2><?php echo $image['caption']; ?></h2>
	                		<p><?php echo $image['description']; ?></p>
	                		<?php if ($sliderlink): ?><a href="<?php echo $sliderlink; ?>">More Information</a><?php endif; ?>
	                	</div>
	                </div>
	            </div>
	        <?php endforeach; ?>
	    </div>
	<?php endif; ?>

	<?php if (get_field('mobile_fallback_image')): ?>
	<div class="mobileimage" style="background-image: url(<?php echo get_field('mobile_fallback_image'); ?>);"></div>
	<?php endif; ?>
	