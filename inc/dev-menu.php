<?php

/**
 * AUTO DEV MENU HELPER
 */

add_filter( 'wp_nav_menu_objects', 'build_dev_menu', 10, 2 );
function build_dev_menu( $items, $args ) {

	if ($args->theme_location == 'primary') {

		// Available Developments
		$all_developments = new WP_Query(array( 
			'post_type' => 'developments', 
			'posts_per_page' => -1,
			'meta_key'		=> 'development_stage',
			'meta_value'	=> 'available'
		));

		$development_locations = array();
		$dev_Count = 9999999991234;
		$dev_sub_count = 99999999999991234;
		$coming_soon_count = 999999999999974322;
		while ( $all_developments->have_posts() ) : $all_developments->the_post();
			$development_location = get_field('county');
			$development_locations[] = $development_location;

		endwhile; wp_reset_postdata();

		// Group by unique county
		$unique_development_locations = array_unique($development_locations);
		
		foreach ($unique_development_locations as $development_location) {
			$dev_Count++;
			
			$dev_locs = array (
				'title'            => $development_location,
				'menu_item_parent' => 5146,
				'ID'               => $dev_Count, //an unlikely, high number
				'db_id'            => $dev_Count, //an unlikely, high number
				'url'              => '#'
			);

			$items[] = (object) $dev_locs;

			// get available by county
			$avilable_developments = new WP_Query(array( 
				'post_type' => 'developments', 
				'posts_per_page' => -1,
				'meta_key'		=> 'county',
				'meta_value'	=> strtolower($development_location),
			));

			while ( $avilable_developments->have_posts() ) : $avilable_developments->the_post(); 
				if ( get_field('development_stage') === 'available' ):

				$dev_sub_count++;

				$av_devs = array (
					'title'            => get_the_title() . ", " . get_field('Town'),
					'menu_item_parent' => $dev_Count,
					'ID'               => $dev_sub_count, //an unlikely, high number
					'db_id'            => $dev_sub_count, //an unlikely, high number
					'url'              => get_the_permalink()
				);

				$items[] = (object) $av_devs;

			endif; endwhile; wp_reset_postdata();
		}

		// coming soon developments

		$coming_soon = array (
			'title'            => 'Coming Soon',
			'menu_item_parent' => 5146,
			'ID'               => 999999999999974321, //an unlikely, high number
			'db_id'            => 999999999999974321, //an unlikely, high number
			'url'              => "#"
		);

		$items[] = (object) $coming_soon;

		$release_soon_developments = new WP_Query(array( 
			'post_type' => 'developments', 
			'posts_per_page' => -1,
			'meta_key'		=> 'development_stage',
			'meta_value'	=> 'release-soon'
		));

		while ( $release_soon_developments->have_posts() ) : $release_soon_developments->the_post();

			$coming_soon_count++;

			$cs_devs = array (
				'title'            => get_the_title() . ", " . get_field('Town'),
				'menu_item_parent' => 999999999999974321,
				'ID'               => $coming_soon_count, //an unlikely, high number
				'db_id'            => $coming_soon_count, //an unlikely, high number
				'url'              => get_the_permalink()
			);
			$items[] = (object) $cs_devs;

		endwhile; wp_reset_postdata();

		// View All Devs

		$view_all = array (
			'title'            => 'View all Properties',
			'menu_item_parent' => 5146,
			'classes'		   => 'view_all_props',
			'ID'               => 99999999999987654, //an unlikely, high number
			'db_id'            => 99999999999987654, //an unlikely, high number
			'url'              => home_url( '/properties/')
		);
		$items[] = (object) $view_all;

		// View Gallery

		$gallery = array (
			'title'            => 'Our Gallery',
			'menu_item_parent' => 5146,
			'ID'               => 99999999999987655, //an unlikely, high number
			'db_id'            => 99999999999987655, //an unlikely, high number
			'url'              => home_url( '/gallery/' )
		);

		$items[] = (object) $gallery;

	}

    return $items;    

}