<?php
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
        <div class="container">
    <ul class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://127.0.0.1/main.php">CarPooling</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
				<li><a href="http://127.0.0.1/main.php">Home</a></li>
				<li><a href="http://127.0.0.1/offer_create.php">Offer Ride</a></li>
                <li class="active"><a href="http://127.0.0.1/offer_accept.php">Book a Ride</a></li>
				<li><a href="http://127.0.0.1/req_create.php">Request Ride</a></li>
				<li><a href="http://127.0.0.1/search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<span class="glyphicon glyphicon-user"></span> 
						<?php echo $login_session; ?> 
						<span class="badge">
						<?php if (is_null($numNotifications[0])) {
								print '0';
							} else {
								print $numNotifications[0];
							} ?> </span>
					<ul class="dropdown-menu">
						<li><a href="http://127.0.0.1/set_profile.php">Set Profile</a></li>
						<li><a href="http://127.0.0.1/notifications.php">Notifications</a></li>
					</ul>
				</li>
				<li>
					<a href="http://127.0.0.1/logout.php">
					<span class="glyphicon glyphicon-log-out"></span> Logout
					</a>
				</li>
            </ul>
        </div>
    </div>
	</ul>
</div>
<!-- Offset Navbar -->
<div style = "margin-top:70px;"></div>

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