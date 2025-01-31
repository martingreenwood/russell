			<div class="youtube">
				<a href="#dev_video">
					<?php $feature_video_image = get_sub_field('video_thumbnail'); ?>
					<img src="<?php echo $feature_video_image['sizes']['thumbnail']; ?>">
					<div class="play-icon"></div>
				</a>
				<div id="dev_video">
					<a class="close_vid" href="#dev_video"></a>
					<div class="table">
						<div class="cell middle">
							<div class="vid-wrap">
								<div class="embed-container">
									<?php $iframe = get_sub_field('dev_video');

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
							</div>
						</div>
					</div>
				</div>
			</div>