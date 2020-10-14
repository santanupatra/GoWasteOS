				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title"> Details</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<ul class="list-unstyled todo-list">
										<li>
											<p>
												<span class="title">Banner Title</span>
												<span class="short-description"><?php echo $banner['bannerTitle']; ?></span>
												
											</p>
										</li>
										<?php if($banner['bannerImage'] != '') { ?>
										<li>
											<p>
												<span class="title">Banner Image</span>
												<span class="short-description"><img src="<?php echo $this->Url->build('/'.$banner['bannerImage']); ?>" class="status-image" /></span>
											</p>
										</li>
										<?php } ?>
										<li>
											<p>
												<span class="title">Content</span>
												<span class="short-description"><?php echo $banner['bannerContent']; ?></span>
											</p>
										</li>
									</ul>
					            </div>
							</div>
						</div>
					</div>
				</div>