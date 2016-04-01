<?php
include('authenticate.php'); // Includes authenticate Script

if(isset($_SESSION['login_user'])){
error_log("Already have login_user go to main.php");
header("Location: http://127.0.0.1/main.php");
}
?>

<html>
	<head>
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		
		<title> Login </title>
	</head>

	<body>
	<div class="container" style="padding-top:30px;">
		<div class="jumbotron row">
			<div class="col-md-offset-2 col-md-6">
				<h1 style="text-align: center;font-size:45px;"><em> Carpooling Login Page</em></h1>
			</div>
		</div>
		<div class="row">
			<div class = "col-md-offset-3 col-md-5">
				<!-- Login form -->
				<form action="" method="post" class="form-signin">
				<label>Name:</label>
				<input class="form-control" type="text" name="username" placeholder="Fill your name here" type="text">
				<label>Password:</label>
				<input class="form-control" type="password" name="password" placeholder="************" type="password">
				<input class="btn btn-lg btn-primary" style="margin-top:10px;margin-left:100px;" name="submit" type="submit" value="Login">
				
				<input class="btn btn-lg btn-success" style="margin-top:10px;margin-left:15px;width:120px;" value="Register" 
					onclick="window.location='http://localhost/register.php';"> 
				
				</form>	
			</div>
		</div>
	</div>
	</body>
</html>