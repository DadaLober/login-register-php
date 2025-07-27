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
	<link rel="stylesheet" href="../css/style.css" />
</head>
<body class="dashboard-body">
	<div class="dashboard-container">
		<h1 class="dashboard-title">Welcome to the secret world!</h1>
	    <!-- logged in user information -->
	    <?php if (isset($_SESSION['username'])) : ?>
	    	<p class="dashboard-text">Hi <strong><?php echo $_SESSION['username']; ?></strong></p>
	    	<p class="dashboard-text">
	    		<a href="dashboard.php?logout='1'" class="dashboard-link logout-link">logout</a>
	    	</p>
	    <?php endif ?>
	</div>
</body>
</html>