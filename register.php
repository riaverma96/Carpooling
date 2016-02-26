<?php
include('register_script.php'); // Includes register Script

if(isset($_SESSION['login_user'])){
error_log("Already have login_user go to main.php");
header("Location: http://127.0.0.1/main.php");
}
?>

<html>
	<head>
		<title> Register </title>
	</head>

	<body>
		<div>
			<!-- Login form -->
			<form action="" method="post">
			<label>Desired Name:</label>
			<input type="text" name="username" placeholder="Fill your desired username here" type="text">
			<label>Desired Password:</label>
			<input type="password" name="password" placeholder="************" type="password">
			<input name="submit" type="submit" value="Register">
			</form>
			<a href="http://127.0.0.1/main.php">Back</a>
		</div>

	</body>
</html>