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
			WHERE b.username = '$username'
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
				<li class="active"><a href="#">Home</a></li>
				<li><a href="http://127.0.0.1/offer_create.php">Offer Ride</a></li>
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
<!-- WTF HAPPENED HERE IDK MANZ -->
<p><p><p><p><p><p><p><p><p><p><p>

	<div> <!-- Changing Passwords -->
		<p><b>Change new password</b></p>
		<form action="set_password.php" method="post">
			<label>New password:</label>
			<input type="password" name="newPassword" placeholder="************" type="password">
			<label>Old password:</label>
			<input type="password" name="oldPassword" placeholder="************" type="password">
			<input name="submit" type="submit">
		</form>
	</div>
	<div> <!-- Changing Email -->
		<p><b>Set email</b></p>
		<form action="set_email.php" method="post">
			<label>New Email:</label>
			<input type="text" name="newEmail">
			<input name="submit" type="submit">
		</form>
	</div>
	<div> <!-- Car Display, should be in table format -->
		<?php
			$username = $login_session;
			$query = "SELECT * FROM owns_car WHERE cOwner = '$username'";
			$result = pg_query($query);
			
			print "<p> \n <table> \n <tr> \n <b>Your Cars</b> \n </tr> \n <tr> \n <td>License</td> \n <td>Seat Available</td></tr> \n ";
			while ($row = pg_fetch_array($result)) {
				print "<tr><td> \n";
				print $row[0];
				print "</td> \n <td> \n";
				print (string) $row[1];
				print "</td></tr> \n";
			}
			print "</table> \n </p> \n";

		?>
	</div>
	<div> <!-- Cars setting, for adding new cars -->
		<p><b>Register cars</b></p>
		<form action="register_car.php" method="post">
			<label>New Car License Number:</label>
			<input type="text" name="newLicense">
			<label>Seats Available:</label>
			<input type="number" name="seatsAvailable" min="1">
			<input name="submit" type="submit">
		</form>
	</div>
	<div> <!-- Funds Display, should be in table format -->
		<?php
			$username = $login_session;
			$query = "SELECT money FROM users WHERE name = '$username'";
			$result = pg_query($query);
			
			print "<p> \n <table> \n <tr> \n <b>Current Amount</b> \n </tr> \n <tr> \n ";
			while ($row = pg_fetch_array($result)) {
				print "<tr><td> \n";
				print (string) $row[0];
				print "</td></tr> \n";
			}
			print "</table> \n </p> \n";

		?>
	</div>
	<div> <!-- Add money, for adding new cars -->
		<p><b>Add funds</b></p>
		<form action="add_funds.php" method="post">
			<label>Add amount:</label>
			<input type="number" name="funds" step = "0.10" value = "1.00" min="1.00">
			<input name="submit" type="submit">
		</form>
	</div>
	<div>
		<b><a href="http://127.0.0.1/main.php">Go back to Main Page</a></b>
	</div>
</body>
</html>