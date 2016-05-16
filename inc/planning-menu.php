<?php

/**
 * AUTO DEV MENU HELPER
 */

add_filter( 'wp_nav_menu_objects', 'build_plan_menu', 10, 2 );
function build_plan_menu( $items, $args ) {

	if ($args->theme_location == 'primary') {

		// Available Developments
		$all_planning = new WP_Query(array( 
			'post_type' => 'planning', 
			'posts_per_page' => -1,
			//'meta_key'		=> 'development_stage',
			//'meta_value'	=> 'available'
		));

		$plan_Count = 999999999999999994567;

		while ( $all_planning->have_posts() ) : $all_planning->the_post(); 

			$plan_Count++;

			$av_plan = array (
				'title'            => get_the_title(),
				'menu_item_parent' => 5174,
				'ID'               => $plan_Count, //an unlikely, high number
				'db_id'            => $plan_Count, //an unlikely, high number
				'url'              => get_the_permalink()
			);

			$items[] = (object) $av_plan;

		endwhile; wp_reset_postdata();


	}

    return $items;    

}