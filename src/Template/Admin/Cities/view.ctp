				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">FAQ Details</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<ul class="list-unstyled todo-list">
										<li>
											<p>
												<span class="title">Question</span>
												<span class="short-description"><?php echo $faq['question']; ?></span>
												
											</p>
										</li>
										<li>
											<p>
												<span class="title">Answer</span>
												<span class="short-description"><?php echo $faq['answer']; ?></span>
											</p>
										</li>
										<li>
											<p>
												<span class="title">List Order</span>
												<span class="short-description"><?php echo $faq['listOrder']; ?></span>
											</p>
										</li>
										<li>
											<p>
												<span class="title">Status</span>
												<span class="short-description"><?php echo $faq['isActive'] == 1 ? "Active" : "Inactive"; ?></span>
											</p>
										</li>
									</ul>
					            </div>
							</div>
						</div>
					</div>
				</div>