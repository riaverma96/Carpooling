<?php 
include ('session.php');
?>

<?php
	$error = '';
	if (isset($_POST['submit'])) {
		$bookingid = $_POST['BookingIndex'];
		$bookingUser = $_POST['BookingUser' . $bookingid];
		$offerid = $_POST['OfferID' . $bookingid];

		error_log((string)$bookingid);
		error_log($bookingUser);
		error_log((string)$offerid);

		$db = include 'postgresconnect.php';
		
		# Get Offer 
		$query = "SELECT * FROM creates_offer WHERE offerid = '$offerid'";
		$offer_result = pg_query($query);
		$offer_row = pg_fetch_array($offer_result);

		# Get Offerer
		$query = "SELECT * FROM users u, owns_car c WHERE c.license = '$offer_row[7]' AND u.name = c.cOwner";
		$offerer_result = pg_query($query);
		$offerer_row = pg_fetch_array($offerer_result);

		# Check whether offerer has enough money to refund
		if (offerer_row[3] < $offer_row[3]) {
			error_log("Offerer does not have enough money to refund.");
			header("Location: http://127.0.0.1/view_all_offers_requests.php");
		}

		# Update funds for both offerer and booker
		$tripCost = $offer_row[3];
		$query = "UPDATE users SET money = money + '$tripCost' WHERE name = '$bookingUser'";
		$refund_result = pg_query($query);
		$query = "UPDATE users SET money = money - '$tripCost' WHERE name = '$offerer_row[0]'";
		$refund_result = pg_query($query);

		# Update number of seats in available in offer
		$query = "UPDATE creates_offer SET numSeatsRemaining = numSeatsRemaining + 1 WHERE offerid = '$offerid'";
		$update_result = pg_query($query);

		# Delete Booking
		$query = "DELETE FROM booking WHERE username = '$bookingUser' AND offerid = '$offerid'";
		$delete_result = pg_query($query);

		error_log("Booking has been deleted!");
		header("Location: http://127.0.0.1/view_all_offers_requests.php");
	} else {
		error_log("Something went wrong with the submission of offer deletion.");
		header("Location: http://127.0.0.1/view_all_offers_requests.php");
	}
?>