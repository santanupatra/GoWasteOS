<!-- LEFT SIDEBAR -->
        <div id="sidebar-nav" class="sidebar">
            <div class="sidebar-scroll">
                <nav>
                    <ul class="nav">
                        <li><a href="<?php echo $this->Url->build('/admin/users/dashboard'); ?>" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>

                        <li>
                            <a href="#settings" data-toggle="collapse" class="collapsed"><i class="lnr lnr-cog"></i> <span>Manage Settings</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="settings" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Settings", "action"=>"index"]); ?>" class="">App Setting</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#city" data-toggle="collapse" class="collapsed"><i class="lnr lnr-map-marker"></i> <span>Manage City</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="city" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Cities", "action"=>"index"]); ?>" class="">City List</a></li>
                                </ul>
                            </div>
                        </li>
                        

                        <li>
                            <a href="#user" data-toggle="collapse" class="collapsed"><i class="lnr lnr-users" aria-hidden="true"></i> <span>Manage All User</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="user" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Users", "action"=>"service_provider_list"]); ?>" class="">Service Provider</a></li>
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Users", "action"=>"customer_list"]); ?>" class="">Customer</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#pricing" data-toggle="collapse" class="collapsed"><i class="lnr lnr-pushpin" aria-hidden="true"></i> <span>Manage Pricing</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="pricing" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"add"]); ?>" class="">Add Pricing</a></li>
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"index"]); ?>" class="">Pricing List</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#booking" data-toggle="collapse" class="collapsed"><i class="lnr lnr-cart" aria-hidden="true"></i> <span>Manage Booking</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="booking" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"add"]); ?>" class="">Add Booking</a></li>
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"index"]); ?>" class="">Booking List</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#service" data-toggle="collapse" class="collapsed"><i class="lnr lnr-list" aria-hidden="true"></i> <span>Manage Service </span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="service" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"add"]); ?>" class="">Add Service</a></li>
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"index"]); ?>" class="">Service List</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#rating" data-toggle="collapse" class="collapsed"><i class="lnr lnr-star" aria-hidden="true"></i> <span>Manage Rating </span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="rating" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"add"]); ?>" class="">Add Rating</a></li>
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"index"]); ?>" class="">Rating List</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#message" data-toggle="collapse" class="collapsed"><i class="lnr lnr-envelope" aria-hidden="true"></i> <span>Manage Messages </span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="message" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"add"]); ?>" class="">Add Messages</a></li>
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"index"]); ?>" class="">Messages List</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#account" data-toggle="collapse" class="collapsed"><i class="lnr lnr-database" aria-hidden="true"></i> <span>Manage Financial Account </span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="account" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"add"]); ?>" class="">Add Financial Account</a></li>
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"index"]); ?>" class="">Messages List</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#comission" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty" aria-hidden="true"></i> <span>Manage Commision </span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="comission" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"add"]); ?>" class="">Add Commision</a></li>
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"index"]); ?>" class="">Commision List</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#analytics" data-toggle="collapse" class="collapsed"><i class="lnr lnr-pie-chart" aria-hidden="true"></i> <span>Manage Analytics </span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="analytics" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"add"]); ?>" class="">Add Analytics</a></li>
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"index"]); ?>" class="">Analytics List</a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
        <!-- END LEFT SIDEBAR -->