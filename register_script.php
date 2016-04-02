<?php
	$error = '';
	if (isset($_POST['submit'])) {

		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Username or password is invalid";
		}
		else {
			$username_without_sanitization = $_POST['username'];
			$password_without_sanitization = $_POST['password'];
			$username = filter_var($username_without_sanitization, FILTER_SANITIZE_STRING);
			$password = filter_var($password_without_sanitization, FILTER_SANITIZE_STRING);

			error_log($username);
			error_log($password);

			$db = include 'postgresconnect.php';

			$query = "";

			if (strpos($username, ';') === false && strpos($password, ';') === false) {
				$query = "INSERT INTO users (name, password, money, admin) VALUES ('$username','$password', '0', false)";
			}

			$result = pg_query($query);
			if (!$result) {
				echo "User account not created";
			} else {
				echo "User account created";
			}
			pg_close($db);
		}
	}

?>
