<!-- LEFT SIDEBAR -->
        <div id="sidebar-nav" class="sidebar">
            <div class="sidebar-scroll">
                <nav>
                    <?php
                        $controller_name = $this->request->getParam('controller');
                        $action_name = $this->request->getParam('action');

                        $loguserid = $this->request->session()->read('Auth.Admin.id');
                        $logusertype = $this->request->session()->read('Auth.Admin.type');
                        
                        if($logusertype=='SA'){
                            $subadminMenuArr = explode(',',@$admin_details['subadmin_access_ids']);
                        } 
                        if($logusertype=='A'){
                            $subadminMenuArr = array('1','2','3','4','5','6','7', '8', '9','10', '11');
                        }

                        // echo '<pre>'; print_r($leftmenu_list);

                    ?>
                    <ul class="nav">

                    <?php if(in_array('1',$subadminMenuArr)){ ?>
                        <li>
                            <a href="<?php echo $this->Url->build('/admin/users/dashboard'); ?>" class="<?php if(@$action_name=='dashboard'){echo 'active';} ?>">
                                <i class="lnr lnr-home"></i> <span>Dashboard</span>
                            </a>
                        </li>
                    <?php } ?>
                    
                    <?php if(in_array('2',$subadminMenuArr)){ ?>
                        <li>
                            <a href="#settings" aria-expanded="true" data-toggle="collapse" class="collapsed <?php if(@$controller_name=='Settings'){echo 'active';} ?>">
                                <i class="lnr lnr-cog"></i> <span>Manage Settings</span> <i class="icon-submenu lnr lnr-chevron-left"></i>
                            </a>
                            <div id="settings" class="collapse ">
                                <ul class="nav">
                                    <li>
                                        <a href="<?php echo $this->Url->build(["controller"=>"Settings", "action"=>"index"]); ?>" class="<?php if(@$controller_name=='Settings'){echo 'active';} ?>">
                                            App Setting
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>
                    
                    <?php if(in_array('3',$subadminMenuArr)){ ?>
                        <li>
                            <a href="#subadmin" data-toggle="collapse" class="collapsed <?php if(@$action_name=='subadmin_list' || @$action_name=='add_subadmin' || @$action_name=='edit_subadmin' 
                                || @$action_name=='subadmin_view'){echo 'active';} ?>">
                                <i class="lnr lnr-lock" aria-hidden="true"></i> <span>Manage Sub Admin</span><i class="icon-submenu lnr lnr-chevron-left"></i>
                            </a>
                            <div id="subadmin" class="collapse ">
                                <ul class="nav">
                                    <li>
                                        <a href="<?php echo $this->Url->build(["controller"=>"Users", "action"=>"subadmin_list"]); ?>" class="<?php if(@$action_name=='subadmin_list'){echo 'active';} ?>">Sub Admin</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>
                    
                    <?php if(in_array('4',$subadminMenuArr)){ ?>
                        <li>
                            <a href="#city" data-toggle="collapse" class="collapsed <?php if(@$controller_name=='Cities'){echo 'active';} ?>">
                                <i class="lnr lnr-map-marker"></i> <span>Manage City</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="city" class="collapse ">
                                <ul class="nav">
                                    <li>
                                        <a href="<?php echo $this->Url->build(["controller"=>"Cities", "action"=>"index"]); ?>" class="<?php if(@$controller_name=='Cities'){echo 'active';} ?>">
                                            City List
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>
                    
                    <?php if(in_array('7',$subadminMenuArr)){ ?>
                        <li>
                            <a href="#service" data-toggle="collapse" class="collapsed <?php if(@$controller_name=='Services'){echo 'active';} ?>">
                                <i class="lnr lnr-pushpin" aria-hidden="true"></i> <span>Manage Service</span><i class="icon-submenu lnr lnr-chevron-left"></i>
                            </a>
                            <div id="service" class="collapse ">
                                <ul class="nav">
                                    <li>
                                        <a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"index"]); ?>" class="<?php if(@$controller_name=='Services'){echo 'active';} ?>">
                                            Service List
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if(in_array('11',$subadminMenuArr)){ ?>
                        <li>
                            <a href="#price" data-toggle="collapse" class="collapsed <?php if(@$controller_name=='Prices'){echo 'active';} ?>">
                            <i class="lnr lnr-paperclip" aria-hidden="true"></i> <span>Manage Price </span><i class="icon-submenu lnr lnr-chevron-left"></i>
                            </a>
                            <div id="price" class="collapse ">
                                <ul class="nav">
                                    <li>
                                        <a href="<?php echo $this->Url->build(["controller"=>"Prices", "action"=>"index"]); ?>" class="<?php if(@$controller_name=='Prices'){echo 'active';} ?>">
                                            Price List
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if(in_array('5',$subadminMenuArr) || in_array('6',$subadminMenuArr)){ ?>
                        <li>
                            <a href="#user" data-toggle="collapse" class="collapsed <?php if(@$action_name=='service_provider_list' || @$action_name=='customer_list'){echo 'active';} ?>">
                                <i class="lnr lnr-users" aria-hidden="true"></i> <span>Manage All User</span><i class="icon-submenu lnr lnr-chevron-left"></i>
                            </a>
                            <div id="user" class="collapse ">
                                <ul class="nav">
                                <?php if(in_array('5',$subadminMenuArr)){ ?>
                                    <li>
                                        <a href="<?php echo $this->Url->build(["controller"=>"Users", "action"=>"service_provider_list"]); ?>" class="<?php if(@$action_name=='service_provider_list'){echo 'active';} ?>">Service Provider</a>
                                    </li>
                                <?php } if(in_array('6',$subadminMenuArr)){ ?>
                                    <li>
                                        <a href="<?php echo $this->Url->build(["controller"=>"Users", "action"=>"customer_list"]); ?>" class="<?php if(@$action_name=='customer_list'){echo 'active';} ?>">Customer</a>
                                    </li>
                                <?php } ?>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if(in_array('8',$subadminMenuArr)){ ?>
                        <li>
                            <a href="#booking" data-toggle="collapse" class="collapsed <?php if(@$controller_name=='Bookings'){echo 'active';} ?>">
                                <i class="lnr lnr-cart" aria-hidden="true"></i> <span>Manage Booking</span><i class="icon-submenu lnr lnr-chevron-left"></i>
                            </a>
                            <div id="booking" class="collapse ">
                                <ul class="nav">
                                    <li>
                                        <a href="<?php echo $this->Url->build(["controller"=>"Bookings", "action"=>"index"]); ?>" class="<?php if(@$controller_name=='Bookings'){echo 'active';} ?>">
                                            Booking List
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if(in_array('9',$subadminMenuArr)){ ?>
                        <li>
                            <a href="#rating" data-toggle="collapse" class="collapsed <?php if(@$controller_name=='Reviews'){echo 'active';} ?>">
                                <i class="lnr lnr-star" aria-hidden="true"></i> <span>Manage Rating </span><i class="icon-submenu lnr lnr-chevron-left"></i>
                            </a>
                            <div id="rating" class="collapse ">
                                <ul class="nav">
                                    <li>
                                        <a href="<?php echo $this->Url->build(["controller"=>"Reviews", "action"=>"index"]); ?>" class="<?php if(@$controller_name=='Reviews'){echo 'active';} ?>">
                                            Customer To Provider
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->Url->build(["controller"=>"Reviews", "action"=>"service_provider"]); ?>" class="<?php if(@$controller_name=='Reviews'){echo 'active';} ?>">
                                        Provider To Customer
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>
                    <?php if(in_array('10',$subadminMenuArr)){ ?>
                        <li>
                            <a href="#accounts" data-toggle="collapse" class="collapsed <?php if(@$controller_name=='Accounts'){echo 'active';} ?>">
                            <i class="lnr lnr-database" aria-hidden="true"></i> <span>Manage Account </span><i class="icon-submenu lnr lnr-chevron-left"></i>
                            </a>
                            <div id="accounts" class="collapse ">
                                <ul class="nav">
                                    <li>
                                        <a href="<?php echo $this->Url->build(["controller"=>"Accounts", "action"=>"service_provider"]); ?>" class="<?php if(@$controller_name=='Accounts'){echo 'active';} ?>">
                                            Service Provider
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->Url->build(["controller"=>"Accounts", "action"=>"customer"]); ?>" class="<?php if(@$controller_name=='Accounts'){echo 'active';} ?>">
                                       Customer
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>


                    </ul>
                </nav>
            </div>
        </div>
        <!-- END LEFT SIDEBAR -->