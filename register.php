

<html>
	<head>
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		
		<title> Register </title>
	</head>

	<body>
	<div class="container" style="padding-top:30px;">
		<div class="jumbotron row">
			<div class="col-md-offset-2 col-md-6">
				<h1 style="text-align: center;font-size:45px;"><em> Registration</em></h1>
			</div>
		</div>
		<div class="row">
			<div class = "col-md-offset-3 col-md-5">
				<!-- Register form -->
				<form action="" method="post" class="form-signin">
				<label>Desired Name:</label>
				<input class="form-control" type="text" name="username" placeholder="Fill your desired username here" type="text">
				<label>Desired Password:</label>
				<input class="form-control" type="password" name="password" placeholder="************" type="password">
				<input class="btn btn-lg btn-primary" style="margin-top:10px;margin-left:100px;" name="submit" type="submit" value="Register">
				
				<input class="btn btn-lg btn-danger" style="margin-top:10px;margin-left:15px;width:120px;" value="Back" 
					onclick="window.location='http://127.0.0.1/main.php';"> 
				
				</form>	
			</div>
		</div>
		<div class = "row">
			<div class = "col-md-offset-3 col-md-5">
				<font color="
				<?php
				include('register_script.php'); // Includes register Script. DO NOT SHIFT THIS PHP CODE 
												// OR ALL HELL WILL BREAK LOOSE!!!

				if(isset($_SESSION['login_user'])){
				error_log("Already have login_user go to main.php");
				header("Location: http://127.0.0.1/main.php");
				}
				?>
				</font>
			</div>
		</div>
	</div>
	</body>
</html>
