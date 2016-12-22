<?php
/**
 * The template for displaying the properties page (search).
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package russell
 */

get_header(); 

include('inc/get_vars.php');

?>

	<div class="feature-image">
		<?php if (has_post_thumbnail()) :
			the_post_thumbnail('cover1600');
		else: ?>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/default.jpg" alt="Russell Armer Homes">
		<?php endif; ?>
	</div>

	<div class="search search-box">
		<div class="container clear">
			
			<h3>Find your new home...</h3>
			<form id="quicksearch" method="get" action="<?php echo home_url( '/properties' ); ?>">
				
				<fieldset class="location-box">
					<legend>Location</legend>
					<p><input type="checkbox" id="selectall"><label>Select All</label></p>
					<?php
					$all_developments = new WP_Query(array( 
						'post_type' 		=> 'developments', 
						'posts_per_page' 	=> -1,
						'meta_key'			=> 'development_stage',
						'meta_value'		=> 'complete',
						'meta_compare'		=> '!=',
					));

					$development_locations = array();
					while ( $all_developments->have_posts() ) : $all_developments->the_post();
						$development_location = get_field('Town');
						$dev_id = get_the_id();
						$dev_search_name = strtolower(str_replace(' ','-', get_the_title()));
						if(isset($devlocation)):
							if(in_array($dev_search_name, $devlocation)) {
								$checked = 'checked';
							} else {
								$checked = '';
							}
						else:
							$checked = '';
						endif;

						if(isset($location)) {
							if ( strtolower($development_location) == $location ) {
								$checked = 'checked';
							}
						}

						echo "<p><input class='location-checkbox' name='devlocation[]' type='checkbox' ".$checked." data-id='".$dev_id."' data-location='".strtolower($development_location)."' value='".$dev_search_name."'><label>".get_the_title().", ".$development_location."</label></p>";
					endwhile; wp_reset_query();
					?>
				</fieldset>

				<fieldset class="bedroom-box">
					<legend>Min Bedrooms</legend>
					<select id="bedrooms" required="" data-parsley-error-message="This field is required..." name="bedrooms">
						<option value="">Select Min Bedrooms</option>
						<?php 
						foreach (range(1,5) as $b): ?>
						<option <?php if($bedrooms == $b) { ?>selected<?php } ?> value="<?php echo $b; ?>"><?php echo $b; ?></option>
						<?php endforeach; ?>
					</select>
				</fieldset>

				<fieldset class="price-box">
					<legend>Price Range (£)</legend>
					<select id="minprice" required="" data-parsley-error-message="This field is required..." name="minprice">
						<option value="">Select Min Price</option>
						<?php 
						foreach (range(100000,900000,10000) as $min_p): ?>
						<option <?php if($minprice == $min_p) { ?>selected<?php } ?> value="<?php echo $min_p; ?>">£<?php echo number_format($min_p); ?></option>
						<?php endforeach; ?>
					</select>

					<select id="maxprice" required="" data-parsley-error-message="This field is required..." name="maxprice">
						<option value="">Select Max Price</option>
						<?php 
						foreach (range(100000,900000,10000) as $max_p): ?>
						<option <?php if($maxprice == $max_p) { ?>selected<?php } ?> value="<?php echo $max_p; ?>">£<?php echo number_format($max_p); ?></option>
						<?php endforeach; ?>
					</select>
				</fieldset>

				<input type="submit" id="search_developments" value="Search Homes">
			</form>
		</div>
	</div>


	<div class="container">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<div class="title">
					<p class="left">&nbsp;</p>
					<p class="right">Sort by <span class="sort1">price (low to high)</span> <span class="sort2">price (high to low)</span></p>
					<div class="clear"></div>
				</div>

				<div id="results">
				<?php
				// available
				get_template_part( 'partials/search', 'available' );

				// release-soon
				get_template_part( 'partials/search', 'release-soon' );

				// not-released
				get_template_part( 'partials/search', 'not-released' );

				// affordable
				get_template_part( 'partials/search', 'affordable' );
				?>
				</div>

			</main>
		</div>
	</div>

<?php
get_footer();