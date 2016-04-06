<?php
$title = accept;
include('session.php');
?>

<html>
	<head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        
		<title> Accept an Offer </title>
	</head>

	<body>
        <?php
include('navbar.php'); 
?>

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
						print str_pad((string) $row[6], 4, STR_PAD_LEFT);
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