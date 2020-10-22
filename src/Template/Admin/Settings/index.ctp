				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Manage App Setting</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<div class="row">
                        				<div class="col-md-6">
                        					<?php echo $this->Form->create($setting,["class"=>"form-auth-small","onsubmit"=>"return validateForm()"]); ?>
						                        <div class="form-group">
						                            <label for="site-email" class="control-label">Contact Email</label>
						                            <?php echo $this->Form->input('siteEmail',['class' => 'form-control email-text2','label'=>false,'id' => 'site-email','placeholder'=>'Site Email']); ?>
						                            <p class="emailError2 error-message" ></p>
						                        </div>
                                                <div class="form-group">
						                            <label for="site-email" class="control-label">Municipality Commission(%)</label>
						                            <?php echo $this->Form->input('municipalityCharge',['class' => 'form-control email-text2','label'=>false,'placeholder'=>'Municipality Comission']); ?>
						                            <p class="emailError2 error-message" ></p>
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