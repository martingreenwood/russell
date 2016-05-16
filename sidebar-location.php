<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package russell
 */

//if ( ! is_active_sidebar( 'sidebar-1' ) ) {
//	return;
//}
?>

<aside id="secondary" class="widget-area" role="complementary">

	<div id="whats-about">
	<?php the_field('location_sidebar_content'); ?>
	</div>
	
</aside><!-- #secondary -->
