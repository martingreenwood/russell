<?php

$loop1 = get_posts( array( 
	'fields'			=> 'ids',
	'post_type' 		=> 'plots', 
	'posts_per_page' 	=> -1,
	'orderby'  			=> 'meta_value',
	'order'     		=> 'ASC',
	'meta_query' 		=> array(
		array(
			'key'     	=> 'plot_availability',
			'value'   	=> 'available',
			'compare' 	=> '=',
		),
	),
));
$loop2 = get_posts( array( 
	'fields' 			=> 'ids',
	'post_type' 		=> 'plots', 
	'posts_per_page' 	=> -1,
	'orderby'  			=> 'meta_value',
	'order'      		=> 'ASC',
	'meta_query' 		=> array(
		array(
			'key'     	=> 'plot_availability',
			'value'   	=> 'release-soon',
			'compare' 	=> '=',
		),
	),
));
$loop3 = get_posts( array( 
    'fields'         	=> 'ids',
	'post_type' 		=> 'plots', 
	'posts_per_page' 	=> -1,
	'orderby'  			=> 'meta_value',
	'order'      		=> 'ASC',
	'meta_query' 		=> array(
		array(
			'key'     	=> 'plot_availability',
			'value'   	=> 'not-released',
			'compare' 	=> '=',
		),
	),
));
$loop4 = get_posts( array( 
    'fields'         	=> 'ids',
	'post_type' 		=> 'plots', 
	'posts_per_page' 	=> -1,
	'orderby'  			=> 'meta_value',
	'order'      		=> 'ASC',
	'meta_query' 		=> array(
		array(
			'key'     	=> 'plot_availability',
			'value'   	=> 'affordable',
			'compare' 	=> '=',
		),
	),
));

// merging ids
$post_ids = array_merge_recursive( $loop1, $loop2, $loop3, $loop4 );

// the main query
$loop = new WP_Query(array(
	'post_type' 		=> 'plots',
	'post__in'  		=> $post_ids
));



