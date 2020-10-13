				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Add Testimonial</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<div class="row">
                                        <?php echo $this->Form->create(null,["url"=>[],"class"=>"form-auth-small","onsubmit"=>"return validateForm()"]); ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Tile</label>
													<?php echo $this->Form->input('title',['type'=>'textarea','class' => 'form-control title','label'=>false,'id' => 'title','rows'=>'4']); ?>
                                                    <p class="titleError error-message"></p>
                                                </div>
						                        <div class="form-group">
                                                    <?php echo $this->Form->submit('Submit',['class'=>'btn btn-primary pull-right']); ?>
                                                </div>
						                    <!-- END INPUTS -->
                                            </div>    
					                    <?php echo $this->Form->end(); ?>
					                </div>
					            </div>
							</div>
						</div>
					</div>
				</div>


<script type="text/javascript">

    function validateForm () {
        var title = $('.title').val();
    	if (title == "") {
            $(".titleError").text("Title can not be empty!"); 
            $(".titleError").css('display','block');
            setTimeout(function(){ 
                $(".titleError").fadeOut();
            },1500);
            return false;
        } else{
    		return true;
    	}
    }
</script>