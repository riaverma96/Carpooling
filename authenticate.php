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

			$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=cs2102") 
			or die ('Could not connect: ' . pg_last_error());

			$query = "SELECT name, password FROM users WHERE name = '$username' AND password = '$password'";
			$result = pg_query($query);
			$row = pg_num_rows($result);
			if ($row == 1) {
				$_SESSION['login_user'] = $username;
				header("Location: http://127.0.0.1/main.php");
			} else {
				$error = "Username or password is invalid";
				header("Location: http://127.0.0.1/login.php/");
			}
			pg_close($db);
		}
	}








/*
	function authenticate($name, $password) {
		$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=cs2102");
		$query = "SELECT name, password FROM users WHERE name = $name AND password = $password";
		$result = pg_query($db, $query);
		if (pg_num_rows($result) == 1) {
			session_start();
			$_SESSION['user'] = $tempName;
			return true;
		} else {
			return false;
		}
	}

	$name = $_POST["name"];
	$password = $_POST["password"];
	if (authenticate($name, $password)) {
		header("Location: carpoolHtmlTest.php");
	} else {
		header("Location: login.php");
	}
	*/
?>
