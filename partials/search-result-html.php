			<div class="search-result" data-dev="<?php echo current($choose_development); ?>" data-order="<?php echo $dorder; ?>" data-availabiility="<?php echo $plot_availability; ?>" data-price="<?php echo $plot_price_filter; ?>" data-room="<?php echo $house_rooms; ?>" data-location="<?php echo $dev_location; ?>">
				<?php //echo $plot_availability; ?>

				<?php if(isset($special_offers)): ?> 
				<div class="feature col-<?php echo count($special_offers); ?>">
					<?php
					foreach ($special_offers as $special_offer) {
						echo "<p class='".$special_offer."'>" . str_replace("-", " ", $special_offer) . "</p>";
					}
					?>
				</div>
				<?php endif; ?>

				<?php echo $house_image; ?>
				
				<?php if( !get_field('hide_htb')): ?>
					<?php if($plot_availability != "affordable" ): ?>
						<span class="htb-logo"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/htb_logo.svg"></span>
					<?php endif; ?>
				<?php endif; ?>

				<div class="sub-title">
					<small><?php echo $dev_title; ?> - Plot <?php echo current($plot_number); ?></small>
					<h3><?php echo $big_title; ?></h3>
				</div>
				<hr>
				<div class="plot_features">
					<?php if($plot_features): ?>
					<ul>
					<?php foreach ($plot_features as $plot_feature): ?>
						<li><?php echo $plot_feature; ?></li>
					<?php endforeach; ?>
					</ul>
					<?php endif; ?>
				</div>

				<div class="houseprice">
					<p><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/price.svg" alt=""> £<?php echo $plot_price; ?></p>
					<p><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/bedrooms.svg" alt=""> <?php echo $house_rooms ?> Bedrooms</p>
					<div class="clear"></div>
				</div>

				<a class="btn" href="<?php echo $plot_link; ?>">View Plot</a>
				<a class="btn" href="<?php echo $dev_link; ?>">View Development</a>

			</div>