<!-- LEFT SIDEBAR -->
        <div id="sidebar-nav" class="sidebar">
            <div class="sidebar-scroll">
                <nav>
                    <ul class="nav">
                        <li><a href="<?php echo $this->Url->build('/admin/users/dashboard'); ?>" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                        <li>
                            <a href="#logo" data-toggle="collapse" class="collapsed"><i class="lnr lnr-cog"></i> <span>Manage Logo</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="logo" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Settings", "action"=>"logo"]); ?>" class="">Manage Logo</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#settings" data-toggle="collapse" class="collapsed"><i class="lnr lnr-cog"></i> <span>Manage Settings</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="settings" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Settings", "action"=>"index"]); ?>" class="">Site Setting</a></li>
                                </ul>
                            </div>
                        </li>
                        
                        <li>
                            <a href="#banner" data-toggle="collapse" class="collapsed"><i class="lnr lnr-picture"></i> <span>Manage Banner</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="banner" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Banners", "action"=>"index"]); ?>" class="">Banner List</a></li>
                                    <!-- <li><a href="<?php echo $this->Url->build(["controller"=>"Banners", "action"=>"add"]); ?>" class="">Add Banner</a></li> -->
                                </ul>
                            </div>
                        </li>

                        <!-- <li>
                            <a href="#homepage" data-toggle="collapse" class="collapsed"><i class="lnr lnr-picture"></i> <span>Manage Homepage</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="homepage" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Homepages", "action"=>"index"]); ?>" class="">List</a></li>
                                </ul>
                            </div>
                        </li> -->

                        <li>
                            <a href="#cms" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Manage CMS</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="cms" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"CmsPages", "action"=>"index"]); ?>" class="">CMS Page List</a></li>
                                    <!-- <li><a href="<?php echo $this->Url->build(["controller"=>"CmsPages", "action"=>"add"]); ?>" class="">Add CMS Page</a></li> -->
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#product" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty" aria-hidden="true"></i> <span>Manage Product</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="product" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Products", "action"=>"add"]); ?>" class="">Add Product</a></li>
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Products", "action"=>"index"]); ?>" class="">Product List</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#client" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty" aria-hidden="true"></i> <span>Manage Service</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="client" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"add"]); ?>" class="">Add Service</a></li>
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"index"]); ?>" class="">Service List</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#faq" data-toggle="collapse" class="collapsed"><i class="fa fa-question-circle" aria-hidden="true"></i> <span>Manage FAQ</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="faq" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Faqs", "action"=>"add"]); ?>" class="">Add FAQ</a></li>
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Faqs", "action"=>"index"]); ?>" class="">FAQ List</a></li>
                                </ul>
                            </div>
                        </li>

                        <!-- <li>
                            <a href="#service" data-toggle="collapse" class="collapsed"><i class="lnr lnr-picture"></i> <span>Manage Service</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="service" class="collapse ">
                                <ul class="nav">
                                    <li><a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"index"]); ?>" class="">Service List</a></li>
                                </ul>
                            </div>
                        </li> -->

                    </ul>
                </nav>
            </div>
        </div>
        <!-- END LEFT SIDEBAR -->