	<section id="homesearch">
		<div class="container">

			<div class="search">
				<h3>Find your new home...</h3>
				<div class="search-box clear">
					<form id="quicksearch" method="get" action="<?php echo home_url( '/properties' ); ?>">
						
						<fieldset>
							<select id="location" required="" data-parsley-error-message="<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>" name="location">
							<option value="">Select Location</option>
							<?php
							$all_developments = new WP_Query(array( 
								'post_type' 		=> 'developments', 
								'posts_per_page' 	=> -1,
								'meta_key'			=> 'development_stage',
								'meta_value'		=> 'complete',
								'meta_compare'		=> '!=',
							));

							$development_locations = array();
							while ( $all_developments->have_posts() ) : $all_developments->the_post();
								$development_location = get_field('Town');
								$development_locations[] = $development_location;
							endwhile; wp_reset_query();

							$unique_development_locations = array_unique($development_locations);

							foreach ($unique_development_locations as $development_location) {
								if ($development_location):
								echo "<option value='".strtolower($development_location)."'>".$development_location."</option>";
								endif;
							}

							?>
							</select>
						</fieldset>
						<fieldset>
							<select id="bedrooms" required="" data-parsley-error-message="<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>" name="bedrooms">
								<option value="">Select Min Bedrooms</option>
								<option value="1">One</option>
								<option value="2">Two</option>
								<option value="3">Three</option>
								<option value="4">Four</option>
								<option value="5">Five</option>
							</select>
						</fieldset>

						<fieldset class="price-box" style="display: none;">
							<select id="minprice" name="minprice">
								<option value="100000">£100,000</option>
							</select>
							<select id="maxprice" name="maxprice">
								<option value="900000">£900,000</option>
							</select>
						</fieldset>

						<input type="submit" id="search_developments" value="Search Homes">
					</form>
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
	</section>