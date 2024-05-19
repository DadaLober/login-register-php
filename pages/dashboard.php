<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<style type="text/css">
		body{
			font-family: 'Courier New', Courier, monospace;
			background-color: #000;
		}
		h1, p{
			color: #fff;
		}
		.container{
			width: 60%;
			margin: 0 auto;
			padding: 20px;
			background-color: #333;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0,0,0,0.5);
			text-align: center;
		}
		a{
			color: #fff;
			text-decoration: none;
		}
		a:hover{
			color: #0f0;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Welcome to the secret world!</h1>
	    <!-- logged in user information -->
	    <?php  if (isset($_SESSION['username'])) : ?>
	    	<p>Hi <strong><?php echo $_SESSION['username']; ?></strong></p>
	    	<p> <a href="dashboard.php?logout='1'" style="color: red;">logout</a> </p>
	    <?php endif ?>
	</div>
</body>
</html>
