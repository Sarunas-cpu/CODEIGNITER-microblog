<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>#Forum</title>
	<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url('css/style.css');?>">
</head>
<body>
<div id="content">
	<div class="header">
		#Forum
	</div>
	<!--the buttons are set up depending on the user if its logged in or not -->
	<?php if($this->session->has_userdata('loggedIn')) : ?>
					<div class="loginStatus">	
						Logged in as: <?php echo " ".$this->session->userdata('login_id');?>
					</div>
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
					<div>
						<!--this button is sett up only if the user is not following that user view -->
						<?php if(isset($notFollowedName)) : ?>
							<button id="followButton" >
								<a href="<?php echo base_url('index.php/user/follow/').$notFollowedName[0];?>">Follow</a>
							</button>
						<?php endif; ?>
					</div>
		<?php else: ?>
				<div class="loginStatus">
					Not Logged in.
				</div>
				<div class="buttonBar">
					<button>
						<a href="<?php echo base_url('index.php/search/');?>">Search Messages</a>
					</button>
					<button>
						<a href="<?php echo base_url('index.php/user/login/');?>">Log In</a>
					</button>
					
				</div>
		<?php endif; ?>	
		<!--all the posts are printed from the current session user -->
		<?php foreach ($posts as $row) {?>
		
			<div class="postBox">
				<div class="postHead"><?php echo $row['user_username']; ?></div>
				<div class="postDate"><?php echo $row['posted_at']; ?></div>			
				<div class="postText"><?php echo $row['text']; ?></div>
			</div>

		<?php } ?>
</div>
</body>
</html>

