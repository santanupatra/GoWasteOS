				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Manage Site Setting</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<div class="row">
                        				<div class="col-md-6">
                        					<?php echo $this->Form->create($setting,["class"=>"form-auth-small","onsubmit"=>"return validateForm()"]); ?>
						                        <div class="form-group">
						                            <label for="site-name" class="control-label">Site Name</label>
						                            <?php echo $this->Form->input('siteName',['class' => 'form-control sName','label'=>false,'id' => 'site-name','placeholder'=>'Site Name']); ?>
						                            <p class="sNameError error-message"></p>
						                        </div>
						                        <div class="form-group">
						                            <label for="site-email" class="control-label">Site Email</label>
						                            <?php echo $this->Form->input('siteEmail',['class' => 'form-control email-text2','label'=>false,'id' => 'site-email','placeholder'=>'Site Email']); ?>
						                            <p class="emailError2 error-message" ></p>
						                        </div>
						                        <div class="form-group">
						                            <label for="address" class="control-label">Address</label>
						                            <?php echo $this->Form->input('address',['class' => 'form-control','label'=>false,'id' => 'address','placeholder'=>'Address']); ?>
						                        </div>
												<div class="form-group">
						                            <label for="mobileNumber" class="control-label">Phone Number</label>
						                            <?php echo $this->Form->input('phoneNumber',['class' => 'form-control','label'=>false,'id' => 'mobileNumber','placeholder'=>'Phone Number']); ?>
						                        </div>
						                        <div class="form-group">
						                            <label for="fax" class="control-label">Fax</label>
						                            <?php echo $this->Form->input('fax',['class' => 'form-control','label'=>false,'id' => 'fax','placeholder'=>'Fax']); ?>
						                        </div>
												<div class="form-group">
						                            <label for="facebook" class="control-label">Facebook Link</label>
						                            <?php echo $this->Form->input('facebookUrl',['class' => 'form-control','label'=>false,'placeholder'=>'Facebook Link']); ?>
						                        </div>
												<div class="form-group">
						                            <label for="twitter" class="control-label">Twitter Link</label>
						                            <?php echo $this->Form->input('twitterUrl',['class' => 'form-control','label'=>false,'placeholder'=>'Twitter Link']); ?>
						                        </div>
												<div class="form-group">
						                            <label for="instagram" class="control-label">Instgram Link</label>
						                            <?php echo $this->Form->input('instagramUrl',['class' => 'form-control email-text2','label'=>false,'placeholder'=>'Instgram Link']); ?>
						                        </div>
												<div class="form-group">
						                            <label for="youtube" class="control-label">YouTube Link</label>
						                            <?php echo $this->Form->input('youtubeUrl',['class' => 'form-control email-text2','label'=>false,'placeholder'=>'Youtube Link']); ?>
						                        </div>
						                        <div class="form-group">
                                                    <?php echo $this->Form->submit('Submit',['class'=>'btn btn-primary pull-right']); ?>
                                                </div>
						                        
					                    	<?php echo $this->Form->end(); ?>
					                    	<!-- END INPUTS -->
					                    </div>
					                </div>
					            </div>
							</div>
						</div>
					</div>
				</div>


<script type="text/javascript">
	function validateForm() {
		  	return true;
	}
</script>