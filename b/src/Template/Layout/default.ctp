<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
<?= $this->Html->charset() ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadly | Cadly</title>
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>frontend/css/slick-theme.css">
    <link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>frontend/css/slick.css">
    <link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>frontend/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>frontend/css/style.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>frontend/css/responsive.css">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $this->Url->build('/'.$setting['favIcon']); ?>">

    <!-- <script src="<?php echo $this->Url->build('/'); ?>frontend/js/jquery-1.9.1.js"></script> -->
    <!-- Jquery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="<?php echo $this->Url->build('/'); ?>frontend/js/bootstrap.js"></script>
    
    
</head>
<body>
    <!-- header start -->
    <?php echo $this->element('header'); ?>
    <!-- header end -->

    <?php echo $this->Flash->render() ?>
    <?php echo $this->Flash->render('success') ?>
    <?php echo $this->Flash->render('error') ?>
    <?php echo $this->fetch('content'); ?>
    
    <!-- footer-area-start -->
    <footer class="footer-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-4 footer-para">
            <a href="<?php echo $this->Url->build('/'); ?>"><img src="<?php echo $this->Url->build('/'.$setting['logo']); ?>" alt=""></a>
            <p><?php echo $footer['bannerContent']; ?></p>
            <ul class="social">
              <li><a href="<?php echo $setting['facebookUrl']; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
              <li><a href="<?php echo $setting['twitterUrl']; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
              <li><a href="<?php echo $setting['instagramUrl']; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6">
            <h3 class="footer-title">Footer menu</h3>
            <ul class="footer-menu">
              <!-- <li><a href="<?php echo $this->Url->build(['controller'=>'Searches','index']); ?>">Search</a></li> -->
              <li><a href="<?php echo $this->Url->build('/about'); ?>">About</a></li>
              <li><a href="<?php echo $this->Url->build(['controller'=>'Pages','action'=>'faq']); ?>">FAQ</a></li>
              <li><a href="<?php echo $this->Url->build('/legal'); ?>">Legal</a></li>
              <!-- <li><a href="<?php echo $this->Url->build('/career'); ?>">Career</a></li> -->
              <li><a href="<?php echo $this->Url->build(['controller'=>'Services','action'=>'contactus']); ?>">Contact Us</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6">
            <h3 class="footer-title">Quick links</h3>
            <ul class="footer-quick-links">
              <li><a href="<?php echo $this->Url->build(['controller'=>'Services','action'=>'details','3d-design']); ?>">3d Design</a></li>
              <li><a href="<?php echo $this->Url->build(['controller'=>'Services','action'=>'details','3d-printinng']); ?>">3d Printing</a></li>
              <li><a href="<?php echo $this->Url->build(['controller'=>'Services','action'=>'details','project-coordination']); ?>">Project Coordination</a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    <div class="copy-right-area text-center">
      <p>© <?php echo date('Y'); ?>. All rights reserved.</p>
    </div>
  </div>
  <!-- login-modal -->
  <div class="modal fade submission-modal" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="page-title">Login</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times"></i>
          </button>
        </div>
        <div class="modal-body">
        <p class="success-message text-center text-success"></p>
          <?php echo $this->Form->create(null,["class"=>"login-form","url"=>['controller' => 'Users', 'action' => 'login']]); ?>
            <div class="form-group">
              <input type="email" name="email" placeholder="Enter email">
            </div>
            <div class="form-group">
              <input type="password" name="password" placeholder="Enter password">
            </div>
            <button type="submit" class="cmn-btn">submit</button>
            <?php echo $this->Form->end(); ?>
        </div>
      </div>
    </div>
  </div>

  <!-- signup-modal -->
  <div class="modal fade submission-modal" id="exampleModalCenter1" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="page-title">Sign  Up</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times"></i>
          </button>
        </div>
        <div class="modal-body">
        <p class="success-message text-center text-success"></p>
          <form class="login-form row userSignupData">
            <div class="form-group col-md-6">
              <input type="text" name="firstName" placeholder="Enter First Name" required="required">
            </div>
            <div class="form-group col-md-6">
              <input type="text" name="lastName" placeholder="Enter Last Name">
            </div>
            <div class="form-group col-md-12">
              <input type="text" name="phoneNumber" placeholder="Enter Phone Number">
            </div>
            <div class="form-group col-md-12">
              <input type="text" name="email" placeholder="Enter Email Address" required="required">
            </div>
            <div class="form-group col-md-12">
              <input type="password" name="password" class="pass" placeholder="Enter password" required="required">
            </div>
            <div class="form-group col-md-12">
              <input type="password" name="confirmPassword" class="conf-pass" placeholder="Enter confirm password" required="required">
            </div>
            <button type="button" class="cmn-btn resigterBtn">submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <script src="<?php echo $this->Url->build('/'); ?>frontend/js/slick.js"></script>
  <script src="<?php echo $this->Url->build('/'); ?>frontend/js/main.js"></script>
  <script>
        window.setTimeout(function() {
            $(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 5000);
    </script>
  <script>
  $(".resigterBtn").click(function(){
    var pass = $(".pass").val();
    var confPass = $(".conf-pass").val();
    if(pass != confPass) {
      alert("Both password should be match");
      return false;
    }
    $.ajax({
        url: "<?php echo $this->Url->build(['controller'=>'Users','action'=>'ajaxUserSignup']); ?>",
        beforeSend: function(xhr){
            xhr.setRequestHeader('X-CSRF-Token', '<?php echo $this->request->getParam('_csrfToken') ?>');
        },
        type: "post",
        dataType: "json",
        data: $(".userSignupData").serialize(),
        success: function(data){
          $(".success-message").text(data.msg);
          setTimeout(function(){ 
            location.reload();
          },5000); 
        }
    });
  });
  </script>
</body>
</html>
