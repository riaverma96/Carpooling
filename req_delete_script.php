<?php 
include ('session.php');
?>

<?php
	if (isset($_POST['submit'])) {
		$requestid = $_POST['RequestNum'];
		
		$db = include 'postgresconnect.php';
		
		#Delete request
		$query = "DELETE FROM creates_request WHERE rid = '$requestid'";
		$delete_result = pg_query($query);

		error_log("Request deleted");
		header("Location: http://127.0.0.1/view_all_offers_requests.php");
	} else {
		error_log("Something went wrong with the submission of offer deletion.");
		header("Location: http://127.0.0.1/view_all_offers_requests.php");
	}
?>