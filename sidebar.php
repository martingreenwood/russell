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

	<?php if( is_page()) : ?>
		<div id="siblings">

		<h3 class="menu_title"><?php echo get_the_title( $post->post_parent ); ?></h3>
		<ul>
		<?php
		global $post;
		$current_page_parent = ( $post->post_parent ? $post->post_parent : $post->ID );
		wp_list_pages( array(
		     'title_li' => '',
		     'child_of' => $current_page_parent,
		     'depth' => '1' )
		);
		?>
		</ul>

	</div>
	<?php endif; ?>

	<?php if( is_home()) : ?>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php endif; ?>
</aside><!-- #secondary -->
