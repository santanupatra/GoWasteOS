<div class="container-fluid">
					<div class="row">
						
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel widget">
								<div class="panel-heading widget-title">
									<h3 class="panel-title">Add Review</h3>
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
                                                    <label for="email" class="control-label">Review Given To</label>
                                                    <select name="to_id" class="form-control">
                                                    <option value="">Choose User</option>
                                                    <?php 
                                                    foreach($users as $user): ?>
                                                    <option value="<?php echo $user['id']; ?>"><?php echo $user['firstName'].' '.$user['lastName']; ?></option>
                                                    <?php endforeach ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email" class="control-label">Review Given By</label>
                                                    <select name="from_id" class="form-control">
                                                        <option value="">Choose User</option>
                                                        <?php 
                                                        foreach($users as $user): ?>
                                                        <option value="<?php echo $user['id']; ?>"><?php echo $user['firstName'].' '.$user['lastName']; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    
                                                    <label>Rating</label><br>
                                                    <div class="rate">
                                                        <span id="span1" onclick="rate(1)" class="fa fa-star "></span> 
                                                        <span id="span2" onclick="rate(2)"  class="fa fa-star "></span>
                                                        <span id="span3" onclick="rate(3)" class="fa fa-star "></span>
                                                        <span id="span4" onclick="rate(4)"  class="fa fa-star "></span>
                                                        <span id="span5" onclick="rate(5)"  class="fa fa-star "></span> 
                                                        <input type="hidden" name="rating" value="" id="RatingId">
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="description" class="control-label">Comment</label>
                                                    <?php echo $this->Form->input('comment',['class' => 'form-control','label'=>false,'placeholder'=>'Comment','type'=>'textarea']); ?>
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
<style>
.rate {
    float: left;
    height: 46px;
    text-align: left;
}
.rate span{
    cursor:pointer;
}
.checked {
  color: orange;
}
</style>

<script>

function rate(e){
    
    if($("#span"+e).hasClass("checked")){
            $("#span1").removeClass("checked");
            $("#span2").removeClass("checked");
            $("#span3").removeClass("checked");
            $("#span4").removeClass("checked");
            $("#span5").removeClass("checked");
    }else{
        if(e>1 || e==1){
            $("#span1").addClass("checked");
        }
        if(e>2 || e==2){
            $("#span2").addClass("checked");
        }
        if(e>3 || e==3){
            $("#span3").addClass("checked");
        }
        if(e>4 || e==4){
            $("#span4").addClass("checked");
        }
        if(e==5){
            $("#span5").addClass("checked");
        }
    }

    if($("#span"+e).hasClass("checked")){
        $("#RatingId").val(e);
    }else{
        $("#RatingId").val(0);
    }
}

</script>


<!-- <script type="text/javascript">
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
</script> -->