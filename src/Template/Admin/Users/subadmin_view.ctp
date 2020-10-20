<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Sub Admin Details</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<ul class="list-unstyled todo-list">
										<li>
											<p>
												<span class="title">Name</span>
												<span class="short-description"><?php echo $subadmin['firstName'].' '.$subadmin['lastName']; ?></span>
												
											</p>
										</li>
										
										<li>
											<p>
												<span class="title">Phone</span>
												<span class="short-description"><?php echo $subadmin['phoneNumber']; ?></span>
												
											</p>
										</li>
                                        <li>
											<p>
												<span class="title">Email</span>
												<span class="short-description"><?php echo $subadmin['email']; ?></span>
												
											</p>
										</li>
										<li>
											<p>
												<span class="title">Status</span>
												<span class="short-description"><?php echo $subadmin['isActive'] == 1 ? "Active" : "Inactive"; ?></span>
											</p>
										</li>
										<li>
											<p>
												<span class="title">Profile Image</span>
												<span class="short-description">
                                                <?php if ($subadmin['profilePicture'] != '') { ?>
                                                    <img src="<?php echo $this->Url->build('/'.$subadmin->profilePicture); ?>" id="user-image" alt="User Image" class="show-image">
                                                    <?php } else { ?>
                                                    <img src="<?php echo $this->Url->build('/img/no-image.jpg'); ?>" id="user-image" alt="User Image" class="show-image">
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