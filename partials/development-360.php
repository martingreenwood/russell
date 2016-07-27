							<div class="view360">
								<a href="#open360">
									<div class="icon360"></div>
									<?php $view360 = get_sub_field('virtual_360_image'); ?>
									<img src="<?php echo $view360['sizes']['thumbnail']; ?>" alt="">
								</a>
								<div id="open360">
									<a class="close_popup" href="#open360"></a>
									<div class="table">
										<div class="cell middle">
											<iframe 
												name="Development 360" 
												src="<?php echo str_replace("http:","", get_sub_field('virtual_360')); ?>" 
												align="middle" 
												frameborder="0"
												height="480"
												width="640"
												></iframe>
										</div>
									</div>
								</div>
							</div>
