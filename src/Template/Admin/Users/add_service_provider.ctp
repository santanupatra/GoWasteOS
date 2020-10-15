
        <div class="container-fluid">
            <div class="row">
                        
                <div class="col-md-12">
                    <!-- TABLE HOVER -->
                    <div class="panel widget">
                        <div class="panel-heading widget-title">
                            <h3 class="panel-title">Add Service Provider</h3>
                            <div class="right">
                                <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                <?php echo $this->Form->create(null,["url"=>[],"type" => "file","class"=>"form-auth-small","onsubmit"=>"return validateForm()"]); ?>
                                        <div class="panel">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label for="first-name" class="control-label">Name</label>
                                                    <?php echo $this->Form->input('name',['class' => 'form-control character-text fName', 'label'=>false,'id' => 'first-name','placeholder'=>'Name']); ?>
                                                    <p class="fNameError error-message"></p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="first-name" class="control-label">Phone</label>
                                                    <?php echo $this->Form->input('phoneNumber',['class' => 'form-control character-text phone', 'label'=>false,'id' => 'phone','placeholder'=>'Phone']); ?>
                                                    <p class="phoneError error-message"></p>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="email" class="control-label">Email</label>
                                                    <?php echo $this->Form->input('email',['class' => 'form-control email-text','label'=>false,'id' => 'email','placeholder'=>'Email']); ?>
                                                    <p class="emailError error-message"></p>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="image-upload" class="control-label">Image</label>
                                                    <?php echo $this->Form->input('profilePicture',['type' => 'file','label'=>false,'id'=>'image-upload']); ?>
                                                </div>
                                                <?php echo $this->Form->input('type',['type'=>'hidden', 'label'=>false,'value'=>'SP']); ?>
                                                <div class="form-group">
                                                    
                                                    <img src="<?php echo $this->Url->build('/img/no-image.jpg'); ?>" id="user-image" alt="User Image" class="show-image">
                                                </div>
                                                <div class="form-group">
                                                    <?php echo $this->Form->submit('Submit',['class'=>'btn btn-primary pull-right']); ?>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    <?php echo $this->Form->end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>

<script type="text/javascript">

    function validateForm() {
        var fName = $(".fName").val();
        var phone = $(".phone").val();
        var email = $(".email-text").val();
        if(fName == "") {
            $(".fNameError").text("Name can not be empty!"); 
            $(".fNameError").css('display','block');
            setTimeout(function(){ 
                $(".fNameError").fadeOut();
            },1500);
            return false;
        } else if (phone == "") {
            $(".phoneError").text("Mobile number can not be empty!"); 
            $(".phoneError").css('display','block');
            setTimeout(function(){ 
                $(".phoneError").fadeOut();
            },1500);
            return false;
        } else if (email == "") {
            $(".emailError").text("Email can not be empty!"); 
            $(".emailError").css('display','block');
            setTimeout(function(){ 
                $(".emailError").fadeOut();
            },1500);
            return false;
        } else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))) {
            $(".emailError").text("You have entered an invalid email address!"); 
            $(".emailError").css('display','block');
            setTimeout(function(){ 
                $(".emailError").fadeOut();
            },1500);
            return false;
        } else {
            return true;
        }
    }
</script>