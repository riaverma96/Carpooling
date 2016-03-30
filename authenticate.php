<?php
	session_start();
	$error = '';
	if (isset($_POST['submit'])) {
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Username or password is invalid";
		}
		else {
			$username = $_POST['username'];
			$password = $_POST['password'];

			$db = include 'postgresconnect.php';

			$query = "SELECT name, password FROM users WHERE name = '$username' AND password = '$password'";
			$result = pg_query($query);
			$row = pg_num_rows($result);
			if ($row == 1) {
				error_log("login_user has a value now");
				$_SESSION['login_user'] = $username;
				header("Location: http://127.0.0.1/main.php");
			} else {
				$error = "Username or password is invalid";
				header("Location: http://127.0.0.1/login.php");
			}
			pg_close($db);
		}
	}

?>
