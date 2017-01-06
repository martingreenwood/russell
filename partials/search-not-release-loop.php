<?php
include(get_template_directory() . '/inc/get_vars.php');
while ( $nrs_loop->have_posts() ) : $nrs_loop->the_post();

	$big_title 				= get_field('big_title');
	$plot_price 			= get_field('plot_price');

	if (!$plot_price): 
		$plot_price_filter 	= 900000;
	else:
		$plot_price_filter 	= str_replace(",", "", $plot_price);
	endif;

	if (is_numeric($plot_price)): 
		$plot_price 		= number_format($plot_price);
	else: 
		$plot_price 		= "TBC";
	endif;

	$special_offers = null;
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

	// get HTML
	include('search-result-html.php');

endwhile; wp_reset_query(); 