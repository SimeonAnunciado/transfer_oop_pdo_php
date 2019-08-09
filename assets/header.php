<?php 

require_once 'inc/connection.php';
require_once 'helper/helper.php';

$process = new Process();








?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

</head>
<body>

	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
				</button>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					
					<?php 	if (isLoggedIn()) : ?>
						<li class="active"><a href="index.php">Home</a></li>
						<li ><a href="request.php">Request <?php echo isLoggedIn()  ? $process->count_request() > 0 ? '<span class="badge">'.$process->count_request().'</span> ' : ''  : ''  ?></a></li>
						<li ><a href="history.php">Transfer History </a></li>
					<?php 	else:  ?>
						<li class="active"><a href="index.php">Home</a></li>
					<?php 	endif ?>

				
			
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo isLoggedIn() ? $_SESSION['user_name'] : 'Sign Up'  ?> </a></li>
					<li><a href="<?php  echo isLoggedIn() ? 'logout.php' : 'login.php' ?>">
						<span class="<?php  echo isLoggedIn() ? 'glyphicon glyphicon-off ' : 'glyphicon glyphicon-log-in ' ?>"></span>
						<?php  echo isLoggedIn() ? 'Logout' : 'Login' ?></a></li>
				</ul>
			</div>
		</div>
	</nav>