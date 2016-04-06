<?php
$title = searchUser;
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
	<title> User Results </title>
	</head>
	<body>
		<?php
		include('navbar.php');
		?>
		
				<div class = "container">
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
								print "<div class=\"table-responsive\">";
									print "<table class=\"table table-striped\">";
									print "<thead>";
									print "<tr>";
									print "<th class=\"col-md-3\">Profile</th>";
									print "<th class=\"col-md-3\"></th>";
									print "<th class=\"col-md-2\"></th>";
									print "</tr>";
									print "</thead>";
									
									print "<tbody>";
									print "<tr><td class=\"col-md-3\">";
									print "<b>Name</b>";
									print "</td><td class=\"col-md-3\">";
									print "<b>Email</b>";
									print "</td><td class=\"col-md-2\">";
									if ($admin_session == 't') {
										print "<b>Money</b>";
									} else {
										print " "; // User cannot see other user's money.
									}
									print "</td></tr>";						
							
									print "<tr><td class=\"col-md-3\">";
									print $userInfo[0];
									print "</td><td class=\"col-md-3\">";
									print $userInfo[2];
									print "</td><td class=\"col-md-2\">";
									if ($admin_session == 't' && $userInfo[4] == 'f') {
										print "<form class=\"form-horizontal\" action = \"update_money.php\" id= \"update_money_form\" method=\"post\">";
										print "<input type=\"hidden\" name=\"search\" value=\"$search_user\">";	
										print "<input class=\"form-control\" style=\"width:100px;display:inline;margin-right:10px;\" type=\"number\" name=\"money\" step = \"0.01\" min=\"0.00\" value = '$userInfo[3]'>";
										print "<input class =\"btn btn-success\" name=\"submit\" type=\"submit\" value=\"Update\">";
										print "</form>";
									} else if ($admin_session == 't') {
										print $userInfo[3];
									} else {
										print " "; // User cannot see other user's money.
									}
									print "</td></tr>";
									print "</tbody>";
								print "</table></div>";
								
								#Print out user cars
								$query = "SELECT * FROM owns_car WHERE cOwner = '$search_user'";
								$result = pg_query($query);
								
								print "<div class=\"table-responsive\">";
									print "<table class=\"table table-striped\">";
									print "<thead>";
									print "<tr>";
									print "<th class=\"col-md-4\">Cars owned by $search_user</th>";
									print "<th class=\"col-md-4\"></th>";
									print "</tr>";
									print "</thead>";
								
									print "<tbody>";
									print "<tr><td class=\"col-md-4\">";
									print "<b>License Number</b>";
									print "</td><td class=\"col-md-4\">";
									print "<b>Number of free seats</b>";
									print "</td></tr>";						
							
									while ($userInfo = pg_fetch_array($result)) {
										print "<tr><td class=\"col-md-4\">";
										print $userInfo[0];
										print "</td><td class=\"col-md-4\">";
										print (string) $userInfo[1];
										print "</td></tr>";	
									}
									print "</tbody>";
								print "</table></div>";

								#Print out user requests
								$query = "SELECT * FROM creates_request WHERE requestor = '$search_user'";
								$result = pg_query($query);
								
								print "<div class=\"table-responsive\">";
									print "<table class=\"table table-striped\">";
									print "<thead>";
									print "<tr>";
									print "<th class=\"col-md-1\">Requests by $search_user</th>";
									print "<th class=\"col-md-2\"></th>";
									print "<th class=\"col-md-2\"></th>";
									print "<th class=\"col-md-1\"></th>";
									print "<th class=\"col-md-1\"></th>";
									print "<th class=\"col-md-1\"></th>";
									print "</tr>";
									print "</thead>";
									
									print "<tbody>";
									print "<tr><td class=\"col-md-1\">";
									print "<b>Request ID</b>";
									print "</td><td class=\"col-md-2\">";
									print "<b>Pick Up</b>";
									print "</td><td class=\"col-md-2\">";
									print "<b>Drop Off</b>";
									print "</td><td class=\"col-md-1\">";
									print "<b>Seats required</b>";
									print "</td><td class=\"col-md-1\">";
									print "<b>Date</b>";
									print "</td><td class=\"col-md-1\">";
									print "<b>Time</b>";
									print "</td></tr>";
								
									while ($userInfo = pg_fetch_array($result)) {
										print "<tr><td class=\"col-md-1\">";
										print (string) $userInfo[0];
										print "</td><td class=\"col-md-2\">";
										print $userInfo[1];
										print "</td><td class=\"col-md-2\">";
										print $userInfo[2];
										print "</td><td class=\"col-md-1\">";
										print (string) $userInfo[3];
										print "</td><td class=\"col-md-1\">";
										print (string) $userInfo[4];
										print "</td><td class=\"col-md-1\">";
										print $userInfo[5];
										print "</td></tr>";	
									}
									print "</tbody>";
								print "</table></div>";

								#Print out user Offers
								$query = "SELECT o.offerid, o.fromWhere, o.toWhere, o.tripCost, o.numSeatsRemaining, o.offerDate, o.offerTime, o.usedCar FROM creates_offer o, owns_car c WHERE c.cOwner = '$search_user' AND c.license = o.usedCar";
								$result = pg_query($query);
								
								print "<div class=\"table-responsive\">";
									print "<table class=\"table table-striped\">";
									print "<thead>";
									print "<tr>";
									print "<th class=\"col-md-1\">Offers by $search_user</th>";
									print "<th class=\"col-md-1\"></th>";
									print "<th class=\"col-md-1\"></th>";
									print "<th class=\"col-md-1\"></th>";
									print "<th class=\"col-md-1\"></th>";
									print "<th class=\"col-md-1\"></th>";
									print "<th class=\"col-md-1\"></th>";
									print "<th class=\"col-md-1\"></th>";
									print "</tr>";
									print "</thead>";
								
									print "<tbody>";
									print "<tr><td class=\"col-md-1\">";
									print "<b>Offer ID</b>";
									print "</td><td class=\"col-md-1\">";
									print "<b>Pick up</b>";
									print "</td><td class=\"col-md-1\">";
									print "<b>Drop Off</b>";
									print "</td><td class=\"col-md-1\">";
									print "<b>Trip Cost</b>";
									print "</td><td class=\"col-md-1\">";
									print "<b>Seats Remaining</b>";
									print "</td><td class=\"col-md-1\">";
									print "<b>Offer Date</b>";
									print "</td><td class=\"col-md-1\">";
									print "<b>Offer Time</b>";
									print "</td><td class=\"col-md-1\">";
									print "<b>Car</b>";
									print "</td></tr>";
								
									while ($userInfo = pg_fetch_array($result)) {
										print "<tr><td class=\"col-md-1\">";
										print (string) $userInfo[0];
										print "</td><td class=\"col-md-1\">";
										print $userInfo[1];
										print "</td><td class=\"col-md-1\">";
										print $userInfo[2];
										print "</td><td class=\"col-md-1\">";
										print (string) $userInfo[3];
										print "</td><td class=\"col-md-1\">";
										print (string) $userInfo[4];
										print "</td><td class=\"col-md-1\">";
										print (string) $userInfo[5];
										print "</td><td class=\"col-md-1\">";
										print $userInfo[6];
										print "</td><td class=\"col-md-1\">";
										print $userInfo[7];
										print "</td></tr>";
									}
									print "</tbody>";
								print "</table></div>";

								#Print out user bookings
								$query = "SELECT offerid FROM booking WHERE username = '$search_user'";
								$result = pg_query($query);
								
								print "<div class=\"table-responsive\">";
									print "<table class=\"table table-striped\">";
									print "<thead>";
									print "<tr>";
									print "<th class=\"col-md-8\">Bookings by $search_user</th>";
									print "</tr>";
									print "</thead>";
								
									print "<tbody>";
									print "<tr><td class=\"col-md-8\">";
									print "<b>Offer ID booked</b>";
									print "</td></tr>";
								
									while ($userInfo = pg_fetch_array($result)) {
										print "<tr><td class=\"col-md-8\">";
										print (string) $userInfo[0];
										print "</td></tr>";
									}
									print "</tbody>";
								print "</table></div>";

								#Only Admins can delete users
								if ($admin_session == 't') {
									error_log((string)$admin_session);
									print "<form action=\"http://127.0.0.1/delete_user_script.php\" method=\"post\" class=\"form-signin\">";
									print "<input type=\"hidden\" name=\"search\" value=\"$search_user\">";	
									print "<input class = \"btn btn-danger\" name=\"submit\" type=\"submit\" value=\"Delete User\">";
									print "</form>";	

									print "<form action=\"http://127.0.0.1/grant_admin_script.php\" method=\"post\" class=\"form-signin\">";
									print "<input type=\"hidden\" name=\"search\" value=\"$search_user\">";	
									print "<input class = \"btn btn-warning\" name=\"submit\" type=\"submit\" value=\"Grant Admin Privileges\">";
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
				<div class = "container" style = "padding-bottom:10px;">
					<b><a class = "btn btn-primary" href="http://127.0.0.1/main.php">Go back to Main Page</a></b>
				</div>
	</body>
</html>