
        <div class="container-fluid">
            <div class="row">
                        
                <div class="col-md-12">
                    <!-- TABLE HOVER -->
                    <div class="panel widget">
                        <div class="panel-heading widget-title">
                            <h3 class="panel-title">Edit Sub Admin</h3>
                            <div class="right">
                                <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo $this->Form->create($user,["class"=>"form-auth-small","type" => "file","onsubmit"=>"return validateForm()"]); ?>
                                        <div class="panel">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label for="first-name" class="control-label">Name</label>
                                                    <?php echo $this->Form->input('name',['class' => 'form-control character-text fName','value'=>$user['firstName'].' '.$user['lastName'], 'label'=>false,'id' => 'first-name','placeholder'=>'Name']); ?>
                                                    <p class="fNameError error-message"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="first-name" class="control-label">Phone</label>
                                                    <?php echo $this->Form->input('phoneNumber',['class' => 'form-control character-text phone','value'=>$user['phoneNumber'], 'label'=>false,'id' => 'phone','placeholder'=>'Phone']); ?>
                                                    <p class="phoneError error-message"></p>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="email" class="control-label">Email</label>
                                                    <?php echo $this->Form->input('email',['class' => 'form-control email-text', 'value'=>$user['email'], 'id' => 'email','label'=>false, 'placeholder'=>'Email']); ?>
                                                    <p class="emailError error-message"></p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email" class="control-label">Type</label>
                                                    <select name="type" class="form-control">
                                                        <option value="SA">Sub Admin</option>
                                                    </select>
                                                    <p class="emailError error-message"></p>
                                                </div>

                                                <div class="form-group">
                                                    <?php 
                                                        if(@$user['subadmin_access_ids']){
                                                            $leftArr = explode(',',@$user['subadmin_access_ids']);
                                                        } else {
                                                            $leftArr = array();
                                                        }
                                                        
                                                        // print_r($leftArr);
                                                    ?>
                                                    <label for="email" class="control-label">Access Menu List</label>
                                                    <select name="leftmenuid[]" id="leftmenu_ids" multiple="multiple" class="form-control select2">
                                                        <?php foreach ($leftmenu_list as $menu_row) { ?>
                                                        <option value="<?php echo $menu_row->id; ?>" <?php if(in_array($menu_row->id ,$leftArr)){echo 'selected';} ?>>
                                                            <?php echo $menu_row->name; ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                    <p class="emailError error-message"></p>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="image-upload" class="control-label">Image</label>
                                                    <?php echo $this->Form->input('profilePicture',['type' => 'file','label'=>false,'id'=>'image-upload']); ?>
                                                </div>
                                                <input type="hidden" name="oldimg" value="<?php echo $user['profilePicture']; ?>">
                                                <div class="form-group">
                                                    <?php if ($user['profilePicture'] != '') { ?>
                                                    <img src="<?php echo $this->Url->build('/'.$user->profilePicture); ?>" id="user-image" alt="User Image" class="show-image">
                                                    <?php } else { ?>
                                                    <img src="<?php echo $this->Url->build('/img/no-image.jpg'); ?>" id="user-image" alt="User Image" class="show-image">
                                                   <?php } ?>
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
            $(".phoneError").text("Phone can not be empty!"); 
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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() { 
        $("#leftmenu_ids").select2();
    });
</script>