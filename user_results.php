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
	<title> Set Profile </title>
	<body>
		<?php
		$query = "SELECT COUNT(*)
		FROM booking b
		WHERE b.username = '$login_session'
		AND b.isUserNotified = 'false'";
		$numNotifications = pg_query($query); 
		?>
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
							<li><a href="http://127.0.0.1/offer_accept.php">Book a Ride</a></li>
							<li><a href="http://127.0.0.1/req_create.php">Request Ride</a></li>
							<li><a href="http://127.0.0.1/search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
							<li class="active"><a href="http://127.0.0.1/search_users.php"><span class="glyphicon glyphicon-search"></span> Search Users</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown" style="cursor:pointer;">
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
					<?php
					if (isset($_POST['submit'])) {
						if (empty($_POST['user'])) {
							error_log("Searched user cannot be empty");
						}
						else {
							$search_user = $_POST['user'];
							$userName = $_SESSION['login_user'];

							$db = include 'postgresconnect.php';

							$query = "SELECT * FROM users WHERE name = '$search_user'";
							$result = pg_query($query);
							$row = pg_num_rows($result);
							if ($row == 1) {
								error_log("Searched user exists");
								$userInfo = pg_fetch_array($result);
								#Print out user profile
								print "<table border=\"1\">";
								print "<th>Profile</th>";
								print "<tr><td>Name</td><td>Email</td></tr>";
								print "<tr><td>";
								print $userInfo[0];
								print "</td><td>";
								print $userInfo[2];
								print "</td></tr>";
								print "</table>";

								#Print out user cars
								$query = "SELECT * FROM owns_car WHERE cOwner = '$search_user'";
								$result = pg_query($query);
								print "<table border=\"1\">";
								print "<th>Cars owned by $search_user</th>";
								print "<tr><td>License Number</td><td>Number of free seats</td></tr>";
								while ($userInfo = pg_fetch_array($result)) {
									print "<tr><td>";
									print $userInfo[0];
									print "</td><td>";
									print (string) $userInfo[1];
									print "</td></tr>";	
								}
								print "</table>";

								#Print out user requests
								$query = "SELECT * FROM creates_request WHERE requestor = '$search_user'";
								$result = pg_query($query);
								print "<table border=\"1\">";
								print "<th>Requests by $search_user</th>";
								print "<tr><td>Request ID</td><td>Pick up</td><td>Drop off</td><td>Number of seats needed</td><td>Date</td><td>Time</td></tr>";
								while ($userInfo = pg_fetch_array($result)) {
									print "<tr><td>";
									print (string) $userInfo[0];
									print "</td><td>";
									print $userInfo[1];
									print "</td><td>";
									print $userInfo[2];
									print "</td><td>";
									print (string) $userInfo[3];
									print "</td><td>";
									print (string) $userInfo[4];
									print "</td><td>";
									print $userInfo[5];
									print "</td></tr>";	
								}
								print "</table>";

								#Print out user Offers
								$query = "SELECT o.offerid, o.fromWhere, o.toWhere, o.tripCost, o.numSeatsRemaining, o.offerDate, o.offerTime, o.usedCar FROM creates_offer o, owns_car c WHERE c.cOwner = '$search_user' AND c.license = o.usedCar";
								$result = pg_query($query);
								print "<table border=\"1\">";
								print "<th>Offers by $search_user</th>";
								print "<tr><td>Offer ID</td><td>Pick up</td><td>Drop off</td><td>Trip Cost</td><td>Seats Remaining</td><td>Offer Date</td><td>Offer Time</td><td>Car</td></tr>";
								while ($userInfo = pg_fetch_array($result)) {
									print "<tr><td>";
									print (string) $userInfo[0];
									print "</td><td>";
									print $userInfo[1];
									print "</td><td>";
									print $userInfo[2];
									print "</td><td>";
									print (string) $userInfo[3];
									print "</td><td>";
									print (string) $userInfo[4];
									print "</td><td>";
									print (string) $userInfo[5];
									print "</td><td>";
									print $userInfo[6];
									print "</td><td>";
									print $userInfo[7];
									print "</td></tr>";
								}
								print "</table>";

								#Print out user bookings
								$query = "SELECT offerid FROM booking WHERE username = '$search_user'";
								$result = pg_query($query);
								print "<table border=\"1\">";
								print "<th>Bookings by User</th>";
								print "<tr><td>Offer ID booked</td></tr>";
								while ($userInfo = pg_fetch_array($result)) {
									print "<tr><td>";
									print (string) $userInfo[0];
									print "</td></tr>";
								}
								print "</table>";

								#Only Admins can delete users
								if ($admin_session == 't') {
									error_log((string)$admin_session);
									print "<form action=\"http://127.0.0.1/delete_user_script.php\" method=\"post\" class=\"form-signin\">";
									print "<input type=\"hidden\" name=\"search\" value=\"$search_user\">";	
									print "<input name=\"submit\" type=\"submit\" value=\"Delete User\">";
									print "</form>";	

									print "<form action=\"http://127.0.0.1/grant_admin_script.php\" method=\"post\" class=\"form-signin\">";
									print "<input type=\"hidden\" name=\"search\" value=\"$search_user\">";	
									print "<input name=\"submit\" type=\"submit\" value=\"Grant Admin Privileges\">";
									print "</form>";	 
								}

							} else {
								$error = "Searched user does not exist";
								header("Location: http://127.0.0.1/search_users.php");
							}
							pg_close($db);
						}
					}


					?>
				</div>
				<div>
					<b><a href="http://127.0.0.1/main.php">Go back to Main Page</a></b>
				</div>
			</body>
			</html>