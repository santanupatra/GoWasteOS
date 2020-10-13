<body id="top">


  <div class="header-overlay"></div>
  <header class="main_head">

    <div class="bootombar">
      <div class="container">
        <nav class="navbar navbar-expand-lg">
          <div class="logo">
          <a href="<?php echo $this->Url->build('/'); ?>"><img src="<?php echo $this->Url->build('/'.$setting['logo']); ?>" alt=""></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="nav-mobile-header d-flex align-items-center justify-content-between">
              <h4>Menu</h4>
              <span class="close-menu"><img src="<?php echo $this->Url->build('/'); ?>frontend/images/close.png" alt=""></span>
            </div>
            <ul class="navbar-nav">
              <li class="<?php if($this->request->params['action'] == 'home'){ echo "current-menu-item"; } ?>"><a href="<?php echo $this->Url->build('/'); ?>">Home</a></li>
              <li class="<?php if($this->request->params['action'] == 'product'){ echo "current-menu-item"; } ?>"><a href="<?php echo $this->Url->build('/product'); ?>">products</a></li>
              <li class="<?php if($this->request->params['controller'] == 'Services' && $this->request->params['action'] == 'index'){ echo "current-menu-item"; } ?>"><a href="<?php echo $this->Url->build(['controller'=>'Services','action'=>'index']); ?>">services</a></li>
              <li class="<?php if($this->request->params['controller'] == 'Products' && $this->request->params['action'] == 'index'){ echo "current-menu-item"; } ?>"><a href="<?php echo $this->Url->build(['controller'=>'Products','action'=>'index']); ?>">industries</a></li>
              <li class="<?php if($this->request->params['action'] == 'about'){ echo "current-menu-item"; } ?>"><a href="<?php echo $this->Url->build('/about'); ?>">about</a></li>
              <!-- <li class="current-menu-item"><a href="#url">News</a></li> -->
              <!-- <li class="menu-item-has-children">
                <a href="#url">News</a>
                <span class="clickD"></span>
                <ul class="sub-menu">
                  <li><a href="#url">Option 1</a></li>
                  <li><a href="#url">Option 1</a></li>
                  <li><a href="#url">Option 1</a></li>
                  <li><a href="#url">Option 1</a></li>
                </ul>
              </li> -->
              <li class="<?php if($this->request->params['action'] == 'contactus'){ echo "current-menu-item"; } ?>"><a href="<?php echo $this->Url->build(['controller'=>'Services','action'=>'contactus']); ?>" class="quote_btn">Get Quotes</a></li>

            </ul>
          </div>
          <ul class="logn-menu">
            <li class="logn-menu-children">
              <a href="#">
                <span class="with-out-login">
                  <img src="<?php echo $this->Url->build('/'); ?>frontend/images/login.png" alt="">
                </span>
              </a>
              <ul class="sub-menus">
              <?php if (isset($userid) && $userid != '') { ?>
                <li><a href="<?php echo $this->Url->build(["controller"=>"Users", "action"=>"profile"]); ?>">Profile</a></li>
                <li><a href="<?php echo $this->Url->build(["controller"=>"Users", "action"=>"query"]); ?>">Query</a></li>
                <li><a href="<?php echo $this->Url->build(["controller"=>"Users", "action"=>"logout"]); ?>">Logout</a></li>
              <?php }else { ?>
                <li><a data-toggle="modal" data-target="#exampleModalCenter">Login</a></li>
                <li><a data-toggle="modal" data-target="#exampleModalCenter1">Sign Up</a></li>
              <?php } ?>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </header>