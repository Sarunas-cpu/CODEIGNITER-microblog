<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/style.css"> 
	<style>		
	input, button {
		width: 100%;
	}

	#content {
		height: 50vh;
		padding: 10vh 0;
	}
	
	</style>
	<title>Login</title>
</head>
<body>
<div id="content">
	<div class="header">
	#Forum
	</div>
	<div id="loginbox">
		<!--user name and password input fields, form is submitted to the controller via POST -->
		<form id="loginForm" method="POST" accept-charset="utf-8"  action="<?php echo base_url('index.php/user/doLogin')?>">
			<label for="username"> Username: </label>
			<br><br />
			<input  type="text" name="username" placeholder="Username...." />
			<br><br />
			<label for="pass"> Password: </label>
			<br><br />
			<input  type="password" name="pass" placeholder="Password...." />
			<br><br />
			<button type="submit" form="loginForm">Login</button>
		</form>
		<br><br />
		
		<div>
		<!--the error message if the user enters wrong details -->
		<?php if(isset($errorMsg)) {echo $errorMsg;}?>
	    </div>	
	</div>
</div>
</body>
</html>