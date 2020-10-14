
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle">
                <div class="auth-box ">
                    <div class="content">
                        <div class="header">
                            <!-- <div class="logo text-center login-logo "><a href="<?php echo $this->Url->build(['controller'=>'Users', 'action'=>'index']); ?>"><img src="<?php echo $this->Url->build('/'.$setting['logo']); ?>" alt="Logo"></a></div> -->
                            <p class="lead">Login to your account</p>
                        </div>
                        <?= $this->Flash->render('auth') ?>
                        <?php echo $this->Form->create('User',array('enctype'=>'multipart/form-data','class'=>'form-auth-small'));?>
                        <!-- <form class="form-auth-small" action="" method="post"> -->
                            <div class="form-group">
                                <label for="signin-email" class="control-label sr-only">Email</label>
                                <?php echo $this->Form->input('email',array('class'=>'form-control','required'=>'required','placeholder'=>'Email')); ?>
                            </div>
                            <div class="form-group">
                                <label for="signin-password" class="control-label sr-only">Password</label>
                                <?php echo $this->Form->input('password',array('class'=>'form-control','required'=>'required','placeholder'=>'Password')); ?>
                            </div>
                            <div class="form-group clearfix">
                                
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                            <div class="bottom">
                                <span class="helper-text"><i class="fa fa-lock"></i> <a href="<?php echo $this->Url->build(['controller'=>'Users', 'action'=>'forgotPassword']); ?>">Forgot password?</a></span>
                            </div>
                            <?php echo $this->Form->end(); ?>
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

