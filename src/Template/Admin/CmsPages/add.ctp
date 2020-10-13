				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Add Cms Page</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<div class="row">
                                        <?php echo $this->Form->create(null,["url"=>[],"class"=>"form-auth-small","onsubmit"=>"return validateForm()"]); ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Page Name</label>
                                                    <?php echo $this->Form->input('pageName',['class' => 'form-control pName','label'=>false,'id' => 'page-name','placeholder'=>'Page Name']); ?>
                                                    <p class="pNameError error-message"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="order" class="control-label">Order</label>
                                                    <?php echo $this->Form->input('orders',['type'=>'number','class' => 'form-control order','label'=>false,'id' => 'order','placeholder'=>'Order']); ?>
                                                    <p class="orderError error-message"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="description" class="control-label">Description</label>
                                                    <?php echo $this->Form->input('content',['class' => 'form-control','label'=>false,'id' => 'description','placeholder'=>'Description','type'=>'textarea']); ?>
                                                    <p class="descriptionError error-message"></p>
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
    CKEDITOR.replace('description');

    function validateForm () {
        var pName = $('.pName').val();
        var order = $('.order').val();
    	var description = CKEDITOR.instances["description"].getData();
    	if (pName == "") {
            $(".pNameError").text("Page name can not be empty!"); 
            $(".pNameError").css('display','block');
            setTimeout(function(){ 
                $(".pNameError").fadeOut();
            },1500);
            return false;
        } else if (order == "") {
            $(".orderError").text("Order can not be empty!"); 
            $(".orderError").css('display','block');
            setTimeout(function(){ 
                $(".orderError").fadeOut();
            },1500);
            return false;
        } else if(description == ''){
    		$(".descriptionError").text("Description can not be empty!"); 
		    $(".descriptionError").css('display','block');
		    setTimeout(function(){ 
		        $(".descriptionError").fadeOut();
		    },1500);
    		return false;
    	}else{
    		return true;
    	}
    }
</script>