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

			$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=12345678") 
			or die ('Could not connect: ' . pg_last_error());

			$query = "INSERT INTO users (name, password) VALUES ('$username','$password')";
			$result = pg_query($query);
			if (!$result) {
				$error = "Invalid username/password";
				echo $error;
			} else {
				echo "User account created";
			}
			pg_close($db);
		}
	}

?>
