<?php
include('authenticate.php'); // Includes authenticate Script

if(isset($_SESSION['login_user'])){
error_log("Already have login_user go to main.php");
header("Location: http://127.0.0.1/main.php");
}
?>

<html>
	<head>
		<title> Login </title>
	</head>

	<body>
		<div>
			<!-- Login form -->
			<form action="" method="post">
			<label>Name:</label>
			<input type="text" name="username" placeholder="Fill your name here" type="text">
			<label>Password:</label>
			<input type="password" name="password" placeholder="************" type="password">
			<input name="submit" type="submit" value="Login">
			</form>
		</div>
		<div>
			<b><a href="http://127.0.0.1/register.php">Register a new User account</a></b>
		</div>
	</body>
</html>