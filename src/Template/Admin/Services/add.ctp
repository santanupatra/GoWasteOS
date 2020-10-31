<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Add Service</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<div class="row">
                                        <?php echo $this->Form->create(null,["class"=>"form-auth-small","type" => "file","onsubmit"=>"return validateForm()"]); ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Title</label>
                                                    <?php echo $this->Form->input('title',['class' => 'form-control pName','label'=>false,'id' => 'page-name','placeholder'=>'Title']); ?>
                                                    <p class="pNameError error-message"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email" class="control-label">Choose Unit of Waste Size</label>
                                                    <select name="unit" class="form-control" id="unit">
                                                        <option value="">Unit</option>                                         
                                                        <option value="Tons">Tons</option>
                                                        <option value="Liters">Liters</option>                                                    
                                                    </select>
                                                    <p class="unitNameError error-message"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email" class="control-label">Choose City</label>
                                                    <select name="city_id[]" multiple="multiple" class="form-control select2" id="city_id">
                                                        <option value="">City</option>
                                                        <?php 
                                                        foreach($cities as $city): ?>
                                                        <option value="<?php echo $city['id']; ?>"><?php echo $city['name']; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <p class="cityNameError error-message"></p>
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label for="page-name" class="control-label">Price per ton in NGN</label>
                                                    <?php echo $this->Form->input('price',['type'=>'number','class' => 'form-control priceName','label'=>false,'placeholder'=>'Price','id' => 'priceName']); ?>
                                                    <p class="priceNameError error-message"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Icon</label>
                                                    <?php echo $this->Form->input('image',['class' => 'form-control', 'type'=>'file', 'label'=>false, 'id'=>'image-upload']); ?>                                                    
                                                </div>
                                                <div class="form-group">                                                    
                                                    <img src="<?php echo $this->Url->build('/service_image/no-image.png'); ?>" id="user-image"  class="show-image">
                                                </div> -->
                                            </div>
                                            <div class="col-md-12">
                                                <!-- <div class="form-group">
                                                    <label for="description" class="control-label">Content</label>
                                                    <?php echo $this->Form->input('content',['class' => 'form-control','label'=>false,'id' => 'description','placeholder'=>'Description','type'=>'textarea']); ?>
                                                    <p class="descriptionError error-message"></p>
                                                </div> -->
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
        var unit = $('#unit').val();
        var city = $("#city_id").val();
    	// var price = $('.priceName').val();
    	// var description = $("#description").val();
    	if (pName == "") {
            $(".pNameError").text("Service title can not be empty!"); 
            $(".pNameError").css('display','block');
            setTimeout(function(){ 
                $(".pNameError").fadeOut();
            },1500);
            return false;
        } else if(unit == ''){
            $(".unitNameError").text("Unit can not be empty!"); 
            $(".unitNameError").css('display','block');
            setTimeout(function(){ 
                $(".unitNameError").fadeOut();
            },1500);
            return false;
        }else if(city == ''){
    		$(".cityNameError").text("Choose City!"); 
		    $(".cityNameError").css('display','block');
		    setTimeout(function(){ 
		        $(".cityNameError").fadeOut();
		    },1500);
    		return false;
    	}
        // else if(price == ''){
        //     $(".priceNameError").text("price can not be empty!"); 
        //     $(".priceNameError").css('display','block');
        //     setTimeout(function(){ 
        //         $(".priceNameError").fadeOut();
        //     },1500);
        //     return false;
        // }else if(description == ''){
    	// 	$(".descriptionError").text("Description can not be empty!"); 
		//     $(".descriptionError").css('display','block');
		//     setTimeout(function(){ 
		//         $(".descriptionError").fadeOut();
		//     },1500);
    	// 	return false;
    	// }
        else{
    		return true;
    	}
    }
</script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() { 
        $("#city_id").select2();
    });
</script>