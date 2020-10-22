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
    <title>GoWasteOs | GoWasteOs</title>
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>frontend/css/slick-theme.css">
    <link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>frontend/css/slick.css">
    <link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>frontend/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>frontend/css/style.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>frontend/css/responsive.css">
    <!-- <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $this->Url->build('/'.$setting['favIcon']); ?>"> -->

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
