<?php 
include ('session.php');
?>

<?php
	$error = '';
	if (isset($_POST['submit'])) {
		if (empty($_POST['newLicense']) || empty($_POST['seatsAvailable'])) {
			$error = "Car entered is invalid";
		}
		else {
			$newLicense = $_POST['newLicense'];
			$seatsAvailable = $_POST['seatsAvailable'];
			$userName = $login_session;

			$db = include 'postgresconnect.php';

			$query = "INSERT INTO owns_car (license, numFreeSeats, cOwner) VALUES ('$newLicense', $seatsAvailable, '$userName')";
			$result = pg_query($query);
			if (!$result) {
				error_log("Error adding new car");
				header("Location: http://127.0.0.1/set_profile.php");
			} else {
				$error = "New car added succesfully";
				header("Location: http://127.0.0.1/set_profile.php");
			}
			pg_close($db);
		}
	}

?>