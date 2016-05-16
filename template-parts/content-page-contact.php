<?php
/**
 * Template part for displaying page content in page-contact-us.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package russell
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="column entry-content">
		<?php the_content(); ?>
	</div>

	<div class="column">
		<div class="general">
			<h4>General Enquiries</h4>
			<p>Tel: <?php the_field('gci_phone'); ?></p>
			<p><a href="mailto:<?php the_field('gci_email'); ?>"><?php the_field('gci_email'); ?></a></p>
		</div>
		<div class="sales">
			<h4>Sales</h4>
			<p>Tel: <?php the_field('sales_phone'); ?></p>
			<p><a href="mailto:<?php the_field('sales_email'); ?>"><?php the_field('sales_email'); ?></a></p>
		</div>
		<div class="care">
			<h4>Customer Care (Weekday Mornings or Emergencies)</h4>
			<p>Tel: <?php the_field('cc_phone'); ?></p>
			<p><a href="mailto:<?php the_field('cc_email'); ?>"><?php the_field('cc_email'); ?></a></p>
		</div>
	</div>

	<div class="column">
		<div class="headoffice">
			<h4>Head Ofice</h4>
			<?php the_field('ho_address'); ?>
		</div>
	</div>
</article>
