		<div class="container">

			<div class="column youtube">
				<?php $videoimage = get_field('feature_video_image'); ?>
				<div class="box" style="background-image: url(<?php echo $videoimage['sizes']['thumbnail']; ?>)">
					<a href="#video-box">
						<div class="play"></div>
					</a>
				</div>

				<div id="video-box">
					<a class="close_map" href="#video-box"></a>
					<div class="table"><div class="cell middle">
					<div class="embed-container">
						<?php $iframe = get_field('feature_video');

						preg_match('/src="(.+?)"/', $iframe, $matches);
						$src = $matches[1];
						$params = array(
						    'controls'    => 0,
						    'hd'        => 1,
						    'autohide'    => 1
						);
						$new_src = add_query_arg($params, $src);
						$iframe = str_replace($src, $new_src, $iframe);
						$attributes = 'frameborder="0"';
						$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

						echo $iframe;
						?>
					</div>
					</div></div>
				</div>
				
				<div class="icon">
					<a href="https://www.youtube.com/user/russellarmerla96ll" target="blank" rel="youtube">
						<i class="fa fa-youtube" aria-hidden="true"></i>
						<p>Check out our lastest videos</p>
					</a>
				</div>
			</div>

			<div class="column news">

				<?php
				$latest_news = new WP_Query(array( 
					'post_type' => 'post', 
					'posts_per_page' => 1
				));

				while ( $latest_news->have_posts() ) : $latest_news->the_post(); ?>
				<div class="news-item box" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>);">
					<a href="<?php the_permalink(); ?>">
						<div class="title"><?php the_title(); ?></div>
					</a>
				</div>
				<?php endwhile; wp_reset_postdata(); ?>

				<div class="icon">
					<a href="https://www.youtube.com/user/russellarmerla96ll" target="blank" rel="youtube">
						<i class="fa fa-youtube" aria-hidden="true"></i>
						<p>our lastest news</p>
					</a>
				</div>
			</div>

			<div class="column tweets">	
				<div class="tweet box">
					<div class="table"><div class="cell middle">
					<a class="twitter-timeline"
					data-dnt="true"
					data-chrome="noheader nofooter noborders noscrollbar transparent"
					data-tweet-limit="1" 
					data-theme="dark" 
					data-link-color="#eeeeee" 
					href="https://twitter.com/RussellArmer" 
					data-widget-id="435421040756260864"></a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</div></div>
				</div>

				<div class="icon">
					<a href="https://twitter.com/russellarmer" target="blank" rel="twitter">
						<i class="fa fa-twitter" aria-hidden="true"></i>
						<p>Follow us here</p>
					</a>
				</div>
			</div>

		</div>
