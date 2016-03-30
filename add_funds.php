<?php 
include ('session.php');
?>

<?php
	$error = '';
	if (isset($_POST['submit'])) {
		if (empty($_POST['funds'])) {
			$error = "Funds entered is invalid";
		}
		else {
			$funds = $_POST['funds'];
			$userName = $login_session;

			$db = include 'postgresconnect.php';

			$query = "UPDATE users SET money = money + $funds WHERE name = '$userName'";
			$result = pg_query($query);
			if (!$result) {
				error_log("Error adding funds");
				header("Location: http://127.0.0.1/set_profile.php");
			} else {
				$error = "Funds added succesfully";
				header("Location: http://127.0.0.1/set_profile.php");
			}
			pg_close($db);
		}
	}

?>