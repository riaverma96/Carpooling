<?php 
include ('session.php');
?>

<?php
	if (isset($_POST['search'])) {
		if (empty($_POST['search'])) {
			error_log("Cannot delete searched user");
		}
		else {
			$search_user = $_POST['search'];
			$db = include 'postgresconnect.php';
			$query = "SELECT admin FROM users WHERE name = '$search_user'";
			$result = pg_query($query);
			$row = pg_fetch_array($result);
			if (!$row[0]) {

				$query = "DELETE FROM booking WHERE offerid IN (SELECT o.offerid FROM creates_offer o, owns_car c WHERE c.cOwner = '$search_user' AND o.usedCar = c.license)";
				$result = pg_query($query);

				$query = "DELETE FROM creates_offer WHERE usedCar IN (SELECT license FROM owns_car WHERE cOwner = '$search_user')";
				$result = pg_query($query);

				$query = "DELETE FROM owns_car WHERE cOwner = '$search_user'";
				$result = pg_query($query);

				$query = "DELETE FROM creates_request WHERE requestor = '$search_user'";
				$result = pg_query($query);

				$query = "DELETE FROM users WHERE name = '$search_user'";
				$result = pg_query($query);
			}
			else {
				error_log("Cannot delete other admins!");
				header("Location: http://127.0.0.1/search_users.php");
			}
			if (!$result) {
				error_log("Some information cannot be deleted");
				header("Location: http://127.0.0.1/search_users.php");
			} else {
				error_log("All information regarding $search_user have been deleted");
				header("Location: http://127.0.0.1/search_users.php");
			}
			pg_close($db);
		}
	}

?>