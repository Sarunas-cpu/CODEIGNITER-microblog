<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url('css/style.css');?>"> 
	<title>Post page</title>
</head>
<body>
<div id="content">
	<div class="header">
		#Forum
	</div>
	<div class="loginStatus">
		<?php if($this->session->has_userdata('loggedIn')) {
					echo "Logged in as: ".$this->session->userdata('login_id');
		}?>
	</div>
	<div class="buttonBar">
		<!--buttons bar is set up-->
		<button>
			<a href="<?php echo base_url('index.php/user/view/').$this->session->userdata('login_id');?>">My Messages</a>
		</button>
		<button>
			<a href="<?php echo base_url('index.php/message/');?>">Post Message</a>
		</button>
		<button>
			<a href="<?php echo base_url('index.php/search/');?>">Search Messages</a>
		</button>
		<button>
			<a href="<?php echo base_url('index.php/user/feed/').$this->session->userdata('login_id');?>">Followed Posts</a>
		</button>
		<button>
			<a href="<?php echo base_url('index.php/user/logout/');?>">Log Out</a>
		</button>
	</div>
	<!--post form where the user is able to enter wanted post and it is submitted via POST to the message controller -->
	<form id="postForm" method="POST" accept-charset="utf-8"  action="<?php echo base_url('index.php/message/doPost')?>">
		<label class="postLabel" for="postInput"> Enter your Message here: </label>
		<br><br />
		<textarea class="postArea" type="text" name="postMsg" rows="3" cols="100" placeholder="Message here..." ></textarea>
		<br><br />
		<button class="postBtn" type="submit">Post</button>	
	</form>
</div>
</body>
</html>