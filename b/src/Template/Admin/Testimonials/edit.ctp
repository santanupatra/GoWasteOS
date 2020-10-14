                <div class="container-fluid">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <!-- TABLE HOVER -->
                            <div class="panel widget">
                                <div class="panel-heading widget-title">
                                    <h3 class="panel-title">Edit Testimonial</h3>
                                    <div class="right">
                                        <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <?php echo $this->Form->create($testimonial,["class"=>"form-auth-small","onsubmit"=>"return validateForm()"]); ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title" class="control-label">Title</label>
                                                    <?php echo $this->Form->input('title',['type'=>'textarea','class' => 'form-control title','label'=>false,'id' => 'title','rows'=>'4']); ?>
                                                    <p class="titleError error-message"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label class="fancy-checkbox">
                                                        <input type="checkbox" class="form-control" name="isActive" <?php echo $testimonial->isActive==1 ? "checked" : ""; ?>>
                                                        <span>Active</span>
                                                    </label>
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
        var title = $('.title').val();
        if (title == "") {
            $(".titleError").text("Title can not be empty!"); 
            $(".titleError").css('display','block');
            setTimeout(function(){ 
                $(".titleError").fadeOut();
            },1500);
            return false;
        } else{
            return true;
        }
    }
</script>