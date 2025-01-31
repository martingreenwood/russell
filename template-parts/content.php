<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package russell
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
			<a href="<?php the_permalink();?>">
				<?php if(has_post_thumbnail()): the_post_thumbnail('full'); endif;

				the_title( '<h2 class="post-title">', '</h2>' ); ?>
			</a>
			<small>Posted on <?php the_date(); ?> | <?php the_category(', ') ?></small>

			<?php the_excerpt();
			
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'russell' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