// available
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => home_url() . "/wp-json/wp/v2/plots/?filter[posts_per_page]=-1&filter[meta_key]=plot_availability&filter[meta_value]=available",

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
  CURLOPT_URL => home_url() . "/wp-json/wp/v2/plots/?filter[posts_per_page]=-1&filter[meta_key]=plot_availability&filter[meta_value]=release-soon",

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
  CURLOPT_URL => home_url() . "/wp-json/wp/v2/plots/?filter[posts_per_page]=-1&filter[meta_key]=plot_availability&filter[meta_value]=not-released",

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
  CURLOPT_URL => home_url() . "/wp-json/wp/v2/plots/?filter[posts_per_page]=-1&filter[meta_key]=plot_availability&filter[meta_value]=affordable",

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
	<?php 

	// check to see if devlocation has been set
	if(isset($_GET['devlocation'])):
			
		// check for max of everything from homepage		
		if ( in_array($dev_title_filter, $devlocation) && $house_rooms >= $bedrooms && $plot_price_filter >= $minprice && $plot_price_filter <= $maxprice ):


			while ( $loop->have_posts() ) : $loop->the_post();

				$big_title 				= get_field('big_title');
				$plot_price 			= get_field('plot_price');

				if (!$plot_price): 
					$plot_price_filter 	= $maxprice;
				else:
					$plot_price_filter 	= str_replace(",", "", $plot_price);
				endif;

				if (is_numeric($plot_price)): 
					$plot_price 		= number_format($plot_price);
				else: 
					$plot_price 		= "TBC";
				endif;


				if (get_field('special_offers')) {
					if(get_field('special_offers') != "help-to-buy") :
						$special_offers = get_field('special_offers');
					else:
						$special_offers = null;
					endif;
				}

				if (get_field('plot_features')) {
					$plot_features 		= get_field('plot_features');
					$plot_features 		= explode(",", $plot_features);
				}

				$choose_development 	= get_field('choose_development');
				$choose_house_type 		= get_field('choose_house_type');
				
				if(get_field('plot_availability')):
					$plot_availability 	= get_field('plot_availability');
				endif;

				$plot_number 		= get_the_title();
				$plot_number 		= explode(" ", $plot_number);
				$plot_link 			= get_permalink();

				$house_image 		= get_the_post_thumbnail( current($choose_house_type) );
				if(!$house_image) $house_image = '<div class="placeholder-image"><div class="table"><div class="cell middle"><img src="' . get_template_directory_uri() . "/assets/no-img.png" . '"></div></div></div>';
				$house_rooms 		= get_field('number_of_bedrooms', current($choose_house_type));
				
				$dev_title 			= get_the_title( current($choose_development) ); 
				$dev_title_filter 	= strtolower(str_replace(' ','-', get_the_title( current($choose_development) ))); 
				$dev_link 			= get_permalink( current($choose_development) ); 
				$dev_location 		= strtolower(str_replace(' ','-', get_field('Town', current($choose_development) )));

				$dorder = null;
				if ($plot_availability == 'available') {
					$dorder  = 1;
				} else if ($plot_availability == 'release-soon') {
					$dorder  = 2;
				} else if ($plot_availability == 'not-released') {
					$dorder  = 3;
				} else if ($plot_availability == 'affordable') {
					$dorder  = 4;
				}

				?>
				<div class="search-result" data-order="<?php echo $dorder; ?>" data-availabiility="<?php echo $plot_availability; ?>" data-price="<?php echo $plot_price_filter; ?>" data-room="<?php echo $house_rooms; ?>" data-location="<?php echo $dev_location; ?>">
				<?php echo $plot_availability; ?>

					<?php if($special_offers): ?> 
					<div class="feature col-<?php echo count($special_offers); ?>">
						<?php
						foreach ($special_offers as $special_offer) {
							echo "<p class='".$special_offer."'>" . str_replace("-", " ", $special_offer) . "</p>";
						}
						?>
					</div>
					<?php endif; ?>

					<?php echo $house_image; ?>
					
					<?php if( !isset($plot->acf->hide_htb )): ?>
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
			<?php
			endwhile; wp_reset_query(); 

		// end check for global max params
		endif;

	// if npt from homepage check if search page search
	elseif (isset($_GET['location'])):

		// check agains submitted search
		if ( strtolower($dev_location) == $location && $house_rooms >= $bedrooms && $plot_price_filter >= $minprice && $plot_price_filter <= $maxprice ):

			while ( $loop->have_posts() ) : $loop->the_post();

				$big_title 				= get_field('big_title');
				$plot_price 			= get_field('plot_price');

				if (!$plot_price): 
					$plot_price_filter 	= $maxprice;
				else:
					$plot_price_filter 	= str_replace(",", "", $plot_price);
				endif;

				if (is_numeric($plot_price)): 
					$plot_price 		= number_format($plot_price);
				else: 
					$plot_price 		= "TBC";
				endif;


				if (get_field('special_offers')) {
					if(get_field('special_offers') != "help-to-buy") :
						$special_offers = get_field('special_offers');
					else:
						$special_offers = null;
					endif;
				}

				if (get_field('plot_features')) {
					$plot_features 		= get_field('plot_features');
					$plot_features 		= explode(",", $plot_features);
				}

				$choose_development 	= get_field('choose_development');
				$choose_house_type 		= get_field('choose_house_type');
				
				if(get_field('plot_availability')):
					$plot_availability 	= get_field('plot_availability');
				endif;

				$plot_number 		= get_the_title();
				$plot_number 		= explode(" ", $plot_number);
				$plot_link 			= get_permalink();

				$house_image 		= get_the_post_thumbnail( current($choose_house_type) );
				if(!$house_image) $house_image = '<div class="placeholder-image"><div class="table"><div class="cell middle"><img src="' . get_template_directory_uri() . "/assets/no-img.png" . '"></div></div></div>';
				$house_rooms 		= get_field('number_of_bedrooms', current($choose_house_type));
				
				$dev_title 			= get_the_title( current($choose_development) ); 
				$dev_title_filter 	= strtolower(str_replace(' ','-', get_the_title( current($choose_development) ))); 
				$dev_link 			= get_permalink( current($choose_development) ); 
				$dev_location 		= strtolower(str_replace(' ','-', get_field('Town', current($choose_development) )));

		$dorder = null;
		if ($plot_availability == 'available') {
			$dorder  = 1;
		} else if ($plot_availability == 'release-soon') {
			$dorder  = 2;
		} else if ($plot_availability == 'not-released') {
			$dorder  = 3;
		} else if ($plot_availability == 'affordable') {
			$dorder  = 4;
		}

				?>
				<div class="search-result" data-order="<?php echo $dorder; ?>" data-availabiility="<?php echo $plot_availability; ?>" data-price="<?php echo $plot_price_filter; ?>" data-room="<?php echo $house_rooms; ?>" data-location="<?php echo $dev_location; ?>">
				<?php echo $plot_availability; ?>

					<?php if($special_offers): ?> 
					<div class="feature col-<?php echo count($special_offers); ?>">
						<?php
						foreach ($special_offers as $special_offer) {
							echo "<p class='".$special_offer."'>" . str_replace("-", " ", $special_offer) . "</p>";
						}
						?>
					</div>
					<?php endif; ?>

					<?php echo $house_image; ?>
					
					<?php if( !isset($plot->acf->hide_htb )): ?>
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
			<?php
			endwhile; wp_reset_query(); 

		// end check for global max params
		endif;

	// end if locations are set....
	endif;

	/*
	foreach ($data as $plot): 

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
				<div class="feature col-<?php echo count($special_offers); ?>">
					<?php
					foreach ($special_offers as $special_offer) {
						echo "<p class='".$special_offer."'>" . str_replace("-", " ", $special_offer) . "</p>";
					}
					?>
				</div>
				<?php endif; ?>

				<?php echo $house_image; ?>
				
				<?php if( !isset($plot->acf->hide_htb )): ?>
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
			<?php // end check for global max params
			endif;

		// if npt from homepage check if search page search
		elseif (isset($_GET['location'])):
			
			// check agains submitted search
			if ( strtolower($dev_location) == $location && $house_rooms >= $bedrooms && $plot_price_filter >= $minprice && $plot_price_filter <= $maxprice ):
			
			?>
			<div class="search-result" data-availabiility="<?php echo $plot_availability; ?>" data-price="<?php echo $plot_price_filter; ?>" data-room="<?php echo $house_rooms; ?>" data-location="<?php echo $dev_location; ?>">

				<?php if($special_offers): ?> 
				<div class="feature col-<?php echo count($special_offers); ?>">
					<?php
					foreach ($special_offers as $special_offer) {
						echo "<p class='".$special_offer."'>" . str_replace("-", " ", $special_offer) . "</p>";
					}
					?>
				</div>
				<?php endif; ?>

				<?php echo $house_image; ?>

				<?php if( !isset($plot->acf->hide_htb )): ?>
				<?php if($plot_availability != "affordable"): ?>
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
			<?php // end if matches search queries
			endif;
			
		// end if locations are set....
		endif;
		
	// end loop for properties
	endforeach; 
	*/

