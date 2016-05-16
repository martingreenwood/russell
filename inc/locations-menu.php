<?php

/**
 * AUTO DEV MENU HELPER
 */

add_filter( 'wp_nav_menu_objects', 'build_loc_menu', 10, 2 );
function build_loc_menu( $items, $args ) {

	if ($args->theme_location == 'primary') {

		// Available Developments
		$all_locations = new WP_Query(array( 
			'post_type' => 'locations', 
			'posts_per_page' => -1,
			//'meta_key'		=> 'development_stage',
			//'meta_value'	=> 'available'
		));

		$loc_Count = 99999999999994567;

		while ( $all_locations->have_posts() ) : $all_locations->the_post(); 

			$loc_Count++;

			$av_loc = array (
				'title'            => get_the_title() . ", " . get_field('Town'),
				'menu_item_parent' => 5178,
				'ID'               => $loc_Count, //an unlikely, high number
				'db_id'            => $loc_Count, //an unlikely, high number
				'url'              => get_the_permalink()
			);

			$items[] = (object) $av_loc;

		endwhile; wp_reset_postdata();


	}

    return $items;    

}