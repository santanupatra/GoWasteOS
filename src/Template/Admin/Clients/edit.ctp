                <div class="container-fluid">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <!-- TABLE HOVER -->
                            <div class="panel widget">
                                <div class="panel-heading widget-title">
                                    <h3 class="panel-title">Edit Client</h3>
                                    <div class="right">
                                        <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <?php echo $this->Form->create($client,["class"=>"form-auth-small","type" => "file","onsubmit"=>"return validateForm()"]); ?>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Client Name</label>
                                                    <?php echo $this->Form->input('name',['class' => 'form-control name','label'=>false,'id' => 'page-name','placeholder'=>'Client Name']); ?>
                                                    <p class="nameError error-message"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="logo-name" class="control-label">Logo</label>
                                                    <?php echo $this->Form->input('logo',['class' => 'form-control companyLogo', 'type'=>'file', 'label'=>false]); ?>
                                                    <p class="logoError error-message"></p>
                                                </div>
                                                <input type="hidden" name="oldImg" value="<?php echo $client->logo;  ?>">
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
        var name = $('.name').val();
        var logo = $('.companyLogo').files.length();
    	if (name == "") {
            $(".nameError").text("Client name can not be empty!"); 
            $(".nameError").css('display','block');
            setTimeout(function(){ 
                $(".nameError").fadeOut();
            },1500);
            return false;
        } else if (logo == 0) {
            $(".logoError").text("Order can not be empty!"); 
            $(".logoError").css('display','block');
            setTimeout(function(){ 
                $(".logoError").fadeOut();
            },1500);
            return false;
        } else{
    		return true;
    	}
    }
</script>