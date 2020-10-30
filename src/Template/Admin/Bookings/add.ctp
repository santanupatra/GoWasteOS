

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
                                        <?php echo $this->Form->create(null,["class"=>"form-auth-small","type" => "file","onsubmit"=>"return validateForm()"]); ?>
                                        <!-- <?php //echo $this->Form->create(null,["class"=>"form-auth-small","type" => "file"]); ?> -->
                                            <div class="col-md-6">
                                                
                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Date</label>
                                                    <?php echo $this->Form->input('booking_date',[ 'class'=>"datepicker form-control",'label'=>false,'placeholder'=>'Date', 'data-date-format'=>"mm/dd/yyyy", 'id'=>"date"]); ?>
                                                    <p class="dateNameError error-message"></p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Time</label>
                                                    <?php  echo $this->Form->input('booking_time',['type'=>'time','class' => 'form-control timepicker', 'label'=>false,'placeholder'=>'Time', 'id'=>"time"]); ?>
                                                    <p class="timeNameError error-message"></p>
                                                </div>
                                                <!-- <div class='col-sm-6'>
                                                    <div class="form-group">
                                                        <div class='input-group date' id='datetimepicker3'>
                                                            <input type='text' class="form-control" />
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-time"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Waste size in ton</label>
                                                    <?php echo $this->Form->input('waste_size',['type'=>'number','class' => 'form-control', 'label'=>false,'placeholder'=>'Waste Size', 'id'=>"waste"]); ?>
                                                    <p class="wasteNameError error-message"></p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email" class="control-label">Choose Service Provider</label>
                                                    <select name="service_provider_id" class="form-control" id="provider">
                                                    <option value="">Service Provider</option>
                                                    <?php 
                                                    foreach($service_providers as $service_provider): ?>
                                                    <option value="<?php echo $service_provider['id']; ?>"><?php echo $service_provider['firstName'].' '.$service_provider['lastName']; ?></option>
                                                    <?php endforeach ?>
                                                    </select>
                                                    <p class="providerNameError error-message"></p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email" class="control-label">Choose Customer</label>
                                                    <select name="customer_id" class="form-control" id="customer">
                                                        <option value="">Customer</option>
                                                        <?php 
                                                        foreach($customers as $customer): ?>
                                                        <option value="<?php echo $customer['id']; ?>"><?php echo $customer['firstName'].' '.$customer['lastName']; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <p class="customerNameError error-message"></p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email" class="control-label">Choose Service</label>
                                                    <select name="service_id" class="form-control" id="service_id">
                                                        <option value="">Service</option>
                                                        <?php 
                                                        foreach($services as $service): ?>
                                                        <option value="<?php echo $service['id']; ?>"><?php echo $service['title']; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <p class="serviceNameError error-message"></p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email" class="control-label">Choose City</label>
                                                    <select name="service_provided_city_id" class="form-control" id="city_id">
                                                        <option value="">City</option>
                                                        <?php 
                                                        foreach($cities as $city): ?>
                                                        <option value="<?php echo $city['id']; ?>"><?php echo $city['name']; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <p class="cityNameError error-message"></p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Service Location</label>
                                                    <?php echo $this->Form->input('service_loaction',['class' => 'form-control',  'label'=>false, 'id'=>'address']); ?>
                                                    <p class="addressNameError error-message"></p>
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
        var date = $('#date').val();
        var time = $('#time').val();
    	var waste = $('#waste').val();
    	var customer = $("#customer").val();
    	var provider = $("#provider").val();
    	var service = $("#service_id").val();
    	var city = $("#city_id").val();
    	var address = $("#address").val();

        if (date == "") {
            $(".dateNameError").text("Date can not be empty!"); 
            $(".dateNameError").css('display','block');
            setTimeout(function(){ 
                $(".dateNameError").fadeOut();
            },1500);
            return false;
        }  else if(time == ''){
            $(".timeNameError").text("Time can not be empty!"); 
            $(".timeNameError").css('display','block');
            setTimeout(function(){ 
                $(".timeNameError").fadeOut();
            },1500);
            return false;
        }else if(waste == ''){
    		$(".wasteNameError").text("Waste size can not be empty!"); 
		    $(".wasteNameError").css('display','block');
		    setTimeout(function(){ 
		        $(".wasteNameError").fadeOut();
		    },1500);
    		return false;
    	}else if(provider == ''){
    		$(".providerNameError").text("Choose Service Provider!"); 
		    $(".providerNameError").css('display','block');
		    setTimeout(function(){ 
		        $(".providerNameError").fadeOut();
		    },1500);
    		return false;
    	}else if(customer == ''){
    		$(".customerNameError").text("Choose Customer!"); 
		    $(".customerNameError").css('display','block');
		    setTimeout(function(){ 
		        $(".customerNameError").fadeOut();
		    },1500);
    		return false;
    	}else if(service == ''){
    		$(".serviceNameError").text("Select Service!"); 
		    $(".serviceNameError").css('display','block');
		    setTimeout(function(){ 
		        $(".serviceNameError").fadeOut();
		    },1500);
    		return false;
    	}else if(city == ''){
    		$(".cityNameError").text("Choose City!"); 
		    $(".cityNameError").css('display','block');
		    setTimeout(function(){ 
		        $(".cityNameError").fadeOut();
		    },1500);
    		return false;
    	}else if(address == ''){
    		$(".addressNameError").text("Select Location!"); 
		    $(".addressNameError").css('display','block');
		    setTimeout(function(){ 
		        $(".addressNameError").fadeOut();
		    },1500);
    		return false;
    	}else{
    		return true;
    	}
    }
</script>

<script type="text/javascript">
    $( document ).ready(function() {
        initialize();

    });
    $('.datepicker').datepicker({
        startDate: '0d'
    });
    // $('#datetimepicker3').datetimepicker({
    //     format: 'HH:mm'
    // });
</script>

<script type="text/javascript">
function initialize() {
    var input = document.getElementById('address');
    var autocomplete = new google.maps.places.Autocomplete(input);
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>