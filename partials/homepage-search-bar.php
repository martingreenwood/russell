		<div class="container">

			<div class="search">
				<h3>Find your new home...</h3>
				<div class="search-box" class="clear">
					<select id="location" name="location">
					<option value="">Location</option>
					<?php

					$all_developments = new WP_Query(array( 
						'post_type' => 'developments', 
						'posts_per_page' => -1,
					));

					$development_locations = array();
					while ( $all_developments->have_posts() ) : $all_developments->the_post();
						$development_location = get_field('Town');
						$development_locations[] = $development_location;
					endwhile; wp_reset_query();

					$unique_development_locations = array_unique($development_locations);

					foreach ($unique_development_locations as $development_location) {
						echo "<option value='".strtolower($development_location)."'>".$development_location."</option>";
					}

					?>
					</select>
					<select id="bedrooms" name="bedrooms">
						<option value="0">Min Bedrooms</option>
						<option value="1">One</option>
						<option value="2">Two</option>
						<option value="3">Three</option>
						<option value="4">Four</option>
						<option value="5">Five</option>
					</select>

					<input type="button" id="search_developments" value="Search Homes">
					
					<div id="loading"></div>
				</div>
			</div>

			<div class="social">
				<ul>
					<li>
						<a class="twitter scl" href="https://twitter.com/RussellArmer" target="_blank" title="Twitter">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
					</li>
					<li>
						<a class="ytube scl" href="https://www.youtube.com/user/russellarmerla96ll" target="_blank" titlw="Youtube">
							<i class="fa fa-youtube" aria-hidden="true"></i>
						</a>
					</li>
					<li>
						<a class="gplus scl" href="https://plus.google.com/115283757929642128482" target="_blank" title="Google Plus">
							<i class="fa fa-google-plus" aria-hidden="true"></i>
						</a>
					</li>
				</ul>
				
				<p>Sales: 01539 724282</p>
				<p>Head Office: 01539 722635</p>
			</div>
		</div>