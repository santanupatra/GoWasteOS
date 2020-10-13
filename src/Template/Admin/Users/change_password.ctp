
       <div class="container-fluid">
            <div class="row">
                        
                <div class="col-md-12">
                    <!-- TABLE HOVER -->
                    <div class="panel widget">
                        <div class="panel-heading widget-title">
                            <h3 class="panel-title">Change Password</h3>
                            <div class="right">
                                <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo $this->Form->create(null,["class"=>"form-auth-small"]); ?>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label for="npassword" class="control-label">New Password</label>
                                                <?php echo $this->Form->input('new_password',['type'=>'password','class' => 'form-control','label'=>false,'id' => 'npassword','placeholder'=>'New Password','required'=>'required']); ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="cpassword" class="control-label">Confirm Password</label>
                                                <?php echo $this->Form->input('password',['class' => 'form-control','label'=>false,'id' => 'cpassword','placeholder'=>'Confirm Password','required'=>'required']); ?>

                                            </div>
                                            
                                            <div class="form-group">
                                                <?php echo $this->Form->submit('Submit',['class'=>'btn btn-primary pull-right']); ?>
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

