<?php
/**
 * The template for displaying all single plots.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package russell
 */
get_header(); 
?>

	<div class="feature-image">
		<?php if (has_post_thumbnail()) :
			the_post_thumbnail('cover1600');
		else: ?>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/default.jpg" alt="Russell Armer Homes">
		<?php endif; ?>
	</div>

	<div class="container">
		<div class="page-title">
			<?php the_title("<h1>","</h1>"); ?>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<?php
			$development_gallery = get_field('development_gallery', $post->ID, false);
			the_content();
			?>
			<div class="feature-gallery" style="background-image:url(<?php echo $coverImgSrc[0] ?>)">
			<?php
				$shortcode = '[gallery type="rectangular" link="file" size="large" ids="' . implode(',', $development_gallery) . '"]';
				echo do_shortcode( $shortcode );
			?>
			</div>
		</div>
	</div>

<?php
get_footer();