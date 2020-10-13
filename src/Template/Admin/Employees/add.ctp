<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
				<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Add Employee</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<div class="row">
                                        <?php echo $this->Form->create(null,["url"=>[],"class"=>"form-auth-small","type" => "file","onsubmit"=>"return validateForm()"]); ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Employee Name</label>
                                                    <?php echo $this->Form->input('userName',['class' => 'form-control pName','label'=>false,'id' => 'page-name','placeholder'=>'Employee Name']); ?>
                                                    <p class="pNameError error-message"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="designation" class="control-label">Designation</label>
                                                    <?php echo $this->Form->input('designation',['class' => 'form-control designation','label'=>false,'id' => 'designation','placeholder'=>'Designation']); ?>
                                                    <p class="designationError error-message"></p>
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label for="qualification" class="control-label">Qualification</label>
                                                    <?php // echo $this->Form->input('qualification',['class' => 'form-control qualification','label'=>false,'id' => 'qualification','placeholder'=>'Qualification']); ?>
                                                    <p class="qualificationError error-message"></p>
                                                </div> -->
                                                <div class="form-group">
                                                    <label for="joinDate" class="control-label">Join Date</label>
                                                    <?php echo $this->Form->input('joinDate',['id'=>'datepicker','class' => 'form-control joinDate','label'=>false,'placeholder'=>'Join Date']); ?>
                                                    <p class="joinDateError error-message"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="joinDate" class="control-label">Employee Image</label>
                                                    <?php echo $this->Form->input('userImage',['class' => 'form-control', 'type'=>'file', 'label'=>false]); ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description" class="control-label">About Employee</label>
                                                    <?php echo $this->Form->input('aboutUser',['type'=>'textarea','rows'=>'7','class' => 'form-control order','label'=>false,'id' => 'description','placeholder'=>'Answer']); ?>
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


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $( "#datepicker" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
    //CKEDITOR.replace('description');

    function validateForm () {
        var pName = $('.pName').val();
        var designation = $('.designation').val();
        // var qualification = $('.qualification').val();
    	//var description = CKEDITOR.instances["description"].getData();
    	if (pName == "") {
            $(".pNameError").text("Employee name can not be empty!"); 
            $(".pNameError").css('display','block');
            setTimeout(function(){ 
                $(".pNameError").fadeOut();
            },1500);
            return false;
        } else if (designation == "") {
            $(".designationError").text("Designation can not be empty!"); 
            $(".designationError").css('display','block');
            setTimeout(function(){ 
                $(".designationError").fadeOut();
            },1500);
            return false;
        } else{
    		return true;
    	}
    }
</script>