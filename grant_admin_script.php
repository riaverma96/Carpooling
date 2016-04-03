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

			$query = "UPDATE users SET admin = true WHERE name = '$search_user'";
			$result = pg_query($query);

			if (!$result) {
				error_log("Error occured in promotion query");
				header("Location: http://127.0.0.1/search_users.php");
			} else {
				error_log("$search_user has been promoted to an admin!");
				header("Location: http://127.0.0.1/search_users.php");
			}
			pg_close($db);
		}
	}

?>