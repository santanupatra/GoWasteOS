<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Add Booking</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<div class="row">
                                        <!-- <?php //echo $this->Form->create(null,["class"=>"form-auth-small","type" => "file","onsubmit"=>"return validateForm()"]); ?> -->
                                        <?php echo $this->Form->create(null,["class"=>"form-auth-small","type" => "file"]); ?>
                                            <div class="col-md-6">
                                                
                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Date</label>
                                                    <?php echo $this->Form->input('booking_date',['type'=>'date','class' => 'form-control','label'=>false,'placeholder'=>'Date']); ?>
                                                    <p class="priceNameError error-message"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Time</label>
                                                    <?php echo $this->Form->input('booking_time',['type'=>'time','class' => 'form-control', 'label'=>false,'placeholder'=>'Time']); ?>
                                                    
                                                </div>

                                                <div class="form-group">
                                                    <label for="email" class="control-label">Choose Service Provider</label>
                                                    <select name="service_provider_id" class="form-control">
                                                    <option value="">Service Provider</option>
                                                    <?php 
                                                    foreach($service_providers as $service_provider): ?>
                                                    <option value="<?php echo $service_provider['id']; ?>"><?php echo $service_provider['firstName'].' '.$service_provider['lastName']; ?></option>
                                                    <?php endforeach ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email" class="control-label">Choose Customer</label>
                                                    <select name="customer_id" class="form-control">
                                                        <option value="">Customer</option>
                                                        <?php 
                                                        foreach($customers as $customer): ?>
                                                        <option value="<?php echo $customer['id']; ?>"><?php echo $customer['firstName'].' '.$customer['lastName']; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email" class="control-label">Choose Service</label>
                                                    <select name="service_id" class="form-control">
                                                        <option value="">Service</option>
                                                        <?php 
                                                        foreach($services as $service): ?>
                                                        <option value="<?php echo $service['id']; ?>"><?php echo $service['title']; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email" class="control-label">Choose City</label>
                                                    <select name="service_provided_city_id" class="form-control">
                                                        <option value="">City</option>
                                                        <?php 
                                                        foreach($cities as $city): ?>
                                                        <option value="<?php echo $city['id']; ?>"><?php echo $city['name']; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Service Location</label>
                                                    <?php echo $this->Form->input('service_loaction',['class' => 'form-control',  'label'=>false]); ?>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-12">
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
    // CKEDITOR.replace('description');

    function validateForm () {
        var pName = $('.pName').val();
    	var price = $('.priceName').val();
    	var description = $("#description").val();
    	if (pName == "") {
            $(".pNameError").text("Service title can not be empty!"); 
            $(".pNameError").css('display','block');
            setTimeout(function(){ 
                $(".pNameError").fadeOut();
            },1500);
            return false;
        }  else if(price == ''){
            $(".priceNameError").text("price can not be empty!"); 
            $(".priceNameError").css('display','block');
            setTimeout(function(){ 
                $(".priceNameError").fadeOut();
            },1500);
            return false;
        }else if(description == ''){
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