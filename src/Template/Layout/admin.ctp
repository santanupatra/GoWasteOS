<!doctype html>
<html lang="en">

<head>
	<title>GoWasteOs | GoWasteOs Admin</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>assets/vendor/chartist/css/chartist-custom.css">
	<link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>css/bootstrap-datetimepicker.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>assets/css/demo.css">
	<link rel="stylesheet" href="<?php echo $this->Url->build('/'); ?>css/developer.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo $this->Url->build('/'.$setting['fav_icon']); ?>">

	<!-- Javascript -->
	<script src="<?php echo $this->Url->build('/'); ?>assets/vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo $this->Url->build('/'); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

	<script src="<?php echo $this->Url->build('/'); ?>assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo $this->Url->build('/'); ?>assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="<?php echo $this->Url->build('/'); ?>assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="<?php echo $this->Url->build('/'); ?>assets/scripts/klorofil-common.js"></script>
	<script src="<?php echo $this->Url->build('/'); ?>ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
	<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<?php if($this->request->params['controller'] == 'Users' && ($this->request->params['action'] == 'index' || $this->request->params['action']=='forgotPassword' || $this->request->params['action']=='setpassword')){ 

			echo $this->Flash->render();
            echo $this->Flash->render('success');
            echo $this->Flash->render('error');
            echo $this->fetch('content');

        } else { ?>
		
			<!-- BEGIN HEADER -->
	        <?php echo $this->element("Admin/header"); ?>
	        <!-- END HEADER -->

	        <!-- BEGIN SIDEBAR -->
	        <?php echo $this->element("Admin/left_panel"); ?>
	        <!-- END SIDEBAR -->


	        <!-- MAIN -->
			<div class="main">
				<!-- MAIN CONTENT -->
				<div class="main-content">

					<?php echo $this->Flash->render() ?>
	                <?php echo $this->Flash->render('success') ?>
	                <?php echo $this->Flash->render('error') ?>
	                <?php echo $this->fetch('content'); ?>
					
				</div>
				<!-- END MAIN CONTENT -->
			</div>
			<!-- END MAIN -->
			<div class="clearfix"></div>

			<!-- BEGIN FOOTER -->
	        <?php echo $this->element("Admin/footer"); ?>
        	<!-- END FOOTER -->

        <?php } ?>

	</div>
	<!-- END WRAPPER -->



	<script>
	$(function() {
		$('#mobile-number').keypress(function (event) {
            var keycode = event.which;
            if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
                event.preventDefault();
            }
        });

        $('.character-text').keypress(function (event) {
            if ((event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32 || event.charCode == 20)
                return true;
            return false;
        });

        $("#image-upload").change(function() {
			readURL(this);
		});

		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#user-image').show();
					$('#user-image').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

	});
	</script>
	
</body>

</html>