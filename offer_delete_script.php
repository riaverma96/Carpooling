<?php 
include ('session.php');
?>

<?php
	$error = '';
	if (isset($_POST['submit'])) {
		$offerid = $_POST['offerNum'];
		
		$db = include 'postgresconnect.php';
		
		# Get cost of trip
		$query = "SELECT * FROM creates_offer c WHERE c.offerid = '$offerid'";
		$offer_result = pg_query($query);
		$offer_row = pg_fetch_array($offer_result);
		$tripCost = $offer_row[3];	
		
		#Get offerer
		$query = "SELECT u.money, u.name FROM users u, owns_car c WHERE c.license = '$offer_row[7]' AND u.name = c.cOwner";
		$result = pg_query($query);
		$offerer_row = pg_fetch_array($result);

		# Check if offerer can afford to refund
		$query = "SELECT * FROM booking b WHERE b.offerid = '$offerid'";
		$result = pg_query($query);
		$num_rows = pg_num_rows($result);
		
		error_log((string)$num_rows);
		error_log((string)$offerer_row[0]);
		error_log($offerer_row[1]);
		error_log((string)$tripCost);
		if ($offerer_row[0] >= $tripCost * $num_rows) {
			# Start the refund process if offerer can refund
			while ($row = pg_fetch_array($result)) {
				# Refund Individual bookers
				$query = "UPDATE users SET money = money + '$tripCost' WHERE name = '$row[1]'";
				$refund_result = pg_query($query);
			}

			# Deduct the refunds from the offerer
			$remainingMoney = $offerer_row[0] - $tripCost * $num_rows;
			error_log($remainingMoney);
			$query = "UPDATE users SET money = '$remainingMoney' WHERE name = '$offerer_row[1]'";
			$refund_result = pg_query($query);

			# Delete bookings
			$query = "DELETE FROM booking WHERE offerid = '$offerid'";
			$delete_result = pg_query($query);
			
			# Delete offer
			$query = "DELETE FROM creates_offer WHERE offerid = '$offerid'";
			$delete_result = pg_query($query);

			error_log("Offer and its bookings have all been deleted.");
			header("Location: http://127.0.0.1/view_all_offers_requests.php");
		} else {
			error_log("Offerer cannot afford a refund!");
			header("Location: http://127.0.0.1/view_all_offers_requests.php");
		}
	} else {
		error_log("Something went wrong with the submission of offer deletion.");
		header("Location: http://127.0.0.1/view_all_offers_requests.php");
	}
?>