// if not location set, defaut to all 
} else {


	?>

	<div id="results">

	<?php 
	while ( $loop->have_posts() ) : $loop->the_post();

		$big_title 				= get_field('big_title');
		$plot_price 			= get_field('plot_price');

		if (!$plot_price): 
			$plot_price_filter 	= $maxprice;
		else:
			$plot_price_filter 	= str_replace(",", "", $plot_price);
		endif;

		if (is_numeric($plot_price)): 
			$plot_price 		= number_format($plot_price);
		else: 
			$plot_price 		= "TBC";
		endif;


		if (get_field('special_offers')) {
			if(get_field('special_offers') != "help-to-buy") :
				$special_offers = get_field('special_offers');
			else:
				$special_offers = null;
			endif;
		}

		if (get_field('plot_features')) {
			$plot_features 		= get_field('plot_features');
			$plot_features 		= explode(",", $plot_features);
		}

		$choose_development 	= get_field('choose_development');
		$choose_house_type 		= get_field('choose_house_type');
		
		if(get_field('plot_availability')):
			$plot_availability 	= get_field('plot_availability');
		endif;

		$plot_number 		= get_the_title();
		$plot_number 		= explode(" ", $plot_number);
		$plot_link 			= get_permalink();

		$house_image 		= get_the_post_thumbnail( current($choose_house_type) );
		if(!$house_image) $house_image = '<div class="placeholder-image"><div class="table"><div class="cell middle"><img src="' . get_template_directory_uri() . "/assets/no-img.png" . '"></div></div></div>';
		$house_rooms 		= get_field('number_of_bedrooms', current($choose_house_type));
		
		$dev_title 			= get_the_title( current($choose_development) ); 
		$dev_title_filter 	= strtolower(str_replace(' ','-', get_the_title( current($choose_development) ))); 
		$dev_link 			= get_permalink( current($choose_development) ); 
		$dev_location 		= strtolower(str_replace(' ','-', get_field('Town', current($choose_development) )));

		$dorder = null;
		if ($plot_availability == 'available') {
			$dorder  = 1;
		} else if ($plot_availability == 'release-soon') {
			$dorder  = 2;
		} else if ($plot_availability == 'not-released') {
			$dorder  = 3;
		} else if ($plot_availability == 'affordable') {
			$dorder  = 4;
		}


	?>
	<div class="search-result" data-order="<?php echo $dorder; ?>" data-availabiility="<?php echo $plot_availability; ?>" data-price="<?php echo $plot_price_filter; ?>" data-room="<?php echo $house_rooms; ?>" data-location="<?php echo $dev_location; ?>">
	<?php echo $plot_availability; ?>

		<?php if($special_offers): ?> 
		<div class="feature col-<?php echo count($special_offers); ?>">
			<?php
			foreach ($special_offers as $special_offer) {
				echo "<p class='".$special_offer."'>" . str_replace("-", " ", $special_offer) . "</p>";
			}
			?>
		</div>
		<?php endif; ?>

		<?php echo $house_image; ?>
		
		<?php if( !isset($plot->acf->hide_htb )): ?>
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
	<?php
	endwhile; wp_reset_query(); ?>

	<?php 
	/*foreach ($data as $plot): 

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
			<div class="feature col-<?php echo count($special_offers); ?>">
				<?php
				foreach ($special_offers as $special_offer) {
					echo "<p class='".$special_offer."'>" . str_replace("-", " ", $special_offer) . "</p>";
				}
				?>
			</div>
			<?php endif; ?>

			<?php echo $house_image; ?>

			<?php if( !isset($plot->acf->hide_htb )): ?>
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
		<?php

	// end loop for properties
	endforeach;
	*/ 

// end if no location 
}

?>