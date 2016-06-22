			<?php 
			$dev_colour = get_field('development_colour'); ?>

				<?php 
					//specification
					$spec_caveat = get_field('specification_caveat');
					
					//affordable spec
					$show_affordable_specificartion = get_field('show_affordable_specificartion');
					$aff_spec_caveat = get_field('affordable_specification_caveat');
				?>

				<ul class="spec-tabs">
					<li class="spec-tab">
						<a style="color: <?php echo $dev_colour; ?>" class="spec-tab-link is-active" href="#spec">Specification
						<?php if($spec_caveat): ?><small><?php echo $spec_caveat; ?></small><?php endif; ?>
						</a>
					</li>

					<?php if($show_affordable_specificartion): ?>
					<li class="spec-tab">
						<a style="color: <?php echo $dev_colour; ?>" class="spec-tab-link" href="#affspec">Affordable Specification
						<?php if($aff_spec_caveat): ?><small><?php echo $aff_spec_caveat; ?></small><?php endif; ?>
						</a>
					</li>
					<?php endif; ?>

				</ul>

				<div class="spec-ledgend">
					<ul>
						<li>
							<i style="color: <?php echo $dev_colour; ?>" class="fa fa-check-circle" aria-hidden="true"></i>
							Item included as standard - subject to stage of construction
						</li>
						<li>
							<i class="fa fa-plus-circle" aria-hidden="true"></i>
							Optional items available at extra cost subject to stage of construction of the property
						</li>
					</ul>
				</div>

				<ul class="spec-tabs-body">

					<li id="spec" class="spec-tab-content is-active">

						<div class="general-items items">
							<h3 style="color: <?php echo $dev_colour; ?>">General</h3>
							<ul>
							<?php 
							if( have_rows('general_items') ): while ( have_rows('general_items') ) : the_row();
							$optional = get_sub_field('optional');
							$item = get_sub_field('item'); ?>
								<li>
								<?php if($optional): ?>
									<i class="fa fa-plus-circle" aria-hidden="true"></i>
								<?php else: ?>
									<i style="color: <?php echo $dev_colour; ?>" class="fa fa-check-circle" aria-hidden="true"></i>
								<?php endif; ?>
									<span><?php echo $item; ?></span>
								</li>
							<?php endwhile;
							endif;
							?>
							</ul>
						</div>

						<div class="kitchen-items items">
							<h3 style="color: <?php echo $dev_colour; ?>">Kitchen</h3>
							<ul>
							<?php 
							if( have_rows('kitchen_items') ): while ( have_rows('kitchen_items') ) : the_row();
							$optional = get_sub_field('optional');
							$item = get_sub_field('item'); ?>
								<li>
								<?php if($optional): ?>
									<i class="fa fa-plus-circle" aria-hidden="true"></i>
								<?php else: ?>
									<i style="color: <?php echo $dev_colour; ?>" class="fa fa-check-circle" aria-hidden="true"></i>
								<?php endif; ?>
									<span><?php echo $item; ?></span>
								</li>
							<?php endwhile;
							endif;
							?>
							</ul>
						</div>

						<div class="bathroom-items items">
							<h3 style="color: <?php echo $dev_colour; ?>">Bathroom</h3>
							<ul>
							<?php 
							if( have_rows('bathroom_items') ): while ( have_rows('bathroom_items') ) : the_row();
							$optional = get_sub_field('optional');
							$item = get_sub_field('item'); ?>
								<li>
								<?php if($optional): ?>
									<i class="fa fa-plus-circle" aria-hidden="true"></i>
								<?php else: ?>
									<i style="color: <?php echo $dev_colour; ?>" class="fa fa-check-circle" aria-hidden="true"></i>
								<?php endif; ?>
									<span><?php echo $item; ?></span>
								</li>
							<?php endwhile;
							endif;
							?>
							</ul>
						</div>

					</li>

					<?php if($show_affordable_specificartion): ?>
					<li id="affspec" class="spec-tab-content">

						<div class="general-items items">
							<h3 style="color: <?php echo $dev_colour; ?>">General</h3>
							<ul>
							<?php 
							if( have_rows('affordable_general_items') ): while ( have_rows('affordable_general_items') ) : the_row();
							$optional = get_sub_field('optional');
							$item = get_sub_field('item'); ?>
								<li>
								<?php if($optional): ?>
									<i class="fa fa-plus-circle" aria-hidden="true"></i>
								<?php else: ?>
									<i class="fa fa-check-circle" aria-hidden="true"></i>
								<?php endif; ?>
									<span><?php echo $item; ?></span>
								</li>
							<?php endwhile;
							endif;
							?>
							</ul>
						</div>

						<div class="kitchen-items items">
							<h3>Kitchen</h3>
							<ul>
							<?php 
							if( have_rows('affordable_kitchen_items') ): while ( have_rows('affordable_kitchen_items') ) : the_row();
							$optional = get_sub_field('optional');
							$item = get_sub_field('item'); ?>
								<li>
								<?php if($optional): ?>
									<i class="fa fa-plus-circle" aria-hidden="true"></i>
								<?php else: ?>
									<i class="fa fa-check-circle" aria-hidden="true"></i>
								<?php endif; ?>
									<span><?php echo $item; ?></span>
								</li>
							<?php endwhile;
							endif;
							?>
							</ul>
						</div>

						<div class="bathroom-items items">
							<h3>Bathroom</h3>
							<ul>
							<?php 
							if( have_rows('affordable_bathroom_items') ): while ( have_rows('affordable_bathroom_items') ) : the_row();
							$optional = get_sub_field('optional');
							$item = get_sub_field('item'); ?>
								<li>
								<?php if($optional): ?>
									<i class="fa fa-plus-circle" aria-hidden="true"></i>
								<?php else: ?>
									<i class="fa fa-check-circle" aria-hidden="true"></i>
								<?php endif; ?>
									<span><?php echo $item; ?></span>
								</li>
							<?php endwhile;
							endif;
							?>
							</ul>
						</div>

					</li>
					<?php endif; ?>

				</ul>

				<div class="spec-tc">
					<?php the_field('specification_terms_&_conditions'); ?>
				</div>
