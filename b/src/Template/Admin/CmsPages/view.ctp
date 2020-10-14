				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Cms Page Details</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<ul class="list-unstyled todo-list">
										<li>
											<p>
												<span class="title">Page Heading</span>
												<span class="short-description"><?php echo $cmspage['page_heading']; ?></span>
												
											</p>
										</li>
										<li>
											<p>
												<span class="title">Page Name</span>
												<span class="short-description"><?php echo $cmspage['page_name']; ?></span>
											</p>
										</li>
										<li>
											<p>
												<span class="title">Content</span>
												<span class="short-description"><?php echo $cmspage['content']; ?></span>
											</p>
										</li>
										<li>
											<p>
												<span class="title">Order</span>
												<span class="short-description"><?php echo $cmspage['orders']; ?></span>
											</p>
										</li>
										<li>
											<p>
												<span class="title">Status</span>
												<span class="short-description"><?php echo $cmspage['status'] == 1 ? "Active" : "Inactive"; ?></span>
											</p>
										</li>
									</ul>
					            </div>
							</div>
						</div>
					</div>
				</div>