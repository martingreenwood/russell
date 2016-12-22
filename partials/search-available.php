<?php
include(get_template_directory() . '/inc/get_vars.php');
$av_loop = new WP_Query( array( 
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

// Sort by price


// check if any location has been set
if ( isset($_GET['location']) || isset($_GET['devlocation']) ) {

	// get loops stuff
	include('search-avail-loop-location.php');

// if not location set, defaut to all 
} else {

	include('search-avail-loop.php');

// end if no location 
}

?>