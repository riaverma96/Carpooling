<?php 
include ('session.php');
?>

<?php
	$error = '';
	if (isset($_POST['submit'])) {
		$offerid = $_POST['offerNum'];
		$username = $login_session;
		$notified = 'false';
		
		$db = include 'postgresconnect.php';
		
		$query = "SELECT numseatsremaining from creates_offer WHERE offerid = '$offerid'";
		$result = pg_query($query);
		$row = pg_fetch_array($result);
		$seatsLeft = $row[0] - 1;
        
        $query = "INSERT INTO booking (isusernotified, username, offerid) VALUES ('$notified', '$username', '$offerid')";
		$result = pg_query($query);
		
		if (!$result) {
			$error = pg_last_error();
			echo $error;
            return;
		}
	
		$query = "UPDATE creates_offer SET numseatsremaining = '$seatsLeft' WHERE offerid ='$offerid'";
		$result = pg_query($query);
		
		if (!$result) {
			$error = pg_last_error();
			echo $error;
            return;
		}
		
		echo "Booking created successfully!";
	}

?>

<html>
	<head>
		<title> Booking Result </title>
	</head>

	<body>
		<div>
			<p>
			<a href="http://127.0.0.1/offer_accept.php">Make another Booking</a>
			</p> <p>
			<a href="http://127.0.0.1/main.php">Back to Home</a>
			</p>
		</div>

	</body>
</html>