<html>
	<head></head>
	<body>
	  <?php echo validation_errors(); ?>
	  <?=form_open($form)?>
	    <?=form_input($input_username)?>
	    <?=form_password($input_passwd)?>
	    <?=form_submit($input_submit)?>	
	  <?=form_close()?>
	</body>
</html>