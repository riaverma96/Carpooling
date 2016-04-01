<?php
// This part is used if running without needing to login.
// To change to include session.php if login is required.
$db = include 'postgresconnect.php';
?>

<?php
	$todayDate = date('Y-m-d');
	// Delete from booking table first.
	$query = "DELETE FROM booking b WHERE b.offerid IN (
		SELECT o.offerid FROM creates_offer o WHERE o.offerdate < '$todayDate')";
	$result = pg_query($query);		
	handleError($result);
	
	// Then delete from creates_offer table due to foreign key
	$query = "DELETE FROM creates_offer o WHERE o.offerdate < '$todayDate'";
	$result = pg_query($query);		
	handleError($result);
			
	function handleError($result) {
        if (!$result) {
            $errormessage = pg_last_error(); 
            echo "Error with query: " . $errormessage; 
            exit();
        }
        return;
    }
?>

<html>
	<head>
		<title> Removed Outdated offers/bookings </title>
	</head>
	
	<body>
		<div> 
			<p>
				There are no more outdated entries left in offers and booking.
			</p>
			<p>
				<a href="http://127.0.0.1/main.php">Back to Home</a>
			</p>
		</div>
	</body>
</html>