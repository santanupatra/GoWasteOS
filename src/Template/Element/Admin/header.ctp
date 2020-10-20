<!--NAVBAR -->
        <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #3c8dbc;">
            <div class="brand" style="width: 260px;height:50px;background-color: #3c8dbc;display: block;">
                <a href="<?php echo $this->Url->build('/admin/users/dashboard'); ?>">
                   <h4 style="color: #fff;margin-top: 20px;margin-left: 35px;">GoWasteOs</h4> 
                    <!-- <img src="<?php //echo $this->Url->build('/'.$setting['logo']); ?>" alt="Logo" class="img-responsive logo"> -->
                </a>
            </div>
            <div class="container-fluid">
                <div class="navbar-btn" style="color: #fff;padding: 6px 6px;">
                    <button type="button" class="btn-toggle-fullwidth" style="color: #fff;"><i class="lnr lnr-list"></i></button>
                </div>
                
                <div id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                <i class="lnr lnr-alarm"></i>
                                <span class="badge bg-danger">5</span>
                            </a>
                            <ul class="dropdown-menu notifications">
                                <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
                                <li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
                                <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
                                <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
                                <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
                                <li><a href="#" class="more">See all notifications</a></li>
                            </ul>
                        </li> -->
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #fff;padding: 7px 7px;background-color: #3c8dbc;">
                                <?php if (@$admin_details['profilePicture'] != '') { ?>
                                    <img src="<?php echo $this->Url->build('/'.@$admin_details['profilePicture']); ?>" style="width: 40px;" class="img-circle" alt="User">
                                <?php } else { ?>
                                    <img src="<?php echo $this->Url->build('/img/no-image.jpg'); ?>" style="width: 40px;" class="img-circle" alt="User">
                                <?php } ?>
                                
                                Welcome <?php echo @$admin_details['firstName'] ?>
                                <span><?php echo isset($admin_details['name'])?$admin_details['name']:""; ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $this->Url->build(["controller"=>"Users", "action"=>"myaccount"]); ?>"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                                <li><a href="<?php echo $this->Url->build(["controller"=>"Users", "action"=>"logout"]); ?>"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END NAVBAR