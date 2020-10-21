
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
                                                    <label for="first-name" class="control-label">Company Name</label>
                                                    <?php echo $this->Form->input('company_name',['class' => 'form-control character-text companyName', 'label'=>false,'id' => 'companyName','placeholder'=>'Company Name']); ?>
                                                    <p class="companyNameError error-message"></p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="first-name" class="control-label">Phone</label>
                                                    <input type="text" class="form-control" name="phoneNumber" id="phone" placeholder="Phone" >
                                                    <p class="phoneError error-message"></p>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="email" class="control-label">Email</label>
                                                    <?php echo $this->Form->input('email',['class' => 'form-control email-text','label'=>false,'id' => 'email','placeholder'=>'Email']); ?>
                                                    <p class="emailError error-message"></p>
                                                </div>

                                                <?php echo $this->Form->input('type',['type'=>'hidden','class' => 'form-control email-text','label'=>false, 'value'=>'SP']); ?>

                                                <div class="form-group">
                                                    <label for="email" class="control-label">Address</label>
                                                    <?php echo $this->Form->input('address',['class' => 'form-control email-text','label'=>false,'id' => 'address','placeholder'=>'Address', 'autocomplete'=>"on"]); ?>
                                                    <p class="addressError error-message"></p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email" class="control-label">Choose City</label>
                                                    <select name="city_id" class="form-control" id="cityName">
                                                        <option value="">City</option>
                                                        <?php 
                                                        foreach($cities as $city): ?>
                                                        <option value="<?php echo $city['id']; ?>"><?php echo $city['name']; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <p class="cityNameError error-message"></p>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="image-upload" class="control-label">Image</label>
                                                    <?php echo $this->Form->input('profilePicture',['type' => 'file','label'=>false,'id'=>'image-upload']); ?>
                                                </div>
                                                
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
        var phone = $("#phone").val();
        var address = $("#address").val();
        var cityName = $("#cityName").val();
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
        } else if (address == "") {
            $(".addressError").text("Address can not be empty!"); 
            $(".addressError").css('display','block');
            setTimeout(function(){ 
                $(".addressError").fadeOut();
            },1500);
            return false;
        } else if (cityName == "") {
            $(".cityNameError").text("City name can not be empty!"); 
            $(".cityNameError").css('display','block');
            setTimeout(function(){ 
                $(".cityNameError").fadeOut();
            },1500);
            return false;
        } else {
            return true;
        }
    }
</script>

<script type="text/javascript">
    $( document ).ready(function() {
        initialize();
    });
</script>

<script type="text/javascript">
function initialize() {
            var input = document.getElementById('address');
            var autocomplete = new google.maps.places.Autocomplete(input);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

