<?php
	$error = '';
	if (isset($_POST['submit'])) {
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Username or password is invalid";
		}
		else {
			$username = $_POST['username'];
			$password = $_POST['password'];

			$db = include 'postgresconnect.php';

			$query = "INSERT INTO users (name, password, money) VALUES ('$username','$password', '0')";
			$result = pg_query($query);
			if (!$result) {
				$error = pg_last_error();
				echo $error;
			} else {
				echo "User account created";
			}
			pg_close($db);
		}
	}

?>
