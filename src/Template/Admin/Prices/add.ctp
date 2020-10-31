<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Add Price</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<div class="row">
                                        <?php echo $this->Form->create(null,["class"=>"form-auth-small","type" => "file","onsubmit"=>"return validateForm()"]); ?>
                                        <!-- <?php echo $this->Form->create(null,["class"=>"form-auth-small","type" => "file"]); ?> -->
                                            <div class="col-md-6">
                                                

                                                <div class="form-group">
                                                    <label for="email" class="control-label">Zone</label>
                                                    <select name="city_id" class="form-control" id="city_id" onchange="getService()">
                                                        <option value="">Select Zone</option>
                                                        <?php 
                                                        foreach($cities as $city): ?>
                                                        <option value="<?php echo $city['id']; ?>"><?php echo $city['name']; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <p class="cityNameError error-message"></p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email" class="control-label">Choose Service</label>
                                                    <div id="serviceDropdown">
                                                    <select name="service_id" class="form-control" id="service_id">
                                                        <option value="">Select Service</option>
                                                    </select>
                                                    </div>
                                                    <p class="serviceNameError error-message"></p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Category</label>
                                                    <?php echo $this->Form->input('category',['class' => 'form-control','label'=>false,'id' => 'category','placeholder'=>'Category']); ?>
                                                    <p class="categoryNameError error-message"></p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Size</label>
                                                    <?php echo $this->Form->input('size',['class' => 'form-control','label'=>false,'id' => 'size','placeholder'=>'Size']); ?>
                                                    <p class="sizeNameError error-message"></p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Price</label>
                                                    <?php echo $this->Form->input('price',['type'=>'number','class' => 'form-control','label'=>false,'id' => 'price_id','placeholder'=>'Price']); ?>
                                                    <p class="priceNameError error-message"></p>
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
        var city = $('#city_id').val();
        var service = $('#serviced_i').val();
    	var category = $('#category').val();
    	var price = $('#price_id').val();
    	var size = $("#size").val();
        console.log(price);
    	if (city == "") {
            $(".cityNameError").text("Select Zone!"); 
            $(".cityNameError").css('display','block');
            setTimeout(function(){ 
                $(".cityNameError").fadeOut();
            },1500);
            return false;
        }  else if(service == ''){
            $(".serviceNameError").text("Select Service!"); 
            $(".serviceNameError").css('display','block');
            setTimeout(function(){ 
                $(".serviceNameError").fadeOut();
            },1500);
            return false;
        }else if(category == ''){
    		$(".categoryNameError").text("Category can not be empty!"); 
		    $(".categoryNameError").css('display','block');
		    setTimeout(function(){ 
		        $(".categoryNameError").fadeOut();
		    },1500);
    		return false;
    	}else if(size == ''){
    		$(".sizeNameError").text("Sze can not be empty!"); 
		    $(".sizeNameError").css('display','block');
		    setTimeout(function(){ 
		        $(".sizeNameError").fadeOut();
		    },1500);
    		return false;
    	}else if(price == ''){
    		$(".priceNameError").text("Price can not be empty!"); 
		    $(".priceNameError").css('display','block');
		    setTimeout(function(){ 
		        $(".priceNameError").fadeOut();
		    },1500);
    		return false;
    	}else{
    		return true;
    	}
    }
</script>
<script>
function getService(){
    $.ajax({
      type: 'POST',
      url: '<?php echo $this->Url->build(["controller"=>"Prices", "action"=>"getService"]); ?>',
      data: {city_id:$('#city_id').val()},
      dataType: "text",
      success: function(resultData) { 
          //console.log(resultData);
          document.getElementById("serviceDropdown").innerHTML = resultData;
           }
});
}
</script>