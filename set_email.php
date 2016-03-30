<?php 
include ('session.php');
?>

<?php
	$error = '';
	if (isset($_POST['submit'])) {
		if (empty($_POST['newEmail'])) {
			$error = "Email entered is invalid";
		}
		else {
			$newEmail = $_POST['newEmail'];
			$userName = $_SESSION['login_user'];

			$db = include 'postgresconnect.php';

			$query = "UPDATE users SET email = '$newEmail' WHERE name='$userName'";
			$result = pg_query($query);
			if (!$result) {
				error_log("Email changing went wrong");
				header("Location: http://127.0.0.1/set_profile.php");
			} else {
				error_log("Succesful email update");
				header("Location: http://127.0.0.1/set_profile.php");
			}
			pg_close($db);
		}
	}

?>