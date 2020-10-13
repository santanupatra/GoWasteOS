				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Manage Logo</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<div class="row">
                        				<div class="col-md-6">
					                		<?php echo $this->Form->create(null,["class"=>"form-auth-small","type" => "file"]); ?>
						                        <div class="form-group">
						                            <label for="site-logo" class="control-label">Site Logo</label>
						                            <?php echo $this->Form->input('logo',['type' => 'file','label'=>false,'id'=>'site-logo']); ?>
						                        </div>
						                        <input type="hidden" name="oldlogo" value="<?php echo $setting->logo;  ?>">
						                        <div class="form-group logo-img">
                                                	<?php if ($setting->logo != '') {  ?>
                                                        <img src="<?php echo $this->Url->build('/'.$setting->logo); ?>" alt="" class="show-image">
                                                    <?php } ?>
												</div>
						                        <div class="form-group">
						                            <label for="fav-icon" class="control-label">Fav Icon</label>
						                            <?php echo $this->Form->input('favIcon',['type' => 'file','label'=>false,'id'=>'fav-icon']); ?>
						                        </div>
						                        <input type="hidden" name="oldfav" value="<?php echo $setting->favIcon;  ?>">
						                        <div class="form-group fav-img">
                                                	<?php if ($setting->favIcon != '') {  ?>
                                                        <img src="<?php echo $this->Url->build('/'.$setting->favIcon); ?>" alt="" class="show-image">
                                                    <?php } ?>
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
	$("#site-logo").change(function() {
		imagePreview(this);
	});

	$("#fav-icon").change(function() {
		iconPreview(this);
	});

	function imagePreview(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('.logo-img').html('');
				$('.logo-img').html('<img src="'+e.target.result+'" alt="" class="show-image">');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	function iconPreview(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('.fav-img').html('');
				$('.fav-img').html('<img src="'+e.target.result+'" alt="" class="show-image">');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>