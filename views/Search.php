<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url('css/style.css');?>">
	<style>
	</style>
	<title>Search Messages</title>
</head>
<body>
<div id="content">
	<div class="header">
		#Forum
	</div>	
		<?php if($this->session->has_userdata('loggedIn')) : ?>
						<div class="loginStatus">	
							Logged in as: <?php echo " ".$this->session->userdata('login_id');?>
						</div>
						<!--buttons areset up dynamically depending on the user login status-->
						<div class="buttonBar">
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
			<?php else: ?>
					<div class="loginStatus">
						Not Logged in.
					</div>
					<div class="buttonBar">
						<button>
							<a href="<?php echo base_url('index.php/user/login/');?>">Log In</a>
						</button>
					</div>
			<?php endif; ?>	
	<!--search form  where the user is able to enter search string and find watend posts, data send via GET to the search controller-->
	<form id="searchForm" method="GET" accept-charset="utf-8"  action="<?php echo base_url('index.php/search/dosearch');?>">
		<label class="postLabel"for="Search">Enter the phrase to find messages:</label>
		<br><br />
		<input id="postInput" type="text" name="searchString" placeholder="Phrase here..."/>
		<br><br />
		<button class="postBtn" type="submit">Search</button>
	</form>
	<div>
		<!--The error is printed if there are no posts with entered message-->
		<?php if(isset($errorMsg)) {echo $errorMsg;}?>
	</div>	
</div>
</body>
</html>