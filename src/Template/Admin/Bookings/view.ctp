				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Product Details</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<ul class="list-unstyled todo-list">
										<li>
											<p>
												<span class="title">Product Name</span>
												<span class="short-description"><?php echo $product['ProductTitle']; ?></span>
												
											</p>
										</li>
										
										<li>
											<p>
												<span class="title">Product Description</span>
												<span class="short-description"><?php echo $product['description']; ?></span>
												
											</p>
										</li>
										<li>
											<p>
												<span class="title">Status</span>
												<span class="short-description"><?php echo $product['isActive'] == 1 ? "Active" : "Inactive"; ?></span>
											</p>
										</li>
										<li>
											<p>
												<span class="title">Product Image</span>
												<span class="short-description">
												<?php foreach($product['product_images'] as $key => $img){ ?>
													<img src="<?php echo $this->Url->build('/'.$img['originalpath']); ?>" alt="" class="show-image">
												<?php } ?>	
												</span>
											</p>
											
										</li>
									</ul>
					            </div>
							</div>
						</div>
					</div>
				</div>