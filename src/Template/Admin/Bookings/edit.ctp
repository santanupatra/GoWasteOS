<div class="container-fluid">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <!-- TABLE HOVER -->
                            <div class="panel widget">
                                <div class="panel-heading widget-title">
                                    <h3 class="panel-title">Edit Service Page</h3>
                                    <div class="right">
                                        <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <?php echo $this->Form->create($service,["class"=>"form-auth-small","type" => "file","onsubmit"=>"return validateForm()"]); ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Title</label>
                                                    <?php echo $this->Form->input('title',['class' => 'form-control pName','label'=>false,'id' => 'page-name','placeholder'=>'Title']); ?>
                                                    <p class="pNameError error-message"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Price</label>
                                                    <?php echo $this->Form->input('price',['class' => 'form-control priceName','label'=>false,'placeholder'=>'Price','id' => 'priceName']); ?>
                                                    <p class="priceNameError error-message"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Icon</label>
                                                    <?php echo $this->Form->input('image',['class' => 'form-control', 'type' => 'file', 'label'=>false]); ?>
                                            
                                                </div>
                                                <input type="hidden" name="oldImg" value="<?php echo $service->image;  ?>">
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="description" class="control-label">Content</label>
                                                    <?php echo $this->Form->input('content',['class' => 'form-control','label'=>false,'id' => 'description','placeholder'=>'Content','type'=>'textarea']); ?>
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
        } else if(price == ''){
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