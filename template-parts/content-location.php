<?php
/**
 * Template part for displaying locations.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package russell
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</article>
