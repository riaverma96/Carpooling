<?php 
include ('session.php');
?>

<?php
	$error = '';
	if (isset($_POST['submit'])) {
		if (empty($_POST['newPassword']) || empty($_POST['oldPassword'])) {
			$error = "New or old password is invalid";
		}
		else {
			$newPassword = $_POST['newPassword'];
			$oldPassword = $_POST['oldPassword'];
			$userName = $_SESSION['login_user'];

			$db = include 'postgresconnect.php';

			$query = "UPDATE users SET password = '$newPassword' WHERE name='$userName' AND password = '$oldPassword'";
			$result = pg_query($query);
			if (!$result) {
				error_log("Password changing went wrong");
				header("Location: http://127.0.0.1/set_profile.php");
			} else {
				$error = "Succesful change in password";
				header("Location: http://127.0.0.1/set_profile.php");
			}
			pg_close($db);
		}
	}

?>