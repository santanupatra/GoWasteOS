
    <section class="py-5">
        <div class="container">
                <div class="col-lg-6 mt-4" style="margin: auto">
                    <h5 class="font-weight-boldest mb-4">Set Password</h5>
                    <div class="Donate-form p-4">
                        <?php echo $this->Form->create(null,["url"=>"","class"=>""]); ?>
                            <div class="row">
                                <div class="col-md-12 mt-4">
                                    <input type="password" name="new_password" class="form-control" placeholder="New Password" required="required" />
                                </div>
                                <div class="col-md-12 mt-4">
                                    <input type="password" name="password" class="form-control" placeholder="Confirm Password" required="required" />
                                </div>
                            </div>
                            <?php echo $this->Form->submit('Submit',['class'=>'btn btn-secondary mt-4']); ?>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>