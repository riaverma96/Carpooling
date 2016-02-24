<?php
include('authenticate.php'); // Includes authenticate Script

if(isset($_SESSION['login_user'])){
header("Location: http://127.0.0.1/main.php");
}
?>

<html>
	<head>
		<title> Login </title>
	</head>

	<body>

	<form action="" method="post">
	<label>Name:</label>
	<input type="text" name="username" placeholder="Fill your name here" type="text">
	<label>Password:</label>
	<input type="password" name="password" placeholder="************" type="password">
	<input name="submit" type="submit" value="Login">
	</form>

	</body>
</html>