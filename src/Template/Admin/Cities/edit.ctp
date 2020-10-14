                <div class="container-fluid">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <!-- TABLE HOVER -->
                            <div class="panel widget">
                                <div class="panel-heading widget-title">
                                    <h3 class="panel-title">Edit City</h3>
                                    <div class="right">
                                        <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <?php echo $this->Form->create($city,["class"=>"form-auth-small","onsubmit"=>"return validateForm()"]); ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="page-name" class="control-label">Name</label>
                                                    <?php echo $this->Form->input('name',['type'=>'text','class' => 'form-control pName','label'=>false,'id' => 'page-name','placeholder'=>'City Name']); ?>
                                                    <p class="pNameError error-message"></p>
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
    //CKEDITOR.replace('description');

    function validateForm () {
        var pName = $('.pName').val();
        if (pName == "") {
            $(".pNameError").text("City name can not be empty!"); 
            $(".pNameError").css('display','block');
            setTimeout(function(){ 
                $(".pNameError").fadeOut();
            },1500);
            return false;
        } else{
            return true;
        }
    }
</script>