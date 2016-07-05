	<?php $slides = get_field('homepage_slider'); if( $slides ): ?>
	    <div class="slick">
	        <?php foreach( $slides as $image ): $sliderlink = get_field('slider_url', $image['ID']); ?>
	            <div>
	            	<?php if ($sliderlink): ?><a href="<?php echo $sliderlink; ?>"><?php endif; ?>
	                
	                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
	                <div class="caption-wrap">
	                	<div class="container">
	                		<h2><?php echo $image['caption']; ?></h2>
	                		<p><?php echo $image['description']; ?></p>
	                	</div>
	                </div>

	                <?php if ($sliderlink): ?></a><?php endif; ?>
	            </div>
	        <?php endforeach; ?>
	    </div>
	<?php endif; ?>
