				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Add Product</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<div class="row">
                                        <?php echo $this->Form->create(null,["class"=>"form-auth-small","type" => "file","onsubmit"=>"return validateForm()"]); ?>
                                            <div class="col-md-6">
						                        <div class="form-group">
                                                    <label for="product-name" class="control-label">Product Name</label>
                                                    <?php echo $this->Form->input('productTitle',['class' => 'form-control pName','label'=>false,'id' => 'product-name','placeholder'=>'product Name']); ?>
                                                    <p class="pNameError error-message"></p>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="image-upload" class="control-label">Image</label>
                                                    <?php echo $this->Form->input('productImage[]',['type' => 'file','label'=>false,'id'=>'image-upload', 'multiple'=>'multiple']); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                    <label for="description" class="control-label">Description</label>
                                                    <?php echo $this->Form->input('description',['type'=>'textarea','class' => 'form-control description','label'=>false,'id' => 'description','rows'=>'4']); ?>
                                                    <p class="descriptionError error-message"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo $this->Form->button('Submit',['class'=>'btn btn-primary pull-right','id'=>'attr-button']); ?>
                                                </div>
                                            </div>
                                             
					                    <?php echo $this->Form->end(); ?>
					                </div>
					            </div>
							</div>
						</div>
					</div>
				</div>


<script type="text/javascript">
    CKEDITOR.replace('description');
    function validateForm () {
        var pName = $('.pName').val();
        
    	if (pName == "") {
            $(".pNameError").text("product name can not be empty!"); 
            $(".pNameError").css('display','block');
            setTimeout(function(){ 
                $(".pNameError").fadeOut();
            },1500);
            return false;
        } else{
            return true;
	    }
    }
</script>