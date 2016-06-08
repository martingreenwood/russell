				<ul class="tabs">
				<?php 
				if( have_rows('add_your_site_plans') ): 
				while ( have_rows('add_your_site_plans') ) : the_row();
				$plan_title = get_sub_field('title');
				$plan_active = get_sub_field('active');
				$plan_plan = get_sub_field('plan');
				?>
				<li class="tab">
					<a href="#<?php echo str_replace(' ','-',strtolower($plan_title)); ?>" class="tab-link <?php if($plan_active): ?>is-active<?php endif; ?>"><?php echo $plan_title; ?></a>
				</li>
				<?php endwhile;
				endif; ?>
				<?php 
				$development_siteplan_pdf = get_field('development_siteplan_pdf');
				if ($development_siteplan_pdf): ?>
				<li class="plan-download">
					<a target="_blank" href="<?php echo $development_siteplan_pdf['url']; ?>">Download Siteplan &amp; Spcification</a>
				</li>
				<?php endif; ?>
				</ul>

				<ul class="tabs-body">
				<?php 
				if( have_rows('add_your_site_plans') ): 
				while ( have_rows('add_your_site_plans') ) : the_row();
				$plan_title = get_sub_field('title');
				$plan_active = get_sub_field('active');
				$plan_plan = get_sub_field('plan');
				$plan_stage = get_sub_field('stage');
				?>
					<li id="<?php echo str_replace(' ','-',strtolower($plan_title)); ?>" class="tab-content <?php echo $plan_stage; ?> <?php if($plan_active): ?>is-active<?php endif; ?>">
						<img src="<?php echo $plan_plan['url']; ?>" alt="<?php echo get_the_title() . ' ' . $plan_title; ?>">

						<ul id="plots">
						<?php 
						$plots = get_posts(array(
							'post_type' 		=> 'plots',
							'posts_per_page' 	=> -1,
							'meta_query' 		=> array(
								array(
									'key' 		=> 'choose_development',
									'value' 	=> '"' . get_the_ID() . '"',
									'compare' 	=> 'LIKE'
								),
								array(
									'key'	  	=> 'development_stage',
									'value'	  	=> $plan_stage,
									'compare' 	=> '=',
								),
							)
						));

						if ($plots) {
							foreach( $plots as $plot ): ?>
							<?php 		
								$plot_num = explode(" ", get_the_title( $plot->ID )); 
								$plot_num = current($plot_num);

								$development_stage = get_field('development_stage', $plot->ID);
								
								$plot_availability = get_field('plot_availability', $plot->ID);
								
	
								$house_type_id = get_field('choose_house_type', $plot->ID); //array
								$house_type_name = get_the_title( $house_type_id[0] );
								$house_type_name = str_replace("'", "", $house_type_name);
								$house_type_name = str_replace('"', "", $house_type_name);
								$house_type_name = str_replace(" ", "-", strtolower($house_type_name));
								$house_type_img = get_the_post_thumbnail( $house_type_id[0], 'thumbnail' );

								$plot_price = get_field('plot_price', $plot->ID);
								if (!$plot_price): 
									$plot_price = "TBC";
								else: 
									$plot_price = '<span class="price">'.get_field('plot_price', $plot->ID) .'</span>';
								endif;
								
								$plot_title = get_field('big_title', $plot->ID);
								if(!$plot_title) $plot_title = "Newly built family home";
							?>
							<li class="plot-<?php echo $plot_num; ?> <?php echo $plot_availability; ?> <?php echo $development_stage; ?>">
								<div class="plot-popup">
									<div class="tri"></div>
									<?php echo $house_type_img; ?>
									<h4>Plot <?php echo $plot_num; ?>, <?php echo $plot_title; ?></h4>
									<h3>£<?php echo $plot_price; ?></h3>
									<a href="<?php echo get_permalink( $plot->ID ); ?>">View Property Details</a>
								</div>
							</li>
							<?php endforeach;
						}
						?>
						</ul>

					</li>
				<?php endwhile;
				endif; ?>
				</ul>

				<div class="ledgend">
					<ul>
						<li>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/available.svg"> <span>Available</span>
						</li>
						<li>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/sold.svg"> <span>Sold</span>
						</li>
						<li>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/reserved.svg"> <span>Reserved</span>
						</li>
						<li>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/coming-soon.svg"> <span>Coming Soon</span>
						</li>
						<li>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/not-released.svg"> <span>Not Released</span>
						</li>
						<li>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/show-home.svg"> <span>Show Home</span>
						</li>
					</ul>
				</div>