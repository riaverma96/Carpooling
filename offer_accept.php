<?php
include('session.php');
?>

<html>
	<head>
		<title> Accept an Offer </title>
	</head>

	<body>
		<div>
			<p><b>Accept an Offer</b></p>
			
			<form action = "offer_accept_script.php" method = "post">
			<p><table border = "1"> 
				<th colspan ="9"><b>Currently Available Offers</b></th>
				<tr><td>OfferID</td><td>From</td><td>To</td><td>Price</td><td>Seats Left</td><td>Date</td><td>Time</td><td>License Num</td><td>Accept</td></tr>

				<?php
					$username = $_SESSION['login_user'];
					$date = date("Y-m-d");
					$query = "SELECT * FROM creates_offer o WHERE o.numseatsremaining > 0 AND o.offerdate >= '$date' AND o.usedcar NOT IN (SELECT c.license FROM owns_car c WHERE c.cowner = '$username')
                    AND NOT EXISTS (SELECT * FROM booking b WHERE b.username = '$username' AND b.offerid = o.offerid)"; # Not exists handles case where user already booked the same ride previously.
					$result = pg_query($query);
							
					while ($row = pg_fetch_array($result)) {
						print "<tr><td>";
						print (string) $row[0];
						print "</td><td>";
						print $row[1];
						print "</td><td>";
						print $row[2];
						print "</td><td>";
						print (string) $row[3];
						print "</td><td>";
						print (string) $row[4];
						print "</td><td>";
						print (string) $row[5];
						print "</td><td>";
						print (string) $row[6];
						print "</td><td>";
						print $row[7];
						print "</td><td>";
						print "<input type = \"radio\" name = \"offerNum\" value = \"$row[0]\">";
						print "</td></tr>";
					}
				?>
			
			</table></p>
			<input name="submit" type="submit">
			</form>
		</div>
		
		<a href="http://127.0.0.1/main.php">Back</a>

	</body>
</html>