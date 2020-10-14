
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle">
                <div class="auth-box ">
                    <div class="content">
                        <div class="header">
                            <div class="logo text-center login-logo"><a href="<?php echo $this->Url->build(['controller'=>'Users', 'action'=>'index']); ?>"> <img src="<?php echo $this->Url->build('/'.$setting['logo']); ?>" alt="Klorofil Logo"></a></div>
                            <p class="lead">Reset Password</p>
                        </div>
                        <?= $this->Flash->render('auth') ?>
                        <?php echo $this->Form->create(null,["class"=>"form-auth-small"]); ?>
                            <div class="form-group">
                                <label for="npassword" class="control-label">New Password</label>
                                <?php echo $this->Form->input('new_password',['type'=>'password','class' => 'form-control','label'=>false,'id' => 'npassword','placeholder'=>'New Password','required'=>'required']); ?>
                            </div>
                            <div class="form-group">
                                <label for="cpassword" class="control-label">Confirm Password</label>
                                <?php echo $this->Form->input('password',['class' => 'form-control','label'=>false,'id' => 'cpassword','placeholder'=>'Confirm Password','required'=>'required']); ?>
                            </div>
                            <?php echo $this->Form->submit('SUBMIT',['class'=>'btn btn-primary btn-lg btn-block']); ?>
                        <?php echo $this->Form->end(); ?>
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

