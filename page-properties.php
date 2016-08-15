<?php
/**
 * The template for displaying the properties page (search).
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package russell
 */

// POSTED FROM HOMEPAGE
//Need to make this run a query to get dev names based on location provided...
if (isset($_POST['qs_town'])) {
	$qs_town = $_POST['qs_town'];
} else {
	$qs_town = null;
}

if (isset($_POST['qs_rooms'])) {
	$qs_rooms = $_POST['qs_rooms'];
} else {
	$qs_rooms = null;
}

// GET SEARCH VARS
if (isset($_GET['devlocation'])) {
	$devlocation = $_GET['devlocation'];
} else {
	$devlocation = null;
}

if (isset($_GET['location'])) {
	$location = $_GET['location'];
} else {
	$location = null;
}

if (isset($_GET['bedrooms'])) {
	$bedrooms = $_GET['bedrooms'];
} else {
	$bedrooms = null;
}

if (isset($_GET['maxprice'])) {
	$maxprice = $_GET['maxprice'];
} else {
	$maxprice = 900000;
}

if (isset($_GET['minprice'])) {
	$minprice = $_GET['minprice'];
} else {
	$minprice = 0;
}

get_header(); ?>

	<div class="feature-image">
		<?php if (has_post_thumbnail()) :
			the_post_thumbnail('cover1600');
		else: ?>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/default.jpg" alt="Russell Armer Homes">
		<?php endif; ?>
	</div>

	<div class="search search-box">
		<div class="container clear">
			
			<h3>Find your new home...</h3>
			<form id="quicksearch" method="get" action="<?php echo home_url( '/properties' ); ?>">
				
				<fieldset class="location-box">
					<legend>Location</legend>
					<p><input type="checkbox" id="selectall"><label>Select All</label></p>
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
						$dev_id = get_the_id();
						$dev_search_name = strtolower(str_replace(' ','-', get_the_title()));
						if(isset($devlocation)):
							if(in_array($dev_search_name, $devlocation)) {
								$checked = 'checked';
							} else {
								$checked = '';
							}
						else:
							$checked = '';
						endif;

						if(isset($location)) {
							if ( strtolower($development_location) == $location ) {
								$checked = 'checked';
							}
						}

						echo "<p><input class='location-checkbox' name='devlocation[]' type='checkbox' ".$checked." data-id='".$dev_id."' data-location='".strtolower($development_location)."' value='".$dev_search_name."'><label>".get_the_title().", ".$development_location."</label></p>";
					endwhile; wp_reset_query();
					?>
				</fieldset>

				<fieldset class="bedroom-box">
					<legend>Min Bedrooms</legend>
					<select id="bedrooms" required="" data-parsley-error-message="This field is required..." name="bedrooms">
						<option value="">Select Min Bedrooms</option>
						<?php 
						foreach (range(1,5) as $b): ?>
						<option <?php if($bedrooms == $b) { ?>selected<?php } ?> value="<?php echo $b; ?>"><?php echo $b; ?></option>
						<?php endforeach; ?>
					</select>
				</fieldset>

				<fieldset class="price-box">
					<legend>Price Range (£)</legend>
					<select id="minprice" required="" data-parsley-error-message="This field is required..." name="minprice">
						<option value="">Select Min Price</option>
						<?php 
						foreach (range(100000,900000,10000) as $min_p): ?>
						<option <?php if($minprice == $min_p) { ?>selected<?php } ?> value="<?php echo $min_p; ?>">£<?php echo number_format($min_p); ?></option>
						<?php endforeach; ?>
					</select>

					<select id="maxprice" required="" data-parsley-error-message="This field is required..." name="maxprice">
						<option value="">Select Max Price</option>
						<?php 
						foreach (range(100000,900000,10000) as $max_p): ?>
						<option <?php if($maxprice == $max_p) { ?>selected<?php } ?> value="<?php echo $max_p; ?>">£<?php echo number_format($max_p); ?></option>
						<?php endforeach; ?>
					</select>
				</fieldset>

				<input type="submit" id="search_developments" value="Search Homes">
			</form>
		</div>
	</div>


	<div class="container">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<div class="title">
					<p class="left">&nbsp;</p>
					<p class="right">Sort by <span class="sort1">price (low to high)</span> <span class="sort2">price (high to low)</span></p>
					<div class="clear"></div>
				</div>
				<?php

				// affordable
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => home_url() . "/wp-json/wp/v2/plots/?filter[posts_per_page]=-1&[meta_key]=plot_availability&filter[meta_value]=available",

				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_HTTPHEADER => array(
				    "cache-control: no-cache",
				  ),
				));

				$head = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				$av_data = json_decode($head);

				$price = array();
				foreach ($av_data as $key => $row)
				{
				    $price[$key] = $row->acf->plot_price;
				}
				array_multisort($price, SORT_ASC, $av_data);

				// release soons
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => home_url() . "/wp-json/wp/v2/plots/?filter[posts_per_page]=-1&[meta_key]=plot_availability&filter[meta_value]=release-soon",

				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_HTTPHEADER => array(
				    "cache-control: no-cache",
				  ),
				));

				$head = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				$rs_data = json_decode($head);

				$price = array();
				foreach ($rs_data as $key => $row)
				{
				    $price[$key] = $row->title->rendered;
				}
				array_multisort($price, SORT_ASC, $rs_data);

				// not released
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => home_url() . "/wp-json/wp/v2/plots/?filter[posts_per_page]=-1&[meta_key]=plot_availability&filter[meta_value]=not-released",

				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_HTTPHEADER => array(
				    "cache-control: no-cache",
				  ),
				));

				$head = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				$nr_data = json_decode($head);

				$price = array();
				foreach ($nr_data as $key => $row)
				{
				    $price[$key] = $row->title->rendered;
				}
				array_multisort($price, SORT_ASC, $nr_data);

				// affordable
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => home_url() . "/wp-json/wp/v2/plots/?filter[posts_per_page]=-1&[meta_key]=plot_availability&filter[meta_value]=affordable",

				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_HTTPHEADER => array(
				    "cache-control: no-cache",
				  ),
				));

				$head = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				$af_data = json_decode($head);

				$price = array();
				foreach ($af_data as $key => $row)
				{
				    $price[$key] = $row->title->rendered;
				}
				array_multisort($price, SORT_ASC, $af_data);

				// errors
				if ($err) {
				  echo "cURL Error #:" . $err;
				} 

				$data = array_merge_recursive($av_data, $rs_data, $nr_data, $af_data);

				// check if any location has been set
				if ( isset($_GET['location']) || isset($_GET['devlocation']) ) {
					?>
					
					<div id="results">
					<?php foreach ($data as $plot): 

						$big_title 			= $plot->acf->big_title;
						$plot_price 		= $plot->acf->plot_price;

						if (!$plot_price): 
							$plot_price_filter = $maxprice;
						else:
							$plot_price_filter = str_replace(",", "", $plot_price);
						endif;

						if (is_numeric($plot_price)): 
							$plot_price = number_format($plot_price);
						else: 
							$plot_price = "TBC";
						endif;


						if (isset($plot->acf->special_offers)) {
							if($plot->acf->special_offers != "help-to-buy") :
							$special_offers 	= $plot->acf->special_offers;
							else:
								$special_offers = null;
							endif;
						}

						if (isset($plot->acf->plot_features)) {
							$plot_features 		= $plot->acf->plot_features;
							$plot_features 		= explode(",", $plot_features);
						}

						$choose_development = $plot->acf->choose_development;
						$choose_house_type 	= $plot->acf->choose_house_type;
						
						if(isset($plot->acf->plot_availability)):
							$plot_availability 	= $plot->acf->plot_availability;
						endif;

						$plot_number 		= $plot->title->rendered;
						$plot_number 		= explode(" ", $plot_number);
						$plot_link 			= $plot->link;

						$house_image 		= get_the_post_thumbnail( current($choose_house_type) );
						if(!$house_image) $house_image = '<div class="placeholder-image"><div class="table"><div class="cell middle"><img src="' . get_template_directory_uri() . "/assets/no-img.png" . '"></div></div></div>';
						$house_rooms 		= get_field('number_of_bedrooms', current($choose_house_type));
						
						$dev_title 			= get_the_title( current($choose_development) ); 
						$dev_title_filter 	= strtolower(str_replace(' ','-', get_the_title( current($choose_development) ))); 
						$dev_link 			= get_permalink( current($choose_development) ); 
						$dev_location 		= strtolower(str_replace(' ','-', get_field('Town', current($choose_development) )));
						
						// check to see if devlocation has been set
						if(isset($_GET['devlocation'])):
							
							// check for max of everything from homepage		
							if ( in_array($dev_title_filter, $devlocation) && $house_rooms >= $bedrooms && $plot_price_filter >= $minprice && $plot_price_filter <= $maxprice ):
							
							?>
							<div class="search-result" data-availabiility="<?php echo $plot_availability; ?>" data-price="<?php echo $plot_price_filter; ?>" data-room="<?php echo $house_rooms; ?>" data-location="<?php echo $dev_location; ?>">

								<?php if($special_offers): ?> 
								<div class="feature">
									<p><?php echo str_replace("-"," ", $special_offers); ?></p>
								</div>
								<?php endif; ?>

								<?php echo $house_image; ?>

								<span class="htb-logo"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/htb_logo.svg"></span>

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
							<?php // end check for global max params
							endif;

						// if npt from homepage check if search page search
						elseif (isset($_GET['location'])):
							
							// check agains submitted search
							if ( strtolower($dev_location) == $location && $house_rooms >= $bedrooms && $plot_price_filter >= $minprice && $plot_price_filter <= $maxprice ):
							
							?>
							<div class="search-result" data-availabiility="<?php echo $plot_availability; ?>" data-price="<?php echo $plot_price_filter; ?>" data-room="<?php echo $house_rooms; ?>" data-location="<?php echo $dev_location; ?>">
								<span class="ribbon"><?php echo $plot_availability; ?></span>

								<?php if($special_offers): ?> 
								<div class="feature">
									<p><?php echo str_replace("-"," ", $special_offers); ?></p>
								</div>
								<?php endif; ?>

								<?php echo $house_image; ?>

								<span class="htb-logo"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/htb_logo.svg"></span>

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
							<?php // end if matches search queries
							endif;
							
						// end if locations are set....
						endif;
						
					// end loop for properties
					endforeach; 

				// if not location set, defaut to all 
				} else {


					?>

					<div id="results">
					<?php foreach ($data as $plot): 

						$big_title 			= $plot->acf->big_title;
						$plot_price 		= $plot->acf->plot_price;

						if (!$plot_price): 
							$plot_price_filter = $maxprice;
						else:
							$plot_price_filter = str_replace(",", "", $plot_price);
						endif;
						if (is_numeric($plot_price)): 
							$plot_price = number_format($plot_price);
						else: 
							$plot_price = "TBC";
						endif;

						if (isset($plot->acf->special_offers)) {
							if($plot->acf->special_offers != "help-to-buy") :
							$special_offers 	= $plot->acf->special_offers;
							else:
								$special_offers = null;
							endif;
						}

						if (isset($plot->acf->plot_features)) {
							$plot_features 		= $plot->acf->plot_features;
							$plot_features 		= explode(",", $plot_features);
						}

						$choose_development = $plot->acf->choose_development;
						$choose_house_type 	= $plot->acf->choose_house_type;
						
						if(isset($plot->acf->plot_availability)):
							$plot_availability 	= $plot->acf->plot_availability;
						endif;

						$plot_number 		= $plot->title->rendered;
						$plot_number 		= explode(" ", $plot_number);
						$plot_link 			= $plot->link;

						$house_image 		= get_the_post_thumbnail( current($choose_house_type) );
						if(!$house_image) $house_image = '<div class="placeholder-image"><div class="table"><div class="cell middle"><img src="' . get_template_directory_uri() . "/assets/no-img.png" . '"></div></div></div>';
						$house_rooms 		= get_field('number_of_bedrooms', current($choose_house_type));
						
						$dev_title 			= get_the_title( current($choose_development) ); 
						$dev_title_filter 	= strtolower(str_replace(' ','-', get_the_title( current($choose_development) ))); 
						$dev_link 			= get_permalink( current($choose_development) ); 
						$dev_location 		= strtolower(str_replace(' ','-', get_field('Town', current($choose_development) )));
													
						?>
						<div class="search-result" data-availabiility="<?php echo $plot_availability; ?>" data-price="<?php echo $plot_price_filter; ?>" data-room="<?php echo $house_rooms; ?>" data-location="<?php echo $dev_location; ?>">

							<?php if($special_offers): ?> 
							<div class="feature">
								<p><?php echo str_replace("-"," ", $special_offers); ?></p>
							</div>
							<?php endif; ?>

							<?php echo $house_image; ?>

							<span class="htb-logo"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/htb_logo.svg"></span>

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
						<?php

					// end loop for properties
					endforeach; 

				// end if no location 
				}

				?>

				</div>

			</main>
		</div>
	</div>

<?php
get_footer();